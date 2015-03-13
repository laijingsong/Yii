<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">

 	<ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=authorize/sonindex&id=<?php echo $id?>"><?php echo $presult->name?></a></li>
     <li><a href="index.php?r=authorize/sonadd&id=<?php echo $id?>">添加菜单</a></li>
  		<a style="display:block;float:right;padding-right:130px; line-height: 20px;height:20px;" href="javascript:history.go(-1);">返回</a>
  </ul>
   
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th>菜单名称</th>
            <th width="150">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $vo){?>
          <tr>
            <td><?php echo $vo['id'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td>
            	 <a href='index.php?r=authorize/sonindex&id=<?php echo $vo['id'];?>'>添加子菜单</a> | 
	            <a href='index.php?r=authorize/sonedit&id=<?php echo $vo['id'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=authorize/sondel&id=<?php echo $vo['id'];?>">删除</a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="pagination"><?php //echo $page;?></div>
   </div>
</div>