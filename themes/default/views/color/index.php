<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=color/index">颜色管理</a></li>
     <li><a href="index.php?r=color/add">添加颜色</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th>颜色名称</th>
            <th>颜色值</th>
            <th width="140">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <foreach name="users" item="vo">
        <?php foreach ($allcolor as $vo){?>
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td><?php echo $vo['v'];?></td>
            <td>
            	<a href='index.php?r=color/indexson&pbh=<?php echo $vo['bh'];?>'>增加子分类</a> | 
	            <a href='index.php?r=color/edit&bh=<?php echo $vo['bh'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=color/del&bh=<?php echo $vo['bh'];?>">删除</a>
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
</div>