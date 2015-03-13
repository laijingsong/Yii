<?php
/**
 * 支付类
 */
class Pay 
{
	private static  $_pay='';
	public  function __construct($api)
	{
		//设置支付接口
		self::setApi($api);
	}
	
	/**
	 * 实例化支付接口
	 */
	private static function setApi($api)
	{
		self::$_pay=new $api();
		if(!self::$_pay)
			echo "不支持的支付接口";
	}
	
	public function __call($method, $arguments) {
		if (method_exists($this, $method)) {
			return call_user_func_array(array(&$this, $method), $arguments);
		} elseif (!empty(self::$_pay) && self::$_pay instanceof PayApi && method_exists(self::$_pay, $method)) {
			return call_user_func_array(array(&self::$_pay, $method), $arguments);
		}
	}
	
}
