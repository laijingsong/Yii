<?php
/**
 * @name 新版默认首页控制器基类
 * @author jun
*/
class IController extends Controller
{
	
	public $main;
	public $shopTitle;
	public $userinfo;
	public $commonfun;
	public $currentUrl;
	public $upUrl;
	public function filters() {
		return array(
			array('application.filters.AdminFilter')
		);
	}
	
	public function init()
	{
		$this->commonfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
		$this->currentUrl=Yii::app()->request->getUrl();
		$this->upUrl=Yii::app()->request->urlReferrer;
		if(isset(Yii::app()->session['ADMIN_ID'])){
			$user=new Ad();
			$id=$_SESSION['ADMIN_ID'];
			$attributes=array('id'=>$id);
			$this->userinfo=$user->findByAttributes($attributes);
		}
	}
	
	function  check_access($uid){
		if($uid == 1){
    		return true;
    	}else{
    		$name=$this->getId();
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
	}
	
	/**
	 * 弹出错误
	 */
	function printerror($error='',$gotourl=''){
		header("Content-type:text/html;charset=utf-8");
		if(strstr($gotourl,"(")||empty($gotourl))
		{
			if(strstr($gotourl,"(-2"))
			{
				$gotourl_js="history.go(-2)";
				$gotourl="javascript:history.go(-2)";
			}
			else
			{
				$gotourl_js="history.go(-1)";
				$gotourl="javascript:history.go(-1)";
			}
		}
		else
		{
			$gotourl_js="self.location.href='$gotourl';";
		}
	
		echo"<script>alert('".$error."');".$gotourl_js."</script>";
		exit();
	}
	
}