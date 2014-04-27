<?php

if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require 'function.php';

ini_set('memory_limit','12800M');


define('LEFEN_OLD', DISCUZ_ROOT.'convert/lefen/data/attachment/forum/');

define('LEPHONE_OLD', DISCUZ_ROOT.'convert/lephone/data/attachment/forum/');

define('ATTACHPATH', DISCUZ_ROOT.'data/attachment/forum/');


$ProcessNum  = 500;
$page = (int)$_REQUEST['page'];
$totalnum = (int)$_REQUEST['totalnum'];
$starttime = (int)$_REQUEST['starttime'];
if (!$starttime) {
	$starttime = $_G['timestamp'];
}



if ($page<2) {
	$totalnum = DB::result_first("SELECT count(*)  FROM ".DB::table('forum_attachment'));
	$page = 1;

}

if(@ceil($totalnum/$ProcessNum) < $page){
	$page = 1;
}


$offset = ($page - 1) * $ProcessNum;

$query = DB::query("SELECT * FROM ".DB::table('forum_attachment')."  ORDER BY aid ASC LIMIT $offset,$ProcessNum");
while($attach = DB::fetch($query)) {
	$echo =mv_attach($attach['aid'],$attach['tableid']);

	if (!$echo) {
		echo'<pre>';
		var_dump( $attach['tid'],$echo,$_G['path'],$_G['oldpath'] );
		echo'</pre>';exit;
	}


}
if($totalnum <= $ProcessNum*$page){
	showmnextpage('附件数据整理完毕!');
}
showmnextpage("附件数据正在整理中.....".loadingdata(),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'page='.($page+1).'&totalnum='.$totalnum.'&starttime='.$starttime,0);






?>