<?php
/**
 * @name
 * @author jun
 */
class RbacController extends IController
{
	public function init()
	{
		parent::init();
	}
	
	function current_week ($date_of_firstday='2015-1-1'){
		//开学第一天的时间戳
		$year = substr($date_of_firstday,0,4);
		$month = substr($date_of_firstday,5,1);
		$day = substr($date_of_firstday,7,2);
		$time_chuo_of_first_day = mktime(0,0,0,$month,$day,$year);
		//今天的时间戳
		$month = date('n'); //获取月 n
		$day = date('d');   //获取日 d
		$year = date('Y');  //获取年 Y
		$time_chuo_of_current_day = mktime(0,0,0,$month,$day,$year);
		$cha = ($time_chuo_of_current_day-$time_chuo_of_first_day)/60/60/24;
		$zhou = (int)(($cha)/7 +1);
		return $zhou;
	}
	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		$Role=new  Role();
		$roleinfo=$Role->getRole();
		$this->render('index',array('roleinfo'=>$roleinfo));
	}
	/*
	 * 添加角色
	 */
	
	public function actionAddrole()
	{
		$Role=new  Role();
		if ($_POST){
			$Role->name=trim($_POST['name']);
			$Role->remark=trim($_POST['remark']);
			$Role->status=trim($_POST['status']);
			$Role->create_time=time();
			$Role->save();
			$this->redirect(Yii::app()->user->returnUrl);
	
		}
		$this->render('addrole');
	}
	
	
	/*
	 * 修改角色
	 */
	
	public function actionEditrole()
	{
		$Role=new  Role();
		$roleid=(int)trim($_GET['roleid']);
		$roleinfo=$Role->getRoleOne($roleid);
		
		$attributes=array('id'=>$roleid);
		$info = $Role -> findByAttributes($attributes);
		if ($_POST){
			$info->name=trim($_POST['name']);
			$info->remark=trim($_POST['remark']);
			$info->status=trim($_POST['status']);
			$info->update_time=time();
			
			$info->save();
			$this->redirect(Yii::app()->user->returnUrl);			
	
		}
		
		$this->render('editrole',array('roleinfo'=>$roleinfo));
	}
	
	/*
	 * 删除角色
	 */
	public function actionDelrole()
	{
		
		$roleid=Yii::app()->request->getParam('roleid');
		if ($roleid==1){
			$this->error('');
		}else{
			$Role=new  Role();
			$Role->deleteByPk($roleid);
			$this->redirect(Yii::app()->user->returnUrl);
		}
	}
	
	//角色授权显示
	public function actionAuthorize()
	{
		
		$app=Yii::app()->request;
		$roleid=$app->getParam('id');
		if (!$roleid){
			echo '参数错误!';exit;
		}
		//$this->auth_access_model = D("Common/AuthAccess");
		
		$authaccess=new Authaccess();
		$attributes=array("role_id"=>$roleid);
		$priv_data=$authaccess->findAllByAttributes($attributes);
		$arr_rule=array();
		foreach ($priv_data as $key=> $data){
			$arr_rule[$key]=$data['rule_name'];
		}
		header("Content-type: text/html; charset=utf-8");
		Yii::import('application.components.Tree');
		$Tree=new Tree();
		$Tree->icon=array('│ ', '├─ ', '└─ ');
		$Tree->nbsp = '&nbsp;&nbsp;&nbsp;';

		$menu=new Menus();
		$result=$menu->getMenu();
		$newmenus=array();
		foreach ($result as $m){
			$newmenus[$m['id']]=$m;
		}
		foreach ($result as $n =>$t){
			foreach ($result as $n => $t) {
				$result[$n]['checked'] = ($this->_is_checked($t, $roleid, $arr_rule)) ? ' checked' : '';
				$result[$n]['level'] = $this->_get_level($t['id'], $newmenus);
				$result[$n]['parentid_node'] = ($t['parentid']) ? ' class="child-of-node-' . $t['parentid'] . '"' : '';
			}
		}
		$str = "<tr id='node-\$id' \$parentid_node>
                       <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='menuid[]' value='\$id' level='\$level' \$checked onclick='javascript:checknode(this);'> \$name</td>
    			</tr>";
		
		$Tree->init($result);
		$categorys = $Tree->get_tree(0, $str);
		$Count=5;
		//$this->layout = '//layouts/rbac';
		$this->render('authorize',array('Count'=>$Count,'categorys'=>$categorys,'roleid'=>$roleid));
	}
	
	/**
	 * 角色授权
	 */
	public function actionAuthorize_post() {
		 
		if ($_POST) {
			header("Content-type: text/html; charset=utf-8");
			$app=Yii::app()->request;
			$roleid=(int)trim($_POST['roleid']);

			//if(!$roleid){
				//exit("需要授权的角色不存在！");
				//$this->error("需要授权的角色不存在！");
			//}
			if (is_array($_POST['menuid']) && count($_POST['menuid'])>0) {
				$menu_model=new Menus();
				$auth_rule_model=new Authaccess();
				
				$auth_rule_model->deleteAllByAttributes(array("role_id"=>$roleid,'type'=>'admin_url'));
				foreach ($_POST['menuid'] as $menuid) {
					$menu=$menu_model->findByPk($menuid)->attributes;
					if($menu){
						$app=$menu['app'];
						$model=$menu['model'];
						$action=$menu['action'];
						$name=strtolower("$app/$model/$action");
						$type="admin_url";
						$sql="insert into cs_auth_access (role_id,rule_name,type) values('$roleid','$name','$type')";
						Yii::app()->db->createCommand($sql)->execute();
					}
				}
				$this->redirect(array('rbac/index'));
			}else{
				//当没有数据时，清除当前角色授权
				
				$auth_rule_model->deleteAllByAttributes(array("role_id"=>$roleid,'type'=>'admin_url'));
				$this->redirect(array('rbac/index'));
			}
		}
	}
	
	/**
	 * 获取菜单深度
	 * @param $id
	 * @param $array
	 * @param $i
	 */
	protected function _get_level($id, $array = array(), $i = 0) {
	
		if ($array[$id]['parentid']==0 || empty($array[$array[$id]['parentid']]) || $array[$id]['parentid']==$id){
			return  $i;
		}else{
			$i++;
			return $this->_get_level($array[$id]['parentid'],$array,$i);
		}
	
	}
	
	
	/**
	 *  检查指定菜单是否有权限
	 * @param array $menu menu表中数组
	 * @param int $roleid 需要检查的角色ID
	 */
	private function _is_checked($menu, $roleid, $priv_data) {
		 
		$app=$menu['app'];
		$model=$menu['model'];
		$action=$menu['action'];
		$name=strtolower("$app/$model/$action");
		if($priv_data){
			if (in_array($name, $priv_data)) {
				return true;
			} else {
				return false;
			}
		}else{
			return false;
		}
		 
	}
	
	//增加角色权限
	
	public function actionAddauth()
	{
		$Menu=new Menus();
		$menus=$Menu->getMenu();
		$this->render('addauth',array('menus'=>$menus));
	}
	//用户登录
	
	public function  actionLoginform(){
		
		$model=new LoginForm();
		if (isset($_POST['username'])){
			$model->attributes=$_POST['username'];
			if ($model->validate()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$Count=5;
		//$this->layout = '//layouts/rbac';
		$this->render('loginform',array('model'=>$model));
	}
	
}