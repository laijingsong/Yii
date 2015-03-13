<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	 <li><a href="index.php?r=chima/index">尺码管理</a></li>
     <li class="active"><a href="index.php?r=chima/add">添加尺码</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="180">尺码名称:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $chima->name?>"></td>
            </tr>
            <tr>
              <td>尺码值:</td>
              <td><input type="text" class="input" name="v" value="<?php echo $chima->v?>" ></td>
            </tr>
            <tr>
              <td>描述:</td>
              <td><input type="text" class="input" name="des" value="<?php echo $chima->des;?>"></td>
            </tr>
            
           
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=chima/index">返回</a>
      </div>
    </form>
  </div>
</div>