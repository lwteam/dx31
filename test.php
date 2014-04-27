<?php


define('CURSCRIPT', 'lenovo');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz = C::app();
$discuz->init();

loadcache('staticlink');
$staticlink = & $_G['cache']['staticlink'];

echo'<pre>';
var_dump( $staticlink );
echo'</pre>';exit;


?>