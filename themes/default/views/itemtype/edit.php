<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
  	 <li><a href="index.php?r=itemtype/index">管理商品类型</a></li>
     <li><a href="index.php?r=itemtype/add">添加商品类型</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="180">商品类型:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $itemtype['name'] ?>"></td>
            </tr>     
            <tr>
              <td>描述:</td>
              <td><input type="text" class="input" name="des" value="<?php echo $itemtype['des'] ?>"></td>
            </tr>
            
           
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=itemtype/index">返回</a>
      </div>
    </form>
  </div>
</div>