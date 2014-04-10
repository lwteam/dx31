<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_G['setting']['bbname'];?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script> -->
<script src="static/js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="static/js/jQuery.main.js" type="text/javascript" type="text/javascript" type="text/javascript"></script>

</head>
<body>


<div id="header">
<div class="top">
<div class="logo"><a href="./"><?php echo $_G['setting']['bbname'];?></a></div>
<div class="nav">
<ul class="clear">
<li <?php if($select == 'index') { ?>class="select"<?php } ?>><a href="./">首页</a></li><li class="line"></li>
<li <?php if($select == 'zixun') { ?>class="select"<?php } ?>><a href="index.php?act=list&amp;key=zixun">资讯</a></li><li class="line"></li>
<li <?php if($select == 'wanfa') { ?>class="select"<?php } ?>><a href="index.php?act=list&amp;key=wanfa">玩法</a></li><li class="line"></li>
<li><a href="forum.php">论坛</a></li><li class="line"></li>
<li>
<div class="tsearch">
<ul>
<form id="scbar_form" method="post" autocomplete="off" action="index.php?act=search" target="_blank">
<li class="seabox"><input type="text" name="srchtxt" id="scbar_txt" value="" autocomplete="off" /></li>
<li class="sbtn"><button type="submit" id="search_submitt" name="searchsubmit" value="true">搜索</button>
</form>
</li>
</ul>
</div>
</li>
</ul>
</div>
<div class="ulogin">

<?php if($_G['uid']) { ?>
<strong><a href="home.php?mod=space&amp;uid=<?php echo $_G['uid'];?>"><?php echo $_G['member']['username'];?></a></strong>
<a href="member.php?mod=logging&amp;action=logout&amp;formhash=<?php echo FORMHASH;?>&amp;referer=index.php">退出</a>
<?php } else { ?>
<a href="member.php?mod=register&amp;referer=index.php" >注册</a>
<a href="member.php?mod=logging&amp;action=login&amp;referer=index.php" >马上登陆</a>
<?php } ?>




</div>
</div>
</div>