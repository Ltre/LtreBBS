<?php
class UserController extends BaseController {
	
	public function actionLogin(){
		$username = arg('username');
		$password = sha1(arg('password'));
		$u = new User();
		$user = $u->find(array('username'=>$username, 'password'=>$password));
		if(empty($user)){
			echo json_encode(array('code'=>'fail', 'data'=>null, 'msg'=>'登录名或密码错误'));
			die;
		}
		session('user', $user);
		echo json_encode(array('code'=>'success', 'data'=>$user, 'msg'=>'登录成功'));
	}
	
	public function actionToLogin(){
		$this->layout = 'user_tologin.html';//取消layout
		$this->display();
	}
	
	public function actionReg(){
		$username = arg('username');
		$password = sha1(arg('password'));
		$nickname = arg('nickname');
		$u = new User();
		$data = array(
			'username'	=> $username,
			'password'	=> $password,
			'nickname'	=> $nickname,
			'avatar'	=> 'http://www.kusha.biz/uc_server/avatar.php?uid=20&s',
		);
		$id = intval( $u->insert($data) );
		if(empty($id)){
			echo json_encode(array('code'=>'fail', 'data'=>null, 'msg'=>'注册失败'));
			die;
		}
		$data['id'] = $id;
		echo json_encode(array('code'=>'success', 'data'=>$data, 'msg'=>'注册成功'));
		session('user', $data);
	}
	
	public function actionToReg(){
		$this->layout = 'user_toreg.html';//取消layout
		$this->display();
	}
	
	public function actionWeiboLogin(){
		$url = 'https://api.weibo.com/oauth2/authorize?client_id=2730756970&response_type=code&redirect_uri=YOUR_REGISTERED_REDIRECT_URI';
	}
	
	
	public function actionQq(){
		$callback = 'http://'.$_SERVER['HTTP_HOST'].'/user/qqcallback';
		$_SESSION[$GLOBALS['app_id']]['refer'] = $this->arg('refer');
		obj('qqLogin', array('1102292717', 'pyopfrRFRzCKLyAo'))->login($callback);
	}
	
	public function actionQqCallback(){
		try{
			$ret = obj('qqLogin', array($GLOBALS['qqLogin']['appid'], $GLOBALS['qqLogin']['appkey']))->callback();
			obj('UserConnect')->setLogin($ret['openid'], $ret['nickname'], 'qq', $ret['access_token']);
		}catch(Exception $e){
			dump($e->getMessage());
		}
		$callback = $_SESSION[$GLOBALS['app_id']]['refer'];
		$callback = str_replace('http://'.$_SERVER['HTTP_HOST'], '', $callback);
		if( preg_match("/^(http:\/\/)/i", $callback) ){
			$callback = '/';
		}
		if( empty($callback) ) $callback = '/';
		header('Location:'.$callback);
	}
	
	public function actionLogout(){
		session('user', null);
	}
	
}