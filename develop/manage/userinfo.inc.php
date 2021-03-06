<?php
/*
+----------------------------------------------
| [Bigqi.com] ---->
| Item Name	: indexdatacache
+----------------------------------------------
| File	: manage 2012-08-23
| Author: Haierspi ...
+----------------------------------------------
*/
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

$loadtemplate = 'userinfo';
//必须填写的用户POST字段
$FieldsMustComplete = array('itcode'=>1, 'email'=>1, 'phone'=>1, 'title'=>1);



$mydata = DB::fetch_first("SELECT * FROM ".DB::table('buglist_user')." WHERE `uid`='{$myPermission[uid]}' LIMIT 1");

if(!$mydata){
	showmessage('您不需要完善个人信息', 'manage.php');
}

if($_POST){
	$error = '';
	
	$myinfo = $_POST['myinfo'];

		

	foreach($FieldsMustComplete as $key=>$value){
		if($value && !$myinfo[$key]) {
			$error = $key;
			$errormsg = '必填项不能为空';;
		}
	}
	foreach($myinfo as $key => $value){
		if(isset($FieldsMustComplete[$key])){
			$mydata[$key] = trim(htmlspecialchars($value));
		}
	}
	unset($mydata['name'],$mydata['team']);



	if(!$error){
		if( $_FILES['avatar']) {
			//require_once libfile('class/upload');
			$upload = new discuz_upload();
			if($upload->init($_FILES['avatar'], 'forum') && $upload->save()) {
				if($mydata['avatar']){
					@unlink($mydata['avatar']);
				}
				$mydata['avatar'] = $_G['setting']['attachurl'].'forum/'.$upload->attach['attachment'];
				require_once libfile('class/image');
				$image = new image;
				$xx = $image->Thumb(DISCUZ_ROOT.$mydata['avatar'],'forum/'.$upload->attach['attachment'], '100', '100', 2);
			}
		}
		DB::update('buglist_user', $mydata, "`uid`='$mydata[uid]'");
		showmessage('您的信息已经完善', 'manage.php?action='.$action);
	}
		
}

function FieldsCheck($key){
	global  $FieldsMustComplete,$error,$errormsg;
	$html = '';
	$html .= $FieldsMustComplete[$key]?'必填':'选填';
	if($key == $error){
		$html .= '  <font color="red">'.$errormsg.'</font>';
	}
	return $html;
}

?>