<?php
class Ad extends CActiveRecord
{
	public $user_login;
	public $user_pass;
	public $user_type;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{ad}}";
	}
	
	public function rules()
	{
		return array(
			array('user_login,user_pass','required','message'=>'用户名不能为空'), 
			array('user_pass','required','message'=>'密码不能为空'),  
			//array('user_pass','compare','compareAttribute'=>'user_repass','message'=>'两次密码不一致'),
			array('user_email','email','message'=>'邮箱格式不正确')
		);
	}
	
	
	
	
	public function getAllAdmin(){
		$array=array();
		$criteria=new CDbCriteria();
		$criteria->condition='user_type=1';
		$criteria->order='id desc';
		$row = self::model()->findAll($criteria);
		foreach ($row as $v){
			$array[]=$v->attributes;
		}
		return $array;
	}
	
	
	
	public function getAdmin($id,$param=true){
		if (empty($id))
			return  ;
		
		$criteria=new CDbCriteria();
		$criteria->condition='user_type=1 and id='.$id;
		$criteria->order='id desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($param)
			return $result->attributes;
		return $result;
	}
	

}