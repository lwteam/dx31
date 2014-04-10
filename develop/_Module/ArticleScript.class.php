<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');

class ArticleScript {
	public function action($point) {
		global $_G;
		$this->actionStorage = $GLOBALS['_ModuleActionStorage'];
		$this->point = $point;
		$this->action = '';

		if (defined('DEFAULT') && constant('DEFAULT') == 'INDEX' ) {
			$this->action = 'index';
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G,$multipage,$discuz_table;

		require DISCUZ_ROOT.'./develop/Categorys.php';

		$act = $_GET['act'];

		if($act  == 'tag'){
			$id = (int)$_GET['id'];
			if($id){
				$key = $id;
				$SeletTag = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE `id` = '$key' LIMIT 1");
			}elseif($_GET['name']){
				$key = $_GET['name'];
				$SeletTag = DB::fetch_first("SELECT * FROM ".DB::table('article_tag')." WHERE `name` = '$key' LIMIT 1");
			}
			$TagsAry = array();
			$TagsAry[] = "a.`tags` LIKE '%,$SeletTag[id],%'";
			if($SeletTag['relateid']){
				$EpAry = array_filter(explode(',',$SeletTag['relatename']));
				foreach($EpAry as $val){
					$TagsAry[] = "a.`tags` LIKE '%,$val,%'";
				}
			}
			$sqlwhere = " WHERE ".join(' OR ',$TagsAry);

			$maxpage = $_G['setting']['threadmaxpages'];

			$page = $_G['page'];
			$page = $maxpage && $page > $maxpage ? 1 : $page;

			$articlecount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('article')." a $sqlwhere");

			if(@ceil($articlecount/$_G['tpp']) < $page) {
				$page = 1;
			}
			$start_limit = ($page - 1) * $_G['tpp'];
			$limit =  $_G['tpp'];

			$multipage = pagination($articlecount, $_G['tpp'], $page, "index.php?act=tag&id=".$id,$maxpage);

			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('article')." a 
				LEFT JOIN ".DB::table('forum_thread')." t USING(tid) 
			 $sqlwhere ORDER BY a.id DESC ".DB::limit($start_limit,$limit));
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['tagary'] = TagsRead($value['tagtxts'],$value['tags']);
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$articles[] = $value;
			}

			include template('article/tag');
			exit;
		}elseif($act  == 'search'){

			$srchtxt = $_GET['srchtxt']?$_GET['srchtxt']:$_POST['srchtxt'];
			
			$sqlwhere = " WHERE a.`title`  LIKE '%$srchtxt%'";

			$maxpage = $_G['setting']['threadmaxpages'];

			$page = $_G['page'];
			$page = $maxpage && $page > $maxpage ? 1 : $page;

			$articlecount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('article')." a $sqlwhere");

			if(@ceil($articlecount/$_G['tpp']) < $page) {
				$page = 1;
			}
			$start_limit = ($page - 1) * $_G['tpp'];
			$limit =  $_G['tpp'];

			$multipage = pagination($articlecount, $_G['tpp'], $page, "index.php?act=search&srchtxt=".urlencode($srchtxt),$maxpage);

			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('article')." a 
				LEFT JOIN ".DB::table('forum_thread')." t USING(tid) 
			 $sqlwhere ORDER BY a.id DESC ".DB::limit($start_limit,$limit));
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['tagary'] = TagsRead($value['tagtxts'],$value['tags']);
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$articles[] = $value;
			}
			if($articles){
				DB::query("insert into ".DB::table('article_search_hothistory')." 
						(`title`, `num`) values ('$srchtxt','1') 
						ON DUPLICATE KEY UPDATE `num`=`num`+1;");
			}
			$query = DB::query("SELECT * FROM ".DB::table('article_search_hothistory')."   ORDER BY  `num` DESC LIMIT 10");
			while($value = DB::fetch($query)) {
				$HotSearchs[] = $value;
			}
			

			include template('article/search');
			exit;
		}elseif($act  == 'tags'){

			$query = DB::query("SELECT * FROM `pre_article_tag` ORDER BY typeid DESC,relatenum DESC ");
			$i = $k = 0;
			while($value = DB::fetch($query)) {
				if($value['typeid'] != $typeid){
					$typeid = $value['typeid'];
					$i++;
				}
				$Tags[$i-1][] = $value;
				if($k == 0){
					$typeid = $value['typeid'];
				}
				$k++;
			}
			include template('article/tags');
			exit;
		}elseif($act  == 'list'){

			$key = $_GET['key'];
			$id = array_search($key , $CategorysKey);
			$id = $id?$id:1;
			$select = $CategorysKey[$id];

			//index.php?act=list&key=

			$maxpage = $_G['setting']['threadmaxpages'];

			$page = $_G['page'];
			$page = $maxpage && $page > $maxpage ? 1 : $page;

			$articlecount = DB::result_first("SELECT COUNT(*) FROM ".DB::table('article')." a WHERE a.`category`='$id'");

			if(@ceil($articlecount/$_G['tpp']) < $page) {
				$page = 1;
			}
			$start_limit = ($page - 1) * $_G['tpp'];
			$limit =  $_G['tpp'];

			$multipage = pagination($articlecount, $_G['tpp'], $page, "index.php?act=list&key=".$CategorysKey[$id],$maxpage);

			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('article')." a 
				LEFT JOIN ".DB::table('forum_thread')." t USING(tid) 
			WHERE a.`category`='$id' ORDER BY a.id DESC ".DB::limit($start_limit,$limit));
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['tagary'] = TagsRead($value['tagtxts'],$value['tags']);
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$articles[] = $value;
			}
			
			// 边栏 热点产品
			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `typeid` = '3' AND `index` = '1' LIMIT 5");
			while($value = DB::fetch($query)) {
				$Products[] = $value;
			}
			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('forum_thread') ." t
				LEFT JOIN ".DB::table('article')." a USING(tid) ORDER BY heats DESC LIMIT 10 ");
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$hotarticles[] = $value;
			}
			//热门标签
			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `typeid` = '0' ORDER BY  `relatenum` DESC LIMIT 20");
			while($value = DB::fetch($query)) {
				$HotTags[] = $value;
			}

			include template('article/list');
			exit;

		}elseif($act  == 'ajax'){


			$tpp = 6;
			$nextoffset = $_GET['offset']+$tpp;

			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('article')." a 
				LEFT JOIN ".DB::table('forum_thread')." t USING(tid) 
			WHERE a.`index`='1' ORDER BY a.id DESC LIMIT $nextoffset,$tpp");
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['tagary'] = TagsRead($value['tagtxts'],$value['tags'],4);
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$articles[] = $value;
			}

			$response = array();
			$response['scode'] = 1;
			$response['offset'] = $nextoffset;
			include template('article/index_ajax');
			$response['content']  = ob_get_clean();
			echo json_encode($response);
			exit();

		}else{

			$act = $select = 'index';
			$tpp = 10;

			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('article')." a 
				LEFT JOIN ".DB::table('forum_thread')." t USING(tid) 
			WHERE a.`index`='1' ORDER BY a.id DESC LIMIT 0,$tpp ");
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['tagary'] = TagsRead($value['tagtxts'],$value['tags'],4);
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$articles[] = $value;
			}
			
			// 边栏 热点产品
			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `typeid` = '3' AND `index` = '1' LIMIT 5");
			while($value = DB::fetch($query)) {
				$Products[] = $value;
			}
			$query = DB::query("SELECT a.*,t.authorid, t.author, t.dateline FROM ".DB::table('forum_thread') ." t
				LEFT JOIN ".DB::table('article')." a USING(tid) ORDER BY heats DESC LIMIT 10 ");
			while($value = DB::fetch($query)) {
				$value['url'] = $value['titleurl']?$value['titleurl']:"forum.php?mod=viewthread&fid=$value[fid]&tid=$value[tid]";
				$value['datetag'] = DateTag($value['adateline']);
				$value['dateline_f'] = dgmdate($value['dateline'], 'u', '9999', getglobal('setting/dateformat'));
				$hotarticles[] = $value;
			}
			//热门标签
			$query = DB::query("SELECT * FROM ".DB::table('article_tag')." WHERE `typeid` = '0' ORDER BY  `relatenum` DESC LIMIT 20");
			while($value = DB::fetch($query)) {
				$HotTags[] = $value;
			}

			// 焦点图

			loadcache('indexdatacache');
			$indexdatacache = & $_G['cache']['indexdatacache'];
			$topicfocuslist = & $_G['cache']['indexdatacache']['topicfocuslist'];


			include template('article/index');
			exit;
		}


	}

}
function TagsRead($tagtxts,$tags,$size=10){
	$r = array();
	$tagtxts = explode(',',$tagtxts);	
	$tags = explode(',',$tags);
	$y = 0;
	foreach($tagtxts as $key=>$val){
		if($val){
			$i= $tags[$key];
			$r[$i] = $val;
			$y++;
			if($y>=$size){
				break;
			}
		}

	}
	return $r;
}
function DateTag($time){
	static $todayzore;
	if(!$todayzore){
		$todayzore = strtotime('today 00:00');
	}
	$r = '';
	//$toStartTime = strtotime('-3 days 00:00');
	//$toYear		=date('Y', TIMESTAMP);
	//$toMonth	=date('m', TIMESTAMP);
	//$toDay		=date('j', TIMESTAMP);
	//$toStartTime =	mktime( 0,0,0,$toMonth, $toDay, $toYear );
	if($time>=$todayzore){
		$r = urldecode('%E4%BB%8A%E6%97%A5');
	}else{
		$r = dgmdate($time, 'u', '9999', getglobal('setting/dateformat'));
	}

	return $r;
}

function pagination($num, $perpage, $page, $pageurl,$maxpage = 0) {
	$totalpage = @ceil($num / $perpage);
	$string = '';
	$string .='<div id="pg"><div class="page">';
	if ($page > 1){ 
		$k=$page-1;
		$string .= '<a href="'.$pageurl.'&page='.$k.'" class="prev">上一页</a> ';
	}
	for($i=1; $i<=$totalpage; $i++){ 
		if ($i == $page){
			$string .= ' <strong>'.$i.'</strong> ';
		}else{
			$string .= ' <a href="'.$pageurl.'&page='.$i.'">'.$i.'</a> ';
		}
	}
	if ($page < $totalpage){
		$k=$page+1;
		$string .= ' <a href="'.$pageurl.'&page='.$k.'" class="nxt">下一页</a>';
	}
	$string .='</div></div>';
	return $string;
}

?>