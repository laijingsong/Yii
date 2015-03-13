<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>系统后台</title>
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta name="robots" content="noindex,nofollow">
		<link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/assets/css/admin_login.css" rel="stylesheet" />
		<style>
			#login_btn_wraper{
				text-align: center;
			}
			#login_btn_wraper .tips_success{
				color:#fff;
			}
			#login_btn_wraper .tips_error{
				color:#DFC05D;
			}
		</style>
		<script>
			if (window.parent !== window.self) {
					document.write = '';
					window.parent.location.href = window.self.location.href;
					setTimeout(function () {
							document.body.innerHTML = '';
					}, 0);
			}
		</script>
		
	</head>
<body>
	<div class="wrap">
		<h1><a href="">彩衫网 后台管理</a></h1>
		<form method="post" name="login" action="index.php?r=login/dologin" autoComplete="off" class="J_ajaxForm">
			<div class="login">
				<ul>
					<li>
						<!-- {$_COOKIE['admin_username']} -->
						<input class="input" id="J_admin_name" required name="username" type="text" placeholder="帐号名或邮箱" title="帐号名或邮箱" value=""/>
					</li>
					<li>
						<input class="input" id="admin_pwd" type="password" required name="password" placeholder="密码" title="密码" />
					</li>
					
					<li style="display:none;">
						<input class="input" type="text" name="verify" placeholder="请输入验证码" />
					</li>
				</ul>
				<div id="login_btn_wraper">
					<button type="submit" name="submit" class="btn btn_submit J_ajax_submit_btn">登录</button>
				</div>
			</div>
		</form>
	</div>

<script>
var GV = {
	DIMAUB: "__ROOT__/",
	JS_ROOT: "statics/js/",//js版本号
	TOKEN : ''	//token ajax全局
};
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/js/jquery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/wind.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/common.js"></script>
<script>
;(function(){
	document.getElementById('J_admin_name').focus();
	
})();
</script>
</body>
</html>
