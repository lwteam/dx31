<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<div id="sidebar">
<?php if($act == 'index') { ?>
<div id="hotproduct" class="sbox">
<div class="stitle"><h3 class="ht">热点产品</h3></div>
<div class="wbox">
<ul><?php if(is_array($Products)) foreach($Products as $v) { ?><li class="wli"><a href="index.php?act=tag&amp;id=<?php echo $v['id'];?>" title="<?php echo $v['name'];?>"><i></i><?php echo $v['name'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } if($act == 'search') { ?>
<div id="searchhome">
<ul>
<form id="scbar_form" method="post" autocomplete="off" action="index.php?act=search" target="_blank">
<li class="smallbox"><input type="text" name="srchtxt" id="scbar_txt" value="" autocomplete="off" /></li>
<li class="smallbtn"><button type="submit" id="search_submitt" name="searchsubmit" value="true">搜索</button></li>
</form>
</ul>
</div>

<div class="sbox">
<div class="stitle"><h3 class="ht">热门搜索</h3></div>
<div class="wbox">
<ul><?php if(is_array($HotSearchs)) foreach($HotSearchs as $value) { ?><li class="wli"><a href="index.php?act=search&amp;srchtxt=<?php echo urlencode($value['title']);; ?>"><i></i><?php echo $value['title'];?></a></li>
<?php } ?>
</ul>
</div>
</div>
<?php } else { ?>
<div id="hotlist" class="sbox">
<div class="stitle"><h3 class="ht">热门</h3></div>
<div class="wbox">
<ul><?php if(is_array($hotarticles)) foreach($hotarticles as $value) { ?><li class="wli"><a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a><small><?php echo $value['datetag'];?></small></li>
<?php } ?>
</ul>
</div>
</div>

<div id="hottag" class="sbox">
<div class="stitle"><span class="more"><a href="index.php?act=tags">更多</a></span><h3 class="ht">热门标签</h3></div>
<div class="htl tagbtn"><?php if(is_array($HotTags)) foreach($HotTags as $v) { ?><a href="index.php?act=tag&amp;id=<?php echo $v['id'];?>"  title="<?php echo $v['name'];?>"><em></em><?php echo $v['name'];?></a>
<?php } ?>
</div>
</div>
<?php } ?>


</div>