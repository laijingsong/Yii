<body class="J_scroll_fixed">
<div class="wrap jj">
	<ul class="nav nav-tabs">
     	<li class="active"><a href="index.php?r=user/userinfo">修改信息</a></li>
	    <li><a href="index.php?r=user/password">修改密码</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" width="100%">
          <tbody>
            <tr>
              <td width="180">用户名:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $this->userinfo->user_login?>" readonly="readonly"></td>
            </tr>
            
            <tr>
              <td>邮箱:</td>
              <td><input type="text" class="input" name="email" value="<?php echo $this->userinfo->user_email?>"></td>
            </tr>
           
          </tbody>
        </table>
      </div>
       <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=user/index">返回</a>
      </div>
    </form>
  </div>
</div>