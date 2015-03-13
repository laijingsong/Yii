    <div class="wrap-main">
        <div class="sub activity clearfix">
			<img src="<?php echo Yii::app()->params['ddcurl'].$row['bigpic']; ?>">
            <h2><?php echo $row['title']?></h2>
            <ul>
            	<li><label>活动时间：</label><span class="red"><?php echo date('Y.m.d日',$row['dateline']) ?></span></li>
                <!--<li><label>活动地点：</label><p>深圳市龙岗区大运软件小镇23栋二楼</p></li>-->
                <li class="clearfix"><label>活动详情：</label><?php echo htmlspecialchars_decode($row['content']) ?></li>
            </ul>
        </div>
        <?php $this->beginWidget('application.widget.CommentWidget',array('type'=>1,'id'=>$row[id],'limit'=>5));?>
		<?php $this->endWidget();?>
    </div>
