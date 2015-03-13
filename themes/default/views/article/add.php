
<body class="J_scroll_fixed">
<div class="wrap jj">
  <ul class="nav nav-tabs">
     <li><a href="index.php?r=article/index">管理文章</a></li>
     <li class="active"><a href="index.php?r=article/add">添加文章</a></li>
  </ul>
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
              <td width="100">文章标题:</td>
              <td><input type="text" class="input" name="title" value=""></td>
            </tr>
            
            
            
           
             <tr>
             
              <td>内容:</td>
              <td><script type="text/plain" id="content" name="c"></script>
					<style type="text/css">
					.content_attr {
						border: 1px solid #CCC;
						padding: 5px 8px;
						background: #FFC;
						margin-top: 6px
					}
					</style></td>
            </tr>
            <tr>
              <td>描述:</td>
              <td><textarea rows="" cols="" name="des"></textarea></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form-actions">
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
            <a class="btn" href="index.php?r=article/index">返回</a>
      </div>
    </form>
  </div>
</div>
