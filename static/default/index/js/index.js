var tvHome = {
	init:function(){
		var that = this;
		that.prev = $(".prev");
		that.next = $(".next");
		that.$scroller = $(".scroller ul");
		that.$list_len = $(".scroller ul li").length;
		that.$scroller_width = $(".scroller ul li").width();
		that.$scroller.width(that.$list_len * that.$scroller_width);
		that.scroller_count = 1;
		that.bindEvent();
	},
	bindEvent:function(){
		var that = this;
		var active = 0,
			as = $('#indicator a');		
		for(var i=0;i<as.length;i++){
			(function(){
				var j=i;
				as[i].onclick=function(){
					ad.slide(j);
					return false;
				}
			})();
		}

		var ad = new TouchSlider({id:'slider', speed:600, timeout:3000, before:function(index){
				as[active].className='';
				active=index;
				as[active].className='active';}});
				
		that.next.click(function(){
			if(that.scroller_count >= that.$list_len){
				return false;
			}
			that.scroller_count++;
			that.$scroller.animate({left:"-=" + that.$scroller_width + "px"},"slow");
			that.scroller_pic();
		});
		that.prev.click(function(){
			
			if (that.scroller_count <= 1) {
				return false;
			}
			that.scroller_count--;
			that.$scroller.animate({left:"+=" + that.$scroller_width + "px"},"slow");
			that.scroller_pic();
		});
				
	},
	scroller_pic:function() {
		var that = this;
		if (that.scroller_count >= that.$list_len) {
			that.next.css({cursor: 'auto'});
			that.next.addClass("dasabled");
		}
		else if (that.scroller_count > 1 && that.scroller_count <= that.$list_len) {
			that.prev.css({cursor: 'pointer'});
			that.prev.removeClass("dasabled");
			that.next.css({cursor: 'pointer'});
			that.next.removeClass("dasabled");
		}
		else if (that.scroller_count <= 1) {
			that.prev.css({cursor: 'auto'});
			that.prev.addClass("dasabled");
		}
	}	
}

$(function(){
	tvHome.init();
	var colorChoice = $(".pro-color .choice li");
	colorChoice.click(function(){
		var index = colorChoice.index(this);
		colorChoice.eq(index).addClass("cur").siblings().removeClass("cur");
	});
	
	var typeChoice = $(".pro-type .choice li");
	typeChoice.click(function(){
		var index = typeChoice.index(this);
		typeChoice.eq(index).addClass("cur").siblings().removeClass("cur");
	});
	//数量增减
	$('.increase').click(function(){
		var obj = $(this);
		var i=parseInt(obj.siblings('.data-num').val())+1;
		if (i>=obj.siblings().find('.store').text() && parseInt(obj.siblings().find('.store').text()) > 0){
			i=obj.siblings().find('.store').text();
		}	
		obj.siblings('.data-num').val(i);	
		$(this).addClass('increaset');		
	});
	$('.decrease').click(function(){
		var obj = $(this);
		var i=parseInt(obj.siblings('.data-num').val())-1;
		if (i<=0){
			i=1;
		}
		obj.siblings('.data-num').val(i);
	});
});	
$(function(){	
//按钮被点击后，滑动到顶
	$(window).scroll(function() {
		if ($(window).scrollTop() > 150) {
			$('.right-side li:last').fadeIn(500);
		} else {
			$('.right-side li:last').fadeOut(500);
		}
	});
	$("#top").click(function() {
		$('body,html').animate({scrollTop: 0},800);
		return false;
	});
	$('.comment').click(function(){
		$('.commentform').toggle();
	})
	$('.reply').click(function(){
		$('.commentform').show();
	})
	$('.logoutsubmit').click(function(){
		$('.commentform').hide();
	})

	$('.menu-share').click(function(){
		$('.share').toggle();
		$('.shade-div').show();
	})
	$('.buy').click(function(){
		$('.contactDiv').toggle();
		$('.shade-div').show();
	})
	$('.shade-div').click(function(){
		$('.share').hide();
		$('.shade-div').hide();
		$('.contactDiv').hide();
		$(".success-add-cart").hide();
	})
});
(function($){
	$.fn.extend({
		setPosition:function(){
			if(this.height() < $(window).height()) {
				this.css({"top":($(window).height() - this.height())/2 + $(document).scrollTop()});
			}else{
				this.css({top:$(document).scrollTop()});
			}
			this.css({"left":($(window).width() - this.width())/2});
			//console.log(1);
			return this;
		}		
	});
})(jQuery);
$(function(){	
	$(".buy").click(function(){
		$(".success-add-cart").setPosition().show();
		$(".shade-div").show();
		return false;
	});
	$(".popBox").click(function(){
		$(".popBox").hide();
		$("#shade-div").hide();
		return false;		
	});
	//按钮被点击后，滑动到顶
	$(window).scroll(function() {
		if ($(window).scrollTop() > 200) {
			$('.submit-bar').fadeOut(100);
		} else {
			$('.submit-bar').fadeIn(100);
		}
	});
	$('.edit-btn').click(function(){
		$('.edit').toggle();
		$('.info-bar').toggle();
		$('.submit-btn').toggle();
		$('.del-btn').toggle();
            if($(this).html() == "编辑") {
            $(this).html("保存");
        }else{
            $(this).html("编辑");
        }
		})
});
$(function(){
	$("#normaltab").tabso({
		cntSelect:"#normalcon",
		tabEvent:"mousedown",
		tabStyle:"fade"
	});
})