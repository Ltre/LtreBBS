
$(function(){
	
	/**
	 *初始化右侧栏 
	 */
	var keywords = [
	    'AIP架构', '爬虫技术', '异类的翻墙方式', 'WEB提权的N种方法', '万能漏洞扫描器', 
	    '压缩炸弹生成器', '免杀技术', '多层代理', 'PS4主机破解'
	];
	for(var i in keywords){
		var size = getRand(16, 55);
		var color = getRandColor();
		keywords = upsetArray(keywords);
		var tag = '<span style="font-size: ' + size + 'px;line-height: ' + (size + 20) + 'px;color: ' + color + ';margin:0 25px;">' + keywords[i] + '</span>';
		$('#tags').append($(tag));
		/*document.write('<span style="font-size: ' + size + 'px;line-height: ' + (size+10) + 'px;color: ' + color + ';">' + keywords[i] + '</span>');
		document.write('&nbsp;&nbsp;');*/
	}

	
});