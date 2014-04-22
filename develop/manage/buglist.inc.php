<?php
/*
+----------------------------------------------
| [Bigqi.com] ---->
| Item Name	: indexdatacache
+----------------------------------------------
| File	: manage 2012-08-23
| Author: Haierspi ...
+----------------------------------------------
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once libfile('function/forumlist');
require_once _Data('buglist');
require_once _Data('buglistfid');
require_once _Data('hwver');
require_once _Data('buglist_handling');

$bfid = $_Data['buglistfid'];

$id = (int)$_REQUEST['id'];
$operation = $_REQUEST['operation']?$_REQUEST['operation']:'list'; 
$handling = isset($_GET['handling'])?$_GET['handling']:1; 
$page = $_G['page'];
$pagenum = $_G['tpp'];


if($id){
	$onebuglist = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='$id'" );
	$onebuglist['handlings'] = unserialize($onebuglist['handlings']);
	$onebuglist['handlingarray'] = array_pop($onebuglist['handlings']);
	$onebuglist['property'] = unserialize($onebuglist['property']);
}
$myPermission = MyCompletion($myPermission);
if (!$myPermission['itcode']) {
	showmessage('你那需要完善您的个人信息才能继续操作', 'manage.php?action=userinfo');
}



if($operation == 'supply'){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");

	$template = '';


	$message = trim($_POST['message']);
	$note = trim($_POST['note']);
	

	$response = array();
	$response['scode'] = 0;


	if (!$onebuglist) {
		$response['error'] = '不存在的问题,请确认操作';
		$template = 'buglist_error';
	}else{
		$HavePerm = Library::BugWorkPerm($myPermission,$onebuglist);
		if (!$message && $_POST) {
			$response['error'] = '请填写用户需要补充信息的原因,请确认操作';
			$template = 'buglist_error';
		}elseif (!$HavePerm) {
			$response['error'] = '该问题的当前状态下您没有权限处理,请确认操作';
			$template = 'buglist_error';
		}else{
			$response['scode']  = '1';
			if ($_POST) {
				//修改流程状态
					$update = array();

					//最后操作时间
					$update['lasttime'] = $_G['timestamp'];

					$update['note'] = serialize(array(
						'dateline'=>$_G['timestamp'],
						'uid'=>$myPermission['uid'],
						'username'=>$myPermission['username'],
						'itcode'=>$myPermission['itcode'],
						'name'=>$myPermission['name'],
						'message'=>$note
					));
					
					// 将补充还原
					$update['supply'] = '1';
					$update['supplytime'] = '0';

					DB::update('buglist', $update, "`tid`='$onebuglist[tid]'");
					//插入流程日志
					$insert = array();
					$insert['tid']		= $onebuglist['tid'];
					$insert['uid']		= $myPermission['uid'];
					$insert['username']	= $myPermission['username'];
					$insert['name'] 	= $myPermission['name'];
					$insert['itcode']	= $myPermission['itcode'];
					$insert['dateline'] = $_G['timestamp'];
					$insert['handling']	= $onebuglist['handling'];
					$insert['message']	= $message;
					$insert['note']		= $note;
					$insert['dist']		= $myPermission['dist'];
					$insert['status']	= Library::setstatus(1,1);
					

					DB::insert('buglist_log', $insert);

					$response['message'] = '已经完成操作,正在返回';
					$template = 'buglist_suss';
			}else{
				$template = 'buglist_supply';
			}
		}
	}
	if ($template) {
		include template($template,0, './develop/manage/template');
		$response['content']  = ob_get_clean();
	}
	echo json_encode($response);
	exit();
}elseif($operation == 'property'){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");

	$note = trim($_POST['note']);
	

	$response = array();
	$response['scode'] = 0;


	if (!$onebuglist) {
		$response['error'] = '不存在的问题,请确认操作';
		$template = 'buglist_error';
	}else{
		$response['scode']  = '1';
		$template = 'buglist_property';
  	}
	if ($template) {
		include template($template,0, './develop/manage/template');
		$response['content']  = ob_get_clean();
		if ($response['scode'] == '1' && $template == 'buglist_property') {
			$query = DB::query("SELECT bl.*,bu.dist,bu.avatar,bu.title,bu.name,bu.itcode FROM ".DB::table('buglist_log')." bl
			LEFT JOIN  ".DB::table('buglist_user')." bu USING(uid) WHERE bl.tid='$id' ORDER BY bl.`dateline` DESC");
			while($value = DB::fetch($query)) {
				//转换全部状态信息
				$value['handlings'] = unserialize($value['handlings']);
				$value['handlingtxt'] = $_Data['buglist_handling'][$value['handling']]['title'];
				
				$value['note'] = unserialize($value['note']);
				$buglogs[] = $value;
			}
			include template('buglist/viewthread_buglog_ajax');
			$response['buglogs']  = ob_get_clean();
		}
		
	}

	echo json_encode($response);
	exit();


}elseif($operation == 'note'){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");
	$template = '';


	$note = trim($_POST['note']);
	

	$response = array();
	$response['scode'] = 0;


	if (!$onebuglist) {
		$response['error'] = '不存在的问题,请确认操作';
		$template = 'buglist_error';
	}else{
		$HavePerm = Library::BugWorkPerm($myPermission,$onebuglist);
		if (!$note && $_POST) {
			$response['error'] = '请填写用户需要补充信息的原因,请确认操作';
			$template = 'buglist_error';
		}elseif (!$HavePerm) {
			$response['error'] = '该问题的当前状态下您没有权限处理,请确认操作';
			$template = 'buglist_error';
		}else{
			$response['scode']  = '1';
			if ($_POST) {

				$update = array();
				$update['lasttime'] = $_G['timestamp'];
				$update['note'] = serialize(array(
					'dateline'=>$_G['timestamp'],
					'uid'=>$myPermission['uid'],
					'username'=>$myPermission['username'],
					'itcode'=>$myPermission['itcode'],
					'name'=>$myPermission['name'],
					'message'=>$note
				));
				
				DB::update('buglist', $update, "`tid`='$onebuglist[tid]'");
				$response['message'] = '已经完成操作,正在返回';
				$template = 'buglist_suss';
			}else{
				$template = 'buglist_note';
			}
		}
	}
	if ($template) {
		include template($template,0, './develop/manage/template');
		$response['content']  = ob_get_clean();
	}
	echo json_encode($response);
	exit();
}elseif($operation == 'process'){
	@header("Expires: -1");
	@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
	@header("Pragma: no-cache");

	$template = '';


	$handling = isset($_POST['handling'])?intval($_POST['handling']):null;
	$message = trim($_POST['message']);
	$note = trim($_POST['note']);
	

	$response = array();
	$response['scode'] = 0;

	if (!$onebuglist) {
		$response['error'] = '不存在的问题,请确认操作';
		$template = 'buglist_error';
	}else{
		
		$HavePerm = Library::BugWorkPerm($myPermission,$onebuglist,$handling);
		if (!$HavePerm) {
			$response['error'] = '您没有权限处理该问题,请确认操作';
			$template = 'buglist_error';
		}else{

			$response['scode']  = '1';


				
			if ($_POST) {

				if ($onebuglist['handling']==$handling) {
					$response['scode']  = '0';
					$response['error'] = '该问题状态没有更改,无法提交,请确认操作';
					$template = 'buglist_error';
				}else{
					//修改流程状态
					$update = array();
					$update['handling'] = $handling;

					if ($handling == 1) {
						$update['touid'] = $myPermission['uid'];
						$update['tousername'] = $myPermission['username'];
					}elseif ($handling == 2) {
						$update['douid'] = $myPermission['uid'];
						$update['dousername'] = $myPermission['username'];
					}elseif ($handling == 3) {
						$update['douid'] = $myPermission['uid'];
						$update['dousername'] = $myPermission['username'];
					}

					//最后操作时间
					$update['handtime'] = $update['lasttime'] = $_G['timestamp'];
					$update['handlings'] = $onebuglist['handlings']?unserialize($onebuglist['handlings']):array();
					$update['handlings'][$handling] = array(
						'handling'=>$handling,
						'dateline'=>$_G['timestamp'],
						'uid'=>$myPermission['uid'],
						'username'=>$myPermission['username'],
						'itcode'=>$myPermission['itcode'],
						'name'=>$myPermission['name'],
					);
					$update['handlings'] = serialize($update['handlings']);
					$update['note'] = serialize(array(
						'dateline'=>$_G['timestamp'],
						'uid'=>$myPermission['uid'],
						'username'=>$myPermission['username'],
						'itcode'=>$myPermission['itcode'],
						'name'=>$myPermission['name'],
						'message'=>$note
					));
					

					// 将补充还原
					$update['supply'] = '0';
					$update['supplytime'] = '0';

					DB::update('buglist', $update, "`tid`='$onebuglist[tid]'");
					//插入流程日志
					$insert = array();
					$insert['tid']		= $onebuglist['tid'];
					$insert['uid']		= $myPermission['uid'];
					$insert['username']	= $myPermission['username'];
					$insert['name'] 	= $myPermission['name'];
					$insert['itcode']	= $myPermission['itcode'];
					$insert['dateline'] = $_G['timestamp'];
					$insert['handling']	= $handling;
					$insert['message']	= $message;
					$insert['note']		= $note;
					$insert['dist']		= $myPermission['dist'];

					DB::insert('buglist_log', $insert);

					//统计数据

					Library::HandlingRecord($onebuglist['dateline'],$onebuglist['classid'],$handling,$onebuglist['handling']);

					$response['message'] = '已经完成操作,正在返回';
					$template = 'buglist_suss';
				}

			}else{
				$template = 'buglist_process';
			}
		}
	}
	if ($template) {
		include template($template ,0, './develop/manage/template');
		$response['content']  = ob_get_clean();
	}
	
	echo json_encode($response);
	exit();

}else{
	$loadtemplate = 'buglist_list';
	
	if($handling == -1){

		if (in_array($myPermission['dist'], array(1))) {
			//产品经理有权限查看全部问题
			$sqlwhere = " WHERE ".BugClassSelectSql($myPermission['buglist']);
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			$sqlwhere = " WHERE 1 ";
		}else{
			//其他人没权限
			$sqlwhere = '';
		}
	}elseif($handling == 0){
		//新提交
		if (in_array($myPermission['dist'], array(1,3))) {
			//产品经理 反馈工程师 有权限查看新提交的问题
			//$sqlwhere = " WHERE b.`handling`='$handling' AND ".BugClassSelectSql($myPermission['buglist']);
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			//$sqlwhere = " WHERE b.`handling`='$handling' ";
		}else{
			//其他人没权限
			//$sqlwhere = '';
		}
	}elseif($handling == 1){
		//待解决
		if (in_array($myPermission['dist'], array(1,2))) {
			//产品经理 产品工程师 有权限查看问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(3))) {
			//反馈工程师 有权限查看自己反馈中的待解决问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND b.`touid`='$myPermission[uid]' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			$sqlwhere = " WHERE b.`handling`='$handling' ";
		}else{
			//其他人没权限
			$sqlwhere = '';
		}

	}elseif($handling == 2){
		//正在解决
		if (in_array($myPermission['dist'], array(1))) {
			//产品经理 有权限查看问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(3))) {
			//反馈工程师 有权限查看自己反馈中的待解决问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND b.`touid`='$myPermission[uid]' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(2))) {
			//产品工程师 有权限查看自己解决中的问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND b.`douid`='$myPermission[uid]' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			$sqlwhere = " WHERE b.`handling`='$handling' ";
		}else{
			//其他人没权限
			$sqlwhere = '';
		}
	}elseif($handling == 3){
		//已经解决
		if (in_array($myPermission['dist'], array(1))) {
			//产品经理 有权限查看问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(3))) {
			//反馈工程师 有权限查看自己反馈中的待解决问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND b.`touid`='$myPermission[uid]' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(2))) {
			//产品工程师 有权限查看自己解决中的问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND b.`douid`='$myPermission[uid]' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			$sqlwhere = " WHERE b.`handling`='$handling' ";
		}else{
			//其他人没权限
			$sqlwhere = '';
		}
	}elseif($handling == 4){
		//完结
		if (in_array($myPermission['dist'], array(1,2,3))) {
			//产品经理 反馈工程师 有权限查看所有问题
			$sqlwhere = " WHERE b.`handling`='$handling' AND (".BugClassSelectSql($myPermission['buglist']).")";
		}elseif (in_array($myPermission['dist'], array(-1,4))) {
			//论坛管理员,信息专员有全部问题查看权限
			$sqlwhere = " WHERE b.`handling`='$handling' ";
		}else{
			//其他人没权限
			$sqlwhere = '';
		}
	}

	if (!$sqlwhere) {
		showmessage('您没有权限查看相关信息', 'javascript:history.go(-1);');
	}

	if ($_GET['search']) {
		$sqlwhere = " WHERE `title`  LIKE '%$_GET[search]%'";
	}
	$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('buglist')." b  $sqlwhere  ORDER BY b.`lasttime` DESC");
	if(@ceil($TotalNum/$pagenum) < $page){
		$page = 1;
	}
	$offset = ($page - 1) * $pagenum;

	$query = DB::query("SELECT * FROM ".DB::table('buglist')." b 
	LEFT JOIN ".DB::table('forum_thread')." t 
	USING(`tid`) $sqlwhere  ORDER BY b.`lasttime` DESC LIMIT $offset,$pagenum ");
	while($value = DB::fetch($query)) {
		//转换全部状态信息
		$value['handlings'] = unserialize($value['handlings']);
		$value['handlingarray'] = end($value['handlings']);
		$value['note'] = unserialize($value['note']);
		$buglists[] = $value;
	}
	$multipage = multi($TotalNum, $pagenum, $page, "manage.php?action=$action&operation=".$operation, $_G['setting']['threadmaxpages']);



	//echo var_dump(serialize(array(array('handling'=>'2','dateline'=>'85344544544','uid'=>'2','username'=>'test','itcode'=>'caogl','name'=>'曹广来'))));
	foreach (array('hardware','version' ) as $value) {
		$query = DB::query("SELECT * FROM ".DB::table('buglist_'.$value).' ORDER BY id DESC');
		while($rvalue = DB::fetch($query)) {
			$BugOption[$value][$rvalue['id']] = $rvalue;
		}
	}

}



?>