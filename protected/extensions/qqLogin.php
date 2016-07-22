<?php
//qq登录模块
class qqLogin{
    const GET_AUTH_CODE_URL = "https://graph.qq.com/oauth2.0/authorize";
    const GET_ACCESS_TOKEN_URL = "https://graph.qq.com/oauth2.0/token";
    const GET_OPENID_URL = "https://graph.qq.com/oauth2.0/me";
	const GET_USER_INFO_URL = "https://graph.qq.com/user/get_user_info";
	
	protected $appid = '';
	protected $appkey ='';
	
	protected $scope = 'get_user_info';	//申请的权限接口
	
	public function __construct($appid, $appkey){
		$this->appid = $appid;
		$this->appkey = $appkey;
	}
	
	//登录方法
	public function login($callback){
		$state = md5(uniqid(rand(), TRUE)); //CSRF protection
        $_SESSION['qqLoginState'] = $state;
		$_SESSION['qqLoginCallback'] = $callback;
		$params = array(
			"response_type" => "code",
            "client_id" => $this->appid,
            "redirect_uri" => $callback,
            "state" => $state,
            "scope" => $scope
		);
       $login_url = self::GET_AUTH_CODE_URL.'?'.http_build_query($params);
 	   header("Location:$login_url");
	   exit;
	}
	
	//登录成功回调的方法
	public function callback(){
		if($_GET['state'] != $_SESSION['qqLoginState']){ //csrf
			throw new Exception('The state does not match. You may be a victim of CSRF');
		}
	    $access_token = $this->getAccessToken();
		$openid = $this->getOpenid($access_token);

		$arr = $this->getUserInfo($access_token, $openid);
		$arr['access_token'] = $access_token;
		$arr['openid'] = $openid;
		
		return $arr;
	}
	
	//获取access_token
	public function getAccessToken(){
		$params = array(
            'grant_type' => 'authorization_code',
            'client_id' => $this->appid,
            'redirect_uri' => $_SESSION['qqLoginCallback'],
            'client_secret' => $this->appkey,
            'code' => $_GET['code']
        );
		
		$token_url = self::GET_ACCESS_TOKEN_URL.'?'.http_build_query($params);
		
		//$response = file_get_contents($token_url);
		$response = obj('dwHttp')->get($token_url);
		
		if (strpos($response, "callback") !== false){
			$lpos = strpos($response, "(");
			$rpos = strrpos($response, ")");
			$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
			$msg = json_decode($response);
			//失败
			if (isset($msg->error)){
				throw new Exception($msg->error.':'.$msg->error_description);
			}
		}
		
		//成功,返回token
		$params = array();
		parse_str($response, $params);
		if( empty($params["access_token"]) ){
			throw new Exception('access_token error');
		}
		return  $params["access_token"];
	}

	//获取openid
	public function getOpenid($access_token){
		$graph_url = self::GET_OPENID_URL.'?access_token='. $access_token;
	
		//$response  = file_get_contents($graph_url);
		$response = obj('dwHttp')->get($graph_url);
        
		if(strpos($response, "callback") !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($response);
        if(isset($user->error)){
            throw new Exception($user->error, $user->error_description);
        }
		if( empty($user->openid) ){
			throw new Exception('openid error');
		}
        return $user->openid;
	}
	
	//获取用户信息
	public function getUserInfo($access_token, $openid){
		$params = array(
            'access_token' => $access_token,
            'oauth_consumer_key' => $this->appid,
            'openid' => $openid,
            'format' => 'json',
        );
		$user_info_url = self::GET_USER_INFO_URL.'?'.http_build_query($params);
		$response = obj('dwHttp')->get($user_info_url);
		if( empty($response) ){
			throw new Exception('getUserInfo error');
		}
		return json_decode($response, true);
	}
}