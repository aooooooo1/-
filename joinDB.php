<?php
    include "db_conn.php";
    $userName = $_POST['userName'];
    $pw = $_POST['pw'];
    $id = $_POST['id'];

    // 비밀번호 해시 생성
    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

    // 쿼리문에서 비밀번호를 해시로 변경
    $query = "INSERT INTO users (id, pw, userName) VALUES ('$id', '$hashed_password', '$userName')";

    $result = mysqli_query($conn, $query);
    $re_cnt = mysqli_num_rows($result);
    if($result){
        
    }
    else{
        echo "<script>alert(\"  join error\")</script>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    echo "<script>window.location.href='/main.php';</script>";
?>