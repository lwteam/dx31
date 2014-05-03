<?php

chdir('../');
$_SERVER['SCRIPT_NAME'] = 'manage.php';
define('CURSCRIPT', 'manage');
require './source/class/class_core.php';

$discuz = & discuz_core::instance();
$discuz->init();

require_once _Data('buglist');
require_once _Data('buglistfid');
require_once _Data('hwver');

@header("Expires: -1");
@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
@header("Pragma: no-cache");

$response = array();
$response['scode'] = '0';

$globalvar = array();

$action = in_array($_REQUEST['action'], array('samenum','membersupply','getattr'))?$_REQUEST['action']:''; 

if(!$action){
	$response['error'] = '请求错误, 请确认后操作!';
	Library::ajax_output();
}

if(!$_G['uid']){
	$response['error'] = '您还没有登陆,请登陆重试';
	Library::ajax_output();
}




	
if ($action == 'getattr') {
	$classid = (int)$_REQUEST['classid'];
	if (!$classid || !$_Data['buglistrelation'][$classid]['bugattr']) {
		$response['error'] = '请求分类不存在!';
		Library::ajax_output();
	}

	if($_GET['tid']){
		$bthread = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='{$_GET[tid]}'" );
		if ($bthread) {
			$bthread['property'] = unserialize($bthread['property']);
			$globalvar['bthread'] = &$bthread;
		}
	}

	$ElementMust = array();

	$Relations = $_Data['buglistrelation'][$classid];
	foreach (array('hardware','version' ) as $value) {
		$sqlwhere = " WHERE type ".(is_array($Relations[$value])?'IN ('.JOIN(',',$Relations[$value]).')':"='{$Relations[$value]}'");
			
		if ($sqlwhere) {
			$query = DB::query("SELECT * FROM ".DB::table('buglist_'.$value).$sqlwhere.' ORDER BY dateline DESC');
			while($rvalue = DB::fetch($query)) {
				if ($bthread && $bthread[$value] ==$rvalue['id'] ) {
					$rvalue['selected'] = true;
				}
				$rvalue['self'] = $Relations['self'];
				${$value.'list'}[] = $rvalue;
			}
			if (count(${$value.'list'})) {
				$ElementMust[] = $value;
			}
			$globalvar[ $value.'list'] = & ${$value.'list'};
		}
	}

	
	$query = DB::query("SELECT * FROM ".DB::table('buglist_bugattr')." WHERE type ='$Relations[bugattr]' ORDER BY `id` DESC");
	while($value = DB::fetch($query)) {
		$value['elementid'] = 'bugattr_'.$value['id'];
		if ($value['inputtype']) {
			$text = str_replace("\r", '', trim($value['text']));
			$value['selectlist'] = explode("\n",$text);
		}
		if ($bthread && $bthread['property'] ) {
			$value['key'] = $bthread['property'][$value['id']]['key'];
			$value['value'] = $bthread['property'][$value['id']]['value'];
		}
		if ($value['must']) {
			$ElementMust[] = $value['elementid'];
		}

		$bugattrlist[] = $value;
	}
	if ($bugattrlist) {
		$globalvar['bugattrlist'] = & $bugattrlist;
	}

	
	$response['scode'] = 1;
	$response['num'] = count($bugattrlist);
	$response['must'] =$ElementMust;
	Library::ajax_output('buglist/post_bugattr_ajax');

}elseif ($action == 'membersupply') {

	$message = trim($_POST['message']);

	$tid = (int)$_REQUEST['tid'];


	
	$bthread = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='$tid'" );
	if ($bthread) {
		$bthread['property'] = unserialize($bthread['property']);
		if ($bthread['uid'] != $_G['uid']) {
			$response['error'] = '您不是该问题的作者,不能补充信息!';
			Library::ajax_output('buglist/buglist_error');
		}
		if (!$bthread[supply] || $bthread[supplytime]) {
			$response['error'] = '该问题已经或不需要补充信息!';
			Library::ajax_output('buglist/buglist_error');
		}
		$globalvar['bthread'] = &$bthread;
	}else{
		$response['error'] = '该问题流程信息不存在!';
		Library::ajax_output('buglist/buglist_error');
	}

	if ($_POST) {
		if (!$message ) {
			$response['error'] = '请填写您需要内容,谢谢';
			Library::ajax_output('buglist/buglist_error');
		}
		$insert = array();
		$insert['tid']		= $bthread['tid'];
		$insert['uid']		= $bthread['uid'];
		$insert['username']	= $bthread['username'];
		$insert['dateline'] = $_G['timestamp'];
		$insert['handling']	= $bthread['handling'];
		$insert['message']	= $message;
		$insert['status']	= Library::setstatus(2,1,1);
		DB::insert('buglist_log', $insert);

		$update = array();
		$update['supply'] = '1';
		$update['supplytime'] = $_G['timestamp'];
		$update['lasttime'] = $_G['timestamp'];
		
		DB::update('buglist', $update, "`tid`='$tid'");

		$response['message'] = '已经完成操作,正在返回';
		Library::ajax_output('buglist/buglist_suss');
	}else{
		Library::ajax_output('buglist/buglist_membersupply');
	}

}elseif ($action == 'samenum') {

	$tid = (int)$_REQUEST['tid'];
	
	$bthread = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='$tid'" );

	
	if ($bthread) {
		$bthread['property'] = unserialize($bthread['property']);
		if ($bthread['uid'] == $_G['uid']) {
			$response['error'] = '您不能操作自己的帖子!';
			Library::ajax_output('buglist/buglist_error');
		}
		$globalvar['bthread'] = &$bthread;
	}else{
		$response['error'] = '该问题流程信息不存在!';
		Library::ajax_output('buglist/buglist_error');
	}

		
	//判断动作是否重复
	$isdo = DB::fetch_first("SELECT *  FROM ".DB::table('buglist_urecords')."  WHERE `keytype`='samenum' AND `keyid`='$tid' AND `uid`='{$_G['uid']}'" );
	if ($isdo) {
		$response['error'] = '你已经操作过,不能重复操作!';
		Library::ajax_output('buglist/buglist_error');
	}else{
		$response['scode'] = '1';
		$response['num'] = $bthread['samenum']+1;

		
		DB::query("insert into ".DB::table('buglist_urecords')." 
				(`keytype`,`keyid`,`uid`,`num`) values ('samenum', '$tid','{$_G['uid']}','1');");


		
		DB::query('UPDATE '.DB::table('buglist')." SET `samenum`=`samenum`+1,`lasttime`='$_G[timestamp]'   WHERE `tid`='$tid' ");
		$response['message'] = '已经完成操作';
		Library::ajax_output();
	}
	
}



?>