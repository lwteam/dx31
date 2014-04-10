<?php
!defined('BIGQI') && exit('BIGQI Dis-Access');


class Checkin {
	public $inajax = false;
	public $moodlist = Array(
			1 => array('mood'=>'static/image/dadatoo/1.jpg','text'=>'有么有女神呀,一起嬷嬷哒'),
			2 => array('mood'=>'static/image/dadatoo/2.jpg','text'=>'呜呜呜呜,求安慰...'),
			3 => array('mood'=>'static/image/dadatoo/3.jpg','text'=>'气死我了..谁来让我捏捏'),
			4 => array('mood'=>'static/image/dadatoo/4.jpg','text'=>'好开心...哈哈  '),
			5 => array('mood'=>'static/image/dadatoo/5.jpg','text'=>'单身妹纸...求抱走...'),
			6 => array('mood'=>'static/image/dadatoo/6.jpg','text'=>'快跑啊...狼来啦'),
		);
	public function action($point) {
		$this->point = $point;
		
		if (defined('CURSCRIPT') && CURSCRIPT == 'home' && $_GET['mod'] == 'checkin') {
			if($_GET['inajax']){
				$this->inajax = 1;
			}else{
				$this->inajax = -1;
			}
			return true;
		}elseif (defined('CURSCRIPT') && CURSCRIPT == 'forum' && defined('CURMODULE') &&  in_array(CURMODULE,array('index','forumdisplay')) ) {
			$this->inajax = 0;
			return true;
		}else{
			$this->inajax = false;
			return false;
		}
	}
	public function execute() {
		global $_G;
		//奖励积分
		$credit = Array(
			'day' => 10,
			'week' => 10,
			'month' => 10,
		);
		//超萌兔兔头像_ 可爱萌达达兔头像
		$moodlist = $this->moodlist;
		//默认表情组
		$defaultmood = 4;
		//默认板块
		$postfid = 2;
		//默认主题模版
		$postsubjectformat = '{y}年{m}月{d}日签到帖';


		$thisyear=date( 'Y', $_G['timestamp'] );
		$thismonth=date( 'm', $_G['timestamp'] );
		$thisday=date( 'd', $_G['timestamp'] );
		$thisweek=date( 'W', $_G['timestamp'] );

		//星期第几天
		$thiswday=date( 'N', $_G['timestamp'] );
		//月份第几天
		$thismday=date( 'j', $_G['timestamp'] );
		$thismhaveday=date( 't', $_G['timestamp'] );
		
		$thiszerotime =	mktime( 0,0,0,$thismonth, $thisday, $thisyear );

		$selectmonth = $thisyear.$thismonth;
		$selectweek = $thisyear.$thisweek;
		$selectday = $selectmonth.$thisday;
		
		//error_reporting(E_ALL);
		
		
		if($this->inajax>0){
			@header("Expires: -1");
			@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
			@header("Pragma: no-cache");

			$response = array();
			$response['scode'] = '0';

			if ($_G['uid']) {

				$checkin =  DB::fetch_first("SELECT * FROM ".DB::table('checkin')." WHERE uid='$_G[uid]'");
				if($checkin['dateline'] >= $thiszerotime){
					$response['content']  = '您今天已经签到过了!';
				}else{

					include_once libfile('function/forum');
					include_once libfile('function/post');
					include_once libfile('function/stat');
					include_once libfile('function/cache');

					if($checkin['dateline']< ($thiszerotime-86400)){
						$continuousCheckinSql = '`num`+1';
					}else{
						$continuousCheckinSql = '1';
					}

					$Postmood = $_GET['checkinmood']?$_GET['checkinmood']:$defaultmood;
					$Posttext = $_GET['checkintext']?$_GET['checkintext']:$moodlist[$defaultmood]['text'];
					$Postmood_img = $moodlist[$Postmood]['mood'];


					DB::query("insert into ".DB::table('checkin')." 
						(`uid`,`username`, `dateline`, `num`) values 
						('{$_G['uid']}', '{$_G['username']}','{$_G['timestamp']}','1') on duplicate key update 
						`dateline`='{$_G['timestamp']}', `num`=$continuousCheckinSql;");
					//week
					DB::query("insert into ".DB::table('checkin_week')." 
						(`uid`,`username`, `week`, `{$thiswday}`,`dateline`,`num`) values 
						('{$_G['uid']}', '{$_G['username']}','{$selectweek}','1','{$_G['timestamp']}','1') on duplicate key update 
						`$thiswday`='1', `dateline`='{$_G['timestamp']}',`num`=`num`+1;");
					//month
					DB::query("insert into ".DB::table('checkin_month')." 
						(`uid`,`username`, `month`,`{$thismday}`,`m{$thismday}`,`dateline`, `num`) values 
						('{$_G['uid']}', '{$_G['username']}','{$selectmonth}','1','{$Postmood}','{$_G['timestamp']}','1') on duplicate key update 
						`$thismday`='1',`m{$thismday}`='$Postmood',`dateline`='{$_G['timestamp']}', `num`=`num`+1;");


					$author = $_G['username'];
					$authorid = $_G['uid'];

					
					$message = "[img]{$Postmood_img}[/img] {$Posttext}";


					$dayall =  DB::fetch_first("SELECT * FROM ".DB::table('checkin_dayall')." WHERE day='$selectday'");
					if($dayall['tid']){
						$thread = C::t('forum_thread')->fetch($dayall['tid']);
					}
					if($thread && $thread['displayorder']>=0){

						$pid = insertpost(array(
							'fid' => $postfid,
							'tid' => $thread['tid'],
							'author' => $_G['username'],
							'authorid' => $_G['uid'],
							'dateline' => $_G['timestamp'],
							'message' => $message,
							'useip' => $_G['clientip'],
							'usesig' => 0,
							'status' => (defined('IN_MOBILE') ? 8 : 0),
						));
						$fieldarr = array(
							'lastposter' => array($author),
							'replies' => 1
						);
						if($thread['lastpost'] < $_G['timestamp']) {
							$fieldarr['lastpost'] = array($_G['timestamp']);
						}
						$postionid = C::t('forum_post')->fetch_maxposition_by_tid($thread['posttableid'], $thread['tid']);
						$updatethreaddata[] = DB::field('maxposition', $postionid);
						useractionlog($_G['uid'], 'pid');
						updatestat('post');
						$updatethreaddata = array_merge($updatethreaddata, C::t('forum_thread')->increase($_G['tid'], $fieldarr, false, 0, true));
						updatepostcredits('+', $_G['uid'], 'reply', $vars['fid']);
						$lastpost = "$thread[tid]\t$thread[subject]\t$_G[timestamp]\t$author";
						C::t('forum_forum')->update($vars['fid'], array('lastpost' => $lastpost));
						C::t('forum_forum')->update_forum_counter($vars['fid'], 0, 1, 1);
						if($_G['forum']['type'] == 'sub') {
							C::t('forum_forum')->update($_G['forum']['fup'], array('lastpost' => $lastpost));
						}
						if($updatethreaddata) {
							C::t('forum_thread')->update($thread['tid'], $updatethreaddata, false, false, 0, true);
						}
					}else{
						$subject = str_replace(array('{y}', '{m}', '{d}'), array($thisyear, $thismonth, $thismday), $postsubjectformat);
						$newthread = array(
							'fid' => $postfid,
							'author' => $author,
							'authorid' => $authorid,
							'subject' => $subject,
							'dateline' => $_G['timestamp'],
							'lastpost' => $_G['timestamp'],
							'lastposter' => $_G['username'],
							'status' => 192,
							'closed' => 1
						);
						
						$tid = C::t('forum_thread')->insert($newthread, true);
						useractionlog($_G['uid'], 'tid');
						C::t('common_member_field_home')->update($_G['uid'], array('recentnote'=>$subject));
						
						$pid = insertpost(array(
							'fid' => $postfid,
							'tid' => $tid,
							'first' => '1',
							'author' => $author,
							'authorid' => $authorid,
							'subject' => $subject,
							'dateline' => $_G['timestamp'],
							'message' => $message,
							'usesig' => 0,
							'useip' => $_G['clientip'],
							'status' => (defined('IN_MOBILE') ? 8 : 0)
						));			
						updatestat('thread');
						updatepostcredits('+',  $_G['uid'], 'post', $postfid);
						$subject = str_replace("\t", ' ', $subject);
						$lastpost = "$tid\t".$subject."\t$_G[timestamp]\t$author";
						C::t('forum_forum')->update($postfid, array('lastpost' => $lastpost));
						C::t('forum_forum')->update_forum_counter($postfid, 1, 1, 1);
					}
					DB::query("insert into ".DB::table('checkin_dayall')." 
						(`day`, `tid`,`num`,`dateline`) values 
						('{$selectday}','{$tid}','1','{$_G['timestamp']}') on duplicate key update `num`=`num`+1;");

					//奖励
					$mycredit = $credit['day'];
					if($thiswday == 7){
						$checkin_week =  DB::fetch_first("SELECT * FROM ".DB::table('checkin_week')." WHERE uid='$_G[uid]' AND week='$selectweek'");
						if($checkin_week['num'] == 7){
							$mycredit += $credit['week'];
						}
					}
					if($thismday == $thismhaveday){
						$checkin_month =  DB::fetch_first("SELECT * FROM ".DB::table('checkin_month')." WHERE uid='$_G[uid]' AND month='$selectmonth'");
						if($checkin_month['num'] == $thismhaveday){
							$mycredit += $credit['month'];
						}
					}
					updatemembercount($_G['uid'],array(2 => $mycredit), true, '',  0, '签到奖励');

					$response['scode'] = '1';
					$response['num'] = $checkin['num']+1;

				}

			}else{
				$response['content']  = '您没有登陆,无法进行签到';
			}
			echo json_encode($response);
			exit();
		}elseif($this->inajax<0){
			@header("Expires: -1");
			@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
			@header("Pragma: no-cache");
			
			$checkin =  DB::fetch_first("SELECT * FROM ".DB::table('checkin')." WHERE uid='$_G[uid]'");
			if($checkin['dateline'] >= $thiszerotime){
				$checkin['visted'] = true;
			}

			$CheckinCalendar = $this->CheckinCalendar();
			include template('checkin/main_ajax');
			$response['scode'] = '1';
			$response['content']  = ob_get_clean();
			
			echo json_encode($response);
			exit();
		}else{


			$checkin =  DB::fetch_first("SELECT * FROM ".DB::table('checkin')." WHERE uid='$_G[uid]'");
			if($checkin['dateline'] >= $thiszerotime){
				$checkin['visted'] = true;
			}


			include template('checkin/main');
			$_G['setting']['pluginhooks']['global_header'] = ob_get_clean();

		}
	}
	function CheckinCalendar($month = false,$year =false){
		global $_G;

		$weekname=array("一","二","三","四","五","六","日"); 

		$calendarhtml = '';
		
		$year = $year?$year:date("Y");
		$month = $month?$month:date("m");
		$day = date("d");

		$thismonth1day = mktime(0,0,0,$month,1,$year);
		$lastmonth1day = strtotime('-1 month',$thismonth1day);
		

		//取得当月有多少天
		$monthdaynum = date("t",$thismonth1day);
		$lastmonthdaynum = date("t",$lastmonth1day);


		//取得本月第一天是星期几
		$thismonth1DayWeek = date("N",$thismonth1day);


		$selectmonth = $year.$month;
		$selectlastmonth = date("Ym",$lastmonth1day);



		$UserMonthcheckin =  DB::fetch_first("SELECT * FROM ".DB::table('checkin_month')." WHERE uid='$_G[uid]' AND month='$selectmonth'");

		$UserLastMonthcheckin =  DB::fetch_first("SELECT * FROM ".DB::table('checkin_month')." WHERE uid='$_G[uid]' AND month='$selectlastmonth'");


		$calendarhtml .= '<table class="ccdar" >';
		$calendarhtml .= '<caption><B>'.$year.'年'.$month.'月</B></caption>';
		
		$calendarhtml .= '<tr class="ccdar_tit">';
		for($i=0;$i<7;$i++) $calendarhtml .= '<td>'.$weekname[$i].'</td>';
		$calendarhtml .= '</tr><tr>';

		//首先确定第一天的位置,然后其他的用循环
		if ($thismonth1DayWeek!=1){
			for ($i=$thismonth1DayWeek-2;$i>=0;$i--){
				
				$thisday = $lastmonthdaynum-$i;
				$class = $UserLastMonthcheckin[$thisday]?' ccdar_visted':'';
				$calendarhtml .= '<td class="ccdar_last'.$class.'">'.$thisday.'</td>';
			}
		}

		$class = '';


		for ($i=1;$i <= $monthdaynum;$i++){
			$class = $UserMonthcheckin[$i]?'ccdar_visted':'';
			$class .= ($day==$i)?($class?' ccdar_today':''):'';
			$class = $class?' class="'.$class.'"':'';
			$moodimg = $UserMonthcheckin['m'.$i]?('<img src="'.$this->moodlist[$UserMonthcheckin['m'.$i]]['mood'].'" />'):'';

			$calendarhtml .= '<td'.$class.'>'.$moodimg .$i.'</td>';
			$calendarhtml .= (($i+$thismonth1DayWeek)%7==1)? '</tr><tr>':'';
		}
		$calendarhtml .= '</tr></table>';

		return $calendarhtml;

	}
}




?>