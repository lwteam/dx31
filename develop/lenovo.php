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
	require_once libfile('function/member');

	if(!$_GET['lenovoid_wust']){
		showmessage('授权失败请重试!','index.php');	
	}

	$content = @file_get_contents('http://uss.lenovomm.com/interserver/authen/1.2/getaccountid?realm=bbs.lenovo.com&lpsust='.$_GET['lenovoid_wust']);

	$xml = simplexml_load_string($content);
	$AccountID = (string)$xml->AccountID;
	$Username = (string)$xml->Username;

	if(!$AccountID){
		showmessage('联想通行证LenovoID授权失败请重试');
	}
	if ($_GET['bind']) {
		DB::insert('common_member_lenovoid', array('uid'=>$member['uid'],'lenovoid'=>$AccountID,'dateline'=>TIMESTAMP));
		showmessage('您的账号和联想通行证已经成功绑定');
	}else{
		$member = DB::fetch_first("SELECT m.*,ml.lenovoid FROM ".DB::table('common_member_lenovoid')." ml
				LEFT JOIN  ".DB::table('common_member')." USING(`uid`)
			WHERE ml.`lenovoid`='{$AccountID}' LIMIT 1");
		if($member && $member['lenovoid'] ){
			//登陆
			setloginstatus($member, 2592000);

			C::t('common_member_status')->update($_G['uid'], array('lastip' => $_G['clientip'], 'port' => $_G['remoteport'], 'lastvisit' =>TIMESTAMP, 'lastactivity' => TIMESTAMP));
			$ucsynlogin = $this->setting['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';

			$param = array(
				'username' => $_G['member']['username'],
				'usergroup' => $_G['group']['grouptitle'],
				'uid' => $_G['member']['uid'],
				'groupid' => $_G['groupid'],
				'syn' => $ucsynlogin ? 1 : 0
			);

			$extra = array(
				'showdialog' => true,
				'locationtime' => true,
				'extrajs' => $ucsynlogin
			);
			showmessage($loginmessage, $location, $param, $extra);
			
		}else{


			$username = $email = '';

			do {
				$uid = uc_user_register(addslashes($username), $password, $email, '', '', $_G['clientip']);
			} while ($uid > 0);


			$password = md5(random(10));
			$secques = $questionid > 0 ? random(8) : '';


			if($setregip !== null) {
				if($setregip == 1) {
					C::t('common_regip')->update_count_by_ip($_G['clientip']);
				} else {
					C::t('common_regip')->insert(array('ip' => $_G['clientip'], 'count' => 1, 'dateline' => $_G['timestamp']));
				}
			}

			$groupinfo = array();
			if($this->setting['regverify']) {
				$groupinfo['groupid'] = 8;
			} else {
				$groupinfo['groupid'] = $this->setting['newusergroupid'];
			}		

			$emailstatus = 1;

			$init_arr = array('credits' => explode(',', $this->setting['initcredits']), 'profile'=>$profile, 'emailstatus' => $emailstatus);

			C::t('common_member')->insert($uid, $username, $password, $email, $_G['clientip'], $groupinfo['groupid'], $init_arr);
			if($emailstatus) {
				updatecreditbyaction('realemail', $uid);
			}


			require_once libfile('cache/userstats', 'function');
			build_cache_userstats();


			if($this->setting['regctrl'] || $this->setting['regfloodctrl']) {
				C::t('common_regip')->delete_by_dateline($_G['timestamp']-($this->setting['regctrl'] > 72 ? $this->setting['regctrl'] : 72)*3600);
				if($this->setting['regctrl']) {
					C::t('common_regip')->insert(array('ip' => $_G['clientip'], 'count' => -1, 'dateline' => $_G['timestamp']));
				}
			}

			setloginstatus(array(
				'uid' => $uid,
				'username' => $_G['username'],
				'password' => $password,
				'groupid' => $groupinfo['groupid'],
			), 0);
			include_once libfile('function/stat');
			updatestat('register');


			if($welcomemsg && !empty($welcomemsgtxt)) {
				$welcomemsgtitle = replacesitevar($welcomemsgtitle);
				$welcomemsgtxt = replacesitevar($welcomemsgtxt);
				if($welcomemsg == 1) {
					$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
					notification_add($uid, 'system', $welcomemsgtxt, array('from_id' => 0, 'from_idtype' => 'welcomemsg'), 1);
				} elseif($welcomemsg == 2) {
					sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
				} elseif($welcomemsg == 3) {
					sendmail_cron($email, $welcomemsgtitle, $welcomemsgtxt);
					$welcomemsgtxt = nl2br(str_replace(':', '&#58;', $welcomemsgtxt));
					notification_add($uid, 'system', $welcomemsgtxt, array('from_id' => 0, 'from_idtype' => 'welcomemsg'), 1);
				}
			}


			dsetcookie('loginuser', '');
			dsetcookie('activationauth', '');
			dsetcookie('invite_auth', '');

			$url_forward = dreferer();
			$refreshtime = 3000;

			$message = 'register_succeed';
			$locationmessage = 'register_succeed_location';


			$param = array('bbname' => $this->setting['bbname'], 'username' => $_G['username'], 'usergroup' => $_G['group']['grouptitle'], 'uid' => $_G['uid']);
			if(strpos($url_forward, $this->setting['regname']) !== false || strpos($url_forward, 'buyinvitecode') !== false) {
				$url_forward = 'forum.php';
			}
			$href = str_replace("'", "\'", $url_forward);
			$extra = array(
				'showid' => 'succeedmessage',
				'extrajs' => '<script type="text/javascript">'.
					'setTimeout("window.location.href =\''.$href.'\';", '.$refreshtime.');'.
					'$(\'succeedmessage_href\').href = \''.$href.'\';'.
					'$(\'main_message\').style.display = \'none\';'.
					'$(\'main_succeed\').style.display = \'\';'.
					'$(\'succeedlocation\').innerHTML = \''.lang('message', $locationmessage).'\';'.
				'</script>',
				'striptags' => false,
			);
			showmessage($message, $url_forward, $param, $extra);


			DB::insert('common_member_accountchange', array('uid'=>$member['uid'],'username'=>$member['username'],'email'=>$member['email']));

		}
	}



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