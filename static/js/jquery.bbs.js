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


jQuery(function($) {
	if ($("._bugc").length > 0) {
		$("._bugc").mouseenter(function () {
			var cid = $(this).attr('cid');
			$("._bugsc li").hide();
			$("._bugsc_"+cid).show();
		});
	};
	//BUGLIST选项
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
	if ($("._bug").length > 0) {
		var loadajax = 0;
		var elementmust = [];

		$("._bugclass,._bugsclass").change(function () {
			loadajax = 0;

			var classid = 0;
			var sclassid = 0;
			var bugcname,bugscname;
			var sclassid = $('._bugsclass').find('option:selected').val();
			
			if ($(this).hasClass('_bugclass')) {
				classid = $(this).find('option:selected').val();
				$('._bugsclass').find('option:selected').attr("selected",false);
				$('._bugsclass').addClass('_dis');
				$('._bugsclass'+classid).removeClass('_dis');
				 sclassid = 0;
				 $('._bugattr').html('');
			}
			$('#classid').val(sclassid);
			var bugcname = $('._bugclass').find('option:selected').text();
			var bugscname = $('._bugsclass').find('option:selected').text();
			$('._bugnav').html(bugcname+'  &gt;  '+bugscname);
			$.BugAjaxLoad();
		});
		

		$.BugAjaxLoad = function(edit){
			var classid = parseInt($('#classid').val());
			if (edit) {
				var btid = $('#btid').val();
			};
			
			if (classid) {
				$('._bugattr').html('Loading....');
				$.getJSON('buglistajax.php?action=getattr&classid='+classid+(btid?'&tid='+btid:''), function(response){
					loadajax = 1;
					if (response.scode == '1') {
						elementmust = response.must;
						$('._bugattr').html(response.content);
						loadajax = 1;
					};
				});
			}else{
				$('._bugattr').html('');
				loadajax = 1;
			}
		}
		$.BugAjaxLoad(true);

		$.bugsubmit = function (theform) {
			if (!loadajax) {
				showError('信息尚未加载完毕,请等待加载完毕并全部填写后再提交问题');
				return false;
			};

			var classid = $('#classid').val();
			if (classid<=0) {
				$("._bugsclass,._bugclass").css('border', "1px solid #FF6464").focus(function(){$('._bugsclass,._bugclass').removeAttr('style')});
				$("html,body").animate({scrollTop: $('._bugclass').offset().top -54}, 200 ,function(){
					showError('抱歉,请选择您的问题分类');
				});
				return false;
			};
			var eachf = true;
			if (elementmust && elementmust.length>0) {
				$.each(elementmust, function(key, val) {
					if (!$('#'+val).val()) {
						$('#'+val).css('border', "1px solid #FF6464").focus(function(){$(this).removeAttr('style')});
						$("html,body").animate({scrollTop: $('#'+val).offset().top -54}, 200 ,function(){
							showError('抱歉,请选择您的问题分类');
						});
						eachf = false;
						return false;
					};
				});
			};
			return eachf?validate(theform):false;
		};

	};
	//bug end
});

function loadcontent(){
	var $ = jQuery;
	loadding = true;
	loadnum++;
	$("#pmore a").html('正在加载中.');
	loaddingtext();
	$.getJSON('index.php?act=ajax&offset='+loadoffset, function(response){
		clearTimeout(loaddingtimer);
		if(response.scode == '1'){
			loadoffset = response.offset;
			loadding = false;
			$(".listcontent").last().after(response.content);
			$("#pg").html(response.multipage);
			if (loadoffset<response.totalnum) {
				$("#pmore a").html('阅读更多文章...');
			}else{
				$("#pmore a").html('已经没有文章了');
			}
			
		}
	});
}
var loaddingtimer;
function loaddingtext(){
	var $ = jQuery;
	loaddingtimer = setTimeout(function(){
		$("#pmore a").html($("#pmore a").html()+'.');
		loaddingtext();
	},500);
}
var BMDialog = {
	'obj':false,
	'boxid':'#buglist_box',
	'init':function (){
		var $ = jQuery;
		if ($(this.boxid).length < 1) {
			$('#append_parent').append('<div id="buglist_box"><div class="buglist_loading">Loading....</div></div>');
			$("#buglist_box").css({position: "absolute"});
		}else{
			this.load();
		}

		this.auto();
	},
	'load':function (){
		var $ = jQuery;
		$(this.boxid).html('<div class="buglist_loading">Loading....</div>');
	},
	'close':function (refresh){
		var $ = jQuery;
		$(this.boxid).remove();
		if (refresh)
		{
			this.refresh();
		}

	},
	'refresh':function (){
		location.href = location.href;
	},
	'get':function (obj,id,todo,ismember){
		var $ = jQuery;
		this.obj = obj;
		this.init();
		if (typeof(ismember)=="undefined") {
			todo = typeof(todo)=="undefined"?'process':todo;
			var _this = this;
			$.getJSON('manage.php?action=buglist&operation='+todo+'&id='+id, function(response){
				$(_this.boxid).html(response.content);
				_this.auto();
			});			
		}else{
			var _this = this;
			$.getJSON('buglistajax.php?action=membersupply&tid='+id, function(response){
				$(_this.boxid).html(response.content);
				_this.auto();
			});	
		}

	},
	'samenum':function (tid,obj_id){
		var $ = jQuery;
		var html = $(obj_id).html();
		
		$(obj_id).html('<img src="static/image/common/buglistloading.gif" />');
		$.getJSON('buglistajax.php?action=samenum&tid='+tid, function(response){
			if (response.scode == '1') {
				$(obj_id).html(response.num);
				showError(response.message);
			}else{
				$(obj_id).html(html);
				showError(response.error);
			}
		});
	},
	'property':function (tid,obj_id,showreal){
		var $ = jQuery;
		$(obj_id).parent().show();
		$(obj_id).show();
		$(obj_id).html('Loading....');
		$.getJSON('manage.php?action=buglist&operation=property&id='+tid, function(response){
			if ($('._buglog').length>0) {
				$('._buglog').html(response.buglogs);
			};
			if (response.content) {
				$(obj_id).html(response.content);
			}else{
				$(obj_id).html('无内容');
			}
			
		});	
	},
	'post':function (id,todo,ismember){
		var $ = jQuery;
		var _this = this;
		var postdata = $("#buglistpostform").serialize();
		this.init();
		if (typeof(ismember)=="undefined") {
			
			todo = typeof(todo)=="undefined"?'process':todo;
			
			$.post('manage.php?action=buglist&operation='+todo+'&id='+id, postdata , function(response){
				//console.dir(response);
				$(_this.boxid).html(response.content);
				_this.auto();
			}, "json");	
		}else{

			$.post('buglistajax.php?action=membersupply&tid='+id, postdata , function(response){
				//console.dir(response);
				$(_this.boxid).html(response.content);
				_this.auto();
			}, "json");	
		}


	},
		// 窗口适应
	'auto':function (){
		var $ = jQuery;
		var top = 0;
		var left = 0;
		var height = $(window).height();
		var width = $(window).width();
		var box_height = $(this.boxid).outerHeight();
		var box_width = $(this.boxid).outerWidth();
		var obj_height = $(this.obj).outerHeight();
		var obj_width = $(this.obj).outerWidth();
		var obj_offset = $(this.obj).offset();
		//console.log(  height,width,box_height,box_width,obj_height,obj_width,obj_offset);
		if((obj_offset.left+box_width)>width){
			left =obj_offset.left-box_width+obj_width;
		}else{
			left =obj_offset.left;
		}
		if((obj_offset.top+box_height)>height){
			top = obj_offset.top-box_height;
		}else{
			top = obj_offset.top+obj_height;
		}
		$(this.boxid).offset({ top: top, left:left});
	}
}

