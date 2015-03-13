    <div class="wrap-main">
    	<div class="intro clearfix">
        	<div class="big-logo"><img src="<?php echo Yii::app()->params['ddcurl'].$row['store_logo'] ?>"></div>
            <div class="infro">
            	<p class="name"><?php echo $row['store_name'] ?></p>
                <div class="simple-info">
                	 <?php echo $row['store_brief']?mb_substr($row['store_brief'],0,40,'utf-8')."...":'暂无简介' ?>
                </div>
            </div>
        </div>
        <div class="list-main space clearfix">
        	<ul class="float-left">
                <li>
                	<div class="other-intro">
                        <span><b><?php echo $count ?></b>作品</span>
                        <span><b><?php echo $fenshi ?></b>粉丝</span>
                        <span><b><?php echo $renqi ?></b>人气</span>
                    </div>
                </li>
                <?php if($goods){ foreach ($goods as $k=>$v){ if($k % 2 != 0){?>
                <li><a class="product-item" href="<?php echo 'index.php?r=shop/goods&dpid='.$this->dpid.'&gid='.$v['id']; ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['productpic']; ?>" alt="<?php echo $v['title'] ?>"></span>
                    <span class="title"><?php echo $v['title'] ?></span>
                </a></li>
               <?php }} ?>
            </ul>
            <ul class="float-right">
            <?php foreach ($goods as $k=>$v){ if($k % 2 == 0){?>
                <li><a class="product-item" href="<?php echo 'index.php?r=shop/goods&dpid='.$this->dpid.'&gid='.$v['id']; ?>">
                    <span class="img"><img originalsrc="<?php echo Yii::app()->params['ddcurl'].$v['productpic']; ?>" alt="<?php echo $v['title'] ?>"></span>
                    <span class="title"><?php echo $v['title'] ?></span>
                </a></li>
               <?php }}} ?>
            </ul>
        </div>
    </div>
