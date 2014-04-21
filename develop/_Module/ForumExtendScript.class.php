<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');

class ForumExtendScript {
	public $action;
	public function action($point) {
		global $_G,$_Data;
		require_once _Data('buglistfid');
		require_once _Data('forumextend');

		if(($_Data['forumextend_fup'] = discuz_table::fetch_cache(0, 'forumextend_fup')) === false){
			$_Data['forumextend_fup'] = $fuparray = array();
			foreach ($_Data['forumextend'] as $key => $array) {
				foreach ($array as $value) {
					$_Data['forumextend_fup'][$value] = $key;
					$fuparray[] = $value;
				}
			}
			$fupfids = join(',',$fuparray);
			$query = DB::query("SELECT fid,fup FROM ".DB::table('forum_forum')." WHERE status='1' AND fup IN ($fupfids) AND type = 'forum' ORDER BY displayorder");

			while($forum = DB::fetch($query)) {
				$_Data['forumextend_fup'][$forum['fid']] =$_Data['forumextend_fup'][$forum['fup']];
			}
			discuz_table::store_cache(0, $_Data['forumextend_fup'], 86400 , 'forumextend_fup');
		}



		if (defined('CURSCRIPT') && constant('CURSCRIPT')  == 'forum' && in_array(constant('CURMODULE'),array('index','forumdisplay','viewthread','post'))) {
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G,$_Data;
			
		
		require_once libfile('function/forumlist');

		$operation = $_GET['operation'];
		if (in_array($operation, array('model','vibeui','apps','portal'))) {
			
			define('TopPoint',$operation);

			$TopPoint = constant('TopPoint');
			$TopPointtxt = $_Data['forumextendtxt'][$TopPoint];
			global $navigation;
			$navigation = '<span class="pipe">&raquo;</span><a href="forum.php?operation='.$TopPoint.'">'.$TopPointtxt.'</a>';

			if (!isset($_Data['forumextend'][$operation]) || !$_Data['forumextend'][$operation]) {
				return;
			}

			$fups = $_Data['forumextend'][$operation];
			$fupfids = join(',',$fups);


			//使用缓存
			if(($catlist = discuz_table::fetch_cache(0, 'catlist_'.$operation)) === false){
				$forums = DB::fetch_all("SELECT ff.*, f.* FROM ".DB::table('forum_forum')." f 
						LEFT JOIN ".DB::table('forum_forumfield')." ff USING (fid) 
					WHERE f.status='1' AND (f.fup IN ($fupfids) || f.fid IN ($fupfids) ) 
						AND f.type IN ('forum','group') ORDER BY f.type,f.displayorder");
				foreach($forums as $forum) {
					$forumname[$forum['fid']] = strip_tags($forum['name']);
					$forum['extra'] = empty($forum['extra']) ? array() : dunserialize($forum['extra']);
					if(!is_array($forum['extra'])) {
						$forum['extra'] = array();
					}
					if($forum['type'] != 'group') {
						$threads += $forum['threads'];
						$posts += $forum['posts'];
						$todayposts += $forum['todayposts'];

						if($forum['type'] == 'forum' && isset($catlist[$forum['fup']])) {
							if(forum($forum)) {
								$catlist[$forum['fup']]['forums'][] = $forum['fid'];
								$forum['orderid'] = $catlist[$forum['fup']]['forumscount']++;
								$forum['subforums'] = '';
								$forumlist[$forum['fid']] = $forum;
							}
						} elseif(isset($forumlist[$forum['fup']])) {

							$forumlist[$forum['fup']]['threads'] += $forum['threads'];
							$forumlist[$forum['fup']]['posts'] += $forum['posts'];
							$forumlist[$forum['fup']]['todayposts'] += $forum['todayposts'];
							if($_G['setting']['subforumsindex'] && $forumlist[$forum['fup']]['permission'] == 2 && !($forumlist[$forum['fup']]['simple'] & 16) || ($forumlist[$forum['fup']]['simple'] & 8)) {
								$forumurl = !empty($forum['domain']) && !empty($_G['setting']['domain']['root']['forum']) ? 'http://'.$forum['domain'].'.'.$_G['setting']['domain']['root']['forum'] : 'forum.php?mod=forumdisplay&fid='.$forum['fid'];
								$forumlist[$forum['fup']]['subforums'] .= (empty($forumlist[$forum['fup']]['subforums']) ? '' : ', ').'<a href="'.$forumurl.'" '.(!empty($forum['extra']['namecolor']) ? ' style="color: ' . $forum['extra']['namecolor'].';"' : '') . '>'.$forum['name'].'</a>';
							}
						}
						$opfids[] = $forum['fid'];
					} else {

						if($forum['moderators']) {
						 	$forum['moderators'] = moddisplay($forum['moderators'], 'flat');
						}
						$forum['forumscount'] 	= 0;
						$catlist[$forum['fid']] = $forum;
					}
				}
				unset( $forum_fields);
				discuz_table::store_cache(0, $catlist, 86400 , 'catlist_'.$operation);
				discuz_table::store_cache(0, $opfids, 86400 , 'Opfids_'.$operation);
			}else{
				$opfids = discuz_table::store_cache(0, $opfids, 86400 , 'Opfids_'.$operation);
			}

			unset($_G['cache']['forumlinks']);

			if (($operation == 'model' || $operation == 'apps') && !$_G['fid']) {

				//热门论坛
				if(($HotForums = discuz_table::fetch_cache(0, 'HotForums_'.$operation)) === false){
					$HotForums = DB::fetch_all("SELECT  f.* FROM ".DB::table('forum_forum')." f 
					WHERE f.type='forum' AND f.fup IN ($fupfids) ORDER BY f.todayposts LIMIT 10");
					discuz_table::store_cache(0, $HotForums, 7200 , 'HotForums_'.$operation);
				}
				//推荐主题
				if(($RecomThreads = discuz_table::fetch_cache(0, 'RecomThreads_'.$operation)) === false){
					$opfids_csv = join(',',$opfids);
					$query = DB::query("SELECT * FROM pre_forum_forumrecommend WHERE fid IN ($opfids_csv) AND `position` IN('0','1') ORDER BY displayorder  LIMIT 5");
					while($thread = DB::fetch($query)) {
						$imgd = explode("\t", $thread['filename']);
						if($imgd[0] && $imgd[3]) {
							$thread['filename'] = getforumimg($imgd[0], 0, $imgd[1], $imgd[2]);
						}
						$RecomThreads[] =$thread;
					}
					discuz_table::store_cache(0, $RecomThreads, 7200 , 'RecomThreads_'.$operation);
				}
			}

			if ( constant('CURMODULE') != 'viewthread') {
				// 热门主题
				if(($HotThreads = discuz_table::fetch_cache(0, 'HotThreads_'.$operation)) === false){
					$selectfids_csv = join(',',$opfids);
					$selecttime = strtotime("-7 days");

					$HotThreads = DB::fetch_all("SELECT * FROM ".DB::table('forum_thread')." WHERE fid in ($selectfids_csv) AND dateline>'$selecttime' AND `displayorder` IN('0','1','2','3','4') ORDER BY `replies` DESC LIMIT 10");
					discuz_table::store_cache(0, $HotThreads, 43200 , 'HotThreads_'.$operation);
				}
			}
				
			include template('forum/discuz');
			exit;
		}elseif ($_G['fid']) {
			if ($_G['forum']['type'] != 'group') {
				if ($_G['fid'] != $_Data['buglistfid'] && $_G['forum'] && $_Data['forumextend_fup'][$_G['forum']['fup']]) {
					define('TopPoint',$_Data['forumextend_fup'][$_G['forum']['fup']]);
					if(constant('TopPoint')  == 'vibeui'){
						loadcache('product');
					}
				}elseif ($_G['fid'] == $_Data['buglistfid']){
					define('TopPoint','buglist');
				}

				if ( constant('CURMODULE') != 'viewthread' && $_G['fid'] && $_G['fid'] != $_Data['buglistfid']) {
					if(($HotThreads = discuz_table::fetch_cache($_G['fid'], 'HotThreads_')) === false){
						$selecttime = strtotime("-7 days");
						$HotThreads = DB::fetch_all("SELECT * FROM ".DB::table('forum_thread')." WHERE `fid`='{$_G['fid']}' AND dateline>'$selecttime' AND `displayorder` IN('0','1','2','3','4') ORDER BY `replies` DESC LIMIT 10");
						discuz_table::store_cache($_G['fid'], $HotModels, 43200 , 'HotThreads_');
					}
				}
			}
			if ($_G['forum']['type'] == 'forum') {
				$_G['dforum'] = $_G['forum'];
			}elseif ($_G['forum']['type'] == 'sub') {
				global $sublist;

				$_G['dforum'] = $_G['cache']['forums'][$_G['forum']['fup']];

				$sublist = array();
				$query = C::t('forum_forum')->fetch_all_info_by_fids(0, 'available', 0, $_G['forum']['fup'], 1, 0, 0, 'sub');

				if(!empty($_G['member']['accessmasks'])) {
					$fids = array_keys($query);
					$accesslist = C::t('forum_access')->fetch_all_by_fid_uid($fids, $_G['uid']);
					foreach($query as $key => $val) {
						$query[$key]['allowview'] = $accesslist[$key];
					}
				}
				foreach($query as $sub) {
					$sub['extra'] = dunserialize($sub['extra']);
					if(!is_array($sub['extra'])) {
						$sub['extra'] = array();
					}
					if(forum($sub)) {
						$sub['orderid'] = count($sublist);
						$sublist[] = $sub;
					}
				}
					
			}

				
		}elseif(constant('CURMODULE')  == 'index'){
			dheader("Location: ./");
		}

	}

}


?>