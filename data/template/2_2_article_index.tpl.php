<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('index');?><?php include template('article/header'); ?><div id="main">
<div id="mleft">
<div id="headimg">
<div class="himglist">
<ul><?php $i=0;?><?php if(is_array($topicfocuslist)) foreach($topicfocuslist as $value) { ?><li<?php if($i==0) { ?> class="select"<?php } ?>><a href="<?php echo $value['url'];?>"><img src="<?php echo $value['pic'];?>"></a></li><?php $i++;?><?php } ?>
</ul>
</div>
<div class="listtab">
<ul><?php $i=0;?><?php if(is_array($topicfocuslist)) foreach($topicfocuslist as $value) { ?><li<?php if($i==0) { ?> class="select"<?php } ?>><a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a></li><li class="line"></li><?php $i++;?><?php } ?>
</ul>
</div>
</div>

<div id="box" class="min20"><?php if(is_array($articles)) foreach($articles as $value) { ?><div class="b2con">
<div class="b2img">
<a href="<?php echo $value['url'];?>">
<div class="patxt"><?php if($value['datetag']) { ?><span class="today"><?php echo $value['datetag'];?></span><?php } ?><?php echo $value['title'];?></div>
<div class="pabg"></div>
<img src="<?php echo $value['titlepic'];?>" title="<?php echo $value['title'];?>" alt="<?php echo $value['title'];?>">
</a>
</div>
<div class="boxcontent">
<ul>
<li class="tagbtn"><?php if(is_array($value['tagary'])) foreach($value['tagary'] as $k => $v) { ?><a href="index.php?act=tag&amp;id=<?php echo $k;?>" title="<?php echo $v;?>"><em></em><?php echo $v;?></a>
<?php } ?>
</li>
<li class="boxtxt"><?php echo $value['content'];?></li>
<li class="boxmore">
<span class="right"><a href="<?php echo $value['url'];?>" title="<?php echo $value['title'];?>" class="tlink">阅读全文&raquo;</a></span>
<a href="home.php?mod=space&amp;uid=<?php echo $value['authorid'];?>" target="_blank"><?php echo $value['author'];?></a> <?php echo $value['dateline_f'];?>
</li>
</ul>
</div>
</div>
<?php } ?>
</div>

<div id="pmore">
<a href="javascript:loadcontent()">阅读更多文章...</a>
</div>
</div><?php include template('article/sidebar'); ?></div>


<div id="links">
<div class="linklist">
<span>友情链接：</span><a href="">乐Phone之家</a><a href="">联想智能手机社区</a>
</div>
</div>


<div id="bg"></div><?php include template('article/footer'); ?>