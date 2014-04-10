<?php

/*
+----------------------------------------------
| [Bigqi.com] ---->
| Item Name	: filename
+----------------------------------------------
| File	: common.inc.php 2012-08-23
| Author: Haierspi ...
+----------------------------------------------
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
require_once BIGQI_MS_ROOT.'./_Module/MenuBuild.class.php';

MenuBuild::Build();

showmessage('首页应用缓存已经更新', 'manage.php?action=manage');
?>