<?php
class dwUDB{
	private $_udbUrl = 'http://webapi.duowan.com/api_udb2.php';
	private $_yyUrl = 'http://webapi.duowan.com/yy_to_uid/api_yytouid.php';
		
	//检查是否登录，如已经登录返回sername,yyuid数组,否则返回空数组
	public function isLogin(){	
		$data['COOKIE[username]'] = @$_COOKIE['username'];
		$data['COOKIE[password]'] = @$_COOKIE['password'];
		$data['COOKIE[osinfo]'] = @$_COOKIE['osinfo'];
		$data['COOKIE[oauthCookie]'] = @$_COOKIE['oauthCookie'];
		$data['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
		$data['HTTP_HOST'] = $_SERVER['HTTP_HOST'];

		$ret = $this->curlPost($this->_udbUrl, $data);
		$result = array();
		if( strlen($ret)>10 ){
			$result = unserialize($ret);
			$result = is_array($result) ? $result : array();
		}

		return $result;
	}
	
	//yy号转uid,有ip白名单限制
	public function yy2uid($yy){
		$data = array();
		$data['yy'] = is_array($yy) ? implode(',', $yy): $yy ;
		$ret = $this->curlPost($this->_yyUrl, $data);
		$json = json_decode($ret, true);
		if( isset($json['code']) && 1==$json['code'] ){
			return $json['data'];
		}
		return false;
	}
	
	//uid转yy号,有ip白名单限制
	public function uid2yy($uid){
		$data = array();
		$data['yyuid'] = is_array($uid) ? implode(',', $uid): $uid;
		$ret = $this->curlPost($this->_yyUrl, $data);
		$json = json_decode($ret, true);
		if( isset($json['code']) && 1==$json['code'] ){
			return $json['data'];
		}
		return false;	
	}
	
	//通过curl post数据
	protected function curlPost($url, $data = array()) {
		$ch = curl_init(); 
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true, 
			CURLOPT_POST => true,
			CURLOPT_NOSIGNAL=>true,
			CURLOPT_CONNECTTIMEOUT_MS => 200,
			CURLOPT_TIMEOUT_MS => 2000,
			CURLOPT_POSTFIELDS => http_build_query($data),
		)); 	
		$ret = curl_exec($ch); 
		curl_close($ch); 		
		return $ret;
	}
		
}
?>