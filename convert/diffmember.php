<?php


if (php_sapi_name() == 'cli') {
	chdir(dirname(__FILE__));
}

chdir('../');

require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();

require 'function.php';


$memberfields = array('uid', 'email', 'username', 'password', 'status', 'emailstatus', 'avatarstatus', 'videophotostatus', 'groupid',  'regdate',   'timeoffset',);
$membeructables = array('ucenter_members', 'ucenter_memberfields');
$membercleartables = array('ucenter_members', 'ucenter_memberfields','common_member','common_member_lenovoid','common_member_accountchange','common_member_lephoneuid');
/**
* 
*/


class memberconvert 
{

	function lenovomember($uid){
		global $membeructables,$memberfields;
		$insert = $insertlen = array();
		$member = DB::fetch_first("SELECT m.*,mp.field1,mp.field2  FROM convert_lefen.`pre_common_member` m 
			LEFT JOIN convert_lefen.`pre_common_member_profile` mp USING(uid) WHERE m.`uid`='$uid'" );

			
		if ($member) {
			foreach ($memberfields as  $value) {

				$insert[$value] = $member[$value];
			}
			$insert['adminid'] = '0';
			$insert['groupid'] = '10';
			$insert['allowadmincp'] = '0';
			$insert['groupid'] = '10';
			

			foreach ($membeructables as  $value) {
				DB::query("insert into ".DB::table($value)." select * from convert_lefen.".DB::table($value)." where uid ='$uid'");
			}
		}

		$insertlen['uid'] = $member['uid'];
		$insertlen['lenovoid'] = $member['field1'];
		DB::insert('common_member', $insert);
		DB::insert('common_member_accountchange', array('uid'=>$member['uid'],'username'=>$member['username'],'email'=>$member['email']));
		if ($member['field1']) {
			if (!DB::result_first("SELECT *  FROM ".DB::table('common_member_lenovoid')." WHERE lenovoid='$insertlen[lenovoid]'")) {
				DB::insert('common_member_lenovoid', $insertlen);
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
	$totalnum = DB::result_first("SELECT count(*) FROM convert_lefen.".DB::table('common_member')." cm
		LEFT JOIN ".DB::table('common_member')." m USING(`uid`) WHERE m.uid is null");
	$page = 1;
}

if(@ceil($totalnum/$ProcessNum) < $page){
	$page = 1;
}



$offset = ($page - 1) * $ProcessNum;


$query = DB::query("SELECT cm.* FROM convert_lefen.".DB::table('common_member')." cm
left join ".DB::table('common_member')." m USING(`uid`) WHERE m.uid is null ORDER BY cm.uid ASC LIMIT $offset,$ProcessNum");
while($user = DB::fetch($query)) {
	if (!DB::fetch_first("SELECT *  FROM ".DB::table('common_member')." WHERE uid='$user[uid]'")) {
		memberconvert::lenovomember($user['uid']);
	}
}
if($totalnum <= $ProcessNum*$page){
	showmnextpage('乐粉会员DIFF数据已经转换完毕! 将进行DIFF主题数据数据转换!','diffthread.php');
}
showmnextpage("乐粉会员DIFF数据正在转换中...".loadingdata(),'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.'page='.($page+1).'&totalnum='.$totalnum.'&starttime='.$starttime,0);

/*




 DELETE FROM `pre_ucenter_members` 			WHERE `uid`>1031836 AND `uid`<1081836 ;
 DELETE FROM `pre_ucenter_memberfields` 	WHERE `uid`>1031836 AND `uid`<1081836 ;
 DELETE FROM `pre_common_member` 			WHERE `uid`>1031836 AND `uid`<1081836 ;
 DELETE FROM `pre_common_member_lenovoid` 	WHERE `uid`>1031836 AND `uid`<1081836 ;
 DELETE FROM `pre_common_member_accountchange`	WHERE `uid`>1031836 AND `uid`<1081836 ;




*/
?>