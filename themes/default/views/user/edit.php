<body class="J_scroll_fixed">
<div class="wrap jj">
	<ul class="nav nav-tabs">
     	<li class="active"><a href="index.php?r=user/index">所有vip</a></li>
	    <li><a href="index.php?r=user/designer">设计师</a></li>
	    <li><a href="index.php?r=ad/dianzhu">店主</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" width="100%">
          <tbody>
            <tr>
              <td width="180">用户名:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $userinfo['name']?>" readonly="readonly"></td>
            </tr>
            <tr>
              <td width="180">昵称:</td>
              <td><input type="text" class="input" name="tname" value="<?php echo $userinfo['tname']?>"></td>
            </tr>
            <tr>
              <td width="180">身份证号:</td>
              <td><input type="text" class="input" name="IdCard" value="<?php echo $userinfo['IdCard']?>"></td>
            </tr>
            
             <tr>
              <td width="180">电话号码:</td>
              <td><input type="text" class="input" name="phone" value="<?php echo $userinfo['phone']?>"></td>
            </tr>
            
            <tr>
              <td>邮箱:</td>
              <td><input type="text" class="input" name="email" value="<?php echo $userinfo['email']?>"></td>
            </tr>
            
             <tr>
              <td>地址:</td>
              <td>
              <textarea name="addr" rows="" cols=""><?php echo $userinfo['addr']?></textarea>
              </td>
            </tr>
           
          </tbody>
        </table>
      </div>
       <div class="form-actions">
       		<input type="hidden" name="bh" value="<?php echo $bh?>"/>
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=user/index">返回</a>
      </div>
    </form>
  </div>
</div>