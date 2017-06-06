<?php
include "./init.php";
class my{
  public $link = null;
  public function __construct(){
    $cfg = require "./config.php";
    $link=$this->link=mysqli_connect($cfg['host'],$cfg['user'],$cfg['pwd'],$cfg['dbname']);
    mysqli_query($link,'set names utf8');
    var_dump($this->link);
    return $link;
  }
  public function query($sql){
    return mysqli_query($this->link,$sql);
  }
  public function getAll($sql){
    $obj=$this->query($sql);
    $data=[];
    while($rs=mysqli_fetch_assoc($obj)){
      $data[]=$rs;
    }
    return $data;
  }
  public function getRow($sql){
    $obj=$this->query($sql);
    $row=mysqli_fetch_row($sql)[0];
    return $row;
  }
  public function getOne($sql){
    $obj=$this->query($sql);
    $one=mysqli_fetch_row($obj);
    return $one;
  }
  #inset into 表 xxx,xxx,xxx values 'xxx','xxx','xxx'
  #update 表 set xxx='xxx',xxx='xxx' where
  public function mExec($table,$data,$acr='insert',$where='0'){
    if($acr == 'insert'){
      $sql='insert into '.$table.'(';
      $sql.=implode(',',array_keys($data)).')'.'values'."('";
      $sql.=implode("','",array_values($data))."')";
      #echo $sql;
      return  $this->query($sql);
    }else if($acr == 'update'){
      $sql='update '.$table.' set ';
      foreach($data as $k => $v){
        $sql.=$k."='".$v."',";
      }
      $sql=rtrim($sql,',');
      $sql=$sql.' where = '.$where;
      #echo $sql;die;
      return  $this->query($sql);
    }
  }
}
// $sq= new my();
// // var_dump($sq->getAll('select * from art'));die;
// $data = array('username'=>'lili','age'=>23,'hobby'=>'pingpang','content'=>'hello');
//
// $sq->mExec('msg',$data,'update','12');
