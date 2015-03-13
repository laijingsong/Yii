<?php

/**
 * @name 商品管理 
 * @author jun
 */
class ItemController extends IController
{
	public $commfun;//公共方法
	public $getmethod;
	public function init()
	{
		parent::init();
		$getmethod=Yii::app()->request;
		$this->commfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
	}
	
	
	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		$model=new Item();
		$getmethod=Yii::app()->request;
		$result=$model->getallitem();
		
		$sql="select item.bh,item.name,item.price,item.kh,item.pic,item.gg,item.cd,itemtype.name as itemtype_name,color.name as color_name,chima.name as chima_name,item.unit,item.pp,item.des ".
				"from {{item}} item ".
				"left join {{itemtype}} as itemtype on item.ItemTypeBh=itemtype.bh ".
				"left join {{color}} as color on item.ColorBh=color.bh ".
				"left join {{chima}} as chima on item.ChiMaBh=chima.bh ";
		$result = Yii::app()->db->createCommand($sql)->query();
		
		if ($_POST){
			$search=$getmethod->getParam('search');
			$tiaojian=$getmethod->getParam('tiaojian');
			$name=$getmethod->getParam('name'); //商品名称
			$ItemTypeBh=$getmethod->getParam('ItemTypeBh'); //类型名称
			$kh=$getmethod->getParam('kh'); //款号名称
			$ColorBh=$getmethod->getParam('ColorBh'); //颜色名称
			$ChiMaBh=$getmethod->getParam('ChiMaBh'); //尺码
			
			$sql="select it.bh,it.name,it.kh,it.pic,it.gg,it.cd,it.unit,it.pp,it.des,cl.name as color_name,itp.name as itemtype_name,ca.name as chima_name ".
					"from {{item}} it ".
					"left join {{color}} as cl on it.ColorBh=cl.bh ".
					"left join {{itemtype}} as itp on it.ItemTypeBh=itp.bh ".
					"left join {{chima}} as ca on it.ChiMaBh=ca.bh ";
			
			if ($tiaojian=='name' && $search){
				
				$sql.="where it.name  LIKE '%".$search ."%'";
			}
			if ($tiaojian=='ItemTypeBh' && $search){
				$sql.="where itp.name like '%".$search."%'";
			}
			if ($tiaojian=='kh' && $search){
				$sql.="where it.kh like '%".$search."%'";
			}
			if ($tiaojian=='ColorBh' && $search){
			
				$sql.="where cl.name like '%".$search."%'";
			}
			if ($tiaojian=='ChiMaBh' && $search){
					
				$sql.="where ca.name like '%".$search."%'";
			}
			$result = Yii::app()->db->createCommand($sql)->query();
		}
		$num=$result->rowCount;
		
		$criteria=new CDbCriteria();
		$pages=new CPagination($result->rowCount);
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$posts=$result->query();
		
		
		
		$allcolor=Color::getallcolor();
		$allchima=Chima::getallchima();
		$this->render('index',array('num'=>$num,'posts'=>$posts,'pages'=>$pages,'allcolor'=>$allcolor,'allchima'=>$allchima));
	}
	/*
	 * 添加商品
	 */
	
	public  function  actionAdd()
	{
		$model=new Item();
		$time=date('Y-m-d H:i:s');
		$getmethod=Yii::app()->request;
		$maxid=$model->getmaxid();
		
		$yanse=Color::getallcolor();
		$itemtype=Itemtype::getalltype();
		$chima=Chima::getallchima();
		if ($_POST){
			$name=$getmethod->getParam('name');
			$ItemTypeBh=$getmethod->getParam('ItemTypeBh');
			$SupBh=$getmethod->getParam('SupBh');
			$price=$getmethod->getParam('price');
			$ColorBh=$getmethod->getParam('ColorBh');
			$ChiMaBh=$getmethod->getParam('ChiMaBh');
			$kh=$getmethod->getParam('kh');
			$gg=$getmethod->getParam('gg');
			$cd=$getmethod->getParam('cd');
			$unit=$getmethod->getParam('unit');
			$pp=$getmethod->getParam('pp');
			$des=$getmethod->getParam('des');
			$tmp_path='attachment/item/';
			$pic=$this->commfun->uploadPicture($_FILES, 'myfile', 2097152, $tmp_path, 1, 'attachment/ddchina.gif', 9);
			$model->name=$name;
			$model->ItemTypeBh=$ItemTypeBh;
			$model->price=$price;
			$model->pic=$pic;
			$model->SupBh=$SupBh;
			$model->ColorBh=$ColorBh;
			$model->ChiMaBh=$ChiMaBh;
			$model->kh=$kh;
			$model->gg=$gg;
			$model->cd=$cd;
			$model->unit=$unit;
			$model->pp=$pp;
			$model->atime=$time;
			$model->des=$des;
			
			$model->bh=(int)($maxid+1);
			if ($model->save()!=false){
				$this->redirect(array('item/index'));
			}
		}
		$this->render('add',array('itemtype'=>$itemtype,'yanse'=>$yanse,'chima'=>$chima));
	}
	/*
	 * 修改商品
	 */
	
	public function actionEdit()
	{
		
		
		$model=new Item();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$item=$model->getitem($bh);
		$time=date('Y-m-d H:i:s');
		
		$yanse=Color::getallcolor();
		$itemtype=Itemtype::getalltype();
		$chima=Chima::getallchima();
		
		if ($_POST){
			$name=$getmethod->getParam('name');
			$ItemTypeBh=$getmethod->getParam('ItemTypeBh');
			$SupBh=$getmethod->getParam('SupBh');
			$price=$getmethod->getParam('price');
			
			$ColorBh=$getmethod->getParam('ColorBh');
			$ChiMaBh=$getmethod->getParam('ChiMaBh');
			$kh=$getmethod->getParam('kh');
			$gg=$getmethod->getParam('gg');
			$cd=$getmethod->getParam('cd');
			$unit=$getmethod->getParam('unit');
			$pp=$getmethod->getParam('pp');
			$des=$getmethod->getParam('des');
			$tmp_path='attachment/item/';
			if ($_FILES['myfile']['tmp_name']!=''){
				$pic=$this->commfun->uploadPicture($_FILES, 'myfile', 2097152, $tmp_path, 1, 'attachment/ddchina.gif', 9);
				unlink(Yii::app()->basePath.'/../'.$_POST['oldpic']);
			}
			$item->name=$name;
			$item->ItemTypeBh=$ItemTypeBh;
			$item->SupBh=$SupBh;
			$item->price=$price;
			$item->ColorBh=$ColorBh;
			$item->ChiMaBh=$ChiMaBh;
			$item->kh=$kh;
			$item->gg=$gg;
			$item->cd=$cd;
			if ($_FILES['myfile']['tmp_name']!='' && $pic ){
				$item->pic=$pic;
			}
			
			
			$item->unit=$unit;
			$item->pp=$pp;
			$item->atime=$time;
			$item->des=$des;
			
			if ($item->save()!=false){
				
				$this->redirect(array('item/index'));
			}
		}
		$this->render('edit',array('itemtype'=>$itemtype,'yanse'=>$yanse,'chima'=>$chima,'item'=>$item));
	}
	/*
	 * 删除商品
	 */
	public  function  actionDel()
	{
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$model=new  Item();
		$attributes=array('bh'=>$bh);
		
		$properymodel=new Itemproperty();
		$inventory=new Inventory();
		
		$res=$model->findByAttributes($attributes);
		
		if ($model->deleteAllByAttributes($attributes)!=false){
			//unlink($filename)
			if ($inventory->deleteAllByAttributes(array('ItemBh'=>$bh))!=false){
				
			}
			$this->redirect(array('item/index'));
		}

	}
	
	/*
	 * 库存
	 */
	public function actionKucun()
	{
		$model=new Inventory();
		$getmethod=Yii::app()->request;
		$bh=$getmethod->getParam('bh');
		$maxid=$model->getmaxid();
		
		$attributes=array('bh'=>$bh);
		$item=new Item();
		$result=$item->findByAttributes($attributes)->attributes;
		$kucun=$model->getkucun($bh);
		if ($_POST){
			$bh=$getmethod->getParam('bh');
			$re=$model->findByAttributes(array('bh'=>$bh));
			$ItemBh=$getmethod->getParam('ItemBh');
			$qty=$getmethod->getParam('qty');
			$price=$getmethod->getParam('price');
			$price2=$getmethod->getParam('price2');
			$price3=$getmethod->getParam('price3');
			$price4=$getmethod->getParam('price4');
			$dc=$getmethod->getParam('dc');
			
			if (!$re){
				$model->qty=$qty;
				$model->ItemBh=$ItemBh;
				$model->price=$price;
				$model->price2=$price2;
				$model->price3=$price3;
				$model->price4=$price4;
				$model->dc=$dc;
				$model->bh=(int)($maxid+1);
				if ($model->save()!=false){
					$this->redirect(array('item/kucun','bh'=>$bh));
				}
			}else{
				$re->qty=$qty;
				$re->ItemBh=$ItemBh;
				$re->price=$price;
				$re->price2=$price2;
				$re->price3=$price3;
				$re->price4=$price4;
				$re->dc=$dc;
				if ($re->save()!=false){
					$this->redirect(array('item/kucun','bh'=>$bh));
				}
			}
			
			
			
		}
		
		$this->render('kucun',array('bh'=>$bh,'kucun'=>$kucun,'item'=>$result));
	}
	
	
	
	
}