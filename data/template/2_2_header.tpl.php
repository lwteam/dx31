<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.managetable{width: 100%;margin:5px 0px; border:1px solid #2B4767;font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;font-size:13px;margin:none;padding:none}
.managetable tr.tit {color:#fff;background:#375B84;font-size:14px;font-weight:700;}
.managetable tr.diff {background:#C5D4E6;}
.managetable tr:not(.tit):hover {background:#E3FFC8;}
.managetable td {text-align: left;height:35px}
.managetable td.left{text-align: left;padding-left:20px}
.managetable tr.displayshow{ background:#eee;}
.managetable tr.displayshow:hover {background:#D6CEF9;}


.buglisttable{width: 100%;margin:5px 0px; border:1px solid #2B4767;font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;font-size:13px;margin:none;padding:none}

.buglisttable .buglist_note{color:#999;font-style:italic;font-style:oblique;}
.buglisttable tr.tit {color:#fff;background:#375B84;font-size:14px;font-weight:700;}
.buglisttable tr.diff {background:#C5D4E6;}
.buglisttable tr:not(.tit):hover {background:#E3FFC8;}
.buglisttable td {text-align: center;height:35px}
.buglisttable td.left{text-align: left;}
.buglisttable tr.displayshow{ background:#eee;}
.buglisttable tr.displayshow:hover {background:#D6CEF9;}

.distpermission {width: 100%;margin:5px 0px; border:1px solid #A797F2;font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;font-size:13px;}
.distpermission td {text-align: left;height:35px}
.distpermission td.left{text-align: left;padding-left:20px}
.distpermission td.tit {text-align: right;}
.distpermission tr.tit {color:#6649EB;background:#DAD3FA;font-size:14px;font-weight:700;}

.bughwvertable{clear:both;width: 49%;margin:5px 0px; border:1px solid #2B4767;font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;font-size:13px;margin:none;padding:none}

.bughwvertable tr.bann {color:#fff;background:#5585B9;font-size:16px;font-weight:700;}
.bughwvertable tr.tit {color:#fff;background:#375B84;font-size:14px;font-weight:700;}
.bughwvertable tr.diff {background:#C5D4E6;}
.bughwvertable tr:not(.tit):not(.bann):hover {background:#E3FFC8;}
.bughwvertable td {text-align: center;height:35px}
.bughwvertable td.left{text-align: left;padding-left:20px}
.bughwvertable tr.displayshow{ background:#eee;}
.bughwvertable tr.displayshow:hover {background:#D6CEF9;}

.manage {float: left;width: 100%;clear: both;}
.mgmenu {float: left; width: 100%;}
.mgmenu ul { border:1px solid #d4dde5; border-top:0; background:#eaeff2;}
.mgmenu li { width:148px; height:34px; float:left; font-size:14px; line-height:34px; border-bottom:1px solid #d4dde5;}
.mgmenu li.select { background:#DBE5EF;}
.mgmenu li span { font-family: Georgia, Sans-Serif;width:20px;overflow:hidden;float:left; padding:0px 0px 0px 9px }


.mgcont {float: left;width: 100%;margin-top:20px;}
.mgmenu h3 {
height: 32px;
border-bottom: 3px solid #416E98;
font-size: 22px;
font-weight: 100;
line-height: 25px;
_line-height:28px; 
color: black;
margin-bottom:1px;
font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;
}

.mgtit {border-bottom: 3px solid #416E98;font-size:20px;font-family: "Microsoft YaHei",verdana,arial,helvetica,sans-serif;}

.mgtit p{float:right;font-size:16px;}
.mgtit p a{padding:0px 20px;height:30px;line-height:30px;background:#DBE5EF;}
.mgtit p a.select{background:#608CBD;color:#fff}

.wd27em {  width: 27em  }
.wd20em {  margin:0px;width: 18em  }

.buglist_loading {
background: #fff;
color: #000000;
border: 1px solid #0B198C;
}

.buglist_inbox {
background: #fff;

color: #000000;
border: 1px solid #0B198C;
}

.handling {font-weight:700;display:inline;}
.handling_radio{{background:blue;}

</style>

<link type="text/css" rel="stylesheet" href="static/qtip/jquery.qtip.css" />
<script src="static/qtip/jquery.qtip.min.js" type="text/javascript"></script>
<script src="static/qtip/imagesloaded.pkg.min.js" type="text/javascript"></script>
<div class="manage">
<div class="mgmenu">
<ul><?php $i=0;?><?php if(is_array($manageitem_array)) foreach($manageitem_array as $key => $value) { if(in_array($key,$myaccessmenu)) { $i++;?><li <?php if($action==$key) { ?>class="select"><span><?php echo $i;?>.</span><?php echo $value;?><?php } else { ?>><span><?php echo $i;?>.</span><a href="manage.php?action=<?php echo $key;?>"><?php echo $value;?></a><?php } ?></li>
<?php } } ?>
</ul>
</div><!-- mgmenu -->




