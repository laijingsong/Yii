<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">

  <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=authorize/index">一级菜单</a></li>
     <li><a href="index.php?r=authorize/add">添加菜单</a></li>
  </ul>
 
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th>菜单名称</th>
            <th>显示状态</th>
            <th width="150">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $vo){?>
          <tr>
            <td><?php echo $vo['id'];?></td>
            <td><?php echo $vo['name'];?></td>
             <td>
          <?php if ($vo['status']==1){?>
         
          <font color="red">√</font>
          <?php }else{?>
          
          <font color="red">╳</font>
         <?php }?>
          </td>
            <td>
            	 <a href='index.php?r=authorize/sonindex&id=<?php echo $vo['id'];?>'>添加子菜单</a> | 
	            <a href='index.php?r=authorize/edit&id=<?php echo $vo['id'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=authorize/del&id=<?php echo $vo['id'];?>">删除</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="pagination"><?php //echo $page;?></div>
   </div>
</div>