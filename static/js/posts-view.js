$(function(){
	
	$('#replybutton').click(function(){
		var postid = $('#posts-id').val();
		if('' === postid){
			alert('该主题刚被删除，不能回复');
			return false;
		}
		var content = $('#reply-content').val();
		if('' === content){
			alert('不能回复空内容');
			return false;
		}
		$.post('?r=posts/reply', {'content':content, 'pid':postid}, function(json){
			if('success'===json.code){
				var htmlz = 
					'<div class="container-fluid"><div class="row-fluid"><!-- 左侧栏：回复人 --><div class="span4 pad scrollspy view-div" data-spy="scroll" style="text-align: center;"><img alt="头像" src="http://avatar.csdn.net/2/D/4/1_mecho.jpg" width="75" height="75"><span style="margin-top: 45px;display: block;">回复人：'
					 + json.data.nickname 
					 + '</span><span>'
					 + json.data.create_time
					 + '</span><!-- 回复时间 --></div><!-- 右侧栏：内容 --><div class="span8 pad view-div"><div>'
					 + json.data.content
					 + '</div></div></div></div>';
				$('#reply-list').html($('#reply-list').html()+htmlz);
			}else{
				alert(json.msg);
			}
		}, 'json');
	});
	
});
