<?php

$_Data['buglist_handling'] = array(
	0=>array('title'=>'新提交',	'text'=>'等待信息专员确认问题',		'color'=>'OrangeRed', 'stylec'=>'new', 'icon'=>'newthead'),
	1=>array('title'=>'待解决',	'text'=>'问题已经提交至工程师，等待解决',	'color'=>'DarkOrange', 'stylec'=>'wait', 'icon'=>'lastthead'),
	2=>array('title'=>'正在解决', 'text'=>'联想工程师知晓并尝试解决问题',	'color'=>'RoyalBlue', 'stylec'=>'resolve', 'icon'=>'hotthead'),
	3=>array('title'=>'已经解决','text'=>'问题已经得到解决',	'color'=>'LimeGreen', 'stylec'=>'resolved', 'icon'=>'verythead'),
	4=>array('title'=>'完结',	'text'=>'问题被关闭',	'color'=>'DarkGray', 'stylec'=>'end'),
);
/*

.tstatus .new{color:OrangeRed}.tstatus .wait{color:DarkOrange}.tstatus .resolve{color:RoyalBlue}.tstatus .resolved{color:LimeGreen}.v
 数字索引第一位数字 用来 归属分类级别
 


*/

?>