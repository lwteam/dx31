<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');


// 用来修改静态地址
class staticlink {

	public $point;

	public function action($point) {
		$this->point = $point;
		if(CURSCRIPT == 'forum'||CURSCRIPT == 'home'||CURSCRIPT == 'misc'||CURSCRIPT == 'activity'||CURSCRIPT == 'resource'||CURSCRIPT == 'business'||CURSCRIPT == 'phone'||CURSCRIPT == 'manage'||CURSCRIPT == 'ranklist'){
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G,$extra;
		//NAV
		
		if(CURMODULE == 'forumdisplay' || ExtSCRIPT == 'index'){
			if($extra){
				$extrafunc = ($_G['forum']['fid']?'fid='.$_G['forum']['fid'].'&':'').rawurldecode($extra);
				if($_G['cookie']['extra']!=$extrafunc){
					dsetcookie('extra', $extrafunc);
				}
			}
		}
		$htmloutput = ob_get_contents();
		$htmloutput = self::staticparse($htmloutput);
		ob_end_clean();
		echo $htmloutput;
	}

	function staticparse($message) {
			$search = array(
			'/forum\.php\?gid=(\d+)/e',
			'/forum.php\?mod\=forumdisplay&(amp;)?fid\=(\d+)(&(amp;)?page\=(\d+))?(&(amp;)?[^"\'# ]+)?/e',
			'/forum.php\?mod\=viewthread&(amp;)?fid\=(\d+)&(amp;)?tid=(\d+)(&(amp;)?page\=(\d+))?(&(amp;)?[^"\'# ]+)?/e',
		);
		$replace= array(
			'self::staticrewrite(\'$0\',\'$0\')',
			'self::staticrewrite(\'$0\',\'$2\',0,\'$5\',\'$6\')',
			'self::staticrewrite(\'$0\',\'$2\',\'$4\',\'$7\',\'$8\')',
		);
		return  preg_replace($search,$replace,$message);
	}


	function staticrewrite($url,$fid,$tid = 0,$page = 0,$ext = '') {
		global $_G;
		if(!$_G['cache']['staticlink']){
			loadcache('staticlink');
		}
		$staticlink = & $_G['cache']['staticlink'];
		if(!$staticlink[$fid]){
			return stripslashes($url);
		}
		parse_str(str_replace('&amp;','&',$ext), $extrary);
		if( $extrary && isset($extrary['page']) ) {
			$page = $extrary['page'];
			unset($extrary['page']);
		}
		if( $extrary && isset($extrary['extra']) ) {
			unset($extrary['extra']);
		}
		//板块
		$thislink .= $staticlink[$fid]['staticname'].'/';
		if($tid) {
			$thislink .= 't'.$tid.'/';
		}
		if($page && $page>1){
			$thislink .= $page.'/';
		}
		if($extrary){
			$i=0;
			foreach($extrary as $key=>$value){
				$thislink .= ($i?'&amp;':'?').$key.'='.$value;
				$i++;
			}
		}

		return $thislink;
	}
}

//处理COOKIE 细节
class staticlink_forumdisplay_extra {

	public function action($point) {
		if(CURSCRIPT == 'forum' && CURMODULE == 'viewthread'){
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G;
		parse_str($_G['cookie']['extra'], $extrax);
		if(isset($_GET['fid'])){
			if($extrax['fid'] == $_GET['fid']){
				$_GET['extra'] = preg_replace('/fid=(\d+)&?/','',$_G['cookie']['extra']);
			}
		}else{
			$_GET['extra'] = preg_replace('/fid=(\d+)&?/','',$_G['cookie']['extra']);
		}
	}
}


//修正帖子移动板块的URL
class staticlink_viewthread_location {

	public function action($point) {
		global $_G;
		
		if(CURSCRIPT == 'forum' && CURMODULE == 'viewthread' && $_G['gp_fid']){
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G;
		$fid = $_G['forum_thread']['fid'];
	

		 //修改静态SEO

		 
		$_G['setting']['seohead']= preg_replace('/forum\.php\?mod=viewthread(?!&fid)/','forum.php?mod=viewthread&fid='.$fid,$_G['setting']['seohead']);

		if($_G['gp_fid'] != $fid){
			loadcache('staticlink');
			$staticlink = & $_G['cache']['staticlink'];

			if($staticlink[$fid] && $staticlink[$fid]['staticname']){
				header( "HTTP/1.1 301 Moved Permanently" );
				header('Location: '.$_G['siteurl'].$staticlink[$fid]['staticname'].'/t'.$_G['gp_tid'].'/');
				exit;
			}
		}
		if ($_GET['haierspi']==1) {
			echo'<pre>';
			var_dump( $_G['gp_fid'] , $fid );
			echo'</pre>';exit;
		}

	}
}
// 修改提示信息中的跳转地址
class staticlink_showmessage {
	public $returns;
	public $class;
	public $function;
	public function action($point) {
		
		if(CURSCRIPT == 'forum'){
			return true;
		}else{
			return false;
		}
	}
	public function execute() {
		global $_G;
		
		if($this->function  == 'showmessage'){
			foreach($this->returns as $key => $value){
				if($key == 'url_forward'){
					$gotourl = $value;
					break;
				}
			}

		}elseif($this->function  == 'dheader'){
			foreach($this->returns as $key => $value){
				if($key == 'string'){
					$gotourl = $value;
					break;
				}
			}
		}


		
		if (preg_match ('/forum.php\?mod\=viewthread&(amp;)?tid=(\d+)/is', $gotourl, $matches)) {
			
			$query = "SELECT fid FROM ".DB::table('forum_thread')." WHERE tid='$matches[2]'";
			$fid = DB::result_first($query);
			$gotourl = str_replace('tid='.$matches[2],'fid='.$fid.'&tid='.$matches[2],$gotourl);
			$search = '/forum.php\?mod\=viewthread&(amp;)?fid\=(\d+)&(amp;)?tid=(\d+)(&(amp;)?page\=(\d+))?(&(amp;)?[^"\'# ]+)?/e';
			$replace= '$siteurl.staticlink::staticrewrite(\'$0\',\'$2\',\'$4\',\'$7\',\'$8\')';
			$gotourl = preg_replace($search,$replace,$gotourl);
			$this->returns[$key] = $gotourl;


		}
	}
}



?>