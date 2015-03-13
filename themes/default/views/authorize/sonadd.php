<body class="J_scroll_fixed">
<div class="wrap jj">

 	<ul class="nav nav-tabs">
     <li><a href="index.php?r=authorize/sonindex&id=<?php echo $id?>"><?php echo $presult->name?></a></li>
     <li class="active"><a href="index.php?r=authorize/sonadd&id=<?php echo $id?>">添加菜单</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="130">菜单名称:</td>
              <td><input type="text" class="input" name="name" value=""></td>
            </tr>
            <tr>
              <td>应用名:</td>
              <td><input type="text" class="input" name="app" value=""></td>
            </tr>
            <tr>
              <td>控制器:</td>
              <td><input type="text" class="input" name="model" value=""></td>
            </tr>
           <tr>
              <td>动作:</td>
              <td><input type="text" class="input" name="action" value=""></td>
            </tr>
            
            <tr>
              <td>额外参数:</td>
              <td><input type="text" class="input" name="data" value=""></td>
            </tr>
            
             <tr>
              <td>额外参数:</td>
              <td><textarea cols="57" rows="5" name="remark"></textarea></td>
            </tr>
            
           <tr>
	          <td>是否启用</td>
	          <td>
	          	<label class="radio inline" for="active_true">
	            		<input type="radio" name="status" value="1" checked id="active_true"/>开启
	            </label>
	            <label class="radio inline" for="active_false">
	            		<input type="radio" name="status" value="0" id="active_false">禁止
	            </label>
	            <input type="hidden" name="id" value="<?php echo $id;?> ">
	          </td>
       	 </tr>
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="javascript:history.go(-1);">返回</a>
      </div>
    </form>
  </div>
</div>