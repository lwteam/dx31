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



if($_POST){
	$_G['gp_id'] = intval($_G['gp_id']);
	$article_tag = $_G['gp_article_tag'];
	if(!$_G['gp_id']){
		if($article_tag['name']){
			CompleteTags($article_tag['relatename'],$article_tag['relateid']);
			DB::insert('article_tag', $article_tag);
		}
		showmessage('标签已经成功建立', 'manage.php?action=indextag');
	}else{
		if($article_tag['name']){
			$article_tag_edit = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE id='{$_G['gp_id']}' LIMIT 1");
			if(!$article_tag_edit){
				showmessage('文章不存在不能进行修改', 'manage.php?action=indextag');
			}else{
				foreach($article_tag as $key => $value){
					$article_tag_edit[$key] = $value;
				}
				unset($article_tag_edit['id']);

				CompleteTags($article_tag_edit['relatename'],$article_tag_edit['relateid']);
			}
	

			DB::update('article_tag', $article_tag_edit, "`id`='{$_G['gp_id']}'");
		}
		showmessage('标签已经成功编辑', 'manage.php?action=indextag');
	}
}else{
	$_G['gp_id'] = (int)$_G['gp_id'];
	if($_G['gp_id']){
		$article_tag = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE id='{$_G['gp_id']}' LIMIT 1");
		if(!$article_tag){
			showmessage('标签不存在', 'manage.php?action=indextag');
		}
	}

	if($_G['gp_do'] == 'del' && $article_tag){
		DB::query("DELETE FROM ".DB::table('article_tag')." WHERE id='{$_G['gp_id']}' LIMIT 1");
		showmessage('标签已经删除', 'manage.php?action=indextag');
	}

	$query = DB::query("SELECT * FROM ".DB::table('article_tag')." ORDER BY `id` DESC");
	while($value = DB::fetch($query)) {
		$value['relatename'] = join(',',array_filter(explode(',',$value['relatename'])));
		$article_taglist[] = $value;
	}
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
	$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `name` IN (".join(',',$taginArray).")");
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