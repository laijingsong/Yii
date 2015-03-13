<body class="J_scroll_fixed">
<div class="wrap jj">
	<ul class="nav nav-tabs">
     <li><a href="index.php?r=ad/index">管理员</a></li>
     <li><a href="index.php?r=ad/add">添加管理员</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" width="100%">
          <tbody>
            <tr>
              <td width="180">用户名:</td>
              <td><input type="text" class="input" name="user_login" value="<?php echo $user['user_login']?>"></td>
            </tr>
            <tr>
              <td>密码:</td>
              <td><input type="password" class="input" name="user_pass" value="" placeholder="******"></td>
            </tr>
            <tr>
              <td>邮箱:</td>
              <td><input type="text" class="input" name="user_email" value="<?php echo $user['user_email']?>"></td>
            </tr>
            <tr>
              <td>角色:</td>
              <td>
 				
 				<?php foreach ($roleinfo as $vo){
 				//print_r($vo);
 					?>
                <label class="checkbox inline">
                <?php $role_id_checked=in_array($vo['id'],$roleids)?"checked":""; ?>
               
				  <input value="<?php echo $vo['id']?>" type="checkbox" name="role_id[]" <?php echo $role_id_checked;?> /><?php echo $vo['name']?>
				</label>
 				<?php }?>
				</td>
            </tr>
          </tbody>
        </table>
      </div>
       <div class="form-actions">
       		<input type="hidden" name="id" value="{$id}"/>
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=ad/index">返回</a>
      </div>
    </form>
  </div>
</div>