<?php


define('CURSCRIPT', 'lenovo');
require './source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz = C::app();
$discuz->init();

require "data/cache/cache_forums_rewrite.php";

loadcache('staticlink');
$staticlink = & $_G['cache']['staticlink'];

echo'<pre>';
print_r( $staticlink );
echo'</pre>';

echo'<pre>';
print_r( $rewritearray );
echo'</pre>';

echo'<pre>';
print_r( $forumsnarray );
echo'</pre>';exit;



?>