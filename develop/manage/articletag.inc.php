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


$id = (int)$_GET['id'];
$operation = $_REQUEST['operation']?$_REQUEST['operation']:'list'; 
$page = $_G['page'];
$pagenum = $_G['tpp'];


if($operation == 'delete'){
	//删除
	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE `id`='$id' LIMIT 1");
	if($DeleteOne){
		DB::query("DELETE FROM ".DB::table('article_tag')." WHERE id='$id' LIMIT 1");
		showmessage('该条信息已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('信息不存在,无法删除!', 'manage.php?action='.$action);
	}
	

}elseif($operation == 'update'){
	$loadtemplate = 'articletag_update';
	if($id){
		//编辑
		$articletag_One = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE `id`='$id' LIMIT 1");
		if(!$articletag_One){
			showmessage('标签不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$articletag = $_G['gp_articletag'];
		if(!$id){
			if($articletag['name']){
				CompleteTags($articletag['relatename'],$articletag['relateid']);
				DB::insert('articletag', $articletag);
			}
			showmessage('标签已经成功建立', 'manage.php?action='.$action);
		}else{
			if($articletag['name']){
				$articletag_edit = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE id='{$id}' LIMIT 1");
				if(!$articletag_edit){
					showmessage('文章不存在不能进行修改', 'manage.php?action='.$action);
				}else{
					foreach($articletag as $key => $value){
						$articletag_edit[$key] = $value;
					}
					unset($articletag_edit['id']);

					CompleteTags($articletag_edit['relatename'],$articletag_edit['relateid']);
				}
				DB::update('article_tag', $articletag_edit, "`id`='{$_G['gp_id']}'");
			}
			showmessage('标签已经成功编辑', 'manage.php?action='.$action);
		}
	}
	//添加
}else{
	$loadtemplate = 'articletag_list';


	if ($_GET['search']) {
		$sqlwhere = " WHERE `title`  LIKE '%$_GET[search]%'";
	}
	$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('article_tag').$sqlwhere);
	if(@ceil($TotalNum/$pagenum) < $page){
		$page = 1;
	}
	$offset = ($page - 1) * $pagenum;

	$query = DB::query("SELECT * FROM ".DB::table('article_tag').$sqlwhere." ORDER BY `id` DESC LIMIT $offset,$pagenum");
	while($value = DB::fetch($query)) {
		$value['relatename'] = join(',',array_filter(explode(',',$value['relatename'])));
		$articletaglist[] = $value;
	}
	$multipage = multi($TotalNum, $pagenum, $page, "manage.php?action=$action&operation=".$operation, $_G['setting']['threadmaxpages']);	



}



function CompleteTags(&$tag,&$tagid) {
	global $_G;
	if(!$tag){
		return ;
	}

	$tagArray = array_filter(explode(',',$tag));
	foreach($tagArray as $key=>$val){
		$taginArray[$key] = "'".htmlspecialchars(trim($val))."'";
	}
	$query = DB::query("SELECT * FROM ".DB::table('articletag')." WHERE `name` IN (".join(',',$taginArray).")");
	while($value = DB::fetch($query)) {
		$Tagids[] = $value['id'];
		$Tagnames[] = $value['name'];
	}
	if($Tagids){
		$tag = ",".join(',',$Tagnames).",";
		$tagid = ",".join(',',$Tagids).",";
	}else{
		$tag = $tagid = '';
	}

	
	
}

?>