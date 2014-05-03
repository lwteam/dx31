<?php


if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();


ini_set('memory_limit','12800M');

$hwarray = array(
	'2.1'=>'11',
	'2.2'=>'1',
	'2.3'=>'15',
	'3.1'=>'6',
	'3.2'=>'5',
	'3.3'=>'7',
	'3.4'=>'3',
	'3.5'=>'9',
	'3.6'=>'14',
	'3.7'=>'16',
	'3.8'=>'12',
	'3.9'=>'13',
	'4.1'=>'8',
	'5.1'=>'17'
);
$verarray = array(
	'2.1'=>'11',
	'2.2'=>'1',
	'2.3'=>'15',
	'3.1'=>'6',
	'3.2'=>'5',
	'3.3'=>'7',
	'3.4'=>'3',
	'3.5'=>'9',
	'3.6'=>'14',
	'3.7'=>'16',
	'3.8'=>'12',
	'3.9'=>'13',
	'4.1'=>'8',
	'5.1'=>'17'
);

$ProcessNum  = 5000;
$page = (int)$_REQUEST['page'];
$totalnum = (int)$_REQUEST['totalnum'];
$starttime = (int)$_REQUEST['starttime'];
if (!$starttime) {
	$starttime = $_G['timestamp'];
}


if ($page<2) {
	foreach ($postcleartables  as  $value) {
		DB::query("TRUNCATE TABLE ".DB::table($value));
	}
	$totalnum = DB::result_first("SELECT count(*)  FROM convert_lefen.".DB::table('forum_thread')." WHERE fid IN (".join(',',$opfids).") ORDER BY tid asc");
	$page = 1;
}

if(@ceil($totalnum/$ProcessNum) < $page){
	$page = 1;
}


$offset = ($page - 1) * $ProcessNum;

$query = DB::query("SELECT * FROM convert_lefen.".DB::table('forum_thread')." WHERE fid IN (".join(',',$opfids).") ORDER BY tid ASC LIMIT $offset,$ProcessNum");
while($thread = DB::fetch($query)) {
	if (!DB::fetch_first("SELECT *  FROM ".DB::table('forum_thread')." WHERE tid='$thread[tid]'")) {
		threadconvert::lenovothread($thread['tid']);
	}
	
}
if($totalnum <= $ProcessNum*$page){
	
	showmnextpage('乐粉主题帖子数据已经转换完毕! 将进行乐Phone.CC主题数据转换');
}

showmnextpage("乐粉主题帖子数据正在转换中...".loadingdata(),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'page='.($page+1).'&totalnum='.$totalnum.'&starttime='.$starttime,0);


?>