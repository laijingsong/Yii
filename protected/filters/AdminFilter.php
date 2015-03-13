<?php
/**
 * 管理员权限
 */
class AdminFilter extends CFilter {
    protected function preFilter ($filterChain) {
    	$commonfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
    	if(isset(Yii::app()->session['ADMIN_ID'])){
    		$user=new Ad();
    		$id=$_SESSION['ADMIN_ID'];
    		$attributes=array('id'=>$id);
    		$userinfo=$user->findByAttributes($attributes);
    		if (!$userinfo['id']){
    			$gotourl_js='index.php?r=login/index';
    			$commonfun->message('您还没有登录，请登录！', $gotourl_js, 0);
    		}else{
    			return true;
    		}
    	}else{   		
    		$commonfun->message('您还没有登录，请登录！', 'index.php?r=login/index', 0);
    	}
    		
    	//$user = Users::model()->find('userid=:userid', array(':userid'=>Yii::app()->user->getId()));
    	//if(!$user['id']) {
    	//	$commonfun->message('您不是管理员无权操作！', 'index.php', 0);
    	//} else {
    	//	return true; // false if the action should not be executed
    	//}
    }
    
    
    function  check_access($uid){
    	if($uid == 1){
    		return true;
    	}else{
    		$name='';
    		$this->check($uid, $name);
    	}
    	 
    	 
    }
    
    public function check($uid,$name,$relation='or') {
    	if($uid==1){
    		return true;
    	}
    	return true;
    	/*if (is_string($name)) {
    	 $name = strtolower($name);
    	if (strpos($name, ',') !== false) {
    	$name = explode(',', $name);
    	} else {
    	$name = array($name);
    	}
    	}*/
    	$list = array(); //保存验证通过的规则名
    
    	$role_user_model=new Roleuser();
    
    
    	$groups=$role_user_model->findAllByAttributes(array('user_id'=>$uid));
    	$array=array();
    	foreach ($groups as $v){
    		array_push($array, $v->attributes['role_id']);
    	}
    	if(in_array(1, $array)){
    		return true;
    	}
    
    	/*$role_model=M("Role");
    
    	$groups=$role_model->where(array("id"=>array("in",$groups),"status"=>1))->getField("id",true);
    
    	$auth_access_model=M("AuthAccess");
    
    	$join = C('DB_PREFIX').'auth_rule as b on a.rule_name =b.name';
    
    	$rules=$auth_access_model->alias("a")->join($join)->where(array("a.role_id"=>array("in",$groups),"b.name"=>array("in",$name)))->select();
    
    	foreach ($rules as $rule){
    	if (!empty($rule['condition'])) { //根据condition进行验证
    	$user = $this->getUserInfo($uid);//获取用户信息,一维数组
    		
    	$command = preg_replace('/\{(\w*?)\}/', '$user[\'\\1\']', $rule['condition']);
    	//dump($command);//debug
    	@(eval('$condition=(' . $command . ');'));
    	if ($condition) {
    	$list[] = strtolower($rule['name']);
    	}
    	}else{
    	$list[] = strtolower($rule['name']);
    	}
    	}
    
    	if ($relation == 'or' and !empty($list)) {
    	return true;
    	}
    	$diff = array_diff($name, $list);
    	if ($relation == 'and' and empty($diff)) {
    	return true;
    	}*/
    	//return false;
    }

    protected function postFilter ($filterChain) {
    	
    }
}