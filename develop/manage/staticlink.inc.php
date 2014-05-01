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
loadcache('staticlink');
$staticlink = & $_G['cache']['staticlink'];
$staticlink = $staticlink?$staticlink:array();
$partforumslist = array();


$query = DB::query('SELECT f.fid,f.fup,f.type,f.name, ff.description FROM '.DB::table('forum_forum').' f LEFT JOIN '.DB::table('forum_forumfield')." ff ON f.fid = ff.fid WHERE f.status IN (0,1) ORDER BY f.type ASC, displayorder DESC");
while($forum = DB::fetch($query)) {
	if($staticlink[$forum['fid']]['staticname']){
		$forum['staticname'] = $staticlink[$forum['fid']]['staticname'];
	}
	if($forum['type'] == 'group' ){
		$partforumslist[$forum['fid']] = $forum;
	}elseif($forum['type'] == 'forum'){
		$partforumslist[$forum['fup']]['subforums'][$forum['fid']] = $forum;
	}else{
		$upforum = $forumslist[$forum['fup']];
		$partforumslist[$upforum['fup']]['subforums'][$upforum['fid']]['subforums'][$forum['fid']] = $forum;
	}
	$forumslist[$forum['fid']] = $forum;
}


if($_POST){
	$forumstatic = $_G['gp_forumstatic'];
	$forumstatic['staticname'] = strtolower(preg_replace('/[^0-9a-zA-Z\-]+/is','',$forumstatic['staticname']));
	if(!$forumstatic['staticname']){
		UNSET($staticlink[$forumstatic['fid']]);
	}else{
		$staticlink[$forumstatic['fid']] = $forumslist[$forumstatic['fid']];
		$staticlink[$forumstatic['fid']]['staticname'] = $forumstatic['staticname'];
	}
	save_syscache('staticlink',$staticlink);
	StaticLinkBuild();
	showmessage('成功更新边栏信息', 'manage.php?action='.$action);
}else{
	$forumstatic = $forumslist[$_G['gp_id']];
}

?>