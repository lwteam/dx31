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
require_once libfile('function/forumlist');
require_once _Data('buglist');
require_once _Data('hwver');

$id = (int)$_GET['id'];
$operation = $_GET['operation']?$_GET['operation']:'list'; 

if($myPermission['dist']!=1){
	showmessage('您不是产品经理不能管理Team权限!', 'javascript:history.go(-1);');
}
$myPermission = PermissionLine($myPermission);




if($operation == 'delete'){
	//删除
	$Permission = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$_GET[id]}' LIMIT 1");

	if($Permission && !preg_match("/^$myPermission[distuidtxt]/i", $Permission['distuid'])){
		showmessage('您没有权限管理该用户,请确认后操作!', 'manage.php?action=team');
	}

	DB::query("DELETE FROM ".DB::table('manage_user')." WHERE `uid`='{$Permission[uid]}' LIMIT 1");
	DB::query("DELETE FROM ".DB::table('buglist_user')." WHERE `uid`='{$Permission[uid]}' LIMIT 1");

	showmessage('系统权限已经更新', 'manage.php?action=team');

}elseif($operation == 'update'){
	$loadtemplate = 'team_update';

	$teamname = DB::result_first("SELECT team FROM ".DB::table('buglist_user')." WHERE `uid`='$_G[uid]' LIMIT 1");


	if($id){
		//编辑
		$Permission_One = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$id}' LIMIT 1");
		if($Permission_One){
			$Permission_One['permission'] = $Permission_One['permission']?unserialize($Permission_One['permission']):array();
			$Permission_One['hardware'] = $Permission_One['hardware']?unserialize($Permission_One['hardware']):array();
		}else{
			showmessage('权限系统中没有查询到该用户,无法完成操作!', 'manage.php?action=manage');
		}
	}
	$forumselect = forumselect(FALSE, 0, $myPermission['forum'], TRUE);
	$BugClassSelect = BugClassSelect($Permission_One['buglist'],$myPermission['buglist']);
	$HWClassSelect = HWClassSelect($Permission_One['hardware'],$myPermission['hardware']);
	$VERClassSelect = VERClassSelect($Permission_One['version'],$myPermission['version']);
	$ATTClassSelect = ATTClassSelect($Permission_One['bugattr'],$myPermission['bugattr']);

		
	if($_POST){
	
		$Permission = $_POST['Permission'];
		$Permission['username'] = trim($Permission['username']);
		if(empty($Permission['username'])){
			showmessage('请输入账户名', 'manage.php?action=team');
		}
		$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE `username`='{$Permission[username]}' LIMIT 1");
		if(!$member){
			showmessage('用户不存在', 'manage.php?action=team');
		}else{
			$manage_user = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$member[uid]}' LIMIT 1");
			if(!$id){
				if($manage_user){
					showmessage('权限系统中已经存在该用户,无法完成操作!', 'manage.php?action=team');
				}
			}
			//判断存在 存在的话判断权限线是否为自己的下游
			if($manage_user && !preg_match("/^$myPermission[distuidtxt]/i", $manage_user['distuid'])){
				showmessage('您没有权限管理该用户,请确认后操作!', 'manage.php?action=team');
			}
			//判断是否有模块权限
			foreach($Permission['permission'] as $value){
				if(!in_array($value,$myPermission['permission'])){
					showmessage("您没有权限添加 $manageitem_array[$value] 权限,请确认后操作!", 'manage.php?action=team');
				}
			}
			if($Permission['buglist']){
				$buglistlen = strlen($myPermission['buglist']);
				if(substr( $Permission['buglist'], 0, $buglistlen) != $myPermission['buglist']){
					showmessage('添加的反馈分类超出您的权限范围,请确认后操作!', 'manage.php?action=team');
				}
			}
			if($Permission['hardware']){
				foreach($Permission['hardware'] as $value){
					if(!in_array( $value, $myPermission['hardware'])){
						showmessage('添加的硬件分类超出您的权限范围,请确认后操作!', 'manage.php?action=team');
					}
				}
			}
			if($Permission['version']){
				if($Permission['version'] !=  $myPermission['version']){
					showmessage('添加的版本分类超出您的权限范围,请确认后操作!', 'manage.php?action=team');
				}
			}
			if($Permission['bugattr']){
				if($Permission['bugattr'] !=  $myPermission['bugattr']){
					showmessage('添加的反馈属性类别超出您的权限范围,请确认后操作!', 'manage.php?action=team');
				}
			}
			// 用户级别
			$Permission['dist'] = in_array($Permission['dist'] ,array(2,3))?$Permission['dist']:2;
			if($Permission['dist'] && !in_array('userinfo',$Permission['permission'])){
				$Permission['permission'][]='userinfo';
			}
			$permission_ser = serialize($Permission['permission']);
			
			$filed = $filedvalue = '';
			if(!$SPermission){
				$filed = "`dateline`,";
				$filedvalue = "'$_G[timestamp]',";
			}else{
				$filed = "`dateline`,";
				$filedvalue = "'$manage_user[dateline]',";
			}

			if(!$id){
				$distuidtxt = (substr($myPermission['distuid'], 0, 1) == ','?"$myPermission[distuid]":",")."{$myPermission['uid']},";
				$distusernametxt = (substr($myPermission['distusername'], 0, 1) == ','?"$myPermission[distusername]":",")."{$myPermission['username']},";
				$filed .= "`distuid`, `distusername`,";
				$filedvalue .= "'$distuidtxt', '$distusernametxt',";
			}else{
				$filed .= "`distuid`, `distusername`,";
				$filedvalue .= "'$manage_user[distuid]', '$manage_user[distusername]',";
			}

			$Permission_hardware = serialize($Permission['hardware']);

			//更新权限到数据库
			DB::query("REPLACE INTO ".DB::table('manage_user')." 
				(`uid`, `username`,`name`, $filed `permission`, `dist`,  `buglist`, `forum`, `hardware`,`version`,`bugattr`) VALUES 
				('$member[uid]', '$member[username]','$Permission[name]', $filedvalue '$permission_ser', '$Permission[dist]',  '$Permission[buglist]', '$Permission[forum]', '$Permission_hardware', '$Permission[version]', '$Permission[bugattr]')");


			$buguser = DB::fetch_first("SELECT * FROM ".DB::table('buglist_user')." WHERE `uid`='{$member[uid]}' LIMIT 1");

			if($Permission['dist']>0){
				if(!$buguser){
					DB::query("INSERT INTO  ".DB::table('buglist_user')."  
					(`uid`, `username`, `dateline`, `name`, `team`, `dist`, `distuid`) VALUES  
					('$member[uid]', '$member[username]', '$_G[timestamp]', '$Permission[name]','$teamname', '$Permission[dist]', '{$myPermission[uid]}')");
				}else{
					DB::query("UPDATE  ".DB::table('buglist_user')."  SET `name`='$Permission[name]',`dist`='$Permission[dist]' WHERE (`uid`='$member[uid]')");
				}
			}elseif($buguser){
				DB::query("DELETE FROM ".DB::table('buglist_user')." WHERE `uid`='{$member[uid]}' LIMIT 1");
			}

			showmessage('系统权限已经更新', 'manage.php?action=team');
		}
	}

	//添加
}else{
	$loadtemplate = 'team_list';
	$query = DB::query("SELECT bu.*,mu.permission FROM ".DB::table('buglist_user')." bu 
							LEFT JOIN ".DB::table('manage_user')." mu USING(`uid`) 
					WHERE bu.`distuid` = '$myPermission[uid]'  ORDER BY bu.`dateline` DESC");
	while($value = DB::fetch($query)) {
		$permission = unserialize($value['permission']);
		if($permission){
			foreach($permission as $k=>$value2){
				$permission[$k] = $manageitem_array[$value2];
			}
			$value['permissiontxt'] = join(', ',$permission);
		}
		
		$Permissionlist[] = $value;
	}
}



?>