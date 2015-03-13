<body class="J_scroll_fixed">
<div class="wrap jj">
  <div>现在位置：<span style="color:red;"><?php echo $color->name;?></span></div>		
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="160">颜色名称:</td>
              <td><input type="text" class="input" name="name" value=""></td>
            </tr>
            <tr>
              <td>颜色值:</td>
              <td><input type="text" class="input" name="v" value="" ></td>
            </tr>
            <tr>
              <td>描述:</td>
              <td><input type="text" class="input" name="des" value=""></td>
              <input type="hidden" name="pbh" value="<?php echo $color->bh;?>" />
              <input type="hidden" name="colorid" value="<?php echo $colorid?>" />
            </tr>
            
           
            
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="<?php echo Yii::app()->request->urlReferrer ?>">返回</a>
      </div>
    </form>
  </div>
</div>