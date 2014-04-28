<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');


class HomeSpacecpExtend {
	public $returns;
	public $action;
	public function action($point) {
		$this->actionStorage = $GLOBALS['_ModuleActionStorage'];
		$this->point = $point;


		if ( constant('CURSCRIPT') == 'home' && $_GET['ac']=='profile' && $_GET['op']=='password' ) {
			$this->action = 'password';
			return true;
		}elseif ( constant('CURSCRIPT') == 'home' && $_GET['ac']=='plugin' ) {
			$this->action = 'plugin';
			return true;
		}else{
			return false;
		}


	}
	public function execute() {
		global $_G,$actives;

		if(empty($_G['uid'])) {
			showmessage('to_login', '', array(), array('showmsg' => true, 'login' => 1));
		}

		$MyAcc = DB::fetch_first("SELECT *  FROM ".DB::table('common_member_accountchange')." WHERE uid='$_G[uid]'" );

		if ($this->action ==  'password') {
			if ($MyAcc && !$MyAcc['rename'] ) {
				showmessage('您的账号是老用户移植过来的,需要您重新更新资料,<br>稍后为您跳转到 <b>修改我的账号</b> 面板','home.php?mod=spacecp&ac=plugin&opdo=accountchange');
			}
			
		}elseif ($this->action ==  'plugin') {

			loaducenter();

			if ($_GET['opdo']=='accountchange') {
				include_once libfile('function/member');
				$actives['accountchange'] = $actives['plugin'] =' class="a"';
				$pluginkey = $_GET['id'] = 'nothing';
				$_G['setting']['plugins']['nothing']['nothing']['name'] = '修改我的账号';

				

				if (!$MyAcc) {
					showmessage('您的账号不需要修改');
				}elseif ( $MyAcc['rename']) {
					showmessage('您的账号已经修改过一次了,不能再修改了');
				}
				if ($_POST) {
					$newusername = dhtmlspecialchars( strtolower(trim($_POST['newusername'])));

					
					$newemail = dhtmlspecialchars( strtolower(trim($_POST['newemail'])));

					$newpassword = $_POST['newpassword'];
					$newconfirmpassword = $_POST['newconfirmpassword'];

					if (!$newpassword || !$newconfirmpassword  ) {
						showmessage("新密码和确认新密码内容不能为空,请重新输入");
					}
					if ($newpassword != $newconfirmpassword) {
						showmessage("您输入的新密码和确认新密码不一致,请重新输入");
					}

					$newemail = strtolower(trim($newemail));
					if(strlen($newemail) > 32) {
						showmessage('profile_email_illegal', '', array(), array('handle' => false));
					}
					if($_G['setting']['regmaildomain']) {
						$maildomainexp = '/('.str_replace("\r\n", '|', preg_quote(trim($_G['setting']['maildomainlist']), '/')).')$/i';
						if($_G['setting']['regmaildomain'] == 1 && !preg_match($maildomainexp, $newemail)) {
							showmessage('profile_email_domain_illegal', '', array(), array('handle' => false));
						} elseif($_G['setting']['regmaildomain'] == 2 && preg_match($maildomainexp, $newemail)) {
							showmessage('profile_email_domain_illegal', '', array(), array('handle' => false));
						}
					}
					$ucemailmember = DB::fetch_first("SELECT * FROM ".DB::table('ucenter_members')." WHERE `email`='$newemail' LIMIT 1");

					if ($ucemailmember && $ucemailmember['uid']!=$_G['uid']) {
						showmessage('profile_email_duplicate', '', array(), array('handle' => false));
					}



					$usernamelen = dstrlen($newusername);
						
					if($usernamelen < 3) {
						showmessage('profile_username_tooshort');
					} elseif($usernamelen > 15) {
						showmessage('profile_username_toolong');
					}

					if($m = C::t('common_member')->fetch_uid_by_username($newusername)) {
						
						if ($m != $_G['uid'] ) {
							showmessage('您输入的新用户名已经被注册,请更换一个后重新提交','javascript:history.go(-1);',array(),array('alert'=>'error'));
						}
						
					}

					$membernew = array('username'=>$newusername,'email'=>$newemail);
					$ucmembernew = $membernew;
					$ucmembernew['salt'] = random(6);
					$ucmembernew['password'] = md5(md5($newpassword).$ucmembernew['salt']);


					
					DB::update('ucenter_members', $ucmembernew, "`uid`='$_G[uid]'");
					DB::update('common_member', $membernew, "`uid`='$_G[uid]'");
					DB::update('common_member_accountchange', array('rename'=>'1'), "`uid`='$_G[uid]'");

					showmessage('您的账号信息已经成功修改','home.php?mod=spacecp',array(),array('alert'=>'right'));
				}else{
					
					//showmessage('您输入的信息不完整,请重新输入','javascript:history.go(-1);',array(),array('alert'=>'right'));
				}
				
				include template('home/spacecp_accountchange');
				exit;
			}elseif ($_GET['opdo']=='lenovoid') {

				if ($MyAcc && !$MyAcc['rename'] ) {
					showmessage('您的账号需要重新更新资料后才能管理联想通行证,<br>稍后为您跳转到 <b>修改我的账号</b> 面板','home.php?mod=spacecp&ac=plugin&opdo=accountchange');
				}


				$user = DB::fetch_first("SELECT * FROM ".DB::table('common_member_lenovoid')." WHERE `uid`='$_G[uid]' LIMIT 1");
			

				$actives['lenovoid'] = $actives['plugin'] =' class="a"';
				$pluginkey = $_GET['id'] = 'nothing';

				$_G['setting']['plugins']['nothing']['nothing']['name'] = '联想通行证';

				include template('home/spacecp_lenovoid');
				exit;
			}
		}
	}
}

?>