<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=ad/index">管理员</a></li>
     <li><a href="index.php?r=ad/add">添加管理员</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">ID</th>
            <th>用户名</th>
            <th>最后登录IP</th>
            <th>最后登录时间</th>
            <th>E-mail</th>
            <th width="120">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($alladmin as $vo){?>
          <tr>
            <td><?php echo $vo['id'];?></td>
            <td><?php echo $vo['user_login'];?></td>
            <td><?php echo $vo['last_login_ip'];?></td>
            <td>
            <?php if ($vo['last_login_time']==0){?>
	            该用户还没登陆过
	            <?php }else{
	            	echo $vo['last_login_time'];
	            }?>
            </td>
            <td><?php echo $vo['user_email'];?></td>
            <td>
            
            <?php if ($vo['id']==1){?>
	            <font color="#cccccc">修改</font> | 
	            <font color="#cccccc">删除</font>
	            <?php }else{?>
	            <a href='index.php?r=ad/edit&id=<?php echo $vo['id'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=ad/del&id=<?php echo $vo['id'];?>">删除</a>
	          <?php }?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <div class="pagination"><?php //echo $page;?></div>
   </div>
</div>