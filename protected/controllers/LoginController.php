<?php

/**
 * @name 后台登陆
 */
class LoginController extends Controller
{
	public function init()
	{
		parent::init();
		$this->layout = '//layouts';
	}
	
	
	/**
	 * @name 登陆首页
	 */
	public function actionIndex()
	{
		$model=new Itemtype();
		$alltype=$model->getalltype();
		$Count=count($alltype);
		$this->render('index');
	}
	
	public function actionlogout(){
		unset(Yii::app()->session['ADMIN_ID']);
		$this->redirect(array("login/index"));
	}
	
	/*
	 * 登陆
	 */
	public function actiondologin(){
		
		$commonfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
		
		$model=new  Ad();
		$getmethod=Yii::app()->request;
		$name=$getmethod->getParam('username');
		$pwd=$getmethod->getParam('password');
		
		if (empty($name)){
			
			echo '用户名不能为空！';
		}
		if (empty($pwd)){
			echo '密码不能为空！';
		}
		
		if(strpos($name,"@")>0){//邮箱登陆
			$where['user_email']=$name;
		}else{
			$where['user_login']=$name;
		}
	
		$result=$model->findByAttributes($where);
		$salt=$result['salt'];
		if($result != null && $result['user_type']==1){
			if($result['user_pass'] == $this->sp_password($pwd,$salt)){
				Yii::app()->session['ADMIN_ID']=$result["id"];
				$_SESSION['name']=$result["user_login"];
				$result->last_login_ip=Yii::app()->request->userHostAddress;
				$result->last_login_time=date("Y-m-d H:i:s");
				
				$result->save();
				setcookie("admin_username",$name,time()+30*24*3600,"/");
				$this->redirect(array('index/index'));
			}else{
				$commonfun->message('账号或密码错误', 'index.php?r=login/index', 0);
			}
		}else {
			$commonfun->message('账号或密码错误', 'index.php?r=login/index', 0);
		}
	}	
	
	function  sp_password($pwd,$salt){
		if (empty($pwd))
			return false;
		return  md5(md5(md5($pwd.$salt)));
	}
	
	
	
	
	public function actionLogin()
	
	{
		$model=new LoginForm();
	
		if(isset($_POST['LoginForm']))
	
		{
			// 收集用户输入的数据
	
			$model->attributes=$_POST['LoginForm'];
	
			// 验证用户输入，并在判断输入正确后重定向到前一页
	
			if($model->validate())
	
				$this->redirect(Yii ::app()->user->returnUrl); //重定向到之前需要身份验证的页面URL
	
		}
	
		// 显示登录表单
	
		$this->render('login',array('model'=>$model));
	
	}
	
	
	/*
	 * 添加商品类型
	 */
	
	public  function  actionAdd()
	{
		$model=new Itemtype();
		$getmethod=Yii::app()->request;
		$maxid=$model->getmaxid();
		//$pbhparam=$getmethod->getParam('bh');
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$model->name=$name;
			$model->des=$des;
			$model->bh=(int)($maxid+1);
			//$model->pbh=(int)($maxid+1);
			if ($model->save()!=false){
				$this->redirect(array('itemtype/index'));
			}
		}
		$this->render('add');
	}
	/*
	 * 修改商品类型
	 */
	
	public function actionEdit()
	{
		$model=new Itemtype();
		$getmethod=Yii::app()->request;
		$id=$getmethod->getParam('bh');
		$typers=$model->gettype($id,false);
		$type=$model->gettype($id);
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$typers->name=$name;
			$typers->des=$des;
			
			if ($typers->save()!=false){
				$this->redirect(array('itemtype/index'));
			}
		}
		$this->render('edit',array('itemtype'=>$type));
	}
	/*
	 * 删除商品类型
	 */
	public  function  actionDel()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$model=new  Itemtype();
		$attributes=array('bh'=>$bh);
		if ($model->deleteAllByAttributes($attributes)!=false){
			$this->redirect(array('itemtype/index'));
		}

	}
	/*
	 * 属性列表
	 */
	public  function  actionSxlist()
	{
		$model=new Itemproperty();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$allcate=$model->getallcate($bh);
		$this->render('sxlist',array('allcate'=>$allcate,'bh'=>$bh));
		
	}
	
	/*
	 * 增加属性
	*/
	public  function  actionSxlistadd()
	{
		$type=new Itemtype();
		$alltype=$type->getalltype();
		
		$model=new Itemproperty();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		
		$maxid=$model->getmaxid();
		if ($_POST){
			$bh=(int)trim($_POST['bh']);
			
			$model->name=trim($_POST['name']);
			$model->content=trim($_POST['content']);
			$model->des=trim($_POST['des']);
			$model->bh=(int)($maxid+1);
			$model->ItemBh=(int)($bh);
			if ($model->save()!=false){
				$this->redirect(Yii::app()->request->urlReferrer);
			}
		}
		$this->render('sxlistadd',array('bh'=>$bh,'alltype'=>$alltype));
	} 
	
	/*
	 * 修改属性
	*/
	public  function  actionSxlistedit()
	{
		$type=new Itemtype();
		$alltype=$type->getalltype();
		
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$sxid=$getmethod->getParam('sxid');
		
		$model=new Itemproperty();
		$Osxinfo=$model->getsxinfo($sxid,false);
		$sxinfo=$model->getsxinfo($sxid);
		$typeinfo=$type->bhgettype($bh);
		if ($_POST){
			$Osxinfo->name=trim($_POST['name']);
			$Osxinfo->content=trim($_POST['content']);
			$Osxinfo->des=trim($_POST['des']);
			
			if ($Osxinfo->save()!=false){
				$this->redirect(Yii::app()->request->urlReferrer);
			}
		}
	
		$this->render('sxlistedit',array('bh'=>$bh,'sxinfo'=>$sxinfo,'alltype'=>$alltype,'typeinfo'=>$typeinfo));
	}
	
	
}