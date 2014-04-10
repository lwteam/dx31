<?php

chdir('../');
$_SERVER['SCRIPT_NAME'] = 'manage.php';
define('CURSCRIPT', 'manage');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();



if($_G['adminid']== 1 && $_G['groupid'] == '1'){
	$manageRoot = True;
}else{
	$manageRoot = false;
}

if($_G['setting']['forumadmin']){
	if(!$_G['setting']['forumadmin_unserialize']){
		$_G['setting']['forumadmin'] = array_filter(unserialize($_G['setting']['forumadmin']));
		$_G['setting']['forumadmin_unserialize'] = 1;
	}
}

$manageitem_array = array(
	"indexarticle"=>"首页推荐",
	"topicfocus"=>"头图管理",
	"indextag"=>"文章标签",
	
	"userinfo"=>"个人信息维护",
	"diyforum"=>"版块自定义",
	"buglist"=>"用户反馈",
	"bughwver"=>"反馈属性检索管理",
	
	"product"=>	"版块产品更新",
	"team"=>"Team权限管理",
	
	"teamdata"=>"团队数据统计",
	"teamlog"=>"tuandui 操作记录",

	"staticlink"=>"平台URL管理",
	"manage"=>"平台权限分配",
	"systemlog"=>"平台操作记录",
	"clearcache"=>"更新平台缓存",
);

// 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

if(!$_G['uid']){
	showmessage('需要登陆才能访问信息管理页面', 'member.php?mod=logging&action=login');
}
$myPermission = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$_G[uid]}' LIMIT 1");
$myPermission['permission'] = $myPermission['permission']?unserialize($myPermission['permission']):array();
$myPermission['hardware'] = $myPermission['hardware']?unserialize($myPermission['hardware']):array();


if($myPermission['dist'] == -1){
	$myPermission['permission'] = array_keys($manageitem_array);
	$action = current($manageitem_array);
}
$action = $_GET['action']?$_GET['action']:current($myPermission['permission']);


if($myPermission['permission'] && in_array($action,$myPermission['permission'])){
	
}else{
	showmessage('对不起您没有权限访问该管理页面','javascript:history.go(-1);');
}



$myaccessmenu = $myPermission['permission'];



$navigation = '<em>&raquo;</em> <a href="manage.php">信息管理平台</a> <em>&raquo;</em>'.$manageitem_array[$action];

$loadtemplate = $action;



require DISCUZ_ROOT.'./develop/Categorys.php';
require DISCUZ_ROOT.'./develop/manage/function.php';
systemlog();
include DISCUZ_ROOT.'./develop/manage/'.$action.'.inc.php';





include template($loadtemplate, 0, './develop/manage/template');

?>