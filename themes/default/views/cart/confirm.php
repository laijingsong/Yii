<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <title>确认订单</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/css/base.css" rel="stylesheet" />
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/jquery-1.8.0.min.js"></script>
  <script type="text/javascript" src="http://www.ddchina.cc/skin/201406/js/jquery.js"></script>
  <script type="text/javascript" src="http://www.ddchina.cc/skin/201406/js/cart.js"></script>
  <script type="text/javascript" src="http://www.ddchina.cc/skin/201406/js/jquery.fancybox.pack.js"></script>
  <script type="text/javascript" src="http://www.ddchina.cc/e/store/assets/default/js/buycart.js"></script>
</head>
<body>
	<header>
		<div class="header">
            <a class="menu-back" href="javascript: history.back();"></a>
             <span class="title">确认订单</span> 
             <a class="menu-share no" href="#" ></a>       		
		</div>
	</header>
	<form action="index.php" method="get" id="submit_form">
	<input  type="hidden" name="r" value="cart/order">
    <div class="wrap-main">
		<div class="postfee-bar">
        	<h3>收货地址</h3>
            <div class="select-adress">
            	<?php 
            	if($address){
					foreach ($address as $a=>$addr){
						if($addr['city']!=$city_on) continue;
						if($addr['city']){?>
						<input type="hidden" id="addressid" name="addressid" value="<?php echo $addr['addressid']?>">
                <a href="index.php?r=cart/selectaddress&data=<?php echo Yii::app()->request->getParam('data');?>&city=<?php echo Yii::app()->request->getParam('city');?>">
                    <p><span class="f14"><?php echo $addr['truename']?></span> <?php echo $addr['phone']?></p>
                    <p><?php echo $province[$addr['province']]['provinceName']?><?php echo $city[$addr['city']]['cityName']?><?php echo $addr['address']?></p>
                    <i class="icon icon4"></i>
                </a>
                <?php }}}else{?>
                <!--没有收货地址-->   
                <p>您当前还未设置收货地址，<a class="red" href="index.php?r=cart/addaddress&data=<?php echo $data?>&city=<?php echo $city_on?>">点击创建</a></p>
                <?php }?>
            </div>
        </div>
        <div class="order-item">
            <div class="postfee-bar pay-list">
                <h3>支付方式</h3>
                <label><input type="radio" name="payfsid" id="payfsid" checked="checked" value="7"><img src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/img/ys.jpg">银盛支付</label>
                <label><input type="radio" name="payfsid" id="payfsid" value="8"><img src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/img/alipay.jpg">支付宝</label>
            </div>
        </div>
        <div class="order-item">
            <div class="postfee-bar express">
            	<input type="hidden" name="psid" id="psid"value="6">
                <h3>配送方式<span class="float-right">普通快递</span></h3>
            </div>
        </div>
        <div class="order-item">
            <div class="postfee-bar">
                <h3>商品清单</h3>
                <?php if ($cart){?>
    			<?php foreach ($cart as $s=>$store){
    			$totalprice=0;
    			$yunfei=0;
    			$total=0;
    			?>
                <p class="name-store"><?php echo $storeinfo[$s]['store_name']?><span class="float-right">共 <span class="red"><i id="store-qty-<?php echo $s?>">0</i></span> 件</span></p>
                <?php foreach ($store as $g=>$goods){
       		 		$totalprice+=$goodsfilter[$g]['total'];
       		 		$yunfei+=$goodsfilter[$g]['yunfei'];
       		 	?>
	       		<?php if($goods){
				foreach ($goods as $p=>$specs){
					$total+=$specs['qty'];
				?>
                <div class="item-main clearfix">
                	<p class="img"><img src="http://www.ddchina.cc<?php echo $goodsfilter[$g]['info']['productpic']?>"></p>
                    <p class="title-bar"><?php echo $goodsfilter[$g]['name']?></p>
                    <p class="property-bar"><span>颜色：<?php echo $color[$specs['colorid']]?></span><span>价格：<?php echo $goodsfilter[$g]['price']?></span></p>
                    <p class="price-bar"><span>尺码：<?php echo $size[$specs['sizeid']]?>码</span><span>数量：<?php echo $specs['qty']?></span></p>
                </div>
                <?php }}?>
		    
	            <?php }?>      
	            <div class="total-box">运费：<span class="red">￥<?php echo $yunfei?></span><span class="float-right">商品金额：<span class="red">￥<?php echo $totalprice?></span></span></div>
	            <script>
	           		$(document).ready(function() {
						$('#store-qty-<?php echo $s?>').html('<?php echo $total?>');
	           		});
	            </script>
	            <?php }?>
	            <?php }?>
            </div>
        </div>
        <div class="postfee-bar pay-bar">
        <!-- 
        	<p>共需支付￥368</p>
            <div class="dan-btn">
                <a class="buy" href="#"><i></i>立即支付</a>
            </div>
         -->
        </div>
    </div>
    <div class="order-btn submit-bar clearfix">
    	<p>共需支付<span class="red">￥<?php echo $goodsfilter['all_yunfei']+$goodsfilter['all_money']?></span></p>
        <p class="small">（含运费￥<?php echo $goodsfilter['all_yunfei']?>）</p>
        <input type="hidden" name="bz" id="bz">
        <input id="h_json"  type="hidden" name="json" value='<?php echo $json?>'>
        <a class="submit-btn" href="javascript:;" id="submit_btn">提交订单</a>
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
	  $( "#submit_btn" ).click(function( event ) {
		  var addressid=$("input#addressid").val();
		if(addressid){
	      //$( "form#chosen input#data" ).val(goodsids);
	      $("form#submit_form").submit();
	    }else{
	      alert('请填写地址');
	      return false;
	    }
	  
	      event.preventDefault();
	  });
	  
	  $('input.addr').change(function() {
	   var city=$(this).data('city');
	   var url=window.top.location+'&city='+city;
	   window.location.href=url;
	  });
	
	  $('.province').change(function() {
	    $.get('index.php', {r:'cart/city',provinceid:$('.province').val()}, function(data) {
	      $('.city').empty();
	      $('.city').append(data);
	    }, 'html');
	  }).trigger( "change" );
	
	
	  //更新购物车
	  $( "form#address_form" ).submit(function( event ) {
	    var da=$( this ).serialize();
	    $.get('index.php',da,function(data) {
	    alert(data);
	    }, 'html');
	    event.preventDefault();
	    setInterval("window.top.location.reload()",500); 
	  });
	
	    $( "input.tr3-input" ).removeAttr("checked"); 
	  
	})
	</script>
</body>
</html>