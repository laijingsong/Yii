<?php
/**
*短消息发送
*@author su 
*/
class Message extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{message}}";
	}
	

	/**
	*短消息发送
	*@bh 编号
	*@title 标题
	*@content 内容
	*@ToUserBh 收件人
	*@FromUserBh  发送人
	*/
	public function send($bh,$title,$content,$ToUserBh,$des,$FromUserBh='0'){
		
		$this->bh = $bh;
		$this->title = $title;
		$this->content = $content;
		$this->ToUserBh = $ToUserBh;
		$this->FromUserBh = $FromUserBh;
		$this->dateline = time();
		return $this->save();
	}
	
	public function getAll(){
		$row = self::model()->findAll();
		foreach ($row as $v){
			$array[]=$v->attributes;
		}
		return $array;
	}
	
	public function  getMaxBh(){
		$criteria=new CDbCriteria();
		$criteria->order='id desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return;
	}
}