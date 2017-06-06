<?php 
if(empty($_COOKIE)){
	header('location:login.php');
}
//引入配置文件
include"/model/init.php";
//判断当前页面POST是否为空不为空就引入静态页
if(empty($_POST)){
	include "/view/regist.html";
}else{
//获取用户名并判断
	$reg['name']=trim($_POST['username']);
	if(empty($reg['name']))error('用户名不能为空');
//获取密码并判断
	$reg['password']=trim($_POST['password']);
	$creg['cfpwd']=trim($_POST['cfpwd']);
	if(empty($reg['password']&&$creg['cfpwd']))error('请输入确认密码');
	if($reg['password'] !== $creg['cfpwd'])error('密码不一致');
//获取验证码 email 是验证码名字没改
	$reg['email']=trim($_POST['checkcode']);
	if(empty($reg['email']))error('验证码不能为空');
//获取注册时间
	$reg['crtime']=time();
//插入数据库
$res=mExec('user',$reg);
//判断注册是否成功
if(!$res)error('注册失败');
succ('注册成功');
}
