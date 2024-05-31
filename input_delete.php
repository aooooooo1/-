<?php
include "db_conn.php";

if (isset($_GET['num'])) {
    $idx = intval($_GET['num']); // 정수로 변환하여 SQL 인젝션 방지

    $query = "DELETE FROM board WHERE idx = $idx";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                window.location.href='/main.php';
            </script>";
        } else {
            echo "<script>
                alert('삭제 중 오류가 발생했습니다.');
                window.location.href='/main.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('쿼리 실행 중 오류가 발생했습니다.');
            window.location.href='/main.php';
        </script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>
        alert('잘못된 접근입니다.');
        window.location.href='/main.php';
    </script>";
}
?>
