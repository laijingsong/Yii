<?php
/**
 * 购物车类
 * @author Lason
 */

class ShopCart
{
	private static  $_cartContents=array();
	private static   $_uid='';
	private static   $_city_on='';
	private static   $_psfs='';
	private $_empire='';
	private  $_dbtbpre='';
	
	/**
	 * 构造方法
	 */
	public function __construct($uid)
	{
		$cartcon=unserialize($this->getcvar('cart-con'));
		if($uid)
		{
			self::$_uid=$uid;

			//默认配送城市
			//$city_on=$this->_empire->fetch1("select addressid,truename,`mycall`,phone,address,province,city,isdefault from {$this->_dbtbpre}enewsshop_address where userid='".self::$_uid."' ORDER BY isdefault DESC");
			$city_on = Yii::app()->db->createCommand()
				->select('addressid,truename,mycall,phone,address,province,city,isdefault')
				->from('phome_enewsshop_address')
				->where('userid=:id', array(':id'=>self::$_uid))
				->order('isdefault DESC')
				->queryRow();
			if($city_on AND $city_on->city){
				self::$_city_on=$city_on->city;
			}

			//已登录用户查数据库
			//$r=$this->_empire->fetch1("select buycart from {$this->_dbtbpre}ddc_cart where userid='$uid'");
			$r = Yii::app()->db->createCommand()
				->select('dpcart')
				->from('phome_ddc_cart')
				->where('userid=:id', array(':id'=>self::$_uid))
				->queryRow();
			if($r)
				$ucart=unserialize($r['dpcart']);

			
		}
		//初始化购物车商品
		if($cartcon && $ucart)
			self::$_cartContents=$this->_merger($cartcon,$ucart);
		elseif($cartcon && !$ucart)
			self::$_cartContents=$cartcon;
		elseif(!$cartcon && $ucart)
			self::$_cartContents=$ucart;
		else 
			self::$_cartContents='';

		if($uid){//如果登陆了，应该清空cookies购物车记录，merger保存到数据库
			$this->setcvar('cart-con', '');
			$this->_saveCart();
		}
	}
	
	/**
	 * 加入购物车
	 */
	public function insert($items=array())
	{
		if(!is_array($items) || count($items)==0)
			return false;
		
		$saveCart=false;
		if(isset($items['storeid']))
		{
			$rowid=$this->_insert($items);
			if($rowid)
				$saveCart=true;
		}
		else
		{
			foreach($items as $val)
			{
				if(is_array($val) && isset($val['storeid']))
					if($this->_insert($val))
						$saveCart=true;
			}
		}
		if($saveCart===true)
		{
			$this->_saveCart();
			return isset($rowid)?$rowid:true;
		}
		return false;
	}
	
	/**
	 * 加入购物车
	 */
	private function _insert($items=array())
	{
		if(!is_array($items) || count($items)==0)
			return false;
		
		if(!isset($items['storeid']) || !isset($items['specid']) || !isset($items['goodsid']) || !isset($items['qty']) || !isset($items['price']) || !isset($items['name']) || !isset($items['colorid']) || !isset($items['sizeid']))
			return false;

		//验证店铺ID
		$storeid=(int)$items['storeid'];
		if(empty($storeid))
			return false;
		//验证specID
		$specid=(int)$items['specid'];
		if(empty($specid))
			return false;
		//验证店铺ID

		$goodsid=(int)$items['goodsid'];
		if(empty($goodsid))
			return false;
		//验证购买数量
		$qty=(int)$items['qty'];
		if( $qty==0)
			return false;
		
		//验证价格
		$price=(float)$items['price'];
		if(!is_numeric($price))
			return false;
		
		//生成唯一标识
		$rowid=md5($items['storeid'].$items['goodsid'].$items['specid']);
		self::$_cartContents[$storeid][$goodsid][$specid]['rowid']=$rowid;
		
		foreach ($items as $key=>$val)
		{
			self::$_cartContents[$storeid][$goodsid][$specid][$key]=$val;
		}
		return $rowid;
	}
	
	/**
	 * 更新购买数量
	 */
	public function update($items=array())
	{
		if(!is_array($items) || count($items)==0)
			return false;
		
		$saveCart=false;
		if(isset($items['storeid']) && isset($items['qty']) && isset($items['goodsid']) && isset($items['specid']))
		{
			if(true==$this->_update($items))
				$saveCart=true;
		}
		else 
		{
			foreach ($items as $val)
			{
				if(is_array($val) && isset($val['storeid']) && isset($val['qty']) && isset($val['goodsid']) && isset($val['specid']))
					if(true==$this->_update($val))
						$saveCart=true;
			}
		}
		if($saveCart==true)
		{
			$this->_saveCart();
			return true;
		}
		return false;
	}
	
	/**
	 * 更新购买数量
	 */
	private function _update($items=array())
	{
		if(!isset($items['qty']) || !isset($items['storeid']) || !isset($items['goodsid']) || !isset($items['specid']) || !isset(self::$_cartContents[$items['storeid']][$items['goodsid']][$items['specid']]))
			return false;
		//验证数量
		$qty=(int)$items['qty'];
		if(!is_numeric($qty))
			return false;
		
		if(self::$_cartContents[$items['storeid']][$items['goodsid']][$items['specid']]['qty']==$qty)
			return false;
		
		if($qty==0)
			unset(self::$_cartContents[$items['storeid']][$items['goodsid']][$items['specid']]);
		else 
			self::$_cartContents[$items['storeid']][$items['goodsid']][$items['specid']]['qty']=$qty;
		return true;
	}
	
	/**
	 * 购物车总金额
	 */
	public function total()
	{
		return false;
	}
	
	/**
	 * 购物车商品数量
	 */
	public function totalItems()
	{
		return false;
	}
	
	/**
	 * 购物车信息
	 * @param $type 指定设计师/作品
	 */
	public static function contents()
	{
		$cart=self::$_cartContents;
		return $cart;
	}
	
	/**
	 * 清空购物车
	 */
	public static  function distory()
	{
		self::$_cartContents='';
		$this->_saveCart();
	}
	
	/**
	 * 保存购物车内容to DB
	 */
	private function _saveCart()
	{
		//未登录用户
		if(empty(self::$_uid))
			$this->setcvar('cart-con', serialize(self::$_cartContents));
		
		//登录用户
		if(self::$_uid)
		{
			$cart=serialize(self::$_cartContents);
			//$lr=$this->_empire->fetch1("select buycart from {$this->_dbtbpre}ddc_cart where userid='".self::$_uid."'");
			$lr = Yii::app()->db->createCommand()
				->select('dpcart')
				->from('phome_ddc_cart')
				->where('userid=:id', array(':id'=>self::$_uid))
				->queryRow();
			if($lr)
			{
				//$sql="update {$this->_dbtbpre}ddc_cart set buycart='$cart',dateline='".time()."' where userid='".self::$_uid."'";
				Yii::app()->db->createCommand()->update('phome_ddc_cart', array(
						'dpcart'=>$cart,
						'dateline'=>time(),
				), 'userid=:id', array(':id'=>self::$_uid));
			}
			else 
			{
				//$sql="insert into {$this->_dbtbpre}ddc_cart(userid,buycart,dateline) values('".self::$_uid."','$cart','".time()."')";
				Yii::app()->db->createCommand()->insert('phome_ddc_cart', array(
					'userid'=>self::$_uid,
					'dpcart'=>$cart,
					'dateline'=>time(),
				));
			}
			//$this->_empire->query($sql);
		}
	}
	
	/**
	 * 合并购物车
	 */
	private function _merger($cart,$cart2)
	{
		if(!is_array($cart) || !is_array($cart2))
			return false;
		foreach($cart as $storeid=>$val)
		{
			if($val)
			{
				foreach ($val as $goodsid=>$vval)
				{
					if($vval)
					{
						foreach ($vval as $specid=>$vvval)
						{
							if(isset($cart2[$storeid][$goodsid][$specid]))
								$cart2[$storeid][$goodsid][$specid]['qty']+=$vvval['qty'];
							else
								$cart2[$storeid][$goodsid][$specid]=$vvval;
						}
					}
				}
			}
		}
		return $cart2;
	}
	
	/**
	 * 生产部是否审核
	 */
	public function goodsProductionCheck($goodsid)
	{
		if(!$goodsid)
			return false;
		$r=Production::model()->find(array(
			'select'=>'ischeck,end_date',
			'condition'=>'goods_id=:gid',
			'params'=>array(':gid'=>$goodsid),
		));
		//已过订单周期不能付款
		$today=strtotime(date('Y-m-d 00:00:00',time()));
// 		if($r->end_date<=$today)
// 			$r->ischeck=0;
		return $r->ischeck;
	}
	
	/**
	 * 获取商品属性
	 */
	public function getinfo($goodsid)
	{
		if(!$goodsid)
			return false;
		$r=Goods::model()->findByPk($goodsid);
		$r['price']=round($r['price']);
		$r['lsprice']=round($r['lsprice']);
		return $r;
	}

	/**
	 * 作品款式数组
	 */
	public function batchFilter()
	{
		if(empty(self::$_cartContents))
			return false;
		$arr=array();
		$arr['all_sum']=0;
		$arr['all_money']=0;
		$arr['all_num']=0;
		$arr['all_yunfei']=0;
		foreach (self::$_cartContents as $storeid=>$v)
		{
			if($v)
			{
				foreach ($v as $goodsid=>$vv)
				{
					//作品是否审核
					$arr[$goodsid]['ischeck']=$this->goodsProductionCheck($goodsid);
					$arr[$goodsid]['info']=$ginfo=$this->getinfo($goodsid);
					
					//店铺价格 零售价 8.8折
					$price=round($ginfo['lsprice']*0.88);
					//作品是否过期
					$goodsM = new Goods();
					$goodsM->gid = $goodsid;
					$pro = $goodsM->getGoodsPro();
					if ($pro['isend'] == 1){
						$price=$ginfo['lsprice'];//过期后按零售价
					}
					$arr[$goodsid]['isend'] = $pro['isend'];
					$arr[$goodsid]['delivery'] = $pro['delivery'];
					$arr[$goodsid]['nostocks'] = 0;
					if($vv)
					{
						$arr[$goodsid]['colorid']=array();
						foreach ($vv as $specid=>$vvv)
						{
							$arr[$goodsid]['price']=$price;
							$arr[$goodsid]['total']+=$vvv['qty']*$price;
							$arr[$goodsid]['colorid'][$vvv['colorid']]+=$vvv['qty'];
							$arr[$goodsid]['name']=$vvv['name'];
							$arr[$goodsid]['sum']+=$vvv['qty'];
							$arr['all_sum']+=$vvv['qty'];
							$arr['all_money']+=$vvv['qty']*$price;
							
							//检测库存是否足够
							if($arr[$goodsid]['isend']){
								if (!($this->checkStocks($specid,$vvv['qty']))) $arr[$goodsid]['nostocks'] = 1;
							}
						}
						$arr[$goodsid]['t_weight']=$arr[$goodsid]['info']['weight']*$arr[$goodsid]['sum'];
						if(self::$_city_on AND self::$_psfs){
							$ft_price = $this->logisticsFees(self::$_city_on,$arr[$goodsid]['info']['weight'],$arr[$goodsid]['info']['flid'],$arr[$goodsid]['sum'],self::$_psfs);
							$arr[$goodsid]['ft_price'] = $ft_price;
							$arr[$goodsid]['yunfei']= $ft_price['price'];  
						}else{
							$arr[$goodsid]['yunfei']=0;
						}
						$arr[$goodsid]['color_sum']=count($arr[$goodsid]['colorid']);

						$arr['all_num']++;
						$arr['all_yunfei']+=$arr[$goodsid]['yunfei'];
					}
				}
			}
		}
		return $arr;
	}

	/**
	 * 店铺数组
	 */
	public function storeinfo()
	{
		if(empty(self::$_cartContents))
			return false;
		$store=array();
		foreach (self::$_cartContents as $storeid=>$v)
		{
			if($storeid AND !isset($store[$storeid]))
			{
				$r=Store::model()->findByPk($storeid);
				$store[$storeid] =$r;
			}
		}
		return $store;
	}
	/**
	 * 从购物车前端传入对象 转为 后台购物车对象
	 *[{"specId":"532","amount":1},{"specId":"534","amount":1}]  =》  buycart   $_cartContents[$items['storeid']][$items['goodsid']][$items['specid']]['qty']
	 */
	public function trans_buycart($spec_arr)
	{
			foreach ($spec_arr as $v)
			{
				if($v['qty']>0)
				{
					$v['price']= $this->_get_price_from_amount($v['goodsid'],$v['qty']);
					if($v['price'])
					{
						$ok=$this->insert($v);
						if(!$ok)
						{
							return false;
						}
					}
				}
				elseif($v['qty']==0 AND self::$_cartContents)
				{
					$ok=$this->update($v);
				}
			}
		return true;
	}


	private function _get_price_from_amount($goodsid,$qty)
	{
		if(!$goodsid || !$qty)
			return false;
		$r=Goods::model()->findByPk($goodsid);
		return round($r->price);
	}


	/**
	 * 购物车删除goods
	 */
	public function delete($gid=0)
	{
		if(empty(self::$_uid)){
			exit('还没有登录');
		}
		if($gid==0 OR !is_numeric($gid)){
			exit('出现错误');
		}else{
			
			$new_cart=$this->_filter_cart($gid);
			self::$_cartContents=$new_cart;
			$this->_saveCart();
			//print_r(self::$_cartContents);exit;
			exit('删除成功');
		}
		
	}

	/**
	 * 购物车删除已经购买了的订单
	 */
	public function delete2($gid=0)
	{
		if(empty(self::$_uid)){
			return false;
		}
		if($gid==0 OR !is_numeric($gid)){
			return false;
		}else{
			
			$new_cart=$this->_filter_cart($gid);
			self::$_cartContents=$new_cart;
			$this->_saveCart();
			//print_r(self::$_cartContents);exit;
			return true;
		}
		
	}


	/**
	 * 过滤 没用的goodsid $gid可以是数字或者数字数组
	 */
	private function _filter_cart($gid)
	{

		$old_cart=self::$_cartContents;
		foreach ($old_cart as $s => $store) {
			foreach ($store as $g => $goods) {
				if($g==$gid OR (is_array($gid) and in_array($g,$gid)) ){
					unset($old_cart[$s][$g]);
				}
			}
			if(count($old_cart[$s])==0){
				unset($old_cart[$s]);
			}
		}
		return $old_cart;
	}


	/**
	 * 确认订单的gids $gid是数字数组
	 */
	private function _confirm_cart($gids)
	{

		$old_cart=self::$_cartContents;
		if($old_cart)
		{
			foreach ($old_cart as $s => $store)
			{
				foreach ($store as $g => $goods) 
				{
					if(is_array($gids))
					{
						if(array_search($g,$gids)===false)
						{
							unset($old_cart[$s][$g]);
						}
					}
					elseif($g!=$gids)
					{
						unset($old_cart[$s][$g]);
					}
				}
				if(count($old_cart[$s])==0)
				{
					unset($old_cart[$s]);
				}
			}
		}
		else
		{
			//printerror("DbError","/e/search/shoplist.php",1);
			throw new CException('错误信息');
		}
		self::$_cartContents=$old_cart;
		$this->_saveCart();
		return $old_cart;
	}

	/**
	 * 确认订单的$specids $specids是数字数组
	 */
	private function _confirm_cart_spec($specids)
	{
	
		$old_cart=self::$_cartContents;
		if($old_cart)
		{
			foreach ($old_cart as $s => $store)
			{
				foreach ($store as $g => $goods)
				{
					foreach ($goods as $spec => $arr){
						if(is_array($specids))
						{
							if(array_search($spec,$specids)===false)
							{
								unset($old_cart[$s][$g][$spec]);
							}
						}
						elseif($spec!=$specids)
						{
							unset($old_cart[$s][$g][$spec]);
						}
					}
					if(count($old_cart[$s][$g])==0)
					{
						unset($old_cart[$s][$g]);
					}
				}
				if(count($old_cart[$s])==0)
				{
					unset($old_cart[$s]);
				}
			}
		}
		else
		{
			//printerror("DbError","/e/search/shoplist.php",1);
			throw new CException('错误信息');
		}
		self::$_cartContents=$old_cart;
		$this->_saveCart();
		return $old_cart;
	}

	/**
	 * 购物车信息
	 * @param $type 指定设计师/作品
	 */
	public function confirm_contents($specids='')
	{
		if(!empty($specids))
			$new_cart=$this->_confirm_cart_spec($specids);
		return $new_cart;
	}
	
	/**
	 * 获取颜色
	 */
	public function getColor()
	{
		$color=Color::model()->findAll();
		foreach ($color as $v)
			$attr[$v->color_id]=$v->color_name;
		return $attr;
	}
	
	/**
	 * 获取尺码
	 */
	public function getSize()
	{
		$size=Size::model()->findAll();
		foreach ($size as $v)
			$attr[$v->size_id]=$v->size_values;
		return $attr;
	}
	
	/**
	 * 获取地址
	 */
	public function getaddress()
	{
		$useraddr = Yii::app()->db->createCommand()
			->select('addressid,truename,mycall,phone,address,province,city,isdefault')
			->from('phome_enewsshop_address')
			->where('userid=:id', array(':id'=>self::$_uid))
			->order('isdefault DESC')
			->queryAll();
		//$useraddr=$this->_empire->select("select addressid,truename,`mycall`,phone,address,province,city,isdefault from {$this->_dbtbpre}enewsshop_address where userid='".self::$_uid."' ORDER BY isdefault DESC");
		return $useraddr;
	}

	public function getprovince()
	{
		$province = Yii::app()->db->createCommand()
			->select('id,provinceId,provinceName')
			->from('phome_ddc_province')
			->queryAll();
		//$province=$this->_empire->select("SELECT id,provinceId,provinceName FROM {$this->_dbtbpre}ddc_province");
		$new_province=array();
		foreach ($province as $key => $value) {
			$new_province[$value['provinceId']]=$value;
		}
		return $new_province;
	}

	public function getcity()
	{
		$city = Yii::app()->db->createCommand()
			->select('id,cityId,cityUpId,cityName')
			->from('phome_ddc_city')
			->queryAll();
		//$city=$this->_empire->select("SELECT id,cityId,cityUpId,cityName FROM {$this->_dbtbpre}ddc_city");
		$new_city=array();
		foreach ($city as $key => $value) {
			$new_city[$value['cityId']]=$value;
		}
		return $new_city;
	}

	public function get_city_from_province($provinceid)
	{
		$result = '';
		//$sql = $this->_empire->query("select id,cityId,cityName from {$this->_dbtbpre}ddc_city where cityUpId='$provinceid'");
		//$row = $this->_empire->fetch($sql);
		$rows=Yii::app()->db->createCommand()
								->select('id,cityId,cityName')
								->from('phome_ddc_city')
								->where('cityUpId=:id',array(':id'=>$provinceid))
								->queryAll();
		foreach ($rows as $row) {
			$row['id']?$result .= '<option value="'.$row['cityId'].'">'.$row['cityName'].'</option>':'';
		}
		$final= '<option vlaue="">选择城市</option>'.$result;
		return $final;
	}

	public function add_address($add)
	{
		$add['addressname']="默认地址";
		$add['truename']=($add['truename']);
		$add['address']=($add['address']);
		$add['mycall']=($add['mycall']);
		$add['phone']=(int)($add['phone']);
		$add['province']=($add['province']);
		$add['city']=($add['city']);
	
		if($add['truename'] AND $add['address'] AND $add['phone'] AND $add['province'] AND $add['city'])
		{
			//$num=$this->_empire->gettotal("select count(*) as total from {$this->_dbtbpre}enewsshop_address where userid='".self::$_uid."'");
			$num=Yii::app()->db->createCommand()
									->select('count(*) as total')
									->from('phome_enewsshop_address')
									->where('userid=:id',array(':id'=>self::$_uid))
									->queryRow();
			$isdefault=1;
			if($num['total']>0)
			{
				//$sql=$this->_empire->query("UPDATE {$this->_dbtbpre}enewsshop_address SET isdefault = 0 WHERE userid='".self::$_uid."'");
				Yii::app()->db->createCommand()
							->update('phome_enewsshop_address',array('isdefault'=>0),'userid=:id',array(':id'=>self::$_uid));
			}
			
			//$sql=$this->_empire->query("insert into {$this->_dbtbpre}enewsshop_address(addressname,userid,truename,address,mycall,phone,isdefault,province,city) values('$add[addressname]','".self::$_uid."','$add[truename]','$add[address]','$add[mycall]','$add[phone]','$isdefault','$add[province]','$add[city]');");
			$sql=Yii::app()->db->createCommand()
								->insert('phome_enewsshop_address',array(
										'addressname'=>$add['addressname'],
										'userid'=>self::$_uid,
										'truename'=>$add['truename'],
										'address'=>$add['address'],
										//'mycall'=>$add['mycall'],
										'phone'=>$add['phone'],
										'isdefault'=>$isdefault,
										'province'=>$add['province'],
										'city'=>$add['city']
								));
			if($sql)
				return 1;
			else
				return 0;
		}else{
			return 2;
		}

	}

	/**
	 * 获取 $json={"123456":["14","124","1234"],"4336":["4234","43243","4353"]}
	 */
	public function json()
	{
		if(empty(self::$_cartContents))
			return false;
		$json=array();
		foreach (self::$_cartContents as $storeid=>$v)
		{
			if($storeid)
			{
				foreach ($v as $goodsid=>$vv){
					$json[$storeid][]=$goodsid;
				}
				
			}
		}
		return $json;
	}

	/**
	 * 运费计算
	 *  $city 城市ID
	 *  $psfs 配送方式
	 *  $goods 作品信息 [title,weight,flid,store_id]
	 *  $num 数量
	 *  return 运费
	 */
	public function logisticsFees($city,$weight,$flid,$num,$psmod)
	{
		//获取商品数据
		$weight = $weight?$weight:0.5;
		//$city_info = $this->_empire->fetch1("SELECT id,cityId FROM {$this->_dbtbpre}ddc_city WHERE cityId='$city'");
		$city_info = Yii::app()->db->createCommand()
			->select('id,cityId')
			->from('phome_ddc_city')
			->where('cityid=:id', array(':id'=>$city))
			->queryRow();
		$city=$city_info['id'];

		//如果产品没有选择运费模版则用默认模版
		//$t = $this->_empire->fetch1("SELECT id,provinceid,cityid FROM {$this->_dbtbpre}ddc_freight_logistics WHERE id='$flid'");
		$t = Yii::app()->db->createCommand()
			->select('id,first_weight,first_price,next_weight,next_price')
			->from('phome_ddc_freight_logistics')
			->where('id=:id', array(':id'=>$flid))
			->queryRow();
		if(empty($t['id'])) 
		{
			//$ft = $this->_empire->fetch1("SELECT id,provinceid,cityid FROM {$this->_dbtbpre}ddc_freight_logistics WHERE state=1 ORDER BY id DESC LIMIT 1");
			$ft = Yii::app()->db->createCommand()
				->select('id,first_weight,first_price,next_weight,next_price')
				->from('phome_ddc_freight_logistics')
				->where('state=1')
				->order('id DESC')
				->queryRow();
			$flid = $ft[id];
			$t = $ft;
		}

		//获取运费价格
		//$ft_price = $this->_empire->fetch1("SELECT id,hk_price,kj_price FROM {$this->_dbtbpre}ddc_freight_logistics_price WHERE flid='$flid' AND cityid='$city'");
		$ft_price = Yii::app()->db->createCommand()
			->select('fla.id,fla.first_weight,fla.first_price,fla.next_weight,fla.next_price')
			->from('phome_ddc_freight_logistics_area as fla')
			->join('phome_ddc_freight_logistics_price as flp','fla.id=flp.flaid')
			->where('fla.flid=:id and flp.cityid=:city',array(':id'=>$flid,':city'=>$city))
			->queryRow();		
		if(empty($ft_price[id])) 
		{
			//$ft_price = $this->_empire->fetch1("SELECT id,dhk_price AS hk_price,dkj_price AS kj_price FROM {$this->_dbtbpre}ddc_freight_logistics WHERE id='$flid'");
			//$ft_price = Yii::app()->db->createCommand()
			//	->select('id,dhk_price AS hk_price,dkj_price AS kj_price')
			//	->from('phome_ddc_freight_logistics')
			//	->where('id=:id', array(':id'=>$flid))
			//	->queryRow();
			$ft_price = $t;
		}
		
		//计算运费价格
		if(($weight*$num) < $ft_price['first_weight']){
			$price = $ft_price['first_price'];
		}else{
			$price = ceil($weight*$num-$ft_price['first_weight'])*$ft_price['next_price']+$ft_price['first_price'];
		}
		
		$ft_price['price'] = $price;
		
		//计算运费价格
		/*if($psmod=='快件'){
			$per_price=$ft_price['kj_price'];
		}else{
			$per_price=$ft_price['hk_price'];
		}*/

		//$price = round($weight*$num*$per_price,2);

		//if($price<6)
		//	$price=6;
		return $ft_price;
	}

	/**
	 * 配送方式
	 */
	public function psfs($psid){
		$psfs=$this->_empire->fetch1("select pid,pname from {$this->_dbtbpre}enewsshopps where pid='$psid' and isclose=0");
		return $psfs;
	}

	/**
	 * 配送方式
	 */
	public function setps($city,$psid){
		$psfs_info = Yii::app()->db->createCommand()
			->select('pid,pname')
			->from('phome_enewsshopps ps')
			->where('pid=:id and isclose=0', array(':id'=>$psid))
			->queryRow();
		//$psfs_info=$this->_empire->fetch1("select pid,pname from {$this->_dbtbpre}enewsshopps where pid='$psid' and isclose=0");
		if($psfs_info AND $psfs_info['pname']){
			self::$_psfs=$psfs_info['pname'];
		}
		if($city){
			self::$_city_on=$city;
		}
	}
	
	/**
	 * 获取COOKIE
	 */
	public function getcvar($name)
	{
		return Yii::app()->request->cookies[$name];
	}
	
	/**
	 * 设置COOKIE
	 */
	public function setcvar($var,$val,$life=3600)
	{
		$ck=new CHttpCookie($var,$val);
		$ck ->expire=time()+$life;
		return Yii::app()->request->cookies[$var] = $ck;
	}
	
	/**
	 * 测试方法
	 */
	public function cartTest()
	{
		//
		$aa=$this->getinfo(266);
		print_r($aa);exit;
	}
	
	/**
	 * 检测库存
	 */
	public function checkStocks($stocksid,$qty)
	{
		$stocks = Yii::app()->db->createCommand()
			->select('stocks')
			->from('phome_ddc_goods_stocks')
			->where('id='.$stocksid)
			->order('id DESC')
			->queryRow();
		if ($stocks['stocks'] < $qty) return false;
		return true;
	}

	/**
	 * @name 根据$specids获取$gids
	 */
	public function getGids($specids){
		$gids = array();
		if(!empty($specids)){
			$res = Yii::app()->db->createCommand()
				->select('goods_id')
				->from('phome_ddc_goods_stocks')
				->where('id in ('.$specids.')')
				->order('id DESC')
				->group('goods_id')
				->queryAll();
			
			if ($res){
				foreach ($res as $v){
					$gids[] = $v['goods_id'];
				}
			}
		}
		return $gids;
	}
	
	/**
	 * @name 根据$specids删除购物车
	 */
	public function deleteBySpecid($specids){
		$old_cart=self::$_cartContents;
		if($old_cart)
		{
			foreach ($old_cart as $s => $store)
			{
				foreach ($store as $g => $goods)
				{
					foreach ($goods as $spec => $arr){
						if(is_array($specids))
						{
							if(array_search($spec,$specids)!==false)
							{
								unset($old_cart[$s][$g][$spec]);
							}
						}
						elseif($spec!=$specids)
						{
							unset($old_cart[$s][$g][$spec]);
						}
					}
					if(count($old_cart[$s][$g])==0)
					{
						unset($old_cart[$s][$g]);
					}
				}
				if(count($old_cart[$s])==0)
				{
					unset($old_cart[$s]);
				}
			}
		}
		else
		{
			//printerror("DbError","/e/search/shoplist.php",1);
			throw new CException('错误信息');
		}
		self::$_cartContents=$old_cart;
		$this->_saveCart();
	}

}
