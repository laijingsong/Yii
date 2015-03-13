<?php

/**
 * @name
 * @author jun
 */
class RegisterController extends IController
{
	public function init()
	{
		parent::init();
	}
	
	
	/**
	 * @name 注册首页
	 */
	public function actionIndex()
	{
		$model=new  Users();
		//$roleinfo=$Role->getRole();
		//$thismonth=strtotime(date('Y-m-01'));
		
		$Count=5;
		
		$this->render('index',array('Count'=>$Count,'form'=>$model));
	}
	
	
	public function actionDoregister()
	{
		$model=new Users();
		if (isset($_POST)){
			
			
			$model->attributes=$_POST;
			$model->create_time=date('Y-m-d H:i:s');
			$model->user_nicename=$_POST['user_login'];
			if ($model->validate()){
				$model->save();
				echo Yii::app()->user->returnUrl;exit;
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
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