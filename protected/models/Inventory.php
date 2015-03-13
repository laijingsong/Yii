<?php
/**
 * 库存表
 * @author jun
 *
 */
class Inventory extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{inventory}}";
	}
	
	//获取单个商品的库存
	public function getkucun($bh,$param=false){
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