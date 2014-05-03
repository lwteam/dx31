<?php

class Library {
	public function randstring($length = 5,$mod = 'UMN', $starthash = '') {
		$hash = $starthash;

		if (preg_match ( "/U/i", $mod )) {
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}
		if (preg_match ( "/M/i", $mod )) {
			$chars .= 'abcdefghijklmnopqrstuvwxyz';
		}
		if (preg_match ( "/N/i", $mod )) {
			$chars .= '0123456789';
		}

		
		$max = strlen ( $chars ) - 1;
		if (PHP_VERSION < '4.2.0') {
			mt_srand ( ( double ) microtime () * 1000000 );
		}
		for($i = 0; $i < $length; $i ++) {
			
			$hash .= $chars [mt_rand ( 0, $max )];
			if ($i == 0) {
				$hash = ($hash [0] == '0') ? '1' : $hash;
			}
		}
		return $hash;
	}
	public function getstatus($status, $position) {
		$t = $status & pow(2, $position - 1) ? 1 : 0;
		return $t;
	}

	public function setstatus($position, $value, $baseon = null) {
		$t = pow(2, $position - 1);
		if($value) {
			$t = $baseon | $t;
		} elseif ($baseon !== null) {
			$t = $baseon & ~$t;
		} else {
			$t = ~$t;
		}
		return $t & 0xFFFFFFFF;
	}
	
	public function HandlingRecord($timestamp,$classid,$handling = 0,$bhandling = NULL,$add = TRUE,$uid=0){
		global $_G,$_Data;
		$uid = $uid?$uid:$_G['uid'];
		$thisyear=date( 'Y', $timestamp );
		$thismonth=date( 'm', $timestamp );
		$thisday=date( 'd', $timestamp );
		$thisweek=date( 'W', $timestamp );

		//星期第几天
		$thiswday=date( 'N', $timestamp );
		//月份第几天
		$thismday=date( 'j', $timestamp );
		$thismhaveday=date( 't', $timestamp );
		
		$thiszerotime =	mktime( 0,0,0,$thismonth, $thisday, $thisyear );

		$selectmonth = $thisyear.$thismonth;
		$selectweek = $thisyear.$thisweek;
		$selectday = $selectmonth.$thisday;


		if (!$_Data['buglistrelation'][$classid]['self']) {
			return FALSE;
		}elseif ($_Data['buglistrelation'][$classid]['self'] == 1) {
			$fclassid = $classid;
		}elseif ($_Data['buglistrelation'][$classid]['self'] == 2) {
			$fclassid = substr($classid, 0,1);
		}
		$record = $hrecord = $mhrecord = $crecord =FALSE;
		$bugMuser = DB::fetch_first("SELECT * FROM ".DB::table('manage_user')." WHERE `dist`='1' AND buglist='$fclassid'  LIMIT 1");

		if ($bugMuser) {
			
			if ($handling == 0) {
				$record =TRUE;
				$hrecord =FALSE;
				$mhrecord =FALSE;
				$crecord =TRUE;
			}elseif ($handling == 1) {
				$record =FALSE;
				$hrecord =TRUE;
				if ($uid!=$bugMuser['uid']) {
					$mhrecord =TRUE;
				}
			}elseif ($handling == 2) {
				$record =FALSE;
				$hrecord =FALSE;
				$mhrecord =TURE;
			}elseif ($handling == 4 && $bhandling == 0 ) {
				$record =FALSE;
				$hrecord =TRUE;
				if ($uid!=$bugMuser['uid']) {
					$mhrecord =TRUE;
				}
			}
		}



		if($record){
			if ($add) {
				$nsql = '+1';
			}else{
				$nsql = '-1';
			}

			DB::query("insert into ".DB::table('buglist_mstatus')." 
				(`uid`,`username`, `month`,`dateline`,`type`, `num`) values 
				('{$bugMuser['uid']}', '{$bugMuser['username']}','{$selectmonth}','{$_G['timestamp']}','1','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `num`=`num`$nsql;");
			DB::query("insert into ".DB::table('buglist_wstatus')." 
				(`uid`,`username`, `week`,`dateline`,`type`, `num`) values 
				('{$bugMuser['uid']}', '{$bugMuser['username']}','{$selectmonth}','{$_G['timestamp']}','1','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `num`=`num`$nsql;");	
		}
		if($hrecord){
			DB::query("insert into ".DB::table('buglist_mstatus')." 
				(`uid`,`username`, `month`,`dateline`, `type`,`hnum`) values 
				('{$bugMuser['uid']}', '{$bugMuser['username']}','{$selectmonth}','{$_G['timestamp']}','1','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `hnum`=`hnum`+1;");
			DB::query("insert into ".DB::table('buglist_wstatus')." 
				(`uid`,`username`, `week`,`dateline`, `type`,`hnum`) values 
				('{$bugMuser['uid']}', '{$bugMuser['username']}','{$selectmonth}','{$_G['timestamp']}','1','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `hnum`=`hnum`+1;");
		}
		if($mhrecord){
			DB::query("insert into ".DB::table('buglist_mstatus')." 
				(`uid`,`username`, `month`,`dateline`, `hnum`) values 
				('{$uid}', '{$_G['username']}','{$selectmonth}','{$_G['timestamp']}','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `hnum`=`hnum`+1;");
			DB::query("insert into ".DB::table('buglist_wstatus')." 
				(`uid`,`username`, `week`,`dateline`, `hnum`) values 
				('{$uid}', '{$_G['username']}','{$selectmonth}','{$_G['timestamp']}','1') on duplicate key update 
				`dateline`='{$_G['timestamp']}', `hnum`=`hnum`+1;");	
		}
		if ( $crecord) {
			if ($add) {
				$nsql = '+1';
			}else{
				$nsql = '-1';
			}

			if (strlen($classid)>1) {
				$pclassid = substr($classid, 0,1);
			}else{
				$pclassid = FALSE;
			}
			DB::query("insert into ".DB::table('buglist_cstatus')." 
				(`classid`, `num`) values ('$classid','1')
				 on duplicate key update `num`=`num`$nsql;");
			if ($pclassid) {
				DB::query("insert into ".DB::table('buglist_cstatus')." 
				(`classid`, `num`) values ('$pclassid','1')
				 on duplicate key update `num`=`num`$nsql;");
			}
		}
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

	public function object($object){
		static $objects;
		if(!isset($objects[$object])){
			$objects[$object] = New $object();
		}
		return $objects[$object];
	}

	public function fetch_cache($ids, $pre_cache_key = null) {
		$data = false;
		if(memory('check')) {
			$data = memory('get', $ids, $pre_cache_key);
		}
		return $data;
	}

	public function store_cache($id, $data, $cache_ttl = null, $pre_cache_key = null) {
		$ret = false;
		if(memory('check')) {
			$ret = memory('set', $id, $data, $cache_ttl, $pre_cache_key);
		}
		return $ret;
	}

	public function clear_cache($ids, $pre_cache_key = null) {
		$ret = false;
		if(memory('check')) {
			$ret = memory('rm', $ids, $pre_cache_key);
		}
		return $ret;
	}

	public function update_cache($id, $data, $cache_ttl = null, $pre_cache_key = null) {
		$ret = false;
		if(memory('check')) {
			if(($_data = memory('get', $id, $pre_cache_key)) !== false) {
				$ret = $this->store_cache($id, array_merge($_data, $data), $cache_ttl, $pre_cache_key);
			}
		}
		return $ret;
	}
	public function ajax_output($template = '',$dir = ''){
		global $response,$globalvar;
		if ($globalvar) {
			extract($globalvar);
		}
		if ($template) {
			if ($dir) {
				include template($template,0, $dir);
			}else{
				include template($template);
			}
			$response['content']  = ob_get_clean();
		}
		echo json_encode($response);
		exit();
	}


}

?>