<body class="J_scroll_fixed">
<div class="wrap jj">
  <span style="color:red;">库存管理</span>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="" enctype="multipart/form-data">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
        
         <script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/ueditor/ueditor.config.js"></script>
	     <script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/ueditor/ueditor.all.min.js"></script>
         <script type="text/javascript">
			    var editorcontent = new baidu.editor.ui.Editor();
			    editorcontent.render('content');
		 </script>
          <tbody>
            <tr>
              <td width="100">商品名称:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $item['name'];?>">
              	<input type="hidden" name="ItemBh" value="<?php echo $item['bh']?>">
              </td>
            </tr>
             <tr>
              <td>库存数:</td>
              <td><input type="text" class="input" name="qty" value="<?php echo $kucun['qty'];?>"></td>
            </tr>
            <tr>
              <td>成本价格:</td>
              <td><input type="text" class="input" name="price" value="<?php echo $kucun['price'];?>"></td>
            </tr> 
             <tr>
              <td>零售价格:</td>
              <td><input type="text" class="input" name="price2" value="<?php echo $kucun['price2'];?>"></td>
            </tr>
            <tr>
              <td>普通会员价格:</td>
              <td><input type="text" class="input" name="price3" value="<?php echo $kucun['price3'];?>"></td>
            </tr>
            <tr>
              <td>高级会员价格:</td>
              <td><input type="text" class="input" name="price4" value="<?php echo $kucun['price4'];?>"></td>
            </tr>
            <tr>
              <td>折扣:</td>
              <td><input type="text" class="input" name="dc" value="1">
              <input type="hidden" name="bh" value="<?php echo $bh?>"> 
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
            <a class="btn" href="index.php?r=item/index">返回</a>
      </div>
    </form>
  </div>
</div>