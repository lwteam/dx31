<?php

!defined('BIGQI') && exit('BIGQI Dis-Access');



//��̬rewrite
ModuleAdd('staticlink/output');
//�޸����ݷ����б����
ModuleAdd('staticlink_forumdisplay_extra/core');
//���������ƶ�
ModuleAdd('staticlink_viewthread_location/template');
//�޸���ת����
ModuleAdd('staticlink_showmessage/dheader/output');
ModuleAdd('staticlink_showmessage/showmessage/output');


ModuleAdd('PublicCore/core');

if(defined('CURSCRIPT') && in_array(CURSCRIPT,array('home','forum'))){
	ModuleAdd('Checkin/hooks');
}


if(defined('CURSCRIPT') && CURSCRIPT == 'forum'){
	ModuleAdd('ArticleScript/hooks');
	ModuleAdd('ForumExtendScript/hooks');
	ModuleAdd('BugListScript/hooks');   // BUGlist
	ModuleAdd('BugListScript/showmessage/output');
}
if(defined('CURSCRIPT') && CURSCRIPT == 'home' && $_GET['ac']=='plugin' &&  in_array($_GET['opdo'], array('accountchange','lenovoid'))){
	ModuleAdd('HomeSpacecpExtend/hooks');
}


?>