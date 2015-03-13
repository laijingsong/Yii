<?php
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe=false;
	private $_identity;
	
	public function rules()
	{
		/*return array(
				array('user_login, user_pass', 'required'),
				array('rememberMe','boolean'),
				array('user_pass','authenticate'),
		);*/
		
		return array(
				// username and password are required
				array('username, password', 'required'),
				// rememberMe needs to be a boolean
				array('rememberMe', 'boolean'),
				// password needs to be authenticated
				array('password', 'authenticate'),
		);
	}
	
	
	public function authenticate($attribute,$params)
	
	{
	
		$this->_identity=new UserIdentity($this->username,$this->password);
	
		if(!$this->_identity->authenticate())
	
			$this->addError('password','错误的用户名或密码。');
	
	}
	
	
	
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