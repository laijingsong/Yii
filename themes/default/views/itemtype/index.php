<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=itemtype/index">管理商品分类</a></li>
     <li><a href="index.php?r=itemtype/add">添加商品分类</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>商品分类名称</th>
            <th>描述</th>
            <th width="150">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($alltype as $vo){?>
          <tr<?php echo $vo['level']==1?" bgcolor='#f5ebed'":""?>>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['level']>1?'&nbsp;&nbsp;&nbsp;&nbsp;'.$vo['name']:$vo['name']?></td>
            <td><?php echo $vo['des'];?></td>
            <td>
            	<?php if($vo['level']<2){?>
            		<a href='index.php?r=itemtype/add&bh=<?php echo $vo['bh'];?>'>添加子分类</a> | 
            	<?php }?>
	            <a href='index.php?r=itemtype/edit&bh=<?php echo $vo['bh'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=itemtype/del&bh=<?php echo $vo['bh'];?>">删除</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
   </div>
</div>