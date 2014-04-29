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


if($operation == 'delete'){
	//删除
	$Permission = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$_GET[id]}' LIMIT 1");
	if($Permission){
		DB::query("DELETE FROM ".DB::table('manage_user')." WHERE `uid`='{$Permission[uid]}' LIMIT 1");
	}
	$buguser = DB::fetch_first("SELECT * FROM ".DB::table('buglist_user')." WHERE `uid`='{$Permission[uid]}' LIMIT 1");
	if($buguser){
		DB::query("DELETE FROM ".DB::table('buglist_user')." WHERE `uid`='{$Permission[uid]}' LIMIT 1");
	}


	showmessage('系统权限已经更新', 'manage.php?action=manage');

}elseif($operation == 'update'){
	$loadtemplate = 'manage_update';
	if($id){
		//编辑
		$Permission_One = DB::fetch_first("SELECT mu.*,bu.team FROM ".DB::table('manage_user')." mu LEFT JOIN  ".DB::table('buglist_user')." bu USING(uid)  WHERE mu.`uid`='{$id}' LIMIT 1");
		if($Permission_One){
			$Permission_One['permission'] = $Permission_One['permission']?unserialize($Permission_One['permission']):array();
			$Permission_One['hardware'] = $Permission_One['hardware']?unserialize($Permission_One['hardware']):array();
		}else{
			showmessage('权限系统中没有查询到该用户,无法完成操作!', 'manage.php?action=manage');
		}
			
	}
	$forumselect = forumselect(FALSE, 0, $Permission_One['forum'], TRUE);
	$BugClassSelect = BugClassSelect($Permission_One['buglist']);
	$HWClassSelect = HWClassSelect($Permission_One['hardware']);
	$VERClassSelect = VERClassSelect($Permission_One['version']);
	$ATTClassSelect = ATTClassSelect($Permission_One['bugattr']);
	if($_POST){
	
		$Permission = $_POST['Permission'];
		$Permission['username'] = trim($Permission['username']);
		if(empty($Permission['username'])){
			showmessage('请输入账户名', 'manage.php?action=manage');
		}
		$member = DB::fetch_first("SELECT * FROM ".DB::table('common_member')." WHERE `username`='{$Permission[username]}' LIMIT 1");
		if(!$member){
			showmessage('用户不存在', 'manage.php?action=manage');
		}else{
			$manage_user = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `uid`='{$member[uid]}' LIMIT 1");
			if(!$id){
				if($manage_user){
					showmessage('权限系统中已经存在该用户,无法完成操作!', 'manage.php?action=manage');
				}
			}

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

			
			DB::query("REPLACE INTO ".DB::table('manage_user')." 
				(`uid`, `username`,`name`, $filed `permission`, `dist`,  `buglist`, `forum`, `hardware`,`version`,`bugattr`,`relations`) VALUES 
				('$member[uid]', '$member[username]','$Permission[name]', $filedvalue '$permission_ser', '$Permission[dist]',  '$Permission[buglist]', '$Permission[forum]', '$Permission_hardware', '$Permission[version]', '$Permission[bugattr]', '$Permission[relations]')");


			if($Permission_One['relations']){
				DB::query("DELETE FROM ".DB::table('manage_relations')." WHERE `classid`='$Permission_One[buglist]' LIMIT 1");
			}
			if($Permission['relations']){
				if ($Permission['buglist']) {
					$HWCSV = $Permission['hardware'] ?','.join(',',$Permission['hardware']).',' :'';
					DB::query("REPLACE INTO ".DB::table('manage_relations')." (`classid`, `forum`, `hardware`, `version`, `uid`) VALUES ('$Permission[buglist]', '$Permission[forum]', '$HWCSV', '$Permission[version]', '$member[uid]') ");
				}
			}

			$buguser = DB::fetch_first("SELECT * FROM ".DB::table('buglist_user')." WHERE `uid`='$member[uid]' LIMIT 1");

			if($Permission['dist']>0){
				if(!$buguser){
					DB::query("INSERT INTO  ".DB::table('buglist_user')."  
					(`uid`, `username`, `dateline`, `name`, `team`, `dist`, `distuid`) VALUES  
					('$member[uid]', '$member[username]', '$_G[timestamp]', '$Permission[name]','$Permission[team]', '$Permission[dist]', '$myPermission[uid]')");
				}else{
					DB::query("UPDATE  ".DB::table('buglist_user')."  SET `name`='$Permission[name]',`team`='$Permission[team]' WHERE (`uid`='$member[uid]')");
				}
			}elseif($buguser){
				DB::query("DELETE FROM ".DB::table('buglist_user')." WHERE `uid`='$member[uid]' LIMIT 1");
			}

			showmessage('系统权限已经更新', 'manage.php?action=manage');
		}
	}
	//添加
}else{
	$loadtemplate = 'manage_list';

	$query = DB::query("SELECT mu.*,bu.team FROM ".DB::table('manage_user')." mu
							LEFT JOIN ".DB::table('buglist_user')." bu USING(`uid`) ORDER BY mu.`distuid` DESC");	

	while($value = DB::fetch($query)) {
		$permission = unserialize($value['permission']);
		if($permission){
			foreach($permission as $k=>$value2){
				$permission[$k] = $manageitem_array[$value2];
			}
			$value['permissiontxt'] = join(', ',$permission);
		}
		if($value['dist'] == -1){
			$value['permissiontxt'] = '全部权限';
		}
		if($value['distusername']){
			$value['distusername'] = str_replace(',','>', substr($value['distusername'], 1, -1));
		}
		
		$Permissionlist[] = $value;
	}
}



?>