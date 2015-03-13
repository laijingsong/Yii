<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <title>购物车</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/css/base.css" rel="stylesheet" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/jquery-1.8.0.min.js"></script>

  <script type="text/javascript" src="http://www.ddchina.cc/skin/201406/js/cart.js"></script>
  <script type="text/javascript" src="http://www.ddchina.cc/skin/201406/js/jquery.fancybox.pack.js"></script>
  <script src="http://www.ddchina.cc/e/store/assets/default/js/jquery.livequery.js"></script>
  <script type="text/javascript" src="static/default/js/buycart.js"></script>
<script type="text/javascript">
    function fava(id) {
    $.post('http://www.ddchina.cc/e/ShopSys/doaction.php',{enews:'FavaGoods',id:id},function(data) {
    alert(data);
    }, 'html');
    }

    function flash(){
      setInterval("window.top.location.reload()",500); 
    }
    //更新购物车
    function clearCartProduct(gid) {
    $.get('index.php',{r:'cart/del',gid:gid},function(data) {
    alert(data);
    }, 'html');
    setInterval("window.top.location.reload()",1000); 
    }

  $(document).ready(function() {
    $('.editcart').click(function() {
      var gid=$(this).data('gid');
    $('.editcart').fancybox({
      type:'ajax', 
      ajax: {dataType: 'text'},
      href: 'index.php?r=cart/selectSpec&goods_id='+gid
     });
    });
  });
</script>
</head>
<body>
	<header>
		<div class="header">
            <a class="menu-back" href="javascript: history.back();"></a>
             <span class="title">购物车</span> 
             <a class="add-adress edit-btn" href="javascript:" ><?php if ($cart){?>编辑<?php }?></a>       		
		</div>
	</header>
    <div class="wrap-main cart-orders">
    <?php if ($cart){?>
    	<?php foreach ($cart as $s=>$store){?>
        <div class="postfee-bar product-sku">
            <p class="name-store"><input class="cbx man-checkbox" type="checkbox" data-storeid="<?php echo $s?>" checked="checked"><?php echo $storeinfo[$s]['store_name']?><span class="float-right">共 <span class="red"><i id="store-qty-<?php echo $s?>">0</i></span> 件</span></p>
            <?php foreach ($store as $g=>$goods){?>
            	<?php foreach ($goodsfilter[$g][colorid] as $gc=>$goodscolor){?>
        			<input class="color_at_less" type="hidden" name="<?php echo $gc?>" data-min='<?php echo $goodsfilter[$g][min]?>' value="<?php echo $goodcolor?>">
       		 	<?php }?>
       		 	
       		<?php if($goods){
			foreach ($goods as $p=>$specs){?>
            <div class="item-main clearfix list-items-<?php echo $s?>" stocksid="<?php echo $p?>">
            	<input type="hidden" name="stocks" value="<?php echo $p?>">
            	<input class="cbx goods-checkbox <?php echo $goodsfilter[$g][ischeck]==1?' gch':''?>" type="checkbox" id="checkbox_<?php echo $p?>" name="goodsid" value="<?php echo $g?>"  <?php echo ($goodsfilter[$g][ischeck]==1 && $goodsfilter[$g]['nostocks'] == 0)?'checked="checked"':'disabled'?>  data-num="<?php echo $specs['qty']?>" data-money="<?php echo $goodsfilter[$g]['price']?>"  data-storeid="<?php echo $s?>" data-specid="<?php echo $specs['specid']?>">
                <p class="img"><img src="http://www.ddchina.cc<?php echo $goodsfilter[$g]['info']['productpic']?>"></p>
                <p class="title-bar"><?php echo $goodsfilter[$g]['name']?></p> 
                
                <div class="info-bar">
		            <p class="property-bar"><span>颜色：<?php echo $color[$specs['colorid']]?></span><span>价格：<?php echo $goodsfilter[$g]['price']?></span></p>
                    <p class="price-bar"><span>尺码：<?php echo $size[$specs['sizeid']]?>码</span><span>数量：<i id="stocks_<?php echo $p?>"><?php echo $specs['qty']?></i></span></p>
                </div>
                
                <div class="edit">
                    <em class="data-crease decrease" >-</em>
                    <input type="text" name="num" value="<?php echo $specs['qty']?>" size="1" data-store="<?php echo $s?>" data-goods="<?php echo $g?>" data-stocks="<?php echo $p?>" class="data-num float-left" />
                    <em class="data-crease increase" >+</em>
                    <span style="color: red;display:none;" id="stocks_<?php echo $p?>"></span>
                </div>
                <?php if ($goodsfilter[$g]['isend']==0){?><p class="org clearfix">该商品暂无现货，计划交货期<?php echo $goodsfilter[$g]['delivery']?></p><?php }?>
            </div>
		    <?php }}?>
		    
            <?php }?>      
        </div>
        <?php }?>
    </div>
    <form action="index.php" method="get" id="chosen">
    <div class="order-btn clearfix">
    	<p>商品总额：<span class="red">￥<span id="t_money"><?php echo $goodsfilter['all_money']?></span></span></p>
        <p class="small">（不含运费）</p>
        <input type="hidden" name="r" value="cart/confirm">
        <input  type="hidden" name="data" id="data" value="">
        <input  type="hidden" name="city" id="city" value="<?php echo $city?>">
        <a class="submit-btn" href="javascript:" id="chosenSubmit">去结算</a>
        <a class="del-btn" href="javascript:">删除</a>
    </div>
    </form>
    <div class="right-side">
        <ul>
            <li class="uptop" style="display:none;"><a id="top" href="#"></a></li>
        </ul>
    </div>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/touchslider.dev.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/index.js"></script>	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/article_v3.js"></script>
	<script>
	$(document).ready(function() {
		//编辑购物车
		$('.edit-btn').click(function(){
			var edit = $(this);
	        if(edit.html() == "编辑") {
	        	$('.edit').toggle();
				$('.info-bar').toggle();
				$('.submit-btn').toggle();
				$('.del-btn').toggle();
				edit.html("保存");
	        }else{
	        	var douhao='';
		        var json = '[';
		        var store = '';
		        var goods = '';
		        var stocks = '';
		        var num = '';
		        $(':text').each(function(){
		        	store = $(this).data('store');
		        	goods = $(this).data('goods');
					stocks = $(this).data('stocks');
					num = $(this).val();
					if(num<=0)num=1;
					json = json+douhao+'{"storeid":'+store+',"goodsid":'+goods+',"specid":'+stocks+',"qty":'+num+'}';
					douhao=',';
		        });
		        json = json+']';
				
				$.ajax({
					url:'index.php?r=cart/editcart',
           			type:'post',
           			dataType:'json',
           			data:'json='+json,
           			success:function(data){
						if(data.code==0){
							location.reload();
							/*
							$(':text').each(function(){
								stocks = $(this).data('stocks');
								num = $(this).val();
								if(num<=0)num=1;
								$('#stocks_'+stocks).html(num);
								$('#checkbox_'+stocks).data('num',num);
					        });
							$('.edit').toggle();
							$('.info-bar').toggle();
							$('.submit-btn').toggle();
							$('.del-btn').toggle();
							edit.html("编辑");
							re_j_total();
							*/
						}
           			}
				});
	        }
		});
		//删除购物车商品
		$('.del-btn').click(function(){
			if(confirm("是否确认删除")){
				var spec_ids='';
				var douhao='';
				$("input.goods-checkbox[type='checkbox']:checked").each(function() {
			        var specid = $(this).data('specid');
			        spec_ids = spec_ids+douhao+specid;
			        douhao=',';
				});
				$.ajax({
					url:'index.php?r=cart/delcart',
           			type:'post',
           			dataType:'json',
           			data:'specids='+spec_ids,
           			success:function(data){
           				location.reload();
           			}
				});
			}
		});

		//提交购物车
	  $( "#chosenSubmit" ).click(function( event ) {
	
	    //var goodsids='';
	    var spec_ids='';
	    var douhao='';
	    $("input.goods-checkbox[type='checkbox']:checked").each(function() {
	      //var gid = $( this ).val();
	      var specid = $(this).data('specid');
	      spec_ids = spec_ids+douhao+specid;
	      //goodsids=goodsids+douhao+gid;
	      douhao=',';
	    });
	    
	    if(spec_ids==''){
	        alert('请选择商品。');
	         event.preventDefault();
	        return false;
	    }
	   
	    var color_num_yes = true;
	   
	    if(color_num_yes){
	      $( "form#chosen input#data" ).val(spec_ids);
	      $("form#chosen").submit();
	      return;
	    }
	    
	     return false;
	      event.preventDefault();
	  });
	
	
	    $('.man-checkbox').click(function(event) {  //on click 
	      var che=this.checked;
	      //var parent=$(this).parent('tr.list-caption');
	      var storeid=$(this).data('storeid');
	      //console.log(storeid);
	      $('.list-items-'+storeid).each(function() { //loop through each checkbox
	                $(this).find('.gch')[0].checked = che; //deselect all checkboxes with class "checkbox1"                       
	      });
	      re_j_total();
	
	    });

	    $('.goods-checkbox').click(function(event) {  //on click 
	        re_j_total();

	     });
	
	    function re_j_total() {
	   
	      var t_num=0;
	      var t_money=0;
	      var store_money={};
	      var store_qty={};
	    $("input.goods-checkbox[type='checkbox']:checked").each(function( index ) {
	    var num = parseFloat($( this ).data('num'));
	    var money = parseFloat($( this ).data('money'))*num;
	    var storeid = $( this ).data('storeid');
	    storeid = storeid.toString();
	     t_num+=num;
	     t_money+=money;
	      if(storeid in store_money){
	        //alert(storeid);
	        store_qty[storeid]+=num;
	        store_money[storeid]+=money;
	      }else{
	    	store_qty[storeid]=num;
	        store_money[storeid]=money;
	      }
	
	      $('#store-qty-'+storeid).text(store_qty[storeid]);
	    });
	
	    //console.log(store_money);
	    //$("#t_num").text(t_num);
	    $("#t_money").text(t_money.toFixed(2));
	    
	    }
	
	    //商品收藏
	    re_j_total();
	  
	})
	</script>
		<?php }else{?>
		<!-- 没有商品时  -->
		<div class="scart">
	        <img src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/img/car.jpg">
	    </div>
	    <p class="c8">您的购物车内还没任何商品</p>
	    <div class="dan-btn">
	        <a class="buy" href="/">去逛逛</a>
	    </div>
	    <?php }?>
</body>
</html>