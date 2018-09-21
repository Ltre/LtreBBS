<?php
define('REWRITE',false);
define('DEVELOPMENT', "\\" == DIRECTORY_SEPARATOR  || '127.0.0.1'==$_SERVER['SERVER_ADDR']);
if(!defined('STORAGE_TEST'))define('STORAGE_TEST', false);//上传图片用远程地址 必备

if(DEVELOPMENT) {
	define('DEBUG',true);
	$_configs = array(
					'mysql'=>array(
						'MYSQL_HOST'=>'sqld.duapp.com',
						'MYSQL_PORT'=>4050,
						'MYSQL_USER'=>'gurzoQmUf010iyL24l72n3jB',
						'MYSQL_PASS'=>'CwG4gTqSRAN5yZVzkY2XnomG3DcmKBsf',
						'MYSQL_DB'=>'dTIwxfQOtsFegyoxsCJh',
						'MYSQL_CHARSET'=>'UTF8',
					),
			
					'session_prefix' => 'ltrebbs_', //会话名前缀，防止同域名下与其它应用冲突
			
				);
		    
				
}else { //线上配置
	define('DEBUG',false);
	$_configs = array(
					'mysql'=>array(
						'MYSQL_HOST'=>'127.0.0.1',
						'MYSQL_PORT'=>3306,
						'MYSQL_USER'=>'ltrebbs',
						'MYSQL_PASS'=>'oi5JhUyaKKkZQmOB',
						'MYSQL_DB'=>'ltrebbs',
						'MYSQL_CHARSET'=>'UTF8',
					),
				);
}

return $_configs;
