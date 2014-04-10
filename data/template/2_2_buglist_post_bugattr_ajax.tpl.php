<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<div>

<?php if($hardwarelist) { ?>
<div class="bip">
<p class="bip-t">机型选择 (必填)</p>
<select class="bip-s" size="1" id="hardware" name="hardware"><?php if(is_array($hardwarelist)) foreach($hardwarelist as $value) { ?><option value="<?php echo $value['id'];?>" <?php if($value['selected']) { ?> selected<?php } ?>><?php echo $value['title'];?></option>
<?php } ?>
</select>
</div>
<?php } if($versionlist) { ?>
<div class="bip">
<p class="bip-t">版本选择 (必填)</p>
<select class="bip-s" id="version" size="1" name="version"><?php if(is_array($versionlist)) foreach($versionlist as $value) { ?><option value="<?php echo $value['id'];?>" <?php if($value['selected']) { ?> selected<?php } ?>><?php echo $value['title'];?></option>
<?php } ?>
</select>
</div>
<?php } if(is_array($bugattrlist)) foreach($bugattrlist as $i => $value) { ?><div class="bip">
<p class="bip-t"><?php echo $value['title'];?> (<?php if($value['must']) { ?>必填<?php } ?>)</p>
<?php if($value['inputtype']) { ?>
<select class="bip-s" id="<?php echo $value['elementid'];?>" size="1" name="bugattr[<?php echo $value['id'];?>]"><?php if(is_array($value['selectlist'])) foreach($value['selectlist'] as $opkey => $opval) { ?><option value="<?php echo $opkey;?>" <?php if($value['key'] == $opkey) { ?> selected<?php } ?>><?php echo $opval;?></option>
<?php } ?>
</select>
<?php } else { ?>
<input type="text" id="<?php echo $value['elementid'];?>" name="bugattr[<?php echo $value['id'];?>]" value="<?php echo $value['value'];?>" class="bip-i" autocomplete="off">
<?php } ?>

</div>
<?php } ?>
</div>
<style>
.bip{}
.bip .bip-t{}
.bip .bip-s {width:200px;}
.bip .bip-i{ 
width:290px;
padding: 2px 4px;
line-height: 17px;
border: 1px solid;
border-color: #848484 #E0E0E0 #E0E0E0 #848484;
background: #FFF url(../../static/image/common/px.png) repeat-x 0 0;
}
</style>