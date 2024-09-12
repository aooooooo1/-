# 목적
웹 해킹을 쉽게 할 수 있도록 취약한 웹페이지 입니다.
보안 코드도 삽입되어 있으니 여러 실습을 통해 sql 인젝션 공격 지식을 확보할 수 있습니다.
추가로 file upload 기능도 있으니 웹쉘 실습과 xss/csrf 를 통해 하이재킹 같은 실습도 가능합니다.

# 설정
## 데이터베이스
Server version	5.5.68-MariaDB
5버전 이상을 사용하시길 바랍니다.

## 테이블 생성

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

위와 같이 테이블을 생성하시면 됩니다.

## db_conn.php
$conn = mysql_connect("localhost", "사용자계정", "사용자비번", "데이터베이스이름")
서버 사용자 (root) 와 비번을 적으시고 생성한 db이름을 적으시면 됩니다.

![db구성도](https://github.com/user-attachments/assets/c461e252-721d-41b5-96ec-bbc87027fc73)

![skimg](https://github.com/user-attachments/assets/f5c7662f-bda1-4a38-84ee-add3a4b3750d)
