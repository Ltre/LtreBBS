<?php
//用户信息
class UserConnect extends Model{
	protected $table_name = 'userconnect';
		
	public function setLogin($openid, $nickname, $type='qq', $access_token=''){
		if( empty($openid)||empty($nickname)||empty($type))	return false;	
	
		$ret= $this->find(array('connect_openid'=>$openid, 'connect_type'=>$type), 'connect_id,uid');	
		$userdata = array();	
		//不存在，则插入数据
		if( empty($ret) ){
			//插入用户表数据
			$data = array(
				'thirdpart_type'=>'qq',
				'nickname'		=>$nickname,
			);
			$uid = obj('User')->insert($data);
			if(!$uid) return false;
			
			//插入第三方登录表数据
			$data = array(
				  'connect_openid'=>$openid,
				  'connect_type'=>$type,
				  'uid'=>$uid,
				  'connect_nickname'=>$nickname,
				  'access_token'=>$access_token,
			);
			$connect_id = $this->insert($data);
			if(!$connect_id) return false;
			
		}else{//存在，则更新数据
			$uid = $ret['uid'];
			$connect_id = $ret['connect_id'];
			
			//更新用户表，最后一次登录时间和ip
			$data = array(
				'thirdpart_type'=>'qq',
				'nickname'		=>$nickname,
			);
			obj('User')->update(array('uid'=>$uid), $data);
			
			//更新第三方登录用户昵称、性别、access_token
			$data = array(			  
				  'connect_nickname'=>$nickname,
				  'access_token'=>$access_token,
			);			
			$this->update(array('connect_id'=>$connect_id), $data);
		}
		session('user', $userdata);
		//return obj('User')->setLoginInfo($uid, 0, $nickname, 'qq');
	}
}
