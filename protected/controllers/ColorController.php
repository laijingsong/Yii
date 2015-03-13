<?php

/**
 * @name 颜色管理
 * 
 */
class ColorController extends IController
{
	public function init()
	{
		parent::init();
	}
	
	
	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		$criteria=new CDbCriteria();
		$criteria->select='bh,pbh,name,v,des';
		$criteria->condition='pbh=0';
		$count=Color::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$allcolor=Color::model()->findAll($criteria);
		$this->render('index',array('num'=>$count,'pages'=>$pages,'allcolor'=>$allcolor));
	}
	/*
	 * 添加颜色
	 */
	
	public  function  actionAdd()
	{
		$model=new Color();
		$getmethod=Yii::app()->request;
		
		$maxid=$model->getmaxid();
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$model->name=$name;
			$model->des=$des;
			$model->v=$v;
			$model->bh=(int)($maxid+1);
			
			if ($model->save()!=false){
				$this->redirect(array('color/index'));
			}
		}
		$this->render('add');
	}
	/*
	 * 修改颜色
	 */
	
	public function actionEdit()
	{
		$model=new Color();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$maxid=$model->getmaxid();

		$color=$model->getcolor($bh);
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$color->name=$name;
			$color->des=$des;
			$color->v=$v;
			
			if ($color->save()!=false){
				$this->redirect(array('color/index'));
			}
		}
		$this->render('edit',array('color'=>$color));
	}
	/*
	 * 删除颜色
	 */
	public  function  actionDel()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$model=new  Color();
		
		if ($model->deleteAllByAttributes(array('bh'=>$bh))!=false){
			$model->deleteAllByAttributes(array('pbh'=>$bh));
			$this->redirect(array('color/index'));
		}
	}
	
	/*
	 * 颜色子类
	*/
	public function  actionIndexson(){
		$pbh=Yii::app()->request->getParam('pbh');
		
		$criteria=new CDbCriteria();
		$criteria->select='bh,pbh,name,v,des';
		$criteria->condition='pbh='.$pbh;
		$count=Color::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$result=Color::model()->findAll($criteria);
		$this->render('indexson',array('num'=>$count,'result'=>$result,'pbh'=>$pbh,'pages'=>$pages));
	}
	
	/*
	 * 添加子类颜色
	*/
	
	public  function  actionAddson()
	{
	
		$colorid=Yii::app()->request->getParam('pbh');
		$model=new Color();
		$getmethod=Yii::app()->request;
	
		$color=$model->getcolor($colorid);
		$maxid=$model->getmaxid();
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$pbh=$getmethod->getParam('pbh');
			$model->name=$name;
			$model->des=$des;
			$model->v=$v;
			$model->bh=(int)($maxid+1);
			$model->pbh=(int)$pbh;
			if ($model->save()!=false){
				$this->redirect(array('color/indexson','pbh'=>$pbh));
			}
		}
		$this->render('addson',array('color'=>$color,'colorid'=>$colorid));
	}
	
	/*
	 * 修改子类颜色
	*/
	
	public function actionEditson()
	{
		$model=new Color();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
	
		$color=$model->getcolor($bh);
		if ($_POST){
			$colorid=$getmethod->getParam('colorid');
			$pbh=(int)trim($_POST['pbh']);
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$color->name=$name;
			$color->des=$des;
			$color->v=$v;
			if ($color->save()!=false){
				$this->redirect(array('color/indexson','pbh'=>$colorid));
			}
		}
		$this->render('editson',array('color'=>$color));
	}
	
	/*
	 * 删除子类颜色
	*/
	public  function  actionDelson()
	{
		$getmethod=Yii::app()->request;
		$pbh=$getmethod->getParam('colorid');
		$bh=$getmethod->getParam('bh');
		$model=new  Color();
		if ($model->deleteAllByAttributes(array('bh'=>$bh))!=false){
			$this->redirect(array('color/indexson','pbh'=>$pbh));
		}
	}
	
}