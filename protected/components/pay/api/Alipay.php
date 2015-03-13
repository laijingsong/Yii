<?php
/**
 * 支付宝接口
 */
class Alipay extends PayApi
{
	protected $gateway="https://mapi.alipay.com/gateway.do?_input_charset=utf-8";
	protected $verify_url = 'http://notify.alipay.com/trade/notify_query.do';
	public function __construct()
	{
		$this->getConfig();
	}
	
	/**
	 * 获取配置文件
	 * @see PayApi::getConfig()
	 */
	public function getConfig()
	{
		$this->config=Yii::app()->params['pay']['alipay'];
	}
	
	/**
	 * 生成表单
	 */
	public function buildResquestForm($vo)
	{
		$params = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($this->config['partner']),
				"payment_type"	=> 1,
				"notify_url"	=> $this->config['notify_url'],
				"return_url"	=> $this->config['return_url'],
				"seller_email"	=> $this->config['aliaccount'],
				"out_trade_no"	=> $vo->getOrderNo(),
				"subject"	=> $vo->getTitle(),
				"total_fee"	=> $vo->getFee(),
				"body"	=> $vo->getBody(),
				"_input_charset"	=> trim(strtolower($this->config['input_charset']))
		);
		
		ksort($params);
		reset($params);
		
		$arg='';
		foreach ($params as $k=>$v)
		{
			if($v)
				$arg.="$k=$v&";
		}
		
		$params['sign']=md5(substr($arg, 0,-1).$this->config['key']);
		$params['sign_type']='MD5';
		
		$formHtml=$this->_buildForm($params, $this->gateway);
		return $formHtml;
	}
	
	/**
	 * 验证
	 * @see PayApi::verify()
	 */
	public function verify($notify,$msg='')
	{
		if(empty($notify))
		{
			Yii::log('支付回执空','info','system.db.cart');
			return false;
		}
		else
		{
			$isSign = $this->getSignVeryfy($notify, $notify["sign"]);
			
			$responseTxt = 'true';
			if (! empty($notify["notify_id"])) {
				$responseTxt = $this->getResponse($notify["notify_id"]);
			}
				
			if (preg_match("/true$/i",$responseTxt) && $isSign) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	/**
	 * 获取返回时的签名验证结果
	 * @param $para_temp 通知返回来的参数数组
	 * @param $sign 返回的签名结果
	 * @return 签名验证结果
	 */
	function getSignVeryfy($param, $sign) {
		//除去待签名参数数组中的空值和签名参数
        $param_filter = array();
        while (list ($key,$val) = each($param)) 
        {
	            if ($key == "sign" || $key == "sign_type" || $val == "")
	             {
	                continue;
	            }
	           else 
	           {
	                $param_filter[$key] = $param[$key];
	          }
        }

        ksort($param_filter);
        reset($param_filter);
	
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = "";
        while (list ($key, $val) = each($param_filter)) {
        	$prestr.=$key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $prestr = substr($prestr, 0, -1);
        
        $prestr = $prestr . $this->config['key'];
        $mysgin = md5($prestr);
        Yii::log('支付宝签名验证:$prestr=='.$prestr.'||||$mysgin+$sign=='.$mysgin.'++'.$sign,'info','system.db.cart');
        if ($mysgin == $sign) {
        	return true;
        } else {
        	return false;
        }
	}
	
	/**
	 * 获取远程服务器ATN结果,验证返回URL
	 * @param $notify_id 通知校验ID
	 * @return 服务器ATN结果
	 * 验证结果集：
	 * invalid命令参数不对 出现这个错误，请检测返回处理中partner和key是否为空
	 * true 返回正确信息
	 * false 请检查防火墙或者是服务器阻止端口问题以及验证时间是否超过一分钟
	 */
	protected function getResponse($notify_id) 
	{
		//证书地址
		$cer=getcwd().'\\cacert.pem';
		$partner = $this->config['partner'];
		$veryfy_url = $this->verify_url . "?partner=" . $partner . "&notify_id=" . $notify_id;
		$responseTxt = $this->getHttpResponseGET($veryfy_url,$cer);
		return $responseTxt;
	}
	
	protected function getHttpResponseGET($url,$cacert_url) 
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
		curl_setopt($curl, CURLOPT_CAINFO,$cacert_url);//证书地址
		$responseText = curl_exec($curl);
		//var_dump( curl_error($curl) );//如果执行curl过程中出现异常，可打开此开关，以便查看异常内容
		Yii::log('支付宝远程验证:$curl_error=='.curl_error($curl),'info','system.db.cart');
		curl_close($curl);
	
		return $responseText;
	}
}