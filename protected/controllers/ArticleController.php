<?php
/**
 * @name 文章管理
 * @author lcj
 */
class ArticleController extends IController
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
		$criteria->select='bh,title,dateline';
		$criteria->order='bh desc';
		$count=Article::model()->count($criteria);
		$pages=new CPagination($count);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$allarticle=Article::model()->findAll($criteria);
		$this->render('index',array('pages'=>$pages,'allarticle'=>$allarticle));
	}
	
	
	/*
	 * 添加文章
	*/
	public  function  actionAdd()
	{
		$model=new Article();
		$getmethod=Yii::app()->request;
		$maxid=$model->getmaxid();
		if ($_POST){
			$title=$getmethod->getParam('title');
			$des=$getmethod->getParam('des');
			$c=$getmethod->getParam('c');
			$model->title=$title;
			$model->des=$des;
			$model->c=$c;
			$model->bh=(int)($maxid+1);
			$model->dateline=time();
			if ($model->save()!=false){
				$this->redirect(array('article/index'));
			}
		}
		$this->render('add');
	}	
	
	/*
	 * 删除文章
	*/
	public  function  actionDel()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$model=new  Article();
		$result=$model->deleteAllByAttributes(array('bh'=>$bh));
		
		if($result){
			$this->commonfun->message('删除成功', $this->upUrl, 0);
		}else{
			$this->commonfun->message('删除失败', $this->currentUrl, 0);
		}
		
	}
	/*
	 * 修改文章
	 */
	public function actionEdit()
	{
		$model=new Article();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$maxid=$model->getmaxid();
	
		$article=$model->getarticle($bh);
		if ($_POST){
			$title=$getmethod->getParam('title');
			$des=$getmethod->getParam('des');
			$c=$getmethod->getParam('c');
			$article->title=$title;
			$article->des=$des;
			$article->c=$c;
				
			if ($article->save()!=false){
				$this->redirect(array('article/index'));
			}
		}
		$this->render('edit',array('article'=>$article));
	}
	
}