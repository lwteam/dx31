<?php

chdir('../');
$_SERVER['SCRIPT_NAME'] = 'manage.php';
define('CURSCRIPT', 'manage');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();


$act = $_REQUEST['act']?$_REQUEST['act']:'goto'; 


if ($act == 'goto') {
	header('Location: http://passport.lenovo.com/wauthen/login?lenovoid.action=uilogin&lenovoid.realm=dr.lenovomm.com&lenovoid.uinfo=username&lenovoid.cb='.urlencode('http://bbs.lenovo.com/lenovo.php?act=callback'));
	exit();	
}elseif ($act == 'callback') {

	if(!$_GET['lenovoid_wust']){
		showmsg('授权失败请重试!','index.php');	
	}

	$content = @file_get_contents('http://uss.lenovomm.com/interserver/authen/1.2/getaccountid?realm=dr.lenovomm.com&lpsust='.$_GET['lenovoid_wust']);

	$xml = simplexml_load_string($content);
	$AccountID = (string)$xml->AccountID;
	$Username = (string)$xml->Username;

	if(!$AccountID){
		showmsg('授权失败请重试!','index.php');	
	}

	
	$user = DB::fetch_first("SELECT * FROM ".DB::table('common_member_lenovoid')." WHERE `lenovoid`='{$AccountID}' LIMIT 1");

	if($user){
		//登陆
	}else{
		//注册
	}
}


?>