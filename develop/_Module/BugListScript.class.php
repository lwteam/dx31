<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');

class BugListScript {
	public $action,$point;
	public $returns;
	public function action($point) {
		global $_G,$_Data;
		require_once _Data('buglist');
		require_once _Data('buglistfid');
		require_once _Data('buglist_handling');

		$_G['setting']['plugins']['func']['hookscript']['deletethread'] = true;
		$_G['setting']['plugins']['func']['hookscriptmobile']['deletethread'] = true;
		$this->point = $point;
		if ($this->point == 'hooks') {
				
			if ( constant('CURSCRIPT') == 'forum' && constant('CURMODULE') == 'forumdisplay' &&  $_G['fid'] == $_Data['buglistfid'] ) {
				$this->action = 'forumdisplay';
				return true;
			}elseif ( constant('CURSCRIPT') == 'forum' && constant('CURMODULE') == 'viewthread' &&  $_G['fid'] == $_Data['buglistfid'] ) {
				$this->action = 'viewthread';
				return true;
			}elseif ( constant('CURSCRIPT') == 'forum' && constant('CURMODULE') == 'post' &&  $_G['fid'] == $_Data['buglistfid'] && $_GET['action']=='newthread') {
				$this->action = 'post';
				return true;
			}else{
				
				return false;
			}
		}elseif ($this->point == 'output') {
				
			if ( constant('CURSCRIPT') == 'forum' && constant('CURMODULE') == 'post' &&  $_G['fid'] == $_Data['buglistfid'] && $_GET['action']=='newthread') {
				$this->action = 'post';
					
				return true;
			}else{
				
				return false;
			}

		}elseif ($this->point == 'hookscript' && $this->returns['script'] =='deletethread' && $this->returns['param']['step'] =='delete' ) {
			$this->action = 'delete';
			return true;
		}else{
			return false;
		}
	} 
	public function execute() {
		global $_G,$_Data;



			

		$_Data['buglist_handling'][4] = $_Data['buglist_handling'][3];

		if ($this->action == 'forumdisplay') {

			define('BUGLIST','forumdisplay');

			//每页数量
			$pagenum = $_G['tpp'];
			$page = $_G['page'];
			$view = $_GET['view'];
			$classid = isset($_GET['classid'])?$_GET['classid']:NULL;
			$hardware = isset($_GET['hardware'])?$_GET['hardware']:NULL;
			$version = isset($_GET['version'])?$_GET['version']:NULL;
			$handling = isset($_GET['handling'])?$_GET['handling']:NULL;

	
			if ($view == 'me') {
				if(empty($_G['uid'])) {
					showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
				}
				$sqlwhere = "WHERE `uid`='$_G[uid]'";
				if ($handling!==NULL) {
					$sqlwhere .= " AND b.`handling`='$handling'";
				}
			}else{
				$sqlwhere = 'WHERE 1 ';
				if ($classid) {
					$BugClass = $this->BugClassSelectSql($classid);
					if ($BugClass) {
						$sqlwhere .= ' AND '.$BugClass;
					}
				}
				if ($handling!==NULL) {
					$sqlwhere .= " AND b.`handling`='$handling'";
				}

				if ($hardware) {
					$sqlwhere .= " AND b.`hardware`='$hardware'";
				}
				if ($version) {
					$sqlwhere .= " AND b.`version`='$version'";
				}

			}
					



			
			$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('buglist')." b $sqlwhere ");
			if(@ceil($TotalNum/$pagenum) < $page){
				$page = 1;
			}
			$offset = ($page - 1) * $pagenum;


			$query = DB::query("SELECT * FROM ".DB::table('buglist')." b 
			LEFT JOIN ".DB::table('forum_thread')." t USING(`tid`) 
			$sqlwhere  ORDER BY b.`dateline` DESC LIMIT $offset,$pagenum");
			
			while($thread = DB::fetch($query)) {
				$thread['handlingtxt'] = $_Data['buglist_handling'][$thread['handling']]['title'];
				$thread['handlingstylec'] = $_Data['buglist_handling'][$thread['handling']]['stylec'];
				$thread['samenum'] = (int)$thread['samenum'];

				$thread['dbdateline'] = $thread['dateline'];
				$thread['dateline'] = dgmdate($thread['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$threadlist[] = $thread;
			}


			if ($classid && $_Data['buglistrelation'][$classid]) {
				$Relations = $_Data['buglistrelation'][$classid];
				foreach (array('hardware','version' ) as $value) {
					$sqlwhere = " WHERE type ".(is_array($Relations[$value])?'IN ('.JOIN(',',$Relations[$value]).')':"='{$Relations[$value]}'");
						
					if ($sqlwhere) {
						$query = DB::query("SELECT * FROM ".DB::table('buglist_'.$value).$sqlwhere.' ORDER BY dateline DESC'.($value=='version'?' LIMIT 10':''));
						while($rvalue = DB::fetch($query)) {
							$rvalue['self'] = $Relations['self'];
							${$value.'list'}[] = $rvalue;
						}
					}
				}
			}


			//使用缓存
			if(($HotEngineers = discuz_table::fetch_cache(0, 'buglist_mstatus')) === false){
				$thisyear=date( 'Y', TIMESTAMP );
				$thismonth=date( 'm', TIMESTAMP );
				$selectmonth = $thisyear.$thismonth;
				$HotEngineers = DB::fetch_all("SELECT bm.*,bu.* FROM ".DB::table('buglist_mstatus')." bm
					LEFT JOIN ".DB::table('buglist_user')." bu USING(`uid`)
				 WHERE bm.`type`='0' AND bm.`month`='$selectmonth' ORDER BY bm.`hnum` DESC LIMIT 100");
				discuz_table::store_cache(0, $HotEngineers, 86400 , 'buglist_mstatus');
			}
			//使用缓存
			// 一周热门遇到的问题
			if(($HotBugs = discuz_table::fetch_cache(0, 'buglist_hotbugs')) === false){
				$thisyear=date( 'Y', TIMESTAMP );
				$thismonth=date( 'm', TIMESTAMP );
				$thisday=date( 'd', TIMESTAMP );
				$thiszerotime =	mktime( 0,0,0,$thismonth, $thisday, $thisyear );
				$offsettime = $thiszerotime - 604800;
				$HotBugs = DB::fetch_all("SELECT b.*,t.fid,t.subject FROM ".DB::table('buglist')." b 
					LEFT JOIN ".DB::table('forum_thread')." t USING(`tid`) 
				 WHERE b.dateline>'$offsettime' ORDER BY b.`samenum` DESC LIMIT 10");
				discuz_table::store_cache(0, $HotBugs, 86400 , 'buglist_hotbugs');
			}
	
			
			$multipage = multi($TotalNum, $pagenum, $page, "forum.php?mod=forumdisplay&fid=$_G[fid]", $_G['setting']['threadmaxpages']);
			$navigation = '<span class="pipe">&raquo;</span>'.'<a href="forum.php?mod=forumdisplay&fid='.$_G['fid'].'">'.$_G['forum']['name'].'</a>';
			include template('buglist/forumdisplay');
			exit;

		}elseif ($this->action == 'viewthread') {
			define('BUGLIST','viewthread');

			global $bthread;
			$bthread = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='{$_G['thread']['tid']}'" );
			if ($bthread) {

				if ($bthread['handling'] == 4) {
					$bthread['handling'] = 3;
					$bthread['handlingend'] = true;
				}


				$bthread['classnavtxt'] = ((strlen($bthread['classid']) != 1)?$_Data['buglist'][substr($bthread['classid'],0,1)].' > ':'').$_Data['buglist'][$bthread['classid']];

				$bthread['handlings'] = unserialize($bthread['handlings']);

				if ($bthread['handlings'] ) {
					$bthread['handlingarray'] = end($bthread['handlings']);
					$bthread['handlingnum'] = count($bthread['handlings']);
				}		
				$bthread['property'] = unserialize($bthread['property']);

	

				$query = DB::query("SELECT bl.*,bu.avatar,bu.name,bu.another,bu.title,bu.team,bu.hide FROM ".DB::table('buglist_log')." bl
				LEFT JOIN  ".DB::table('buglist_user')." bu USING(uid) WHERE bl.tid='{$_G['thread']['tid']}' ORDER BY bl.`dateline` DESC");
				while($value = DB::fetch($query)) {
					//转换全部状态信息
					$value['showname'] = $value['dist']?$value['another']:$value['username'];
					$value['handlings'] = unserialize($value['handlings']);
					$value['handlingtxt'] = $_Data['buglist_handling'][$value['handling']]['title'];
					$value['note'] = unserialize($value['note']);
					unset($value['itcode'] );
					$bthread['hlogs'][] = $value;
				}
				
				global $BugOption;
				foreach (array('hardware','version' ) as $value) {
					$query = DB::query("SELECT * FROM ".DB::table('buglist_'.$value).' ORDER BY id DESC');
					while($rvalue = DB::fetch($query)) {
						$BugOption[$value][$rvalue['id']] = $rvalue;
					}
				}
				// 一周热门遇到的问题
				if(($HotBugs = discuz_table::fetch_cache(0, 'buglist_hotbugs')) === false){
					$thisyear=date( 'Y', TIMESTAMP );
					$thismonth=date( 'm', TIMESTAMP );
					$thisday=date( 'd', TIMESTAMP );
					$thiszerotime =	mktime( 0,0,0,$thismonth, $thisday, $thisyear );
					$offsettime = $thiszerotime - 604800;
					$HotBugs = DB::fetch_all("SELECT b.*,t.fid,t.subject FROM ".DB::table('buglist')." b 
						LEFT JOIN ".DB::table('forum_thread')." t USING(`tid`) 
					 WHERE b.dateline>'$offsettime' ORDER BY b.`samenum` DESC LIMIT 10");
					discuz_table::store_cache(0, $HotBugs, 86400 , 'buglist_hotbugs');
				}


			}


			//include template('forum/forumdisplay');
			//exit;
		}elseif ($this->action == 'post') {

			define('BUGLIST','post');
			$classid = (int)$_REQUEST['classid'];
			$hardware = $_REQUEST['hardware'];
			$version = $_REQUEST['version'];
			$bugattr = $_REQUEST['bugattr'];

			global $bthread;
			if ( $_G['thread'] && !$bthread) {
							
				$bthread = DB::fetch_first("SELECT *  FROM ".DB::table('buglist')."  WHERE tid='{$_G['thread']['tid']}'" );
				if ($bthread) {
					$bthread ['property'] = unserialize($bthread['property']);
					if ($bthread ['handling'] != 0) {
						showmessage('这个问题已经进入流程无法编辑!', dreferer());
					}
				}
			}

			

			if ($_POST && !defined('BUGLIST_CHECKED')) {
				define('BUGLIST_CHECKED',TRUE);

				
				if (!$classid || !$_Data['buglistrelation'][$classid]['bugattr']) {
					showmessage('请求分类不存在!', dreferer());
				}


				$ElementMust = array();
				//需要引入缓存机制
				$Relations = $_Data['buglistrelation'][$classid];
				foreach (array('hardware','version' ) as $value) {
					if (!$$value) {
						continue;
					}
					$postfieldid = $$value;
					$sqlwhere = " WHERE type ".(is_array($Relations[$value])?'IN ('.JOIN(',',$Relations[$value]).')':"='{$Relations[$value]}' AND `id`='$postfieldid'");	
					if ($sqlwhere) {
						$postfield = DB::fetch_first("SELECT * FROM ".DB::table('buglist_'.$value).$sqlwhere);
						if (!$postfield) {
							showmessage('硬件型号或版本不存在!', dreferer());
						}
					}
				}

				
				$_POST['property'] = array();
				if ($bugattr) {
					$bugattrids = join(',',array_keys($bugattr));
					//需要引入缓存机制
					$query = DB::query("SELECT * FROM ".DB::table('buglist_bugattr')." WHERE type ='$Relations[bugattr]' AND id IN ($bugattrids)");
					while($value = DB::fetch($query)) {
						if ($value['inputtype']) {
							$text = str_replace("\r", '', trim($value['text']));
							$value['selectlist'] = explode("\n",$text);
						}
						$bugattrlist[$value['id']] = $value;
					}
					foreach ($bugattr as $key => $value) {
						if (!$bugattrlist[$key]) {
							showmessage('您填写的字段不存在!', dreferer());
						}
						if ($bugattrlist[$key]['inputtype']) {
							if (!$bugattrlist[$key]['selectlist'][$value]) {
								showmessage('您填写的字段值不存在!', dreferer());
							}
							$_POST['property'][$key] = array('key' => $value ,'title' =>$bugattrlist[$key]['title'] ,'value' =>$bugattrlist[$key]['selectlist'][$value]);
						}else{
							$_POST['property'][$key] = array('title' =>$bugattrlist[$key]['title'] ,'value' =>$value);

						}
					}
						
				}
			}elseif ($_POST && $this->point == 'output') {

				if ( in_array($this->returns['message'], array('post_newthread_succeed' ,'post_newthread_mod_succeed'))) {	
					$insert = array();
					$insert['tid']		= $GLOBALS['tid'];
					$insert['uid']		= $_G['uid'];
					$insert['username']	= $_G['username'];
					$insert['classid'] 	= $classid;
					$insert['hardware']	= $_POST['hardware'];
					$insert['version']	= $_POST['version'];
					$insert['dateline'] = $insert['handtime'] = $insert['lasttime']  = $_G['timestamp'];
					$insert['samenum']	= 1;
					$insert['property']	= serialize($_POST['property']);
					DB::insert('buglist', $insert);
					//统计
					Library::HandlingRecord($insert['dateline'],$classid);

				}elseif ( in_array($this->returns['message'], array('post_edit_succeed' ,'edit_newthread_mod_succeed')) ) {

					$update = array();
					$update['classid'] 	= $classid;
					$update['hardware']	= $_POST['hardware'];
					$update['version']	= $_POST['version'];
					$update['lasttime']  = $_G['timestamp'];
					$update['property']	= serialize($_POST['property']);
					DB::update('buglist', $update, "`tid`='$_G[tid]'");	
					Library::HandlingRecord($bthread['dateline'],$classid, NULL, FALSE, FALSE);
					Library::HandlingRecord($bthread['dateline'],$classid);
				}
				
			}
		}elseif ($this->action == 'delete') {
			DB::query(" DELETE FROM ".DB::table('buglist')." WHERE `tid` IN (".$_G['deletethreadtids'].")");
		}
	}
	public function BugClassSelectSql($id,$filed='b.`classid`') {
		global $_Data;
		$sql = '';
		$IdAs = array();
		foreach($_Data['buglist'] as $key=>$value){
			$len = strlen($id);
			if(substr($key, 0, $len) != $id){
				continue;
			}
			$IdAs[] = $key;
		}
		if ($IdAs) {
			$sql = "$filed in (".JOIN(',',$IdAs).')';

		}

		return $sql;
	}
	public function GetSelectUrl($classid = NULL,$handling = NULL,$hardware = NULL,$version = NULL) {
		
		$url = '';
		foreach (array('classid','handling','hardware','version') as  $value) {
			if ($$value !== NULL) {
				$url .= "&$value=".$$value;
			}
		}
		
		return $url;
	}
			
}

?>