<?php

$gofids = '665,255,649,678,714,690,734,689,706,705,692,686,683,699,691,724,713,711,733,737,668,688,679,676,672,671,329,269,335,648,383,669,728,715,730,264,729,701,735,736,639,385,670,400,660,674,362,293,386,662,675,687,677';

if (in_array(CURMODULE, array('forumdisplay','viewthread')) && in_array($_G['fid'], explode(',', $gofids)) ) {
	if ($_GET['tid']) {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: http://www.diybeta.com/forum.php?mod=viewthread&tid='.$_G['tid']);
	}else{
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: http://www.diybeta.com/forum.php?mod=forumdisplay&fid='.$_G['fid']);
	}
}


?>