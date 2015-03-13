<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
	</style>
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/wind.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "__ROOT__/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
</head>	
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <ul class="nav nav-tabs">
     <li><a href="index.php?r=rbac/index">角色管理</a></li>
     <li><a href="index.php?r=rbac/addrole">添加角色</a></li>
  </ul>
  <form class="form-horizontal J_ajaxForm" action="" method="post" id="myform">
    <div class="table_full">
      <table width="100%" cellpadding="2" cellspacing="2">
        <tr>
          <th width="180">角色名称</th>
          <td><input type="text" name="name" value="<?php echo $roleinfo['name'];?>" class="input" id="rolename"><span class="must_red">*</span></td>
        </tr>
        <tr>
          <th>角色描述</th>
          <td><textarea name="remark" rows="2" cols="20" id="remark" class="inputtext" style="height:100px;width:500px;"><?php echo $roleinfo['remark'];?></textarea></td>
        </tr>
        <tr>
          <th>是否启用</th>
          <td>
        	<?php $active_true_checked=($roleinfo['status'] ==1)?"checked":""; ?>
          	
              <label class="radio inline" for="active_true">
            		<input type="radio" name="status" value="1" <?php echo $active_true_checked; ?>  id="active_true"/>开启
            </label>
            <?php $active_false_checked=($roleinfo['status'] ==0)?"checked":""; ?>
           
            <label class="radio inline" for="active_false">
            		<input type="radio" name="status" value="0" id="active_false" <?php echo $active_false_checked; ?> >禁止
            </label>
          </td>
        </tr>
      </table>
      <input type="hidden" name="id" value="<?php echo $roleinfo['id'];?>" />
    </div>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary btn_submit  J_ajax_submit_btn">提交</button>
        <a class="btn" href="<?php echo Yii::app()->user->returnUrl;?>">返回</a>
    </div>
  </form>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/common.js"></script>
</body>
</html>