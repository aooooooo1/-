## -- Server version	5.5.68-MariaDB

### 테이블 생성

CREATE TABLE `board` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `wdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) 

CREATE TABLE `upload_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_orig` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `board_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) 

CREATE TABLE `users` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) DEFAULT NULL,
  `pw` varchar(255) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `authority` enum('general','admin') DEFAULT 'general',
  PRIMARY KEY (`idx`)
) 

## db_conn.php
자신의 데이터베이스 이름과 비번 사용자 계정을 적으면 됩니다.
