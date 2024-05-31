<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['id'])) {
    $userName = $_SESSION['id'];
    $title = $_POST['title']; //*취약코드*
    $content = $_POST['content']; //*취약코드*
    // $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'); // *보안*코드
    // $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8'); // *보안*코드

    //화이트
    $allowed_extensions = array('txt', 'jpeg', 'jpg', 'png', 'zip');
    // 블랙리스트 설정 (제외할 확장자)
    $disallowed_extensions = array('php', 'asp', 'jsp');

    // 게시글 삽입
    $query = "INSERT INTO board (title, content, userName) VALUES ('$title', '$content', '$userName')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        // 새로 추가된 게시글의 idx 가져오기
        $new_board_idx = mysqli_insert_id($conn);
        $file = $_FILES['fileToUpload'];

        // 파일 정보 가져오기
        $file_name = basename($file["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // 파일 확장자가 허용된 확장자인지 확인
        if (!in_array($file_extension, $disallowed_extensions)) {
            // 업로드 경로 지정
            $target_dir = "uploads/";
            // 업로드될 파일의 실제 경로 설정
            $target_file = $target_dir . $file_name;

            // 이미지 파일 검사
            // $check = getimagesize($file["tmp_name"]);
            $check = $file["tmp_name"];
            if ($check !== false || $file_extension === 'txt' || $file_extension === 'zip') {
                // 파일을 지정된 경로로 이동하여 업로드
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    // 파일이 성공적으로 업로드된 경우 데이터베이스에 파일 정보 저장
                    // $name_orig = htmlspecialchars($file['name'], ENT_QUOTES, 'UTF-8'); // *보안* 코드
                    $name_orig = $file['name']; //*취약* 코드
                    $query = "INSERT INTO upload_file (name_orig, reg_time, board_num) VALUES('$name_orig', now(), $new_board_idx)";
                    $result = mysqli_query($conn, $query);

                    echo "<script>alert('성공적으로 게시글 작성을 성공하였습니다.');</script>";
                } else {
                    echo "<script>alert('파일 업로드에 실패하였습니다.');</script>";
                }
            } else {
                echo "<script>alert('허용되지 않는 파일 형식입니다1. 허용되는 형식은 txt, jpeg, jpg, png입니다.');</script>";
            }
        } else {
            echo "<script>alert('허용되지 않는 파일 형식입니다2. 허용되는 형식은 txt, jpeg, jpg, png입니다.');</script>";
        }
    } else {
        echo "<script>alert('게시글 작성 중 오류가 발생했습니다.');</script>";
    }
    mysqli_close($conn);
} else {
    echo "<script>alert('로그인 후 이용해주세요.');</script>";
}
echo "<script>window.location.href='/main.php';</script>";
?>