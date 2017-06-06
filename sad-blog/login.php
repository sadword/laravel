<?php
//引入配置文件
include "./model/init.php";
//判断POST是否为空引入静态页
if(empty($_POST)){
	include "./view/login.html";
}else{
//获取登录的用户名
	$log['name']=addslashes(trim($_POST['username']));
	if(empty($log['name']))error('用户名不能为空');
//获取登录密码
	$log['password']=addslashes(trim($_POST['password']));
	if(empty($log['password']))error('密码不能为空');
//查询数据库并判断输入的用户名和数据库是否匹配
	$user=getOne("select * from user where name='$log[name]'");
	if($user['name']===$log['name']&&$user['password']===$log['password']){
		setcookie('name',time());
		header('location:index.php');
	}else{
		error("用户名或密码错误");
	}
// var_dump($user);die;
// var_dump($_POST);die;
}
