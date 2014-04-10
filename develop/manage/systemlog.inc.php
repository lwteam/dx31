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

$operation = $_REQUEST['operation']?$_REQUEST['operation']:'list'; 


$page = $_G['page'];
$pagenum = $_G['tpp'];



if($operation == 'clear'){
	$dateline = $_G['timestamp']- 5356800;
	DB::query("DELETE FROM ".DB::table('manage_log')." WHERE `dateline`<'$dateline'");

	showmessage('二个月之外的平台操作日志已经清理完毕', "manage.php?action=$action");
}else{

	if ($_GET['search']) {
		$sqlwhere = " WHERE `request`  LIKE '%$_GET[search]%'";
	}
	$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('manage_log').$sqlwhere);
	if(@ceil($TotalNum/$pagenum) < $page){
		$page = 1;
	}
	$offset = ($page - 1) * $pagenum;

	$query = DB::query("SELECT * FROM ".DB::table('manage_log').$sqlwhere." ORDER BY `dateline` DESC LIMIT $offset,$pagenum");
	while($value = DB::fetch($query)) {
		if ($_GET['search']) {
			$value['request'] = str_replace($_GET['search'], '<font color="red">'.$_GET['search'].'</font>', $value['request']);
		}
		$systemlogs[] = $value;
	}
	$multipage = multi($TotalNum, $pagenum, $page, "manage.php?action=$action&operation=".$operation, $_G['setting']['threadmaxpages']);	
}



?>