<?php

chdir('../');
$_SERVER['SCRIPT_NAME'] = 'manage.php';
define('CURSCRIPT', 'manage');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();


$act = $_REQUEST['act']?$_REQUEST['act']:'goto'; 


if ($act == 'auth') {
	header('Location: http://passport.lenovo.com/wauthen/login?lenovoid.action=uilogin&lenovoid.realm=bbs.lenovo.com&lenovoid.uinfo=username&lenovoid.cb='.urlencode('http://bbs.lenovo.com/lenovo.php?act=callback'));
	exit();	
}elseif ($act == 'callback') {


}elseif ($act == 'binding') {
	if(empty($_G['uid'])) {
		showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
	}
	$user = DB::fetch_first("SELECT * FROM ".DB::table('common_member_lenovoid')." WHERE `uid`='$_G[uid]' LIMIT 1");
	if($user || $user['lenovoid']) {
		showmessage('您的账号和联想通行证已经绑定过了,如需绑定其他联想通行证请先解除现有的绑定关系!');
	}else{
		header('Location: http://passport.lenovo.com/wauthen/login?lenovoid.action=uilogin&lenovoid.realm=dr.lenovomm.com&lenovoid.uinfo=username&lenovoid.cb='.urlencode('http://bbs.lenovo.com/lenovo.php?act=callback&bind=1'));
		exit();
	}

}elseif ($act == 'unbinding') {
	if(empty($_G['uid'])) {
		showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
	}
	$user = DB::fetch_first("SELECT * FROM ".DB::table('common_member_lenovoid')." WHERE `uid`='$_G[uid]' LIMIT 1");
	
	if(!$user || !$user['lenovoid']) {
		showmessage('您没有绑定过联想通行证,无法进行解绑操作!');
	}else{
		DB::query("DELETE FROM ".DB::table('common_member_lenovoid')." WHERE `uid`='$_G[uid]' LIMIT 1");
		showmessage('您的账号和联想通行证之间的绑定关系已经解除!');
	}
}


?>