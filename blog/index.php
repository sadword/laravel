<?php
header("Content-type:text/html;charset=utf8");
include "./model/init.php";
if(empty($_POST)){
	if(isset($_GET['cat_id'])){
		$where = "and art.cat_id=$_GET[cat_id]";
	}else{
		$where = '';
	}
//使用分页函数	
	$num=getRow('select count(*) from art');
	$cnt=2;
	$curr=isset($_GET['page'])?$_GET['page']:1;
	$res=paging($num,$cnt,$curr);
//执行sq语句取出数据	
	$catlist=getAll('select * from cat');
	$list=getAll("select art.*,catname from art inner join cat on art.cat_id=cat.cat_id where 1".$where. ' order by art_id desc limit '.($curr-1)*$cnt.','.$cnt);
	$artlist=getAll('select title,content,catname,pubtime,art_id from art inner join cat on art.cat_id=cat.cat_id order by pubtime desc limit 6');
	include "./index.html";
}
