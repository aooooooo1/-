<?php
    include "db_conn.php";

    $pw = $_POST['pw'];
    $idx = $_POST['num'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $query = "select pw from board where idx=$idx";
    $result = mysqli_query($conn, $query);
    $re_cnt = mysqli_num_rows($result);
    if($re_cnt > 0){
        $row = mysqli_fetch_array($result);
        if($pw != $row['pw']){
            echo "<script>
                alert(\"비밀번호가 틀립니다.\");
                history.go(-1);
            </script>";
        }
        else {
            $query = "update board set title='$title', content='$content' where idx='$idx'  ";
            mysqli_query($conn, $query);
            echo "<script>
                alert(\"성공적으로 수정을 완료하였습니다.\");
                window.location.href='/list.php';
            </script>";
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>