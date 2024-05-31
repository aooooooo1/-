<?php
include "db_conn.php";

// file_id 값이 전달되었는지 확인
if (isset($_GET['file_id']) || isset($_GET['name_orig'])) {
    $file_id = (int)$_GET['file_id'];


    //파일 네임 가져오기
// if (isset($_GET['name_orig'])) {
//     $name_orig = $_GET['name_orig'];
//     $file_path = 'uploads/' . $name_orig; 

//     // 파일이 존재하는지 확인
//     if (file_exists($file_path)) {
//         // 파일이 존재하면 새 탭에서 파일을 열도록 리다이렉트
//         $file_url = 'uploads/' . $name_orig;
//         // 파일이 존재하면 파일 내용을 읽어서 화면에 출력 (추가됨)
//         $file_contents = file_get_contents($file_path);
        
//         // 파일의 내용을 안전하게 브라우저에 출력하기 위해 HTML 엔티티 변환 (추가됨)
//         $safe_contents = htmlspecialchars($file_contents, ENT_QUOTES, 'UTF-8');

//         // 파일 내용을 출력 (추가됨)
//         echo "<pre>$safe_contents</pre>";
//         echo "<script>window.location.href = '$file_url';</script>";
//     } else {
//         echo "파일이 존재하지 않습니다.";
//     }
// } else {
//     echo "파일 이름이 지정되지 않았습니다.";
//}

    //file_id에 해당하는 파일 정보 가져오기
    $query = "SELECT name_orig FROM upload_file WHERE file_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $file_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_name = $row['name_orig'];
        $file_path = "uploads/" . $file_name;


        // 취약 코드####################
        if (file_exists($file_path)) {
            echo "<script>window.location.href = '$file_path';</script>";
        } else {
            echo "파일이 존재하지 않습니다.";
        }
        //##############################


        // ########보안 코드 파일이 존재하는지 확인
        // if (file_exists($file_path)) {
        //     header('Content-Description: File Transfer');
        //     header('Content-Type: application/octet-stream');
        //     header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        //     header('Expires: 0');
        //     header('Cache-Control: must-revalidate');
        //     header('Pragma: public');
        //     header('Content-Length: ' . filesize($file_path));
        //     flush(); 
        //     readfile($file_path); 
        //     exit;
        // } else {
        //     echo "파일이 존재하지 않습니다.";
        // }
        // ############################


    
    } else {
        echo "잘못된 파일 ID입니다. Invalid file ID ";
    }
} else {
    echo "파일 ID가 지정되지 않았습니다.";
}

mysqli_close($conn);
?>
