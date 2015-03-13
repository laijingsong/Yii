<?php
class User extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{users}}";
	}
	

	
	
	
	
	public function getAlluser(){
		$array=array();
		$criteria=new CDbCriteria();
		//$criteria->condition='user_type=1';
		$criteria->order='id desc';
		$row = self::model()->findAll($criteria);
		foreach ($row as $v){
			$array[]=$v->attributes;
		}
		return $array;
	}
	
	

	public function getUser($id,$param=false){
		if (empty($id))
			return  ;
		$criteria=new CDbCriteria();
		$criteria->condition='id='.$id;
		$criteria->order='id desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($param)
			return $result->attributes;
		return $result;
	}
	

}