$(function(){
	
	/**
	 * 发布新主题，并跳转到发表结果页
	 */
	$('#posts_submit').click(function() {
		var title = $('#posts_title').val();
		var content = $('#posts_content').val();
		if(''===title || ''===content){
			alert('内容填写不完整');
			return false;
		}
		var data = {'title':title, 'content':content};
		$.post('?r=posts/pub', data, function(json){
			if('success'===json.code){
				alert(json.msg);
				$.post('?r=posts/view', {'id':json.data.id}, function(htmlz){
					$('#left-content').html( htmlz );
				});
			}else{
				alert(json.msg);
			}
		}, 'json');
	});
	
});
