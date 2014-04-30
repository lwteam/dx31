<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');


class PublicCore {
	public function action($point) {
		return true;
	}
	public function execute() {
		global $_G,$myPermission;
		$myPermission = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$_G[uid]}' LIMIT 1");
		$myPermission['permission'] = $myPermission['permission']?unserialize($myPermission['permission']):array();
		$myPermission['hardware'] = $myPermission['hardware']?unserialize($myPermission['hardware']):array();

		$_G['setting']['pluginhooks']['register_logging_method'] = $_G['setting']['pluginhooks']['logging_method'] = '<a href="lenovo.php">联想通行证</a>';
		loadcache('staticlink');

	}
}

?>