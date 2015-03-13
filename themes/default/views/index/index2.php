<!DOCTYPE html>
<html style="overflow: hidden;" lang="zh_CN"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<!-- Set render engine for 360 browser --> 
<meta name="renderer" content="webkit"> 
<meta charset="utf-8"> 
<title>后台</title> 
<meta name="description" content="This is page-header (.page-header &gt; h1)"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="<?php echo Yii::app()->request->baseUrl; ?>/static/default/css/theme.css" rel="stylesheet">
<body>
<div>角色管理1</div>
<form action="">
	<table>
		<tr>
			<td width="50">id</td>
			<td>角色名称</td>
			<td>角色描述</td>
			<td>状态</td>
			<td>管理操作</td>
			
		</tr>
		<tr>
			<td>1</td>
			<td>超级管理员</td>
			<td>拥有网站最高管理员权限！</td>
			<td>1</td>
			<td cols="3"><a href="index.php?r=rbac/authoriaze">权限设置11</a>&nbsp;<a href="">修改</a>&nbsp;<a href="">删除</a></td>
		</tr>
	</table>
</form>


</body></html>