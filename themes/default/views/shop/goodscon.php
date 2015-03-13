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
            <h2><?php echo $goods['title'] ?></h2>
            <h3 class="formprice">吊牌价：<span class="red">￥</span><b>658.00</b><span class="zhe"> (8.8折)</span></h3>
            <div class="product-select">
                <div class="pro-color clearfix">
                    <span class="float-left">颜色：</span>
                    <ul class="choice">
                    	<?php foreach ($color as $k=>$v){ ?>
                        <li><?php echo $v['name'] ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="pro-type clearfix">
                    <span class="float-left">尺码：</span>
                    <ul class="choice">
                    	<?php foreach ($size as $k=>$v){ ?>
                        <li><?php echo $v['size_values'] ?></li>
                        <?php } ?>
                    </ul>
                </div>	
            </div>
            <div class="btn clearfix">
                <a class="service buy" id="buy" href="javascript:;"><i></i>我要订购</a>
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
		<div class="contactDiv">
		    <h2>店铺信息</h2>
		    <ul>
		        <li class="line">
		            <p class="font"><?php echo $this->dpinfo['name'];?></p>
		            <p><span>所  在  地 :</span> <?php echo $this->province[$this->dpinfo['dpcontact']['provinceid']];echo ' '.$this->city[$this->dpinfo['dpcontact']['cityid']] ?> <?php echo $this->dpinfo['dpcontact']['address'] ?> </p>
		            <p><span>开店时间 :</span> <?php echo date('Y-m-d',$this->dpinfo['addtime']) ?></p>
		        </li>
		        <li><a class="react phone" href="tel:<?php echo $this->dpinfo['dpcontact']['phone'] ?>" data-com="phonecall"><p class="font"><?php echo $this->dpinfo['dpcontact']['phone'] ?></p>
		        <p>欢迎来电咨询和订购！</p>
		        </a></li>                
		    </ul>
		</div>