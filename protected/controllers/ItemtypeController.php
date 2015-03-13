<?php

/**
 * @name 商品分类管理类
 * @author yzj
 * @date 2015.3.1
 */
class ItemtypeController extends IController
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
		$model=new Itemtype();
		$allType=$model->getTypeTree();
		
		$this->render('index',array(
				'alltype'=>$allType
		));
	}
	
	/*
	 * 添加商品类型
	 */
	public  function  actionAdd()
	{
		$model=new Itemtype();
		$getmethod=Yii::app()->request;
		$maxid=$model->getmaxid();
		if ($_POST){
			$name=$getmethod->getParam('name');
			$des=$getmethod->getParam('des');
			$pbh=(int)$getmethod->getParam('pbh');
			$model->name=$name;
			$model->des=$des;
			$model->bh=(int)($maxid+1);
			$model->pbh=$pbh;
			if ($model->save()!=false){
				$this->redirect(array('itemtype/index'));
			}
		}
		//上级分类bh
		$topBh=(int)Yii::app()->request->getParam('bh');
		//查找一级分类
		$c=new Itemtype();
		$top=$c->getSubType();
		
		$this->render('add',array(
			'top'=>$top,
			'topBh'=>$topBh
		));
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
		
		$properymodel=new Itemproperty();
		if ($model->deleteAllByAttributes($attributes)!=false){
			$properymodel->deleteAllByAttributes(array('ItemBh'=>$bh));
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
		
		$sql="select iy.id,iy.bh,iy.name,iy.content,iy.des,ip.name as itemtype_name ".
				"from {{itemproperty}} iy ".
				"left join {{itemtype}} as ip on ip.bh=iy.ItemBh ".
				"where ItemBh=".$bh;
		
		$result = Yii::app()->db->createCommand($sql)->query();
		$criteria=new CDbCriteria();
		$num=$result->rowCount;
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$posts=$result->query();

		$this->render('sxlist',array('num'=>$num,'allcate'=>$posts,'pages'=>$pages,'bh'=>$bh));
		
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
				$this->redirect(array('itemtype/sxlist','bh'=>$bh));
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
		$sxinfo=$model->getsxinfo($sxid);
		//$sxinfo=$model->getsxinfo($sxid);
		$typeinfo=$type->bhgettype($bh);
		if ($_POST){
			$sxinfo->name=trim($_POST['name']);
			$sxinfo->content=trim($_POST['content']);
			$sxinfo->des=trim($_POST['des']);
			
			if ($sxinfo->save()!=false){
				$this->redirect(Yii::app()->request->urlReferrer);
			}
		}
	
		$this->render('sxlistedit',array('bh'=>$bh,'sxinfo'=>$sxinfo,'alltype'=>$alltype,'typeinfo'=>$typeinfo));
	}
	/*
	 * 删除属性
	 */
	
	public function  actionSxlistdel(){
		
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$sxid=$getmethod->getParam('sxid');
		
		$model=new Itemproperty();
		if ($model->deleteByPk($sxid)!=false){
			$this->redirect(Yii::app()->request->urlReferrer);
		}
		
	}
	
	
}