<?php
class DefaultController extends BaseController {

	// 登录界面
	public function actionIndex(){
		/* if( obj('User')->check() ){
			$this->redirect( url('posts/index') );
		}else{
			obj('User')->login( url('posts/index'), $this->title);
		} */
		$this->redirect( '?r=posts/list' );
	}
	
	// 登出
	public function actionLogout(){
		obj('User')->logout( url('default/index') );
	}
	
	//图片空间上传
	public function actionImageUpload(){
		echo json_encode($this->_upload());		
	}
	
	//编辑器上传
	public function actionEditorUpload(){
		$result = array('err' => '','msg' => '');
		$ret = $this->_upload();
		if( 1== $ret['status'] ){
			$result['msg'] = $ret['url'];
		}else{
			$result['err'] =  $ret['message'];
		}
		echo json_encode($result);
	}
	
	protected function _upload(){
		$result = array('status'=>0, 'message'=>'上传失败');
		if( !empty($_FILES['filedata']['tmp_name']) ) {
			$suffix = pathinfo($_FILES['filedata']['name'],PATHINFO_EXTENSION);
			$res = obj('dwFile')->uploadFile( $_FILES['filedata']['tmp_name'],$suffix);
			if( !empty($res['file_url']) ){
				$result['status'] = 1; //上传成功标志
				$result['url'] = htmlspecialchars($res['file_url']);
				$result['name'] = $_FILES['Filedata']['name'];
			}
		}
		return $result;	
	}
}