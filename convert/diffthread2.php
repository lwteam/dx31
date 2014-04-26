<?php


if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require 'function.php';

$posttables = array('forum_thread','forum_attachment','forum_attachment_0','forum_attachment_1','forum_attachment_2','forum_attachment_3','forum_attachment_4','forum_attachment_5','forum_attachment_6','forum_attachment_7','forum_attachment_8','forum_attachment_9','forum_poll','forum_polloption','forum_polloption_image','forum_pollvoter','forum_post','forum_post_location','forum_postcomment','forum_postlog','forum_poststick');


$postcleartables = array('forum_thread_lephonetid','forum_post_tableid','forum_thread','forum_post','forum_attachment','forum_attachment_0','forum_attachment_1','forum_attachment_2','forum_attachment_3','forum_attachment_4','forum_attachment_5','forum_attachment_6','forum_attachment_7','forum_attachment_8','forum_attachment_9','forum_poll','forum_polloption','forum_polloption_image','forum_pollvoter','forum_post','forum_post_location','forum_postcomment','forum_postlog','forum_poststick');


$convertfups = array(255,665);
$convertlefids = array(85,87,67,71,4,13);

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




$bugfid = 730;



$tableSameArray = array();

//比较两个表获得两2个表中相同的部分
foreach ($posttables as $table) {
	$TempAry1 = $TempAry2 = array();
	$query = DB::query("desc ".DB::table($table));
	while($value = DB::fetch($query)) {
		$TempAry1[] = $value['Field'];
	}
	$query = DB::query("desc convert_lefen.".DB::table($table));
	while($value = DB::fetch($query)) {
		$TempAry2[] = $value['Field'];
	}
	$tableSameArray[$table] = array_intersect($TempAry1,$TempAry2);
}


class threadconvert 
{
	function lenovothread($tid){
		global $tableSameArray,$posttables;
		$insert = $insertlen = array();
					
		foreach ($posttables as  $table) {
			DB::query("insert into ".DB::table($table)." (".join(',',$tableSameArray[$table]).") select ".join(',',$tableSameArray[$table])." from convert_lefen.".DB::table($table)." where tid ='$tid'");
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
	$totalnum = DB::result_first("SELECT count(*) FROM convert_lefen.".DB::table('forum_thread')." ct
		left join ".DB::table('forum_thread')." t USING(`tid`) WHERE t.tid is null AND ct.fid IN (".join(',',$opfids).")");
	$page = 1;

	echo'<pre> Tnum';
var_dump( ("SELECT count(*) FROM convert_lefen.".DB::table('forum_thread')." ct
		left join ".DB::table('forum_thread')." t USING(`tid`) WHERE t.tid is null AND ct.fid IN (".join(',',$opfids).")") );
echo'</pre>';
}

if(@ceil($totalnum/$ProcessNum) < $page){
	$page = 1;
}


$offset = ($page - 1) * $ProcessNum;


echo'<pre> Stid';
var_dump(  $thread[tid] );
echo'</pre>';
$query = DB::query("SELECT ct.* FROM convert_lefen.".DB::table('forum_thread')." ct
		left join ".DB::table('forum_thread')." t USING(`tid`) WHERE t.tid is null AND ct.fid IN (".join(',',$opfids).") ORDER BY ct.tid ASC LIMIT $offset,$ProcessNum");
while($thread = DB::fetch($query)) {
	
}
echo'<pre>Etid';
var_dump( $thread[tid] );
echo'</pre>';exit;
	

/*


 DELETE FROM `pre_forum_thread` WHERE `tid`>166496 AND `tid`<216497 ;
  DELETE FROM `pre_forum_post` 	WHERE  `tid`>166496 AND `tid`<216497 ;
 DELETE FROM `pre_forum_post` 	WHERE `pid`>2583945 AND `pid`<2633945 ;









*/
?>