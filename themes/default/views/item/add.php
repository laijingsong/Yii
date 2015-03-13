<style>
/*上传标签样式 begin*/
.uploader { position:relative; display:inline-block; overflow:hidden; cursor:default; padding:0; margin:10px 0px; -moz-box-shadow:0px 0px 5px #ddd; -webkit-box-shadow:0px 0px 5px #ddd; box-shadow:0px 0px 5px #ddd; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; }
.filename { float:left; display:inline-block; outline:0 none; height:32px; width:180px; margin:0; padding:8px 10px; overflow:hidden; cursor:default; border:1px solid; border-right:0; font:9pt/100% Arial, Helvetica, sans-serif; color:#777; text-shadow:1px 1px 0px #fff; text-overflow:ellipsis; white-space:nowrap; -moz-border-radius:5px 0px 0px 5px; -webkit-border-radius:5px 0px 0px 5px; border-radius:5px 0px 0px 5px; background:#f5f5f5; background:-moz-linear-gradient(top, #fafafa 0%, #eee 100%); background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #fafafa), color-stop(100%, #f5f5f5)); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fafafa', endColorstr='#f5f5f5', GradientType=0);
border-color:#ccc; -moz-box-shadow:0px 0px 1px #fff inset; -webkit-box-shadow:0px 0px 1px #fff inset; box-shadow:0px 0px 1px #fff inset; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; }
.button { float:left; height:32px; display:inline-block; outline:0 none; padding:8px 12px; margin:0; cursor:pointer; border:1px solid; font:bold 9pt/100% Arial, Helvetica, sans-serif; -moz-border-radius:0px 5px 5px 0px; -webkit-border-radius:0px 5px 5px 0px; border-radius:0px 5px 5px 0px; -moz-box-shadow:0px 0px 1px #fff inset; -webkit-box-shadow:0px 0px 1px #fff inset; box-shadow:0px 0px 1px #fff inset; }
.uploader input[type=file] { position:absolute; top:0; right:0; bottom:0; border:0; padding:0; margin:0; height:30px; cursor:pointer; filter:alpha(opacity=0); -moz-opacity:0; -khtml-opacity: 0; opacity:0; }
 input[type=button]::-moz-focus-inner {
padding:0;
border:0 none;
-moz-box-sizing:content-box;
}   
input[type=button]::-webkit-focus-inner {
padding:0;
border:0 none;
-webkit-box-sizing:content-box;
}
input[type=text]::-moz-focus-inner {
padding:0;
border:0 none;
-moz-box-sizing:content-box;
}
input[type=text]::-webkit-focus-inner {
padding:0;
border:0 none;
-webkit-box-sizing:content-box;
}
/* White Color Scheme ------------------------ */

.white .button { color:#555; text-shadow:1px 1px 0px #fff; background:#ddd; background:-moz-linear-gradient(top, #eeeeee 0%, #dddddd 100%); background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #eeeeee), color-stop(100%, #dddddd)); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#eeeeee', endColorstr='#dddddd', GradientType=0);
border-color:#ccc; }
.white:hover .button { background:#eee; background:-moz-linear-gradient(top, #dddddd 0%, #eeeeee 100%); background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #dddddd), color-stop(100%, #eeeeee)); filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dddddd', endColorstr='#eeeeee', GradientType=0);
}

/*上传标签样式 end*/

</style>
<script type="text/javascript">
$(function(){
	/* tabal切换 */
	$("#ptab li a").click(function(){
		var id = $(this).attr('data-id');
		$('#ptab li').removeClass('active');
		$('.ttab').hide();
		$("#"+id).show();
		$(this).parent().addClass('active');
	});

	/* 商品类型切换 */
	$("#goods_type").change(function(){
		var gtype_id = $(this).children('option:selected').val();
		$.ajax({
			
			});
	});
})
</script>
<body class="J_scroll_fixed">
<div class="wrap jj">

  <span style="color:red;">商品添加</span>
  <ul class="nav nav-tabs" id="ptab">
  	  <li class="active"><a href="javascript:;" data-id="basic">基本信息</a></li>
  	  <li><a href="javascript:;" data-id="stocks" id="stocks_tab">颜色尺码 </a></li>
  	  <li><a href="javascript:;" data-id="attribute">商品属性</a></li>
  	  <li><a href="javascript:;" data-id="gallery">商品相片 </a></li>
  </ul>
  
   <script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/ueditor/ueditor.config.js"></script>
	     <script type="text/javascript"  src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/ueditor/ueditor.all.min.js"></script>
         <script type="text/javascript">
			    var editorcontent = new baidu.editor.ui.Editor();
			    editorcontent.render('content');
 </script>
  <div class="common-form" >
    <form method="post" class="form-horizontal J_ajaxForm" action="" enctype="multipart/form-data">
      
      <div id="basic" class="ttab">
        <table cellpadding="2" cellspacing="2" class="table_form" width="100%">
          <tbody>
            <tr>
              <td width="100">商品名称:</td>
              <td><input type="text" class="input" name="name" value=""></td>
            </tr>
             <tr>
              <td width="100">价格:</td>
              <td><input type="text" class="input" name="price" value=""></td>
            </tr>
             <tr>
              <td>商品类型:</td>
              <td>
              <select class="normal_select" name="ItemTypeBh">
              <?php foreach ($itemtype as $vo){?>
              <option value="<?php echo $vo['bh']?>"><?php echo $vo['name'];?></option>
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
              <option value="<?php echo $vo['bh']?>"><?php echo $vo['name']?></option>
              <?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>尺码编号:</td>
              <td>
              <select class="normal_select" name="ChiMaBh">
              <?php foreach ($chima as $vo){?>
              <option value="<?php echo $vo['bh']?>"><?php echo $vo['name'];?></option>
              <?php } ?>
              </select></td>
            </tr>
            
            <tr>
              <td>款号:</td>
              <td><input type="text" class="input" name="kh" value=""></td>
            </tr> 
             <tr>
              <td>规格:</td>
              <td><input type="text" class="input" name="gg" value=""></td>
            </tr>
            <tr>
              <td>产地:</td>
              <td><input type="text" class="input" name="cd" value=""></td>
            </tr>
            <tr>
              <td>单位:</td>
              <td><input type="text" class="input" name="unit" value=""></td>
            </tr>
            <tr>
              <td>品牌:</td>
              <td><input type="text" class="input" name="pp" value=""></td>
            </tr>
            <tr>
              <td>商品图片:</td>
              <td>
				<!--  <div class="uploader white">
					<input type="text" class="filename" readonly/>
				    <input type="button" name="file" class="button" value="上传图片"/>
				    <input type="file" name="path" size="30"/>
				</div>-->
              
              <input type="file" class="input" name="myfile" value="">
              </td>
            </tr>
            <tr>
              <td>备注:</td>
              <td><textarea rows="" cols="" name="des"></textarea></td>
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
      
      
      <div id="stocks" class="ttab" style="display: none">
		<table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder">
			<tr><td height="10"></td></tr>
			<tr><td bgcolor="f9f9f9">颜色选择</td></tr>
			<tr>
				<td bgcolor="f9f9f9">
				<?php if($yanse){ foreach($yanse as $c){?>
					<span class="colorbox" style="width:85px;height:25px;display:inline-block">
						<input type="checkbox" name="color[]" data-cname="<?php echo $c['name'];?>" data-cvalues="<?php echo $c['v'];?>" data- value="<?php echo $c['id'];?>"><em style="padding-left:3px;background: <?php echo $c['v'];?>;height:13px;width:13px;display:inline-block;">&nbsp;</em><span><?php echo $c['name'];?></span></span>
					
				<?php }}?>
				</td>
			</tr>
			<tr>
				<td bgcolor="f9f9f9">
					<table>
						<tbody>
						<tr><td height="10"></td></tr>
						<tr><td>尺码选择</td></tr>
						<tr>
								<td>
								<?php if($chima){ foreach($chima as $s){?>
									<span style="width:50px;height:25px;display:inline-block">
										<input name="size_value[]" type="checkbox" data-value="<?php echo $s['v'];?>" value="<?php echo $s['id'];?>"><i style="padding-left:3px;"><?php echo $s['v'];?></i></span>
								<?php }}?>
								</td>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
				
			</table>
  		</div>
  		
  	   <div id="stocks" class="ttab" style="display: none">
  	   		<table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder">
			<tr><td height="10"></td></tr>
			<tr><td bgcolor="f9f9f9">颜色选择</td></tr>
			<tr>
				<td bgcolor="f9f9f9">
				<?php if($yanse){ foreach($yanse as $c){?>
					<span class="colorbox" style="width:85px;height:25px;display:inline-block">
						<input type="checkbox" name="color[]" data-cname="<?php echo $c['name'];?>" data-cvalues="<?php echo $c['v'];?>" data- value="<?php echo $c['id'];?>"><em style="padding-left:3px;background: <?php echo $c['v'];?>;height:13px;width:13px;display:inline-block;">&nbsp;</em><span><?php echo $c['name'];?></span></span>
					
				<?php }}?>
				</td>
			</tr>
			</table>
  	   </div>
  	   
  	   
  	   <!-- attribute begin -->
  	<div id="attribute" class="ttab" style="display: none">
		<table width=100% align=center cellpadding=3 cellspacing=1 class="tableborder">
			<tr>
				<td height="25" bgcolor="#FFFFFF">商品类型: 
                  <select name="goods_type" id="goods_type">
                  	<option>请选择商品类型</option>
                  	<?php foreach ($itemtype as $v){?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                    <?php }?>
                   </select> 
                   <input type="hidden" name="old_goods_type" />
				</td>
			</tr>
			
		</table>
		</div>	
  		
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="index.php?r=item/index">返回</a>
      </div>
    </form>
  </div>
</div>