<?php
class LoginFormbk extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe=false;
	private $_identity;
	
	public function rules()
	{
		return array(
				array('user_login, user_pass', 'required'),
				array('rememberMe','boolean'),
				array('user_pass','authenticate'),);
	}
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{users}}";
	}
	
	//private function authenticate(){
	//	$this->addError($attribute, $error)
	//}
	
	public function getMenu($parentid=0){
		$array=array();
		$criteria=new CDbCriteria();
		
		//$criteria->select='id,classid,title,productpic,userid,store_id';
		$criteria->condition='parentid=".$parentid."';
		$criteria->order='id desc';
		$row = self::model()->findAll($criteria);
		foreach ($row as $k=> $v){
			
			$array[$v['id']]=$v->attributes;
		}
		return $array;
	}
}