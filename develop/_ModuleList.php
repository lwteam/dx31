<?php

!defined('BIGQI') && exit('BIGQI Dis-Access');



//静态rewrite
ModuleAdd('staticlink/output');
//修改内容返回列表记忆
ModuleAdd('staticlink_forumdisplay_extra/core');
//修正帖子移动
ModuleAdd('staticlink_viewthread_location/hooks');
//修改跳转功能
ModuleAdd('staticlink_showmessage/dheader/output');
ModuleAdd('staticlink_showmessage/showmessage/output');


ModuleAdd('PublicCore/core');

if(defined('CURSCRIPT') && in_array(CURSCRIPT,array('home','forum'))){
	//ModuleAdd('Checkin/hooks');
}


if(defined('CURSCRIPT') && CURSCRIPT == 'forum'){
	ModuleAdd('ArticleScript/hooks');
	ModuleAdd('ForumExtendScript/hooks');
	ModuleAdd('BugListScript/hooks');   // BUGlist
	ModuleAdd('BugListScript/showmessage/output');
}
if(defined('CURSCRIPT') && CURSCRIPT == 'home'){
	ModuleAdd('HomeSpacecpExtend/hooks');
}

		
if(constant('CURSCRIPT') == 'member' &&  $_GET['mod'] == 'logging' && $_GET['action'] == 'logout'){

	ModuleAdd('LenovoMemberLogout/hooks');
}


ModuleAdd('BugListScript/hookscript');



?>