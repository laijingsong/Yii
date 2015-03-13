<?php

/**
 * @name 会员管理,设计师、店主管理
 * @author su
 */
class messageController extends IController
{
	public $getmethod;
	
	public function init()
	{
		
		date_default_timezone_set('Asia/shanghai'); 
		$this->getmethod=Yii::app()->request;
		parent::init();
	}

	/**
	 * 首页
	 */
	public function actionIndex()
	{
		$mode = new Message();
		$criteria = new CDbCriteria;
		$criteria->order = 'id DESC';
		$count = $mode->count($criteria);
		$pages = new CPagination($count);
		$pages->pageSize=2;
		$pages->applyLimit($criteria);
		$data = $mode->findAll($criteria);
		$this->render('index',array('data'=>$data,'pages'=>$pages,'num'=>$count));
		
	}
	/**
	*修改
	*/
	public function actionEdit(){
		$mode = new Message();
		$id = $this->getmethod->getParam("id");
		if($_POST){
			$arr = array(
					'title'=>$this->getmethod->getParam("title"),
					'ToUserBh'=>$this->getmethod->getParam("ToUserBh"),
					'content'=>$this->getmethod->getParam("content"),
					'des'=>$this->getmethod->getParam("des"),
			);
			$result = $mode->updateAll($arr,'id=:id',array(":id"=>$id));
			$this->redirect(array('message/index'));
			exit;
		}
		$data = $mode->findAll("id=:id",array(":id"=>$id));
		$this->render('edit',array('data'=>$data[0]));
		
		
	}
	
	/**
	*删除
	*/
	
	public function actionDel(){
		$mode = new Message();
		$commonfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
		$id = $this->getmethod->getParam("id");
		$result = $mode->deleteByPk($id);
		if($result)
			$commonfun->message('删除成功', 'index.php?r=message/index', 0);
		else
			$commonfun->message('删除失败', 'index.php?r=message/index', 0);
		
	}
	
	/**
	* 发送短信 -增加
	*/
	public function actionsend(){
		$mode = new Message();
		$commonfun = Yii::createComponent('application.components.CommonFunction');//组建的实例化方式
		if($_POST){
			$mode->bh=!empty($mode->getMaxBh())?($mode->getMaxBh()+1):1;
			$mode->FromUserBh=!empty($this->getmethod->getParam("FromUserBh"))?$this->getmethod->getParam("FromUserBh"):'0';
			$mode->ToUserBh=$this->getmethod->getParam("ToUserBh");
			$mode->title=$this->getmethod->getParam("title");
			$mode->content=$this->getmethod->getParam("content");
			$mode->des=$this->getmethod->getParam("des");
			$mode->dateline = time();
			$result = $mode->save();
			if($result)
				//$this->redirect(array('message/index'));
				$commonfun->message('添加成功', 'index.php?r=message/index', 0);
			else
				$commonfun->message('添加失败', 'index.php?r=message/index', 2);
			
		}
		$this->render('add');
	}
	
	
}