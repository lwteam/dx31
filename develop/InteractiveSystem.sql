
-- 博客文章

DROP TABLE IF EXISTS `pre_article`;
CREATE TABLE `pre_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL DEFAULT '',
  `titleurl` char(255) NOT NULL DEFAULT '',
  `titlepic` char(255) NOT NULL DEFAULT '',
  `category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `index` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `tags` char(255) NOT NULL DEFAULT '',
  `tagtxts` char(255) NOT NULL DEFAULT '',
  `adateline` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `tags` (`tags`),
  KEY `index` (`index`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- TAG列表
DROP TABLE IF EXISTS `pre_article_tag`;
CREATE TABLE `pre_article_tag` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL DEFAULT '', -- 标签标题
  `namedesc` char(255) NOT NULL DEFAULT '', -- 标签描述
  `relatenum` int(10) unsigned NOT NULL DEFAULT '0', -- 关联数量
  `typeid` mediumint(8) unsigned NOT NULL DEFAULT '0', --  类型 {0 普通,1 产品,2 公司,3人物}
  `index` tinyint(1) NOT NULL DEFAULT '0',
  `relatename` char(255) NOT NULL DEFAULT '', -- 关联关键字 用于搜索
  `relateid` char(255) NOT NULL DEFAULT '', -- 关联TAGid 用于搜索
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_article_search_hothistory`;
CREATE TABLE `pre_article_search_hothistory` (
  `title` char(255) NOT NULL DEFAULT '', -- 标签标题
  `num` int(10) unsigned NOT NULL DEFAULT '0', -- 关联数量
  UNIQUE KEY `title` (`title`),
  Key `num` (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for pre_checkin
-- ----------------------------
DROP TABLE IF EXISTS `pre_checkin`;
CREATE TABLE `pre_checkin` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_checkin_day
-- ----------------------------

CREATE TABLE `pre_checkin_dayall` (
  `day` int(5) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `day` (`day`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for pre_checkin_month
-- ----------------------------
-- 数字判断是否签到 m2 为表情id
DROP TABLE IF EXISTS `pre_checkin_month`;
CREATE TABLE `pre_checkin_month` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '',
  `month` int(5) unsigned NOT NULL DEFAULT '0',
  `1` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `10` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `11` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `12` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `13` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `14` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `15` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `16` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `17` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `18` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `19` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `20` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `21` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `22` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `23` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `24` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `25` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `26` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `27` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `28` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `29` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `30` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `31` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m1` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m10` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m11` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m12` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m13` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m14` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m15` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m16` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m17` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m18` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m19` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m20` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m21` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m22` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m23` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m24` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m25` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m26` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m27` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m28` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m29` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m30` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `m31` tinyint(1) unsigned NOT NULL DEFAULT '0',

  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`,`month`) USING BTREE,
  KEY `num` (`num`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_checkin_month
-- ----------------------------
INSERT INTO `pre_checkin_month` (`uid`, `username`, `month`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `21`, `22`, `23`, `24`, `25`, `26`, `27`, `28`, `29`, `30`, `31`, `dateline`, `num`) VALUES (3, 'haierspi', 201403, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1394975159, 7);


-- ----------------------------
-- Table structure for pre_checkin_week
-- ----------------------------
DROP TABLE IF EXISTS `pre_checkin_week`;
CREATE TABLE `pre_checkin_week` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '',
  `week` int(5) unsigned NOT NULL DEFAULT '0',
  `1` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`,`week`) USING BTREE,
  KEY `num` (`num`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `pre_manage_log`;
CREATE TABLE `pre_manage_log` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(24) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `action` char(15) NOT NULL DEFAULT '', -- 姓名
  `url` text NOT NULL,
  `method`  char(15) NOT NULL DEFAULT '',
  `request` text NOT NULL,
  KEY (`uid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_manage_user`;
CREATE TABLE `pre_manage_user` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(24) NOT NULL DEFAULT '',
  `name` char(24) NOT NULL DEFAULT '', -- 姓名
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `permission` text NOT NULL,
  `dist` tinyint(1)  NOT NULL DEFAULT '0', -- 用户级别 -1 超级管理员 0 非管理员 1 产品经理 2产品工程师 3 信息员
  `distuid`  char(255) NOT NULL DEFAULT '', -- 权限分配线
  `distusername` char(255) NOT NULL DEFAULT '',
  `buglist` int(8) unsigned NOT NULL DEFAULT '0', -- 归属分类
  `forum` int(8) unsigned NOT NULL DEFAULT '0',-- 归属分类
  `hardware`  text NOT NULL DEFAULT '',-- 归属分类
  `version`  int(8) unsigned NOT NULL DEFAULT '0',-- 归属分类
  `bugattr`  int(8) unsigned NOT NULL DEFAULT '0',-- 归属分类
  `relations`  int(8) unsigned NOT NULL DEFAULT '0',-- 是否建立分类联系表
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `pre_manage_user` (`uid`, `username`, `dateline`, `permission`, `dist`, `distuid`, `distusername`) VALUES (1, 'admin', 0, '', -1, 0, '');
INSERT INTO `pre_manage_user` (`uid`, `username`, `name`, `dateline`, `permission`, `dist`, `distuid`, `distusername`, `buglist`, `forum`, `hardware`) VALUES (3, 'haierspi', '曹广来', 1396257637, 'a:8:{i:0;s:8:\"userinfo\";i:1;s:7:\"buglist\";i:2;s:7:\"bugattr\";i:3;s:8:\"diyforum\";i:4;s:7:\"product\";i:5;s:8:\"hardware\";i:6;s:4:\"team\";i:7;s:4:\"data\";}', 1, ',1,', ',admin,', 2, 2, 'a:3:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";}');
INSERT INTO `pre_manage_user` (`uid`, `username`, `name`, `dateline`, `permission`, `dist`, `distuid`, `distusername`, `buglist`, `forum`, `hardware`) VALUES (2, 'test', '陈福光', 1396080413, 'a:5:{i:0;s:8:\"userinfo\";i:1;s:7:\"buglist\";i:2;s:7:\"bugattr\";i:3;s:8:\"diyforum\";i:4;s:7:\"product\";}', 2, ',1,3,', ',admin,haierspi,', 20, 2, 'N;');





DROP TABLE IF EXISTS `pre_buglist`;
CREATE TABLE `pre_buglist` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(24) NOT NULL DEFAULT '',
  `classid` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `handling` smallint(6) unsigned NOT NULL DEFAULT '0', -- 处理状态情况 0 新提交 1 待解决 2 正在解决 3 已经解决 4 确认解决(完结)
  `hardware` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `version` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `handlings` text NOT NULL, -- 状态流程  array{0=>{handling:状态,dateline:状态时间,uid:操作人UID,username:操作人用户名,itcode:操作人itcode,name:操作人姓名}}
  `handlinglogid` mediumint(8) unsigned NOT NULL DEFAULT '0', -- 最新处理状态对应的日志id
  `dateline` int(10) unsigned NOT NULL DEFAULT '0', -- 最后状态时间
  `handtime` int(10) unsigned NOT NULL DEFAULT '0', -- 最后状态时间
  `lasttime` int(10) unsigned NOT NULL DEFAULT '0', -- 最后操作时间
  `supply` tinyint(1) unsigned NOT NULL DEFAULT '0', -- 补充
  `supplytime` int(10) unsigned NOT NULL DEFAULT '0', -- 补充时间
  `note` text NOT NULL, -- 备注 {dateline:状态时间,uid:操作人UID,username:操作人用户名,note:备注}
  `samenum` int(10) unsigned NOT NULL DEFAULT '0', -- 也遇到人数
  `property` mediumtext NOT NULL, -- 分类属性 的值 比如   {id=>array(key,title,value) //选择,id=>array(title,value)//输入}
  `touid` mediumint(8) unsigned NOT NULL, -- 反馈状态指派用户ID
  `tousername` char(24) NOT NULL DEFAULT '', -- 反馈状态指派用户名
  `douid` mediumint(8) unsigned NOT NULL, -- 解决状态指派用户ID
  `dousername` char(24) NOT NULL DEFAULT '', -- 解决状态指派用户名
  `bstatus` smallint(6) unsigned NOT NULL DEFAULT '0',-- 二进制状态信息 二进制位 可以存储32个操作状态
  PRIMARY KEY (`tid`),
  KEY `classhandling` (`classid`,`handling`),
  KEY `hardware` (`hardware`),
  KEY `version` (`version`),
  KEY `dateline` (`dateline`),
  KEY `lasttime` (`lasttime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- 第一个是 用户新提交 需要反馈工程师确认BUG
-- 第二个是 反馈工程师确认BUG 提交给 产品工程师
-- 第三个是 产品工程师处理问题
-- 第四个是 信息专员结束问题


DROP TABLE IF EXISTS `pre_buglist_log`;
CREATE TABLE `pre_buglist_log` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(24) NOT NULL DEFAULT '',
  `name` char(24) NOT NULL DEFAULT '', -- 姓名
  `itcode` char(255) NOT NULL DEFAULT '', -- 
  `dateline` int(10) unsigned NOT NULL DEFAULT '0', -- 提交时间
  `handling` smallint(6) unsigned NOT NULL DEFAULT '0', -- 操作处理后状态情况
  `status` smallint(6) unsigned NOT NULL DEFAULT '0',-- 二进制状态信息  1位:ture:修改状态了 false:补充 2:用户已经补充
  `message` char(255) NOT NULL DEFAULT '', -- 处理信息
  `note` char(255) NOT NULL DEFAULT '', -- 后台备注
  KEY (`tid`,`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 


-- 负责处理的用户列表
DROP TABLE IF EXISTS `pre_buglist_user`;
CREATE TABLE `pre_buglist_user` (
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(24) NOT NULL DEFAULT '', -- another
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `another` char(24) NOT NULL DEFAULT '', -- 马甲
  `avatar` char(255) NOT NULL DEFAULT '', -- 头像
  `name` char(24) NOT NULL DEFAULT '', -- 姓名
  `itcode` char(255) NOT NULL DEFAULT '', -- 
  `email` char(255) NOT NULL DEFAULT '', -- 
  `phone` char(255) NOT NULL DEFAULT '', -- 电话
  `title` char(255) NOT NULL DEFAULT '', -- 工作头衔
  `team` char(255) NOT NULL DEFAULT '', -- team名称
  `dist` smallint(6) unsigned NOT NULL DEFAULT '0', -- 级别  1. 产品经理 2 产品工程师 3.反馈专员  4. 信息专员
  `distuid` mediumint(8) unsigned NOT NULL DEFAULT '0', -- 指派UID 归属TEAM
  `hide` tinyint(1)  NOT NULL DEFAULT '0', -- 是否隐藏个人信息
  PRIMARY KEY (`uid`),
  KEY `distuid` (`distuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 

-- 分类硬件关联表
DROP TABLE IF EXISTS `pre_buglist_hardware`;
CREATE TABLE `pre_buglist_hardware` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `title` char(255) NOT NULL DEFAULT '', -- 名称
  `dateline` int(10) unsigned NOT NULL DEFAULT '0', -- 提交时间
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 

-- 分类版本关联表
DROP TABLE IF EXISTS `pre_buglist_version`;
CREATE TABLE `pre_buglist_version` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `title` char(255) NOT NULL DEFAULT '', -- 名称
  `dateline` int(10) unsigned NOT NULL DEFAULT '0', -- 提交时间
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 


-- 自定义属性
DROP TABLE IF EXISTS `pre_buglist_bugattr`;
CREATE TABLE `pre_buglist_bugattr` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) unsigned NOT NULL DEFAULT '0', -- 分类
  `title` char(255) NOT NULL DEFAULT '', -- 名称
  `dateline` int(10) unsigned NOT NULL DEFAULT '0', -- 提交时间
  `inputtype` smallint(6) unsigned NOT NULL DEFAULT '0', -- 输入框类型  {0 输入框 1. 选择框}
  `text` char(255) NOT NULL DEFAULT '', -- 属性内容
  `must` tinyint(1)  NOT NULL DEFAULT '0', -- 是否必填选项
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; 



-- 处理问题记录


DROP TABLE IF EXISTS `pre_buglist_mstatus`;
CREATE TABLE `pre_buglist_mstatus` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '',
  `month` int(5) unsigned NOT NULL DEFAULT '0',
  `type` smallint(6) unsigned NOT NULL DEFAULT '0', -- 0 工程师 1 产品经理
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0', -- 所有问题数量
  `hnum` int(10) unsigned NOT NULL DEFAULT '0', -- 处理问题数量
  UNIQUE KEY `uid` (`uid`,`month`) USING BTREE,
  KEY `num` (`num`),
  KEY `hnum` (`hnum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_checkin_week
-- ----------------------------
DROP TABLE IF EXISTS `pre_buglist_wstatus`;
CREATE TABLE `pre_buglist_wstatus` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL DEFAULT '',
  `week` int(5) unsigned NOT NULL DEFAULT '0',
   `type` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0', -- 所有问题数量
  `hnum` int(10) unsigned NOT NULL DEFAULT '0', -- 处理问题数量
  UNIQUE KEY `uid` (`uid`,`week`) USING BTREE,
  KEY `num` (`num`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- BUGLIST 分类问题数量统计
DROP TABLE IF EXISTS `pre_buglist_cstatus`;
CREATE TABLE `pre_buglist_cstatus` (
  `classid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num` int(10) unsigned NOT NULL DEFAULT '0', -- 所有问题数量
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 用于去除重复提交  比如投票
DROP TABLE IF EXISTS `pre_buglist_urecords`;
CREATE TABLE `pre_buglist_urecords` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keytype` char(50) NOT NULL DEFAULT '', #凭证ID
  `keyid` mediumint(8) unsigned NOT NULL DEFAULT '0', #凭证ID
  `num` int(10) unsigned NOT NULL DEFAULT '0', -- 所有问题数量
  UNIQUE KEY `uid` (`keytype`,`keyid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `pre_common_member_lenovoid`;
CREATE TABLE `pre_common_member_lenovoid` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lenovoid` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `lenovoid` (`lenovoid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `pre_common_member_lephoneuid`;
CREATE TABLE `pre_common_member_lephoneuid` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lephoneuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lephoneusername` char(15) NOT NULL DEFAULT '',
  `lephoneemail` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `lephoneuid` (`lephoneuid`),
  UNIQUE KEY `lephoneusername` (`lephoneusername`),
  KEY `lephoneemail` (`lephoneemail`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_common_member_accountchange`;
CREATE TABLE `pre_common_member_accountchange` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username`  char(24) NOT NULL DEFAULT '',
  `email`  char(255) NOT NULL DEFAULT '',
  `rename` tinyint(1) unsigned NOT NULL DEFAULT '0', -- 是否更改用户名
  `renamed` tinyint(1) unsigned NOT NULL DEFAULT '0', -- 是否成功更改
  PRIMARY KEY (`uid`),
  UNIQUE KEY `renamed` (`rename`,`renamed`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pre_forum_forum_lephonefid`;
CREATE TABLE `pre_forum_forum_lephonefid` (
  `fid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lephonefid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`),
  UNIQUE KEY `lephonefid` (`lephonefid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pre_forum_thread_lephonetid`;
CREATE TABLE `pre_forum_thread_lephonetid` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lephonetid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  UNIQUE KEY `lephonetid` (`lephonetid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pre_forum_thread_lephonepid`;
CREATE TABLE `pre_forum_thread_lephonepid` (
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lephonepid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  UNIQUE KEY `lephonepid` (`lephonepid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


