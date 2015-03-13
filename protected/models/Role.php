<?php
class Role extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{role}}";
	}

	public function getRole(){
		$array=array();
		$criteria=new CDbCriteria();
		$criteria->order='id desc';
		$row = self::model()->findAll($criteria);
		foreach ($row as $v){
			$array[]=$v->attributes;
		}
		return $array;
	}
	
	public function getRoleOne($id){
		if (empty($id)){
			return ;
		}
		$criteria=new CDbCriteria();
		$criteria->condition='id='.$id;
		//$criteria->order='id desc';
		$criteria->limit='1';
		$row = self::model()->find($criteria)->attributes;
		
		return $row;
	}
	
}