	<?php if($album){ ?>
	<div id="slider-wrap clearfix">
		<ul id="slider">
			<?php foreach ($album as $k=>$v){ ?>
        	<li><img src="<?php echo Yii::app()->params['ddcurl'].$v['path']; ?>" /></li>
            <?php } ?>
		</ul>
		<div id="indicator">
			<?php foreach ($album as $k=>$v){ ?>
			<a href="javascript:void(0);" class="<?php if ($k == 0) echo 'active' ?>"></a>
            <?php } ?>
		</div>
	</div>
	<?php } ?>
    <div class="wrap-main">
    	<?php if($top){ ?>
        <div class="ad">
            <a href="<?php echo 'index.php?r=shop/actives&dpid='.$this->dpid.'&aid='.$top['id']; ?>"><img title="<?php echo $top['title']; ?>" alt="<?php echo $top['title']; ?>" src="<?php echo Yii::app()->params['ddcurl'].$top['bigpic']; ?>" ></a>
        </div>
        <?php } ?>
        <div class="list-main">
        	<ul class="float-left">
                <li>
                	<div class="time">
                        <span class="date"><em class="day"><?php echo date('d') ?></em><em class="month"><?php echo date('m') ?></em></span>
                        <p>欢迎光临！<br>
                        共有商品<span class="red"><?php echo $count; ?></span>件</p>
                    </div>
                </li>
                <?php if($goods){ foreach ($goods as $k=>$v){ if($k % 2 != 0){?>
                <li><a class="product-item" href="<?php echo 'index.php?r=shop/goods&dpid='.$this->dpid.'&gid='.$v['id']; ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['productpic']; ?>" title="<?php echo $v['title'] ?>" alt="<?php echo $v['title'] ?>"></span>
                    <span class="title"><?php echo $v['title'] ?></span>
                    <span class="designer">设计师: <?php echo $v['store_name'] ?></span>
                </a></li>
                <?php }} ?>
            </ul>
            <ul class="float-right">
         	   <?php foreach ($goods as $k=>$v){ if($k % 2 == 0){?>
                <li><a class="product-item" href="<?php echo 'index.php?r=shop/goods&dpid='.$this->dpid.'&gid='.$v['id']; ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['productpic']; ?>" title="<?php echo $v['title'] ?>" alt="<?php echo $v['title'] ?>"></span>
                    <span class="title"><?php echo $v['title'] ?></span>
                    <span class="designer">设计师: <?php echo $v['store_name'] ?></span>
                </a></li>
                <?php }}} ?>
            </ul>
        </div>
    </div>