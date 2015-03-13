<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li><a href="index.php?r=user/index">所有vip</a></li>
     <li><a href="index.php?r=user/designer">设计师</a></li>
     <li class="active"><a href="index.php?r=user/dianzhu">店主</a></li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>E-mail</th>
            <th>下线数量</th>
            <th>开户行</th>
            <th>银行账号</th>
            <th>身份证号</th>
            <th>电话</th> 
            <th>登陆次数</th>
            <th>状态</th>
           
            <th width="120">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $vo){?>
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['name'];?></td>
             <td><?php echo $vo['tname'];?></td>
            <td><?php echo $vo['email'];?></td>
            <td><?php echo $vo['bh2'];?></td>
            <td><?php echo $vo['bank'];?></td>
            <td><?php echo $vo['acc'];?></td>
            <td><?php echo $vo['IdCard'];?></td>
            <td><?php echo $vo['phone'];?></td>
             <td><?php echo $vo['LoginTimes'];?></td>
             <td>
             <?php if ($vo['status']==1){?>
             	<font color="red">√</font>
             <?php }else{?>
				<font color="red">╳</font>
				<?php }?>
             </td>
            <td>
            	<?php if (!$vo['status']){?>
            	 <a href='index.php?r=user/designerCk&bh=<?php echo $vo['bh'];?>'>审核</a> | 
            	<?php }?>
	            <a href='index.php?r=user/dianzhuedit&bh=<?php echo $vo['bh'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=user/dianzhudel&bh=<?php echo $vo['bh'];?>">删除</a>
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