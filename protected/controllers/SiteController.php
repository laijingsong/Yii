<?php
/**
 * @name 店铺首页
 * @author lason
 */
class SiteController extends DpController
{
	public $user;
	public function init()
	{
		parent::init();
		$this->user=self::$u;
		Yii::app()->theme='default';
		$this->layout = '//layouts/column1';
	}
	
	/**
	 * @name 首页
	 */
	public function actionIndex()
	{
		$order=Yii::app()->request->getParam('order');
		$style=Yii::app()->request->getParam('style');
		$cityid=(int)Yii::app()->request->getParam('city');
		
		$criteria=new CDbCriteria();
		$criteria->condition='status=1';
		$criteria->with='dpcontact';
		if($style)
			$criteria->addCondition('style="'.$style.'"');
		if($cityid)
		{
			if(strpos($cityid, '00'))
				$criteria->addCondition('provinceid='.$cityid);
			else 
				$criteria->addCondition('cityid='.$cityid);
		}
		//分页
		$count=Dp::model()->count($criteria);
		$pager=new CPagination($count);
		$pager->pageSize='12';
		$pager->applyLimit($criteria);
		
		//列表
		switch ($order)
		{
			case 'collect':
				$criteria->order='collects';
				break;
			case 'new':
				$criteria->order='id desc';
				break;
			case 'follow':
				$criteria->order='follows';
				break;
			default:
				break;
		}
		$dpList=Dp::model()->findAll($criteria);
		
		$city=DCache::system('_jcity');
		$province=DCache::system('_jprovince');
		
		$this->render('index',array(
				'top'=>self::getTopShop(),
				'pages'=>$pager,
				'list'=>$dpList,
				'city'=>$city,
				'province'=>$province,
				'search'=>array("order"=>$order,"city"=>$cityid,"style"=>$style)
		));
	}
	
	/**
	 * 推荐店铺
	 */
	private function getTopShop()
	{
		$criteria=new CDbCriteria();
		$criteria->condition='istop=1';
		$criteria->order='id desc';
		$criteria->limit=5;
		$topDp=Dp::model()->findAll($criteria);
		return $topDp;
	}
	
	/**
	 * ajax获取城市列表
	 */
	public function actionGetCity()
	{
		$id=Yii::app()->request->getParam('id');
		$city=DCache::system('_city');
		$list=$city[$id];
		if(!is_array($list))
			exit('{"code":"-100","msg":"未找到相关数据"}');
		$data="<option value=>选择市</option>";
		foreach ($list as $k=>$v)
			$data.="<option value=$k>$v</option>";

		exit('{"code":"0","msg":"ok","d":"'.$data.'"}');
	}
	
	public function actionTest()
	{
		
	}
}