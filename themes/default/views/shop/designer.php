    <div class="wrap-main">
        <div class="list-main designer-list">
        	<ul class="float-left">
                <li>
                	<div class="time">
                        <span class="date"><em class="day"><?php echo date('d') ?></em><em class="month"><?php echo date('m') ?></em></span>
                        <p>店铺相关<br>
                        设计师共<span class="red"><?php echo $count ?></span>位</p>
                    </div>
                </li>
                <?php if($designer){ foreach ($designer as $k=>$v){ if($k % 2 != 0){?>
                <li><a class="product-item" href="index.php?r=shop/designer&dpid=<?php echo $this->dpid ?>&sid=<?php echo $v['store_id'] ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['topGoods']['productpic']; ?>" alt="<?php echo $v['store_name'] ?>"></span>
					<div class="de-logo"><span class="pic"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['store_logo'] ?>"></span><em><?php echo $v['store_name'] ?></em></div>
                </a></li>
                 <?php }} ?>
            </ul>
            <ul class="float-right">
                <?php foreach ($designer as $k=>$v){ if($k % 2 == 0){?>
                <li><a class="product-item" href="index.php?r=shop/designer&dpid=<?php echo $this->dpid ?>&sid=<?php echo $v['store_id'] ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['topGoods']['productpic']; ?>" alt="<?php echo $v['store_name'] ?>"></span>
                    <div class="de-logo"><span class="pic"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['store_logo'] ?>"></span><em><?php echo $v['store_name'] ?></em></div>
                </a></li>
                 <?php }}} ?>
            </ul>
        </div>
    </div>
