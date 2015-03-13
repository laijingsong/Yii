<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	  <li><a href="index.php?r=itemtype/sxlist&bh=<?php echo $bh;?>">管理商品属性</a></li>
     <li class="active"><a href="index.php?r=itemtype/sxlistadd&bh=<?php echo  $bh;?>">添加商品属性</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="180">商品属性名称:</td>
              <td><input type="text" class="input" name="name" value=""></td>
            </tr>   
            <tr>
              <td width="180">商品类型:</td>
              <td>
              <select class="select_2" name="term">
              	<?php foreach ($alltype as $key=> $vo){?>
              	<option value="<?php echo $vo['name']?>"><?php echo $vo['name']?></option>
              	
              	<?php } ?>
              </select>
              </td>
            </tr>  
             <tr>
              <td>内容:</td>
              <td><input type="text" class="input" name="content" value=""></td>
            </tr>
            <tr>
              <td>描述:</td>
              <input type="hidden" name="bh" value="<?php echo $bh;?>">
              <td><input type="text" class="input" name="des" value=""></td>
            </tr>
            
           
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="index.php?r=itemtype/sxlist&bh=<?php echo $bh;?>">返回</a>
      </div>
    </form>
  </div>
</div>