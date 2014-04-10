var browser={};

browser.isie=!!window.ActiveXObject;
browser.isie6=!!browser.isie&&window.VBArray && !window.XMLHttpRequest; 
browser.isie8=!!browser.isie&&document.documentMode==8;
browser.isie9=!!browser.isie&&document.documentMode==9;
browser.isie10=!!browser.isie&&document.documentMode==10;
browser.isie7=!!browser.isie&&!browser.isie6&&!browser.isie8&&!browser.isie9&&!browser.isie10;
browser.issafari=!!navigator.vendor && navigator.vendor.toLowerCase().indexOf('apple')!=-1; 
browser.ischrome=!!window.chrome; 
browser.isopera=!!window.opera;
browser.isfirefox=!!window.mozIndexedDB;

var loadding = false;
var loadnum = 0;
var loadoffset = 0;

jQuery(function($) {

	if ($("#headimg").length > 0) {
		var _index = _next = 0;
		var headimgtimer;
		var _size = $(".listtab ul li:not(.line)").size();
		headimgShow();
		$(".listtab ul li:not(.line)").mouseenter(function () {
			$(".listtab ul li").removeClass("select");
			$(this).addClass("select");
			_index = $(".listtab ul li:not(.line)").index($(this));
			$(".himglist ul li").removeClass("select");
			$(".himglist ul li").eq(_index).addClass("select");
			clearTimeout(headimgtimer);
		}).mouseleave( function () {
			headimgShow();
		});
		
		function headimgShow(){
			headimgtimer = setTimeout(function(){
				if(_index < (_size-1)){ _next++;}else{_next = 0;}
				$(".listtab ul li:not(.line)").eq(_next).mouseenter();
				headimgShow();
			},3000);
		}
	}
	
	if ($("#pmore").length > 0) {
		
		$(window).scroll(function() {
			if(!loadding && loadnum<4){
				var window_height = $(window).height();
				var pmore_offset = $("#pmore").offset();
				var pmore_height = pmore_offset.top;
				var scrolls = $(this).scrollTop();
				if(scrolls>=(pmore_height-window_height)){
					loadcontent();
				}
			}
		});
	}
});

function loadcontent(){
	loadding = true;
	loadnum++;
	$("#pmore a").html('正在加载中.');
	loaddingtext();
	$.getJSON('index.php?act=ajax&offset='+loadoffset, function(response){
		clearTimeout(loaddingtimer);
		if(response.scode == '1'){
			loadoffset = response.offset;
			loadding = false;
			$("#box").append(response.content);
			$("#pmore a").html('阅读更多文章...');
		}
	});
}
var loaddingtimer;
function loaddingtext(){
	loaddingtimer = setTimeout(function(){
		$("#pmore a").html($("#pmore a").html()+'.');
		loaddingtext();
	},500);
}
