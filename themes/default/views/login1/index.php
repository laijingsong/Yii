<!DOCTYPE html>
<html style="overflow: hidden;" lang="zh_CN"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<!-- Set render engine for 360 browser --> 
<meta name="renderer" content="webkit"> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>后台</title> 
<meta name="description" content="This is page-header (.page-header &gt; h1)"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/bootstrap/js/bootstrap.min.js" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>static/default/cmf/theme.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>static/default/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->request->baseUrl; ?>static/default/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>static/default/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>static/default/css/style.css" rel="stylesheet">
</head>
<body class="body-white">
	<tc_include file="Public:nav" />

	<div class="container tc-main">
		<div class="row">
			<div class="span6 offset3">
				<h2 class="text-center">用户登录</h2>
				<form class="form-horizontal J_ajaxForms" action="index.php?r=login/dologin" method="post">
					<div class="control-group">
						<label class="control-label" for="user_login">账号</label>
						<div class="controls">
							<input type="text" id="user_login" name="user_login" placeholder="请输入用户名或者邮箱" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="user_pass">密码</label>
						<div class="controls">
							<input type="password" id="user_pass" name="user_pass" placeholder="请输入密码" class="span3">
						</div>
					</div>

					<div class="control-group" style="display:none;">
						<label class="control-label" for="input_verify">验证码</label>
						<div class="controls">
							<input type="text" id="input_verify" name="verify"  placeholder="请输入验证码" class="span3">
							{:sp_verifycode_img('code_len=4&font_size=15&width=100&height=35&charset=1234567890')}
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<label class="checkbox persistent"><input type="checkbox" name="terms" value="1">我同意
								<a href="#">网站内容服务条款</a></label>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<button class="btn btn-primary J_ajax_submit_btn" type="submit">确定</button>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<ul class="inline">
								<li><a href="index.php?r=login/register">现在注册</a></li>
								<li><a href="{:U('user/login/forgot_password')}">忘记密码</a></li>
							</ul>
						</div>
					</div>
				</form>
			</div>
		</div>

		<tc_include file="Public:footer" />

	</div>
	<!-- /container -->

	<tc_include file="Public:scripts" />
</body>
</html>
