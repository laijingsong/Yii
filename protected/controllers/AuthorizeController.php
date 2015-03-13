<?php
/**
 * @name
 * @author jun
 */
class AuthorizeController extends IController
{
	public $getmethod;
	public function init()
	{
		$this->getmethod=Yii::app()->request;
		parent::init();
	}
	

	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		
		$menu=new Menus();
		$parentid=0;
		$result=Menus::getMenuOne($parentid);
		$this->render('index',array('result'=>$result));
	
	}
	
	//增加权限
	
	public function actionAdd()
	{
		$getmethod=Yii::app()->request;
		$menu=new Menus();
		 
		if ($_POST){
			$parentid=0;
			$name=$getmethod->getParam('name');
			$app=ucfirst($getmethod->getParam('app'));
			$model=ucfirst($getmethod->getParam('model'));
			$action=$getmethod->getParam('action');
			$status=$getmethod->getParam('status');
			$data=$getmethod->getParam('data');
			$remark=$getmethod->getParam('remark');
			
			$menu->name=$name;
			$menu->app=$app;
			$menu->model=$model;
			$menu->action=$action;
			$menu->status=$status;
			$menu->data=$data;
			$menu->remark=$remark;
			$menu->parentid =0;
			
			$menu->save();
			$this->redirect(array('authorize/index'));
			
		}
		$this->render('add');
		
	}
	
	
	/**
	 * 修改权限
	 */
	
	public function actionEdit()
	{
		$menu=new  Menus();
		$id=Yii::app()->request->getParam('id');
		$attributes=array('id'=>$id);
		$result=$menu->findByAttributes($attributes);
		if ($_POST){
			$id=$this->getmethod->getParam('id');
			$name=$this->getmethod->getParam('name');
			$app=ucfirst($this->getmethod->getParam('app'));
			$model=ucfirst($this->getmethod->getParam('model'));
			$action=$this->getmethod->getParam('action');
			$status=$this->getmethod->getParam('status');
			$data=$this->getmethod->getParam('data');
			$remark=$this->getmethod->getParam('remark');
			
			$result->name=$name;
			$result->app=$app;
			$result->model=$model;
			$result->action=$action;
			$result->status=$status;
			$result->data=$data;
			$result->remark=$remark;
			$result->save();
			$this->redirect(array('Authorize/edit','id'=>$id));
	
		}
		$this->render('edit',array('result'=>$result,'id'=>$id));
	}
	
	
	/**
	 * 删除权限
	 */
	function  actionDel(){
		$menu=new Menus();
		$id=Yii::app()->request->getParam('id');
		$this->_deleteSubNode($id);
		$this->redirect(array('authorize/index'));
	}
	
	private  function _deleteSubNode($ids){
		$subNodes = array();
		$mod = new Menus();
		foreach (explode ( ',', $ids ) as $k){
			$mod->deleteAllByAttributes(array('id'=>$k));
			$res = $this->_getSubNode($k,$subNodes[$k],$mod);  //获取子节点
			if(!empty($res[0])){
				foreach($res as $k => $nid){
					$mod->deleteAllByAttributes(array('id'=>$nid)); //删除子节点   
				}
			}
		}
	}
	
	private function _getSubNode($id, &$arr,$mod){
		$attributes = array ('parentid' => $id);
		$ret=$mod->findAllByAttributes($attributes);
		
		if(!empty($ret)){
			foreach ($ret as $k => $node){
				$arr[] = $node->id;
				$this->_getSubNode($node->id, $arr, $mod);
			}
		}
		return $arr;
	}
	
	
	/**
	 * 删除菜单及下级菜单
	 * @param unknown $pk
	 * @return boolean
	 */
	function  delMenu($pk){
		$menu=new Menus();
		if ($menu->findByPk($pk)==false){
			return true;
		}else{
			$result=$menu->findByPk($pk);
			
			if (!$result){
				return false;
			}else{
				
				$pid=$result->parentid;
				echo $pid;exit;
				//$menu->deleteAllByAttributes(array('id'=>$pk));
				if ($pid!=0){
					
					$menu->deleteAllByAttributes(array('parentid'=>$pid));
					$this->delMenu($pk);
				}
				return true;
			}
			
			
		}
	}
	
	/**
	 * 权限子类展示
	 */
	function  actionSonindex(){
		$menu=new Menus();
		$id=$this->getmethod->getParam('id');
		$presult=$menu->findByPk($id);
		$result=Menus::getMenuOne($id);
		$this->render('sonindex',array('id'=>$id,'result'=>$result,'presult'=>$presult));
		
	}
	
	/**
	 * 增加子类权限
	 */
	
	function  actionSonadd(){
		$menu=new Menus();
		$id=$this->getmethod->getParam('id');
		$getmethod=Yii::app()->request;
		if ($_POST){
			$parentid=$getmethod->getParam('id');
			
			$name=$getmethod->getParam('name');
			$app=ucfirst($getmethod->getParam('app'));
			$model=ucfirst($getmethod->getParam('model'));
			$action=$getmethod->getParam('action');
			$status=$getmethod->getParam('status');
			$data=$getmethod->getParam('data');
			$remark=$getmethod->getParam('remark');
				
			$menu->name=$name;
			$menu->app=$app;
			$menu->model=$model;
			$menu->action=$action;
			$menu->status=$status;
			$menu->data=$data;
			$menu->remark=$remark;
			$menu->parentid =$parentid;
				
			if ($menu->save()!=false){
				$this->redirect(array('authorize/sonindex','id'=>$parentid));
			}	
		}
		
		$presult=$menu->findByPk($id);
		$this->render('sonadd',array('id'=>$id,'presult'=>$presult));
	}
	
	
	/**
	 * 添加角色
	*/
	
	public function actionSonedit()
	{
		$menu=new  Menus();
		$id=Yii::app()->request->getParam('id');
		$attributes=array('id'=>$id);
		$result=$menu->findByAttributes($attributes);
		
		$presult=$menu->findByAttributes(array('id'=>$result['parentid']));
		if ($_POST){
			$id=$this->getmethod->getParam('id');
			$name=$this->getmethod->getParam('name');
			$app=ucfirst($this->getmethod->getParam('app'));
			$model=ucfirst($this->getmethod->getParam('model'));
			$action=$this->getmethod->getParam('action');
			$status=$this->getmethod->getParam('status');
			$data=$this->getmethod->getParam('data');
			$remark=$this->getmethod->getParam('remark');
				
			$result->name=$name;
			$result->app=$app;
			$result->model=$model;
			$result->action=$action;
			$result->status=$status;
			$result->data=$data;
			$result->remark=$remark;
			$result->save();
			$this->redirect(array('Authorize/sonedit','id'=>$id));
	
		}
		$this->render('sonedit',array('result'=>$result,'presult'=>$presult,'id'=>$id));
	}
	
	
}