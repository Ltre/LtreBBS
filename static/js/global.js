$(function(){
	/**
	 * 普通登录/退出切换 
	 */
	$('#loginOrLogout').click(function(){
		var shell = $(this).attr('shell');
		if('login'===shell){
			$.post('?r=user/tologin', function(data){
				$('#left-content').html(data);
			});
			return false;
		}
		if('logout'===shell){
			$.post('?r=user/logout',function(data){location.href='./';});
		}
	});
	
	/**
	 * 微博登录
	 */
	$('#weibologin').click(function(){
		location.href = '?r=user/weibologin'; 
	});
	
	
	/**
	 * QQ登录
	 */
	$('#qqlogin').click(function(){
		//以下为按钮点击事件的逻辑。注意这里要重新打开窗口
		//否则后面跳转到QQ登录，授权页面时会直接缩小当前浏览器的窗口，而不是打开新窗口
		var A=window.open("?r=user/qq","TencentLogin", 
			"width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
	});
	
});