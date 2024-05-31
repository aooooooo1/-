<?php
session_start(); // 세션 시작
include "db_conn.php";
// 사용자가 로그인되어 있는지 확인
$session_id = session_id();
$query = "SELECT * FROM login WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$logged_in = $user !== null;

mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>KISEC</title>
        <link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
        <style>
            
        </style>
    </head>
    <body class="text-center">
        <?php include 'header.php' ?>




        <div class="form-signin">
            <h5 class="mb-3 fw-bold">글 작성</h5>
            <form method='POST' action="/input_write.php" enctype="multipart/form-data">
                <div class="form-floating">
                    <input class="form-control" type="text" name="title" placeholder="">
                    <label>title</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" style="height:200px;" name="content" placeholder=""></textarea>
                    <label>content</label>
                </div>
                <input class="btn1" type="file" name="fileToUpload" style="width:300px;" accept=".jpeg, .jpg, .png, .txt, .zip">
                <input class="btn1" type="submit" value="저장">
            </form>
        </div>



        <footer>
			<p>&copy; 2024 Kisec. All rights reserved.</p>
			<p>본관 : 서울시 강남구 남부순환로 2645 한독빌딩 5층 SPACE HUM</p>
			<p>대표이사 : 이경빈 &nbsp;|&nbsp; 대표번호 : 02-921-1465 &nbsp;|&nbsp; 사업자등록번호 : 120-86-17944</p>
			<p></p>
		</footer>


    </body>
</html>