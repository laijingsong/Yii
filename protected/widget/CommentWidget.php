<?php
class CommentWidget extends CWidget
{
	public $type;
	public $id;
	public $limit;
	public $uid;
	
	public function init()
	{
		
	}
	
	public function run()
	{
		$criteria=new CDbCriteria();
		if($this->type==0)
			$criteria->addCondition('dpid='.$this->id);
		else
			$criteria->addCondition('fdid='.$this->id);
		//分页
		$count=Comment::model()->count($criteria);
		$paper=new CPagination($count);
		$paper->pageSize=$this->limit;
		$paper->applyLimit($criteria);
		//列表
		$criteria->limit=$this->limit;
		$criteria->with='commentreply';
		$criteria->order='id desc';
		$list=Comment::model()->findAll($criteria);
		$data=$list;		
		//用户信息
		if($data)
		{
			foreach ($list as $v)
			{
				$uid[]=$v->uid;
				if($v->commentreply)
					foreach ($v->commentreply as $val)
						$uid[]=$val->uid;
			}
		}
		if($uid)
		{
			$uid=array_unique($uid);
			$u=Member::model()->getUserInfo($uid);
		}
		
		$this->render('comment',array(
			'data'=>$data,
			'u'=>$u,
			'pages'=>$paper,
			'count'=>$count,
			'type'=>$this->type,
			'id'=>$this->id,
		));
	}
	
}