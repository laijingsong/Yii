<?php
class Actives extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{ddc_dp_activity}}";
	}
	
	public function getTop($dpid){
		$criteria=new CDbCriteria();
		$criteria->condition='dpid="'.$dpid.'" and istop=1';
		$criteria->order='id desc';
		$criteria->limit='1';
		$row = self::model()->find($criteria);
		return $row;
	}
}