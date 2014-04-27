<?php

require_once './source/class/class_core.php';

$cachelist = array();
$discuz = & discuz_core::instance();
$discuz->cachelist = $cachelist;
$discuz->init_cron = false;
$discuz->init_setting = true;
$discuz->init_user = false;
$discuz->init_session = false;
$discuz->init();

if (is_file(DISCUZ_ROOT . './data/discuzx_update_sitekey.lock')) {
	echo "LOCK, please delete file ./data/discuzx_update_sitekey.lock";
	exit;
}

$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
$siteuniqueid = 'DX' . $chars[date('y') % 60] . $chars[date('n')] . $chars[date('j')] . $chars[date('G')] . $chars[date('i')] . $chars[date('s')] . substr(md5($_G['clientip'] . 'root' . TIMESTAMP), 0, 4) . random(4);
$temp = array(
			  'skey' => 'siteuniqueid',
			  'svalue' => $siteuniqueid
			 );
DB::insert('common_setting', $temp, false, true);

require_once libfile('function/cache');
updatecache('setting');

echo 'SiteKey Update Succeed';

$fp = fopen(DISCUZ_ROOT . './data/discuzx_update_sitekey.lock', 'w');
fclose($fp);

?>