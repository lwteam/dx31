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
	113=>'绿茶浏览器',
	114=>'联想通讯录',
	115=>'联想日历',


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

//对应表

$_Data['buglistrelation'] = array(
	1=> array(),		// FALSE,		//'乐产品',
	10=> array('hardware'=>array(2,3,4,5),'version'=>10,'bugattr'=>10,'self'=>1),  //乐云记事
	11=> array('hardware'=>array(2,3,4,5),'version'=>11,'bugattr'=>11,'self'=>1),  //茄子快传
	12=> array('hardware'=>array(2,3,4,5),'version'=>12,'bugattr'=>12,'self'=>1),  //乐商店
	13=> array('hardware'=>array(2,3,4,5),'version'=>13,'bugattr'=>13,'self'=>1),  //乐安全
	14=> array('hardware'=>array(2,3,4,5),'version'=>14,'bugattr'=>14,'self'=>1),  //乐桌面
	15=> array('hardware'=>array(2,3,4,5),'version'=>15,'bugattr'=>15,'self'=>1),  //超级相机
	16=> array('hardware'=>array(2,3,4,5),'version'=>16,'bugattr'=>16,'self'=>1),  //乐省电
	17=> array('hardware'=>array(2,3,4,5),'version'=>17,'bugattr'=>17,'self'=>1),  //乐语音
	18=> array('hardware'=>array(2,3,4,5),'version'=>18,'bugattr'=>18,'self'=>1),  //乐同步
	19=> array('hardware'=>array(2,3,4,5),'version'=>19,'bugattr'=>19,'self'=>1),  //乐助手
	110=> array('hardware'=>array(2,3,4,5),'version'=>110,'bugattr'=>110,'self'=>1),  //联想天气
	111=> array('hardware'=>array(2,3,4,5),'version'=>111,'bugattr'=>111,'self'=>1),  //游戏世界
	112=> array('hardware'=>array(2,3,4,5),'version'=>112,'bugattr'=>112,'self'=>1),  //友约
	113=> array('hardware'=>array(2,3,4,5),'version'=>113,'bugattr'=>113,'self'=>1),  //绿茶浏览器
	114=> array('hardware'=>array(2,3,4,5),'version'=>114,'bugattr'=>114,'self'=>1),  //联想通讯录
	115=> array('hardware'=>array(2,3,4,5),'version'=>115,'bugattr'=>115,'self'=>1),  //联想日历


	2=> array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>1),		//'VibeUi',
	20=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//公告
	21=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//通话
	22=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//通讯录
	23=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//音乐
	24=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//视频
	25=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//日历
	26=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//时钟
	27=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//蓝牙•无线
	28=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//常用工具
	29=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//功耗
	210=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//性能
	211=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//系统问题
	212=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//系统升级
	213=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//文件管家
	214=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//主题中心
	215=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//通知中心
	216=>array('hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>2),	//其他


);

/*
'hardware'=>1,'version'=>1,'bugattr'=>1,'self'=>0
bug分类 对应的 硬件分类 版本分类  属性分类  是否为产品经理分类(是否检索自身)
 数字索引第一位数字 用来 归属分类级别
 


*/

?>