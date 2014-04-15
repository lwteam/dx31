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
$operation = $_REQUEST['operation']?$_REQUEST['operation']:'list'; 
$page = $_G['page'];
$pagenum = $_G['tpp'];


if($operation == 'delete'){
	//删除
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('bughwver')." WHERE `id`='$id' LIMIT 1");
	if($DeleteOne){
		DB::query("DELETE FROM ".DB::table('bughwver')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}
	

}elseif($operation == 'update'){
	$loadtemplate = 'bughwver_update';
	if($id){
		//编辑
		$bughwver_One = DB::fetch_first("SELECT * FROM ".DB::table('bughwver')." WHERE `id`='$id' LIMIT 1");
		if(!$bughwver_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$bughwver = $_POST['bughwver'];
		if(!$id){
			if($bughwver['name']){
				DB::insert('bughwver', $bughwver);
			}
			showmessage('信息已经添加', 'manage.php?action='.$action);
		}else{
			if($bughwver['name']){
				foreach($bughwver as $key => $value){
					$bughwver_One[$key] = $value;
				}
				unset($bughwver_One['id']);
		
				DB::update('bughwver', $bughwver_One, "`id`='$id'");
			}
			showmessage('信息已经成功编辑', 'manage.php?action='.$action);
		}	

	}
	//添加
}else{
	$loadtemplate = 'bughwver_list';


	if ($_GET['search']) {
		$sqlwhere = " WHERE `title`  LIKE '%$_GET[search]%'";
	}
	$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('bughwver').$sqlwhere);
	if(@ceil($TotalNum/$pagenum) < $page){
		$page = 1;
	}
	$offset = ($page - 1) * $pagenum;

	$query = DB::query("SELECT * FROM ".DB::table('bughwver').$sqlwhere." ORDER BY `id` DESC LIMIT $offset,$pagenum");
	while($value = DB::fetch($query)) {
		$value['tagtxts'] = join(',',array_filter(explode(',',$value['tagtxts'])));
		$bughwverlist[] = $value;
	}
	$multipage = multi($TotalNum, $pagenum, $page, "manage.php?action=$action&operation=".$operation, $_G['setting']['threadmaxpages']);	



}



?>
