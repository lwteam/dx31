<?php

!defined('BIGQI') && exit('BIGQI Dis-Access');



//��̬rewrite
ModuleAdd('staticlink/output');
//�޸����ݷ����б����
ModuleAdd('staticlink_forumdisplay_extra/core');
//���������ƶ�
if ($_GET['haierspi']) {
	ModuleAdd('staticlink_viewthread_location/template');
}
if ($_GET['haierspi']==1) {
	exit('staticlink_showmessagedheader');
}

//
//�޸���ת����
ModuleAdd('staticlink_showmessage/dheader/output');
if ($_GET['haierspi']==2) {
	exit('staticlink_showmessageshowmessage');
}

ModuleAdd('staticlink_showmessage/showmessage/output');

if ($_GET['haierspi']==3) {
	exit('PublicCore');
}

ModuleAdd('PublicCore/core');

if(defined('CURSCRIPT') && in_array(CURSCRIPT,array('home','forum'))){
	//ModuleAdd('Checkin/hooks');
}
if ($_GET['haierspi']==4) {
	exit('ArticleScript');
}

if(defined('CURSCRIPT') && CURSCRIPT == 'forum'){
	ModuleAdd('ArticleScript/hooks');
	ModuleAdd('ForumExtendScript/hooks');
	ModuleAdd('BugListScript/hooks');   // BUGlist
	ModuleAdd('BugListScript/showmessage/output');
}
if ($_GET['haierspi']==5) {
	exit('HomeSpacecpExtend');
}

if(defined('CURSCRIPT') && CURSCRIPT == 'home'){
	ModuleAdd('HomeSpacecpExtend/hooks');
}

ModuleAdd('BugListScript/hookscript');



?>