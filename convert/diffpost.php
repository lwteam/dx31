<?php


if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require 'function.php';

$posttables = array('forum_thread','forum_post','forum_attachment','forum_attachment_0','forum_attachment_1','forum_attachment_2','forum_attachment_3','forum_attachment_4','forum_attachment_5','forum_attachment_6','forum_attachment_7','forum_attachment_8','forum_attachment_9');

$convertfups = array(255,665);

$fupfids = join(',',$convertfups);


$query = DB::query("SELECT f.* FROM convert_lefen.".DB::table('forum_forum')." f 
	WHERE f.status='1' AND (f.fup IN ($fupfids) || f.fid IN ($fupfids) ) AND f.type IN ('forum','group') ");

while($forum = DB::fetch($query)) {
	$opfids[] = $forum['fid'];
	if ($forum['type'] == 'forum') {
		$suball =  DB::fetch_all("SELECT f.* FROM convert_lefen.".DB::table('forum_forum')." f 
				WHERE f.status='1' AND f.fup='$forum[fid]'  AND f.type ='sub';");
		if ($suball) {
			foreach ($suball as $value) {
				$opfids[] = $value['fid'];
			}
		}
	}
}

//比较两个表获得两2个表中相同的部分
foreach ($posttables as $table) {
	$TempAry1 = $TempAry2 = array();
	$query = DB::query("desc ".DB::table($table));
	while($value = DB::fetch($query)) {
		$TempAry1[$value['Field']] = $value['Field'];
	}
	$query = DB::query("desc convert_lefen.".DB::table($table));
	while($value = DB::fetch($query)) {
		$TempAry2[$value['Field']] = $value['Field'];
	}
	$tableSameArray[$table] = array_intersect($TempAry1,$TempAry2);
}



class threadconvert 
{
	function diffpost($pid){
		global $tableSameArray;

		$ccpost = $uidtouids = array();
		//获取老帖子
		$post = DB::fetch_first("SELECT * FROM convert_lefen.".DB::table('forum_post')." WHERE `pid`='$pid'" );

			

		$tableid = dintval($post['tid']{strlen($post['tid'])-1});

		DB::insert('forum_post', $post);


		if ($post['attachment']) {
			$tabstatus =  DB::fetch_first("SHOW TABLE STATUS where name='pre_forum_attachment';");
			$newaid= $tabstatus['Auto_increment'];
			$query = DB::query("SELECT * FROM convert_lefen.".DB::table('forum_attachment')." WHERE `tid`='$post[tid]' AND `pid`='$post[pid]'  ORDER BY aid");
			while($attach = DB::fetch($query)) {


				$ccattach = array();
				foreach ($tableSameArray['forum_attachment'] as $value) {
					if ($value == 'aid') {
						$ccattach[$value] = $newaid;
					}else{
						$ccattach[$value] = $attach[$value];
					}
				}


				$attach_num = DB::fetch_first("SELECT * FROM convert_lefen.".DB::table('forum_attachment_'.$attach['tableid'])." WHERE `aid`='$attach[aid]'" );
				$ccattach = array();


				foreach ($tableSameArray['forum_attachment_'.$attach['tableid']] as $value) {
					if ($value == 'aid') {
						$ccattach[$value] = $newaid;
					}else{
						$ccattach[$value] = $attach_num[$value];
					}
				}

					

				DB::insert('forum_attachment_'.$tableid, $ccattach);
				DB::query("UPDATE ".DB::table('forum_post')." SET `message` = replace(message, '[attach]{$attach['aid']}[/attach]', '[attach]{$newaid}[/attach]') WHERE `tid`='$post[tid]' AND `pid`='$post[pid]' ;");
				$newaid++;		
			}
		}
	}

}


ini_set('memory_limit','12800M');



$ProcessNum  = 5000;
$page = (int)$_REQUEST['page'];
$totalnum = (int)$_REQUEST['totalnum'];
$starttime = (int)$_REQUEST['starttime'];
if (!$starttime) {
	$starttime = $_G['timestamp'];
}
	

if ($page<2) {

	$totalnum = DB::result_first("SELECT count(*)  FROM convert_lefen.".DB::table('forum_post')."  WHERE fid IN (".join(',',$opfids).") ");
	$page = 1;

}

if(@ceil($totalnum/$ProcessNum) < $page){
	$page = 1;
}

$offset = ($page - 1) * $ProcessNum;
	
$query = DB::query("SELECT * FROM convert_lefen.".DB::table('forum_post')." WHERE fid IN (".join(',',$opfids).")   ORDER BY pid DESC LIMIT $offset,$ProcessNum");
while($post = DB::fetch($query)) {
	if (!DB::fetch_first("SELECT *  FROM ".DB::table('forum_post')." WHERE pid='$post[pid]'")) {
		threadconvert::diffpost($post['pid']);
	}
}
if($totalnum <= $ProcessNum*$page){
	showmnextpage('乐粉帖子DIFF数据已经转换完毕!');
}
showmnextpage("乐粉帖子DIFF数据正在转换中...".loadingdata(),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'page='.($page+1).'&totalnum='.$totalnum.'&starttime='.$starttime,1000);

/*


	DELETE FROM `pre_forum_thread_lephonepid`;
 DELETE FROM `pre_forum_post` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_0` WHERE `tid`>=166495;

 DELETE FROM `pre_forum_attachment_1` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_2` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_3` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_4` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_5` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_6` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_7` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_8` WHERE `tid`>=166495;
 DELETE FROM `pre_forum_attachment_9` WHERE `tid`>=166495;

*/
?>