<?php
/**
 * @name 商品尺码管理
 * @author jun
 */
class ChimaController extends IController
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
		$count=Chima::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$allchima=Chima::model()->findAll($criteria);
		$this->render('index',array('num'=>$count,'pages'=>$pages,'allchima'=>$allchima));
	}
	
	/*
	 * 添加尺码
	 */
	
	public  function  actionAdd()
	{
		$chimaid=Yii::app()->request->getParam('bh');
		
		$model=new Chima();
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
				$this->redirect(array('chima/index'));
			}
		}
		$this->render('add');
	}
	
	/*
	 * 修改尺码
	 */
	
	public function actionEdit()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		
		$chima=Chima::model()->getchima($bh);
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$chima->name=$name;
			$chima->des=$des;
			$chima->v=$v;
			if ($chima->save()!=false){
				$this->redirect(array('chima/index'));
			}
		}
		$this->render('edit',array('chima'=>$chima));
	}
	/*
	 * 删除尺码
	 */
	public  function  actionDel()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$model=new  Chima();
		
		if ($model->deleteAllByAttributes(array('bh'=>$bh))!=false){
			$model->deleteAllByAttributes(array('pbh'=>$bh));
			$this->redirect(array('chima/index'));
		}
	}
	
	/*
	 * 尺码子类
	 */
	public function  actionIndexson(){
		
		$pbh=Yii::app()->request->getParam('pbh');
		
		$criteria=new CDbCriteria();
		$criteria->select='bh,pbh,name,v,des';
		$criteria->condition='pbh='.$pbh;
		$count=Chima::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$result=Chima::model()->findAll($criteria);
		$this->render('indexson',array('num'=>$count,'result'=>$result,'pbh'=>$pbh,'pages'=>$pages));
	}
	
	/*
	 * 添加子类尺码
	*/
	
	public  function  actionAddson()
	{
	
		$chimaid=Yii::app()->request->getParam('pbh');	
		$model=new Chima();
		$getmethod=Yii::app()->request;
		
		$chima=$model->getchima($chimaid);
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
				$this->redirect(array('chima/indexson','pbh'=>$pbh));
			}
		}
		$this->render('addson',array('chima'=>$chima,'chimaid'=>$chimaid));
	}
	
	/*
	 * 修改子类尺码
	*/
	
	public function actionEditson()
	{
		$model=new chima();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
	
		$chima=$model->getchima($bh);
		if ($_POST){
			
			$chimaid=$getmethod->getParam('chimaid');
			$pbh=(int)trim($_POST['pbh']);
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$v=$getmethod->getParam('v');
			$chima->name=$name;
			$chima->des=$des;
			$chima->v=$v;
			if ($chima->save()!=false){
				$this->redirect(array('chima/indexson','pbh'=>$chimaid));
			}
		}
		$this->render('editson',array('chima'=>$chima));
	}
	
	/*
	 * 删除子类尺码
	*/
	public  function  actionDelson()
	{
		$getmethod=Yii::app()->request;
		$pbh=$getmethod->getParam('chimaid');
		$bh=$getmethod->getParam('bh');
		$model=new  Chima();
		if ($model->deleteAllByAttributes(array('bh'=>$bh))!=false){
			$this->redirect(array('chima/indexson','pbh'=>$pbh));
		}
	}
	
}