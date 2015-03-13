<?php
class Item extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{item}}";
	}
	//获取所有商品
	public function getallitem($limit=0,$offset=0){
		//$array=array();
		//$page=new CPagination();
		//$page->pageSize=10;
		$sql="select item.bh,item.name,item.price,item.kh,item.pic,item.gg,item.cd,itemtype.name as itemtype_name,color.name as color_name,chima.name as chima_name,item.unit,item.pp,item.des ".
			"from {{item}} item ".
			"left join {{itemtype}} as itemtype on item.ItemTypeBh=itemtype.bh ".
			"left join {{color}} as color on item.ColorBh=color.bh ".
			"left join {{chima}} as chima on item.ChiMaBh=chima.bh ";
		
		$db = Yii::app()->db;
		$res = $db->createCommand($sql);
		$result = $res->queryAll();
		return $result;
		
		//$criteria=new CDbCriteria();
		//$criteria->order='id desc';
		
		//$row = self::model()->findAll($criteria);
		//foreach ($row as $v){
		//	$array[]=$v->attributes;
		//}
		//return $array;
	}
	//获取单个商品
	public function getitem($bh,$param=false){
		$criteria=new CDbCriteria();
		
		//$criteria->select='name,kh,pic,gg,cd,SupBh,ColorBh,ChiMaBh,unit,pp,des,t.id,t.classid,t.title,t.productpic,t.userid,t.store_id';
		$criteria->condition='bh='.$bh;
		//$criteria->join='inner join {{itemtype}} as itemtype on t.id=shopdd_add.goods_id inner join {{enewsshopdd}} as shopdd on shopdd_add.ddid=shopdd.ddid';
		$result = self::model()->find($criteria);
		if ($param){
			$result=$result->attributes;
		}
		return $result;
	}
	
	
	//根据typeid 获取bh；
	public  function  typeidgetbh($typeid){
		$criteria=new CDbCriteria();
		$criteria->condition='id='.$typeid;
		$result = self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return false;
		
	}
	
	public  function  bhgettype($bh){
		$criteria=new CDbCriteria();
		$criteria->condition='bh='.$bh;
		$result = self::model()->find($criteria);
		if ($result)
			return $result->attributes;
		return false;
	
	}
	
	
	
	
	public function  getmaxid(){
		$criteria=new CDbCriteria();
		$criteria->order='id desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return false;
	}
	
	
	

}