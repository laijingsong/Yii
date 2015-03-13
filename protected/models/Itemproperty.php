<?php
class Itemproperty extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{itemproperty}}";
	}
	
	public function getallcate($typeid){
		$array=array();
		$sql="select iy.id,iy.bh,iy.name,iy.content,iy.des,ip.name as itemtype_name ".
			"from {{itemproperty}} iy ".
			"left join {{itemtype}} as ip on ip.bh=iy.ItemBh ".
			"where ItemBh=".$typeid;
		//echo $sql;exit;
		$db = Yii::app()->db;
		$res = $db->createCommand($sql);
		$result = $res->queryAll();
		
		return $result;
		//return $result;
		
		//$criteria=new CDbCriteria();
		//$criteria->condition='ItemBh='.$typeid;
		//$criteria->order='id desc';
		//$row = self::model()->findAll($criteria);
		
	}
	
	public function getsxinfo($id,$param=false){
		$criteria=new CDbCriteria();
		$criteria->condition='ItemBh='.$id;
		$row = self::model()->find($criteria);
		//$row =self::model()->findByPk($id);
		if ($param){
			$row=$row->attributes;
		}
		return $row;
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