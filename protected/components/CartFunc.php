<?php
require_once 'ShopCart.php';
class CartFunc
{
	private $_empire='';
	private  $_dbtbpre='';
	private static $_cart='';
	private static $_uid='';
	private static $_uname='';
	
	public function __construct($uid,$name)
	{
		self::$_uname=$name;
		self::$_uid=$uid;
		if(!$name || !$uid)
			return false;
		self::$_cart=new ShopCart(self::$_uid);
	}
	
	/**
	 * 提交订单
	 */
	public function SubmitOrder($add)
	{
		$json=$add['json'];
		$addrid=$add['addressid'];
		$payfsid=$add['payfsid'];
		$psid=$add['psid'];
		$bz=$add['bz'];
		
		$ip=Yii::app()->request->getUserHostAddress();
		$userid=self::$_uid;
		$username=self::$_uname;
		
		$arr=json_decode($json,true);
		//库存
		/*if (!$this->checkStocks($json)){
			header("Content-type:text/html;charset=utf-8");
			echo '<script>alert("下手慢了，库存已不足");history.go(-1);</script>';	
			return false;
		}*/
		
		if(!$arr)
			return false;
		//配送方式
		//$psfs=$this->_empire->fetch1("select pid,pname from {$this->_dbtbpre}enewsshopps where pid='$psid' and isclose=0");
		$psfs = Yii::app()->db->createCommand()
			->select('pid,pname')
			->from('phome_enewsshopps')
			->where('pid=:id and isclose=0', array(':id'=>$psid))
			->queryRow();
		if(empty($psfs['pid']))
			throw new CHttpException('10000','未选择配送方式');
		//支付方式
		//$payr=$this->_empire->fetch1("select payid,payname,payurl,userpay,userfen from {$this->_dbtbpre}enewsshoppayfs where payid='$payfsid' and isclose=0");
		$payr = Yii::app()->db->createCommand()
			->select('payid,payname,payurl,userpay,userfen')
			->from('phome_enewsshoppayfs')
			->where('payid=:id and isclose=0', array(':id'=>$payfsid))
			->queryRow();
		if(empty($payr['payid']))
			throw new CHttpException('10000','未选择支付方式');
		$mess="AddDdAndToPaySuccess";
		$location=$payr['payurl'];
		$payfsname=$payr['payname'];
		//收货地址
		//$address=$this->_empire->fetch1("select * from {$this->_dbtbpre}enewsshop_address where addressid='$addrid' and userid='$userid'");
		$address = Yii::app()->db->createCommand()
			->select('*')
			->from('phome_enewsshop_address')
			->where('addressid=:id and userid=:uid', array(':id'=>$addrid,':uid'=>$userid))
			->queryRow();
		if(empty($address['addressid']) || empty($addrid)     )
			throw new CHttpException('10000','收货地址错误');
		
		$f='';
		//每款作品生成一个订单
		foreach ($arr as $storeid=>$v)
		{
			if(!is_array($v))
				continue;
			foreach ($v as $goodsid)
			{
				//作品信息
				$goodsInfo=self::$_cart->getinfo($goodsid);
				$goodsArr=array();
				$goodsArr=self::$_cart->contents();
				$goods=$goodsArr[$storeid][$goodsid];
				if(!is_array($goods))
					continue;
				$amount='';//作品金额
				$name='';//作品名称
				$qty='';//作品数量
				$oldcar='';//ecms
				
				//购买商品
				foreach ($goods as $specid=>$val)
				{
					$price=round($goodsInfo['lsprice']*0.88);
					//作品是否过期
					$goodsM = new Goods();
					$goodsM->gid = $goodsid;
					$pro = $goodsM->getGoodsPro();
					if ($pro['isend'] == 1){
						$price=$goodsInfo['lsprice'];//过期后按零售价
					}
					$car[$val['colorid']][$val['sizeid']]=$val['qty'];
					$amount+=$price*$val['qty'];
					$qty+=$val['qty'];
					$name=$val['name'];
					$oldcar.="|$specid,$goodsid||$val[qty]|$val[price]|0|$val[name]!";
					
					//更新库存
					//$this->updateStocks($specid,$val['qty'],$goodsid);
				}
				//运费
				$ft_price = self::$_cart->logisticsFees($address['city'],$goodsInfo['weight'],$goodsInfo['flid'],$qty,$psfs['pname']);
				$yunfei=$ft_price['price'];  
				//订单入库
				$ddtime=date("Y-m-d H:i:s");
				$ddtruetime=time();
				$ddno=$this->createDdno();
				$scar=serialize($car);
				/*$ddSql="insert into {$this->_dbtbpre}enewsshopdd".
								 "(ddno,ddtime,userid,username,outproduct,haveprice,checked,truename,phone,address,zip,psid,psname,pstotal,alltotal,payfsid,payfsname,payby,fp,fptt,fptotal,fpname,userip,pretotal,ddtruetime,addressid) ".
								"values('$ddno','$ddtime','$userid','$username',0,'0',0,'$address[truename]','$address[phone]','$address[address]','$address[zip]','$psid','$psfs[pname]','$yunfei',$amount,'$payfsid','$payfsname','0','0','0','0','0','$ip','0','$ddtruetime','$addrid');";*/
				//$this->_empire->query($ddSql);
				//$ddid=$this->_empire->lastid();
				$ddSql = Yii::app()->db->createCommand()
					->insert('phome_enewsshopdd',array(
							'ddno'=>$ddno,'ddtime'=>$ddtime,'userid'=>$userid,'username'=>$username,'outproduct'=>'0','haveprice'=>'0','checked'=>'0',
							'truename'=>$address['truename'],'phone'=>$address['phone'],'address'=>$address['address'],
							'zip'=>$address['zip'],'psid'=>$psid,'psname'=>$psfs['pname'],
							'pstotal'=>$yunfei,'alltotal'=>$amount,'payfsid'=>$payfsid,'payfsname'=>$payfsname,'payby'=>0,'fp'=>0,
							'fptt'=>0,'fptotal'=>0,'fpname'=>0,'userip'=>$ip,
							'pretotal'=>0,'ddtruetime'=>$ddtruetime,'addressid'=>$addrid,
				));
				$ddid=Yii::app()->db->getLastInsertID();
				//$addSql="insert into {$this->_dbtbpre}enewsshopdd_add(ddid,buycar,store_id,goods_id,goods_title,goods_price,goods_car,bz,retext,goods_total,saleid,saleinfo) values('$ddid','$oldcar','$storeid','$goodsid','$name','$price','$scar','$bz','','$qty','$saleid','$saleCon');";
				$addSql=Yii::app()->db->createCommand()
					->insert('phome_enewsshopdd_add',array(
						'ddid'=>$ddid,'buycar'=>$oldcar,'store_id'=>$storeid,'goods_id'=>$goodsid,'goods_title'=>$name,'goods_price'=>$price,
							'goods_car'=>$scar,'bz'=>$bz,
							'retext'=>'','goods_total'=>$qty,
				));
				//$this->_empire->query($addSql);
				$ddids.=$f.$ddid;
				$f=',';
				//移出购物车
				self::$_cart->delete2($goodsid);
			}
		}
		//批量支付
		$payment=$payfsid==7?'eyspay':'alipay';
		//$payment='eyspay';
		$pay=new Pay(ucfirst($payment));
		$payss=$this->createPayStatus($ddids,self::$_uid);
		$orderId=$payss['id'];
		unset(Yii::app()->session['ddid']);
		Yii::app()->session->add('ddid',$orderId);
		
		$vo=new PayData();
		$vo->setBody('订单支付')
				->setFee($payss['money'])
				->setOrderNo($orderId)
				->setTitle('彩衫网')
				->setParam(array('orderId'=>$orderId));
		echo $pay->buildResquestForm($vo);
		//include_once('../payapi/payfun.php');
		//支付前保存订单号
		//$payss=createPayStatus($ddids,self::$_uid);
		//$set=esetcookie("paymoneyddid",$payss['id'],0);
		//printerror($mess,$location,1);
	}
	
	/**
	 * 支付前保存订单号
	 */
	function createPayStatus($ddid,$userid)
	{
		global $empire,$dbtbpre;
		if(!$ddid)
			return false;
		$dd=explode(',', $ddid);
		if(!$dd)
			return false;
		$f=$ddids="";
		foreach ($dd as $v)
		{
			if($v)
			{
				$ddm=$this->PayApiShopDdMoney($v);
				if($ddm)
				{
					$money=$money+$ddm['tmoney'];
					$userid=$ddm['userid'];
					$ddno.=$f.$ddm['ddno'];
					$f=",";
				}
			}
		}
	
		$time=time();
		//$empire->query("insert into {$dbtbpre}ddc_pay_status(ddno,userid,money,create_time) values('$ddno','$userid','$money','$time')");
		//$arr['id']=$empire->lastid();
		Yii::app()->db->createCommand()
			->insert('phome_ddc_pay_status',array(
					'ddno'=>$ddno,'userid'=>$userid,'money'=>$money,'create_time'=>$time
		));
		$arr['id']=Yii::app()->db->getLastInsertID();
		$arr['money']=$money;
		return $arr;
	}
	
	/**
	 * 订单金额
	 */
	public function PayApiShopDdMoney($ddid){
		global $empire,$dbtbpre;
		if(empty($ddid))
			return false;
		//$r=$empire->fetch1("select ddid,ddno,userid,username,truename,pstotal,alltotal,fptotal,pretotal,fp,payby,havecutnum from {$dbtbpre}enewsshopdd where ddid='$ddid'");
		$r = Yii::app()->db->createCommand()
			->select('ddid,ddno,userid,username,truename,pstotal,alltotal,fptotal,pretotal,fp,payby,havecutnum')
			->from('phome_enewsshopdd')
			->where('ddid=:id', array(':id'=>$ddid))
			->queryRow();
		if(empty($r['ddid']))
			return false;
		
		$r['tmoney']=$r['alltotal']+$r['pstotal']+$r['fptotal']-$r['pretotal'];
		return $r;
	}
	
	/**
	 * 支付完成处理订单状态
	 * $id int 订单状态ID
	 * $tradesn int 银盛交易流水号
	 * $apyId int 银盛订单号
	 */
	function updatePayStatus($id,$tradesn='0',$back=false,$payId='')
	{
		global $empire,$dbtbpre;
		if(!$id)
			return false;
		//$query="select * from {$dbtbpre}ddc_pay_status where id={$id} limit 1";
		//$r=$empire->fetch1($query);
		$r = Yii::app()->db->createCommand()
			->select('*')
			->from('phome_ddc_pay_status')
			->where('id=:id', array(':id'=>$id))
			->queryRow();

		if(!$r)
			return false;
		$ddnos=explode(',', $r['ddno']);
		if(!is_array($ddnos))
			return false;
		$time=time();
		//$empire->query("update {$dbtbpre}ddc_pay_status set end_time='$time',tradesn='$tradesn' where id=$id");
		Yii::app()->db->createCommand()->update('phome_ddc_pay_status', array(
				'end_time'=>$time,
				'tradesn'=>$tradesn,
		), 'id=:id', array(':id'=>$id));
		$f="";
		$nos="";
		
		//更新订单支付
		foreach ($ddnos as $v)
		{
			//订单号
			$orderId = $v;
	
			//payrecord 有记录，即为已支付成功
			//$num=$empire->gettotal("select count(*) as total from {$dbtbpre}enewspayrecord where orderid='$orderId' limit 1");
			$num=Yii::app()->db->createCommand()
									->select('count(*) as total')
									->from('phome_enewspayrecord')
									->where('orderid=:id',array(':id'=>$orderId))
									->queryRow();
			if($num['total']>0)
				continue;
			//需要更新销量的订单
			$nos.=$f.$v;
			$f=",";
			//修改订单支付状态 table:phome_enewsshopdd,是否付款:haveprice==1
			//$sql=$empire->query("update {$dbtbpre}enewsshopdd set haveprice=1 where ddno='$orderId'");
			$sql=Yii::app()->db->createCommand()
							->update('phome_enewsshopdd',array('haveprice'=>1),'ddno=:id',array(':id'=>$orderId));
	
			//查询订单记录
			//$ddr=$empire->fetch1("select ddid,ddno,userid,username,truename,pstotal,alltotal,fptotal,pretotal,fp,payby,havecutnum from {$dbtbpre}enewsshopdd where ddno='$orderId'");
			$ddr=Yii::app()->db->createCommand()
							->select('ddid,ddno,userid,username,truename,pstotal,alltotal,fptotal,pretotal,fp,payby,havecutnum')
							->from('phome_enewsshopdd')
							->where('ddno=:id',array(':id'=>$orderId))
							->queryRow();
			$money=$ddr['alltotal']+$ddr['pstotal']+$ddr['fptotal']-$ddr['pretotal'];
			$posttime=date("Y-m-d H:i:s");
			$payip=Yii::app()->request->getUserHostAddress();
			$userid=(int)$ddr[userid];
			$username=$ddr[username]?$ddr[username]:$ddr[truename];
			$paybz='零售订单---银盛订单号：'.$payId.'总支付金额：'.$r['money'].';支付订单号：'.$r['ddno'];
	
			//添加支付记录
			//$insertsql="insert into {$dbtbpre}enewspayrecord(`userid`,`username`,`orderid`,`money`,`posttime`,`paybz`,`type`,`tradesn`) values('$userid','$username','$orderId','$money','$posttime','$paybz','eyspay','$tradesn');";
			//$empire->query($insertsql);
			Yii::app()->db->createCommand()->insert('phome_enewspayrecord',array(
						'userid'=>$userid,'username'=>$username,'orderid'=>$orderId,'money'=>$money,
						'posttime'=>$posttime,'paybz'=>$paybz,'type'=>'eyspay','tradesn'=>$tradesn,
			));
		}
		$this->updatePsalenum($nos);
		return true;
	}
	
	/**
	 * 付款后更新销量
	 */
	function updatePsalenum($ddno)
	{
		global $empire,$dbtbpre;
		if (!$ddno)
			return false;
		if(strpos($ddno,','))
		{
			$arr=explode(',', $ddno);
			if(!$arr)
				return false;
			foreach ($arr as $v)
			{
				//$goods=$empire->fetch1("select fdd.buycar from {$dbtbpre}enewsshopdd  as dd inner join {$dbtbpre}enewsshopdd_add as fdd on dd.ddid=fdd.ddid where dd.ddno='$v' ");
				$sql="select fdd.buycar from phome_enewsshopdd  as dd inner join phome_enewsshopdd_add as fdd on dd.ddid=fdd.ddid where dd.ddno='$v' ";
				$goods=Yii::app()->db->createCommand($sql)->queryRow();
				if($goods['buycar'])
					$this->updateGoodsPsalenum($goods['buycar']);
			}
		}
		else
		{
			//$goods=$empire->fetch1("select fdd.buycar from {$dbtbpre}enewsshopdd  as dd inner join {$dbtbpre}enewsshopdd_add as fdd on dd.ddid=fdd.ddid where dd.ddno='$v' ");
			$sql="select fdd.buycar from phome_enewsshopdd  as dd inner join phome_enewsshopdd_add as fdd on dd.ddid=fdd.ddid where dd.ddno='$v' ";
			$goods=Yii::app()->db->createCommand($sql)->queryRow();
			if($goods['buycar'])
				$this->updateGoodsPsalenum($goods['buycar']);
		}
	}
	
	/**
	 * 销售量更新方法
	 */
	function updateGoodsPsalenum($buycar)
	{
		global $empire,$dbtbpre;
		$garr=explode('!', $buycar);
		array_pop($garr);
		$count=count($garr);
		for ($i=0;$i<$count;$i++)
		{
			$pr=explode('|', $garr[$i]);
			$fr=explode(',', $pr[1]);;
			$goodsId=(int)$fr[1];
			$pnum=(int)$pr[3];
			//$empire->query("update {$dbtbpre}ecms_shop set psalenum=psalenum+".$pnum." where id='$goodsId'");
			$sql="update phome_ecms_shop set psalenum=psalenum+".$pnum." where id='$goodsId'";
			Yii::app()->db->createCommand($sql)->execute();
			/**
			 * 生产表本期销量
			*/
			//$empire->query("update {$dbtbpre}ddc_goods_production set salenum=salenum+".$pnum." where goods_id='$goodsId'");
			$sql="update phome_ddc_goods_production set salenum=salenum+".$pnum." where goods_id='$goodsId'";
			Yii::app()->db->createCommand($sql)->execute();
			
			/**
			 * 更新库存
			 */
			//$this->updateStocks($fr[0],$pnum,$goodsId);
		}
		return true;
	}
	
	/**
	 * 生成订单号
	 */
	public function createDdno()
	{
		$ddno=time().rand(10000,99999);
		return $ddno;
	}
	
	/**
	 * @name 更新库存
	 */
	public function updateStocks($stocksid,$num,$gid){
		$goodsM = new Goods();
		$goodsM->gid = $gid;
		$pro = $goodsM->getGoodsPro();
		if ($pro['isend'] == 1){
			$sql="update phome_ddc_goods_stocks set stocks=stocks-".$pnum." where id='$stocksid'";
			Yii::app()->db->createCommand($sql)->execute();
		}
		return true;
	}
	
	/**
	 * @name 订单提交检测库存
	 */
	public function checkStocks($json){
		$arr=json_decode($json,true);
		foreach ($arr as $storeid=>$v)
		{
			if(!is_array($v))
				continue;
			foreach ($v as $goodsid)
			{
				$goodsArr=self::$_cart->contents();
				$goods=$goodsArr[$storeid][$goodsid];
				if(!is_array($goods))
					continue;
				foreach ($goods as $specid=>$val)
				{
					$stocks=Yii::app()->db->createCommand()
						->select('stocks')
						->from('phome_ddc_goods_stocks')
						->where('goods_id=:gid and color_id=:cid and size_id=:sid',array(':gid'=>$goodsid,':cid'=>$val['colorid'],':sid'=>$val['sizeid']))
						->queryRow();
					if ($stocks['stocks'] < $val['qty']) return false;
				}
			}
		}
		return true;
	}
	
}