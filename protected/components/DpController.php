<?php
/**
 * @name 店铺控制器基类
 * @author gm
*/
class DpController extends Controller
{
	public $dpid;
	public $dpnumber;
	protected $dpinfo;
	protected $province;
	protected $city;
	
	public $main;
	public $shopTitle;

	
	public function init()
	{
		$this->dpnumber = Yii::app()->request->getParam('number');
		$this->dpid = Yii::app()->request->getParam('dpid');
		$this->layout = '//layouts/column1';	
		$this->dpinfo = Dp::getDpInfo($this->dpnumber,$this->dpid);//店铺信息+联系信息
		$this->dpid = $this->dpid?$this->dpid:$this->dpinfo['id'];
		if(empty($this->dpid) || empty($this->dpinfo['status'])) $this->printerror('店铺信息不存在');
		$this->province = DCache::system('_jprovince');
		$this->city = DCache::system('_jcity');
		
		$this->main = true;
		
	}
	
	/**
	 * 评论列表
	 */
	public function getComment($id,$type=0,$limit=5)
	{
		$criteria=new CDbCriteria();
		if($type==0)
			$criteria->addCondition('dpid='.$id);
		else
			$criteria->addCondition('fdid='.$id);
		$criteria->limit=$limit;
		$criteria->with='commentreply';
		$list=Comment::model()->findAll($criteria);
		return $list;
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