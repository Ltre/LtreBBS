<?php 
class TestController extends BaseController{
	
	public function actionIndex(){
		foreach(glob("protected/data/tmp/*.log") as $file){
			echo '<a href="/'. $file .'">'. $file .'</a>';
			echo "  ";
			echo intval(filesize($file)/1024)."KB ";
			echo date("Y-m-d H:i:s", filemtime($file));
			echo "<br>";
		}
	}
	
/*	
    public function actionFix(){
		echo '<pre>';
		$sql = "select pai2_user.uid, pai2_user.yyuid, pai2_money_record.money from pai2_money_record,pai2_user where pai2_user.uid=pai2_money_record.uid and goods_id=16";
		$db = obj('User');
		$list = $db->query($sql);
		foreach($list as $v){
			echo $yyuid = $v['yyuid'];
			echo '&&';
			echo $uid = $v['uid'];
			//print_r( $db->query("SELECT `money` FROM user_info WHERE yyuid=$yyuid") );
			//$db->execute("UPDATE `user_info` SET `money` = `money`+{$money} WHERE yyuid={$yyuid} AND money=0");
			$db->query("UPDATE `pai2_money_record` SET `record_status` = 1 WHERE uid=$uid and goods_id=16");
			$db->query("UPDATE `pai2_goods_record` SET `record_status` = 1 WHERE uid=$uid and goods_id=16");

		}		
	}
*/
	
	public function actionChong(){
	
		//$ret = obj('Recharge')->testQQ(2);
		
		//echo $ret = obj('Recharge')->getProductList('ABJSUPZGDX');
		echo $ret = obj('Recharge')->getProductList('AAJSUPTXQB');
		/*$ret = obj('Recharge')->select(array(
								'goods_record_id'=>'pai_1_33242_313212820_1_08041004'
							));
		dump($ret);	*/				
	}
	
	public function actionTest(){
       $username = "aaa";    
       $pwd = "pwd";    
       $sql = "SELECT * FROM table WHERE username = ? AND pwd = ?";    
       bindParam($sql, 1, $username, 'STRING');  //以字符串的形式.在第一个问号的地方绑定$username这个变量    
       bindParam($sql, 2, $pwd, 'STRING');       //以字符串的形式.在第二个问号的地方绑定$pwd这个变量    
       echo $sql;  
	}
	public function actionDates(){
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $date = date("Y-m-d H:i:s",$endToday);
        echo $date;exit();

	}

	public function actionSendmsg(){
	/*	$tel = '18658002005,15668375951,18655228501,18502645304,18502808175,13145799356,15335928009,15503081396,13037134164,13264242088';
		$res = explode(',', $tel);

		//$res = obj('dwSMS')->send($tel, '感谢您关注私密圈活动！很抱歉的通知您，鉴于合作方充值系统近期维护，您在活动中兑换的话费将延期至本月中充值至您账户！届时会有短信通知，请留意。再次感谢您对我们活动的理解与支持。');
		dump($res);exit();
		if ($res == '1') {
			echo "success";
		}else{
			echo "fail";
		}*/
		$arr = array(1,2,3,4,5,6);
		foreach ($arr as $k => &$v) {
			
		}
		foreach ($arr as $key => $value) {
			# code...
		}
        var_dump($arr);
	}

	//紧急关闭新闻任务
	public function actionClose(){
		$ret = obj('Task')->find(array('task_id'=>'10023'));
		var_dump($ret);die;
		$ret = obj('Task')->update(array('task_id'=>'10023'), array('task_start_time'=>1922391200, 'task_end_time'=>2022391200));
		echo '操作结果：'; var_dump($ret);		
	}
	
}