<?php
abstract class aDB {
/**
* 连接数据库,从配置文件读取配置信息
*/
abstract public function conn();
/**
* 发送query查询
* @param string $sql sql语句
* @return mixed
*/
abstract public function query($sql);
/**
* 查寻多行数据
* @param string $sql sql语句
* @return array
*/
abstract public function getAll($sql);
/***单行数据
* @param string $sql sql语句
* @return array
*/
abstract public function getRow($sql);
/**
* 查询总单个 count(*)
* @param string $sql sql语句
* @return mixed
*/
abstract public function getOne($sql);
/**
* 自动创建sql并执行
* @param array $data 关联数组建值对
* @param string $table 标名字
* @param string $act动作/update/insert
* @param string $where 条件update
* @return int 插入的行主键值或行数
*/
abstract public function Exec($data , $table , $act='insert' , $whe
re='0');
/**
* 返回上一条insert产生的主键值
*/
abstract public function lastId();
/**
* 返回上一条语句影响的行数
*/
abstract public function affectRows();
}
abstract class aUpload {
public $allowExt = array('jpg' , 'jpeg' , 'png' , 'rar');
public $maxSize = 1; // 最大上传M为单位
protected $error = ''; //错误信息
/**
* 分析$_FILES中$name域的信息 比例$_FILES中的['pic']
* @param string $name 表单中file表单项的那么直
* @return array 上传文件的信息,包含(tmp_name,oname[不含后缀的文件名称],ext[后缀],size)
*/
abstract public function getInfo($name);
/**
* 创建目录 在当前网站的根目录的image目录中 按年月日创建
* @return string 路径 例 ֺ /upload/2015/0331
*/
abstract public function createDir();
/**
* 生成随机文件名字
* @param int $len 随机字符创长度
* @return string 制定长度的随机字符串
*/
abstract public function randStr($len = 8);/**
* Ӥփ෈կ
* @param string $name 表单中FILE表单项的name
* @return string 上传文件的路径,从web根目录开始计/upload/2015/0331/a
.jpg
*/
abstract public function up($name);
/*
判断 $_FILES[$name]
调用getInfo 分析文件大小,后缀
调用checkType
调用checkSize
调用createDir
调用randStr生成随机文件名
移动,返回路径
*/
/**
* 检测文件的类型,如只允许jpg,jpeg,png,rer,不允许exe
* @param $ext 文件的后缀
* @return boolean
*/
abstract protected function checkType($ext);
/**
* 检测文件大小
* @param $size 文件大小
* @return boolean
*/
abstract protected function checkSize($size);
/**
*读取错误信息
*/
public function getError() {
return $this->error;
}
}
interface iImage {
/**
* 创建缩略图
* @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:
/www
* @param int width 缩略后的宽
* @param int height 缩略后的高
* @return string 缩略图的路径 以WEB/跟目录为起点
*/
static function thumb($ori , $width=200 , $height=200);
/**
* 添加水印
* @param string ori 原始图片路径,以web根目录为起点,/upload/xxxx,而不是D:
/www
* @param string $water 水印图片
* @return string 加水印的图片路径
*/static function water($ori , $water);
/**
* @return string 错误信息
*/
static function getError();
}
abstract class aPage {
public $size = 5; // 显示多少个页码
public $error = '';
public $offset = 0;
/**
* 计算分页代码
* @param int $num 总数量
* @param int $cnt 没一页条数
* @param int $curr 当前页
*/
abstract public function pagnation($num , $cnt , $curr);
}