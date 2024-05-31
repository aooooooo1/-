<?php
session_start(); // 세션 시작
include "db_conn.php";
// 사용자가 로그인되어 있는지 확인
$session_id = session_id();
$query = "SELECT * FROM users WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$logged_in = $user !== null;

mysqli_free_result($result);
mysqli_close($conn);

$message = "";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>SKkisec</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<style>
			th {
				padding: 10px;
			}
			td{
                padding: 10px;
            }
            tr{
                border-bottom : 1px solid lightgray;
            }
            a {
                color: black;
				text-decoration: none;
            }

            .container {
            display: flex;
            width: 500px;
            border: 1px solid #ccc;
            padding: 10px;
            align-items: center;
            }
            .container .photo {
                flex: 1;
                margin-right: 10px;
            }
            .container .photo img {
                width: 100%;
                height: auto;
            }
            .container .info {
                flex: 2;
            }
            .container .info label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            .container .info span,
            .container .info input {
                display: block;
                width: 100%;
                padding: 5px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }
            .container .info span {
                border: none;
                padding: 0;
                margin-bottom: 10px;
            }
	</style>
	</head>
	<body>
	<?php include 'header.php' ?>

		<?php
            include "db_conn.php";
			
			// 검색어가 있는지 확인
			$searchKeyword = '';
			if(isset($_GET['searchKeyword'])) {
				// 검색어를 안전하게 처리
				$searchKeyword = $_GET['searchKeyword'];
				// $searchKeyword = mysqli_real_escape_string($conn, $_GET['searchKeyword']);
			}
			// 기본 쿼리문
			$query = "SELECT idx, userName, title, content, wdate FROM board";
			// 검색어가 있을 경우 쿼리문에 조건 추가
			if(!empty($searchKeyword)) {
				$query .= " WHERE title LIKE '%$searchKeyword%' OR content LIKE '%$searchKeyword%' OR userName LIKE '%$searchKeyword%'";
			}

			$query .= " ORDER BY idx DESC";
            $result = mysqli_query($conn, $query);
			
			if (!$result) {
				die("Error: " . mysqli_error($conn));
			}
        ?>
		<!-- 검색 폼 -->
		<div style="text-align: center; margin: 10px;">
			<form method="get" action="">
				<input type="text" name="searchKeyword" placeholder="검색어를 입력하세요" value="" style="padding:7px; border-radius:10px; border-color:#e5e5e5; width: 450px">
				<input type="submit" class="btn1" value="검색">
			</form>
		</div>




        <div class="container">
            <div class="photo">
                <img src="img/ksj.png" alt="Photo">
            </div>
            <div class="info">
                <div style="display:flex;">
                    <label for="name" style="margin-right:10px;">Name</label>
                    <span id="name" style="display:flex; justify-content:center;">김성진</span>
                </div>

                <div style="display:flex;">
                    <label for="email" style="margin-right:10px;">Email</label>
                    <span id="name" style="display:flex; justify-content:center;">pdqovvarxx@naver.com</span>
                </div>
                <div style="display:flex;">
                    <label for="address" style="margin-right:10px;">Address</label>
                    <span id="name" style="display:flex; justify-content:center;">서울 강서구 화곡로 66길 153</span>
                </div>
                <div style="display:flex;">
                    <label for="phone" style="margin-right:10px;">Phone</label>
                    <span id="name" style="display:flex; justify-content:center;">010-7613-9012</span>
                </div>
                <div style="display:flex;">
                    <label for="age" style="margin-right:10px;">Age</label>
                    <span id="name" style="display:flex; justify-content:center;">27</span>
                </div>
                <!-- <div style="display:flex;">
                    <label for="grade" style="margin-right:7px;">성적</label>
                    <span id="grade" style="margin:0 auto; width:37px;">20</span>
                </div> -->
            </div>
        </div>
        <div class="container">
            <div class="photo">
                <img src="img/ngky.png" alt="Photo">
            </div>
            <div class="info">
                <div style="display:flex;">
                    <label for="name" style="margin-right:10px;">Name</label>
                    <span id="name" style="display:flex; justify-content:center;">남궁길영</span>
                </div>

                <div style="display:flex;">
                    <label for="email" style="margin-right:10px;">Email</label>
                    <span id="name" style="display:flex; justify-content:center;">rlfdud6212@naver.com</span>
                </div>
                <div style="display:flex;">
                    <label for="address" style="margin-right:10px;">Address</label>
                    <span id="name" style="display:flex; justify-content:center;">서울 강서구 좌영번영로 64길 </span>
                </div>
                <div style="display:flex;">
                    <label for="phone" style="margin-right:10px;">Phone</label>
                    <span id="name" style="display:flex; justify-content:center;">010-2835-9006</span>
                </div>
                <div style="display:flex;">
                    <label for="age" style="margin-right:10px;">Age</label>
                    <span id="name" style="display:flex; justify-content:center;">25</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="photo">
                <img src="img/kde.png" alt="Photo">
            </div>
            <div class="info">
                <div style="display:flex;">
                    <label for="name" style="margin-right:10px;">Name</label>
                    <span id="name" style="display:flex; justify-content:center;">김도은</span>
                </div>

                <div style="display:flex;">
                    <label for="email" style="margin-right:10px;">Email</label>
                    <span id="name" style="display:flex; justify-content:center;">doen33@naver.com</span>
                </div>
                <div style="display:flex;">
                    <label for="address" style="margin-right:10px;">Address</label>
                    <span id="name" style="display:flex; justify-content:center;">서울 강서구 화곡로 68길 146</span>
                </div>
                <div style="display:flex;">
                    <label for="phone" style="margin-right:10px;">Phone</label>
                    <span id="name" style="display:flex; justify-content:center;">010-4876-4155</span>
                </div>
                <div style="display:flex;">
                    <label for="age" style="margin-right:10px;">Age</label>
                    <span id="name" style="display:flex; justify-content:center;">24</span>
                </div>
            </div>
        </div>

        




		<footer>
			<p>&copy; Copyright (c) 2023 KISEC ALL RIGHTS RESREVED.</p>
			<p>본관 : 서울시 강남구 남부순환로 2645 한독빌딩 5층 SPACE HUM</p>
			<p>대표이사 : 김도은 &nbsp;|&nbsp; 대표번호 : 02-921-1465 &nbsp;|&nbsp; 사업자등록번호 : 120-86-17944</p>
			<p></p>
		</footer>
		<script>
			
		</script>
	</body>
</html>
