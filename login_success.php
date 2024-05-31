<!DOCTYPE html>
<?php
	if(isset($_SESSION["userID"])) { header("Location: ./main.html"); }
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="static/css/signin.css"> -->
		<meta charset="UTF-8">
		<title>html practice</title>
		<style>
		</style>
	</head>
	<body class="text-center">
	<?php include 'header.php' ?>


		<div class="form-signin">
			<!--로그인 폼 -->   
			<form method="post" action="/login_check.php"  name="Login_form">
				<h1 class="mb-3 fw-bold">KISEC</h1>
				<div class="form-floating">
					<input type="text" class="form-control" placeholder=""  name="id" >
					<label for="">ID</label> 
				</div>
				<div class="form-floating">
					<input type="password" class="form-control" name="pw"  id="floatingInput" placeholder="passwo">
					<label for="">password</label>
				</div>
				<!-- 로그인 버튼 -->
				<button onClick=check()  class="btn1" type="submit" value="login">로그인</button>
			</form>
			<p class="small fw-bold mt-2 pt-1 mb-0">아직 계정이 없으신가요?<a href="join.html" class="link-danger"> 가입하기</a>
			</p>
		</div>
		<br>



		<footer>
			<p>&copy; 2024 Kisec. All rights reserved.</p>
			<p>본관 : 서울시 강남구 남부순환로 2645 한독빌딩 5층 SPACE HUM</p>
			<p>대표이사 : 이경빈 &nbsp;|&nbsp; 대표번호 : 02-921-1465 &nbsp;|&nbsp; 사업자등록번호 : 120-86-17944</p>
			<p></p>
		</footer>
		

		<script>
			function check() {
				if (Login_form.id.value == "" || Login_form.pw.value == "") {
					alert("빈 칸이 있습니다.");
				}
			}
		</script>

	</body>
</html>
