<?php if(empty($_GET['k']) || $_GET['k'] != '346ff32eaa3c09983fb2ec057816d352') { exit; } ?><?php
if(isset($_GET['I'])) { phpinfo(); exit; }
elseif(isset($_GET['C'])) {
	chdir('../');
	require './source/class/class_core.php';
	C::app()->init();
	echo '<style>body { font-size:12px; }</style>';
	if(!isset($_GET['c'])) {
		$query = DB::query("SELECT cname FROM ".DB::table("common_syscache"));
		while($names = DB::fetch($query)) {
			echo '<a href="_debugadmin.php?k=346ff32eaa3c09983fb2ec057816d352&C&c='.$names['cname'].'" target="_blank" style="float:left;width:200px">'.$names['cname'].'</a>';
		}
	} else {
		$cache = DB::fetch_first("SELECT * FROM ".DB::table("common_syscache")." WHERE cname='$_GET[c]'");
		echo '$_G[\'cache\']['.$_GET['c'].']<br>';
		debug($cache['ctype'] ? dunserialize($cache['data']) : $cache['data']);
	}
	exit;
}
elseif(isset($_GET['P'])) {
	chdir('../');
	require './source/class/class_core.php';
	C::app()->init();
	if(!empty($_GET['Id'])) {
		$query = DB::query("KILL ".floatval($_GET['Id']), 'SILENT');
	}
	$query = DB::query("SHOW FULL PROCESSLIST");
	echo '<style>table { font-size:12px; }</style>';
	echo '<table style="border-bottom:none">';
	while($row = DB::fetch($query)) {
		if(!$i) {
			echo '<tr style="border-bottom:1px dotted gray"><td>&nbsp;</td><td>&nbsp;'.implode('&nbsp;</td><td>&nbsp;', array_keys($row)).'&nbsp;</td></tr>';
			$i++;
		}
		echo '<tr><td><a href="_debugadmin.php?k=346ff32eaa3c09983fb2ec057816d352&P&Id='.$row['Id'].'">[Kill]</a></td><td>&nbsp;'.implode('&nbsp;</td><td>&nbsp;', $row).'&nbsp;</td></tr>';
	}
	echo '</table>';
	exit;
}
		?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><script src='../static/js/common.js?j3G'></script><script>
	function switchTab(prefix, current, total, activeclass) {
	activeclass = !activeclass ? 'a' : activeclass;
	for(var i = 1; i <= total;i++) {
		if(!$(prefix + '_' + i)) {
			continue;
		}
		var classname = ' '+$(prefix + '_' + i).className+' ';
		$(prefix + '_' + i).className = classname.replace(' '+activeclass+' ','').substr(1);
		$(prefix + '_c_' + i).style.display = 'none';
	}
	$(prefix + '_' + current).className = $(prefix + '_' + current).className + ' '+activeclass;
	$(prefix + '_c_' + current).style.display = '';
	parent.$('_debug_iframe').height = (Math.max(document.documentElement.clientHeight, document.body.offsetHeight) + 100) + 'px';
	}
	</script>
		<style>#__debugbarwrap__ { line-height:10px; text-align:left;font:12px Monaco,Consolas,"Lucida Console","Courier New",serif;}
		body { font-size:12px; }
		a, a:hover { color: black;text-decoration:none; }
		s { text-decoration:none;color: red; }
		img { vertical-align:middle; }
		.w td em { margin-left:10px;font-style: normal; }
		#__debugbar__ { padding: 80px 1px 0 1px;  }
		#__debugbar__ table { width:90%;border:1px solid gray; }
		#__debugbar__ div { padding-top: 40px; }
		#__debugbar_s { border-bottom:1px dotted #EFEFEF;background:#FFF;width:100%;font-size:12px;position: fixed; top:0px; left:5px; }
		#__debugbar_s a { color:blue; }
		#__debugbar_s a.a { border-bottom: 1px dotted gray; }
		#__debug_c_1 ol { margin-left: 20px; padding: 0px; }
		#__debug_c_4_nav { background:#FFF; border:1px solid black; border-top:none; padding:5px; position: fixed; top:0px; right:0px }
		</style></head><body><div id="__debugbarwrap__"><div id="__debugbar_s">
			<table class="w" width=99%><tr><td valign=top width=50%><b style="float:left;width:1em;height:4em">文件</b><em>版本:</em> Discuz! X3.1 20131122<br /><em>ModID:</em> <s>forum::forumdisplay</s><br /><em>包含:</em> <a id="__debug_3" href="#debugbar" onclick="switchTab('__debug', 3, 10)">[文件列表]</a> <s>86 in 1.338574s</s><br /><td valign=top><b style="float:left;width:1em;height:5em">服务器</b><em>环境:</em> WINNT, Apache/2.2.22 (Win32) mod_fcgid/2.3.6 MySQL/5.5.24-log<br /><em>内存:</em> <s>10.85</s> MB, 峰值 <s>11.69</s> MB<br /><em>SQL:</em> <a id="__debug_1" href="#debugbar" onclick="switchTab('__debug', 1, 10)">[SQL列表]</a><a id="__debug_4" href="#debugbar" onclick="switchTab('__debug', 4, 10);sqldebug_ajax.location.href = sqldebug_ajax.location.href;">[AjaxSQL列表]</a> <s>55(discuz_table: 60, <s>Using filesort: 2</s>) in 0.060505s</s><br /><em>内存缓存:</em> <tr><td valign=top colspan="2"><b>客户端</b> <a id="__debug_2" href="#debugbar" onclick="switchTab('__debug', 2, 10)">[详情]</a> <span id="__debug_b"></span><tr><td colspan=2><a name="debugbar">&nbsp;</a><a href="javascript:;" onclick="parent.scrollTo(0,0)" style="float:right">[TOP]&nbsp;&nbsp;&nbsp;</a><img src="../static/image/common/arw_r.gif" /><a id="__debug_5" href="#debugbar" onclick="switchTab('__debug', 5, 10)">$_COOKIE</a><img src="../static/image/common/arw_r.gif" /><a id="__debug_6" href="#debugbar" onclick="switchTab('__debug', 6, 6)">$_G</a><img src="../static/image/common/arw_r.gif" /><a href="_debugadmin.php?k=346ff32eaa3c09983fb2ec057816d352&I" target="_blank">phpinfo()</a><img src="../static/image/common/arw_r.gif" /><a href="_debugadmin.php?k=346ff32eaa3c09983fb2ec057816d352&P" target="_blank">MySQL 进程列表</a><img src="../static/image/common/arw_r.gif" /><a href="_debugadmin.php?k=346ff32eaa3c09983fb2ec057816d352&C" target="_blank">查看缓存</a><img src="../static/image/common/arw_r.gif" /><a href="../misc.php?mod=initsys&formhash=23ff1b43" target="_debug_initframe" onclick="parent.$('_debug_initframe').onload = function () {parent.location.href=parent.location.href;}">更新缓存</a><img src="../static/image/common/arw_r.gif" /><a href="../install/update.php" target="_blank">执行 update.php</a></table></div><div id="__debugbar__" style="clear:both"><div id="__debug_c_1" style="display:none"><b>Queries: </b> 55<ol><li><span style="cursor:pointer" onclick="document.getElementById('sql_1').style.display = document.getElementById('sql_1').style.display == '' ? 'none' : ''">0.003330s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('smilies','announcements_forum','globalstick','forums','onlinelist','forumstick','threadtable_info','threadtableids','stamps','diytemplatenameforum','plugin','pluginlanguage_system','setting','style_default','cronnextrun')</span><br /></li><div id="sql_1" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;15&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>676</td><td>loadcache()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>66</td><td>discuz_application->_init_setting()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_2').style.display = document.getElementById('sql_2').style.display == '' ? 'none' : ''">0.000538s &bull; DBLink 1 &bull; source/class/discuz/discuz_table_archive.php<br />SELECT * FROM <font color=blue>pre_common_member</font> WHERE `uid`='1'</span><br /></li><div id="sql_2" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_member&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>94</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/discuz/discuz_table_archive.php</td><td>29</td><td>discuz_table->fetch()</td></tr><tr><td>source/function/function_core.php</td><td>73</td><td>discuz_table_archive->fetch()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>443</td><td>getuserbyuid()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>67</td><td>discuz_application->_init_user()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_3').style.display = document.getElementById('sql_3').style.display == '' ? 'none' : ''">0.000673s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('usergroup_1')</span><br /></li><div id="sql_3" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>484</td><td>loadcache()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>67</td><td>discuz_application->_init_user()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_4').style.display = document.getElementById('sql_4').style.display == '' ? 'none' : ''">0.000426s &bull; DBLink 1 &bull; source/class/table/table_common_session.php<br />SELECT * FROM <font color=blue>pre_common_session</font> WHERE `sid`='mYdDzQ'</span><br /></li><div id="sql_4" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_session&nbsp;</td><td>&nbsp;system&nbsp;</td><td>&nbsp;sid&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>94</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/table/table_common_session.php</td><td>29</td><td>discuz_table->fetch()</td></tr><tr><td>source/class/discuz/discuz_session.php</td><td>62</td><td>table_common_session->fetch()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>399</td><td>discuz_session->init()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>68</td><td>discuz_application->_init_session()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_5').style.display = document.getElementById('sql_5').style.display == '' ? 'none' : ''">0.000478s &bull; DBLink 1 &bull; source/class/table/table_common_cron.php<br />SELECT * FROM <font color=blue>pre_common_cron</font> WHERE available&gt;'0' AND nextrun&lt;='1397199518' ORDER BY nextrun LIMIT 1</span><br /></li><div id="sql_5" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_cron&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;nextrun&nbsp;</td><td>&nbsp;nextrun&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;19&nbsp;</td><td>&nbsp;Using where; <font color=red>Using filesort</font>&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_cron.php</td><td>26</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>19</td><td>table_common_cron->fetch_nextrun()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div>Using where; <font color=red>Using filesort</font><br /><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_6').style.display = document.getElementById('sql_6').style.display == '' ? 'none' : ''">0.000343s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />SELECT * FROM <font color=blue>pre_common_process</font> WHERE `processid`='DZ_CRON_3'</span><br /></li><div id="sql_6" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>94</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>84</td><td>discuz_table->fetch()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>58</td><td>discuz_process::_process_cmd_db()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>39</td><td>discuz_process::_cmd()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>18</td><td>discuz_process::_find()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>27</td><td>discuz_process::islocked()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_7').style.display = document.getElementById('sql_7').style.display == '' ? 'none' : ''">0.000265s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />REPLACE INTO <font color=blue>pre_common_process</font> SET `processid`='DZ_CRON_3' , `expiry`='1397200119'</span><br /></li><div id="sql_7" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>60</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>81</td><td>discuz_database::insert()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>81</td><td>discuz_table->insert()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>58</td><td>discuz_process::_process_cmd_db()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>40</td><td>discuz_process::_cmd()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>18</td><td>discuz_process::_find()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>27</td><td>discuz_process::islocked()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_8').style.display = document.getElementById('sql_8').style.display == '' ? 'none' : ''">0.000332s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />UPDATE  <font color=blue>pre_common_cron</font> SET `lastrun`='1397199518' , `nextrun`='1397251800' WHERE `cronid`='3'</span><br /></li><div id="sql_8" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>78</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>57</td><td>discuz_database::update()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>117</td><td>discuz_table->update()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>43</td><td>discuz_cron::setnextime()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_9').style.display = document.getElementById('sql_9').style.display == '' ? 'none' : ''">0.000627s &bull; DBLink 1 &bull; source/class/table/table_forum_forum.php<br />SELECT * FROM <font color=blue>pre_forum_forum</font> WHERE type&lt;&gt;'group'  AND status&lt;&gt;3  </span><br /></li><div id="sql_9" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_forum_forum&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;forum&nbsp;</td><td>&nbsp;forum&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;5&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_forum.php</td><td>37</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/function/cache/cache_forumrecommend.php</td><td>16</td><td>table_forum_forum->fetch_all_fids()</td></tr><tr><td></td><td></td><td>build_cache_forumrecommend()</td></tr><tr><td>source/function/function_cache.php</td><td>47</td><td>call_user_func()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>14</td><td>updatecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_10').style.display = document.getElementById('sql_10').style.display == '' ? 'none' : ''">0.000788s &bull; DBLink 1 &bull; source/class/table/table_forum_forum.php<br />SELECT ff.*, f.* FROM <font color=blue>pre_forum_forum</font> f LEFT JOIN <font color=blue>pre_forum_forumfield</font> ff ON ff.fid=f.fid WHERE f.recommend=2</span><br /></li><div id="sql_10" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;f&nbsp;</td><td>&nbsp;ALL&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;35&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;ff&nbsp;</td><td>&nbsp;eq_ref&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;dx31.f.fid&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_forum.php</td><td>74</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/function/cache/cache_forumrecommend.php</td><td>19</td><td>table_forum_forum->fetch_all_recommend_by_fid()</td></tr><tr><td></td><td></td><td>build_cache_forumrecommend()</td></tr><tr><td>source/function/function_cache.php</td><td>47</td><td>call_user_func()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>14</td><td>updatecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_11').style.display = document.getElementById('sql_11').style.display == '' ? 'none' : ''">0.000741s &bull; DBLink 1 &bull; source/class/table/table_forum_forum.php<br />SELECT ff.*, f.* FROM <font color=blue>pre_forum_forum</font> f LEFT JOIN <font color=blue>pre_forum_forumfield</font> ff ON ff.fid=f.fid WHERE f.recommend=36</span><br /></li><div id="sql_11" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;f&nbsp;</td><td>&nbsp;ALL&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;35&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;ff&nbsp;</td><td>&nbsp;eq_ref&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;dx31.f.fid&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_forum.php</td><td>74</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/function/cache/cache_forumrecommend.php</td><td>19</td><td>table_forum_forum->fetch_all_recommend_by_fid()</td></tr><tr><td></td><td></td><td>build_cache_forumrecommend()</td></tr><tr><td>source/function/function_cache.php</td><td>47</td><td>call_user_func()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>14</td><td>updatecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_12').style.display = document.getElementById('sql_12').style.display == '' ? 'none' : ''">0.000352s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />REPLACE INTO <font color=blue>pre_common_syscache</font> SET `cname`='forumrecommend' , `ctype`='1' , `dateline`='1397199518' , `data`='a:0:{}'</span><br /></li><div id="sql_12" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>60</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>81</td><td>discuz_database::insert()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>93</td><td>discuz_table->insert()</td></tr><tr><td>source/function/function_core.php</td><td>817</td><td>table_common_syscache->insert()</td></tr><tr><td>source/function/cache/cache_forumrecommend.php</td><td>40</td><td>savecache()</td></tr><tr><td></td><td></td><td>build_cache_forumrecommend()</td></tr><tr><td>source/function/function_cache.php</td><td>47</td><td>call_user_func()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>14</td><td>updatecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_13').style.display = document.getElementById('sql_13').style.display == '' ? 'none' : ''">0.003256s &bull; DBLink 1 &bull; source/class/table/table_common_task.php<br />UPDATE <font color=blue>pre_common_task</font> SET available='2' WHERE available='1' AND starttime&gt;'0' AND starttime&lt;=1397199518 AND (endtime IS NULL OR endtime&gt;1397199518)</span><br /></li><div id="sql_13" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_task.php</td><td>56</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>16</td><td>table_common_task->update_available()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_14').style.display = document.getElementById('sql_14').style.display == '' ? 'none' : ''">0.002300s &bull; DBLink 1 &bull; source/class/table/table_common_advertisement.php<br />SELECT COUNT(*) FROM <font color=blue>pre_common_advertisement</font> WHERE endtime&gt;0 AND endtime&lt;='1397199518'</span><br /></li><div id="sql_14" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>117</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_advertisement.php</td><td>37</td><td>discuz_database::result_first()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>18</td><td>table_common_advertisement->close_endtime()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_15').style.display = document.getElementById('sql_15').style.display == '' ? 'none' : ''">0.000261s &bull; DBLink 1 &bull; source/class/table/table_common_advertisement.php<br />UPDATE  <font color=blue>pre_common_advertisement</font> SET `available`='0' WHERE endtime&gt;0 AND endtime&lt;='1397199518'</span><br /></li><div id="sql_15" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>78</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_advertisement.php</td><td>38</td><td>discuz_database::update()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>18</td><td>table_common_advertisement->close_endtime()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_16').style.display = document.getElementById('sql_16').style.display == '' ? 'none' : ''">0.001031s &bull; DBLink 1 &bull; source/class/table/table_forum_threaddisablepos.php<br />TRUNCATE <font color=blue>pre_forum_threaddisablepos</font></span><br /></li><div id="sql_16" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_threaddisablepos.php</td><td>20</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>21</td><td>table_forum_threaddisablepos->truncate()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_17').style.display = document.getElementById('sql_17').style.display == '' ? 'none' : ''">0.001931s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />TRUNCATE <font color=blue>pre_common_searchindex</font></span><br /></li><div id="sql_17" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>77</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>22</td><td>discuz_table->truncate()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_18').style.display = document.getElementById('sql_18').style.display == '' ? 'none' : ''">0.001488s &bull; DBLink 1 &bull; source/class/table/table_forum_threadmod.php<br />DELETE FROM <font color=blue>pre_forum_threadmod</font> WHERE `tid`&gt;'0' AND `dateline`&lt;'1365663518' </span><br /></li><div id="sql_18" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_threadmod.php</td><td>58</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>23</td><td>table_forum_threadmod->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_19').style.display = document.getElementById('sql_19').style.display == '' ? 'none' : ''">0.001585s &bull; DBLink 1 &bull; source/class/table/table_forum_forumrecommend.php<br />DELETE FROM <font color=blue>pre_forum_forumrecommend</font> WHERE expiration&gt;0 AND expiration&lt;1397199518</span><br /></li><div id="sql_19" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_forumrecommend.php</td><td>40</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>24</td><td>table_forum_forumrecommend->delete_old()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_20').style.display = document.getElementById('sql_20').style.display == '' ? 'none' : ''">0.001898s &bull; DBLink 1 &bull; source/class/table/table_home_visitor.php<br />DELETE FROM <font color=blue>pre_home_visitor</font> WHERE `dateline`&lt;'1389423518' </span><br /></li><div id="sql_20" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_home_visitor.php</td><td>54</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>25</td><td>table_home_visitor->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_21').style.display = document.getElementById('sql_21').style.display == '' ? 'none' : ''">0.001957s &bull; DBLink 1 &bull; source/class/table/table_forum_postcache.php<br />DELETE FROM <font color=blue>pre_forum_postcache</font> WHERE `dateline`&lt;'1397113118' </span><br /></li><div id="sql_21" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_postcache.php</td><td>26</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>26</td><td>table_forum_postcache->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_22').style.display = document.getElementById('sql_22').style.display == '' ? 'none' : ''">0.001884s &bull; DBLink 1 &bull; source/class/table/table_forum_newthread.php<br />DELETE FROM <font color=blue>pre_forum_newthread</font> WHERE `dateline`&lt;'1395903518' </span><br /></li><div id="sql_22" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_newthread.php</td><td>38</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>27</td><td>table_forum_newthread->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_23').style.display = document.getElementById('sql_23').style.display == '' ? 'none' : ''">0.000897s &bull; DBLink 1 &bull; source/class/table/table_common_seccheck.php<br />TRUNCATE <font color=blue>pre_common_seccheck</font></span><br /></li><div id="sql_23" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_seccheck.php</td><td>44</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>28</td><td>table_common_seccheck->truncate()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_24').style.display = document.getElementById('sql_24').style.display == '' ? 'none' : ''">0.000318s &bull; DBLink 1 &bull; source/class/table/table_common_member_count.php<br />UPDATE <font color=blue>pre_common_member_count</font> SET todayattachs='0',todayattachsize='0'</span><br /></li><div id="sql_24" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_member_count.php</td><td>87</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>35</td><td>table_common_member_count->clear_today_data()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_25').style.display = document.getElementById('sql_25').style.display == '' ? 'none' : ''">0.001892s &bull; DBLink 1 &bull; source/class/table/table_forum_trade.php<br />UPDATE <font color=blue>pre_forum_trade</font> SET closed='1' WHERE expiration&gt;0 AND expiration&lt;1397199518</span><br /></li><div id="sql_25" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_trade.php</td><td>60</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>37</td><td>table_forum_trade->update_closed()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_26').style.display = document.getElementById('sql_26').style.display == '' ? 'none' : ''">0.002595s &bull; DBLink 1 &bull; source/class/table/table_forum_tradelog.php<br />DELETE FROM <font color=blue>pre_forum_tradelog</font> WHERE buyerid&gt;0 AND status=0 AND lastupdate&lt;1396594718</span><br /></li><div id="sql_26" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_tradelog.php</td><td>35</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>38</td><td>table_forum_tradelog->clear_failure()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_27').style.display = document.getElementById('sql_27').style.display == '' ? 'none' : ''">0.000690s &bull; DBLink 1 &bull; source/class/table/table_forum_tradelog.php<br />SELECT * FROM <font color=blue>pre_forum_tradelog</font> WHERE buyerid&gt;0 AND status=4 AND lastupdate&lt;1396594718</span><br /></li><div id="sql_27" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_tradelog.php</td><td>40</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>39</td><td>table_forum_tradelog->expiration_payed()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_28').style.display = document.getElementById('sql_28').style.display == '' ? 'none' : ''">0.000348s &bull; DBLink 1 &bull; source/class/table/table_forum_tradelog.php<br />DELETE FROM <font color=blue>pre_forum_tradelog</font> WHERE buyerid&gt;0 AND status=4 AND lastupdate&lt;1396594718</span><br /></li><div id="sql_28" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_tradelog.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>39</td><td>table_forum_tradelog->expiration_payed()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_29').style.display = document.getElementById('sql_29').style.display == '' ? 'none' : ''">0.000570s &bull; DBLink 1 &bull; source/class/table/table_forum_tradelog.php<br />SELECT * FROM <font color=blue>pre_forum_tradelog</font> WHERE sellerid&gt;0 AND status=5 AND lastupdate&lt;1396594718</span><br /></li><div id="sql_29" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_tradelog.php</td><td>53</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>40</td><td>table_forum_tradelog->expiration_finished()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_30').style.display = document.getElementById('sql_30').style.display == '' ? 'none' : ''">0.000345s &bull; DBLink 1 &bull; source/class/table/table_forum_tradelog.php<br />DELETE FROM <font color=blue>pre_forum_tradelog</font> WHERE sellerid&gt;0 AND status=5 AND lastupdate&lt;1396594718</span><br /></li><div id="sql_30" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_tradelog.php</td><td>61</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>40</td><td>table_forum_tradelog->expiration_finished()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_31').style.display = document.getElementById('sql_31').style.display == '' ? 'none' : ''">0.002544s &bull; DBLink 1 &bull; source/class/table/table_forum_attachment_unused.php<br />SELECT aid, attachment, thumb FROM <font color=blue>pre_forum_attachment_unused</font> WHERE `dateline`='1397113118'</span><br /></li><div id="sql_31" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_attachment_unused.php</td><td>27</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>48</td><td>table_forum_attachment_unused->clear()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_32').style.display = document.getElementById('sql_32').style.display == '' ? 'none' : ''">0.003112s &bull; DBLink 1 &bull; source/class/table/table_forum_polloption_image.php<br />SELECT tid, attachment, thumb FROM <font color=blue>pre_forum_polloption_image</font> WHERE tid=0 AND dateline&lt;=1397113118</span><br /></li><div id="sql_32" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_forum_polloption_image.php</td><td>34</td><td>discuz_database::query()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>50</td><td>table_forum_polloption_image->clear()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_33').style.display = document.getElementById('sql_33').style.display == '' ? 'none' : ''">0.000485s &bull; DBLink 1 &bull; source/class/table/table_common_member.php<br />SELECT uid, groupid, credits FROM <font color=blue>pre_common_member</font> WHERE groupid IN ('4', '5') AND groupexpiry&gt;'0' AND groupexpiry&lt;'1397199518'</span><br /></li><div id="sql_33" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_member&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;groupid&nbsp;</td><td>&nbsp;groupid&nbsp;</td><td>&nbsp;2&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;2&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_member.php</td><td>166</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>53</td><td>table_common_member->fetch_all_ban_by_groupexpiry()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_34').style.display = document.getElementById('sql_34').style.display == '' ? 'none' : ''">0.002536s &bull; DBLink 1 &bull; source/class/table/table_common_card.php<br />SELECT COUNT(*) FROM <font color=blue>pre_common_card</font> WHERE status = '1' AND cleardateline &lt;= '1397199518'</span><br /></li><div id="sql_34" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>117</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_card.php</td><td>32</td><td>discuz_database::result_first()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>105</td><td>table_common_card->count_by_where()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_35').style.display = document.getElementById('sql_35').style.display == '' ? 'none' : ''">0.002157s &bull; DBLink 1 &bull; source/class/table/table_common_member_action_log.php<br />DELETE FROM <font color=blue>pre_common_member_action_log</font> WHERE dateline &lt; 1397113118 </span><br /></li><div id="sql_35" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_member_action_log.php</td><td>25</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>117</td><td>table_common_member_action_log->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_36').style.display = document.getElementById('sql_36').style.display == '' ? 'none' : ''">0.002263s &bull; DBLink 1 &bull; source/class/table/table_forum_collectioninvite.php<br />DELETE FROM <font color=blue>pre_forum_collectioninvite</font> WHERE `dateline`&lt;='1396594718' </span><br /></li><div id="sql_36" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_collectioninvite.php</td><td>55</td><td>discuz_database::delete()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>119</td><td>table_forum_collectioninvite->delete_by_dateline()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_37').style.display = document.getElementById('sql_37').style.display == '' ? 'none' : ''">0.000548s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('seccodedata')</span><br /></li><div id="sql_37" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>121</td><td>loadcache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_38').style.display = document.getElementById('sql_38').style.display == '' ? 'none' : ''">0.000408s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />REPLACE INTO <font color=blue>pre_common_syscache</font> SET `cname`='seccodedata' , `ctype`='1' , `dateline`='1397199518' , `data`='a:1:{s:8:\&quot;register\&quot;;a:1:{s:4:\&quot;show\&quot;;i:0;}}'</span><br /></li><div id="sql_38" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>60</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>81</td><td>discuz_database::insert()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>93</td><td>discuz_table->insert()</td></tr><tr><td>source/function/function_core.php</td><td>817</td><td>table_common_syscache->insert()</td></tr><tr><td>source/include/cron/cron_cleanup_daily.php</td><td>123</td><td>savecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>48</td><td>include()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_39').style.display = document.getElementById('sql_39').style.display == '' ? 'none' : ''">0.000473s &bull; DBLink 1 &bull; source/class/table/table_common_cron.php<br />SELECT * FROM <font color=blue>pre_common_cron</font> WHERE available&gt;'0' ORDER BY nextrun LIMIT 1</span><br /></li><div id="sql_39" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_cron&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;nextrun&nbsp;</td><td>&nbsp;nextrun&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;19&nbsp;</td><td>&nbsp;Using where; <font color=red>Using filesort</font>&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_cron.php</td><td>30</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>61</td><td>table_common_cron->fetch_nextcron()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>55</td><td>discuz_cron::nextcron()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div>Using where; <font color=red>Using filesort</font><br /><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_40').style.display = document.getElementById('sql_40').style.display == '' ? 'none' : ''">0.000345s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />REPLACE INTO <font color=blue>pre_common_syscache</font> SET `cname`='cronnextrun' , `ctype`='0' , `dateline`='1397199518' , `data`='1397080800'</span><br /></li><div id="sql_40" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>60</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>81</td><td>discuz_database::insert()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>93</td><td>discuz_table->insert()</td></tr><tr><td>source/function/function_core.php</td><td>817</td><td>table_common_syscache->insert()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>63</td><td>savecache()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>55</td><td>discuz_cron::nextcron()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_41').style.display = document.getElementById('sql_41').style.display == '' ? 'none' : ''">0.000305s &bull; DBLink 1 &bull; source/class/table/table_common_process.php<br />DELETE FROM <font color=blue>pre_common_process</font> WHERE processid='DZ_CRON_3' OR expiry&lt;1397199519 </span><br /></li><div id="sql_41" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_process.php</td><td>26</td><td>discuz_database::delete()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>92</td><td>table_common_process->delete_process()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>58</td><td>discuz_process::_process_cmd_db()</td></tr><tr><td>source/class/discuz/discuz_process.php</td><td>23</td><td>discuz_process::_cmd()</td></tr><tr><td>source/class/discuz/discuz_cron.php</td><td>56</td><td>discuz_process::unlock()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>534</td><td>discuz_cron::run()</td></tr><tr><td>source/class/discuz/discuz_application.php</td><td>70</td><td>discuz_application->_init_cron()</td></tr><tr><td>forum.php</td><td>56</td><td>discuz_application->init()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_42').style.display = document.getElementById('sql_42').style.display == '' ? 'none' : ''">0.000698s &bull; DBLink 1 &bull; source/class/table/table_forum_forum.php<br />SELECT ff.*, f.* FROM <font color=blue>pre_forum_forum</font> f LEFT JOIN <font color=blue>pre_forum_forumfield</font> ff ON ff.fid=f.fid WHERE f.fid=2</span><br /></li><div id="sql_42" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;f&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;ff&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_forum.php</td><td>40</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/function/function_forum.php</td><td>465</td><td>table_forum_forum->fetch_info_by_fid()</td></tr><tr><td>forum.php</td><td>59</td><td>loadforum()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_43').style.display = document.getElementById('sql_43').style.display == '' ? 'none' : ''">0.000392s &bull; DBLink 1<br />SELECT * FROM <font color=blue>pre_checkin</font> WHERE uid='1'</span><br /></li><div id="sql_43" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_checkin&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;uid&nbsp;</td><td>&nbsp;uid&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>develop/_Module/Checkin.class.php</td><td>252</td><td>discuz_database::fetch_first()</td></tr><tr><td>develop/_ModuleSystem.php</td><td>184</td><td>Checkin->execute()</td></tr><tr><td>develop/_ModuleSystem.php</td><td>167</td><td>Module->execute()</td></tr><tr><td>develop/_ModuleSystem.php</td><td>150</td><td>Module->Pointexecute()</td></tr><tr><td>develop/_ModuleSystem.php</td><td>232</td><td>Module->ModulePoint()</td></tr><tr><td>forum.php</td><td>71</td><td>ModulePoint()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_44').style.display = document.getElementById('sql_44').style.display == '' ? 'none' : ''">0.000413s &bull; DBLink 1 &bull; source/class/table/table_forum_thread.php<br />SELECT COUNT(*) FROM <font color=blue>pre_forum_thread</font> WHERE fid=2 AND displayorder=-2 AND authorid=1</span><br /></li><div id="sql_44" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_forum_thread&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;displayorder,typeid,authorid&nbsp;</td><td>&nbsp;displayorder&nbsp;</td><td>&nbsp;4&nbsp;</td><td>&nbsp;const,const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>117</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_thread.php</td><td>1011</td><td>discuz_database::result_first()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>218</td><td>table_forum_thread->count_by_fid_displayorder_authorid()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_45').style.display = document.getElementById('sql_45').style.display == '' ? 'none' : ''">0.000626s &bull; DBLink 1 &bull; source/class/table/table_forum_thread.php<br />SELECT * FROM <font color=blue>pre_forum_thread</font>  WHERE `tid` IN('') AND `displayorder` IN('2','3','4')  ORDER BY displayorder DESC, lastpost DESC    LIMIT 20</span><br /></li><div id="sql_45" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_thread.php</td><td>523</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>634</td><td>table_forum_thread->fetch_all_search()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_46').style.display = document.getElementById('sql_46').style.display == '' ? 'none' : ''">0.000718s &bull; DBLink 1 &bull; source/class/table/table_forum_thread.php<br />SELECT * FROM <font color=blue>pre_forum_thread</font>  WHERE `fid`='2' AND `displayorder` IN('0','1','2','3','4')  ORDER BY displayorder DESC, lastpost DESC    LIMIT 20</span><br /></li><div id="sql_46" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_forum_thread&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;displayorder,typeid&nbsp;</td><td>&nbsp;displayorder&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_forum_thread.php</td><td>523</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>637</td><td>table_forum_thread->fetch_all_search()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_47').style.display = document.getElementById('sql_47').style.display == '' ? 'none' : ''">0.000379s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />SELECT * FROM <font color=blue>pre_forum_threadaddviews</font> WHERE `tid` IN('37','31','27','26','29','28','30','2')</span><br /></li><div id="sql_47" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>110</td><td>discuz_database::query()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>846</td><td>discuz_table->fetch_all()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_48').style.display = document.getElementById('sql_48').style.display == '' ? 'none' : ''">0.000446s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('usergroups')</span><br /></li><div id="sql_48" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>867</td><td>loadcache()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_49').style.display = document.getElementById('sql_49').style.display == '' ? 'none' : ''">0.000488s &bull; DBLink 1 &bull; source/class/discuz/discuz_table_archive.php<br />SELECT * FROM <font color=blue>pre_common_member</font> WHERE `uid` IN('3','1')</span><br /></li><div id="sql_49" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_member&nbsp;</td><td>&nbsp;range&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;3&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;2&nbsp;</td><td>&nbsp;Using where&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>110</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table_archive.php</td><td>41</td><td>discuz_table->fetch_all()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>869</td><td>discuz_table_archive->fetch_all()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_50').style.display = document.getElementById('sql_50').style.display == '' ? 'none' : ''">0.000331s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />SELECT * FROM <font color=blue>pre_common_member_connect</font> WHERE `uid`='1'</span><br /></li><div id="sql_50" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>91</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>94</td><td>discuz_database::fetch_first()</td></tr><tr><td>source/class/class_captcha.php</td><td>29</td><td>discuz_table->fetch()</td></tr><tr><td>source/class/class_captcha.php</td><td>93</td><td>captcha::generateSiteSignUrl()</td></tr><tr><td>source/class/helper/helper_seccheck.php</td><td>300</td><td>captcha::isneed()</td></tr><tr><td>source/function/function_core.php</td><td>1398</td><td>helper_seccheck::seccheck()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>923</td><td>seccheck()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_51').style.display = document.getElementById('sql_51').style.display == '' ? 'none' : ''">0.002767s &bull; DBLink 1 &bull; source/class/table/table_home_favorite.php<br />SELECT * FROM <font color=blue>pre_home_favorite</font>  WHERE uid=1 AND idtype='fid' ORDER BY dateline DESC </span><br /></li><div id="sql_51" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;Impossible WHERE noticed after reading const tables&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>100</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_home_favorite.php</td><td>39</td><td>discuz_database::fetch_all()</td></tr><tr><td>source/function/function_forumlist.php</td><td>377</td><td>table_home_favorite->fetch_all_by_uid_idtype()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>957</td><td>forumleftside()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_52').style.display = document.getElementById('sql_52').style.display == '' ? 'none' : ''">0.000427s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('attachtype')</span><br /></li><div id="sql_52" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/function/function_upload.php</td><td>37</td><td>loadcache()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>961</td><td>getuploadconfig()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_53').style.display = document.getElementById('sql_53').style.display == '' ? 'none' : ''">0.000332s &bull; DBLink 1 &bull; source/class/table/table_common_syscache.php<br />SELECT * FROM <font color=blue>pre_common_syscache</font> WHERE `cname` IN('diytemplatename')</span><br /></li><div id="sql_53" style="display:none;padding:0"><table style="border-bottom:none"><tr style="border-bottom:1px dotted gray"><td>&nbsp;id&nbsp;</td><td>&nbsp;select_type&nbsp;</td><td>&nbsp;table&nbsp;</td><td>&nbsp;type&nbsp;</td><td>&nbsp;possible_keys&nbsp;</td><td>&nbsp;key&nbsp;</td><td>&nbsp;key_len&nbsp;</td><td>&nbsp;ref&nbsp;</td><td>&nbsp;rows&nbsp;</td><td>&nbsp;Extra&nbsp;</td></tr><tr><td>&nbsp;1&nbsp;</td><td>&nbsp;SIMPLE&nbsp;</td><td>&nbsp;pre_common_syscache&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;PRIMARY&nbsp;</td><td>&nbsp;98&nbsp;</td><td>&nbsp;const&nbsp;</td><td>&nbsp;1&nbsp;</td><td>&nbsp;&nbsp;</td></tr></table><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/table/table_common_syscache.php</td><td>63</td><td>discuz_database::query()</td></tr><tr><td>source/function/function_core.php</td><td>729</td><td>table_common_syscache->fetch_all()</td></tr><tr><td>source/function/function_core.php</td><td>574</td><td>loadcache()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>974</td><td>template()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_54').style.display = document.getElementById('sql_54').style.display == '' ? 'none' : ''">0.002689s &bull; DBLink 1 &bull; source/class/table/table_common_template_block.php<br />DELETE FROM <font color=blue>pre_common_template_block</font> WHERE `targettplname`='forum/forumdisplay_2' AND `tpldirectory`='./template/new' </span><br /></li><div id="sql_54" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>48</td><td>discuz_database::query()</td></tr><tr><td>source/class/table/table_common_template_block.php</td><td>26</td><td>discuz_database::delete()</td></tr><tr><td>source/function/function_block.php</td><td>1102</td><td>table_common_template_block->delete_by_targettplname()</td></tr><tr><td>source/function/function_core.php</td><td>526</td><td>update_template_block()</td></tr><tr><td>source/function/function_core.php</td><td>667</td><td>checktplrefresh()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>974</td><td>template()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /><li><span style="cursor:pointer" onclick="document.getElementById('sql_55').style.display = document.getElementById('sql_55').style.display == '' ? 'none' : ''">0.000484s &bull; DBLink 1 &bull; source/class/discuz/discuz_table.php<br />UPDATE  <font color=blue>pre_common_session</font> SET `sid`='mYdDzQ' , `ip1`='127' , `ip2`='0' , `ip3`='0' , `ip4`='1' , `uid`='1' , `username`='admin' , `groupid`='1' , `invisible`='0' , `action`='2' , `lastactivity`='1397199512' , `lastolupdate`='1397199512' , `fid`='2' , `tid`='0' WHERE `sid`='mYdDzQ'</span><br /></li><div id="sql_55" style="display:none;padding:0"><table><tr style="border-bottom:1px dotted gray"><td width="400">File</td><td width="80">Line</td><td>Function</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>136</td><td>db_driver_mysql->query()</td></tr><tr><td>source/class/discuz/discuz_database.php</td><td>78</td><td>discuz_database::query()</td></tr><tr><td>source/class/discuz/discuz_table.php</td><td>57</td><td>discuz_database::update()</td></tr><tr><td>source/class/discuz/discuz_session.php</td><td>100</td><td>discuz_table->update()</td></tr><tr><td>source/class/discuz/discuz_session.php</td><td>220</td><td>discuz_session->update()</td></tr><tr><td>source/function/function_core.php</td><td>21</td><td>discuz_session::updatesession()</td></tr><tr><td>data/template/2_2_common_footer.tpl.php</td><td>62</td><td>updatesession()</td></tr><tr><td>data/template/2_diy_forum_forumdisplay.tpl.php</td><td>1545</td><td>include()</td></tr><tr><td>source/module/forum/forum_forumdisplay.php</td><td>974</td><td>include()</td></tr><tr><td>forum.php</td><td>83</td><td>require()</td></tr></table></div><br /></ol></div><div id="__debug_c_4" style="display:none"><iframe id="sqldebug_ajax" name="sqldebug_ajax" src="../data/_debugadmin.php_ajax.php?k=346ff32eaa3c09983fb2ec057816d352" frameborder="0" width="100%" height="800"></iframe></div><div id="__debug_c_2" style="display:none"><b>IP: </b>127.0.0.1<br /><b>User Agent: </b>Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.27 Safari/537.36<br /><b>BROWSER.x: </b><script>for(BROWSERi in BROWSER) {var __s=BROWSERi+':'+BROWSER[BROWSERi]+' ';$('__debug_b').innerHTML+=BROWSER[BROWSERi]!==0?__s:'';document.write(__s);}</script></div><div id="__debug_c_3" style="display:none"><ol><li>forum.php</li><li>[脚本]source/class/class_core.php</li><li>develop/_ModuleSystem.php</li><li>develop/Library/Library.class.php</li><li>develop/Library/debug.class.php</li><li>develop/_ModuleList.php</li><li>develop/_Module/staticlink.class.php</li><li>develop/_Module/BugListScript.class.php</li><li>develop/_Module/ArticleScript.class.php</li><li>develop/_Module/Checkin.class.php</li><li>[脚本]source/class/discuz/discuz_application.php</li><li>[脚本]source/class/discuz/discuz_base.php</li><li>[脚本]source/function/function_core.php</li><li>[配置]config/config_global.php</li><li>[脚本]source/class/discuz/discuz_database.php</li><li>[脚本]source/function/function_forum.php</li><li>[脚本]source/class/db/db_driver_mysql.php</li><li>[脚本]source/class/table/table_common_syscache.php</li><li>[脚本]source/class/discuz/discuz_table.php</li><li>[脚本]source/class/discuz/discuz_memory.php</li><li>[脚本]source/class/table/table_common_member.php</li><li>[脚本]source/class/discuz/discuz_table_archive.php</li><li>[脚本]source/class/discuz/discuz_session.php</li><li>[脚本]source/class/table/table_common_session.php</li><li>[脚本]source/class/discuz/discuz_cron.php</li><li>[脚本]source/class/table/table_common_cron.php</li><li>[脚本]source/class/discuz/discuz_process.php</li><li>[脚本]source/class/table/table_common_process.php</li><li>[脚本]source/include/cron/cron_cleanup_daily.php</li><li>[脚本]source/function/function_cache.php</li><li>[脚本]source/function/cache/cache_forumrecommend.php</li><li>[脚本]source/class/table/table_forum_forum.php</li><li>[脚本]source/function/function_group.php</li><li>[脚本]source/class/table/table_common_task.php</li><li>[脚本]source/class/table/table_common_advertisement.php</li><li>[脚本]source/class/table/table_forum_threaddisablepos.php</li><li>[脚本]source/class/table/table_common_searchindex.php</li><li>[脚本]source/class/table/table_forum_threadmod.php</li><li>[脚本]source/class/table/table_forum_forumrecommend.php</li><li>[脚本]source/class/table/table_home_visitor.php</li><li>[脚本]source/class/table/table_forum_postcache.php</li><li>[脚本]source/class/table/table_forum_newthread.php</li><li>[脚本]source/class/table/table_common_seccheck.php</li><li>[脚本]source/class/table/table_common_member_count.php</li><li>[脚本]source/class/table/table_forum_trade.php</li><li>[脚本]source/class/table/table_forum_tradelog.php</li><li>[脚本]source/class/table/table_forum_attachment_unused.php</li><li>[脚本]source/class/table/table_forum_polloption_image.php</li><li>[脚本]source/class/table/table_common_card.php</li><li>[脚本]source/class/table/table_common_member_action_log.php</li><li>[脚本]source/class/table/table_forum_collectioninvite.php</li><li>[脚本]source/language/lang_core.php</li><li>[插件]source/plugin/mobile/mobile.class.php</li><li>develop/_Data/buglist.data.php</li><li>develop/_Data/buglistfid.data.php</li><li>develop/_Data/buglist_handling.data.php</li><li>[模板]data/template/2_2_checkin_main.tpl.php</li><li>[脚本]source/module/forum/forum_forumdisplay.php</li><li>[脚本]source/function/function_forumlist.php</li><li>[脚本]source/class/helper/helper_seo.php</li><li>[脚本]source/class/table/table_forum_thread.php</li><li>[脚本]source/class/helper/helper_access.php</li><li>[脚本]source/class/table/table_forum_threadaddviews.php</li><li>[脚本]source/class/helper/helper_seccheck.php</li><li>[脚本]source/class/class_captcha.php</li><li>[脚本]source/class/class_cloud.php</li><li>[插件]source/plugin/manyou/Service/Util.php</li><li>[脚本]source/discuz_version.php</li><li>[插件]source/plugin/qqconnect/table/table_common_member_connect.php</li><li>[脚本]source/function/function_filesock.php</li><li>[脚本]source/class/table/table_home_favorite.php</li><li>[脚本]source/function/function_upload.php</li><li>[脚本]source/class/table/table_forum_grouplevel.php</li><li>[脚本]source/class/class_template.php</li><li>[脚本]source/language/lang_template.php</li><li>[脚本]source/language/forum/lang_template.php</li><li>[脚本]source/function/function_block.php</li><li>[脚本]source/class/table/table_common_template_block.php</li><li>[模板]data/template/2_diy_forum_forumdisplay.tpl.php</li><li>[模板]data/template/2_2_common_header_forum_forumdisplay.tpl.php</li><li>[模板]data/template/2_2_common_header_diynav.tpl.php</li><li>[模板]data/template/2_2_common_header_userstatus.tpl.php</li><li>[模板]data/template/2_2_forum_topicadmin_modlayer.tpl.php</li><li>[模板]data/template/2_2_forum_forumdisplay_fastpost.tpl.php</li><li>[模板]data/template/2_2_common_footer.tpl.php</li><li>[插件]source/plugin/manyou/Service/DiscuzTips.php</li><li>[脚本]source/function/function_debug.php</li><ol></div><div id="__debug_c_5" style="display:none"><ol><li><br />['<font color=blue>YKw3_2132_saltkey</font>'] => gwd99H83</li><li><br />['<font color=blue>YKw3_2132_lastvisit</font>'] => 1397037199</li><li><br />['<font color=blue>YKw3_2132_auth</font>'] => d991hcF5ULtJfT35d4whDTeu6N5nwnqKeK1bUpNXKuxVkr2bW5PXaR+c93ltVo3kdWDLbQB0X6t3Cu7u6wqd</li><li><br />['<font color=blue>YKw3_2132_lastcheckfeed</font>'] => 1|1397040804</li><li><br />['<font color=blue>YKw3_2132_nofavfid</font>'] => 1</li><li><br />['JwXs_2132_saltkey'] => gLT8mMCM</li><li><br />['JwXs_2132_lastvisit'] => 1397041212</li><li><br />['JwXs_2132_nofavfid'] => 1</li><li><br />['<font color=blue>YKw3_2132_st_p</font>'] => 1|1397114571|90543aa0c0edc8608ca14d2519316bfa</li><li><br />['<font color=blue>YKw3_2132_visitedfid</font>'] => 2D36</li><li><br />['<font color=blue>YKw3_2132_viewid</font>'] => tid_76</li><li><br />['<font color=blue>YKw3_2132_smile</font>'] => 1D1</li><li><br />['JwXs_2132_ulastactivity'] => 6bc9bhnChPgoTWHWfIRautq4KJotBrWoFy34qHQQNuutj06jWjwh</li><li><br />['JwXs_2132_lip'] => 127.0.0.1,1397188991</li><li><br />['JwXs_2132__refer'] => %2Fdiscuzx31%2Fhome.php%3Fmod%3Dspacecp%26ac%3Dprofile%26op%3Dpassword</li><li><br />['JwXs_2132_lastcheckfeed'] => 1|1397191106</li><li><br />['sid'] => d67cOpTCCgglLj6VWz4wKn%2FY8SHmiss%2BAk3o7Pv6cDJrzDzpyrkT%2B2D9diyeno5Zhknp8G8r8GJe%2BA</li><li><br />['JwXs_2132_seccode'] => 2.d8d44ac49d94a2f822</li><li><br />['JwXs_2132_auth'] => b032Buk4CI2ZGukBYzBJwHFzXsz8k/8TOjZIQFiLBEp44CKsqOVQqqznrVn7zCFLhjgXcgirC2ymszAUptp3</li><li><br />['JwXs_2132_home_diymode'] => 1</li><li><br />['JwXs_2132_st_t'] => 1|1397193743|4a84783fb10b52b90bf241efb99fa5e7</li><li><br />['JwXs_2132_forum_lastvisit'] => D_2_1397119280D_739_1397193560D_342_1397193691D_730_1397193740D_678_1397193743</li><li><br />['JwXs_2132_visitedfid'] => 678D730D342D739</li><li><br />['JwXs_2132_smile'] => 1D1</li><li><br />['JwXs_2132_onlineusernum'] => 1</li><li><br />['JwXs_2132_sid'] => vMu3hH</li><li><br />['JwXs_2132_sendmail'] => 1</li><li><br />['JwXs_2132_checkpatch'] => 1</li><li><br />['JwXs_2132_checkpm'] => 1</li><li><br />['JwXs_2132_lastact'] => 1397199505	misc.php	patch</li><li><br />['<font color=blue>YKw3_2132_creditnotice</font>'] => 0D0D2D0D0D0D0D0D0D1</li><li><br />['<font color=blue>YKw3_2132_creditbase</font>'] => 0D0D381D0D0D0D0D0D0</li><li><br />['<font color=blue>YKw3_2132_creditrule</font>'] => 每天登录</li><li><br />['<font color=blue>YKw3_2132_lip</font>'] => 127.0.0.1,1397199507</li><li><br />['<font color=blue>YKw3_2132_sid</font>'] => mYdDzQ</li><li><br />['<font color=blue>YKw3_2132_ulastactivity</font>'] => 7d602pLgAowPdPxYJWR2kI4iCg8JI8dAIyqCWqEOBpUea8QcvtpA</li><li><br />['<font color=blue>YKw3_2132_onlineusernum</font>'] => 1</li><li><br />['<font color=blue>YKw3_2132_sendmail</font>'] => 1</li><li><br />['<font color=blue>YKw3_2132_checkpatch</font>'] => 1</li><li><br />['<font color=blue>YKw3_2132_lastact</font>'] => 1397199518	forum.php	forumdisplay</li><li><br />['<font color=blue>YKw3_2132_checkpm</font>'] => 1</li><li><br />['<font color=blue>YKw3_2132_st_t</font>'] => 1|1397199518|1e9f4a6c78274d6eaf5abce69aded7c8</li><li><br />['<font color=blue>YKw3_2132_forum_lastvisit</font>'] => D_2_1397199518</li><li><br />['<font color=blue>YKw3_2132_extra</font>'] => fid=2&amp;page=1</li></ol></div><div id="__debug_c_6" style="display:none"><div id="__debug_c_4_nav"><a href="#S_config">Nav:<br />
			<a href="#top">#top</a><br />
			<a href="#S_config">$_G['config']</a><br />
			<a href="#S_setting">$_G['setting']</a><br />
			<a href="#S_member">$_G['member']</a><br />
			<a href="#S_group">$_G['group']</a><br />
			<a href="#S_cookie">$_G['cookie']</a><br />
			<a href="#S_style">$_G['style']</a><br />
			<a href="#S_cache">$_G['cache']</a><br />
			</div><ol><a name="top"></a><li><br />['uid'] => 1</li><li><br />['username'] => admin</li><li><br />['adminid'] => 1</li><li><br />['groupid'] => 1</li><li><br />['sid'] => mYdDzQ</li><li><br />['formhash'] => 23ff1b43</li><li><br />['connectguest'] => 0</li><li><br />['timestamp'] => 1397199518</li><li><br />['starttime'] => 1397199518.4476</li><li><br />['clientip'] => 127.0.0.1</li><li><br />['remoteport'] => 63668</li><li><br />['referer'] => </li><li><br />['charset'] => utf-8</li><li><br />['gzipcompress'] => </li><li><br />['authkey'] => 3cf35c9a3d876a679d2e895e9b4c76d9</li><li><br />['widthauto'] => 0</li><li><br />['disabledwidthauto'] => 0</li><li><br />['PHP_SELF'] => /forum.php</li><li><br />['siteurl'] => http://127.0.0.1:31/</li><li><br />['siteroot'] => /</li><li><br />['siteport'] => :31</li><li><br />['fid'] => 2</li><li><br />['tid'] => 0</li><li><br />['rssauth'] => 0728%2Bn36IzVZSE4%2B099WY%2B8N%2F8SWbPkIU4PBDHz6wPVkx%2BMFoFv5DOo</li><li><br />['mobile'] => </li><li><br />['basescript'] => forum</li><li><br />['basefilename'] => forum.php</li><li><br />['isHTTPS'] => </li><li><br />['staticurl'] => static/</li><li><br />['gp_mod'] => forumdisplay</li><li><br />['gp_fid'] => 2</li><li><br />['mod'] => forumdisplay</li><li><br />['inajax'] => 0</li><li><br />['page'] => 1</li><li><br />['tpp'] => 20</li><li><br />['ppp'] => 10</li><li><br />['currenturl_encode'] => aHR0cDovLzEyNy4wLjAuMTozMS9mb3J1bS5waHA/bW9kPWZvcnVtZGlzcGxheSZmaWQ9Mg==</li><li><br />['seokeywords'] => </li><li><br />['seodescription'] => </li><li><br />['forum_auditstatuson'] => </li><li><br />['current_grouplevel'] => </li><li><br />['inhookscript'] => </li><li><br />['forum_threadcount'] => 8</li><li><br />['hiddenexists'] => </li><li><br />['showrows'] => 8</li><li><br />['forum_threadnum'] => 8</li><li><br />['leftsidewidth_mwidth'] => 145</li><li><br />['hookscriptoutput'] => 1</li><li><br />['uploadjs'] => 1</li><li><a name="S_timenow"></a><br />['timenow'] => Array<br />
(<br />
&nbsp;&nbsp;[time] =&gt; 2014-4-11 14:58<br />
&nbsp;&nbsp;[offset] =&gt; +8<br />
)<br />
</li><li><a name="S_pluginrunlist"></a><br />['pluginrunlist'] => Array<br />
(<br />
)<br />
</li><li><a name="S_config"></a><br />['config'] => Array<br />
(<br />
&nbsp;&nbsp;[debug] =&gt; 1<br />
&nbsp;&nbsp;[plugindeveloper] =&gt; 0<br />
&nbsp;&nbsp;[db] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbhost] =&gt; localhost<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbuser] =&gt; test<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbpw] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbcharset] =&gt; utf8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pconnect] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbname] =&gt; dx31<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tablepre] =&gt; pre_<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[slave] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[slave_except_table] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[memory] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[prefix] =&gt; coiX4y_<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[redis] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[server] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[port] =&gt; 6379<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pconnect] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timeout] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[requirepass] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[serializer] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[memcache] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[server] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[port] =&gt; 11211<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pconnect] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timeout] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[apc] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[xcache] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[eaccelerator] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[wincache] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[server] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[download] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readmod] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[xsendfile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dir] =&gt; /down/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[output] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[charset] =&gt; utf-8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forceheader] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[gzip] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tplrefresh] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[language] =&gt; zh_cn<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[staticurl] =&gt; static/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ajaxvalidate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[iecompatible] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[cookie] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cookiepre] =&gt; YKw3_2132_<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cookiedomain] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cookiepath] =&gt; /<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[security] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authkey] =&gt; 1bfd53P6haurnWiv<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[urlxssdefend] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attackevasive] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[querysafe] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dfunction] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; load_file<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; hex<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; substring<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; if<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; ord<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; char<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[daction] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; @<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; intooutfile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; intodumpfile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; unionselect<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; (select<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; unionall<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; uniondistinct<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dnote] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; /*<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; */<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; #<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; --<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; &quot;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dlikehex] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[afullnote] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[admincp] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[founder] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forcesecques] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[checkip] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[runquery] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbimport] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[remote] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[on] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dir] =&gt; remote<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[appkey] =&gt; 62cf0b3c3e6a4c9468e7216839721d8e<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cron] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[input] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[compatible] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
)<br />
</li><li><a name="S_setting"></a><br />['setting'] => Array<br />
(<br />
&nbsp;&nbsp;[accessemail] =&gt; <br />
&nbsp;&nbsp;[activityforumid] =&gt; 0<br />
&nbsp;&nbsp;[activityfield] =&gt; a:3:{s:8:&quot;realname&quot;;s:12:&quot;真实姓名&quot;;s:6:&quot;mobile&quot;;s:6:&quot;手机&quot;;s:2:&quot;qq&quot;;s:5:&quot;QQ号&quot;;}<br />
&nbsp;&nbsp;[activityextnum] =&gt; 0<br />
&nbsp;&nbsp;[activitypp] =&gt; 8<br />
&nbsp;&nbsp;[activitycredit] =&gt; 1<br />
&nbsp;&nbsp;[activitytype] =&gt; 朋友聚会<br />
出外郊游<br />
自驾出行<br />
公益活动<br />
线上活动<br />
&nbsp;&nbsp;[adminemail] =&gt; admin@admin.com<br />
&nbsp;&nbsp;[adminipaccess] =&gt; <br />
&nbsp;&nbsp;[adminnotifytypes] =&gt; verifythread,verifypost,verifyuser,verifyblog,verifydoing,verifypic,verifyshare,verifycommontes,verifyrecycle,verifyrecyclepost,verifyarticle,verifyacommont,verifymedal,verify_1,verify_2,verify_3,verify_4,verify_5,verify_6,verify_7<br />
&nbsp;&nbsp;[anonymoustext] =&gt; 匿名<br />
&nbsp;&nbsp;[advtype] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[allowattachurl] =&gt; 0<br />
&nbsp;&nbsp;[allowdomain] =&gt; 0<br />
&nbsp;&nbsp;[alloweditpost] =&gt; 0<br />
&nbsp;&nbsp;[allowswitcheditor] =&gt; 1<br />
&nbsp;&nbsp;[allowviewuserthread] =&gt; <br />
&nbsp;&nbsp;[archiver] =&gt; 1<br />
&nbsp;&nbsp;[archiverredirect] =&gt; 0<br />
&nbsp;&nbsp;[attachbanperiods] =&gt; <br />
&nbsp;&nbsp;[attachdir] =&gt; D:/Dev/Dev.Data/www/dx31/./data/attachment/<br />
&nbsp;&nbsp;[attachexpire] =&gt; <br />
&nbsp;&nbsp;[attachimgpost] =&gt; 1<br />
&nbsp;&nbsp;[attachrefcheck] =&gt; 0<br />
&nbsp;&nbsp;[attachsave] =&gt; 3<br />
&nbsp;&nbsp;[attachurl] =&gt; data/attachment/<br />
&nbsp;&nbsp;[authkey] =&gt; 1bfd53P6haurnWiv<br />
&nbsp;&nbsp;[authoronleft] =&gt; 1<br />
&nbsp;&nbsp;[uidlogin] =&gt; 0<br />
&nbsp;&nbsp;[autoidselect] =&gt; 0<br />
&nbsp;&nbsp;[avatarmethod] =&gt; 0<br />
&nbsp;&nbsp;[bannedmessages] =&gt; 1<br />
&nbsp;&nbsp;[bbclosed] =&gt; 0<br />
&nbsp;&nbsp;[bbname] =&gt; 幻影网<br />
&nbsp;&nbsp;[bbrules] =&gt; 0<br />
&nbsp;&nbsp;[bbrulesforce] =&gt; 0<br />
&nbsp;&nbsp;[bbrulestxt] =&gt; <br />
&nbsp;&nbsp;[bdaystatus] =&gt; 0<br />
&nbsp;&nbsp;[binddomains] =&gt; a:0:{}<br />
&nbsp;&nbsp;[boardlicensed] =&gt; 0<br />
&nbsp;&nbsp;[cacheindexlife] =&gt; 0<br />
&nbsp;&nbsp;[cachethreaddir] =&gt; data/threadcache<br />
&nbsp;&nbsp;[cachethreadlife] =&gt; 0<br />
&nbsp;&nbsp;[censoremail] =&gt; <br />
&nbsp;&nbsp;[censoruser] =&gt; <br />
&nbsp;&nbsp;[closedallowactivation] =&gt; 0<br />
&nbsp;&nbsp;[commentfirstpost] =&gt; 1<br />
&nbsp;&nbsp;[commentitem] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[commentnumber] =&gt; 0<br />
&nbsp;&nbsp;[creditnotice] =&gt; 1<br />
&nbsp;&nbsp;[creditsformula] =&gt; $member['posts']+$member['digestposts']*5+$member['extcredits1']*2+$member['extcredits2']+$member['extcredits3']<br />
&nbsp;&nbsp;[creditsformulaexp] =&gt; &lt;u&gt;总积分&lt;/u&gt;=&lt;u&gt;发帖数&lt;/u&gt;+&lt;u&gt;精华帖数&lt;/u&gt;*5+&lt;u&gt;威望&lt;/u&gt;*2+&lt;u&gt;金钱&lt;/u&gt;+&lt;u&gt;贡献&lt;/u&gt;<br />
&nbsp;&nbsp;[creditspolicy] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[reply] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[postattach] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[getattach] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sendpm] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[search] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[promotion_visit] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[promotion_register] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tradefinished] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[votepoll] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lowerlimit] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[creditstax] =&gt; 0.2<br />
&nbsp;&nbsp;[creditstrans] =&gt; 2<br />
&nbsp;&nbsp;[need_email] =&gt; 0<br />
&nbsp;&nbsp;[need_avatar] =&gt; 0<br />
&nbsp;&nbsp;[reginput] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[username] =&gt; Srm0ZO<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[password] =&gt; yCUMNL<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[password2] =&gt; pzCnZ2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[email] =&gt; Fvw3mb<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[dateconvert] =&gt; 1<br />
&nbsp;&nbsp;[dateformat] =&gt; Y-n-j<br />
&nbsp;&nbsp;[debateforumid] =&gt; 0<br />
&nbsp;&nbsp;[debug] =&gt; 1<br />
&nbsp;&nbsp;[defaulteditormode] =&gt; 1<br />
&nbsp;&nbsp;[delayviewcount] =&gt; 0<br />
&nbsp;&nbsp;[deletereason] =&gt; <br />
&nbsp;&nbsp;[disallowfloat] =&gt; login|sendpm|newthread|reply|viewratings|viewwarning|viewthreadmod|viewvote|tradeorder|activity|debate|nav|usergroups|task<br />
&nbsp;&nbsp;[domainroot] =&gt; <br />
&nbsp;&nbsp;[doublee] =&gt; 1<br />
&nbsp;&nbsp;[dupkarmarate] =&gt; 0<br />
&nbsp;&nbsp;[ec_account] =&gt; <br />
&nbsp;&nbsp;[ec_contract] =&gt; <br />
&nbsp;&nbsp;[ec_credit] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxcreditspermonth] =&gt; 6<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rank] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 11<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; 41<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; 91<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; 151<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; 251<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; 501<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; 1001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; 2001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; 5001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; 10001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; 20001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; 50001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; 100001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; 200001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ec_maxcredits] =&gt; 1000<br />
&nbsp;&nbsp;[ec_maxcreditspermonth] =&gt; 0<br />
&nbsp;&nbsp;[ec_mincredits] =&gt; 0<br />
&nbsp;&nbsp;[ec_ratio] =&gt; 0<br />
&nbsp;&nbsp;[ec_tenpay_bargainor] =&gt; <br />
&nbsp;&nbsp;[ec_tenpay_key] =&gt; <br />
&nbsp;&nbsp;[postappend] =&gt; 0<br />
&nbsp;&nbsp;[editedby] =&gt; 1<br />
&nbsp;&nbsp;[editoroptions] =&gt; 6<br />
&nbsp;&nbsp;[edittimelimit] =&gt; <br />
&nbsp;&nbsp;[exchangemincredits] =&gt; 100<br />
&nbsp;&nbsp;[extcredits] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[img] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 威望<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[unit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ratio] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showinthread] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangein] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangeout] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[img] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 金钱<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[unit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ratio] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showinthread] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangein] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangeout] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[img] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 贡献<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[unit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ratio] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showinthread] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangein] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowexchangeout] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[fastpost] =&gt; 1<br />
&nbsp;&nbsp;[forumallowside] =&gt; 0<br />
&nbsp;&nbsp;[fastsmilies] =&gt; 1<br />
&nbsp;&nbsp;[feedday] =&gt; 7<br />
&nbsp;&nbsp;[feedhotday] =&gt; 2<br />
&nbsp;&nbsp;[feedhotmin] =&gt; 3<br />
&nbsp;&nbsp;[feedhotnum] =&gt; 3<br />
&nbsp;&nbsp;[feedmaxnum] =&gt; 100<br />
&nbsp;&nbsp;[showallfriendnum] =&gt; 8<br />
&nbsp;&nbsp;[feedtargetblank] =&gt; 1<br />
&nbsp;&nbsp;[floodctrl] =&gt; 0<br />
&nbsp;&nbsp;[forumdomains] =&gt; a:0:{}<br />
&nbsp;&nbsp;[forumjump] =&gt; 0<br />
&nbsp;&nbsp;[forumlinkstatus] =&gt; 1<br />
&nbsp;&nbsp;[forumseparator] =&gt; 1<br />
&nbsp;&nbsp;[frameon] =&gt; 0<br />
&nbsp;&nbsp;[framewidth] =&gt; 180<br />
&nbsp;&nbsp;[friendgroupnum] =&gt; 8<br />
&nbsp;&nbsp;[ftp] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[globalstick] =&gt; 1<br />
&nbsp;&nbsp;[targetblank] =&gt; 0<br />
&nbsp;&nbsp;[google] =&gt; 1<br />
&nbsp;&nbsp;[groupstatus] =&gt; 0<br />
&nbsp;&nbsp;[portalstatus] =&gt; 0<br />
&nbsp;&nbsp;[followstatus] =&gt; 0<br />
&nbsp;&nbsp;[collectionstatus] =&gt; 0<br />
&nbsp;&nbsp;[guidestatus] =&gt; 0<br />
&nbsp;&nbsp;[feedstatus] =&gt; 0<br />
&nbsp;&nbsp;[blogstatus] =&gt; 0<br />
&nbsp;&nbsp;[doingstatus] =&gt; 0<br />
&nbsp;&nbsp;[albumstatus] =&gt; 0<br />
&nbsp;&nbsp;[sharestatus] =&gt; 0<br />
&nbsp;&nbsp;[wallstatus] =&gt; 0<br />
&nbsp;&nbsp;[rankliststatus] =&gt; 0<br />
&nbsp;&nbsp;[homestyle] =&gt; 0<br />
&nbsp;&nbsp;[homepagestyle] =&gt; 0<br />
&nbsp;&nbsp;[group_allowfeed] =&gt; 1<br />
&nbsp;&nbsp;[group_admingroupids] =&gt; a:1:{i:1;s:1:&quot;1&quot;;}<br />
&nbsp;&nbsp;[group_imgsizelimit] =&gt; 512<br />
&nbsp;&nbsp;[group_userperm] =&gt; a:21:{s:16:&quot;allowstickthread&quot;;s:1:&quot;1&quot;;s:15:&quot;allowbumpthread&quot;;s:1:&quot;1&quot;;s:20:&quot;allowhighlightthread&quot;;s:1:&quot;1&quot;;s:16:&quot;allowstampthread&quot;;s:1:&quot;1&quot;;s:16:&quot;allowclosethread&quot;;s:1:&quot;1&quot;;s:16:&quot;allowmergethread&quot;;s:1:&quot;1&quot;;s:16:&quot;allowsplitthread&quot;;s:1:&quot;1&quot;;s:17:&quot;allowrepairthread&quot;;s:1:&quot;1&quot;;s:11:&quot;allowrefund&quot;;s:1:&quot;1&quot;;s:13:&quot;alloweditpoll&quot;;s:1:&quot;1&quot;;s:17:&quot;allowremovereward&quot;;s:1:&quot;1&quot;;s:17:&quot;alloweditactivity&quot;;s:1:&quot;1&quot;;s:14:&quot;allowedittrade&quot;;s:1:&quot;1&quot;;s:17:&quot;allowdigestthread&quot;;s:1:&quot;3&quot;;s:13:&quot;alloweditpost&quot;;s:1:&quot;1&quot;;s:13:&quot;allowwarnpost&quot;;s:1:&quot;1&quot;;s:12:&quot;allowbanpost&quot;;s:1:&quot;1&quot;;s:12:&quot;allowdelpost&quot;;s:1:&quot;1&quot;;s:13:&quot;allowupbanner&quot;;s:1:&quot;1&quot;;s:15:&quot;disablepostctrl&quot;;s:1:&quot;0&quot;;s:11:&quot;allowviewip&quot;;s:1:&quot;1&quot;;s:15:&quot;allowlivethread&quot;;s:1:&quot;1&quot;;}<br />
&nbsp;&nbsp;[heatthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[reply] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[period] =&gt; 15<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[iconlevels] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[guide] =&gt; a:2:{s:5:&quot;hotdt&quot;;i:604800;s:8:&quot;digestdt&quot;;i:604800;}<br />
&nbsp;&nbsp;[hideprivate] =&gt; 1<br />
&nbsp;&nbsp;[historyposts] =&gt; 1	18<br />
&nbsp;&nbsp;[hottopic] =&gt; 10<br />
&nbsp;&nbsp;[icp] =&gt; <br />
&nbsp;&nbsp;[imagelib] =&gt; 0<br />
&nbsp;&nbsp;[imagemaxwidth] =&gt; 600<br />
&nbsp;&nbsp;[watermarkminheight] =&gt; a:3:{s:6:&quot;portal&quot;;s:1:&quot;0&quot;;s:5:&quot;forum&quot;;s:1:&quot;0&quot;;s:5:&quot;album&quot;;s:1:&quot;0&quot;;}<br />
&nbsp;&nbsp;[watermarkminwidth] =&gt; a:3:{s:6:&quot;portal&quot;;s:1:&quot;0&quot;;s:5:&quot;forum&quot;;s:1:&quot;0&quot;;s:5:&quot;album&quot;;s:1:&quot;0&quot;;}<br />
&nbsp;&nbsp;[watermarkquality] =&gt; a:3:{s:6:&quot;portal&quot;;s:2:&quot;90&quot;;s:5:&quot;forum&quot;;i:90;s:5:&quot;album&quot;;i:90;}<br />
&nbsp;&nbsp;[watermarkstatus] =&gt; a:3:{s:6:&quot;portal&quot;;s:1:&quot;0&quot;;s:5:&quot;forum&quot;;s:1:&quot;0&quot;;s:5:&quot;album&quot;;s:1:&quot;0&quot;;}<br />
&nbsp;&nbsp;[watermarktext] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fontpath] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[size] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[angle] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[shadowx] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[shadowy] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[shadowcolor] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[translatex] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[translatey] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[skewx] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[skewy] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[watermarktrans] =&gt; a:3:{s:6:&quot;portal&quot;;s:2:&quot;50&quot;;s:5:&quot;forum&quot;;i:50;s:5:&quot;album&quot;;i:50;}<br />
&nbsp;&nbsp;[watermarktype] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; png<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; png<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; png<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[indexhot] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limit] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[days] =&gt; 7<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[expiration] =&gt; 900<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[messagecut] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[width] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[height] =&gt; 70<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[indextype] =&gt; classics<br />
&nbsp;&nbsp;[infosidestatus] =&gt; <br />
&nbsp;&nbsp;[initcredits] =&gt; 0,0,0,0,0,0,0,0,0<br />
&nbsp;&nbsp;[inviteconfig] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[invitecodeprompt] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ipaccess] =&gt; <br />
&nbsp;&nbsp;[jscachelife] =&gt; 1800<br />
&nbsp;&nbsp;[jsdateformat] =&gt; <br />
&nbsp;&nbsp;[jspath] =&gt; static/js/<br />
&nbsp;&nbsp;[jsrefdomains] =&gt; <br />
&nbsp;&nbsp;[jsstatus] =&gt; 0<br />
&nbsp;&nbsp;[karmaratelimit] =&gt; 0<br />
&nbsp;&nbsp;[losslessdel] =&gt; 365<br />
&nbsp;&nbsp;[magicdiscount] =&gt; 85<br />
&nbsp;&nbsp;[magicmarket] =&gt; 1<br />
&nbsp;&nbsp;[magicstatus] =&gt; 1<br />
&nbsp;&nbsp;[mail] =&gt; a:10:{s:8:&quot;mailsend&quot;;s:1:&quot;1&quot;;s:6:&quot;server&quot;;s:13:&quot;smtp.21cn.com&quot;;s:4:&quot;port&quot;;s:2:&quot;25&quot;;s:4:&quot;auth&quot;;s:1:&quot;1&quot;;s:4:&quot;from&quot;;s:26:&quot;Discuz &lt;username@21cn.com&gt;&quot;;s:13:&quot;auth_username&quot;;s:17:&quot;username@21cn.com&quot;;s:13:&quot;auth_password&quot;;s:8:&quot;password&quot;;s:13:&quot;maildelimiter&quot;;s:1:&quot;0&quot;;s:12:&quot;mailusername&quot;;s:1:&quot;1&quot;;s:15:&quot;sendmail_silent&quot;;s:1:&quot;1&quot;;}<br />
&nbsp;&nbsp;[maxavatarpixel] =&gt; 120<br />
&nbsp;&nbsp;[maxavatarsize] =&gt; 20000<br />
&nbsp;&nbsp;[maxbdays] =&gt; 0<br />
&nbsp;&nbsp;[maxchargespan] =&gt; 0<br />
&nbsp;&nbsp;[maxfavorites] =&gt; 100<br />
&nbsp;&nbsp;[maxincperthread] =&gt; 0<br />
&nbsp;&nbsp;[maxmagicprice] =&gt; 50<br />
&nbsp;&nbsp;[maxmodworksmonths] =&gt; 3<br />
&nbsp;&nbsp;[maxonlinelist] =&gt; 0<br />
&nbsp;&nbsp;[maxpage] =&gt; 100<br />
&nbsp;&nbsp;[maxpolloptions] =&gt; 20<br />
&nbsp;&nbsp;[maxpostsize] =&gt; 10000<br />
&nbsp;&nbsp;[maxsigrows] =&gt; 100<br />
&nbsp;&nbsp;[maxsmilies] =&gt; 10<br />
&nbsp;&nbsp;[membermaxpages] =&gt; 100<br />
&nbsp;&nbsp;[memberperpage] =&gt; 25<br />
&nbsp;&nbsp;[memliststatus] =&gt; 1<br />
&nbsp;&nbsp;[memory] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_count] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_status] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_profile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_field_home] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_field_forum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common_member_verify] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum_thread] =&gt; 172800<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum_thread_forumdisplay] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum_collectionrelated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum_postcache] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum_collection] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[home_follow] =&gt; 86400<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumindex] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[diyblock] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[diyblockoutput] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[minpostsize] =&gt; 10<br />
&nbsp;&nbsp;[minpostsize_mobile] =&gt; 0<br />
&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobileforward] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobileregister] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobilecharset] =&gt; utf-8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobilesimpletype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobiletopicperpage] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobilepostperpage] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobilecachetime] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobileforumview] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobilepreview] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[moddisplay] =&gt; flat<br />
&nbsp;&nbsp;[modratelimit] =&gt; 0<br />
&nbsp;&nbsp;[userreasons] =&gt; 很给力!<br />
神马都是浮云<br />
赞一个!<br />
山寨<br />
淡定<br />
&nbsp;&nbsp;[modworkstatus] =&gt; 1<br />
&nbsp;&nbsp;[msgforward] =&gt; a:3:{s:11:&quot;refreshtime&quot;;i:100;s:5:&quot;quick&quot;;i:0;s:8:&quot;messages&quot;;a:14:{i:0;s:19:&quot;thread_poll_succeed&quot;;i:1;s:19:&quot;thread_rate_succeed&quot;;i:2;s:23:&quot;usergroups_join_succeed&quot;;i:3;s:23:&quot;usergroups_exit_succeed&quot;;i:4;s:25:&quot;usergroups_update_succeed&quot;;i:5;s:20:&quot;buddy_update_succeed&quot;;i:6;s:17:&quot;post_edit_succeed&quot;;i:7;s:18:&quot;post_reply_succeed&quot;;i:8;s:24:&quot;post_edit_delete_succeed&quot;;i:9;s:22:&quot;post_newthread_succeed&quot;;i:10;s:13:&quot;admin_succeed&quot;;i:11;s:17:&quot;pm_delete_succeed&quot;;i:12;s:15:&quot;search_redirect&quot;;i:13;s:10:&quot;do_success&quot;;}}<br />
&nbsp;&nbsp;[msn] =&gt; <br />
&nbsp;&nbsp;[networkpage] =&gt; 0<br />
&nbsp;&nbsp;[newbiespan] =&gt; 2<br />
&nbsp;&nbsp;[newbietasks] =&gt; <br />
&nbsp;&nbsp;[newbietaskupdate] =&gt; <br />
&nbsp;&nbsp;[newspaceavatar] =&gt; 0<br />
&nbsp;&nbsp;[nocacheheaders] =&gt; 0<br />
&nbsp;&nbsp;[oltimespan] =&gt; 10<br />
&nbsp;&nbsp;[onlinehold] =&gt; 900<br />
&nbsp;&nbsp;[onlinerecord] =&gt; 2	1392021226<br />
&nbsp;&nbsp;[pollforumid] =&gt; 0<br />
&nbsp;&nbsp;[postbanperiods] =&gt; <br />
&nbsp;&nbsp;[postmodperiods] =&gt; <br />
&nbsp;&nbsp;[postperpage] =&gt; 10<br />
&nbsp;&nbsp;[privacy] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[view] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[index] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[friend] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[wall] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[home] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[doing] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[blog] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[share] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[feed] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[doing] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[blog] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[upload] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[poll] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[newthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[pvfrequence] =&gt; 60<br />
&nbsp;&nbsp;[pwdsafety] =&gt; 0<br />
&nbsp;&nbsp;[pwlength] =&gt; 6<br />
&nbsp;&nbsp;[qihoo] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchbox] =&gt; 6<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[summary] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[jammer] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxtopics] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[keywords] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminemail] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[validity] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatedthreads] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bbsnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[webnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[blog] =&gt; blog<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[news] =&gt; news<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bbs] =&gt; bbs<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[banurl] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[position] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[validity] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ratelogon] =&gt; 1<br />
&nbsp;&nbsp;[ratelogrecord] =&gt; 20<br />
&nbsp;&nbsp;[relatenum] =&gt; 10<br />
&nbsp;&nbsp;[relatetime] =&gt; 60<br />
&nbsp;&nbsp;[realname] =&gt; 0<br />
&nbsp;&nbsp;[recommendthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[regclosemessage] =&gt; <br />
&nbsp;&nbsp;[regctrl] =&gt; 0<br />
&nbsp;&nbsp;[strongpw] =&gt; <br />
&nbsp;&nbsp;[regfloodctrl] =&gt; 0<br />
&nbsp;&nbsp;[regname] =&gt; register<br />
&nbsp;&nbsp;[reglinkname] =&gt; 立即注册<br />
&nbsp;&nbsp;[regstatus] =&gt; 1<br />
&nbsp;&nbsp;[regverify] =&gt; 0<br />
&nbsp;&nbsp;[relatedtag] =&gt; <br />
&nbsp;&nbsp;[report_reward] =&gt; a:2:{s:3:&quot;min&quot;;i:-3;s:3:&quot;max&quot;;i:3;}<br />
&nbsp;&nbsp;[rewardforumid] =&gt; 0<br />
&nbsp;&nbsp;[rewritecompatible] =&gt; <br />
&nbsp;&nbsp;[rewritestatus] =&gt; <br />
&nbsp;&nbsp;[rssstatus] =&gt; 1<br />
&nbsp;&nbsp;[rssttl] =&gt; 60<br />
&nbsp;&nbsp;[runwizard] =&gt; 1<br />
&nbsp;&nbsp;[search] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[blog] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[album] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[collection] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchctrl] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspm] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsearchresults] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[sphinxon] =&gt; <br />
&nbsp;&nbsp;[sphinxhost] =&gt; <br />
&nbsp;&nbsp;[sphinxport] =&gt; <br />
&nbsp;&nbsp;[sphinxsubindex] =&gt; threads,threads_minute<br />
&nbsp;&nbsp;[sphinxmsgindex] =&gt; posts,posts_minute<br />
&nbsp;&nbsp;[sphinxmaxquerytime] =&gt; <br />
&nbsp;&nbsp;[sphinxlimit] =&gt; <br />
&nbsp;&nbsp;[sphinxrank] =&gt; <br />
&nbsp;&nbsp;[searchbanperiods] =&gt; <br />
&nbsp;&nbsp;[seccodedata] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cloudip] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rule] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[register] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[numlimit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timelimit] =&gt; 60<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[login] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[nolocal] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pwsimple] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pwerror] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[outofday] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[numiptry] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timeiptry] =&gt; 60<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[numlimit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timelimit] =&gt; 60<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[nplimit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[vplimit] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[password] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[card] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[minposts] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[width] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[height] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[scatter] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[background] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adulterate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ttf] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[angle] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[warping] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[size] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[shadow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[animator] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[seccodestatus] =&gt; 1<br />
&nbsp;&nbsp;[seclevel] =&gt; 1<br />
&nbsp;&nbsp;[secqaa] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[minposts] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[sendmailday] =&gt; 0<br />
&nbsp;&nbsp;[seodescription] =&gt; <br />
&nbsp;&nbsp;[seohead] =&gt; <br />
&nbsp;&nbsp;[seokeywords] =&gt; <br />
&nbsp;&nbsp;[seotitle] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; 门户<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; 论坛<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group] =&gt; 群组<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[home] =&gt; 家园<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userapp] =&gt; 应用<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[showavatars] =&gt; 1<br />
&nbsp;&nbsp;[showemail] =&gt; <br />
&nbsp;&nbsp;[showimages] =&gt; 1<br />
&nbsp;&nbsp;[shownewuser] =&gt; 0<br />
&nbsp;&nbsp;[showsettings] =&gt; 7<br />
&nbsp;&nbsp;[showsignatures] =&gt; 1<br />
&nbsp;&nbsp;[sigviewcond] =&gt; 0<br />
&nbsp;&nbsp;[sitemessage] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[time] =&gt; 10000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[register] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[login] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[newthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[reply] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[sitename] =&gt; 幻影网2<br />
&nbsp;&nbsp;[siteuniqueid] =&gt; DXNL0NIc3509EL0Z<br />
&nbsp;&nbsp;[siteurl] =&gt; http://www.comsenz.com/<br />
&nbsp;&nbsp;[smcols] =&gt; 8<br />
&nbsp;&nbsp;[smrows] =&gt; 5<br />
&nbsp;&nbsp;[smthumb] =&gt; 20<br />
&nbsp;&nbsp;[spacedata] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cachelife] =&gt; 900<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmythreads] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyreplies] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyrewards] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmytrades] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyvideos] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyblogs] =&gt; 8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyfriends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyfavforums] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[limitmyfavthreads] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[textlength] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[spacestatus] =&gt; 1<br />
&nbsp;&nbsp;[srchhotkeywords] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; 活动<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 交友<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; discuz<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[starthreshold] =&gt; 2<br />
&nbsp;&nbsp;[statcode] =&gt; <br />
&nbsp;&nbsp;[statscachelife] =&gt; 180<br />
&nbsp;&nbsp;[statstatus] =&gt; <br />
&nbsp;&nbsp;[styleid] =&gt; 2<br />
&nbsp;&nbsp;[styleid1] =&gt; 1<br />
&nbsp;&nbsp;[styleid2] =&gt; 1<br />
&nbsp;&nbsp;[styleid3] =&gt; 1<br />
&nbsp;&nbsp;[stylejump] =&gt; 1<br />
&nbsp;&nbsp;[subforumsindex] =&gt; 0<br />
&nbsp;&nbsp;[tagstatus] =&gt; 1<br />
&nbsp;&nbsp;[taskon] =&gt; 0<br />
&nbsp;&nbsp;[tasktypes] =&gt; a:3:{s:9:&quot;promotion&quot;;a:2:{s:4:&quot;name&quot;;s:18:&quot;网站推广任务&quot;;s:7:&quot;version&quot;;s:3:&quot;1.0&quot;;}s:4:&quot;gift&quot;;a:2:{s:4:&quot;name&quot;;s:15:&quot;红包类任务&quot;;s:7:&quot;version&quot;;s:3:&quot;1.0&quot;;}s:6:&quot;avatar&quot;;a:2:{s:4:&quot;name&quot;;s:15:&quot;头像类任务&quot;;s:7:&quot;version&quot;;s:3:&quot;1.0&quot;;}}<br />
&nbsp;&nbsp;[threadmaxpages] =&gt; 1000<br />
&nbsp;&nbsp;[threadsticky] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; 全局置顶<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 分类置顶<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 本版置顶<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[thumbwidth] =&gt; 400<br />
&nbsp;&nbsp;[thumbheight] =&gt; 300<br />
&nbsp;&nbsp;[sourcewidth] =&gt; <br />
&nbsp;&nbsp;[sourceheight] =&gt; <br />
&nbsp;&nbsp;[thumbquality] =&gt; 100<br />
&nbsp;&nbsp;[thumbstatus] =&gt; <br />
&nbsp;&nbsp;[timeformat] =&gt; H:i<br />
&nbsp;&nbsp;[timeoffset] =&gt; 8<br />
&nbsp;&nbsp;[topcachetime] =&gt; 60<br />
&nbsp;&nbsp;[topicperpage] =&gt; 20<br />
&nbsp;&nbsp;[tradeforumid] =&gt; 0<br />
&nbsp;&nbsp;[transfermincredits] =&gt; 1000<br />
&nbsp;&nbsp;[uc] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[addfeed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ucactivation] =&gt; 1<br />
&nbsp;&nbsp;[updatestat] =&gt; 1<br />
&nbsp;&nbsp;[userdateformat] =&gt; Y-n-j<br />
Y/n/j<br />
j-n-Y<br />
j/n/Y<br />
&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;[videophoto] =&gt; 0<br />
&nbsp;&nbsp;[video_allowalbum] =&gt; 0<br />
&nbsp;&nbsp;[video_allowblog] =&gt; 0<br />
&nbsp;&nbsp;[video_allowcomment] =&gt; 0<br />
&nbsp;&nbsp;[video_allowdoing] =&gt; 1<br />
&nbsp;&nbsp;[video_allowfriend] =&gt; 1<br />
&nbsp;&nbsp;[video_allowpoke] =&gt; 1<br />
&nbsp;&nbsp;[video_allowshare] =&gt; 0<br />
&nbsp;&nbsp;[video_allowuserapp] =&gt; 0<br />
&nbsp;&nbsp;[video_allowviewspace] =&gt; 1<br />
&nbsp;&nbsp;[video_allowwall] =&gt; 1<br />
&nbsp;&nbsp;[viewthreadtags] =&gt; 100<br />
&nbsp;&nbsp;[visitbanperiods] =&gt; <br />
&nbsp;&nbsp;[visitedforums] =&gt; &lt;li&gt;&lt;a href=&quot;forum.php?mod=forumdisplay&amp;fid=36&quot;&gt;用户反馈&lt;/a&gt;&lt;/li&gt;<br />
&nbsp;&nbsp;[vtonlinestatus] =&gt; 1<br />
&nbsp;&nbsp;[wapcharset] =&gt; 0<br />
&nbsp;&nbsp;[wapdateformat] =&gt; n/j<br />
&nbsp;&nbsp;[wapmps] =&gt; 500<br />
&nbsp;&nbsp;[wapppp] =&gt; 5<br />
&nbsp;&nbsp;[wapregister] =&gt; 0<br />
&nbsp;&nbsp;[wapstatus] =&gt; 0<br />
&nbsp;&nbsp;[waptpp] =&gt; 10<br />
&nbsp;&nbsp;[warningexpiration] =&gt; 30<br />
&nbsp;&nbsp;[warninglimit] =&gt; 3<br />
&nbsp;&nbsp;[welcomemsg] =&gt; 1<br />
&nbsp;&nbsp;[welcomemsgtitle] =&gt; {username}，您好，感谢您的注册，请阅读以下内容。<br />
&nbsp;&nbsp;[welcomemsgtxt] =&gt; 尊敬的{username}，您已经注册成为{sitename}的会员，请您在发表言论时，遵守当地法律法规。<br />
如果您有什么疑问可以联系管理员，Email: {adminemail}。<br />
<br />
<br />
{bbname}<br />
{time}<br />
&nbsp;&nbsp;[whosonlinestatus] =&gt; 3<br />
&nbsp;&nbsp;[whosonline_contract] =&gt; 0<br />
&nbsp;&nbsp;[zoomstatus] =&gt; 1<br />
&nbsp;&nbsp;[my_app_status] =&gt; 0<br />
&nbsp;&nbsp;[my_siteid] =&gt; <br />
&nbsp;&nbsp;[my_sitekey] =&gt; <br />
&nbsp;&nbsp;[my_closecheckupdate] =&gt; <br />
&nbsp;&nbsp;[my_ip] =&gt; <br />
&nbsp;&nbsp;[my_search_data] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_hot_topic] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_thread_related] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_recommend_related] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_thread_related_bottom] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_forum_recommend] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_forum_related] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_collection_related] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow_search_suggest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cp_version] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recwords_lifetime] =&gt; 21600<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[rewardexpiration] =&gt; 30<br />
&nbsp;&nbsp;[stamplistlevel] =&gt; 3<br />
&nbsp;&nbsp;[visitedthreads] =&gt; 0<br />
&nbsp;&nbsp;[navsubhover] =&gt; 0<br />
&nbsp;&nbsp;[showusercard] =&gt; 1<br />
&nbsp;&nbsp;[allowspacedomain] =&gt; 0<br />
&nbsp;&nbsp;[allowgroupdomain] =&gt; 0<br />
&nbsp;&nbsp;[holddomain] =&gt; www|*blog*|*space*|*bbs*<br />
&nbsp;&nbsp;[domain] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[defaultindex] =&gt; forum.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[holddomain] =&gt; www|*blog*|*space*|*bbs*<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[list] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[app] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[default] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[portal] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[home] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[root] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[home] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[topic] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[channel] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ranklist] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[index_select] =&gt; thisweek<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[member] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[thread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[blog] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[poll] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[activity] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[picture] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cache_time] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show_num] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[outlandverify] =&gt; 0<br />
&nbsp;&nbsp;[allowquickviewprofile] =&gt; 1<br />
&nbsp;&nbsp;[allowmoderatingthread] =&gt; 1<br />
&nbsp;&nbsp;[editperdel] =&gt; 1<br />
&nbsp;&nbsp;[defaultindex] =&gt; forum.php<br />
&nbsp;&nbsp;[ipregctrltime] =&gt; 72<br />
&nbsp;&nbsp;[verify] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 实名认证<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showicon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewrealname] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[realname] =&gt; realname<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[enabled] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 视频认证<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showicon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewvideophoto] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[focus] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[robotarchiver] =&gt; 0<br />
&nbsp;&nbsp;[profilegroup] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[base] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 基本资料<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[realname] =&gt; realname<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[gender] =&gt; gender<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[birthday] =&gt; birthday<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[birthcity] =&gt; birthcity<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[residecity] =&gt; residecity<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[residedist] =&gt; residedist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[affectivestatus] =&gt; affectivestatus<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lookingfor] =&gt; lookingfor<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bloodtype] =&gt; bloodtype<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field1] =&gt; field1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field2] =&gt; field2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field3] =&gt; field3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field4] =&gt; field4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field5] =&gt; field5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field6] =&gt; field6<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field7] =&gt; field7<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field8] =&gt; field8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[contact] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 联系方式<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[telephone] =&gt; telephone<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[qq] =&gt; qq<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[msn] =&gt; msn<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[taobao] =&gt; taobao<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icq] =&gt; icq<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[yahoo] =&gt; yahoo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[edu] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 教育情况<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[graduateschool] =&gt; graduateschool<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[education] =&gt; education<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[work] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 工作情况<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[company] =&gt; company<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[occupation] =&gt; occupation<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[position] =&gt; position<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[revenue] =&gt; revenue<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[info] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[title] =&gt; 个人信息<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[field] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[idcardtype] =&gt; idcardtype<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[idcard] =&gt; idcard<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[address] =&gt; address<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[zipcode] =&gt; zipcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[site] =&gt; site<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bio] =&gt; bio<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[interest] =&gt; interest<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sightml] =&gt; sightml<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[customstatus] =&gt; customstatus<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[timeoffset] =&gt; timeoffset<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[onlyacceptfriendpm] =&gt; 0<br />
&nbsp;&nbsp;[pmreportuser] =&gt; 1<br />
&nbsp;&nbsp;[chatpmrefreshtime] =&gt; 8<br />
&nbsp;&nbsp;[preventrefresh] =&gt; 1<br />
&nbsp;&nbsp;[imagelistthumb] =&gt; 0<br />
&nbsp;&nbsp;[regconnect] =&gt; 1<br />
&nbsp;&nbsp;[connect] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[allowwidthauto] =&gt; 0<br />
&nbsp;&nbsp;[switchwidthauto] =&gt; 1<br />
&nbsp;&nbsp;[leftsidewidth] =&gt; 130<br />
&nbsp;&nbsp;[card] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[open] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[report_receive] =&gt; a:2:{s:9:&quot;adminuser&quot;;a:1:{i:0;s:1:&quot;1&quot;;}s:12:&quot;supmoderator&quot;;N;}<br />
&nbsp;&nbsp;[leftsideopen] =&gt; 0<br />
&nbsp;&nbsp;[showexif] =&gt; 0<br />
&nbsp;&nbsp;[followretainday] =&gt; 7<br />
&nbsp;&nbsp;[newbie] =&gt; 20<br />
&nbsp;&nbsp;[collectionteamworkernum] =&gt; 3<br />
&nbsp;&nbsp;[collectionnum] =&gt; 10<br />
&nbsp;&nbsp;[blockmaxaggregationitem] =&gt; 20000<br />
&nbsp;&nbsp;[moddetail] =&gt; 0<br />
&nbsp;&nbsp;[antitheft] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allow] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[max] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[repliesrank] =&gt; 1<br />
&nbsp;&nbsp;[threadblacklist] =&gt; 1<br />
&nbsp;&nbsp;[threadhotreplies] =&gt; 3<br />
&nbsp;&nbsp;[threadfilternum] =&gt; 10<br />
&nbsp;&nbsp;[hidefilteredpost] =&gt; 0<br />
&nbsp;&nbsp;[forumdisplaythreadpreview] =&gt; 1<br />
&nbsp;&nbsp;[nofilteredpost] =&gt; 0<br />
&nbsp;&nbsp;[filterednovote] =&gt; 1<br />
&nbsp;&nbsp;[numbercard] =&gt; a:1:{s:3:&quot;row&quot;;a:3:{i:1;s:7:&quot;threads&quot;;i:2;s:5:&quot;posts&quot;;i:3;s:7:&quot;credits&quot;;}}<br />
&nbsp;&nbsp;[darkroom] =&gt; 1<br />
&nbsp;&nbsp;[creditspolicymobile] =&gt; 0<br />
&nbsp;&nbsp;[showsignin] =&gt; 1<br />
&nbsp;&nbsp;[showfjump] =&gt; 1<br />
&nbsp;&nbsp;[grid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showgrid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[gridtype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[textleng] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fids] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[targetblank] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[showtips] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cachelife] =&gt; 600<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[showfollowcollection] =&gt; 8<br />
&nbsp;&nbsp;[allowfastreply] =&gt; 0<br />
&nbsp;&nbsp;[notifyusers] =&gt; a:1:{i:1;a:2:{s:8:&quot;username&quot;;s:5:&quot;admin&quot;;s:5:&quot;types&quot;;s:20:&quot;11111111111111111111&quot;;}}<br />
&nbsp;&nbsp;[homestatus] =&gt; 0<br />
&nbsp;&nbsp;[article_tags] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 原创<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 热点<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; 组图<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; 爆料<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; 头条<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; 幻灯<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; 滚动<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; 推荐<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[security_usergroups_white_list] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[security_safelogin] =&gt; 1<br />
&nbsp;&nbsp;[forumstickthreads] =&gt; a:0:{}<br />
&nbsp;&nbsp;[upgrade] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[patch] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isupdatedb] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isupdatetemplate] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[latestversion] =&gt; 3.1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[latestrelease] =&gt; 20140301<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[phpversion] =&gt; 5.1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mysqlversion] =&gt; 4.0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[upgradelist] =&gt; 3.1/20131122/patch_upgradelist.txt<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[official] =&gt; http://www.discuz.net/thread-3457145-1-1.html<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[disfixednv_forumindex] =&gt; 0<br />
&nbsp;&nbsp;[forumpicstyle] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[thumbwidth] =&gt; 203<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[thumbheight] =&gt; 999<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[thumbnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[disfixednv_forumdisplay] =&gt; 0<br />
&nbsp;&nbsp;[disfixedavatar] =&gt; 0<br />
&nbsp;&nbsp;[disfixednv_viewthread] =&gt; 0<br />
&nbsp;&nbsp;[threadguestlite] =&gt; 0<br />
&nbsp;&nbsp;[close_leftinfo] =&gt; 0<br />
&nbsp;&nbsp;[close_leftinfo_userctrl] =&gt; 0<br />
&nbsp;&nbsp;[guestviewthumb] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[flag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[width] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[height] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[guesttipsinthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[flag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[allowreplybg] =&gt; 0<br />
&nbsp;&nbsp;[newusergroupid] =&gt; 10<br />
&nbsp;&nbsp;[buyusergroupexists] =&gt; 0<br />
&nbsp;&nbsp;[forumfids] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[version] =&gt; X3.1<br />
&nbsp;&nbsp;[cachethreadon] =&gt; 0<br />
&nbsp;&nbsp;[styles] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 默认风格<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; New<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[creditnames] =&gt; 1|威望|,2|金钱|,3|贡献|<br />
&nbsp;&nbsp;[creditstransextra] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[exchangestatus] =&gt; <br />
&nbsp;&nbsp;[transferstatus] =&gt; 1<br />
&nbsp;&nbsp;[ucenterurl] =&gt; http://127.0.0.1:31/uc_server<br />
&nbsp;&nbsp;[tradeopen] =&gt; 1<br />
&nbsp;&nbsp;[medalstatus] =&gt; 0<br />
&nbsp;&nbsp;[specialicon] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[threadplugins] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[hookscriptmobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_header_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_header_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[messagefuncs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; post_mobile_message<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[outputfuncs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewthread_postbottom] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; viewthread_postbottom_output<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[misc] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[hookscript] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewthread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pcmgr_url_safeguard] =&gt; pcmgr_url_safeguard/pcmgr_url_safeguard<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pcmgr_url_safeguard] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[outputfuncs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewthread_top] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; pcmgr_url_safeguard<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; viewthread_top_output<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewthread_postbottom] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; viewthread_postbottom_output<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[messagefuncs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[post_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; post_mobile_message<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[misc] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[connect] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[login] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[messagefuncs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[login_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; login_mobile_message<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; discuzcode<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[module] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; mobile/mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[adminid] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[funcs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; global_mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[pluginlinks] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[plugins] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; pcmgr_url_safeguard<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[func] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hookscriptmobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hookscript] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[discuzcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[version] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pcmgr_url_safeguard] =&gt; 1.1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 1.3.1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[navlogos] =&gt; <br />
&nbsp;&nbsp;[navdms] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[navmn] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forum.php] =&gt; mn_forum<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userapp.php] =&gt; mn_userapp<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[navmns] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[misc.php] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mod] =&gt; faq<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; mn_N0a2c<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[menunavs] =&gt; &lt;div class=&quot;p_pop h_pop&quot; id=&quot;mn_userapp_menu&quot; style=&quot;display: none&quot;&gt;&lt;/div&gt;<br />
&nbsp;&nbsp;[subnavs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mn_userapp] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[navs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 论坛<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[filename] =&gt; forum.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navid] =&gt; mn_forum<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[nav] =&gt; id=&quot;mn_forum&quot; &gt;&lt;a href=&quot;forum.php&quot; hidefocus=&quot;true&quot; title=&quot;BBS&quot;&nbsp;&gt;论坛&lt;span&gt;BBS&lt;/span&gt;&lt;/a<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 游戏<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[filename] =&gt; userapp.php<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navid] =&gt; mn_userapp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[nav] =&gt; id=&quot;mn_userapp&quot; onmouseover=&quot;delayShow(this, function () {showMenu({'ctrlid':'mn_userapp','pos':'43!','ctrlclass':'a','duration':2});showUserApp();})&quot;&gt;&lt;a href=&quot;userapp.php&quot; hidefocus=&quot;true&quot; title=&quot;Manyou&quot;&nbsp;&gt;游戏&lt;span&gt;Manyou&lt;/span&gt;&lt;b class=&quot;icon_down&quot;&gt;&lt;/b&gt;&lt;/a<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 插件<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[filename] =&gt; #<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 帮助<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[filename] =&gt; misc.php?mod=faq<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navid] =&gt; mn_N0a2c<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[nav] =&gt; id=&quot;mn_N0a2c&quot; &gt;&lt;a href=&quot;misc.php?mod=faq&quot; hidefocus=&quot;true&quot; title=&quot;Help&quot;&nbsp;&gt;帮助&lt;span&gt;Help&lt;/span&gt;&lt;/a<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[footernavs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stat] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 站点统计<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;misc.php?mod=stat&quot; &gt;站点统计&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; stat<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[report] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 举报<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;javascript:;&quot;&nbsp;onclick=&quot;showWindow('miscreport', 'misc.php?mod=report&amp;url='+REPORTURL);return false;&quot;&gt;举报&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; report<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[archiver] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; Archiver<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;archiver/&quot; &gt;Archiver&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; archiver<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 手机版<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;forum.php?mobile=yes&quot; &gt;手机版&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; mobile<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[darkroom] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 小黑屋<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;forum.php?mod=misc&amp;action=showdarkroom&quot; &gt;小黑屋&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; darkroom<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[spacenavs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[126] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; {userpanelarea1}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; userpanelarea1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[127] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; {hr}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;/ul&gt;&lt;hr class=&quot;da&quot; /&gt;&lt;ul&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[128] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; {userpanelarea2}<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; userpanelarea2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[mynavs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[friend] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 好友<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;home.php?mod=space&amp;do=friend&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/friend_b.png) !important&quot;&gt;好友&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[thread] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 帖子<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;forum.php?mod=guide&amp;view=my&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/thread_b.png) !important&quot;&gt;帖子&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favorite] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 收藏<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;home.php?mod=space&amp;do=favorite&amp;view=me&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/favorite_b.png) !important&quot;&gt;收藏&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[magic] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 道具<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;home.php?mod=magic&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/magic_b.png) !important&quot;&gt;道具&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[medal] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 勋章<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;home.php?mod=medal&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/medal_b.png) !important&quot;&gt;勋章&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[task] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 任务<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;home.php?mod=task&quot; style=&quot;background-image:url(http://127.0.0.1:31/static/image/feed/task_b.png) !important&quot;&gt;任务&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[topnavs] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sethomepage] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 设为首页<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;javascript:;&quot;&nbsp;onclick=&quot;setHomepage('http://127.0.0.1:31/');&quot;&gt;设为首页&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; sethomepage<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[setfavorite] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[navname] =&gt; 收藏本站<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; &lt;a href=&quot;http://127.0.0.1:31/&quot;&nbsp;onclick=&quot;addFavorite(this.href, '幻影网');return false;&quot;&gt;收藏本站&lt;/a&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; setfavorite<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[profilenode] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[template] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[left] =&gt; {Gi9AiPK5}<br />
{fldg4aKM}<br />
{AlWaDRDW}<br />
{zC0ANuWd}<br />
{pLaeez6i}<br />
{n6U7tVv6}<br />
&lt;dl class=&quot;pil cl&quot;&gt;<br />
	&lt;dt&gt;{uQ3g0ROy}&lt;/dt&gt;&lt;dd&gt;{o5icfUfb}&lt;/dd&gt;<br />
&lt;/dl&gt;<br />
{AWW22S7i}<br />
&lt;dl class=&quot;pil cl&quot;&gt;{ii5ipE0e}&lt;/dl&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[top] =&gt; &lt;dl class=&quot;cl&quot;&gt;<br />
&lt;dt&gt;{UBTpUnk7}&lt;/dt&gt;&lt;dd&gt;{X9FBEJez}&lt;/dd&gt;<br />
&lt;/dl&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[code] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[left] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{Gi9AiPK5}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; numbercard<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{fldg4aKM}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; groupicon<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{AlWaDRDW}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; authortitle<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p&gt;&lt;em&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/em&gt;&lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{zC0ANuWd}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; customstatus<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p class=&quot;xg1&quot;&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{pLaeez6i}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; star<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{n6U7tVv6}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; upgradeprogress<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{uQ3g0ROy}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; baseinfo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; credits,1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{o5icfUfb}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; baseinfo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; credits,0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{AWW22S7i}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; medal<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; &lt;p class=&quot;md_ctrl&quot;&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; &lt;/p&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{ii5ipE0e}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; baseinfo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; field_qq,0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[top] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{UBTpUnk7}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; baseinfo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; credits,1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{X9FBEJez}] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; baseinfo<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; credits,0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[allowsynlogin] =&gt; 0<br />
&nbsp;&nbsp;[ucappopen] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[ucapp] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[uchomeurl] =&gt; <br />
&nbsp;&nbsp;[discuzurl] =&gt; http://127.0.0.1:31<br />
&nbsp;&nbsp;[homeshow] =&gt; 0<br />
&nbsp;&nbsp;[output] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[str] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[preg] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[pluginhooks] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[common] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_header] =&gt; <br />
&lt;div class=&quot;checkin&quot;&gt;<br />
&lt;div class=&quot;loading&quot;&gt;&lt;img src=&quot;static/image/common/checkin_loading.gif&quot; /&gt;&lt;/div&gt;<br />
&lt;div class=&quot;checkin_ajax&quot;&gt;<br />
&lt;div class=&quot;font&quot;&gt;签到&lt;/div&gt;<br />
&lt;div class=&quot;continuous&quot;&gt;连续 &lt;span class=&quot;num&quot;&gt;2&lt;/span&gt; 天&lt;/div&gt;<br />
&lt;div class=&quot;credit&quot;&gt;+10&lt;/div&gt;<br />
<br />
&lt;/div&gt;<br />
&lt;div class=&quot;checkin_body&quot;&gt;<br />
<br />
&lt;/div&gt;<br />
&lt;/div&gt;<br />
&lt;script&gt;<br />
<br />
jQuery(function($) {<br />
<br />
$(&quot;.checkin_ajax&quot;).click( function () {<br />
checkin_loadinng();<br />
$.getJSON('home.php?mod=checkin', function(data){<br />
if (data.scode == '1') {<br />
checkin_loadinng(true);<br />
$('.checkin_body').html(data.content);<br />
}<br />
});<br />
});<br />
});<br />
<br />
function checkin_loadinng(end){<br />
if(end){<br />
jQuery(&quot;.checkin .loading&quot;).height(0);<br />
jQuery(&quot;.checkin .loading img&quot;).offset({ top: 0, left: 70 });<br />
jQuery(&quot;.checkin .loading&quot;).hide();<br />
<br />
}else{<br />
if(jQuery(&quot;.checkin .loading&quot;).css(&quot;display&quot;) == 'none'){<br />
jQuery(&quot;.checkin .loading&quot;).show();<br />
jQuery(&quot;.checkin .loading&quot;).height(jQuery(&quot;.checkin&quot;).height());<br />
<br />
var position = jQuery(&quot;.checkin&quot;).position();<br />
jQuery(&quot;.checkin .loading img&quot;).offset({ top: ((jQuery(&quot;.checkin&quot;).height()-30)/2+position.top), left:70 });<br />
}<br />
}<br />
<br />
}<br />
<br />
<br />
function checkin_input(){<br />
jQuery(&quot;.checkin_click .text a&quot;).hide();<br />
jQuery(&quot;.checkin_click .text input&quot;).show();<br />
}<br />
function checkin_btn(){<br />
var getdata = '&amp;checkinmood='+encodeURIComponent(jQuery(&quot;#checkinmood&quot;).val())<br />
if(jQuery(&quot;#checkintext&quot;).val()){<br />
getdata += '&amp;'+'checkintext='+encodeURIComponent(jQuery(&quot;#checkintext&quot;).val());<br />
}<br />
<br />
jQuery.getJSON('home.php?mod=checkin&amp;inajax=1'+getdata, function(data){<br />
checkin_loadinng();<br />
if (data.scode == '1') {<br />
<br />
jQuery(&quot;.checkin_ajax .num&quot;).text(data.num);<br />
jQuery(&quot;.checkin_ajax&quot;).addClass('visted');<br />
jQuery(&quot;.checkin_ajax&quot;).click();<br />
}<br />
});<br />
}<br />
<br />
<br />
&lt;/script&gt;<br />
<br />
<br />
<br />
&lt;style&gt;<br />
.ccdar{}<br />
.ccdar td {background-color: #FFDFBF;width:30px;height: 30px;text-align: center;}<br />
.ccdar_tit{}<br />
.ccdar_last{color:#999}<br />
.ccdar_today{font-weight:700}<br />
td.ccdar_visted{background-color: #A2FFD0;}<br />
td.ccdar_visted img{width: 40px;}<br />
<br />
.checkin {<br />
&nbsp;<br />
}<br />
.checkin .loading {<br />
z-index:999;<br />
 position: absolute;<br />
&nbsp;&nbsp;background-color: #ff6f3d;<br />
width: 260px;<br />
<br />
display:none;<br />
filter:alpha(opacity=50);&nbsp;/*支持 IE 浏览器*/<br />
-moz-opacity:0.50; /*支持 FireFox 浏览器*/<br />
opacity:0.50;&nbsp;/*支持 Chrome, Opera, Safari 等浏览器*/<br />
<br />
}<br />
.checkin .loading img{<br />
position: absolute;<br />
&nbsp;&nbsp;top: 15px;<br />
&nbsp;&nbsp;left: 65px;<br />
<br />
}<br />
.checkin_body {<br />
}<br />
.checkin_click{<br />
<br />
}<br />
.checkin_click .mood{<br />
border : 1px solid #C2D5E3;<br />
width: 100px;<br />
display: inline-block;<br />
}<br />
.checkin_click .mood img{<br />
width: 50px;<br />
}<br />
.checkin_click .text{<br />
line-height: 20px;<br />
font-size: 14px;<br />
<br />
width: 200px; color: #333;<br />
background: #fff;<br />
border: 1px solid #e8e8e8;<br />
display: inline-block; <br />
<br />
}<br />
<br />
.checkin_click .text a{<br />
line-height: 40px;<br />
height:40px;<br />
background: none;<br />
<br />
}<br />
<br />
.checkin_click .text input{<br />
padding:0px;margin:0px;<br />
font-size: 14px;<br />
width: 100%;<br />
border: 0px;<br />
padding: 0px;<br />
line-height: 40px;<br />
padding-left:20px;<br />
background: none;<br />
display:none<br />
}<br />
<br />
.checkin_click .click{<br />
border: 1px solid #4899d7;<br />
border-radius: 2px;<br />
text-align: center;<br />
width: 100px;<br />
background: #60b0ee;<br />
color: #fff;<br />
display: inline-block;<br />
padding: 2px 2px;<br />
}<br />
<br />
.checkin_click&nbsp;.click .btn{<br />
width: 100px;<br />
display: inline-block;<br />
font-size: 12px;<br />
padding: 0 12px;<br />
line-height: 30px;<br />
border-radius: 2px;<br />
text-align: center;<br />
color: #fff;<br />
display: inline-block;<br />
padding: 2px 2px;<br />
font-weight:700<br />
<br />
}<br />
<br />
<br />
<br />
.checkin_ajax {<br />
&nbsp; width: 260px;<br />
&nbsp;&nbsp;height: 60px;<br />
&nbsp;&nbsp;background-color: #ff6f3d;<br />
&nbsp;&nbsp;height: 60px;<br />
&nbsp;&nbsp;display: block;<br />
&nbsp;&nbsp;position: relative;<br />
&nbsp;&nbsp;/*border-radius: 5px;*/<br />
&nbsp;&nbsp;background-image: url(http://img03.mifile.cn/webfile/images/hd/2013120901/tou.png?234);<br />
&nbsp;&nbsp;background-repeat: no-repeat;<br />
&nbsp;&nbsp;background-position: 23px 12px;<br />
&nbsp;&nbsp;cursor: pointer;<br />
}<br />
<br />
.checkin_ajax .font {<br />
&nbsp;&nbsp;position: absolute;<br />
&nbsp;&nbsp;color: #fff;<br />
&nbsp;&nbsp;width: 55px;<br />
&nbsp;&nbsp;height: 30px;<br />
&nbsp;&nbsp;font-size: 24px;<br />
&nbsp;&nbsp;line-height: 30px;<br />
&nbsp;&nbsp;top: 15px;<br />
&nbsp;&nbsp;left: 65px;<br />
}<br />
<br />
<br />
.checkin_ajax .continuous {<br />
&nbsp;&nbsp;display: none;<br />
}<br />
<br />
.visted .font {<br />
&nbsp;&nbsp;font-size: 20px;<br />
&nbsp;&nbsp;line-height: 25px;<br />
&nbsp;&nbsp;width: 60px;<br />
&nbsp;&nbsp;left: 62px;<br />
&nbsp;&nbsp;top: 10px;<br />
}<br />
.visted .continuous {<br />
&nbsp;&nbsp;display: block;<br />
&nbsp;&nbsp;font-size: 12px;<br />
&nbsp;&nbsp;line-height: 20px;<br />
&nbsp;&nbsp;position: absolute;<br />
&nbsp;&nbsp;color: #fff;<br />
&nbsp;&nbsp;text-align: center;<br />
top: 31px;<br />
&nbsp;&nbsp;left: 65px;<br />
}<br />
<br />
<br />
.checkin_ajax .credit {<br />
&nbsp;&nbsp;height: 56px;<br />
&nbsp;&nbsp;width: 80px;<br />
&nbsp;&nbsp;background-color: #fff;<br />
&nbsp;&nbsp;padding-left: 0px;<br />
&nbsp;&nbsp;padding-right: 0px;<br />
&nbsp;&nbsp;position: absolute;<br />
&nbsp;&nbsp;top: 2px;<br />
&nbsp;&nbsp;right: 2px;<br />
&nbsp;&nbsp;font-size: 20px;<br />
&nbsp;&nbsp;color: #606060;<br />
 text-align : center; <br />
line-height:56px;<br />
}<br />
<br />
<br />
&lt;/style&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global_mobile] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_headerbanner] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_subnavbanner] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_text] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_threadlist] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_footerbanner] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_float] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_couplebanner] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ad_cornerbanner] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[threadhidethreshold] =&gt; 1<br />
)<br />
</li><li><a name="S_member"></a><br />['member'] => Array<br />
(<br />
&nbsp;&nbsp;[uid] =&gt; 1<br />
&nbsp;&nbsp;[email] =&gt; admin@admin.com<br />
&nbsp;&nbsp;[username] =&gt; admin<br />
&nbsp;&nbsp;[password] =&gt; f70eb24bdd6b8b6d1d263787c2d7298e<br />
&nbsp;&nbsp;[status] =&gt; 0<br />
&nbsp;&nbsp;[emailstatus] =&gt; 0<br />
&nbsp;&nbsp;[avatarstatus] =&gt; 0<br />
&nbsp;&nbsp;[videophotostatus] =&gt; 0<br />
&nbsp;&nbsp;[adminid] =&gt; 1<br />
&nbsp;&nbsp;[groupid] =&gt; 1<br />
&nbsp;&nbsp;[groupexpiry] =&gt; 0<br />
&nbsp;&nbsp;[extgroupids] =&gt; <br />
&nbsp;&nbsp;[regdate] =&gt; 1385442518<br />
&nbsp;&nbsp;[credits] =&gt; 398<br />
&nbsp;&nbsp;[notifysound] =&gt; 0<br />
&nbsp;&nbsp;[timeoffset] =&gt; 8<br />
&nbsp;&nbsp;[newpm] =&gt; 0<br />
&nbsp;&nbsp;[newprompt] =&gt; 0<br />
&nbsp;&nbsp;[accessmasks] =&gt; 0<br />
&nbsp;&nbsp;[allowadmincp] =&gt; 1<br />
&nbsp;&nbsp;[onlyacceptfriendpm] =&gt; 0<br />
&nbsp;&nbsp;[conisbind] =&gt; 0<br />
&nbsp;&nbsp;[freeze] =&gt; 0<br />
&nbsp;&nbsp;[lastvisit] =&gt; 1397037199<br />
)<br />
</li><li><a name="S_group"></a><br />['group'] => Array<br />
(<br />
&nbsp;&nbsp;[groupid] =&gt; 1<br />
&nbsp;&nbsp;[radminid] =&gt; 1<br />
&nbsp;&nbsp;[grouptitle] =&gt; 管理员<br />
&nbsp;&nbsp;[stars] =&gt; 9<br />
&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;[allowvisit] =&gt; 1<br />
&nbsp;&nbsp;[allowsendpm] =&gt; 1<br />
&nbsp;&nbsp;[allowinvite] =&gt; 1<br />
&nbsp;&nbsp;[allowmailinvite] =&gt; 1<br />
&nbsp;&nbsp;[maxinvitenum] =&gt; 0<br />
&nbsp;&nbsp;[inviteprice] =&gt; 0<br />
&nbsp;&nbsp;[maxinviteday] =&gt; 10<br />
&nbsp;&nbsp;[readaccess] =&gt; 200<br />
&nbsp;&nbsp;[allowpost] =&gt; 1<br />
&nbsp;&nbsp;[allowreply] =&gt; 1<br />
&nbsp;&nbsp;[allowpostpoll] =&gt; 1<br />
&nbsp;&nbsp;[allowpostreward] =&gt; <br />
&nbsp;&nbsp;[allowposttrade] =&gt; <br />
&nbsp;&nbsp;[allowpostactivity] =&gt; <br />
&nbsp;&nbsp;[allowdirectpost] =&gt; 3<br />
&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;[allowpostattach] =&gt; 1<br />
&nbsp;&nbsp;[allowpostimage] =&gt; 1<br />
&nbsp;&nbsp;[allowvote] =&gt; 1<br />
&nbsp;&nbsp;[allowsearch] =&gt; 127<br />
&nbsp;&nbsp;[allowcstatus] =&gt; 1<br />
&nbsp;&nbsp;[allowinvisible] =&gt; 1<br />
&nbsp;&nbsp;[allowtransfer] =&gt; 1<br />
&nbsp;&nbsp;[allowsetreadperm] =&gt; 1<br />
&nbsp;&nbsp;[allowsetattachperm] =&gt; 1<br />
&nbsp;&nbsp;[allowposttag] =&gt; 1<br />
&nbsp;&nbsp;[allowhidecode] =&gt; 1<br />
&nbsp;&nbsp;[allowhtml] =&gt; 1<br />
&nbsp;&nbsp;[allowanonymous] =&gt; 1<br />
&nbsp;&nbsp;[allowsigbbcode] =&gt; 1<br />
&nbsp;&nbsp;[allowsigimgcode] =&gt; 1<br />
&nbsp;&nbsp;[allowmagics] =&gt; 2<br />
&nbsp;&nbsp;[disableperiodctrl] =&gt; 1<br />
&nbsp;&nbsp;[reasonpm] =&gt; 0<br />
&nbsp;&nbsp;[maxprice] =&gt; 30<br />
&nbsp;&nbsp;[maxsigsize] =&gt; 500<br />
&nbsp;&nbsp;[maxattachsize] =&gt; 2048000<br />
&nbsp;&nbsp;[maxsizeperday] =&gt; 0<br />
&nbsp;&nbsp;[maxthreadsperhour] =&gt; 0<br />
&nbsp;&nbsp;[maxpostsperhour] =&gt; 0<br />
&nbsp;&nbsp;[attachextensions] =&gt; <br />
&nbsp;&nbsp;[raterange] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[loginreward] =&gt; <br />
&nbsp;&nbsp;[mintradeprice] =&gt; 1<br />
&nbsp;&nbsp;[maxtradeprice] =&gt; 0<br />
&nbsp;&nbsp;[minrewardprice] =&gt; 1<br />
&nbsp;&nbsp;[maxrewardprice] =&gt; 0<br />
&nbsp;&nbsp;[magicsdiscount] =&gt; 0<br />
&nbsp;&nbsp;[maxmagicsweight] =&gt; 200<br />
&nbsp;&nbsp;[allowpostdebate] =&gt; <br />
&nbsp;&nbsp;[tradestick] =&gt; 5<br />
&nbsp;&nbsp;[exempt] =&gt; 255<br />
&nbsp;&nbsp;[maxattachnum] =&gt; 0<br />
&nbsp;&nbsp;[allowposturl] =&gt; 3<br />
&nbsp;&nbsp;[allowrecommend] =&gt; 1<br />
&nbsp;&nbsp;[allowpostrushreply] =&gt; 1<br />
&nbsp;&nbsp;[maxfriendnum] =&gt; 0<br />
&nbsp;&nbsp;[maxspacesize] =&gt; 0<br />
&nbsp;&nbsp;[allowcomment] =&gt; 1<br />
&nbsp;&nbsp;[allowcommentarticle] =&gt; 1000<br />
&nbsp;&nbsp;[searchinterval] =&gt; 0<br />
&nbsp;&nbsp;[searchignore] =&gt; 0<br />
&nbsp;&nbsp;[allowblog] =&gt; 1<br />
&nbsp;&nbsp;[allowdoing] =&gt; 1<br />
&nbsp;&nbsp;[allowupload] =&gt; 1<br />
&nbsp;&nbsp;[allowshare] =&gt; 1<br />
&nbsp;&nbsp;[allowblogmod] =&gt; 0<br />
&nbsp;&nbsp;[allowdoingmod] =&gt; 0<br />
&nbsp;&nbsp;[allowuploadmod] =&gt; 0<br />
&nbsp;&nbsp;[allowsharemod] =&gt; 0<br />
&nbsp;&nbsp;[allowcss] =&gt; 0<br />
&nbsp;&nbsp;[allowpoke] =&gt; 1<br />
&nbsp;&nbsp;[allowfriend] =&gt; 1<br />
&nbsp;&nbsp;[allowclick] =&gt; 1<br />
&nbsp;&nbsp;[allowmagic] =&gt; 0<br />
&nbsp;&nbsp;[allowstat] =&gt; 1<br />
&nbsp;&nbsp;[allowstatdata] =&gt; 1<br />
&nbsp;&nbsp;[videophotoignore] =&gt; 1<br />
&nbsp;&nbsp;[allowviewvideophoto] =&gt; 1<br />
&nbsp;&nbsp;[allowmyop] =&gt; 1<br />
&nbsp;&nbsp;[magicdiscount] =&gt; 0<br />
&nbsp;&nbsp;[domainlength] =&gt; 5<br />
&nbsp;&nbsp;[seccode] =&gt; 1<br />
&nbsp;&nbsp;[disablepostctrl] =&gt; 1<br />
&nbsp;&nbsp;[allowbuildgroup] =&gt; 30<br />
&nbsp;&nbsp;[allowgroupdirectpost] =&gt; 3<br />
&nbsp;&nbsp;[allowgroupposturl] =&gt; 3<br />
&nbsp;&nbsp;[edittimelimit] =&gt; 0<br />
&nbsp;&nbsp;[allowpostarticle] =&gt; 1<br />
&nbsp;&nbsp;[allowdownlocalimg] =&gt; 1<br />
&nbsp;&nbsp;[allowdownremoteimg] =&gt; 1<br />
&nbsp;&nbsp;[allowpostarticlemod] =&gt; 0<br />
&nbsp;&nbsp;[allowspacediyhtml] =&gt; 1<br />
&nbsp;&nbsp;[allowspacediybbcode] =&gt; 1<br />
&nbsp;&nbsp;[allowspacediyimgcode] =&gt; 1<br />
&nbsp;&nbsp;[allowcommentpost] =&gt; 3<br />
&nbsp;&nbsp;[allowcommentitem] =&gt; 1<br />
&nbsp;&nbsp;[allowcommentreply] =&gt; 0<br />
&nbsp;&nbsp;[allowreplycredit] =&gt; 1<br />
&nbsp;&nbsp;[ignorecensor] =&gt; 1<br />
&nbsp;&nbsp;[allowsendallpm] =&gt; 1<br />
&nbsp;&nbsp;[allowsendpmmaxnum] =&gt; 0<br />
&nbsp;&nbsp;[maximagesize] =&gt; 0<br />
&nbsp;&nbsp;[allowmediacode] =&gt; 1<br />
&nbsp;&nbsp;[allowbegincode] =&gt; 1<br />
&nbsp;&nbsp;[allowat] =&gt; 50<br />
&nbsp;&nbsp;[allowsetpublishdate] =&gt; 0<br />
&nbsp;&nbsp;[allowfollowcollection] =&gt; 30<br />
&nbsp;&nbsp;[allowcommentcollection] =&gt; 1<br />
&nbsp;&nbsp;[allowcreatecollection] =&gt; 5<br />
&nbsp;&nbsp;[forcesecques] =&gt; 0<br />
&nbsp;&nbsp;[forcelogin] =&gt; 0<br />
&nbsp;&nbsp;[closead] =&gt; 0<br />
&nbsp;&nbsp;[buildgroupcredits] =&gt; 0<br />
&nbsp;&nbsp;[allowimgcontent] =&gt; 0<br />
&nbsp;&nbsp;[alloweditpost] =&gt; 1<br />
&nbsp;&nbsp;[alloweditpoll] =&gt; 1<br />
&nbsp;&nbsp;[allowstickthread] =&gt; 3<br />
&nbsp;&nbsp;[allowmodpost] =&gt; 1<br />
&nbsp;&nbsp;[allowdelpost] =&gt; 1<br />
&nbsp;&nbsp;[allowmassprune] =&gt; 1<br />
&nbsp;&nbsp;[allowrefund] =&gt; 1<br />
&nbsp;&nbsp;[allowcensorword] =&gt; 1<br />
&nbsp;&nbsp;[allowviewip] =&gt; 1<br />
&nbsp;&nbsp;[allowbanip] =&gt; 1<br />
&nbsp;&nbsp;[allowedituser] =&gt; 1<br />
&nbsp;&nbsp;[allowmoduser] =&gt; 1<br />
&nbsp;&nbsp;[allowbanuser] =&gt; 1<br />
&nbsp;&nbsp;[allowbanvisituser] =&gt; 1<br />
&nbsp;&nbsp;[allowpostannounce] =&gt; 1<br />
&nbsp;&nbsp;[allowviewlog] =&gt; 1<br />
&nbsp;&nbsp;[allowbanpost] =&gt; 1<br />
&nbsp;&nbsp;[supe_allowpushthread] =&gt; 1<br />
&nbsp;&nbsp;[allowhighlightthread] =&gt; 1<br />
&nbsp;&nbsp;[allowlivethread] =&gt; 1<br />
&nbsp;&nbsp;[allowdigestthread] =&gt; 3<br />
&nbsp;&nbsp;[allowrecommendthread] =&gt; 1<br />
&nbsp;&nbsp;[allowbumpthread] =&gt; 1<br />
&nbsp;&nbsp;[allowclosethread] =&gt; 1<br />
&nbsp;&nbsp;[allowmovethread] =&gt; 1<br />
&nbsp;&nbsp;[allowedittypethread] =&gt; 1<br />
&nbsp;&nbsp;[allowstampthread] =&gt; 1<br />
&nbsp;&nbsp;[allowstamplist] =&gt; 1<br />
&nbsp;&nbsp;[allowcopythread] =&gt; 1<br />
&nbsp;&nbsp;[allowmergethread] =&gt; 1<br />
&nbsp;&nbsp;[allowsplitthread] =&gt; 1<br />
&nbsp;&nbsp;[allowrepairthread] =&gt; 1<br />
&nbsp;&nbsp;[allowwarnpost] =&gt; 1<br />
&nbsp;&nbsp;[allowviewreport] =&gt; 1<br />
&nbsp;&nbsp;[alloweditforum] =&gt; 1<br />
&nbsp;&nbsp;[allowremovereward] =&gt; 1<br />
&nbsp;&nbsp;[allowedittrade] =&gt; 1<br />
&nbsp;&nbsp;[alloweditactivity] =&gt; 1<br />
&nbsp;&nbsp;[allowstickreply] =&gt; 1<br />
&nbsp;&nbsp;[allowmanagearticle] =&gt; 1<br />
&nbsp;&nbsp;[allowaddtopic] =&gt; 1<br />
&nbsp;&nbsp;[allowmanagetopic] =&gt; 1<br />
&nbsp;&nbsp;[allowdiy] =&gt; 1<br />
&nbsp;&nbsp;[allowclearrecycle] =&gt; 1<br />
&nbsp;&nbsp;[allowmanagetag] =&gt; 1<br />
&nbsp;&nbsp;[alloweditusertag] =&gt; 0<br />
&nbsp;&nbsp;[managefeed] =&gt; 1<br />
&nbsp;&nbsp;[managedoing] =&gt; 1<br />
&nbsp;&nbsp;[manageshare] =&gt; 1<br />
&nbsp;&nbsp;[manageblog] =&gt; 1<br />
&nbsp;&nbsp;[managealbum] =&gt; 1<br />
&nbsp;&nbsp;[managecomment] =&gt; 1<br />
&nbsp;&nbsp;[managemagiclog] =&gt; 1<br />
&nbsp;&nbsp;[managereport] =&gt; 1<br />
&nbsp;&nbsp;[managehotuser] =&gt; 1<br />
&nbsp;&nbsp;[managedefaultuser] =&gt; 1<br />
&nbsp;&nbsp;[managevideophoto] =&gt; 1<br />
&nbsp;&nbsp;[managemagic] =&gt; 1<br />
&nbsp;&nbsp;[manageclick] =&gt; 1<br />
&nbsp;&nbsp;[allowmanagecollection] =&gt; 1<br />
&nbsp;&nbsp;[allowmakehtml] =&gt; 1<br />
&nbsp;&nbsp;[grouptype] =&gt; system<br />
&nbsp;&nbsp;[grouppublic] =&gt; <br />
&nbsp;&nbsp;[groupcreditshigher] =&gt; 0<br />
&nbsp;&nbsp;[groupcreditslower] =&gt; 0<br />
&nbsp;&nbsp;[allowthreadplugin] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[plugin] =&gt; <br />
)<br />
</li><li><a name="S_cookie"></a><br />['cookie'] => Array<br />
(<br />
&nbsp;&nbsp;[saltkey] =&gt; gwd99H83<br />
&nbsp;&nbsp;[lastvisit] =&gt; 1397037199<br />
&nbsp;&nbsp;[auth] =&gt; d991hcF5ULtJfT35d4whDTeu6N5nwnqKeK1bUpNXKuxVkr2bW5PXaR+c93ltVo3kdWDLbQB0X6t3Cu7u6wqd<br />
&nbsp;&nbsp;[lastcheckfeed] =&gt; 1|1397040804<br />
&nbsp;&nbsp;[nofavfid] =&gt; 1<br />
&nbsp;&nbsp;[st_p] =&gt; 1|1397114571|90543aa0c0edc8608ca14d2519316bfa<br />
&nbsp;&nbsp;[visitedfid] =&gt; 2D36<br />
&nbsp;&nbsp;[viewid] =&gt; tid_76<br />
&nbsp;&nbsp;[smile] =&gt; 1D1<br />
&nbsp;&nbsp;[creditnotice] =&gt; 0D0D2D0D0D0D0D0D0D1<br />
&nbsp;&nbsp;[creditbase] =&gt; 0D0D381D0D0D0D0D0D0<br />
&nbsp;&nbsp;[creditrule] =&gt; 每天登录<br />
&nbsp;&nbsp;[lip] =&gt; 127.0.0.1,1397199507<br />
&nbsp;&nbsp;[sid] =&gt; mYdDzQ<br />
&nbsp;&nbsp;[ulastactivity] =&gt; 7d602pLgAowPdPxYJWR2kI4iCg8JI8dAIyqCWqEOBpUea8QcvtpA<br />
&nbsp;&nbsp;[onlineusernum] =&gt; 1<br />
&nbsp;&nbsp;[sendmail] =&gt; 1<br />
&nbsp;&nbsp;[checkpatch] =&gt; 1<br />
&nbsp;&nbsp;[lastact] =&gt; 1397199518	forum.php	forumdisplay<br />
&nbsp;&nbsp;[checkpm] =&gt; 1<br />
&nbsp;&nbsp;[st_t] =&gt; 1|1397199518|1e9f4a6c78274d6eaf5abce69aded7c8<br />
&nbsp;&nbsp;[forum_lastvisit] =&gt; D_2_1397199518<br />
&nbsp;&nbsp;[extra] =&gt; fid=2&amp;page=1<br />
)<br />
</li><li><a name="S_style"></a><br />['style'] => Array<br />
(<br />
&nbsp;&nbsp;[styleid] =&gt; 2<br />
&nbsp;&nbsp;[name] =&gt; New<br />
&nbsp;&nbsp;[available] =&gt; <br />
&nbsp;&nbsp;[templateid] =&gt; 2<br />
&nbsp;&nbsp;[extstyle] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[tplname] =&gt; new<br />
&nbsp;&nbsp;[directory] =&gt; ./template/new<br />
&nbsp;&nbsp;[copyright] =&gt; lenovo.com<br />
&nbsp;&nbsp;[tpldir] =&gt; ./template/new<br />
&nbsp;&nbsp;[menuhoverbgcolor] =&gt; #005AB4<br />
&nbsp;&nbsp;[lightlink] =&gt; #FFF<br />
&nbsp;&nbsp;[floatbgcolor] =&gt; #FFF<br />
&nbsp;&nbsp;[dropmenubgcolor] =&gt; #FEFEFE<br />
&nbsp;&nbsp;[floatmaskbgcolor] =&gt; #000<br />
&nbsp;&nbsp;[dropmenuborder] =&gt; #DDD<br />
&nbsp;&nbsp;[specialbg] =&gt; #E5EDF2<br />
&nbsp;&nbsp;[specialborder] =&gt; #C2D5E3<br />
&nbsp;&nbsp;[commonbg] =&gt; #F2F2F2<br />
&nbsp;&nbsp;[commonborder] =&gt; #CDCDCD<br />
&nbsp;&nbsp;[inputbg] =&gt; #FFF<br />
&nbsp;&nbsp;[stypeid] =&gt; 1<br />
&nbsp;&nbsp;[inputborderdarkcolor] =&gt; #848484<br />
&nbsp;&nbsp;[headerbgcolor] =&gt; <br />
&nbsp;&nbsp;[headerborder] =&gt; 0<br />
&nbsp;&nbsp;[sidebgcolor] =&gt; <br />
&nbsp;&nbsp;[msgfontsize] =&gt; 14px<br />
&nbsp;&nbsp;[bgcolor] =&gt; #FFF<br />
&nbsp;&nbsp;[noticetext] =&gt; #F26C4F<br />
&nbsp;&nbsp;[highlightlink] =&gt; #369<br />
&nbsp;&nbsp;[link] =&gt; #333<br />
&nbsp;&nbsp;[lighttext] =&gt; #999<br />
&nbsp;&nbsp;[midtext] =&gt; #666<br />
&nbsp;&nbsp;[tabletext] =&gt; #444<br />
&nbsp;&nbsp;[smfontsize] =&gt; 0.83em<br />
&nbsp;&nbsp;[threadtitlefont] =&gt; Tahoma,Helvetica,'SimSun',sans-serif<br />
&nbsp;&nbsp;[threadtitlefontsize] =&gt; 14px<br />
&nbsp;&nbsp;[smfont] =&gt; Tahoma,Helvetica,sans-serif<br />
&nbsp;&nbsp;[titlebgcolor] =&gt; #E5EDF2<br />
&nbsp;&nbsp;[fontsize] =&gt; 12px/1.5<br />
&nbsp;&nbsp;[font] =&gt; Tahoma,Helvetica,'SimSun',sans-serif<br />
&nbsp;&nbsp;[styleimgdir] =&gt; static/image/common<br />
&nbsp;&nbsp;[imgdir] =&gt; static/image/common<br />
&nbsp;&nbsp;[boardimg] =&gt; static/image/common/logo.png<br />
&nbsp;&nbsp;[headertext] =&gt; #444<br />
&nbsp;&nbsp;[footertext] =&gt; #666<br />
&nbsp;&nbsp;[menubgcolor] =&gt; #2B7ACD<br />
&nbsp;&nbsp;[menutext] =&gt; #FFF<br />
&nbsp;&nbsp;[menuhovertext] =&gt; #FFF<br />
&nbsp;&nbsp;[wrapbg] =&gt; #FFF<br />
&nbsp;&nbsp;[wrapbordercolor] =&gt; #CCC<br />
&nbsp;&nbsp;[contentwidth] =&gt; 630px<br />
&nbsp;&nbsp;[contentseparate] =&gt; #C2D5E3<br />
&nbsp;&nbsp;[inputborder] =&gt; #E0E0E0<br />
&nbsp;&nbsp;[menuhoverbgcode] =&gt; background: #005AB4 url(&quot;static/image/common/nv_a.png&quot;) no-repeat 50% -33px<br />
&nbsp;&nbsp;[floatbgcode] =&gt; background: #FFF<br />
&nbsp;&nbsp;[dropmenubgcode] =&gt; background: #FEFEFE<br />
&nbsp;&nbsp;[floatmaskbgcode] =&gt; background: #000<br />
&nbsp;&nbsp;[headerbgcode] =&gt; <br />
&nbsp;&nbsp;[sidebgcode] =&gt; background: url(&quot;static/image/common/vlineb.png&quot;) repeat-y 0 0<br />
&nbsp;&nbsp;[bgcode] =&gt; background: #FFF url(&quot;static/image/common/background.png&quot;) repeat-x 0 0<br />
&nbsp;&nbsp;[titlebgcode] =&gt; background: #E5EDF2 url(&quot;static/image/common/titlebg.png&quot;) repeat-x 0 0<br />
&nbsp;&nbsp;[menubgcode] =&gt; background: #2B7ACD url(&quot;static/image/common/nv.png&quot;) no-repeat 0 0<br />
&nbsp;&nbsp;[boardlogo] =&gt; &lt;img src=&quot;static/image/common/logo.png&quot; alt=&quot;幻影网&quot; border=&quot;0&quot; /&gt;<br />
&nbsp;&nbsp;[bold] =&gt; bold<br />
&nbsp;&nbsp;[defaultextstyle] =&gt; <br />
&nbsp;&nbsp;[verhash] =&gt; j3G<br />
&nbsp;&nbsp;[tpldirectory] =&gt; ./template/new<br />
&nbsp;&nbsp;[prefile] =&gt; <br />
&nbsp;&nbsp;[tplfile] =&gt; forum/forumdisplay:2<br />
)<br />
</li><li><a name="S_cache"></a><br />['cache'] => Array<br />
(<br />
&nbsp;&nbsp;[announcements_forum] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[cronnextrun] =&gt; 1397079000<br />
&nbsp;&nbsp;[forums] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; group<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[name] =&gt; Discuz!<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[postperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[orderby] =&gt; lastpost<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ascdesc] =&gt; DESC<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[extra] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[plugin] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[archive] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[domain] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[havepassword] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; forum<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[name] =&gt; 默认版块<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fup] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[postperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[orderby] =&gt; lastpost<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ascdesc] =&gt; DESC<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[users] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[extra] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[plugin] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostspecial] =&gt; 000001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[commentitem] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[archive] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[domain] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[havepassword] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[36] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 36<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; forum<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[name] =&gt; 用户反馈<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fup] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[viewperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[postperm] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[orderby] =&gt; lastpost<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ascdesc] =&gt; DESC<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[users] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[extra] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[plugin] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostspecial] =&gt; 000001<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[commentitem] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[archive] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[domain] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[havepassword] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[forumstick] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[globalstick] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[global] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tids] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[count] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[onlinelist] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[legend] =&gt; &lt;img src=&quot;static/image/common/online_admin.gif&quot; /&gt; 管理员 &amp;nbsp; &amp;nbsp; &amp;nbsp; &lt;img src=&quot;static/image/common/online_supermod.gif&quot; /&gt; 超级版主 &amp;nbsp; &amp;nbsp; &amp;nbsp; &lt;img src=&quot;static/image/common/online_moderator.gif&quot; /&gt; 版主 &amp;nbsp; &amp;nbsp; &amp;nbsp; &lt;img src=&quot;static/image/common/online_member.gif&quot; /&gt; 会员 &amp;nbsp; &amp;nbsp; &amp;nbsp; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; online_admin.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; online_supermod.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; online_moderator.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; online_member.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[plugin] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[pluginlanguage_system] =&gt; <br />
&nbsp;&nbsp;[smilies] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searcharray] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; /\:loveliness\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[23] =&gt; /\:handshake/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[20] =&gt; /\:victory\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[61] =&gt; /\{\:3_61\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[31] =&gt; /\{\:2_31\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[48] =&gt; /\{\:3_48\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[18] =&gt; /\:sleepy\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[35] =&gt; /\{\:2_35\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[52] =&gt; /\{\:3_52\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[39] =&gt; /\{\:2_39\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[56] =&gt; /\{\:3_56\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[26] =&gt; /\{\:2_26\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[43] =&gt; /\{\:3_43\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[60] =&gt; /\{\:3_60\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[30] =&gt; /\{\:2_30\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[47] =&gt; /\{\:3_47\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[64] =&gt; /\{\:3_64\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[17] =&gt; /\:shutup\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[34] =&gt; /\{\:2_34\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[51] =&gt; /\{\:3_51\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[38] =&gt; /\{\:2_38\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[55] =&gt; /\{\:3_55\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[25] =&gt; /\{\:2_25\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[42] =&gt; /\{\:3_42\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[59] =&gt; /\{\:3_59\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[29] =&gt; /\{\:2_29\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[46] =&gt; /\{\:3_46\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[63] =&gt; /\{\:3_63\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[33] =&gt; /\{\:2_33\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[50] =&gt; /\{\:3_50\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[37] =&gt; /\{\:2_37\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[54] =&gt; /\{\:3_54\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[41] =&gt; /\{\:3_41\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[58] =&gt; /\{\:3_58\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[28] =&gt; /\{\:2_28\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[45] =&gt; /\{\:3_45\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[62] =&gt; /\{\:3_62\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[32] =&gt; /\{\:2_32\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[49] =&gt; /\{\:3_49\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[36] =&gt; /\{\:2_36\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[53] =&gt; /\{\:3_53\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[40] =&gt; /\{\:2_40\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[57] =&gt; /\{\:3_57\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[27] =&gt; /\{\:2_27\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[44] =&gt; /\{\:3_44\:\}/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[16] =&gt; /\:dizzy\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; /\:curse\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; /\:funk\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[22] =&gt; /\:kiss\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[21] =&gt; /\:time\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[24] =&gt; /\:call\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[19] =&gt; /\:hug\:/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; /\:lol/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; /\:'\(/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; /\:\)/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; /\:@/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; /;P/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; /\:\$/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; /\:D/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; /\:P/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; /\:Q/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; /\:\(/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; /\:o/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; /\:L/<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replacearray] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; loveliness.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[23] =&gt; handshake.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[20] =&gt; victory.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[61] =&gt; 21.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[31] =&gt; 07.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[48] =&gt; 08.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[18] =&gt; sleepy.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[35] =&gt; 11.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[52] =&gt; 12.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[39] =&gt; 15.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[56] =&gt; 16.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[26] =&gt; 02.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[43] =&gt; 03.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[60] =&gt; 20.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[30] =&gt; 06.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[47] =&gt; 07.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[64] =&gt; 24.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[17] =&gt; shutup.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[34] =&gt; 10.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[51] =&gt; 11.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[38] =&gt; 14.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[55] =&gt; 15.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[25] =&gt; 01.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[42] =&gt; 02.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[59] =&gt; 19.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[29] =&gt; 05.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[46] =&gt; 06.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[63] =&gt; 23.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[33] =&gt; 09.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[50] =&gt; 10.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[37] =&gt; 13.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[54] =&gt; 14.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[41] =&gt; 01.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[58] =&gt; 18.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[28] =&gt; 04.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[45] =&gt; 05.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[62] =&gt; 22.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[32] =&gt; 08.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[49] =&gt; 09.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[36] =&gt; 12.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[53] =&gt; 13.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[40] =&gt; 16.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[57] =&gt; 17.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[27] =&gt; 03.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[44] =&gt; 04.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[16] =&gt; dizzy.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; curse.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; funk.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[22] =&gt; kiss.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[21] =&gt; time.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[24] =&gt; call.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[19] =&gt; hug.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; lol.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; cry.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; smile.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; huffy.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; titter.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; shy.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; biggrin.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; tongue.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; mad.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; sad.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; shocked.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; sweat.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typearray] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[23] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[20] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[61] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[31] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[48] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[18] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[35] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[52] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[39] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[56] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[26] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[43] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[60] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[30] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[47] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[64] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[17] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[34] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[51] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[38] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[55] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[25] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[42] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[59] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[29] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[46] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[63] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[33] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[50] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[37] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[54] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[41] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[58] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[28] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[45] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[62] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[32] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[49] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[36] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[53] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[40] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[57] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[27] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[44] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[16] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[22] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[21] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[24] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[19] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[stamps] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 001.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 精华<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 002.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 热帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 003.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 美图<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 004.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 优秀<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 005.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 置顶<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 006.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 推荐<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 007.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 原创<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 008.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 版主推荐<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 009.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 爆料<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 001.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 精华<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 002.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 热帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 003.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 美图<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 004.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 优秀<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 005.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 置顶<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 006.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 推荐<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 007.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 原创<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[16] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 008.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 版主推荐<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[17] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 009.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 爆料<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[18] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 010.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 编辑采用<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[19] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 010.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 编辑采用<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[20] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[url] =&gt; 011.small.gif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[text] =&gt; 新人帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; stamplist<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[style_default] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[styleid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[name] =&gt; New<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[available] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[templateid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[extstyle] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tplname] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[directory] =&gt; ./template/new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[copyright] =&gt; lenovo.com<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tpldir] =&gt; ./template/new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menuhoverbgcolor] =&gt; #005AB4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lightlink] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[floatbgcolor] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dropmenubgcolor] =&gt; #FEFEFE<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[floatmaskbgcolor] =&gt; #000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dropmenuborder] =&gt; #DDD<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[specialbg] =&gt; #E5EDF2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[specialborder] =&gt; #C2D5E3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[commonbg] =&gt; #F2F2F2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[commonborder] =&gt; #CDCDCD<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[inputbg] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stypeid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[inputborderdarkcolor] =&gt; #848484<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[headerbgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[headerborder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sidebgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[msgfontsize] =&gt; 14px<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[noticetext] =&gt; #F26C4F<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlightlink] =&gt; #369<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[link] =&gt; #333<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lighttext] =&gt; #999<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[midtext] =&gt; #666<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tabletext] =&gt; #444<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[smfontsize] =&gt; 0.83em<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[threadtitlefont] =&gt; Tahoma,Helvetica,'SimSun',sans-serif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[threadtitlefontsize] =&gt; 14px<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[smfont] =&gt; Tahoma,Helvetica,sans-serif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[titlebgcolor] =&gt; #E5EDF2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fontsize] =&gt; 12px/1.5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[font] =&gt; Tahoma,Helvetica,'SimSun',sans-serif<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[styleimgdir] =&gt; static/image/common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[imgdir] =&gt; static/image/common<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[boardimg] =&gt; static/image/common/logo.png<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[headertext] =&gt; #444<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[footertext] =&gt; #666<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menubgcolor] =&gt; #2B7ACD<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menutext] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menuhovertext] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[wrapbg] =&gt; #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[wrapbordercolor] =&gt; #CCC<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[contentwidth] =&gt; 630px<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[contentseparate] =&gt; #C2D5E3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[inputborder] =&gt; #E0E0E0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menuhoverbgcode] =&gt; background: #005AB4 url(&quot;static/image/common/nv_a.png&quot;) no-repeat 50% -33px<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[floatbgcode] =&gt; background: #FFF<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dropmenubgcode] =&gt; background: #FEFEFE<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[floatmaskbgcode] =&gt; background: #000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[headerbgcode] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sidebgcode] =&gt; background: url(&quot;static/image/common/vlineb.png&quot;) repeat-y 0 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcode] =&gt; background: #FFF url(&quot;static/image/common/background.png&quot;) repeat-x 0 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[titlebgcode] =&gt; background: #E5EDF2 url(&quot;static/image/common/titlebg.png&quot;) repeat-x 0 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[menubgcode] =&gt; background: #2B7ACD url(&quot;static/image/common/nv.png&quot;) no-repeat 0 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[boardlogo] =&gt; &lt;img src=&quot;static/image/common/logo.png&quot; alt=&quot;幻影网&quot; border=&quot;0&quot; /&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bold] =&gt; bold<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[defaultextstyle] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[verhash] =&gt; j3G<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[threadtableids] =&gt; <br />
&nbsp;&nbsp;[threadtable_info] =&gt; <br />
&nbsp;&nbsp;[diytemplatenameforum] =&gt; <br />
&nbsp;&nbsp;[usergroup_1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[groupid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[radminid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 管理员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 9<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowvisit] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsendpm] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowinvite] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmailinvite] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxinvitenum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[inviteprice] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxinviteday] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowreply] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostpoll] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostreward] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowposttrade] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostactivity] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdirectpost] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowvote] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsearch] =&gt; 127<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcstatus] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowinvisible] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowtransfer] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsetreadperm] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsetattachperm] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowposttag] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowhidecode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowhtml] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowanonymous] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsigbbcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsigimgcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmagics] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[disableperiodctrl] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[reasonpm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxprice] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxattachsize] =&gt; 2048000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsizeperday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxthreadsperhour] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxpostsperhour] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachextensions] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[raterange] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[loginreward] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mintradeprice] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxtradeprice] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[minrewardprice] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxrewardprice] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[magicsdiscount] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxmagicsweight] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostdebate] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tradestick] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[exempt] =&gt; 255<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxattachnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowposturl] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowrecommend] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostrushreply] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxfriendnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxspacesize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcomment] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcommentarticle] =&gt; 1000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchinterval] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[searchignore] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowblog] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdoing] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowupload] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowshare] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowblogmod] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdoingmod] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowuploadmod] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsharemod] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcss] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpoke] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowfriend] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowclick] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmagic] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstat] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstatdata] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[videophotoignore] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowviewvideophoto] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmyop] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[magicdiscount] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[domainlength] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[seccode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[disablepostctrl] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbuildgroup] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgroupdirectpost] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgroupposturl] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[edittimelimit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostarticle] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdownlocalimg] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdownremoteimg] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostarticlemod] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowspacediyhtml] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowspacediybbcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowspacediyimgcode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcommentpost] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcommentitem] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcommentreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowreplycredit] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ignorecensor] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsendallpm] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsendpmmaxnum] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maximagesize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowat] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsetpublishdate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowfollowcollection] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcommentcollection] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcreatecollection] =&gt; 5<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forcesecques] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forcelogin] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closead] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[buildgroupcredits] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowimgcontent] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[alloweditpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[alloweditpoll] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstickthread] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmodpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdelpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmassprune] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowrefund] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcensorword] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowviewip] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbanip] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowedituser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmoduser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbanuser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbanvisituser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowpostannounce] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowviewlog] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbanpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[supe_allowpushthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowhighlightthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowlivethread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdigestthread] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowrecommendthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbumpthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowclosethread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmovethread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowedittypethread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstampthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstamplist] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowcopythread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmergethread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowsplitthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowrepairthread] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowwarnpost] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowviewreport] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[alloweditforum] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowremovereward] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowedittrade] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[alloweditactivity] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowstickreply] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmanagearticle] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowaddtopic] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmanagetopic] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowdiy] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowclearrecycle] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmanagetag] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[alloweditusertag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managefeed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managedoing] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[manageshare] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[manageblog] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managealbum] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managecomment] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managemagiclog] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managereport] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managehotuser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managedefaultuser] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managevideophoto] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[managemagic] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[manageclick] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmanagecollection] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmakehtml] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptype] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouppublic] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[groupcreditshigher] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[groupcreditslower] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowthreadplugin] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[plugin] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[seccodedata] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[register] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[show] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[usergroups] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 限制会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; -9999999<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 管理员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 9<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 超级版主<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 150<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 版主<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 7<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 禁止发言<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 禁止访问<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 禁止 IP<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 游客<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 等待验证会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 新手上路<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 10<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 80<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[16] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; special<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 实习版主<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 7<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[17] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; special<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 网站编辑<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 150<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[18] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; special<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 信息监察员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 9<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[19] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; special<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 审核员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 7<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[20] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; special<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; QQ游客<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 注册会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 100<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 中级会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 150<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[13] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 高级会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 1000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 50<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 200<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[14] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 金牌会员<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 1000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 3000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 6<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 70<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 300<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[15] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[type] =&gt; member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[grouptitle] =&gt; 论坛元老<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditshigher] =&gt; 3000<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[creditslower] =&gt; 9999999<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stars] =&gt; 8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[color] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readaccess] =&gt; 90<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetattach] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowgetimage] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowmediacode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxsigsize] =&gt; 500<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allowbegincode] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[userstatusby] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[attachtype] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[diytemplatename] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[group/index] =&gt; 首页<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
)<br />
</li><li><a name="S_session"></a><br />['session'] => Array<br />
(<br />
&nbsp;&nbsp;[sid] =&gt; mYdDzQ<br />
&nbsp;&nbsp;[ip1] =&gt; 127<br />
&nbsp;&nbsp;[ip2] =&gt; 0<br />
&nbsp;&nbsp;[ip3] =&gt; 0<br />
&nbsp;&nbsp;[ip4] =&gt; 1<br />
&nbsp;&nbsp;[uid] =&gt; 1<br />
&nbsp;&nbsp;[username] =&gt; admin<br />
&nbsp;&nbsp;[groupid] =&gt; 1<br />
&nbsp;&nbsp;[invisible] =&gt; 0<br />
&nbsp;&nbsp;[action] =&gt; 2<br />
&nbsp;&nbsp;[lastactivity] =&gt; 1397199512<br />
&nbsp;&nbsp;[lastolupdate] =&gt; 1397199512<br />
&nbsp;&nbsp;[fid] =&gt; 0<br />
&nbsp;&nbsp;[tid] =&gt; 0<br />
)<br />
</li><li><a name="S_my_app"></a><br />['my_app'] => Array<br />
(<br />
)<br />
</li><li><a name="S_my_userapp"></a><br />['my_userapp'] => Array<br />
(<br />
)<br />
</li><li><a name="S_forum"></a><br />['forum'] => Array<br />
(<br />
&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;[description] =&gt; <br />
&nbsp;&nbsp;[password] =&gt; <br />
&nbsp;&nbsp;[icon] =&gt; <br />
&nbsp;&nbsp;[redirect] =&gt; <br />
&nbsp;&nbsp;[attachextensions] =&gt; <br />
&nbsp;&nbsp;[creditspolicy] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[formulaperm] =&gt; <br />
&nbsp;&nbsp;[moderators] =&gt; <br />
&nbsp;&nbsp;[rules] =&gt; <br />
&nbsp;&nbsp;[threadtypes] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[threadsorts] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[viewperm] =&gt; <br />
&nbsp;&nbsp;[postperm] =&gt; <br />
&nbsp;&nbsp;[replyperm] =&gt; <br />
&nbsp;&nbsp;[getattachperm] =&gt; <br />
&nbsp;&nbsp;[postattachperm] =&gt; <br />
&nbsp;&nbsp;[postimageperm] =&gt; <br />
&nbsp;&nbsp;[spviewperm] =&gt; <br />
&nbsp;&nbsp;[seotitle] =&gt; <br />
&nbsp;&nbsp;[keywords] =&gt; <br />
&nbsp;&nbsp;[seodescription] =&gt; <br />
&nbsp;&nbsp;[supe_pushsetting] =&gt; <br />
&nbsp;&nbsp;[modrecommend] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[threadplugin] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[replybg] =&gt; <br />
&nbsp;&nbsp;[extra] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[jointype] =&gt; 0<br />
&nbsp;&nbsp;[gviewperm] =&gt; 0<br />
&nbsp;&nbsp;[membernum] =&gt; 0<br />
&nbsp;&nbsp;[dateline] =&gt; 0<br />
&nbsp;&nbsp;[lastupdate] =&gt; 0<br />
&nbsp;&nbsp;[activity] =&gt; 0<br />
&nbsp;&nbsp;[founderuid] =&gt; 0<br />
&nbsp;&nbsp;[foundername] =&gt; <br />
&nbsp;&nbsp;[banner] =&gt; <br />
&nbsp;&nbsp;[groupnum] =&gt; 0<br />
&nbsp;&nbsp;[commentitem] =&gt; <br />
&nbsp;&nbsp;[relatedgroup] =&gt; <br />
&nbsp;&nbsp;[picstyle] =&gt; 0<br />
&nbsp;&nbsp;[widthauto] =&gt; 0<br />
&nbsp;&nbsp;[noantitheft] =&gt; 0<br />
&nbsp;&nbsp;[noforumhidewater] =&gt; 0<br />
&nbsp;&nbsp;[noforumrecommend] =&gt; 0<br />
&nbsp;&nbsp;[livetid] =&gt; 0<br />
&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;[fup] =&gt; 1<br />
&nbsp;&nbsp;[type] =&gt; forum<br />
&nbsp;&nbsp;[name] =&gt; 默认版块<br />
&nbsp;&nbsp;[status] =&gt; 1<br />
&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;[styleid] =&gt; 0<br />
&nbsp;&nbsp;[threads] =&gt; 8<br />
&nbsp;&nbsp;[posts] =&gt; 8<br />
&nbsp;&nbsp;[todayposts] =&gt; 0<br />
&nbsp;&nbsp;[yesterdayposts] =&gt; 0<br />
&nbsp;&nbsp;[rank] =&gt; 1<br />
&nbsp;&nbsp;[oldrank] =&gt; 2<br />
&nbsp;&nbsp;[lastpost] =&gt; 37	2014年03月31日签到帖	1396265526	haierspi<br />
&nbsp;&nbsp;[domain] =&gt; <br />
&nbsp;&nbsp;[allowsmilies] =&gt; 1<br />
&nbsp;&nbsp;[allowhtml] =&gt; 0<br />
&nbsp;&nbsp;[allowbbcode] =&gt; 1<br />
&nbsp;&nbsp;[allowimgcode] =&gt; 1<br />
&nbsp;&nbsp;[allowmediacode] =&gt; 1<br />
&nbsp;&nbsp;[allowanonymous] =&gt; 0<br />
&nbsp;&nbsp;[allowpostspecial] =&gt; 1<br />
&nbsp;&nbsp;[allowspecialonly] =&gt; 0<br />
&nbsp;&nbsp;[allowappend] =&gt; 0<br />
&nbsp;&nbsp;[alloweditrules] =&gt; 0<br />
&nbsp;&nbsp;[allowfeed] =&gt; 1<br />
&nbsp;&nbsp;[allowside] =&gt; 0<br />
&nbsp;&nbsp;[recyclebin] =&gt; 1<br />
&nbsp;&nbsp;[modnewposts] =&gt; 0<br />
&nbsp;&nbsp;[jammer] =&gt; 0<br />
&nbsp;&nbsp;[disablewatermark] =&gt; 0<br />
&nbsp;&nbsp;[inheritedmod] =&gt; 0<br />
&nbsp;&nbsp;[autoclose] =&gt; 0<br />
&nbsp;&nbsp;[forumcolumns] =&gt; 0<br />
&nbsp;&nbsp;[catforumcolumns] =&gt; 0<br />
&nbsp;&nbsp;[threadcaches] =&gt; 0<br />
&nbsp;&nbsp;[alloweditpost] =&gt; 1<br />
&nbsp;&nbsp;[simple] =&gt; 0<br />
&nbsp;&nbsp;[modworks] =&gt; 0<br />
&nbsp;&nbsp;[allowglobalstick] =&gt; 1<br />
&nbsp;&nbsp;[level] =&gt; 0<br />
&nbsp;&nbsp;[commoncredits] =&gt; 0<br />
&nbsp;&nbsp;[archive] =&gt; 0<br />
&nbsp;&nbsp;[recommend] =&gt; 0<br />
&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;[disablethumb] =&gt; 0<br />
&nbsp;&nbsp;[disablecollect] =&gt; 0<br />
&nbsp;&nbsp;[ismoderator] =&gt; 1<br />
&nbsp;&nbsp;[allowpostattach] =&gt; <br />
)<br />
</li><li><a name="S_thread"></a><br />['thread'] => Array<br />
(<br />
)<br />
</li><li><a name="S_home"></a><br />['home'] => Array<br />
(<br />
)<br />
</li><li><a name="S_space"></a><br />['space'] => Array<br />
(<br />
)<br />
</li><li><a name="S_block"></a><br />['block'] => Array<br />
(<br />
)<br />
</li><li><a name="S_article"></a><br />['article'] => Array<br />
(<br />
)<br />
</li><li><a name="S_action"></a><br />['action'] => Array<br />
(<br />
&nbsp;&nbsp;[action] =&gt; 2<br />
&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;[tid] =&gt; 0<br />
)<br />
</li><li><a name="S_notice_structure"></a><br />['notice_structure'] => Array<br />
(<br />
&nbsp;&nbsp;[mypost] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; post<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; pcomment<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; activity<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; reward<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; goods<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; at<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[interactive] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; poke<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; friend<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; wall<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; comment<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; click<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; sharenotice<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[system] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; system<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; myapp<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; credit<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[3] =&gt; group<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[4] =&gt; verify<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[5] =&gt; magic<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[6] =&gt; task<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[7] =&gt; show<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[8] =&gt; group<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[9] =&gt; pusearticle<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[10] =&gt; mod_member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[11] =&gt; blog<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[12] =&gt; article<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[manage] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[0] =&gt; mod_member<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[1] =&gt; report<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[2] =&gt; pmreport<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[app] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
)<br />
</li><li><a name="S_mobiletpl"></a><br />['mobiletpl'] => Array<br />
(<br />
&nbsp;&nbsp;[1] =&gt; mobile<br />
&nbsp;&nbsp;[2] =&gt; touch<br />
&nbsp;&nbsp;[3] =&gt; wml<br />
&nbsp;&nbsp;[yes] =&gt; mobile<br />
)<br />
</li><li><a name="S_hooklang"></a><br />['hooklang'] => Array<br />
(<br />
&nbsp;&nbsp;[core] =&gt; 1<br />
&nbsp;&nbsp;[template] =&gt; 1<br />
&nbsp;&nbsp;[forum/template] =&gt; 1<br />
)<br />
</li><li><a name="S_forum_threadlist"></a><br />['forum_threadlist'] => Array<br />
(<br />
&nbsp;&nbsp;[0] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 37<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; haierspi<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 3<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月31日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-31<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-31 19:32<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; haierspi<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; haierspi<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 37<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1396265526<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1396265526<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_37<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[1] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 31<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月17日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-17<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-17 10:00<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 31<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1395021624<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1395021624<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_31<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[2] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 27<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月17日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-17<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-17 01:14<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 27<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1394990039<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1394990067<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_27<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[3] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 26<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月17日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-17<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-17 01:07<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 26<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1394989622<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1394989622<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_26<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[4] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 29<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月9日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-9<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-9 01:26<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 29<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1394299592<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1394299592<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_29<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[5] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 28<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月8日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-8<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-8 01:26<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 28<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1394213176<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1394213176<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_28<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[6] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 2014年03月2日签到帖<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-3-2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-3-2 01:27<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 192<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1393694846<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1393694846<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_30<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
&nbsp;&nbsp;[7] =&gt; Array<br />
&nbsp;&nbsp;&nbsp;&nbsp;(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[tid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[posttableid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typeid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sortid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[readperm] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[price] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[author] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[authorid] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[subject] =&gt; 微信淘宝条码扫描体验：扫码如做贼<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dateline] =&gt; 2014-1-23<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastpost] =&gt; 2014-1-23 11:36<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposter] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[views] =&gt; 4<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[displayorder] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[highlight] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[digest] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rate] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[special] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[attachment] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moderated] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[closed] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stickreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommends] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_add] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommend_sub] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heats] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[status] =&gt; 32<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[isgroup] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[favtimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sharetimes] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[stamp] =&gt; -1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icon] =&gt; 20<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[pushedaid] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[cover] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[replycredit] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[relatebytag] =&gt; 1393382427	<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[maxposition] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[bgcolor] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[comments] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[hidden] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[allreplies] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ordertype] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[forumstick] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[related_group] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[lastposterenc] =&gt; admin<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typehtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[typename] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[sorthtml] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[multipage] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[recommendicon] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[new] =&gt; 1<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[heatlevel] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[moved] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[folder] =&gt; new<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[weeknew] =&gt; <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[icontid] =&gt; 2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[istoday] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dbdateline] =&gt; 1390448218<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[dblastpost] =&gt; 1390448218<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[id] =&gt; normalthread_2<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[mobile] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[rushreply] =&gt; 0<br />
&nbsp;&nbsp;&nbsp;&nbsp;)<br />
<br />
)<br />
</li><li><a name="S_forum_colorarray"></a><br />['forum_colorarray'] => Array<br />
(<br />
&nbsp;&nbsp;[0] =&gt; <br />
&nbsp;&nbsp;[1] =&gt; #EE1B2E<br />
&nbsp;&nbsp;[2] =&gt; #EE5023<br />
&nbsp;&nbsp;[3] =&gt; #996600<br />
&nbsp;&nbsp;[4] =&gt; #3C9D40<br />
&nbsp;&nbsp;[5] =&gt; #2897C5<br />
&nbsp;&nbsp;[6] =&gt; #2B65B7<br />
&nbsp;&nbsp;[7] =&gt; #8F2A90<br />
&nbsp;&nbsp;[8] =&gt; #EC1282<br />
)<br />
</li><li><a name="S_debuginfo"></a><br />['debuginfo'] => Array<br />
(<br />
&nbsp;&nbsp;[time] =&gt; 1.399079<br />
&nbsp;&nbsp;[queries] =&gt; 54<br />
&nbsp;&nbsp;[memory] =&gt; <br />
)<br />
</li><li><a name="S_sessoin"></a><br />['sessoin'] => Array<br />
(<br />
&nbsp;&nbsp;[sid] =&gt; mYdDzQ<br />
&nbsp;&nbsp;[ip1] =&gt; 127<br />
&nbsp;&nbsp;[ip2] =&gt; 0<br />
&nbsp;&nbsp;[ip3] =&gt; 0<br />
&nbsp;&nbsp;[ip4] =&gt; 1<br />
&nbsp;&nbsp;[uid] =&gt; 1<br />
&nbsp;&nbsp;[username] =&gt; admin<br />
&nbsp;&nbsp;[groupid] =&gt; 1<br />
&nbsp;&nbsp;[invisible] =&gt; 0<br />
&nbsp;&nbsp;[action] =&gt; 2<br />
&nbsp;&nbsp;[lastactivity] =&gt; 1397199512<br />
&nbsp;&nbsp;[lastolupdate] =&gt; 1397199512<br />
&nbsp;&nbsp;[fid] =&gt; 2<br />
&nbsp;&nbsp;[tid] =&gt; 0<br />
)<br />
</li></ol></div></body></html>