/*
依赖jquery和/static/kissy/1.3.2/kissy-min.js
具体参考http://gallery.kissyui.com/uploader/1.5/guide/index.html
*/
var imageUpload = {
	init:function(id, opt){
		opt= $.extend({action:'/?r=default/ImageUpload',max:10,maxSize:500}, opt);
		var tpl = '<span class="grid">'
				+	'<input class="g-u" id="J_UploaderBtn_'+id+'" name="filedata" type="file"' 
				+		'value="上传图片" action="'+opt.action+'" postData="" max="'+opt.max+'" maxSize="'+opt.maxSize+'">'			
				+	'<!--用来存放服务器端返回的图片路径，多个图片以逗号隔开-->'
				+	'<input type="hidden" id="J_Urls_'+id+'" name="'+id+'" value="">'
				+'</span>'
				+'<ul id="J_UploaderQueue_'+id+'" class="grid"></ul>';
		$('#'+id).html(tpl);
		this.uploader(id);
	},
	
	uploader:function(id){	
		var S = KISSY;
		S.Config.debug = false;
		S.config({
			packages:[
				{
					base:"/static/kissy/",
					name:"gallery",
				//	path:"/static/kissy2/",
					charset:"utf-8"
				}
			]
		});

		S.use('gallery/uploader/1.5/index,gallery/uploader/1.5/themes/imageUploader/index,gallery/uploader/1.5/themes/imageUploader/style.css', function (S, Uploader,ImageUploader) {
			//上传组件插件
			var plugins = 'gallery/uploader/1.5/plugins/auth/auth,' +
					'gallery/uploader/1.5/plugins/urlsInput/urlsInput,' +
					'gallery/uploader/1.5/plugins/proBars/proBars,' +
					'gallery/uploader/1.5/plugins/filedrop/filedrop,' +
					'gallery/uploader/1.5/plugins/preview/preview,' +
					'gallery/uploader/1.5/plugins/tagConfig/tagConfig';

			S.use(plugins,function(S,Auth,UrlsInput,ProBars,Filedrop,Preview,TagConfig){
				var uploader = new Uploader('#J_UploaderBtn_'+id,{
					//处理上传的服务器端脚本路径
					action:$('#J_UploaderBtn_'+id).attr('action')
				});
				//使用主题
				uploader.theme(new ImageUploader({
					queueTarget:'#J_UploaderQueue_'+id
				}))
				//验证插件
				uploader.plug(new Auth({
							//最多上传个数
							max:$('#J_UploaderBtn_'+id).attr('max'),
							//图片最大允许大小
							maxSize:$('#J_UploaderBtn_'+id).attr('maxSize')
						}))
					//url保存插件
						.plug(new UrlsInput({target:'#J_Urls_'+id}))
					//进度条集合
						.plug(new ProBars())
					//拖拽上传
						.plug(new Filedrop())
					//图片预览
						.plug(new Preview())
						.plug(new TagConfig())
				;

				//S.log('action:'+uploader.get('action'));
				//S.log(uploader.get('data'));
				//var auth = uploader.getPlugin('auth');
				//S.log(auth.get('max'));
				//S.log(auth.get('maxSize'));
			});
		})
	}
}
