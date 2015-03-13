<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=article/index">管理文章</a></li>
     <li><a href="index.php?r=article/add">添加文章</a></li>   
   
     <form method="post" class="form-horizontal J_ajaxForm" action=""> 
       <!--  <a style="display:block;float:left;padding-left:130px; line-height: 20px;height:20px;" href="javascript:history.go(-1);">条件</a>-->
     
      <select name="tiaojian" id="tiaojian" style="width:100px"> 
       <option value="title">文章标题</option> 
       <option value="dateline">发布时间</option> 
      </select> 
  
      <input name="search" value="" placeholder="文章标题、发布时间">
  	  <button class="btn" value="查询">查询</button>
    </form> 
       
  </ul>
    <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>文章标题</th>
			<th>发布时间</th>
            <th width="120">管理操作</th>
            
          </tr>
        </thead>
        <tbody>
        <?php foreach ($allarticle as $vo){?>
         <tr>

            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['title'];?></td>
			<td><?php echo date("Y-m-d H:i:s",$vo['dateline']);?></td>
            <td>
	            <a href="index.php?r=article/edit&bh=<?php echo $vo['bh'];?>">修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=article/del&bh=<?php echo $vo['bh'];?>">删除</a>
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