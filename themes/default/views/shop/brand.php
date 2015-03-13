    <div class="wrap-main">
    	<div class="sub detail-box">
        	<ul>
            	<li><h1>彩衫网品牌形象店</h1></li>
                <li><label>所在地：</label><?php echo $this->province[$this->dpinfo['dpcontact']['provinceid']];echo ' '.$this->city[$this->dpinfo['dpcontact']['cityid']] ?></li>
                <li><label>主　营：</label><?php echo $this->dpinfo['main'] ?></li>
                <li><label>风　格：</label><?php echo $this->dpinfo['style'] ?></li>
                <li><label>开店时间：</label><?php echo date('Y-m-d',$this->dpinfo['addtime'])?></li>
                <li><label>店铺认证：</label><i class="yan"></i></li>
            </ul>   
        </div>
        <div class="sub pic-box">
        	<h1>品牌实景</h1>
            <ul id="slider">
            <?php foreach ($album as $v){ ?>
                <li><img src="<?php echo Yii::app()->params['ddcurl'].$v['path'] ?>" alt="" /></li>
 			<?php } ?>
            </ul>
            <div id="indicator">
            <?php foreach ($album as $k=>$v){ ?>
                <a href="javascript:void(0);" class="<?php if ($k == 0) echo 'active' ?>"></a>
            <?php } ?>    
            </div>
        </div>
        <div class="sub btn clearfix">
        	<a class="service buy" href="javascript:;"><i></i>联系店家</a>
            <a class="shareo" href="javascript:;"><i></i>分享店铺</a>
        </div>
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