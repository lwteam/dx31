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
echo'</pre>';

function dieDebug($sError)
 {
     echo "<hr /><div>".$sError."<br /><table border='1'>";
     $sOut=""; $aCallstack=debug_backtrace();
     
     echo "<thead><tr><th>file</th><th>line</th><th>function</th>".
         "</tr></thead>";
     foreach($aCallstack as $aCall)
     {
         if (!isset($aCall['file'])) $aCall['file'] = '[PHP Kernel]';
         if (!isset($aCall['line'])) $aCall['line'] = '';

         echo "<tr><td>{$aCall["file"]}</td><td>{$aCall["line"]}</td>".
             "<td>{$aCall["function"]}</td></tr>";
     }
     echo "</table></div><hr /></p>";
     die();
 }
dieDebug('22');
?>