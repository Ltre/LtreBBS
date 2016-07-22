$(function(){
	
	/**
	 * 查看某贴明细 
	 */
	$('.titlez>span').click(function(){
		var idz = $(this).attr('idz');
		$.post('?r=posts/view', {'id':idz}, function(data){
			$('#left-content').html(data);
		});
	});
	
	/**
	 * 点击进入发帖 
	 */
	$('[shell=posts-new]').click(function() {
		$.post('?r=posts/new', function(data){
			$('#left-content').html(data);
		});
	});
	
});


