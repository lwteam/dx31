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
require_once libfile('function/forumlist');
require_once _Data('buglist');
require_once _Data('hwver');


$query = DB::query("SELECT bu.*,bm.hnum,bm.num FROM ".DB::table('buglist_user')." bu 
						LEFT JOIN ".DB::table('buglist_mstatus')." bm USING(`uid`) 
				WHERE bu.`distuid` = '1'");
while($value = DB::fetch($query)) {
	$teamstatistics[] = $value;
}



?>