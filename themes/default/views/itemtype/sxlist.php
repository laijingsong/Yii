<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=itemtype/sxlist&bh=<?php echo $bh;?>">管理商品属性</a></li>
     <li><a href="index.php?r=itemtype/sxlistadd&bh=<?php echo $bh;?>">添加商品属性</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>商品属性名称</th>
            <th>商品类型</th>
            <th>备注</th>
            <th width="120">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php if (!empty($allcate)){ foreach ($allcate as $vo){?>
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td><?php echo $vo['itemtype_name'];?></td>
            <td><?php echo $vo['des'];?></td>
            <td>
            	<input type="hidden" name="bh" value="<?php echo $bh;?>">
	            <a href='index.php?r=itemtype/sxlistedit&bh=<?php echo $bh;?>&sxid=<?php echo $vo['id'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=itemtype/sxlistdel&sxid=<?php echo $vo['id'];?>">删除</a>
            </td>
          </tr>
        <?php } } ?>
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
   <div style="clear: both"></div>
   <div class="form-actions">
		<a href="index.php?r=itemtype/index"><button class="btn btn-primary btn_submit J_ajax_submit_btn" type="button">返回商品类型菜单</button></a>
	</div>
</div>