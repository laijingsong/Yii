<!DOCTYPE html>
<html style="overflow: hidden;" lang="zh_CN">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Set render engine for 360 browser --> 
<meta name="renderer" content="webkit"> 
<meta charset="utf-8"> 
<title>ThinkCMF</title> 
<meta name="description" content="This is page-header (.page-header &gt; h1)"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="css/theme.css" rel="stylesheet"> 
<link href="css/simplebootadmin.css" rel="stylesheet"> 
<link href="css/font-awesome.css" rel="stylesheet" type="text/css"> <!--[if IE 7]> <link rel="stylesheet" href="css/font-awesome-ie7.min.css"> <![endif]-->
<link rel="stylesheet" href="css/simplebootadminindex.css"> <!--[if lte IE 8]> <link rel="stylesheet" href="/statics/simpleboot/css/simplebootadminindex-ie.css?" /> <![endif]--> 
<style>
.navbar .nav_shortcuts .btn{margin-top: 5px;}
#nav_wraper ul ul ul .menu-text{display:inline-block;text-indent:8px;}
/*-----------------导航hack--------------------*/
.nav-list>li.open{position: relative;}
.nav-list>li.open .back {display: none;}
.nav-list>li.open .normal {display: inline-block !important;}
.nav-list>li.open a {padding-left: 7px;}
.nav-list>li .submenu>li>a {background: #fff;}
.nav-list>li .submenu>li a>[class*="fa-"]:first-child{left:20px;}
.nav-list>li ul.submenu ul.submenu>li a>[class*="fa-"]:first-child{left:30px;}
/*----------------导航hack--------------------*/
</style> 
<script>//全局变量
var GV = {
	HOST:"demo.thinkcmf.com",
    DIMAUB: "/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script> </head>
<body style="min-width:900px;" screen_capture_injected="true"> 
	<div style="display: none;" id="loading">
    	<i class="loadingicon"></i>
        <span>正在加载...</span>
    </div> 
    <div id="right_tools_wrapper"> <!--<span id="right_tools_clearcache" title="清除缓存" onclick="javascript:openapp('/admin/setting/clearcache.html','right_tool_clearcache','清除缓存');"><i class="fa fa-trash-o right_tool_icon"></i></span>		-->
    	<span id="refresh_wrapper" title="刷新当前页">
        	<i class="fa fa-refresh right_tool_icon"></i>
        </span>
     </div> 
     <div class="navbar"> 
     	<div class="navbar-inner"> 
        	<div class="container-fluid"> 
            	<a href="http://demo.thinkcmf.com/index.php?g=admin&amp;m=index&amp;a=index" class="brand"> 
                	<small> <img src="ThinkCMF_files/logo-18.png"> 彩衫网 后台</small> 
                </a> 
                <div class="pull-left nav_shortcuts"> 
                    <a class="btn btn-small btn-success" href="#" title="分类管理"> <i class="fa fa-th"></i> </a> 
                    <a class="btn btn-small btn-info" href="#" title="文章管理"> <i class="fa fa-pencil"></i> </a> 
                    <a class="btn btn-small btn-warning" href="#" title="前台首页" target="_blank"> <i class="fa fa-home"></i> </a> 
                    <a class="btn btn-small btn-danger" href="#" title="清除缓存"> <i class="fa fa-trash-o"></i> </a> 
                </div> 
                <ul class="nav simplewind-nav pull-right"> 
                	<li class="light-blue"> 
                    	<a data-toggle="dropdown" href="#" class="dropdown-toggle"> 
                        	<img class="nav-user-photo" src="ThinkCMF_files/logo-18.png" alt="demo"> 
                            <span class="user-info"> <small>欢迎,</small>demo</span> 
                            <i class="fa fa-caret-down"></i> 
                        </a> 
                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer"> 
                        	<li><a href="#"><i class="fa fa-cog"></i> 站点管理</a></li> 
                            <li><a href="#"><i class="fa fa-user"></i> 个人资料</a></li> 
                            <li class="divider"></li> 
                            <li><a href="http://demo.thinkcmf.com/admin/public/logout.html"><i class="fa fa-sign-out"></i> 退出</a></li> 
                        </ul> 
                    </li> 
                 </ul> 
             </div> 
         </div> 
     </div> 
     <div class="main-container container-fluid"> 
     	<div class="sidebar" id="sidebar"> <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts"> </div> --> 
        	<div style="height: 522px;" id="nav_wraper"> 
            	<ul class="nav nav-list"> 
                	<li class="open"> 
                    	<a href="#" class="dropdown-toggle"> 
                        	<i class="fa fa-cogs normal"></i> 
                            <span class="menu-text normal">设置</span> 
                            <b class="arrow fa fa-angle-right normal"></b> 
                            <i class="fa fa-reply back"></i> 
                            <span class="menu-text back">返回</span> 
                        </a> 
                        <ul style="display: block;" class="submenu"> 
                        	<li class="open"> 
                            	<a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">个人信息</span><b class="arrow fa fa-angle-right"></b></a> 
                                <ul style="display: block;" class="submenu"> 
                                	<li><a href="javascript:openapp('admin/userinfo/111.html','111Admin','修改信息');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">修改信息</span> </a> </li> 
                                    <li> <a href="javascript:openapp('admin/userinfo/113.html','113Admin','修改密码');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">修改密码</span> </a> </li> 
                                </ul> 
                            </li> 
                            <li><a href="#"><i class="fa fa-caret-right"></i><span class="menu-text">网站信息</span> </a> </li> 
                            <li class=""> 
                            	<a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">邮箱配置</span> <b class="arrow fa fa-angle-right"></b> </a> 
                                <ul style="display: none;" class="submenu"> 
                                	<li> <a href="javascript:openapp('admin/mailer/129.html','129Admin','邮件模板');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">邮件模板</span> </a> </li> 
                                </ul> 
                            </li> 
                        </ul> 
                    </li> 
                    <li class=""> 
                    	<a href="#" class="dropdown-toggle"> 
                        	<i class="fa fa-group normal"></i> 
                            <span class="menu-text normal">用户管理</span> 
                            <b class="arrow fa fa-angle-right normal"></b> 
                            <i class="fa fa-reply back"></i> 
                            <span class="menu-text back">返回</span> 
                        </a> 
                        <ul style="display: none;" class="submenu"> 
                        	<li> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">用户组</span> <b class="arrow fa fa-angle-right"></b> </a> 
                            	<ul class="submenu"> 
                                    <li> <a href="javascript:openapp('admin/user/indexadmin/134.html','134User','本站用户');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">本站用户</span> </a> </li> 
                                    <li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">第三方用户</span> </a> </li> 
                                </ul> 
                            </li> 
                            <li class=""> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">管理组</span> <b class="arrow fa fa-angle-right"></b> </a> 
                            	<ul style="display: none;" class="submenu"> 
                                	<li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">角色管理</span> </a> </li> 
                                    <li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">管理员</span> </a> </li> 
                                </ul> 
                            </li> 
                        </ul> 
                    </li> 
                    <li class=""> <a href="#" class="dropdown-toggle"> <i class="fa fa-list normal"></i> <span class="menu-text normal">菜单管理</span> <b class="arrow fa fa-angle-right normal"></b> <i class="fa fa-reply back"></i> <span class="menu-text back">返回</span> </a> 
                    	<ul style="display: none;" class="submenu"> 
                        	<li> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">前台菜单</span> <b class="arrow fa fa-angle-right"></b> </a> 
                            	<ul class="submenu"> 
                                	<li> <a href="javascript:openapp('admin/nav/1.html','1Admin','菜单管理');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">菜单管理</span> </a> </li> 
                                    <li> <a href="javascript:openapp('admin/nav/2.html','2Admin','菜单分类');"><i class="fa fa-angle-double-right"></i> <span class="menu-text">菜单分类</span> </a> </li> 
                                </ul> 
                            </li> 
                            <li> <a href="javascript:openapp('admin/menu/100.html','100Admin','后台菜单');"> <i class="fa fa-caret-right"></i> <span class="menu-text">后台菜单</span> </a> </li> 
                        </ul> 
                    </li> 
                    <li class=""> <a href="#" class="dropdown-toggle"> <i class="fa fa-th normal"></i> <span class="menu-text normal">内容管理</span> <b class="arrow fa fa-angle-right normal"></b> <i class="fa fa-reply back"></i> <span class="menu-text back">返回</span> </a> 
                    	<ul style="display: none;" class="submenu"> 
                        	<li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">所有留言</span> </a> </li> 
                            <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">评论管理</span> </a> </li> 
                            <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">文章管理</span> </a> </li> 
                            <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">分类管理</span> </a> </li> 
                            <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">页面管理</span> </a> </li> 
                            <li> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">回收站</span> <b class="arrow fa fa-angle-right"></b> </a> 
                            	<ul class="submenu"> 
                                	<li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">文章回收</span> </a> </li> 
                                    <li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">页面回收</span> </a> </li> 
                                </ul> 
                            </li> 
                        </ul> 
                    </li> 
                    <li class=""> 
                    <a href="#" class="dropdown-toggle"> 
                    	<i class="fa fa-cloud normal"></i> 
                        <span class="menu-text normal">扩展工具</span> 
                        <b class="arrow fa fa-angle-right normal"></b> 
                        <i class="fa fa-reply back"></i> 
                        <span class="menu-text back">返回</span> 
                    </a> 
                    <ul style="display: none;" class="submenu"> 
                    	<li> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">备份管理</span> <b class="arrow fa fa-angle-right"></b> </a> 
                        	<ul class="submenu"> 
                            	<li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">数据备份</span> </a> </li> 
                            </ul> 
                        </li> 
                        <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">插件管理</span> </a> </li> 
                        <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">文件存储</span> </a> </li> 
                        <li> <a href="#" class="dropdown-toggle"> <i class="fa fa-caret-right"></i> <span class="menu-text">幻灯片</span> <b class="arrow fa fa-angle-right"></b> </a> 
                        	<ul class="submenu"> 
                            	<li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">幻灯片管理</span> </a> </li> 
                                <li> <a href="#"><i class="fa fa-angle-double-right"></i> <span class="menu-text">幻灯片分类</span> </a> </li> 
                            </ul> 
                        </li> 
                        <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">网站广告</span> </a> </li> 
                        <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">友情链接</span> </a> </li> 
                        <li> <a href="#"> <i class="fa fa-caret-right"></i> <span class="menu-text">第三方登陆</span> </a> </li> 
                    </ul> 
                </li> 
            </ul> 
        </div> 
    </div> 
    <div class="main-content"> 
    	<div class="breadcrumbs" id="breadcrumbs"> <a style="display: none;" id="task-pre" class="task-changebt">←</a> 
        	<div style="width: 118px;" id="task-content"> 
            	<ul style="width: 118px; margin-left: 0px;" class="macro-component-tab" id="task-content-inner"> 
                	<li class="macro-component-tabitem noclose current" app-id="0" app-url="/admin/main/index.html" app-name="首页"> <span class="macro-tabs-item-text">首页</span> </li> 
                </ul> 
                <div style="clear:both;"></div> 
            </div> 
            <a style="display: none;" id="task-next" class="task-changebt">→</a> 
        </div> 
        <div style="height: 522px;" class="page-content" id="content"> 
        	<iframe src="admin/index.htm" style="width: 100%; height: 100%; display: inline;" id="appiframe-0" class="appiframe" frameborder="0"></iframe> 
            <iframe id="appiframe-111Admin" src="ThinkCMF_files/111.htm" style="width: 100%; height: 100%; display: none;" class="appiframe" frameborder="0"></iframe>
            <iframe id="appiframe-140Admin" src="ThinkCMF_files/140.htm" style="width: 100%; height: 100%; display: none;" class="appiframe" frameborder="0"></iframe>
        </div> 
    </div> 
</div> 

<script src="js/statics/jquery.js"></script> 
<script src="js/statics/bootstrap.js"></script> 
<script>
	var b = $("#sidebar").hasClass("menu-min");
	var a = "ontouchend" in document;
	$(".nav-list").on(
			"click",
			function(g) {
				var f = $(g.target).closest("a");
				if (!f || f.length == 0) {
					return
				}
				if (!f.hasClass("dropdown-toggle")) {
					if (b && "click" == "tap"
							&& f.get(0).parentNode.parentNode == this) {
						var h = f.find(".menu-text").get(0);
						if (g.target != h && !$.contains(h, g.target)) {
							return false
						}
					}
					return
				}
				var d = f.next().get(0);
				if (!$(d).is(":visible")) {
					var c = $(d.parentNode).closest("ul");
					if (b && c.hasClass("nav-list")) {
						return
					}
					c.find("> .open > .submenu").each(
							function() {
								if (this != d
										&& !$(this.parentNode).hasClass(
												"active")) {
									$(this).slideUp(150).parent().removeClass(
											"open")
								}
							})
				} else {
				}
				if (b && $(d.parentNode.parentNode).hasClass("nav-list")) {
					return false;
				}
				$(d).slideToggle(150).parent().toggleClass("open");
				return false;
			});
</script> 
<script src="js/index.js"></script>  
</body>
</html>