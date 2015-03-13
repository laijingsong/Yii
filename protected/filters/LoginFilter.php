<?php
/**
 * 未登录用户
 */
class LoginFilter extends CFilter
{
	protected function preFilter ($filterChain) 
	{
		$uid=Controller::getUid();
		if(!$uid)
		{
			header('Location: http://www.ddchina.cc/e/member/login');
		}
		else
		{
			return true;
		}
	}
}