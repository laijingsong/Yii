<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	  <li><a href="index.php?r=authorize/index">一级菜单</a></li>
     <li class="active"><a href="index.php?r=authorize/add">添加菜单</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="130">菜单名称:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $result->name;?>" ></td>
            </tr>
            <tr>
              <td>应用名:</td>
              <td><input type="text" class="input" name="app" value="<?php echo $result->app;?>"></td>
            </tr>
            <tr>
              <td>控制器:</td>
              <td><input type="text" class="input" name="model" value="<?php echo $result->model;?>"></td>
            </tr>
           <tr>
              <td>动作:</td>
              <td><input type="text" class="input" name="action" value="<?php echo $result->action;?>"></td>
            </tr>
            
            <tr>
              <td>额外参数:</td>
              <td><input type="text" class="input" name="data" value="<?php echo $result->data;?>"></td>
            </tr>
            
             <tr>
              <td>额外参数:</td>
              <td><textarea cols="57" rows="5" name="remark"><?php echo $result->remark;?></textarea></td>
            </tr>
            
           <tr>
	          <td>是否启用</td>
	          <td>
	          	<label class="radio inline" for="active_true">
	            		<input type="radio" name="status" value="1" 
	            		<?php if ($result->status==1){?>
	            		 checked <?php }?> id="active_true"/>开启
	            </label>
	            <label class="radio inline" for="active_false">
	            		<input type="radio" name="status" value="0" 
	            		<?php if ($result->status==0){?>
	            		 checked <?php }?>
	            		 id="active_false">禁止
	            </label>
	            <input name="id" type="hidden" value="<?php echo $result->id?>">
	          </td>
       	 </tr>
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=authorize/index">返回</a>
      </div>
    </form>
  </div>
</div>