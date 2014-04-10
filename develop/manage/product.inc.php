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



loadcache('product');
$product = & $_G['cache']['product'];
if($_POST){
	$product = $_POST['product'];
	save_syscache('product',$product);
	showmessage('成功更新信息', 'manage.php?action='.$action);
}

?>