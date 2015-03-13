<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    <title>彩衫网-最好的服装设计师作品采购平台</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/css/base.css" rel="stylesheet" />

</head>
<body>
	<header>
		<div class="header">
            <a class="menu-back" href="javascript: history.back();"></a>
             <span class="title">收货地址</span> 
             <a class="add-adress" href="#" >保存</a>       		
		</div>
	</header>
    <div class="wrap-main adress-new">
        <form class="adress-form" method="POST" action="" name="adress-form" id="adress-form">
            <ul>
                <li><input type="text" placeholder="请输入收件人姓名" value="" name="truename"></li>
                <li>
                    <select class="province" name="province">
                        <option value="">选择省份</option>
                        <?php if($province){?>
						<?php foreach ($province as $s=>$prov){?>
                        <option value="<?php echo $s?>"><?php echo $prov['provinceName']?></option>
                        <?php }?>
						<?php }?>
                    </select>
                </li>
                <li>
                    <select class="city"name="city">
                        <option value="">选择城市</option>
                    </select>
                </li>
                <li><textarea placeholder="详细地址（路名或街道地址，门牌号）" name="address"></textarea></li>
                <li><input type="text" placeholder="联系人电话" value="" name="phone"></li>
            </ul>
            <!-- <p><input class="cbx" type="checkbox"> 是否设为默认地址</p> -->
            <div class="btn clearfix">
            	<input type="hidden" name="url" value="<?php echo Yii::app()->request->urlReferrer?>">
                <a class="add-adress" href="javascript:;">保存</a>
                <a class="right-btn" href="javascript:history.back();">取消</a>
            </div>
        </form>
    </div>
</body>
</html>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/jquery-1.8.0.min.js"></script>
<script>
$('.add-adress').click(function(){
	var truename=$("input[name='truename']").val();
	var address=$("input[name='address']").val();
	var phone=$("input[name='phone']").val();
	var province=$("select[name='province']").val();
	var city=$("select[name='city']").val();
	if(truename==''||address==''||phone==''||province==''||city==''){
		alert('请填写完整信息');
		return false;
	}
	
	$("form#adress-form").submit();
});

$('.province').change(function() {
    $.get('index.php', {r:'cart/city',provinceid:$('.province').val()}, function(data) {
      $('.city').empty();
      $('.city').append(data);
    }, 'html');
  }).trigger( "change" );
</script>