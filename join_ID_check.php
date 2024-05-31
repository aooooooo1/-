<?php
include "db_conn.php";

$userID = $_GET['id'];
$userID = $conn->real_escape_string($userID);

// 특수문자 검증을 위한 정규 표현식 추가
if (preg_match('/[^a-zA-Z0-9]/', $userID)) {
    echo "ID에는 특수문자가 포함될 수 없습니다."; 
} else {
    if ($userID != '') {
        $sql = "SELECT id FROM users WHERE id = '$userID'";
        $result = $conn->query($sql);

        if ($result === FALSE) {
            // SQL 에러가 발생한 경우
            echo "SQL 에러: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                echo "중복된 ID입니다.";
            } else {
                echo "사용할 수 있는 ID입니다.";
            }
        }
    } else {
        echo "ID를 입력해주세요.";
    }
}

$conn->close();
?>
