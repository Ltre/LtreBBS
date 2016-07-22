<?php
function mtime(){
	list($usec, $sec) = explode(" ", microtime());
	return substr($sec.substr($usec, 2, 6), 0, 13);
}

function getip(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_CDN_SRC_IP'])){
			$ip = $_SERVER['HTTP_CDN_SRC_IP'];		
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  //to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else{
			$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

// 自动包含类
function __autoload($className) {
    if (class_exists($className, false) || interface_exists($className, false)) {return false;}
    
    $types = array(
        'models',
        'extensions',
        'controllers',
        'framework',
        'framework' . DIRECTORY_SEPARATOR . 'lib',
    );
    
    $file_exists = false;
    $basePath = BASE_DIR . 'protected' . DIRECTORY_SEPARATOR;
    
    $pathName = DIRECTORY_SEPARATOR . str_replace("_", DIRECTORY_SEPARATOR, $className) . '.php';
    foreach ($types as $type) {
        $file = $basePath . $type . $pathName;
        if (file_exists($file)) {
            require_once $file;
            $file_exists = true;
        } 
        // var_dump($file);
    }
}

/**
 * 取本应用的会话
 * session($name)取会话；session($name, $value)设置会话；session()取所有会话。
 * 按名称存取会话时，将只会取出名称被指定前缀的会话。
 * @param string $name 会话名
 * @param string $value 设置值
 * @param string $prefix 会话名前缀
 * @param string $private 要取出所有会话的时候，是否只取出本应用私有的会话（即仅带前缀的会话）
 */
function session($name=null, $value=null, $prefix=null, $private=true){
	$num = count(func_get_args());
	$prefix = null===$prefix ? $GLOBALS['session_prefix'] : $prefix;
	if(2 === $num){
		$name = func_get_arg(0);
		$value = func_get_arg(1);
		$_SESSION[$prefix.$name] = $value;
	}
	else if(1 === $num){
		return $_SESSION[$prefix.$name];
	}
	else if(0 === $num){
		if($private){
			$zezzion = array();
			foreach ($_SESSION as $i=>$s){
				if(0===strpos($i, $prefix))
					$zezzion[$i] = $s;
			}
			return $zezzion;
		}else{
			return $_SESSION;
		}
	}
}

//会话是否存在
function session_exists($name, $prefix=null){
	$prefix = null===$prefix ? $GLOBALS['session_prefix'] : $prefix;
	return isset($_SESSION[$prefix.$name]);
}