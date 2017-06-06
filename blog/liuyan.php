<?php 
include "./model/init.php";
if(empty($_COOKIE)){
	header('location:login.php');
}
if(empty($_POST)){
	include "./view/luyan.html";
}else{
//获取art_id 使用get接收
	$comm['art_id']=trim($_GET['art_id']);
	if(empty($comm['art_id']))error('非法参数');
//判断用户名是否为空
	$comm['nick']=trim($_POST['name']);
	if(empty($comm['nick']))error('用户名不能为空');
//判断email是否为空
	$comm['email']=trim($_POST['email']);
	if(empty($comm['email']))error('email不能为空');
//判断内容不能为空
	$comm['content']=trim($_POST['content']);
	if(empty($comm['content']))error('内容不能为空');
//获取当前的时间戳
	$comm['pubtime']=time();
//获取来访者的IP 地址
	$comm['ip']= sprintf('%u',ip2long(getIp()));
//插入数据库
	$res=mExec('comm',$comm);
	if(!$res){
		error('写入失败');
	}else{
		header('location:index.php');
	}
}
