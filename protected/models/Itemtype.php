<?php
class Itemtype extends CActiveRecord
{
	public $bh;
	public $pbh;
	public $name;
	public $des;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return "{{itemtype}}";
	}
	
	/**
	 * @name 验证规则
	 * @see CModel::rules()
	 */
	public function rules()
	{
		return array(
			array('bh,pbh,name','required','message'=>'分类名不能为空'),
		);
	}
	
	public static function getalltype(){
		$array=array();
		$criteria=new CDbCriteria();
		$criteria->order='id desc';
		
		$row = self::model()->findAll($criteria);
		foreach ($row as $v){
			$array[]=$v->attributes;
		}
		return $array;
	}
	
	public function gettype($id,$param=true){
		$row =self::model()->findByPk($id);
		if ($param){
			$row=$row->attributes;
		}
		return $row;
	}
	//根据typeid 获取bh；
	public  function  typeidgetbh($typeid){
		$criteria=new CDbCriteria();
		$criteria->condition='id='.$typeid;
		$result = self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return false;
		
	}
	
	public  function  bhgettype($bh){
		$criteria=new CDbCriteria();
		$criteria->condition='bh='.$bh;
		$result = self::model()->find($criteria);
		if ($result)
			return $result->attributes;
		return false;
	
	}
	
	public function  getmaxid(){
		$criteria=new CDbCriteria();
		$criteria->order='id desc';
		$criteria->limit='1';
		$result =self::model()->find($criteria);
		if ($result)
			return $result->bh;
		return false;
	}
	
	/**
	 * @name 获取子分类
	 * @author lason
	 */
	public function getSubType($pbh='0')
	{
		$criteria=new CDbCriteria();
		$criteria->condition='pbh='.$pbh;
		$result = self::model()->findAll($criteria);
		if ($result)
			return $result;
		return false;
	}
	
	/**
	 * @name 获取分类树
	 */
	public function getTypeTree()
	{
		$arr=array();
		$result=self::model()->findAll();
		foreach ($result as $k=>$v)
		{
			$arr[$k]['bh']=$v->bh;
			$arr[$k]['name']=$v->name;
			$arr[$k]['des']=$v->des;
			$arr[$k]['pbh']=$v->pbh;
		}
		$tree=self::getTree($arr);
		return $tree;
	}
	
	/**
	 * @name 遍历分类数组
	 */
	private static  function getTree($result,$pbh=0,$level=0)
	{
		static $typeTree;
		if(empty($result))
			return false;
		$level++;
		foreach ($result as $k=>$v)
		{
			if($v['pbh']==$pbh)
			{
				$v['level']=$level;
				$typeTree[]=$v;
				unset($result[$k]);
				self::getTree($result,$v['bh'],$level);
			}
		}
		return $typeTree;
	}
	
}