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
loadcache('indexdatacache');
$indexdatacache = & $_G['cache']['indexdatacache'];
$topicfocuslist = & $_G['cache']['indexdatacache']['topicfocuslist'];


//save_syscache('indexdatacache',array());
echo '<pre>';
//var_dump($topicfocuslist);
echo '</pre>';
//exit();
if($_POST){
	$topicfocus = $_G['gp_topicfocus'];
	ManagePostdataSafe($topicfocus);
	if(!isset($_GET['id'])){
		if($topicfocus['title']){
			if( $_FILES['topicfocuspic']) {
				$upload = new discuz_upload();
				if($upload->init($_FILES['topicfocuspic'], 'portal') && $upload->save()) {
					$topicfocus['pic'] = $_G['setting']['attachurl'].'portal/'.$upload->attach['attachment'];
				}
			}

			$topicfocus['dateline'] = $_G['timestamp'];
			$topicfocus['order'] = (int)$topicfocus['order'];
			$topicfocuslist[] = $topicfocus;
		}



		if($topicfocuslist && is_array($topicfocuslist)){
			$sortarray= array();
			foreach($topicfocuslist as $key=>$value){
				$sortarray[$key] = $value['order'];
			}
			arsort($sortarray);
			$topicfocuslist2 = $topicfocuslist;
			$topicfocuslist= array();
			foreach($sortarray as $key=>$value){
				$topicfocuslist[] = $topicfocuslist2[$key];
			}
		}else{
			$topicfocuslist = array();
		}
		$indexdatacache['topicfocuslist'] = $topicfocuslist;
		save_syscache('indexdatacache',$indexdatacache);

		showmessage('信息已经成功添加', 'manage.php?action=topicfocus');
	}else{
		if($topicfocus['title']){
			$topicfocus_edit = $topicfocuslist[$_GET['id']];
			if(!$topicfocus_edit){
				showmessage('信息不存在不能进行修改', 'manage.php?action=topicfocus');
			}else{
				foreach($topicfocus as $key => $value){
					$topicfocus_edit[$key] = $value;
				}
				unset($topicfocus_edit['id']);
			}

			if( $_FILES['topicfocuspic']) {
				$upload = new discuz_upload();
				if($upload->init($_FILES['topicfocuspic'], 'portal') && $upload->save()) {
					if($article_edit['topicfocuspic']){
						@unlink($article_edit['topicfocuspic']);
					}
					$topicfocus_edit['pic'] = $_G['setting']['attachurl'].'portal/'.$upload->attach['attachment'];
				}
			}
			$topicfocus_edit['order'] = (int)$topicfocus_edit['order'];
			$topicfocuslist[$_GET['id']] = $topicfocus_edit;
		}


		if($topicfocuslist && is_array($topicfocuslist)){
			$sortarray= array();
			foreach($topicfocuslist as $key=>$value){
				$sortarray[$key] = $value['order'];
			}
			arsort($sortarray);
			$topicfocuslist2 = $topicfocuslist;
			$topicfocuslist= array();
			foreach($sortarray as $key=>$value){
				$topicfocuslist[] = $topicfocuslist2[$key];
			}
		}else{
			$topicfocuslist = array();
		}
		$indexdatacache['topicfocuslist'] = $topicfocuslist;
		save_syscache('indexdatacache',$indexdatacache);
		showmessage('信息已经成功编辑', 'manage.php?action=topicfocus');
	}

}else{
	

	if(isset($_GET['id'])){
		$topicfocus = $topicfocuslist[$_GET['id']];
		if(!$topicfocus){
			showmessage('信息不存在', 'manage.php?action=topicfocus');
		}
	}
	if($_G['gp_do'] == 'del' && $topicfocus){
		if($topicfocus['pic']){
			@unlink($topicfocus['pic']);
		}
		unset($topicfocuslist[$_GET['id']]);

		$indexdatacache['topicfocuslist'] = $topicfocuslist;
		save_syscache('indexdatacache',$indexdatacache);
		showmessage('信息已经删除', 'manage.php?action=topicfocus');
	}
}
?>