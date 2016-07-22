<?php
class BaseController extends Controller {
	public $layout = 'layout.html';
	public $__page_title;
		
	public function __construct() {
		header('Content-type: text/html; charset=utf-8');
		// 不存在allows列表中的都需要检查权限
		 $public_pages = array(
			'default/index',
			'default/logout',
 			'posts/list',
		 	'posts/view',
		 	'posts/new',//框架不支持专用过滤器，不得不加到这个列表，再进行特殊处理
		 	'posts/pub',//框架不支持专用过滤器，不得不加到这个列表，再进行特殊处理
		 	'posts/reply',//框架不支持专用过滤器，不得不加到这个列表，再进行特殊处理
		 	'user/tologin',
		 	'user/login',
		 	'user/toreg',
		 	'user/reg',
		 	'user/logout',
		 	'user/weibologin',
		 	'user/qq',
		 	'user/qqcallback',
		);
		if( !in_array(CONTROLLER_NAME.'/'.ACTION_NAME, $public_pages) ) {
			$user = obj('User');
			if( !$user->check() ) $this->errorJumpOut( url('default/logout') );
			
			$this->userInfo =  $user->userInfo;
		}

		$this->userinfo = session('user');//有用的
		$this->loginOrLogout = obj('User')->check() ? 'logout' : 'login';
		$this->loginOrLogoutz = obj('User')->check() ? '退出' : '登录';
				
		//删除操作必须通过post方式
		if( ACTION_NAME=='del'&&false==$this->isPost() ){
			exit('del error');
		}
		parent::__construct();
	}

	public function display($tpl_name='', $return = false){
	
		$this->__page_title = '某论坛';
		$this->curentUrl = url( CONTROLLER_NAME . '/' . ACTION_NAME );	//当前网址
				
		//模板命名 默认为c_a.html
		$tpl_name =empty($tpl_name) ? CONTROLLER_NAME . '_' . ACTION_NAME : $tpl_name;
		$tpl_name .= '.html';	//模板后缀
		
		return @parent::display($tpl_name, $return);
	}
	
	//判断是否是数据提交	
	protected function isPost(){
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
	
	//直接跳转
	protected function redirect( $url ) {
		header('location:' . $url);
		exit;
	}
		
	//弹出信息
	protected function alert($msg, $url = NULL){
		header("Content-type: text/html; charset=utf-8"); 
		$alert_msg="alert('$msg');";
		if( empty($url) ) {
			$gourl = 'history.go(-1);';
		}else{
			$gourl = "window.location.href = '{$url}'";
		}
		echo "<script>$alert_msg $gourl</script>";
		exit;
	}

	
	private function errorJumpOut() {
		header("HTTP/1.0 403");
		echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function tips(){alert(\"登录过期，请重新登录！\");top.location.href=\"".url('default/logout')."\"}</script></head><body onload=\"tips()\"></body></html>";
		exit(0);
	}
	
}