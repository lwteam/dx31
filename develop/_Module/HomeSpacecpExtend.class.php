<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');


class HomeSpacecpExtend {
	public $returns;
	public function action($point) {
		$this->actionStorage = $GLOBALS['_ModuleActionStorage'];
		$this->point = $point;

		if ( constant('CURSCRIPT') == 'home' && $_GET['ac']=='plugin' ) {
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

		if ($_GET['opdo']=='accountchange') {
			include_once libfile('function/member');
			$actives['accountchange'] = $actives['plugin'] =' class="a"';
			$pluginkey = $_GET['id'] = 'nothing';
			$_G['setting']['plugins']['nothing']['nothing']['name'] = '修改我的账号';

			$MyAcc = DB::fetch_first("SELECT *  FROM ".DB::table('common_member_accountchange')." WHERE uid='$_G[uid]'" );

			if (!$MyAcc) {
				showmessage('您的账号不需要修改');
			}elseif ( $MyAcc['rename']) {
				showmessage('您的账号已经修改过一次了,不能再修改了');
			}
			if ($_POST) {
				$newusername = dhtmlspecialchars( strtolower(trim($_POST['newusername'])));

				
				$newemail = dhtmlspecialchars( strtolower(trim($_POST['newemail'])));

				checkemail($newemail);

				$usernamelen = dstrlen($newusername);
					
				if($usernamelen < 3) {
					showmessage('profile_username_tooshort');
				} elseif($usernamelen > 15) {
					showmessage('profile_username_toolong');
				}

				if(C::t('common_member')->fetch_uid_by_username($newusername)) {
					showmessage('您输入的新用户名已经被注册,请更换一个后重新提交','javascript:history.go(-1);',array(),array('alert'=>'right'));
				}

				$membernew = array('username'=>$newusername,'email'=>$newemail);
				DB::update('ucenter_members', $membernew, "`uid`='$_G[uid]'");
				DB::update('common_member', $membernew, "`uid`='$_G[uid]'");
				DB::update('common_member_accountchange', array('rename'=>'1'), "`uid`='$_G[uid]'");

				showmessage('您的账号信息已经成功修改','home.php?mod=spacecp',array(),array('alert'=>'right'));
			}else{
				
				//showmessage('您输入的信息不完整,请重新输入','javascript:history.go(-1);',array(),array('alert'=>'right'));
			}
			
			

		


			include template('home/spacecp_accountchange');
			exit;
		}elseif ($_GET['opdo']=='lenovoid') {
			$actives['lenovoid'] = $actives['plugin'] =' class="a"';
			$pluginkey = $_GET['id'] = 'nothing';

			$_G['setting']['plugins']['nothing']['nothing']['name'] = '联想通行证';

			include template('home/spacecp_lenovoid');
			exit;
		}

			

	}
}

?>