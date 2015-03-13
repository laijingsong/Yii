<?php
/**
 *支付接口抽象类
 */
abstract class PayApi 
{
	protected $config=array();
    /**
     * 生成订单号
     */
    public function createOrderNo() {
        $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        return $year_code[intval(date('Y')) - 2010] .
                strtoupper(dechex(date('m'))) . date('d') .
                substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));
    }
	
	/**
	 * 获取配置
	 */
	abstract  public function getConfig();
	
	/**
	 *  生成提交表单
	 */
	abstract public function buildResquestForm($vo);
	
	/**
	 * 验签
	 */
	abstract public function verify($msg,$check);
	
	/**
	 * 构造表单
	 */
	protected function _buildForm($params,$gateway,$method='post',$charset='utf-8')
	{
		header("Content-type:text/html;charset={$charset}");
		$formHtml = "<form id='paysubmit' name='paysubmit' action='{$gateway}' method='{$method}'>";
		
		foreach ($params as $k => $v) {
			$formHtml.= "<input type=\"hidden\" name=\"{$k}\" value=\"{$v}\" />\n";
		}
	
		$formHtml = $formHtml . "</form>Loading......";
		
		$formHtml = $formHtml . "<script>document.forms['paysubmit'].submit();</script>";
		return $formHtml;
	}
	
	/**
	 * 通信方法
	 */
	final protected function fsockOpen()
	{
		
	}
}
