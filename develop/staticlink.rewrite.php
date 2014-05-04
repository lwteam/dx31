<?php

define('BIGQI', TRUE);
chdir('../');

error_reporting(0);

$position = strpos($_SERVER['SCRIPT_FILENAME'],'develop/');
$_SERVER['SCRIPT_FILENAME'] = substr($_SERVER['SCRIPT_FILENAME'],0,$position).'forum.php';
$_SERVER['SCRIPT_NAME'] = basename($_SERVER['SCRIPT_FILENAME']);

require "data/cache/cache_forums_rewrite.php";


$QUERYSTEP1 = explode('&',$_SERVER['QUERY_STRING']);
$QUERY_STRING = substr($QUERYSTEP1[0],-1) == '/'?substr($QUERYSTEP1[0],0,-1):$QUERYSTEP1[0];


	
$_TP = Array();
$_TP['request'] = $_TP['_GET'] = array();
$_TP['request'] = explode('/',$QUERY_STRING);
$_TP['OQUERY'] = isset($QUERYSTEP1[1])?$QUERYSTEP1[1]:'';



if( isset($_TP['request'][1]) ){

	if(substr($_TP['request'][1],0,1) == 't'){

		$_TP['scriptype'] = 'tid';
		$_TP['threadqs'] = substr($_TP['request'][1],1);

		if(stripos($_TP['threadqs'], '-')){
			$_TP['threadqs_a'] = array();
			$_TP['threadqs_a'] = explode('-',$_TP['threadqs']);

			$_TP['_GET']['tid'] = intval($_TP['threadqs_a'][0]);
			$_TP['_GET']['extra'] = isset($_TP['threadqs_a'][1])?'page='.intval($_TP['threadqs_a'][1]):'';

		}else{
			$_TP['_GET']['tid'] = intval($_TP['threadqs']);
			$_TP['_GET']['extra'] = isset($_TP['threadqs_a'][1])?'page='.intval($_TP['threadqs_a'][1]):'';

		}
		if(isset($_TP['request'][2])){
			$_TP['_GET']['page'] = intval($_TP['request'][2]);
		}
	}else{
		$_TP['scriptype'] = 'fid';
		$_TP['_GET']['page'] = intval($_TP['request'][1]);
	}
}else{
	$_TP['scriptype'] = 'fid';
}


if($_TP['scriptype'] == 'fid'){
	$_TP['forumstr'] = $_TP['request'][0];
	$_TP['forumsinfo'] = $rewritearray[$_TP['forumstr']];
	if($_TP['forumsinfo'] && $_TP['forumsinfo']['type']=='group'){
		$_TP['_GET']['gid']=$_TP['forumsinfo']['fid'];

	}elseif($_TP['forumsinfo'] && $_TP['forumsinfo']['type']=='forum'){
		$_TP['_GET']['fid']=$_TP['forumsinfo']['fid'];
		$_TP['_GET']['mod']='forumdisplay';
	}elseif($_TP['forumsinfo'] && $_TP['forumsinfo']['type']=='sub'){
		$_TP['_GET']['fid']=$_TP['forumsinfo']['fid'];
		$_TP['_GET']['mod']='forumdisplay';
	}
}elseif($_TP['scriptype'] =='tid'){
	$_TP['forumstr'] = $_TP['request'][0];
	if(!isset($rewritearray[$_TP['forumstr']])){
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		$cont404 = file_get_contents('./develop/_Error/404.html');
		exit($cont404);
	}
	$_TP['forumsinfo'] = $rewritearray[$_TP['forumstr']];
	$_TP['_GET']['fid']=$_TP['forumsinfo']['fid'];
	$_TP['_GET']['mod']='viewthread';
}

$QUERY_ARRAY = array();
if ($_TP['_GET']['mod']) {
	$QUERY_ARRAY[] = 'mod='.$_TP['_GET']['mod'];
}
if ($_TP['_GET']['fid']) {
	$QUERY_ARRAY[] = 'fid='.$_TP['_GET']['fid'];
}
if ($_TP['_GET']['tid']) {
	$QUERY_ARRAY[] = 'tid='.$_TP['_GET']['tid'];
}
if ($_TP['_GET']['page']) {
	$QUERY_ARRAY[] = 'page='.$_TP['_GET']['page'];
}
if ($_TP['_GET']['extra']) {
	$QUERY_ARRAY[] = 'extra='.$_TP['_GET']['extra'];
}


$_SERVER['QUERY_STRING'] = join('&',$QUERY_ARRAY ).($_TP['OQUERY']?'&'.$_TP['OQUERY']:'');
$_SERVER['PHP_SELF'] ="/forum.php";
$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'] . ($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');

foreach($_TP['_GET'] as $key => $value){
	$_GET[$key] = $value;
}
unset($_TP);

include 'forum.php';
?>