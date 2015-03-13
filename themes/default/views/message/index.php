<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>接收用户编号</th>
            <th>标题</th>
            <th>内容</th>
            <th>发送时间</th>
            <th>发送用户编号</th>
            <th>备注</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $vo){?>
		
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['ToUserBh'];?></td>
             <td><?php echo $vo['title'];?></td>
            <td><?php echo $vo['content'];?></td>
            <td><?php echo date("Y-m-d H:i:s",$vo['dateline']);?></td>
            <td><?php echo $vo['FromUserBh'];?></td>
            <td><?php echo $vo['des'];?></td>
            <td>
	            <a href='index.php?r=message/edit&id=<?php echo $vo['id'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=message/del&id=<?php echo $vo['id'];?>">删除</a>
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