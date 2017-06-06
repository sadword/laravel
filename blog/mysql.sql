/**
 * 创建用户名注册表通用登录表
 */
CREATE TABLE user (
  user_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name char(20) NOT NULL DEFAULT '',
  email char(30) NOT NULL DEFAULT '',
  password char(32) NOT NULL DEFAULT '',
  crtime int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/**
 * 创建留言表留言获取客户IP邮箱	
 */
 CREATE TABLE comm (
  comm_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  art_id int(10) unsigned NOT NULL,
  user_id int(10) unsigned NOT NULL DEFAULT '0',
  nick varchar(45) NOT NULL DEFAULT '',
  email varchar(30) NOT NULL,
  content varchar(1000) NOT NULL DEFAULT '',
  ip int(10) unsigned NOT NULL DEFAULT '0',
  pubtime int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (comm_id)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
 /**
 * 添加栏目	
 */
CREATE TABLE cat (
  cat_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  catname char(30) NOT NULL DEFAULT '',
  num smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (cat_id)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8; 
 /**
 * 添加文章
 */
CREATE TABLE art (
  art_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  cat_id smallint(5) unsigned DEFAULT '0',
  user_id int(10) unsigned DEFAULT '0',
  nick varchar(45) DEFAULT '',
  title varchar(45) DEFAULT '',
  content text,
  pubtime int(10) unsigned NOT NULL DEFAULT '0',
  comm smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (art_id)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;