<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
	/**
	 * 登录用户ID
	 */
	protected static $uid;
	/**
	 * 登录用户信息
	 */
	protected static $u;
	
	public function init()
	{
		//登录状态
		self::loginInfo();
	}
	/**
	 * 登录状态
	 */
	public static function loginInfo()
	{
		//$id=Yii::app()->request->cookies['vrkmtmluserid'];
		$id=Yii::app()->request->cookies['wfjdlmluserid'];
		if($id)
		{
			self::$uid=$id;
			self::userInfo();
		}
	}
	
	/**
	 * 用户信息
	 */
	public static function userInfo()
	{
		if(empty(self::$uid))
			return false;
		$info=Member::model()->with('memberadd')->findByPk(self::$uid);
		$u['name']=$info->username;
		$u['id']=$info->userid;
		$u['pic']=$info->memberadd->userpic;
		self::$u=$u;
		return $u;
	}
	
	public static function getUid()
	{
		return self::$uid;
	}
}