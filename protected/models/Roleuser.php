<?php
class Roleuser extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{role_user}}";
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
	
	public function getRoleids($id){
		if (empty($id))
			return  ;
		$arr=array();
		$sql="select * from {{role_user}} where user_id='$id'  ";
		$row=Yii::app()->db->createCommand($sql)->queryAll();
		foreach ($row as $v){
			array_push($arr, $v['role_id']);
		}
		return $arr;
	}
	
}