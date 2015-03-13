<div class="wrap-main">
		<?php if($list){ ?>
    	<div class="sub act-list">
        	<ul>
        	<?php foreach ($list as $k=>$v){ ?>
            	<li><a href="index.php?r=shop/actives&dpid=<?php echo $this->dpid;?>&aid=<?php echo $v['id'];?>">
                    <img src="<?php echo Yii::app()->params['ddcurl'].$v['bigpic'] ?>">
                    <h2><?php echo $v['title'] ?></h2>
                    <h3 class="date"><?php echo date('Y.m.d日',$v['dateline']) ?></h3>
                    <p><?php echo mb_substr(strip_tags(htmlspecialchars_decode($v['content'])),0,50,'utf-8') ?></p>
                </a></li>
            <?php } ?>
            </ul>
       	</div>
       	<?php }else{echo '暂无活动';} ?>
    </div>