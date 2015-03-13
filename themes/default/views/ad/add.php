<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	 <li><a href="index.php?r=ad/index">管理员</a></li>
     <li class="active"><a href="index.php?r=ad/add">添加管理员</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="180">用户名:</td>
              <td><input type="text" class="input" name="user_login" value=""></td>
            </tr>
            <tr>
              <td>密码:</td>
              <td><input type="password" class="input" name="user_pass" value="" ></td>
            </tr>
            <tr>
              <td>邮箱:</td>
              <td><input type="text" class="input" name="user_email" value=""></td>
            </tr>
            <tr>
              <td>角色:</td>
              <td>
                <?php foreach ($roleinfo as $vo){?>
                <label class="checkbox inline">
				  <input value="<?php echo $vo['id']?>" type="checkbox" name="role_id[]"/><?php echo $vo['name']?>
				</label>
 				<?php }?>
				</td>
            </tr>
           
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="index.php?r=ad/index">返回</a>
      </div>
    </form>
  </div>
</div>