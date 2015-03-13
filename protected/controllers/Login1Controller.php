<?php

/**
 * @name
 * @author jun
 */
class LoginController extends IController
{
	public function init()
	{
		parent::init();
		$this->layout = '//layouts/Login';
	}
	
	
	/**
	 * @name 登录首页
	 */
	public function actionIndex()
	{
		$model=new  Users();
		//$roleinfo=$Role->getRole();
		//$thismonth=strtotime(date('Y-m-01'));
		
		$Count=5;
		
		$this->render('index',array('Count'=>$Count));
	}
	
	
	public function actionDologin()
	{
		$model=new Users();
		if (isset($_POST)){
			
			
			$username = isset($_POST['user_login']) ? trim($_POST['user_login']) : '';
			$password = isset($_POST['user_pass']) ? trim($_POST['user_pass']) : '';
			//$identify=new UserIdentity($username, $password);
			$errorMsg = '';
			if ($username && $password ){
				$attributes = array('user_login' => $username);
				$user = $model -> findByAttributes($attributes);
				if ($user) {
					$userpasswd=md5($password);
					
					if (empty($errorMsg)) {
						if ($userpasswd != $user -> user_pass) {
							// 登陆错误次数
							$errorMsg = '密码错误！';
							Yii::error($errorMsg,'',1);
							//echo '<script>alert("密码错误！")</script>';
							//$this -> redirect("/index.php?r=login/index",$errorMsg);
						} else {
							// 登陆成功，
							Yii::app()->session['user_login']=$user['user_login'];
							Yii::app() -> session['user_nicename'] = $user['user_nicename'];
							Yii::app() -> session['is_login'] = TRUE;
							Yii::app() -> session['visitor'] = $user;
							// 更新用户记录:登陆时间，最近一次IP，登陆次数等
							$user -> last_login_time = date('Y-m-d H:i:s');
							$user -> last_login_ip = Yii::app()->request->userHostAddress;
							$user -> save();
							// 重置登陆错误次数
							Yii::app() -> session['login_error_times'] = null;
							$this -> redirect("/index.php?r=rbac/index");
							return;
						}
					}
				}else{
					$errorMsg='该用户名不存在';
					$this -> redirect("/index.php?r=login/index",$errorMsg);
				}
			}elseif (empty($username)){
				$errorMsg='用户名为不能为空';
				$this -> redirect("/index.php?r=login/index",$errorMsg);
			}elseif (empty($password)){
				$errorMsg='密码为不能为空';
				$this -> redirect("/index.php?r=login/index",$errorMsg);
				return;
			}
			
			/*$model->attributes=$_POST;
			$model->create_time=date('Y-m-d H:i:s');
			$model->user_nicename=$_POST['user_login'];
			if ($model->validate()){
				$model->save();
				echo Yii::app()->user->returnUrl;exit;
				$this->redirect(Yii::app()->user->returnUrl);
			}*/
		}
		
	}
	
	
	
	
	
}