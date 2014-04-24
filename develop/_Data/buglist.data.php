<?php

$_Data['buglist'] = array(
	1=>'乐家族产品',
	10=>'乐云记事',
	11=>'茄子快传',
	12=>'乐商店',
	13=>'乐安全',
	14=>'乐桌面',
	15=>'超级相机',
	16=>'乐省电',
	17=>'乐语音',
	18=>'乐同步',
	19=>'乐助手',
	110=>'联想天气',
	111=>'游戏世界',
	112=>'友约',

	2=>'VIBE UI',
	20=>'公告',
	21=>'通话',
	22=>'通讯录',
	23=>'音乐',
	24=>'视频',
	25=>'日历',
	26=>'时钟',
	27=>'蓝牙•无线',
	28=>'常用工具',
	29=>'功耗',
	210=>'性能',
	211=>'系统问题',
	212=>'系统升级',
	213=>'文件管家',
	214=>'主题中心',
	215=>'通知中心',
	216=>'其他',
);
/*
1=>'乐产品',
10=>'乐云记事',
11=>'茄子快传',
12=>'乐商店',
13=>'乐安全',
14=>'乐桌面',
15=>'超级相机',
16=>'乐省电',
17=>'乐语音',
18=>'乐同步',
19=>'乐助手',
110=>'联想天气',
111=>'游戏世界',
112=>'友约',

2=>'VibeUi',
20=>'公告',
21=>'通话',
22=>'通讯录',
23=>'音乐',
24=>'视频',
25=>'日历',
26=>'时钟',
27=>'蓝牙•无线',
28=>'常用工具',
29=>'功耗',
210=>'性能',
211=>'系统问题',
212=>'系统升级',
213=>'文件管家',
214=>'主题中心',
215=>'通知中心',
216=>'其他',




*/
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