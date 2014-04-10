<?php






function systemlog(){
	global $_G,$action;
	$insert = array();
	$insert['uid']		= $_G['uid'];
	$insert['username']	= $_G['username'];
	$insert['dateline'] = $_G['timestamp'];
	$insert['action']	= $action;
	$insert['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$insert['method']	= $_POST?'post':'get';
	$insert['request']	= array();
	$insert['request']['get']	= $_GET;
	$insert['request']['post']	= $_POST;
	$insert['request'] = serialize($insert['request']);

	DB::insert('manage_log', $insert);
}



function PermissionLine($myPermission){
	$myPermission['distuidtxt'] = (substr($myPermission['distuid'], 0, 1) == ','?"$myPermission[distuid]":",{$myPermission['distuid']},")."{$myPermission['uid']},";
	$myPermission['distusernametxt'] = (substr($myPermission['distusername'], 0, 1) == ','?"$myPermission[distusername]":",{$myPermission['distusername']},")."{$myPermission['username']},";
	return $myPermission;
}

function MyCompletion($myPermission){
	$buglist_user = DB::fetch_first("SELECT * FROM ".DB::table('buglist_user')." WHERE `uid`='$myPermission[uid]' LIMIT 1");
	foreach ($buglist_user as $key => $value) {
		if (in_array($key, array('dist','istuid'))) {
			continue;
		}
		$myPermission[$key] =  $value;
	}
	return $myPermission;
}






function BugWorkPerm($myPermission,$onebuglist,$handling = NULL){

	$ishave = FALSE;

	if($onebuglist['handling'] == 0){
		//新提交
		if($handling == 0 || $handling == 1 || $handling == 4 || $handling === NULL ){
			// 查看权限
			if (in_array($myPermission['dist'], array(1,3,4))) {
				$ishave = TRUE;
			}
		}
	}elseif($onebuglist['handling'] == 1){

		//待解决

		if($handling == 1 || $handling == 2 || $handling == 3 || $handling === NULL ){
			// 查看权限
			if (in_array($myPermission['dist'], array(2))) {
				$ishave = TRUE;
			}
		}


	}elseif($onebuglist['handling']== 2){
		//正在解决
		if($handling == 2 || $handling == 3 || $handling === NULL ){
			// 查看权限
			if (in_array($myPermission['dist'], array(2)) && $onebuglist['douid']==$myPermission['uid']) {
				$ishave = TRUE;
			}
		}
	}elseif($onebuglist['handling'] == 3){
		//已经解决
		if($handling == 3 || $handling == 4 || $handling === NULL ){
			//
			if (in_array($myPermission['dist'], array(1,3,4)) && $onebuglist['touid']==$myPermission['uid']) {
				$ishave = TRUE;
			}
		}

	}elseif($onebuglist['handling'] == 4){

	}

	return $ishave;
}

function BugClassSelect($id,$limitid = 0 ) {
	global $_Data;
	$html = '';
	foreach($_Data['buglist'] as $key=>$value){
		if($limitid){
			$len = strlen($limitid);
			if(substr($key, 0, $len) != $limitid){
				continue;
			}
		}
		$subtext= $key>=10?'&nbsp|-&nbsp':'';
		$html .= '<option value="'.$key.'"'.($key==$id?' selected':'').'>'.$subtext.$value.'</option>';
	}
	return $html;
}

function BugClassSelectSql($id,$filed='b.`classid`') {
	global $_Data;
	$sql = '';
	$IdAs = array();
	foreach($_Data['buglist'] as $key=>$value){
		$len = strlen($id);
		if(substr($key, 0, $len) != $id){
			continue;
		}
		$IdAs[] = $key;
	}
	if ($IdAs) {
		$sql = "$filed in (".JOIN(',',$IdAs).')';

	}

	return $sql;
}


function HWClassSelect($array,$limitid = NULL ) {
	global $_Data;
	$html = '';
	foreach($_Data['hardware'] as $key=>$value){
		if($limitid !== NULL){
			if(!in_array($key, $limitid)){
				continue;
			}
		}
		$html .= '<input type="checkbox" name="Permission[hardware][]" value="'.$key.'"'.(in_array($key,$array)?' checked="ture"':'').'>'.$value.'&nbsp;';
	}
	return $html;
}


function isMyHW($id ) {
	global $myPermission;
	return in_array($id,$myPermission['hardware'])?TRUE:FALSE;
}

function isMyVER($id ) {
	global $myPermission;
	return $id== $myPermission['version']?TRUE:FALSE;
}

function isMyATT($id ) {
	global $myPermission;
	return $id== $myPermission['bugattr']?TRUE:FALSE;
}

function VERClassSelect($id,$limitid = NULL ) {
	global $_Data;
	$html = '';
	$html .= '<input type="radio" name="Permission[version]" value="0"'.(!$id?' checked="ture"':'').'> 无 &nbsp;';
	foreach($_Data['version'] as $key=>$value){
		if($limitid !== NULL){
			if($key!=$limitid){
				continue;
			}
		}
		$html .= '<input type="radio" name="Permission[version]" value="'.$key.'"'.(($key==$id)?' checked="ture"':'').'>'.$value.'&nbsp;';
	}
	return $html;
}

function ATTClassSelect($id,$limitid = NULL ) {
	global $_Data;
	$html = '';
	$html .= '<input type="radio" name="Permission[bugattr]" value="0"'.(!$id?' checked="ture"':'').'> 无 &nbsp;';
	foreach($_Data['bugattr'] as $key=>$value){
		if($limitid !== NULL){
			if($key!=$limitid){
				continue;
			}
		}
		$html .= '<input type="radio" name="Permission[bugattr]" value="'.$key.'"'.(($key==$id)?' checked="ture"':'').'>'.$value.'&nbsp;';
	}
	return $html;
}




function ManagePostdataSafe(&$data) {
	if(is_array($data)){
		foreach($data as $key=>$value){
			if($key === 'url'){
				if(substr($value, 0, 7) != 'http://') {
					$data[$key] = 'http://'.$value;
				}
			}
			ManagePostdataSafe($data[$key]);
		}
	}else{
		htmlspecialchars($data);
	}
}

function slidefocusXMLBuild($data) {
	global $_G;

	if(!$_G['cache']['slidefocuslist']){
		loadcache('slidefocuslist');
	}
	$slidefocuslist = $_G['cache']['slidefocuslist'];

	$string =  '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
	$string .= "<list>\r\n";

	foreach($slidefocuslist as $value){
		$string .= "\t<item><img>{$value[pic]}</img><url>{$value[url]}</url></item>\r\n";
	}
	$string .=  "</list>";

	$fp = fopen(DISCUZ_ROOT."data/cache/slidefocus.xml", "w");
	fwrite($fp,$string);
	fclose($fp);
}


function ActivitysTopBuild() {
	global $_G;
	if(!$_G['cache']['indexdatacache']){
		loadcache('indexdatacache');
	}
	
	$query = DB::query("SELECT * FROM ".DB::table('iasys_activity')." WHERE `top`='1' ORDER BY `order` DESC");
	while($value = DB::fetch($query)) {
		$activitys[$value['id']] = $value;
	}
	$_G['cache']['indexdatacache']['activitys'] = $activitys;
	save_syscache('indexdatacache',$_G['cache']['indexdatacache']);

}
function ActivitysTidShow($tid) {
	global $InteractiveSystem;
	DB::query("UPDATE ".DB::table('iasys_activity')." SET tid='0' WHERE  tid='{$tid}'");
	$threadstatus = DB::fetch_first("SELECT ts.expand  FROM ".DB::table('iasys_threadstatus')." ts  WHERE ts.tid='$tid' AND ts.pid='0'" );
	$expand = unserialize($threadstatus['expand']);
	$expand['activity'] = true;
	$expand_ser = serialize($expand);
	$InteractiveSystem->ChangeThreadStatus( array('expand'=>$expand_ser),$tid,NULL);
}



function IndexRecommendThreadsBuild() {
	global $_G;

	loadcache('indexdatacache');
	$indexdatacache = & $_G['cache']['indexdatacache'];

	if($lenews){
		$indexnewsLimit = 10;
	}else{
		$indexnewsLimit = 14;
	}

	$query = DB::query("SELECT c.tid, c.subject,c.author,c.authorid FROM ".DB::table('forum_threadmod')." tm
	LEFT JOIN ".DB::table('forum_forumrecommend')." c ON tm.tid = c.tid
	LEFT JOIN ".DB::table('common_member')." m ON c.moderatorid = m.uid
	WHERE tm.action = 'REC' AND tm.status = '1'
			AND m.groupid = '1' AND (tm.expiration = '0' OR tm.expiration > '".$_G['timestamp']."')
				ORDER by tm.dateline DESC LIMIT $indexnewsLimit");
				//AND c.fid NOT IN (26,17,23,37,38)
	while($thread = DB::fetch($query)) {
		$thread['subject'] = cutstr($thread['subject'],50,' ...');
		$recommendthreads[] = $thread;
	}
	$indexdatacache['recommendthreads'] = $recommendthreads;
	save_syscache('indexdatacache',$indexdatacache);
}

function StaticLinkBuild() {
	global $_G;

	loadcache('staticlink');
	$staticlink = & $_G['cache']['staticlink'];
	if(is_array($staticlink) && $staticlink){

		foreach($staticlink as $key=>$value){
			$rewritearray[$value['staticname']] = array('fid'=>$key,'type'=>$value['type']);
			$forumsnarray[$key] =$value['staticname'];
		}

		$string = "<?php\n!defined('BIGQI') && exit('Dis-Access');\n\t//BQ! Setting Cache File ! \n\t//Created: " . date ( "Y-m-d", $_G['timestamp'] ) . "\n";
		$string .= "\n\$rewritearray  = ";
		$string .= var_export ( $rewritearray, true ).';';
		$string .= "\n\n\$forumsnarray  = ";
		$string .= var_export ( $forumsnarray, true ).';';
		$string .= "\n?>";

		$fp = @fopen ( DISCUZ_ROOT."./data/cache/cache_forums_rewrite.php", 'w' );
		@fputs ( $fp, $string );
		@fclose ( $fp );
	}
}
?>