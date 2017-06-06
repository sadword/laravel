<?php
include "./model/init.php";
if(empty($_POST)){
//查询所有的栏目并显示
	$catlist=getAll('select * from cat');
	include ROOT.'/view/artadd.html';
}else{
//判断文章名称
	$art['title']=trim($_POST['name']);
	if(empty($art['title']))error('文章名称不能为空');
//判断邮箱
	$art['nick']=trim($_POST['email']);
	if(empty($art['nick']))error('邮箱名称不能为空');
//判断栏目ID
	$art['cat_id']=trim($_POST['cat_id']);
	if(!is_numeric($art['cat_id']))error('非法参数');
//判断内容
	$art['content']=htmlspecialchars(trim($_POST['content']));
	if(empty($art['content']))error('内容不能为空');
//获取发布时间
	$art['pubtime']=time(); 
//获取上传的图片移动到当前文件夹
	if(!empty($_FILES)&&$_FILES['pic']['error'] == 0){
		$des=createDir().'/'.randStr().getExt($_FILES['pic']['name']);
		move_uploaded_file($_FILES['pic']['tmp_name'] , ROOT.$des);
		$art['pic']=$des;
	}
//插入数据库
	$res=mExec('art',$art);
	if(!$res){
		error('发布失败');
	}else{
		$rs=mQuery("update cat set num=num+1 where cat_id='$art[cat_id]'");
		if(!$rs)error('流程失败');
		header('location:index.php');
	}
	
}
