<body class="J_scroll_fixed">
<style>
.cateimg{
	float:left;
	position: relative;
}
.cateimg .smallpic{
	width:50px;
}
.cateimg .bigpic {
  	display: none;
    left: 51px;
    position: absolute;
    top: 0;
	width:320px;
}
select{
	margin-bottom: 1px;
}
#chima_tiaojian{
	display:none;
}
</style>
<script>
$(document).ready(function(){
	$('.smallpic').mouseover(function(){
		$(this).parent().find('.bigpic').css('display','block');
	}).mouseout(function(){
		$(this).parent().find('.bigpic').css('display','none'); 
	});
	
	
});
</script>
<div class="wrap J_check_wrap">
   <ul class="nav nav-tabs">
     <li class="active"><a href="index.php?r=item/index">管理商品</a></li>
     <li><a href="index.php?r=item/add">添加商品</a></li>
     <li>
     <form method="post" class="form-horizontal J_ajaxForm" action="">
     <!--  <a style="display:block;float:left;padding-left:130px; line-height: 20px;height:20px;" href="javascript:history.go(-1);">条件</a>-->
  	
  	<select name="tiaojian" id="tiaojian" style="width:100px;">
  		<option value="name">商品名称</option>
  		<option value="ItemTypeBh">商品类型</option>
  		<option value="kh">款号</option>
  		<option value="ColorBh">颜色</option>
  		<option value="ChiMaBh">尺码</option>
  	</select>
  	
  	
  	<!--  <select id="color_tiaojian" style="width:150px;">
  		<?php foreach ($allcolor as $vo){?>
  		<option><?php echo $vo['name']?></option>
  		<?php } ?>
  	</select>
  	<select id="chima_tiaojian" style="width:150px;">
  		<?php foreach ($allchima as $vo){?>
  		<option value="<?php echo $vo['bh']?>"><?php echo $vo['name']?></option>
  		<?php } ?>
  	</select>-->
  	 <input name="search" value="" placeholder="颜色、商品款号">
  	<button class="btn" value="查询">查询</button>
  	</form>
  	</li>
  </ul>
   <div class="table_list">
   <table width="100%" cellspacing="0" class="table table-hover">
        <thead>
          <tr>
            <th width="50">编号</th>
            <th>商品名称</th>
            <th>商品类型</th>
            <th>款号</th>
            <th>图片</th>
            <th>规格</th>
            <th>产地</th>
            <th>颜色</th>
            <th>尺码</th>
            <th>单位</th>
            <th>品牌</th>
            <th>备注</th>
            <th width="120">管理操作</th>
          </tr>
        </thead>
        <tbody>
        <foreach name="users" item="vo">
        <?php foreach ($posts as $vo){?>
          <tr>
            <td><?php echo $vo['bh'];?></td>
            <td><?php echo $vo['name'];?></td>
            <td><?php echo $vo['itemtype_name'];?></td>
            <td><?php echo $vo['kh'];?></td>
            <td>
            <?php if ($vo['pic']){?>
            <div class="cateimg">
            <img class="smallpic" src="<?php echo $vo['pic'];?>">
            <img class="bigpic" src="<?php echo $vo['pic'];?>">
            </div>
             <?php }?></td>
            <td><?php echo $vo['gg'];?></td>
            <td><?php echo $vo['cd'];?></td>
            <td><?php echo $vo['color_name'];?></td>
            <td><?php echo $vo['chima_name'];?></td>
            <td><?php echo $vo['unit'];?></td>
            <td><?php echo $vo['pp'];?></td>
            <td><?php echo $vo['des'];?></td>
            <td>
            	<a href='index.php?r=item/kucun&bh=<?php echo $vo['bh'];?>'>库存</a> |
	            <a href='index.php?r=item/edit&bh=<?php echo $vo['bh'];?>'>修改</a> | 
	            <a class="J_ajax_del" href="index.php?r=item/del&bh=<?php echo $vo['bh'];?>">删除</a>
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