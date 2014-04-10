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


$id = (int)$_GET['id'];
$operation = $_GET['operation']?$_GET['operation']:'list'; 

if($operation == 'delete'){
	//删除
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('buglist_hardware')." WHERE `uid`='$id' LIMIT 1");
	if($DeleteOne){
		DB::query("DELETE FROM ".DB::table('buglist_hardware')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}
	

}elseif($operation == 'update'){
	$loadtemplate = 'bughwver_update';
	if($id){
		//编辑
		$bughwver_One = DB::fetch_first("SELECT * FROM ".DB::table('buglist_hardware')." WHERE `uid`='$id' LIMIT 1");
		if(!$bughwver_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$bughwver = $_POST['bughwver'];
		if(!$id){
			if($bughwver['name']){
				DB::insert('buglist_hardware', $bughwver);
			}
			showmessage('信息已经添加', 'manage.php?action='.$action);
		}else{
			if($bughwver['name']){
				foreach($bughwver as $key => $value){
					$bughwver_One[$key] = $value;
				}
				unset($bughwver_One['id']);
		
				DB::update('buglist_hardware', $bughwver_One, "`id`='$id'");
			}
			showmessage('信息已经成功编辑', 'manage.php?action='.$action);
		}	

	}
	//添加
}else{
	$loadtemplate = 'bughwver_list';
	$query = DB::query("SELECT * FROM ".DB::table('buglist_hardware')." ORDER BY `id` DESC");
	while($value = DB::fetch($query)) {
		$value['relatename'] = join(',',array_filter(explode(',',$value['relatename'])));
		$bughwverlist[] = $value;
	}

}



?>
