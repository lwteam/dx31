<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');

class LenovoMemberLogout {
	public function action($point) {
		if (constant('CURSCRIPT') == 'member' && constant('CURMODULE') == 'logging' && $_GET['action'] == 'logout' && !isset($_GET['fromlenovo']) ) {
			$this->action = 'index';
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G;

		$user = DB::fetch_first("SELECT * FROM ".DB::table('common_member_lenovoid')." WHERE `uid`='$_G[uid]' LIMIT 1");

		if(!$user) {
			return;
		}else{
			header('Location: http://passport.lenovo.com/wauthen/logout?lenovoid.action=uilogout&lenovoid.realm=chita.lps.lenovo.com&lenovoid.uinfo=username&lenovoid.cb='.urlencode('http://'.$_SERVER['HTTP_HOST'].'/member.php?mod=logging&action=logout&fromlenovo=1&action=logout&formhash='.$_GET['formhash']));
			exit();	
		}
	}

}


?>