<?php
include "./model/init.php";
if(isset($_GET['cat_id'])){
		$where = "and art.cat_id=$_GET[cat_id]";
	}else{
		$where = '';
	}
$sql="select art.*,catname from art inner join cat on art.cat_id=cat.cat_id where 1 ".$where;

$res = getAll($sql);
$catlist=getAll('select * from cat');
include ROOT."/view/catlist.html";