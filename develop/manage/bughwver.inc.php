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
require_once _Data('hwver');

$id = (int)$_GET['id'];
$operation = $_GET['operation']?$_GET['operation']:'list'; 

if($operation == 'delete'){
	
	//删除硬件
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('buglist_hardware')." WHERE `uid`='$id' LIMIT 1");
	if($DeleteOne){
		if (!isMyHW($DeleteOne['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		DB::query("DELETE FROM ".DB::table('buglist_hardware')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}
}elseif($operation == 'vdelete'){
	//删除版本
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('buglist_version')." WHERE `uid`='$id' LIMIT 1");
	if($DeleteOne){
		if (!isMyVER($DeleteOne['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		DB::query("DELETE FROM ".DB::table('buglist_version')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}	
}elseif($operation == 'adelete'){
	//删除版本
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('buglist_bugattr')." WHERE `uid`='$id' LIMIT 1");
	if($DeleteOne){
		if (!isMyATT($DeleteOne['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		DB::query("DELETE FROM ".DB::table('buglist_bugattr')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}	
}elseif($operation == 'update'){
	//post 硬件
	$loadtemplate = 'bughwver_update';
	if (!$myPermission['hardware']) {
		showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
	}
	if($id){
		//编辑
		$bughwver_One = DB::fetch_first("SELECT * FROM ".DB::table('buglist_hardware')." WHERE `id`='$id' LIMIT 1");
		if(!$bughwver_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){


		$bughwver = $_POST['bughwver'];
		if(!$bughwver['title'] || !$bughwver['type']){
			showmessage('输入项有部分没有被设置', 'manage.php?action='.$action);
		}
		if (!isMyHW($bughwver['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		if(!$id){
			$bughwver['dateline'] = $_G['timestamp'];
			DB::insert('buglist_hardware', $bughwver);
			showmessage('信息已经添加', 'manage.php?action='.$action);
		}else{
			foreach($bughwver as $key => $value){
				$bughwver_One[$key] = $value;
			}
			unset($bughwver_One['id']);
	
			DB::update('buglist_hardware', $bughwver_One, "`id`='$id'");
			showmessage('信息已经成功编辑', 'manage.php?action='.$action);
		}	
	}
	//添加
}elseif($operation == 'vupdate'){
	//post  版本
	$loadtemplate = 'bughwver_vupdate';
	if (!$myPermission['version']) {
		showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
	}
	if($id){
		//编辑
		$bughwver_One = DB::fetch_first("SELECT * FROM ".DB::table('buglist_version')." WHERE `id`='$id' LIMIT 1");
		if(!$bughwver_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$bughwver = $_POST['bughwver'];
		if(!$bughwver['title'] || !$bughwver['type']){
			showmessage('输入项有部分没有被设置', 'manage.php?action='.$action);
		}
		if (!isMyVER($bughwver['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		if(!$id){
			$bughwver['dateline'] = $_G['timestamp'];
			DB::insert('buglist_version', $bughwver);
			showmessage('信息已经添加', 'manage.php?action='.$action);
		}else{
			foreach($bughwver as $key => $value){
				$bughwver_One[$key] = $value;
			}
			unset($bughwver_One['id']);
	
			DB::update('buglist_version', $bughwver_One, "`id`='$id'");
			showmessage('信息已经成功编辑', 'manage.php?action='.$action);
		}	
	}
	//添加
}elseif($operation == 'aupdate'){
	//post  版本
	$loadtemplate = 'bughwver_aupdate';
	if (!$myPermission['bugattr']) {
		showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
	}
	if($id){
		//编辑
		$bughwver_One = DB::fetch_first("SELECT * FROM ".DB::table('buglist_bugattr')." WHERE `id`='$id' LIMIT 1");
		if(!$bughwver_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$bughwver = $_POST['bughwver'];
		if(!$bughwver['title'] || !$bughwver['type']){
			showmessage('输入项有部分没有被设置', 'manage.php?action='.$action);
		}
		if (!isMyATT($bughwver['type'])) {
			showmessage('您没权限执行该操作!', 'manage.php?action='.$action);
		}
		if(!$id){
			$bughwver['dateline'] = $_G['timestamp'];
			DB::insert('buglist_bugattr', $bughwver);
			showmessage('信息已经添加', 'manage.php?action='.$action);
		}else{
			foreach($bughwver as $key => $value){
				$bughwver_One[$key] = $value;
			}
			unset($bughwver_One['id']);
	
			DB::update('buglist_bugattr', $bughwver_One, "`id`='$id'");
			showmessage('信息已经成功编辑', 'manage.php?action='.$action);
		}	
	}
	//添加
}else{
	$loadtemplate = 'bughwver_list';
	if ($myPermission['hardware']) {
		$query = DB::query("SELECT * FROM ".DB::table('buglist_hardware')." WHERE type IN (".join(',',$myPermission['hardware']).") ORDER BY `id` DESC");
		while($value = DB::fetch($query)) {
			$bughwlist[] = $value;
		}
	}

	if ($myPermission['version']) {
		$query = DB::query("SELECT * FROM ".DB::table('buglist_version')." WHERE type ='$myPermission[version]' ORDER BY `id` DESC");
		while($value = DB::fetch($query)) {
			$bugverlist[] = $value;
		}
	}

	if ($myPermission['bugattr']) {
		$query = DB::query("SELECT * FROM ".DB::table('buglist_bugattr')." WHERE type ='$myPermission[bugattr]' ORDER BY `id` DESC");
		while($value = DB::fetch($query)) {
			$bugattrlist[] = $value;
		}
	}


}



?>
