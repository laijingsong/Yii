<?php
return array(
		/**
		 * 银盛支付
		 */
		'eyspay'=>array(
				//签名请求URL
				'signUrl'=>'http://www.ddchina.cc:8080/yspay/',
				//证书密码
				'cerPwd'=>'22452014317',
				//前端回调
				'pgUrl'=>'http://d.ddchina.cc/index.php?r=cart/frontend',
				//后端回调
				'bgUrl'=>'http://d.ddchina.cc/index.php?r=cart/backend',
				//交易用户号
				'src'=> 'Cs2013',	
				//报文编号
				'msgCode'=>'S3001',	
				//用户号 收款方银盛用户号
				'userCode'=>'Cs2013',
				//客户名 收款方 客户名
				'name'=>'深圳市彩衫电子商务有限公司',
		),
		
		/**
		 * 支付宝
		 */
		'alipay'=>array(
				'partner'=>'2088611939820034',
				'key'=>'1dro2lk2qwif99qmd8bpz7bj54nc2zbe',
				'aliaccount'=>'cw@ddchina.cc',
				'notify_url'=>'http://d.ddchina.cc/index.php?r=cart/alinotify&method=notify&apitype=alipay',
				'return_url'=>'http://d.ddchina.cc/index.php?r=cart/alinotify&method=return&apitype=alipay',
				'input_charset'=>'utf-8',
		),
);