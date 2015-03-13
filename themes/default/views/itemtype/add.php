<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	  <li><a href="index.php?r=itemtype/index">管理商品分类</a></li>
     <li class="active"><a href="index.php?r=itemtype/add">添加商品分类</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
			<table cellpadding="2" cellspacing="2" width="100%">
			<tbody>
			<tr>
				<td width="140">
					上级:
				</td>
				<td>
					<select name="pbh" class="normal_select">
						<option value="0">作为一级分类</option>
						<?php 
						if($top)
						{
							foreach ($top as $key=>$val){
						?>
						<option value="<?php echo $val['bh']?>" <?php echo $val['bh']==$topBh?"selected":''?>><?php echo $val['name']?></option>
						<?php }}?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					名称:
				</td>
				<td>
					<input type="text" class="input" name="name" value=""><span class="must_red">*</span>
				</td>
			</tr>
			<tr>
				<td>
					描述:
				</td>
				<td>
					<textarea name="des" rows="5" cols="57"></textarea>
				</td>
			</tr>
			</tbody>
			</table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="index.php?r=itemtype/index">返回</a>
      </div>
    </form>
  </div>
</div>