<?php

if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();



ini_set('memory_limit','12800M');


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

	if (false && !$echo) {
		echo'<pre>';
		var_dump( $attach['aid'],$attach['tableid'],$attach['tid'],$echo,$_G['path'],$_G['oldpath'] );
		echo'</pre>';exit;
	}


}
if($totalnum <= $ProcessNum*$page){
	showmnextpage('附件数据整理完毕!');
}
showmnextpage("附件数据正在整理中.....".loadingdata(),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'page='.($page+1).'&totalnum='.$totalnum.'&starttime='.$starttime,0);



function mv_attach($aid,$tableid) {
	global $_G;
	$attach= DB::fetch_first("SELECT * FROM ".DB::table('forum_attachment_'.$tableid)." WHERE `aid`='$aid'" );

	

	if (stripos($attach['attachment'], 'lephonecc/') === false) {
		$oldpath  = str_replace ( '\\', '/',  LEFEN_OLD.$attach['attachment'] );
		$path  = str_replace ( '\\', '/',  ATTACHPATH.$attach['attachment'] );
	}else{
		$oldpath  = str_replace ( '\\', '/',  LEPHONE_OLD.str_replace('lephonecc/', '', $attach['attachment']) );
		$path  = str_replace ( '\\', '/',  ATTACHPATH.'lephonecc/'.$attach['attachment'] );
	}
	

	nmkdir($path);
	if (file_exists($oldpath.'.thumb.jpg')) {
		@copy($oldpath.'.thumb.jpg',$path.'.thumb.jpg');
	}
	$_G['oldpath'] = $oldpath;
	$_G['path'] = $path;
	return copy($oldpath,$path);
}



?>