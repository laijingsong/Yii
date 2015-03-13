    <div class="wrap-main">
        <div class="sub product clearfix">
        	<div class="product-sroll">
                <ul id="slider">
                	<?php foreach ($gallery as $k=>$v){ ?>
                    <li><img src="<?php echo Yii::app()->params['ddcurl'].$v['pic'] ?>" alt="" /></li>
					<?php } ?>
                </ul>
                <div id="indicator">
                	<?php foreach ($gallery as $k=>$v){ ?>
                    <a href="javascript:void(0);" <?php echo $k == 0?'class="active"':''?>></a>
					<?php } ?>
                </div>
            </div>
            <div class="pro-info">
	            <h2><?php echo $goods['title'] ?></h2>
	            <h3 class="formprice">吊牌价：<span class="red">￥</span><b><?php echo ($pro && $pro['isend']==0)?number_format($goods['lsprice']*0.88,2):$goods['lsprice']?></b> <?php if (($pro && $pro['isend']==0)){?><span class="zhe"> (8.8折)</span><?php }?></h3>
	            <?php if (($pro && $pro['isend']==0)){?><p class="orange">该商品暂无现货，申请订购即可享受8.8折超低折扣！</p><?php }?>
	        </div>
            <div class="product-select">
                <div class="pro-color clearfix">
                    <span class="float-left">颜色：</span>
                    <ul class="choice">
                    	<?php foreach ($color as $k=>$v){ ?>
                        <li id="color" class="color" color="<?php echo $v['id']?>"><?php echo $v['name'] ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="pro-type clearfix">
                    <span class="float-left">尺码：</span>
                    <ul class="choice">
                    	<?php foreach ($size as $k=>$v){ ?>
                        <li id="size" class="size" size="<?php echo $k?>"><?php echo $v ?></li>
                        <?php } ?>
                    </ul>
                </div>	
                <div class="product-sku clearfix">
                    <span class="float-left">数量： </span>
                    <em class="data-crease decrease" >-</em>
                    <input type="text" id="num" name="num" value="1" size="1" class="data-num float-left" />
                    <em class="data-crease increase" >+</em>
                    <span class="amount">库存：<span class="orange" id="stocks"><?php echo ($pro && $pro['isend']==0)?'5':$stocks['total']?></span> 件</span>
                </div>	
            </div>
            <div class="btn clearfix">
                <a class="service buy" id="t_buy" href="javascript:;" colorid='' sizeid='' stocksid='' name="<?php echo $goods['title']?>" goodsid="<?php echo $goods['id']?>" storeid="<?php echo $goods['store_id']?>" id="spec_22566890" specid=""><i></i>我要订购</a>
                <a class="brand" href="index.php?r=shop/designer&dpid=<?php echo $this->dpid ?>&sid=<?php echo $goods['store']['store_id']?>"><i></i>设计师品牌</a>
            </div>
        </div>
       
        <!--<div class="more_pic">
        	<a href="view_more.html">更多图文信息<i></i></a>
        </div>-->
        <!--图文信息-->
        <div class="wrap-main">
            <?php echo $newtext; ?>
        </div>
		<!--成功加入购物车-->
	    <div class="success-add-cart">
	    	<p>成功加入购物车</p>
	    	<div class="btn clearfix">
	            <a href="index.php?r=cart">查看购物车</a>
	            <a class="right-btn popBox" href="javascript:;">继续购物</a>
	        </div>
	    </div>
	    <script>
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
	    		$('.color').click(function(){
					$('#t_buy').attr('colorid',$(this).attr('color'));
					var colorid=$('#t_buy').attr('colorid');
               	    var sizeid=$('#t_buy').attr('sizeid');
               	    if(colorid!=''&&sizeid!=''){
						$.stocks(colorid,sizeid);
               	    }
                });
               	$('.size').click(function(){
               		$('#t_buy').attr('sizeid',$(this).attr('size'));
               		var colorid=$('#t_buy').attr('colorid');
               	    var sizeid=$('#t_buy').attr('sizeid');
               	    if(colorid!=''&&sizeid!=''){
               	    	$.stocks(colorid,sizeid);
               	    }
                });
               	$.stocks = function(colorid,sizeid){
                	var goodsid=$('#t_buy').attr('goodsid');
                	$.ajax({
               			url:'index.php?r=cart/stocks',
               			type:'post',
               			dataType:'json',
               			async:false,
               			data:{goodsid:goodsid,colorid:colorid,sizeid:sizeid},
               			success:function(data){
                   			if(data.code==0){
                       			<?php if (!($pro && $pro['isend']==0)){?>
	                   			$('#stocks').html(data.stock);
	                   			<?php }?>
                   				$('#t_buy').attr('stocksid',data.stocksid);
                   			}
               			}
               		});
                };
                
	    		$("#t_buy").click(function(){
	    			var spec='';
               		
               	    var colorid=$(this).attr('colorid');
               	    var sizeid=$(this).attr('sizeid');
               	    if(colorid=='' || sizeid==''){
                   	     alert('请选择商品颜色和尺码');
                   	     return false;
               	    }
               	    var sid=$(this).attr('stocksid');
               	    var name=$(this).attr('name');
               	    var goodsid=$(this).attr('goodsid');
               	    var storeid=$(this).attr('storeid');
               	    var qty=parseInt($('#num').val());
               		<?php if (!($pro && $pro['isend']==0)){?>
					var havestocks=true;
                   	$.ajax({
               			url:'index.php?r=cart/stocks',
               			type:'post',
               			dataType:'json',
               			async:false,
               			data:{goodsid:goodsid,colorid:colorid,sizeid:sizeid},
               			success:function(data){
                   			if(data.code==0){
	                   			if(data.stock < qty){
		                   			havestocks=false;
		                   		}
                   			}
               			}
               		});
                   		
                   	if(!havestocks){
	                    alert("库存不足");
	                	return false;
                   	}
                   	<?php }?>
               	    if(qty>0){
               	    	spec+='{"specid":"'+sid+'","qty":"'+qty+'","colorid":"'+colorid+'","sizeid":"'+sizeid+'","name":"'+name+'","goodsid":"'+goodsid+'","storeid":"'+storeid+'"}';
               	    }

               		if(spec){
               			spec='['+spec+']';
               			/*o.find('#submit_cart').val(spec);*/
               		}else{
               			alert('请选择产品属性');
               			return false;
               		}
					
               		//提交订单
               		$.ajax({
               			url:'index.php?r=cart/add',
               			type:'post',
               			dataType:'json',
               			data:'specData='+spec,
               			success:function(data){
               				$(".success-add-cart").setPosition().show();
        	    			$(".shade-div").show();
               			}
               		});
	    		});
	    		$(".popBox").click(function(){
	    			$(".shade-div").hide();
	    			$(".success-add-cart").hide();
	    			return false;		
	    		});
	    	});
        </script>