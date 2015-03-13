<?php
/**
 * 银盛支付接口
 */
class Eyspay extends PayApi
{
	private $gateway="http://pay.ysepay.com/businessgate/yspay.do";

	public function __construct()
	{
		$this->getConfig();
	}
	
	/**
	 * 获取配置
	 */
	public function getConfig()
	{
		$this->config=Yii::app()->params['pay']['eyspay'];
	}
	/**
	 * 签名
	 */
	public function sign($data)
	{
		if(isset($data))
			return $this->getReponse('sign',$data);
		return false;
	}
	
	/**
	 * 验签
	 */
	public function verify($msg,$check)
	{
		if(isset($msg) && isset($check))
			return $this->getReponse('verify','',$msg,$check);
		return false;
	}
	
	/**
	 * 创建表单
	 */
	public function buildResquestForm($vo)
	{
		$src 				= $this->config['src'];									//交易用户号
		$msgCode 	= $this->config['msgCode'];						//报文编号
		$userCode 	= $this->config['userCode'];						//用户号 收款方银盛用户号
		$name 			= $this->config['name'];								//客户名 收款方 客户名
		
		$note 					= $vo->getTitle().$vo->getBody();	//订单说明
		$userAmount	= $vo->getFee()*100;					//收款金额 收款方
		$amount 			= $vo->getFee()*100;					//订单金额
		$orderId  			= $vo->getOrderNo();					//订单号
		$ysorderId				= $orderId.time();					//多次未支付成功时，银盛需要每次都是新的订单号
		//esetcookie("checkpaysession",$orderId,0);	//设置定单号
		
		$date 			= date('YmdHis');			//日期
		$busiCode 	= '01000010';					//业务代码 银盛指定，业务的编号
		$cur 				= 'CNY';								//币种
		$shopDate = date('Ymd');					//商户日期
		$timeOut	= '10080';							//订单有效时间，(分) ，过期不能支付
		
		$msgId			= $shopDate.$orderId;	//ID，唯一值
		
		$pgUrl 	= $this->config['pgUrl'];		 //前端回调页
		$bgUrl 	= $this->config['bgUrl'];		//后台回调页
		$gotoPayUrl 	= $this->gateway;
		
		$xml = "";
		$xml .= "<?xml version=\"1.0\" encoding=\"GBK\"?>";
		$xml .= "<yspay>";
		$xml .= "<head>";
		$xml .= "<Ver>1.0</Ver>";
		$xml .= "<Src>$src</Src>";
		$xml .= "<MsgCode>$msgCode</MsgCode>";
		$xml .= "<Time>$date</Time>";
		$xml .= "</head>";
		$xml .= "<body>";
		$xml .= "<Order>";
		$xml .= "<OrderId>$ysorderId</OrderId>";
		$xml .= "<BusiCode>$busiCode</BusiCode>";
		$xml .= "<ShopDate>$shopDate</ShopDate>";
		$xml .= "<Cur>$cur</Cur>";
		$xml .= "<Amount>$amount</Amount>";
		$xml .= "<Note>$note</Note>";
		$xml .= "<Timeout>$timeOut</Timeout>";
		$xml .= "</Order>";
		$xml .= "<Payee>";
		$xml .= "<UserCode>$userCode</UserCode>";
		$xml .= "<Name>$name</Name>";
		$xml .= "<Amount>$userAmount</Amount>";
		$xml .= "</Payee>";
		$xml .= "<Notice>";
		$xml .= "	<PgUrl>$pgUrl</PgUrl>";
		$xml .= "<BgUrl>$bgUrl</BgUrl>";
		$xml .= "</Notice>";
		$xml .= "</body>";
		$xml .= "</yspay>";

		$check = $this->sign($xml);	//签名
		if($check=="error" || $check=="")
			exit("支付遇到问题，签名失败，请重试");
		
		$data = iconv("UTF-8","GB2312//IGNORE",$xml);//编码转化
		$msg = base64_encode($data);	//参数编码
		
		$params=array(
			'src'=>$src,
			'msgCode'=>$msgCode,
			'msgId'=>$msgId,
			'check'=>$check,
			'msg'=>$msg,
		);
		$formHtml=$this->_buildForm($params, $this->gateway);
		return $formHtml;
	}
	
	/**
	 * 签名与验签方法
	 * @param $type 签名/验签
	 * @param $data 需要签名数据
	 * @param $msg  验签，接收到的数据
	 * @param $check 验签，接收到的签名
	 */
	private function getReponse($type,$data='',$msg='',$check='')
	{
		$link=$type=='sign'?'PaySet':'PayGet';
		$url=$this->config['signUrl'].$link;
		//验签
		if($type=='verify' && isset($msg) && isset($check))
		{
			$msg=iconv("UTF-8","GBK//IGNORE",$msg);//编码转化
			$check=iconv("UTF-8","GBK//IGNORE",$check);//编码转化
			$d = "msg=".urlencode(urlencode(base64_encode($msg)))."&check=".urlencode(urlencode(base64_encode($check)));
		}
		//签名
		if($type=='sign' && isset($data))
		{
			$data = iconv("UTF-8","GBK//IGNORE",$data);//编码转化
			$d = "pw=".$this->config['cerPwd']."&set=".urlencode(urlencode(base64_encode($data)));
		}
		
		$header = array("content-type: application/x-www-form-urlencoded;charset=GBK");
		$ch = curl_init(); 	//初始化
		curl_setopt($ch, CURLOPT_URL, $url);									//设置链接
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		//设置是否返回信息
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);	//设置HTTP头
		curl_setopt($ch, CURLOPT_POST, 1);									//设置为POST方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $d);					//POST数据
		$response = curl_exec($ch);														//接收返回信息
		if(curl_errno($ch)){																		//出错则显示错误信息
			curl_error($ch);
			return false;
		}
		curl_close($ch); 		//关闭
		
		if($response == "true")
			return true;
		else
			return $response;	
	}
	
}
