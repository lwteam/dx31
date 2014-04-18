<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');

class ForumExtendScript {
	public $action;
	public function action($point) {
		global $_G,$_Data;
		require_once _Data('buglistfid');
		require_once _Data('forumextend');

		if (!$_Data['forumextend_fup']) {
			$_Data['forumextend_fup'] = array();
			foreach ($_Data['forumextend'] as $key => $array) {
				foreach ($array as $value) $_Data['forumextend_fup'][$value] = $key;
			}
		}
	
		if (defined('CURSCRIPT') && CURSCRIPT == 'forum') {
			if (in_array($_GET['operation'], array('model','vibeui','apps','portal'))) {
				$this->action = 'group';
				return true;
			}elseif ($_G['fid'] != $_Data['buglistfid'] && $_G['forum'] && $_Data['forumextend_fup'][$_G['forum']['fup']]) {
				$this->action = 'forum';
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G,$_Data;
			
		
		require_once libfile('function/forumlist');

		if ($this->action == 'group') {

			$operation = $_GET['operation'];
			define('TopPoint',$operation);

			if (!isset($_Data['forumextend'][$operation]) || !$_Data['forumextend'][$operation]) {
				return;
			}

			//使用缓存
			if(($catlist = discuz_table::fetch_cache(0, 'catlist_'.$operation)) === false){
				$fups = $_Data['forumextend'][$operation];
				$fupsids = join(',',$fups);

				$forums = DB::fetch_all("SELECT * FROM ".DB::table('forum_forum')." WHERE status='1' AND (fup IN ($fupsids) || fid IN ($fupsids) ) AND type IN ('forum','group') ORDER BY displayorder");

				$fids = array();
				foreach($forums as $forum) {
					$fids[$forum['fid']] = $forum['fid'];
				}
				$forum_fields = C::t('forum_forumfield')->fetch_all($fids);

				foreach($forums as $forum) {
					if($forum_fields[$forum['fid']]['fid']) {
						$forum = array_merge($forum, $forum_fields[$forum['fid']]);
					}

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

				foreach($catlist as $catid => $category) {
					$catlist[$catid]['collapseimg'] = 'collapsed_no.gif';
					if($catlist[$catid]['forumscount'] && $category['forumcolumns']) {
						$catlist[$catid]['forumcolwidth'] = (floor(100 / $category['forumcolumns']) - 0.1).'%';
						$catlist[$catid]['endrows'] = '';
						if($colspan = $category['forumscount'] % $category['forumcolumns']) {
							while(($category['forumcolumns'] - $colspan) > 0) {
								$catlist[$catid]['endrows'] .= '<td width="'.$catlist[$catid]['forumcolwidth'].'">&nbsp;</td>';
								$colspan ++;
							}
							$catlist[$catid]['endrows'] .= '</tr>';
						}
					} elseif(empty($category['forumscount'])) {
						unset($catlist[$catid]);
					}
				}
				unset($catid, $category);

				if(isset($catlist[0]) && $catlist[0]['forumscount']) {
					$catlist[0]['fid'] = 0;
					$catlist[0]['type'] = 'group';
					$catlist[0]['name'] = $_G['setting']['bbname'];
					$catlist[0]['collapseimg'] = 'collapsed_no.gif';
				} else {
					unset($catlist[0]);
				}
				discuz_table::store_cache(0, $catlist, 86400 , 'catlist_'.$operation);
			}
			include template('forum/discuz');
			exit;
		}else{
			define('TopPoint',$_Data['forumextend_fup'][$_G['forum']['fup']]);
		}	
	}
}


?>