<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('forumdisplay');?><?php include template('common/header'); ?><style>
._dis {display:none}
.selected {font-weight:700}
</style>
<!-- 一级分类 -->
<span<?php if(!$classid) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl(false,$handling,$hardware,$version); ?>">全部</a></span> <?php if(is_array($_Data['buglist'])) foreach($_Data['buglist'] as $key => $value) { if(strlen($key) == 1) { ?>
<span class="_topclass <?php if(substr($classid,0,1) == $key) { ?> selected<?php } ?>" cid="<?php echo $key;?>"><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($key,$handling,$hardware,$version); ?>"><?php echo $value;?></a></span>
<?php } } ?>

<!-- 二级分类 --><?php $topid = 0;?><?php if(is_array($_Data['buglist'])) foreach($_Data['buglist'] as $key => $value) { if(strlen($key) == 1) { if($topid != $key) { if($topid >0) { ?></p><?php } ?>
<p class="_subclass _subclass<?php echo $key;?><?php if((!$classid&&$key==1)) { } elseif(($key != substr($classid,0,1))) { ?> _dis<?php } ?>">
<?php } ?>
<span<?php if($classid == $key) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($key,$handling,$hardware,$version); ?>">全部</a></span>
<?php } else { ?>
<span <?php if($classid == $key) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($key,$handling,$hardware,$version); ?>"><?php echo $value;?></a></span>
<?php } $topid = substr($key,0,1);?><?php } ?>
</p>
<!-- 问题状态栏 -->
<p>
<span<?php if(!isset($handling)) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($classid,false,$hardware,$version); ?>">全部</a></span>   <?php if(is_array($_Data['buglist_handling'])) foreach($_Data['buglist_handling'] as $key => $value) { if ($key>3)continue;?><span <?php if(isset($handling) && $handling == $key) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($classid,$key,$hardware,$version); ?>"><?php echo $value['title'];?></a></span>
<?php } ?>

</p>

<!-- 硬件选择 -->
<p>
<span<?php if(!isset($hardware)) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($classid,$handling,false,$version); ?>">全部</a></span>   <?php if(is_array($hardwarelist)) foreach($hardwarelist as $value) { ?><span <?php if($hardware == $value['id']) { ?> class="selected"<?php } ?>>
<a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;classid=<?php echo $value['self']?$classid:substr($classid,0,1); echo $this->GetSelectUrl($classid,$handling,$value['id'],$version); ?>"><?php echo $value['title'];?></a></span>
<?php } ?>
</p>

<!-- 版本选择 -->
<p>
<span<?php if(!isset($version)) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?><?php echo $this->GetSelectUrl($classid,$handling,$hardware,false); ?>">全部</a></span>   <?php if(is_array($versionlist)) foreach($versionlist as $value) { ?><span <?php if($version == $value['id']) { ?> class="selected"<?php } ?>><a href="forum.php?mod=forumdisplay&amp;fid=<?php echo $_G['fid'];?>&amp;classid=<?php echo $value['self']?$classid:substr($classid,0,1); ?>&amp;version=<?php echo $this->GetSelectUrl($classid,$handling,$hardware,$value['id']); ?>"><?php echo $value['title'];?></a></span>
<?php } ?>
</p><?php if(is_array($threadlist)) foreach($threadlist as $thread) { ?><p>
<a href="forum.php?mod=viewthread&amp;fid=<?php echo $thread['fid'];?>&amp;tid=<?php echo $thread['tid'];?>"><?php echo $thread['subject'];?></a>
</p>
<?php } include template('common/footer'); ?>