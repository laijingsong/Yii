<body>
<div class="wrap J_check_wrap">
  <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=rbac/index">角色管理</a></li>
     <li><a href="index.php?r=rbac/addrole">添加角色</a></li>
  </ul>
  <div class="table_list">
  <form name="myform" action="{:U('Rbac/listorders')}" method="post">
    <table width="100%" cellspacing="0" class="table table-hover">
      <thead>
        <tr>
          <th width="30">ID</th>
          <th align="left" >角色名称</th>
          <th align="left" >角色描述</th>
          <th width="40" align="left" >状态</th>
          <th width="200">管理操作</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($roleinfo as $vo){?>
        <tr>
          <td><?php echo $vo['id'];?></td>
          <td><?php echo $vo['name'];?></td>
          <td><?php echo $vo['remark'];?></td>
          <td>
          <?php if ($vo['status']==1){?>
         
          <font color="red">√</font>
          <?php }else{?>
          
          <font color="red">╳</font>
         <?php }?>
          </td>
          <td  class="text-c">
          
           <?php if ($vo['id']==1){?>
         
          <font color="#cccccc">权限设置</font>  | <font color="#cccccc">修改</font> | <font color="#cccccc">删除</font>
           <?php }else{?>
          <a href="index.php?r=rbac/authorize&id=<?php echo $vo['id'];?>">权限设置</a>  | <a href="index.php?r=rbac/editrole&roleid=<?php echo $vo['id'];?>">修改</a> | <a class="J_ajax_del" href="index.php?r=rbac/delrole&roleid=<?php echo $vo['id'];?>">删除</a>
         <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </form>
  </div>
</div>