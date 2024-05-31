<?php
session_start(); // 세션 시작

include "db_conn.php";

// 현재 세션 ID를 가져옴
$session_id = session_id();

// 데이터베이스에서 세션 ID 제거
$query = "UPDATE users SET session_id = NULL WHERE session_id = '$session_id'";
mysqli_query($conn, $query);
// 쿠키 삭제
setcookie("user_role_cookie", "", time() - 3600, "/");
// 세션 종료
session_unset();
session_destroy();

// 데이터베이스 연결 종료
mysqli_close($conn);

// 로그인 페이지로 리디렉션
header("Location: main.php");
exit();
?>
