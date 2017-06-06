<?php 
function mConn(){
	static $link=null;
	if(!$link){
		$cfg = require ROOT."./model/config.php";
		@$conn=mysql_connect($cfg['host'],$cfg['user'],$cfg['pwd']);
		mysql_query('use '.$cfg['dbname'],$conn);
		mysql_query('set names '.$cfg['charset'],$conn);
		return $conn;
	}
	return $link;
}

function mQuery($sql){
	$res = mysql_query($sql,mConn());
	if($res){
		mLog($sql);
		return $res;
	}else
		mLog($sql.mysql_error());
	
	return $res;
}

function getAll($sql){
		$res=mQuery($sql);
		$arr=[];
		while ($x=mysql_fetch_assoc($res)) {
			$arr[]=$x;
		}
		return $arr;
}

function getOne($sql){
	$res=mQuery($sql);
	$rs=mysql_fetch_assoc($res);
	return $rs;
}
function getRow($sql){
	$res=mQuery($sql);
	$rs=mysql_fetch_row($res)[0];
	return $rs;
}

function mExec($table,$data,$act='insert',$where='0'){
	if($act == 'insert'){
		$sql='insert into '.$table." (";
		$sql.=implode(',', array_keys($data)).') '.'values'." ('";	
		$sql.=implode("','",array_values($data))."')";
		return mQuery($sql);
	}else if($act == 'update'){
		$sql='update '.$table.' set ';
		foreach($data as $k => $v){
			$sql.=$k.'="'.$v.'" ,';
		}
		$sql=rtrim($sql,',');
		$sql.='where '.$where;
		
		return mQuery($sql);
	}
}
// $data = array('username'=>'lili','age'=>23,'hobby'=>'pingpang','content'=>'hello');

// mExec('msg',$data,'update','cat_id=12');
