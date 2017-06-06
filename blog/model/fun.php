<?php
function succ($msg='成功'){
	#$res='succ';
	echo $msg;
	#require ROOT."./view/admin/info.html";
	exit;
}
function error($msg='失败'){
	#$res='danger';
	echo $msg;
	#require ROOT."./view/admin/info.html";
	exit;
}
//日志系统封装函数
function mLog($log){
	$lo=ROOT.'/log/'.date('Y-m-d',time()).".text";
	$he="*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*"."\n"."\n".date('Y-m-d H:i:s',time())."\n";
	file_put_contents($lo,$he.$log."\n"."\n".'*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*--*'."\n"."\n",FILE_APPEND);
}
//创建路径
function createDir(){
	$path = '/images/'.date("Y/m/d");
	$abs=ROOT .$path;
	if(is_dir($abs)||mkdir($abs,0777,true)){
		return $path;
	}
}

//生成随机字符串做名字
function randStr($leng='6'){
	$str=str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz23456789');
	$str=substr($str,0,$leng);
	return $str;
}
//截取图片后缀名
function getExt($name){
	return strrchr($name,'.');
}

//获取IP函数封装
function getIp(){
	static $realip = null;
	if($realip !== null){
		return $realip;
	}
	if(getenv('HTTP_X_FORWARDED_FOR')){
		$realip = getenv('HTTP_X_FORWARDED_FOR');
	}elseif(getenv("HTTP_CLIENT_IP")){
		$realip = getenv('HTTP_CLIENT_IP');
	}else{
		$realip = getenv('REMOTE_ADDR');
	}
		return $realip;
}
/**
* 计算分页代码/假设显示5个页码数
* @param int $num 总文章数
* @param int $cnt 每页显示文章数
* @param int $curr 当前显示页码数
* @return arr $pages 返回一个页码数=>地址栏值的关联数组
*/
//封装分页代码
function paging($num,$cnt,$curr){
	$ing=ceil($num/$cnt);
	$left=max($curr-2,1);
	$right=min($ing,$left+4);
	$left=max($right-4,1);
	for ($i=$left; $i <=$right ; $i++) { 
		 $_GET['page']=$i;
		 $pages[$i] = http_build_query($_GET);

	}
	return $pages;
}

#var_dump(paging(99,2,30));