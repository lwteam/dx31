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

require_once _Data('Categorys');

$id = (int)$_GET['id'];
$operation = $_GET['operation']?$_GET['operation']:'list';
$page = $_G['page'];
$pagenum = $_G['tpp'];


//删除
if($operation == 'delete'){

	$DeleteOne = DB::fetch_first("SELECT * FROM ".DB::table('article')." WHERE `id`='$id' LIMIT 1");
	if($DeleteOne){
		if($DeleteOne['titlepic']){
			@unlink($DeleteOne['titlepic']);
		}
		DB::query("DELETE FROM ".DB::table('article')." WHERE id='$id' LIMIT 1");
		showmessage('文章已经删除', 'manage.php?action='.$action);
	}else{
		showmessage('文章不存在,无法删除!', 'manage.php?action='.$action);
	}

// AJAX 获取分词	
}elseif($operation == 'ajaxtag'){

	$response = array();
	$response['scode'] = 0;
	$thread = C::t('forum_post')->fetch_threadpost_by_tid_invisible($_GET['tid']);
	if($thread){
		$response['scode'] = 1;
		$subjectenc = rawurlencode(strip_tags($thread['subject']));
		$message = DiscuzUBBclear($thread['message']);
		$messageenc = cutstr($message, 500, '');
		$messageenc = rawurlencode(strip_tags(preg_replace("/\[.+?\]/U", '', $messageenc)));
		$data = @implode('', file("http://keyword.discuz.com/related_kw.html?ics=".CHARSET."&ocs=".CHARSET."&title=$subjectenc&content=$messageenc"));
		if($data) {
			if(PHP_VERSION > '5' && CHARSET != 'utf-8') {
				require_once libfile('class/chinese');
				$chs = new Chinese('utf-8', CHARSET);
			}
			$parser = xml_parser_create();
			xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
			xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
			xml_parse_into_struct($parser, $data, $values, $index);
			xml_parser_free($parser);

			$kws = array();

			foreach($values as $valuearray) {
				if($valuearray['tag'] == 'kw' || $valuearray['tag'] == 'ekw') {
					$kws[] = !empty($chs) ? $chs->convert(trim($valuearray['value'])) : trim($valuearray['value']);
				}
			}
			 $tagtxts  = $return = '';
			if($kws) {
				foreach($kws as $kw) {
					$kw = dhtmlspecialchars($kw);
					$return .= $kw.',';
				}
				$return = dhtmlspecialchars($return);
				$tagtxts = substr($return, 0, strlen($return)-1);
			}
		}

		$response['subject'] = $thread['subject'];
		$response['content'] = $message;
		$response['tagtxts'] = $tagtxts;
	}else{
		$response['subject'] = '';
		$response['content'] = '';
		$response['tagtxts'] = '';
	}		
	echo json_encode($response);
	exit();

}elseif($operation == 'update'){
	$loadtemplate = 'indexarticle_update';

	$article = $_G['gp_article'];
	ManagePostdataSafe($article);
	
	if($id){
		//编辑
		$article_One = DB::fetch_first("SELECT * FROM ".DB::table('article')." WHERE `id`='$id' LIMIT 1");
		if(!$article_One){
			showmessage('信息不存在,无法完成操作!', 'manage.php?action='.$action);
		}
	}
	if($_POST){
		$indexarticle = $_POST['indexarticle'];
		if(!$id){
			if($article['title']){
				if($article['tagtxts']){
					UpdateTags($article['tagtxts'],$article['tags']);
				}
				if( $_FILES['titlepic']) {
					$upload = new discuz_upload();
					if($upload->init($_FILES['titlepic'], 'forum') && $upload->save()) {
						$article['titlepic'] = $_G['setting']['attachurl'].'forum/'.$upload->attach['attachment'];
					}
				}
				if($article['tid']){
					$thread = C::t('forum_post')->fetch_threadpost_by_tid_invisible($article['tid']);
					$article['fid'] = $thread['fid'];
				}
				$article['adateline'] = $_G['timestamp'];
				DB::insert('article', $article);
			}
			showmessage('文章已经成功添加', 'manage.php?action='.$action);
		}else{
			if($article['title']){
				if(!$article_One){
					showmessage('文章不存在不能进行修改', 'manage.php?action='.$action);
				}else{
					foreach($article as $key => $value){
						$article_One[$key] = $value;
					}
					unset($article_One['id']);
				}
				if($article_One['tagtxts']){
					UpdateTags($article_One['tagtxts'],$article_One['tags']);
				}

				if( $_FILES['titlepic']) {
					$upload = new discuz_upload();
					if($upload->init($_FILES['titlepic'], 'forum') && $upload->save()) {
						if($article_One['titlepic']){
							@unlink($article_One['titlepic']);
						}
						$article_One['titlepic'] = $_G['setting']['attachurl'].'forum/'.$upload->attach['attachment'];
					}
				}
				if($article_One['tid']){
					$thread = C::t('forum_post')->fetch_threadpost_by_tid_invisible($article_One['tid']);
					$article_One['fid'] = $thread['fid'];
				}
				DB::update('article', $article_One, "`id`='{$_G['gp_id']}'");
			}
			showmessage('文章已经成功编辑', 'manage.php?action='.$action);
		}
	}
	//添加
}else{
	$loadtemplate = 'indexarticle_list';
	if ($_GET['search']) {
		$sqlwhere = " WHERE `title`  LIKE '%$_GET[search]%'";
	}
	$TotalNum = DB::result_first("SELECT count(*) FROM ".DB::table('article').$sqlwhere);
	if(@ceil($TotalNum/$pagenum) < $page){
		$page = 1;
	}
	$offset = ($page - 1) * $pagenum;

	$query = DB::query("SELECT * FROM ".DB::table('article').$sqlwhere." ORDER BY `id` DESC LIMIT $offset,$pagenum");
	while($value = DB::fetch($query)) {
		$value['tagtxts'] = join(',',array_filter(explode(',',$value['tagtxts'])));
		$articlelist[] = $value;
	}
	$multipage = multi($TotalNum, $pagenum, $page, "manage.php?action=$action&operation=".$operation, $_G['setting']['threadmaxpages']);
}







function DiscuzUBBclear($content) {
	global $_G;
	//将[attachimg]和[attach]的UBB标签连同内容给全部删除
	$content = preg_replace('!\[(attachimg|attach)\]([^\[]+)\[/(attachimg|attach)\]!', '', $content);
	$message = preg_replace("|\s*http://[a-z0-9-\.\?\=&_@/%#]*\$|sim", "", $message);
	/* 过滤[img]标签，在其后面添加空格，防止粘连 2010-10-12 */
	$content = preg_replace('|\[img(?:=[^\]]*)?\](.*?)\[/img\]|', '\\1 ', $content);
	
	// 过滤UBB
	$re ="#\[([a-z]+)(?:=[^\]]*)?\](.*?)\[/\\1\]#sim";
	while(preg_match($re, $content)) {
		$content = preg_replace($re, '\2', $content);
	}
	// 过滤表情
	$re = isset($_G['cache']['smileycodes']) ? (array)$_G['cache']['smileycodes'] : array();
	$smiles_searcharray = isset($_G['cache']['smilies']['searcharray']) ? (array)$_G['cache']['smilies']['searcharray'] : array();
	$content = str_replace($re, '', $content);
	$content = preg_replace($smiles_searcharray, '', $content);
	//多个空格合为一个空格；前后空格去掉
	$content = preg_replace("#\s+#", ' ', $content);
	$content = trim($content);
	return $content;
}

function UpdateTags(&$tag,&$tagid) {
	global $_G;
	$tagids = array();
	if(!$tag) {
		$tag = $tagid = '';
	}else{
		$tagArray = array_filter(explode(',',$tag));
		foreach($tagArray as $key=>$val){
			$tagArray[$key] = htmlspecialchars(trim($val));
			$taginArray[$key] = "'".htmlspecialchars(trim($val))."'";
		}

		if(!$tagid){
			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `name` IN (".join(',',$taginArray).")");
			while($value = DB::fetch($query)) {
				$taglist[$value['id']] = $value['name'];
			}
			foreach($tagArray as $val){
				if(in_array($val,$taglist)){
					$kid = array_search($val,$taglist);
					DB::query("UPDATE ".DB::table('article_tag')." SET relatenum = relatenum+1 WHERE id='{$kid}'");
					$tagids[$kid] = $kid;
				}else{
					$tabstatus =  DB::fetch_first("show table status where name='".DB::table('article_tag')."'");
					$maxid= $tabstatus['Auto_increment'];
					DB::insert('article_tag', array('id'=>$maxid,'name'=>$val, 'relatenum'=>1));
					$tagids[$maxid] = $maxid;
				}
			}

		}else{
			if($tagid){
				$tagidArray = join(',',array_filter(explode(',',$tagid)));
				DB::query("UPDATE ".DB::table('article_tag')." SET relatenum = relatenum-1 WHERE id IN ($tagidArray)");
			}
			

			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `name` IN (".join(',',$taginArray).")");
			while($value = DB::fetch($query)) {
				$taglist[$value['id']] = $value['name'];
			}
			foreach($tagArray as $val){
				if(in_array($val,$taglist)){
					$kid = array_search($val,$taglist);
					DB::query("UPDATE ".DB::table('article_tag')." SET relatenum = relatenum+1 WHERE id='{$kid}'");
					$tagids[$kid] = $kid;
				}else{
					$tabstatus =  DB::fetch_first("show table status where name='".DB::table('article_tag')."'");
					$maxid= $tabstatus['Auto_increment'];
					DB::insert('article_tag', array('id'=>$maxid,'name'=>$val, 'relatenum'=>1));
					$tagids[$maxid] = $maxid;
				}
			}
		}
		if($tagids){
			$tagid = ','.join(',',$tagids).',';
			$tag = ','.join(',',$tagArray).',';
		}else{
			$tag = $tagid = '';
		}
	}

	
}



?>