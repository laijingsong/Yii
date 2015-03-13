<?php

/**
 * @name 会员管理,设计师、店主管理
 * @author jun
 */
class userController extends IController
{
	public $DesignerTable;
	public $VipTable;
	public $DianzhuTable;
	public $UserTable;
	public function init()
	{
		parent::init();
		$this->DesignerTable='{{designer}}';
		$this->VipTable='{{vip}}';
		$this->DianzhuTable='{{dianzhu}}';
		$this->UserTable='{{users}}';
		
	}

	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		$sql="select distinct a.bh,a.name as uname,a.bank,a.acc,a.email,a.IdCard,a.phone,a.tbh,(select count(tbh) from ".$this->VipTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->VipTable."  a ".
				"left join ".$this->VipTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ";
		$result = Yii::app()->db->createCommand($sql)->query();
		$num=$result->rowCount;
		$criteria=new CDbCriteria();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=1;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$posts=$result->query();
		
		
		$this->render('index',array('pages'=>$pages,'posts'=>$posts,'num'=>$num));
		
	}
	/*
	 * 修改会员资料
	 */
	
	public function actionEdit()
	{
		$mothod=Yii::app()->request;
		$bh=Yii::app()->request->getParam('bh');
		$sql="select distinct a.bh,a.name as uname,a.bank,a.acc,a.email,a.IdCard,a.addr,a.phone,a.tbh,(select count(tbh) from ".$this->VipTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->VipTable."  a ".
				"left join ".$this->VipTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ".
				"where a.bh=".$bh;
		$userinfo = Yii::app()->db->createCommand($sql)->queryRow();
		if ($_POST){

			$model=new vip();
			$bh=$mothod->getParam('bh');
			$vip=$model->findByAttributes(array('bh'=>$bh));
			$vip->name=$mothod->getParam('name');
			$vip->bank=$mothod->getParam('bank');
			$vip->acc=$mothod->getParam('acc');
			$vip->email=$mothod->getParam('email');
			$vip->IdCard=$mothod->getParam('IdCard');
			$vip->addr=$mothod->getParam('addr');
			$vip->phone=$mothod->getParam('phone');
			
			if ($vip->save()){
				$this->commonfun->message('更新成功', $this->upUrl, 0);
			}else{
				$this->commonfun->message('更新失败', $this->currentUrl, 2);
			}
		}
		
		$this->render('edit',array('userinfo'=>$userinfo,'bh'=>$bh));
	}
	/*
	 * 删除会员
	 */
	public  function  actionDel()
	{
		$bh=Yii::app()->request->getParam('bh');
		$vip=new vip() ;
		$vipinfo=$vip->findByAttributes(array('bh'=>$bh));
		$attributes=array('bh'=>$bh);
		if ($vip->deleteAllByAttributes($attributes)!=false){
			User::model()->deleteAllByAttributes(array('bh'=>$vipinfo->UserBh));
			$this->commonfun->message('删除成功', $this->upUrl, 0);
		}
	}
	
//==================

	/**
	 * @name 设计师管理
	 */
	public function actionDesigner()
	{
		$sql="select distinct a.bh,a.tname as uname,a.bank,a.acc,a.email,a.IdCard,a.phone,a.tbh,a.status,(select count(tbh) from ".$this->DesignerTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DesignerTable."  a ".
				"left join ".$this->DesignerTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ";
		$result = Yii::app()->db->createCommand($sql)->query();
		$num=$result->rowCount;
		$criteria=new CDbCriteria();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$posts=$result->query();
		$this->render('designer',array('pages'=>$pages,'posts'=>$posts,'num'=>$num));
	
	}
	/*
	 * 修改设计师资料
	*/
	
	public function actionDesignerEdit()
	{
		$mothod=Yii::app()->request;
		$bh=Yii::app()->request->getParam('bh');
		$sql="select distinct a.bh,a.tname as tname,a.bank,a.acc,a.email,a.IdCard,a.addr,a.phone,a.tbh,(select count(tbh) from ".$this->DesignerTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DesignerTable."  a ".
				"left join ".$this->DesignerTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ".
				"where a.bh=".$bh;
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		if ($_POST){
			$bh=$mothod->getParam('bh');
			$model=Designer::model()->findByAttributes(array('bh'=>$bh));
			$model->tname=$mothod->getParam('tname');
			$model->bank=$mothod->getParam('bank');
			$model->acc=$mothod->getParam('acc');
			$model->email=$mothod->getParam('email');
			$model->IdCard=$mothod->getParam('IdCard');
			$model->addr=$mothod->getParam('addr');
			$model->phone=$mothod->getParam('phone');
			
			if ($model->save()){
				$this->commonfun->message('更新成功', $this->upUrl, 0);
			}else{
				$this->commonfun->message('更新失败', $this->currentUrl, 2);
			}
		}
	
		$this->render('designeredit',array('result'=>$result,'bh'=>$bh));
	}
	/*
	 * 删除设计师
	*/
	public  function  actionDesignerDel()
	{
		$bh=Yii::app()->request->getParam('bh');
		$vipinfo=Designer::model()->findByAttributes(array('bh'=>$bh));
		$attributes=array('bh'=>$bh);
		if (Designer::model()->deleteAllByAttributes($attributes)!=false){
			User::model()->deleteAllByAttributes(array('bh'=>$vipinfo->UserBh));
			$this->commonfun->message('删除成功', $this->upUrl, 0);
		}
	}
	/**
	 * 审核设计师
	 */
	public  function  actionDesignerCk()
	{
		$mothod=Yii::app()->request;
		$bh=Yii::app()->request->getParam('bh');
		$sql="select distinct a.bh,a.tname as tname,a.bank,a.acc,a.email,a.IdCard,a.addr,a.phone,a.tbh,a.status,(select count(tbh) from ".$this->DesignerTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DesignerTable."  a ".
				"left join ".$this->DesignerTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ".
				"where a.bh=".$bh;
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		if ($_POST){
			$bh=$mothod->getParam('bh');
			$model=Designer::model()->findByAttributes(array('bh'=>$bh));
			$status=$mothod->getParam('status');
			$model->status=(int)$status;
			if ($model->save()){
				$this->commonfun->message('审核成功', $this->upUrl, 0);
			}
		}
		
		$this->render('designerck',array('result'=>$result,'bh'=>$bh));
	}
	
	//===============
	
	/**
	 * @name 店主管理
	 */
	public function actionDianzhu()
	{
		$sql="select distinct a.bh,a.tname as uname,a.bank,a.acc,a.email,a.IdCard,a.phone,a.tbh,a.status,(select count(tbh) from ".$this->DianzhuTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DianzhuTable."  a ".
				"left join ".$this->DianzhuTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ";
		$result = Yii::app()->db->createCommand($sql)->query();
		$num=$result->rowCount;
		$criteria=new CDbCriteria();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=1;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$posts=$result->query();
	
		$this->render('dianzhu',array('pages'=>$pages,'posts'=>$posts,'num'=>$num));
	
	}
	/**
	 * 修改店主资料
	*/
	
	public function actionDianzhuEdit()
	{
		$mothod=Yii::app()->request;
		$bh=Yii::app()->request->getParam('bh');
		$sql="select distinct a.bh,a.tname,a.bank,a.acc,a.email,a.IdCard,a.addr,a.phone,a.tbh,(select count(tbh) from ".$this->DianzhuTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DianzhuTable."  a ".
				"left join ".$this->DianzhuTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ".
				"where a.bh=".$bh;
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		if ($_POST){
			$bh=$mothod->getParam('bh');
			$model=Designer::model()->findByAttributes(array('bh'=>$bh));
			$model->tname=$mothod->getParam('tname');
			$model->bank=$mothod->getParam('bank');
			$model->acc=$mothod->getParam('acc');
			$model->email=$mothod->getParam('email');
			$model->IdCard=$mothod->getParam('IdCard');
			$model->addr=$mothod->getParam('addr');
			$model->phone=$mothod->getParam('phone');
			if ($model->save()){
					$this->commonfun->message('更新成功', $this->upUrl, 0);
				}else{
					$this->commonfun->message('更新失败', $this->currentUrl, 2);
				}
			}
	
		$this->render('dianzhuedit',array('result'=>$result,'bh'=>$bh));
	}
	/**
	 * 审核店主
	 */
	public  function  actionDianzhuCk()
	{
		$mothod=Yii::app()->request;
		$bh=Yii::app()->request->getParam('bh');
		$sql="select distinct a.bh,a.tname as tname,a.bank,a.acc,a.email,a.IdCard,a.addr,a.phone,a.tbh,a.status,(select count(tbh) from ".$this->DianzhuTable." where tbh = a.bh) as bh2,c.name ".
				"from ".$this->DianzhuTable."  a ".
				"left join ".$this->DianzhuTable." b on a.bh=b.tbh ".
				"left join  ".$this->UserTable." c on a.UserBh=c.bh ".
				"where a.bh=".$bh;
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		if ($_POST){
			$bh=$mothod->getParam('bh');
			$model=Designer::model()->findByAttributes(array('bh'=>$bh));
			$status=$mothod->getParam('status');
			$model->status=(int)$status;
			if ($model->save()!=false){
				$this->commonfun->message('审核成功', $this->upUrl, 0);
			}
		}
	
		$this->render('dianzhuck',array('result'=>$result,'bh'=>$bh));
	}
	
	/**
	 * 删除店主
	*/
	public  function  actionDianzhuDel()
	{
		$bh=Yii::app()->request->getParam('bh');
		$vipinfo=Dianzhu::model()->findByAttributes(array('bh'=>$bh));
		$attributes=array('bh'=>$bh);
		if (Dianzhu::model()->deleteAllByAttributes($attributes)!=false){
			User::model()->deleteAllByAttributes(array('bh'=>$vipinfo->UserBh));
			$this->commonfun->message('删除成功', $this->upUrl, 0);
		}
	}
	
	
	/**
	 * 管理员修改信息
	 * 
	 */
	
	public function  actionUserinfo(){
		
		if ($_POST){
			$email=Yii::app()->request->getParam('email');
			$this->userinfo->user_email=$email;
			if ($this->userinfo->save()!=false){
				$this->commonfun->message('更新成功', $this->upUrl, 0);
			}else{
				$this->commonfun->message('更新失败', $this->currentUrl, 2);
			}
		}
		$this->render('userinfo');
	}
	
	
	/**
	 * 管理员修改密码
	 *
	 */
	
	public function  actionPassword(){
		$mothod=Yii::app()->request;
		if ($_POST){
			$ckpwd=$this->userinfo->user_pass;
			$pwd=$mothod->getParam('pwd');
			$newpwd=$mothod->getParam('newpwd');
			$repwd=$mothod->getParam('repwd');
			
			$newpwd=md5(md5(md5($newpwd.$this->userinfo->salt)));
			$repwd=md5(md5(md5($repwd.$this->userinfo->salt)));
			$pwd=md5(md5(md5($pwd.$this->userinfo->salt)));
			
			if ($newpwd!=$repwd || !$pwd || !$newpwd || $pwd!=$ckpwd){
				$this->redirect(array('password'));
			}
			
			$this->userinfo->user_pass=$newpwd;
			
			if ($this->userinfo->save()!=false){
				$this->commonfun->message('更新成功', 'index.php?r=user/userinfo', 0);
			}else{
				$this->commonfun->message('更新失败', 'index.php?r=user/password', 2);
			}
			$this->redirect('user/userinfo');
			
		}
		$this->render('password');
	}
	
	
	
	
	
}