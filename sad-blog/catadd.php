<?php
include "/model/init.php";
if(empty($_COOKIE)){
	header('location:login.php');
}
if(empty($_POST)){
	include ROOT.'/view/catadd.html';
}else{
//判断栏目名称是否为空
	$cat['catname']=htmlspecialchars(trim($_POST['catname']));
	if(empty($cat['catname']))error('栏目名不能为空');
//查查有没有这个栏目有的话就不能添加了
	$catname=getRow("select catname from cat where catname='$cat[catname]'");
	if($catname === $cat['catname'])error('栏目名重复');
//插入栏目名
	$res=mExec('cat',$cat);
	if(!$res){
		error('添加失败');
	}else{
		header('location:index.php');//成功后跳转
	}
}
