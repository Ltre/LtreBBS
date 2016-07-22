<?php
class User extends Model {

	protected $table_name = 'ltrebbs_user';
	
	function getNickname($id){
		$u = $this->find(array('id'=>$id));
		$nickname = $u['nickname'];
		return $nickname;
	}
	
	function userinfo(){
		
		return array();
	}
	
	function check() {
		if(session_exists('user') && array_key_exists('id', session('user')))
			return true;
		else
			return false;
	}
	
}
// dump(debug_backtrace());