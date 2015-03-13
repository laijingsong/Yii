<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=chima/indexson&pbh=<?php echo $pbh;?>">尺码子类管理</a></li>
     <li><a href="index.php?r=chima/addson&pbh=<?php echo $pbh;?>">添加子类尺码</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>尺码名称</th>
            <th>尺码值</th>
            <th width="130">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <foreach name="users" item="vo">
        <?php foreach ($result as $vo){?>
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td><?php echo $vo['v'];?></td>
            <td> 
	            <a href='index.php?r=chima/editson&bh=<?php echo $vo['bh'];?>&chimaid=<?php echo $pbh;?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=chima/delson&bh=<?php echo $vo['bh'];?>&chimaid=<?php echo $pbh;?>">删除</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="pagination">
      	 <span>总数：<?php echo $num;?></span>
      		<?php
      $this->widget('CLinkPager',array(
		'header'=>'',
		'firstPageLabel' => '首页',
		'lastPageLabel' => '末页',
		'prevPageLabel' => '上一页',
		'nextPageLabel' => '下一页',
		'pages' => $pages,
		'maxButtonCount'=>15,
		'cssFile'=>'/assets/quanzi_pager.css',
		)
	);
?>
      </div>
      
   </div>
   <div style="clear:both;"></div>
   <div class="form-actions">
		<a href="index.php?r=chima/index"><button class="btn btn-primary btn_submit J_ajax_submit_btn" type="button">返回尺码菜单</button></a>
	</div>
</div>