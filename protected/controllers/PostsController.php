<?php
class PostsController extends BaseController {
	
	public function actionList(){
		$plist = obj('Posts')->select('', '', 'create_time desc', array($this->arg('p', 1), 10, 10) );
		foreach ($plist as $i=>$p){
			$plist[$i]['nickname'] = obj('User')->getNickname($p['uid']);
			$plist[$i]['create_time'] = date('Y-m-d H:i:s', $p['create_time']);
			$plist[$i]['update_time'] = date('Y-m-d H:i:s', $p['update_time']);
		}
		
		$this->posts_list = $plist;
		$this->page = obj('Posts')->page;
		$this->display();
	}
	
	
	
	
	public function actionView(){
		$id = $this->arg('id');
		
		$p = new Posts();
		$p = $p->find(array('id'=>$id));
		if(false === $p){
			/* echo json_encode(array('code'=>'notfound', 'data'=>null, 'msg'=>'该主题不存在'));
			die; */
			die('<h1 align=center>该主题不存在</h1>');
		}
		
		$u = new User();
		$nickname = $u->find(array('id'=>$p['uid']), 'nickname');
		$nickname = array_pop($nickname);
		if(false===$u){
			/* echo json_encode(array('code'=>'nouser', 'data'=>null, 'msg'=>'发表人不存在'));
			die; */
			die('<h1 align=center>发表人不存在</h1>');
		}
		$p['create_time'] = date('Y-m-d H:i:s', $p['create_time']);
		$p['update_time'] = date('Y-m-d H:i:s', $p['update_time']);
		$p['nickname'] = $nickname;
		$this->postinfo = $p;	//主题信息
		
		$r = new Reply();
		$rlist = $r->select(array('pid'=>$p['id']), '', 'create_time asc', array($this->arg('p', 1), 10, 10));
		foreach ($rlist as $i=>$rl){
			$rlist[$i]['nickname'] = obj('User')->getNickname($rl['uid']);
			$rlist[$i]['create_time'] = date('Y-m-d H:i:s', $rl['create_time']);
			$rlist[$i]['update_time'] = date('Y-m-d H:i:s', $rl['update_time']);
		}
		$this->replylist = $rlist;	//回复列表
		
		$this->layout = 'posts_view.html';//取消使用全局布局，供ajax调用
		$this->display();
	}
	
	
	
	public function actionNew(){
		$this->beforeNew();
		$this->layout = 'posts_new.html';//取消使用全局布局，供ajax调用
		$this->display();
	}
	
	private function beforeNew(){
		if(!obj('User')->check()){
			$this->redirect('?r=user/tologin');
			exit;
		}
	}
	
	
	public function actionPub(){
		$title = arg('title', '');
		$content = arg('content', '');
		$create_time = time();
		$user = session('user');
		$uid = $user['id'];
		
		if(empty($title) || empty($content)){
			echo json_encode(array('code'=>'empty', 'data'=>null, 'msg'=>'标题或内容为空'));
			die;
		}
		
		$p = new Posts();
		$data = array(
			'title'			=> $title,
			'content'		=> $content,
			'create_time'	=> $create_time,
			'update_time'	=> $create_time,
			'uid'			=> $uid,
		);
		$id = intval( $p->insert($data) );
		
		if(! empty($id) ){
			$data['id'] = $id;
			echo json_encode(array('code'=>'success', 'data'=>$data, 'msg'=>'发表成功'));
		}else{
			echo json_encode(array('code'=>'fail', 'data'=>null, 'msg'=>'发表失败'));
		}
		
	}
	
	
	

	public function actionReply(){
		$this->beforeReply();
		foreach (array('content', 'pid' ) as $p){
			$$p = arg($p);
		}
		$create_time = time();
		$user = session('user');
		$uid = $user['id'];
		
		if(empty($content)){
			echo json_encode(array('code'=>'empty', 'data'=>null, 'msg'=>'回复内容为空'));
			die;
		}
		if(empty($pid)){
			echo json_encode(array('code'=>'empty', 'data'=>null, 'msg'=>'该主题刚被删除'));
			die;
		}
		
		$r = new Reply();
		$data = array(
			'content'		=> $content,
			'uid'			=> $uid,
			'pid'			=> $pid,
			'create_time'	=> $create_time,
			'update_time'	=> $create_time,
		);
		$id = intval( $r->insert($data) );
		
		if(! empty($id) ){
			$data['id'] = $id;
			$data['nickname'] = obj('User')->getNickname($data['uid']);
			$data['create_time'] = date('Y-m-d H:i:s', $data['create_time']);
			$data['update_time'] = date('Y-m-d H:i:s', $data['update_time']);
			echo json_encode(array('code'=>'success', 'data'=>$data, 'msg'=>'回复成功'));
		}else{
			echo json_encode(array('code'=>'fail', 'data'=>null, 'msg'=>'回复失败'));
		}
	}
	
	private function beforeReply(){
		if(!obj('User')->check()){
			echo json_encode(array('code'=>'login', 'data'=>null, 'msg'=>'请先登录'));
			exit;
		}
	}
	
	
	
	
}