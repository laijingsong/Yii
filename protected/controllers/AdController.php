<?php

/**
 * @name 管理员管理
 * @author jun
 */
class AdController extends IController
{
	public function init()
	{
		parent::init();
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
		$model=new  Ad();
		
		$alladmin=$model->getAllAdmin();

		$Count=count($alladmin);
		
		$this->render('index',array('Count'=>$Count,'alladmin'=>$alladmin));
	}
	
	/**
	 * 添加管理员
	 */
	
	public function actionAdd()
	{
		$Role=new  Role();
		$user=new Ad();
		$Role=new  Role();
		$roleinfo=$Role->getRole();
		$Roleuser=new Roleuser();
		if ($_POST){
			$roleids=Yii::app()->request->getParam('role_id');
			
			unset($_POST['role_id']);
			$user->user_login=Yii::app()->request->getParam('user_login');
			$pwd=Yii::app()->request->getParam('user_pass');
			$salt=uniqid();
			$pwd=md5(md5(md5($pwd.$salt)));
			$user->user_pass=$pwd;
			$user->salt=$salt;
			$user->user_email=Yii::app()->request->getParam('user_email');
			$user->user_type=1;
			$user->last_login_ip='';
			$user->last_login_time='0000-00-00 00:00:00';
			$user->create_time=date('Y-m-d H:i:s');

			if ($user->save()!=false){
				$user_id=$user->id;
				foreach ($roleids as $roleid){
					$addsql="insert into cs_role_user (role_id,user_id) values($roleid,$user_id)";
					Yii::app()->db->createCommand($addsql)->execute();
				}
				$this->redirect(array('ad/index'));
				
			}	
		}
		$this->render('add',array('roleinfo'=>$roleinfo));
	}
	
	
	/*
	 * 修改管理员资料
	 */
	
	public function actionEdit()
	{
		
		$id=Yii::app()->request->getParam('id');
		$model=new  Ad();
		$userinfo=$model->getAdmin($id,false);
		$user=$model->getAdmin($id);
		$Role=new  Role();
		$roleinfo=$Role->getRole();
		$Roleuser=new Roleuser();
		$roleids=$Roleuser->getRoleids($id);
		
		if ($_POST){
			$roleids2=Yii::app()->request->getParam('role_id');

			$userinfo->user_login=Yii::app()->request->getParam('user_login');
			if (Yii::app()->request->getParam('user_pass')){
				$salt=uniqid();
				$pwd=Yii::app()->request->getParam('user_pass');
				$pwd=md5(md5(md5($pwd.$salt)));
				$userinfo->user_pass=$pwd;
				$userinfo->salt=$salt;
			}

			$userinfo->user_email=Yii::app()->request->getParam('user_email');
			
			if ($userinfo->save()!=false){
				$delrolesql="delete from cs_role_user where user_id=".$id;
				$arr=array('user_id'=>$id);
				Yii::app()->db->createCommand($delrolesql)->execute();
				
				foreach ($roleids2 as $roleid){
					$addsql="insert into cs_role_user (role_id,user_id) values($roleid,$id)";
					Yii::app()->db->createCommand($addsql)->execute();
				}
				
			}
			$this->redirect(array('ad/index'));
	
		}
		
		$this->render('edit',array('user'=>$user,'roleinfo'=>$roleinfo,'roleids'=>$roleids));
	}
	/*
	 * 删除管理员
	 */
	public  function  actionDel()
	{
		$id=Yii::app()->request->getParam('id');
		if ($id==1){
			$this->redirect(array('ad/index'));
		}else{
			$user=new Ad() ;
			$roleuser=new  Roleuser();
			if ($user->deleteByPk($id)!=false){
				$attributes=array('user_id'=>$id);
				$roleuser->deleteAllByAttributes($attributes);
				$this->redirect(array('ad/index'));
			}
		}
	}
	
}