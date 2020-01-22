CREATE DATABASE IF NOT EXISTS member;

CREATE TABLE users (
  id int(3) unsigned zerofill NOT NULL auto_increment,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  email varchar(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY Firstname (firstname)
) ENGINE=MyISAM  AUTO_INCREMENT=3 ;