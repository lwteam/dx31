<?php

$_Data['buglist'] = array(
	1=>'乐产品',
	10=>'乐商店',
	11=>'乐安全',
	12=>'茄子快传',
	13=>'绿茶浏览器',
	13=>'乐笔记',

	2=>'VibeUi',
	20=>'通话',
	21=>'设置',
	22=>'浏览器',
	23=>'视频浏览',
	23=>'短信',
	29=>'短信',
);

//对应表

$_Data['buglistrelation'] = array(
	1=> array(),		// FALSE,		//'乐产品',
	10=> array('hardware'=>array(2,3,4,5),'version'=>2,'bugattr'=>2,'self'=>1),		//'乐商店',
	11=> array('hardware'=>array(2,3,4,5),'version'=>3,'bugattr'=>3,'self'=>1),		//'乐安全',
	12=> array('hardware'=>array(2,3,4,5),'version'=>4,'bugattr'=>4,'self'=>1),		//'茄子快传',
	13=> array('hardware'=>array(2,3,4,5),'version'=>5,'bugattr'=>5,'self'=>1),		//'绿茶浏览器',
	13=> array('hardware'=>array(2,3,4,5),'version'=>6,'bugattr'=>6,'self'=>1),		//'乐笔记',

	2=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>1),		//'VibeUi',
	20=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),		//'通话',
	21=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),		//'设置',
	22=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),		//'浏览器',
	23=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),		//'视频浏览',
	23=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//'短信',
	29=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//'短信',
);

/*
'hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>0
bug分类 对应的 硬件分类 版本分类  属性分类  是否为产品经理分类(是否检索自身)
 数字索引第一位数字 用来 归属分类级别
 


*/

?>