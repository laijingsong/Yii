<?php
class DCache
{
	/**
	 * 取缓存
	 * @param $id
	 */
	public static function get( $id )
	{
		$value = Yii::app()->cache->get( $id );
		if ( $value === false )
			return '';
		else
			return $value;
	}
	
	/**
	 * 设置缓存
	 */
	public static function set( $id = '', $data = '', $expirse = 3600 ) 
	{
		Yii::app()->cache->set( $id, $data, $expirse );
	}
	
	/**
	 * 基础
	 */
	public static function system($id,$expirse=3600,$fields='',$params=array())
	{
		return self::_refresh($id,$expirse,$fields,$params);
		$val=Yii::app()->cache->get($id);
		if($val===false)
		{
			return self::_refresh($id,$expirse,$fields,$params);
		}
		else 
		{
			return $val;
		}
	}
	
	/**
	 * 刷新缓存
	 */
	private static function _refresh($id,$expirse=3600,$fields,$params=array())
	{
		try
		{
			switch($id)
			{
				case '_province':
					$data=self::_base('Province',$fields);
					if($data)
						foreach ($data as $val)
							$d[$val['provinceId']]=$val['provinceName'];
					self::set($id,$d);
					break;
				case '_jprovince':
					$data=self::_base('Province',$fields);
					if($data)
						foreach ($data as $val)
							$d[$val['id']]=$val['provinceName'];
					self::set($id,$d);
					break;
				case '_city':
					$data=self::_base('City',$fields);
					if($data)
						foreach ($data as $val)
							$d[$val['cityUpId']][$val['id']]=$val['cityName'];
					self::set($id,$d);
					break;
				case '_jcity':
					$data=self::_base('City',$fields);
					if($data)
						foreach ($data as $val)
							$d[$val['id']]=$val['cityName'];
					self::set($id,$d);
					break;
				default:
					throw new Exception('数据不在接受的范围内');
					break;
			}
			return $d;
		}
		catch (Exception $error)
		{
			exit($error->getMessage());
		}
	}
	
	/**
	 * 基础数据
	 */
	private static function _base($id='',$fields='',$condition='')
	{
		$mod=ucfirst($id);
		$model=new $mod();
		$dataGet = $model->findAll( $condition );
		foreach ( (array) $dataGet as $key => $row ) {
			foreach ( (array) self::_attributes( $fields, $model ) as $attr )
				$returnData[$key][$attr] = $row->$attr;
		}
		return $returnData;
	}
	
	/**
	 * 取字段
	 * @param $model
	 */
	protected static function _attributes( $fields, $model = '' ) {
		if ( empty( $fields ) || trim( $fields ) == '*' ) {
			return $model->attributeNames();
		} else {
			$fields = str_replace( '，', ',', $fields );
			return explode( ',', $fields );
		}
	}
	
}