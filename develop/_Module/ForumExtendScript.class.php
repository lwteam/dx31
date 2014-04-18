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
		if (defined('CURSCRIPT') && CURSCRIPT == 'forum') {
			return true;
			
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G,$_Data;
			
		
		require_once libfile('function/forumlist');

		if (in_array($_GET['operation'], array('model','vibeui','apps','portal'))) {
$operation = $_GET['operation'];
			define('TopPoint',$operation);

			if (!isset($_Data['forumextend'][$operation]) || !$_Data['forumextend'][$operation]) {
				return;
			}

			//使用缓存
			if(($catlist = discuz_table::fetch_cache(0, 'catlist_'.$operation)) === false){
				$fups = $_Data['forumextend'][$operation];
				$fupsids = join(',',$fups);

				$forums = DB::fetch_all("SELECT ff.*, f.* FROM ".DB::table('forum_forum')." f 
						LEFT JOIN ".DB::table('forum_forumfield')." ff USING (fid) 
					WHERE f.status='1' AND (f.fup IN ($fupsids) || f.fid IN ($fupsids) ) 
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
			}

				
			include template('forum/discuz');
			exit;
		}elseif ($_G['fid']) {
			if ($_G['fid'] != $_Data['buglistfid'] && $_G['forum'] && $_Data['forumextend_fup'][$_G['forum']['fup']]) {
				define('TopPoint',$_Data['forumextend_fup'][$_G['forum']['fup']]);
				if(TopPoint == 'vibeui'){
					loadcache('product');
				}
				
			}else{

			}
		}else{
			dheader("Location: ./");
		}





		if ($this->action == 'group') {

			
		}else{
			define('TopPoint',$_Data['forumextend_fup'][$_G['forum']['fup']]);
		}

		

	}

}


?>