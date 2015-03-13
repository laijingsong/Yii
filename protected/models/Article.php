<?php
/*
 * @name 
 * @author lcj
 */
class Article extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{article}}";
	}
	
	public function getarticle($bh,$param=false){
		$attributes=array('bh'=>$bh);
		$row=self::model()->findByAttributes($attributes);
		if ($param){
			$row=$row->attributes;
		}
		return $row;
	}
	

	
	public function  getmaxid(){
		$criteria=new CDbCriteria();
		$criteria->order='bh desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return false;
	}
	
	
	

}