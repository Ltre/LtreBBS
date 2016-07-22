//获取随机数
function getRand(min, max){
	return Math.floor(Math.random() * ( max - min )) + min;
}

//获取随机颜色
function getRandColor(){
	return '#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);
}

//打乱数组
function upsetArray(arr){
	arr.sort(function(x){ 
		if (x % 2 ==0) return 1; 
		if (x % 2 !=0) return -1; 
	}); 
	var str=arr.join();
	return arr;
}