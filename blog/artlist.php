<?php
include "./model/init.php";
if(empty($_COOKIE)){
	header('location:login.php');
}
if(empty($_POST)){
	$artid=$_GET['art_id'];
	if(!empty($artid)&&!is_numeric($artid))error('非法参数');
	$lm=getAll('select * from comm');
	$catlist=getAll('select catname from cat');
	$artlist=getAll("select * from art where art_id=$artid");
	include ROOT.'/view/artlist.html';
}
