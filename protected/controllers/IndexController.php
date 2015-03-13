<?php

/**
 * @name 登陆页面
 * @author jun
 */
class IndexController extends IController
{
	public $userinfo;
	public function init()
	{	
		parent::init();
		if(isset(Yii::app()->session['ADMIN_ID'])){
			$user=new Ad();
			$id=$_SESSION['ADMIN_ID'];
			$attributes=array('id'=>$id);
			$this->userinfo=$user->findByAttributes($attributes);
		}
		$this->layout = '//layouts';
	}
	
	function current_week ($date_of_firstday='2015-1-1'){
		//开学第一天的时间戳
		$year = substr($date_of_firstday,0,4);
		$month = substr($date_of_firstday,5,1);
		$day = substr($date_of_firstday,7,2);
		$time_chuo_of_first_day = mktime(0,0,0,$month,$day,$year);
		//今天的时间戳
		$month = date('n'); //获取月 n
		$day = date('d');   //获取日 d
		$year = date('Y');  //获取年 Y
		$time_chuo_of_current_day = mktime(0,0,0,$month,$day,$year);
		$cha = ($time_chuo_of_current_day-$time_chuo_of_first_day)/60/60/24;
		$zhou = (int)(($cha)/7 +1);
		return $zhou;
	}
	/**
	 * @name 首页
	 */
	public function actionIndex()
	{

		$this->layout = '//layouts';
		//print_r($this->userinfo->attributes);
		$this->render('index',array('userinfo'=>$this->userinfo));
	}
	
	public function actionDefault()
	{
		
		//print_r($this->userinfo->attributes);
		$this->render('default');
	}
	
	//角色授权
	public function actionAuthoriaze()
	{
		//$thismonth=strtotime(date('Y-m-01', strtotime("-7 day")));
		$thismonth=strtotime(date('Y-m-01'));
		
		$Count=5;
		$this->layout = '//layouts/rbac';
		$this->render('authorize',array('Count'=>$Count));
	}
	
	//增加角色权限
	
	public function actionAddauth()
	{
		//CHtml::textField($name);
		$Menu=new Menus();
	
		
		$menus=$Menu->getMenu();
		
		$Count=5;
		$this->layout = '//layouts/rbac';
		$this->render('addauth',array('menus'=>$menus));
	}
	//用户登录
	
	public function  actionLoginform(){
		
		$model=new LoginForm();
		if (isset($_POST['username'])){
			$model->attributes=$_POST['username'];
			if ($model->validate()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$Count=5;
		$this->layout = '//layouts/rbac';
		$this->render('loginform',array('model'=>$model));
	}
	
}