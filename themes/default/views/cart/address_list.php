<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <title>收货地址</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/css/base.css" rel="stylesheet" />
</head>
<body>
	<header>
		<div class="header">
            <a class="menu-back" href="javascript: history.back();"></a>
             <span class="title">收货地址</span> 
             <a class="add-adress" href="index.php?r=cart/addaddress&data=<?php echo $data?>&city=<?php echo $city_on?>" >新增</a>       		
		</div>
	</header>
    <div class="wrap-main adress-list">
    <?php 
    if($address){
		foreach ($address as $a=>$addr){
			if($addr['city']){?>
		<div class="select-adress">
        	<a href="javascript:" class="address" data-city="<?php echo $addr['city']?>">
            	<input class="cbx" type="radio" <?php if ($addr['city'] == $city_on) echo checked?>>
                <p><span class="f14"><?php echo $addr['truename']?></span> <?php echo $addr['phone']?><?php if ($addr['isdefault']){?><span class="default">默认地址</span><?php }?></p>
                <p><?php echo $province[$addr['province']]['provinceName']?><?php echo $city[$addr['city']]['cityName']?><?php echo $addr['address']?></p>
                <i class="icon icon4"></i>
            </a>
        </div>
        <?php }}}else {?>
        	<div class="select-adress">
        	<p>您当前还未设置收货地址，<a class="red" href="index.php?r=cart/addaddress">点击创建</a></p>
        </div>
        <?php }?>
    </div>
</body>
</html>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/jquery-1.8.0.min.js"></script>
<script>
	$('.address').click(function(){
		var city=$(this).data('city');
		location.href="index.php?r=cart/confirm&data=<?php echo $data?>&city="+city;
	});
</script>