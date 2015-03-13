<body class="J_scroll_fixed">
<div class="wrap jj">
<!--  <ul class="nav nav-tabs">
  	  <li><a href="index.php?r=itemtype/sxlist">管理商品属性</a></li>
     <li class="active"><a href="index.php?r=itemtype/sxlistadd">添加商品属性</a></li>
  </ul>-->
  <span style="color:red;">商品修改</span>
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
              <td><input type="text" class="input" name="name" value="<?php echo $item->name;?>"></td>
            </tr>
             <tr>
              <td width="100">价格:</td>
              <td><input type="text" class="input" name="price" value="<?php echo $item->price;?>"></td>
            </tr>
             <tr>
              <td>商品类型:</td>
              <td>
              <select class="normal_select" name="ItemTypeBh">
              <?php foreach ($itemtype as $vo){?>
              <option value="<?php echo $vo['bh']?>" <?php if ($vo['bh']==$item->ItemTypeBh){?> selected="selected" <?php }?>><?php echo $vo['name'];?></option>
              <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>供应商编号:</td>
              <td>
              <select class="normal_select" name="SupBh">
              <option value="0">111</option>
              </select></td>
            </tr>
            <tr>
              <td>颜色编号:</td>
              <td>
              <select class="normal_select" name="ColorBh">
              <?php foreach ($yanse as $vo){?>
              <option value="<?php echo $vo['bh']?>" <?php if ($vo['bh']==$item->ColorBh){?> selected="selected" <?php }?>><?php echo $vo['name']?></option>
              <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>尺码编号:</td>
              <td>
              <select class="normal_select" name="ChiMaBh">
              <?php foreach ($chima as $vo){?>
              <option value="<?php echo $vo['bh']?>" <?php if ($vo['bh']==$item->ChiMaBh){?> selected="selected" <?php }?> ><?php echo $vo['name'];?></option>
              <?php } ?>
              </select></td>
            </tr>
            
            <tr>
              <td>款号:</td>
              <td><input type="text" class="input" name="kh" value="<?php echo $item->kh;?>"></td>
            </tr> 
             <tr>
              <td>规格:</td>
              <td><input type="text" class="input" name="gg" value="<?php echo $item->gg;?>"></td>
            </tr>
            <tr>
              <td>产地:</td>
              <td><input type="text" class="input" name="cd" value="<?php echo $item->cd;?>"></td>
            </tr>
            <tr>
              <td>单位:</td>
              <td><input type="text" class="input" name="unit" value="<?php echo $item->unit;?>"></td>
            </tr>
            <tr>
              <td>品牌:</td>
              <td><input type="text" class="input" name="pp" value="<?php echo $item->pp;?>"></td>
            </tr>
            <tr>
              <td>图片:</td>
              <td>
              <input type="hidden" name="oldpic" value="<?php echo $item->pic;?>"> 
              <input type="file" class="input" name="myfile" value="<?php echo $item->pic;?>"><img src="<?php echo Yii::app()->baseUrl.$item->pic;?>"></td>
            </tr>
            <tr>
              <td>备注:</td>
              <td><textarea rows="" cols="" name="des"><?php echo $item->des;?></textarea></td>
            </tr>
            
           
             <!--  <tr>
              <td>内容:</td>
              <td><script type="text/plain" id="content" name="options[template]"></script>
					<style type="text/css">
					.content_attr {
						border: 1px solid #CCC;
						padding: 5px 8px;
						background: #FFC;
						margin-top: 6px
					}
					</style></td>
            </tr>  -->  
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">修改</button>
            <a class="btn" href="index.php?r=item/index">返回</a>
      </div>
    </form>
  </div>
</div>