<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>

<div class="checkin">
<div class="loading"><img src="static/image/common/checkin_loading.gif" /></div>
<div class="checkin_ajax<?php if($checkin['visted']) { ?> visted<?php } ?>">
<div class="font"><?php if($checkin['visted']) { ?>已<?php } ?>签到</div>
<div class="continuous">连续 <span class="num"><?php echo (int)$checkin['num']; ?></span> 天</div>
<div class="credit">+<?php echo $credit['day'];?></div>

</div>
<div class="checkin_body">

</div>
</div>
<script>

jQuery(function($) {

$(".checkin_ajax").click( function () {
checkin_loadinng();
$.getJSON('home.php?mod=checkin', function(data){
if (data.scode == '1') {
checkin_loadinng(true);
$('.checkin_body').html(data.content);
}
});
});
});

function checkin_loadinng(end){
if(end){
jQuery(".checkin .loading").height(0);
jQuery(".checkin .loading img").offset({ top: 0, left: 70 });
jQuery(".checkin .loading").hide();

}else{
if(jQuery(".checkin .loading").css("display") == 'none'){
jQuery(".checkin .loading").show();
jQuery(".checkin .loading").height(jQuery(".checkin").height());

var position = jQuery(".checkin").position();
jQuery(".checkin .loading img").offset({ top: ((jQuery(".checkin").height()-30)/2+position.top), left:70 });
}
}

}


function checkin_input(){
jQuery(".checkin_click .text a").hide();
jQuery(".checkin_click .text input").show();
}
function checkin_btn(){
var getdata = '&checkinmood='+encodeURIComponent(jQuery("#checkinmood").val())
if(jQuery("#checkintext").val()){
getdata += '&'+'checkintext='+encodeURIComponent(jQuery("#checkintext").val());
}

jQuery.getJSON('home.php?mod=checkin&inajax=1'+getdata, function(data){
checkin_loadinng();
if (data.scode == '1') {

jQuery(".checkin_ajax .num").text(data.num);
jQuery(".checkin_ajax").addClass('visted');
jQuery(".checkin_ajax").click();
}
});
}


</script>



<style>
.ccdar{}
.ccdar td {background-color: #FFDFBF;width:30px;height: 30px;text-align: center;}
.ccdar_tit{}
.ccdar_last{color:#999}
.ccdar_today{font-weight:700}
td.ccdar_visted{background-color: #A2FFD0;}
td.ccdar_visted img{width: 40px;}

.checkin {
  
}
.checkin .loading {
z-index:999;
 position: absolute;
    background-color: #ff6f3d;
width: 260px;

display:none;
filter:alpha(opacity=50);  /*支持 IE 浏览器*/
-moz-opacity:0.50; /*支持 FireFox 浏览器*/
opacity:0.50;  /*支持 Chrome, Opera, Safari 等浏览器*/

}
.checkin .loading img{
position: absolute;
    top: 15px;
    left: 65px;

}
.checkin_body {
}
.checkin_click{

}
.checkin_click .mood{
border : 1px solid #C2D5E3;
width: 100px;
display: inline-block;
}
.checkin_click .mood img{
width: 50px;
}
.checkin_click .text{
line-height: 20px;
font-size: 14px;

width: 200px; color: #333;
background: #fff;
border: 1px solid #e8e8e8;
display: inline-block; 

}

.checkin_click .text a{
line-height: 40px;
height:40px;
background: none;

}

.checkin_click .text input{
padding:0px;margin:0px;
font-size: 14px;
width: 100%;
border: 0px;
padding: 0px;
line-height: 40px;
padding-left:20px;
background: none;
display:none
}

.checkin_click .click{
border: 1px solid #4899d7;
border-radius: 2px;
text-align: center;
width: 100px;
background: #60b0ee;
color: #fff;
display: inline-block;
padding: 2px 2px;
}

.checkin_click  .click .btn{
width: 100px;
display: inline-block;
font-size: 12px;
padding: 0 12px;
line-height: 30px;
border-radius: 2px;
text-align: center;
color: #fff;
display: inline-block;
padding: 2px 2px;
font-weight:700

}



.checkin_ajax {
   width: 260px;
    height: 60px;
    background-color: #ff6f3d;
    height: 60px;
    display: block;
    position: relative;
    /*border-radius: 5px;*/
    background-image: url(http://img03.mifile.cn/webfile/images/hd/2013120901/tou.png?234);
    background-repeat: no-repeat;
    background-position: 23px 12px;
    cursor: pointer;
}

.checkin_ajax .font {
    position: absolute;
    color: #fff;
    width: 55px;
    height: 30px;
    font-size: 24px;
    line-height: 30px;
    top: 15px;
    left: 65px;
}


.checkin_ajax .continuous {
    display: none;
}

.visted .font {
    font-size: 20px;
    line-height: 25px;
    width: 60px;
    left: 62px;
    top: 10px;
}
.visted .continuous {
    display: block;
    font-size: 12px;
    line-height: 20px;
    position: absolute;
    color: #fff;
    text-align: center;
top: 31px;
    left: 65px;
}


.checkin_ajax .credit {
    height: 56px;
    width: 80px;
    background-color: #fff;
    padding-left: 0px;
    padding-right: 0px;
    position: absolute;
    top: 2px;
    right: 2px;
    font-size: 20px;
    color: #606060;
 text-align : center; 
line-height:56px;
}


</style>