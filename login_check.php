<?php
	session_start();
	$id = $_POST['id'];
	$pw = $_POST['pw'];

	if (empty($id) || empty($pw)) {
		echo "<script>window.location.href='/login_success.php'; </script>";
		exit(); // 추가: 종료
	}

	include "db_conn.php";
	$message = "";

	// 보안 코드
	$id = $conn->real_escape_string($id); // 추가: SQL 인젝션 방지
	$query = "SELECT * FROM users WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	$re_cnt = mysqli_num_rows($result);

	if ($re_cnt > 0) {
		$row = mysqli_fetch_array($result);
		// 데이터베이스에서 가져온 해시화된 비밀번호
		$hashed_password = $row['pw'];
		// 입력된 비밀번호와 해시화된 비밀번호를 비교
		$password_verified = password_verify($pw, $hashed_password);

		if ($password_verified) {
			session_regenerate_id(true);

			// 관리자 권한 확인 및 쿠키 설정
			if ($row['authority'] == 'admin') {
				setcookie("user_role_cookie", "admin", time() + (86400 * 1), "/"); // 1일간 유효
			} else {
				setcookie("user_role_cookie", "user", time() + (86400 * 1), "/"); // 1일간 유효
			}

			// 로그인 성공, 세션 생성 및 데이터베이스에 저장
			$_SESSION['id'] = $id;
			// 세션 데이터베이스에 저장
			$session_id = session_id();
			$session_id = $conn->real_escape_string($session_id); // 추가: SQL 인젝션 방지
			$update_query = "UPDATE users SET session_id = '$session_id' WHERE id = '$id'";
			mysqli_query($conn, $update_query);

			mysqli_free_result($result);
			mysqli_close($conn);
			echo "<script>
					window.location.href='/main.php'; 
				</script>";
		} else {
			// 비밀번호가 일치하지 않음
			echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
			echo "<script>
					window.location.href='/main.php'; 
				</script>";
			mysqli_free_result($result);
			mysqli_close($conn);
		}
	} else {
		echo "<script>alert('존재하지 않는 ID입니다.');</script>"; // 추가: 존재하지 않는 ID 처리
		echo "<script>
				window.location.href='/login_success.php'; 
			</script>";
		mysqli_close($conn); // 추가: 연결 닫기
	}

// 취약한 코드
	// $query = "SELECT * FROM users WHERE id = '" . $id . "' and pw='" . $pw . "'";
	// mysqli_query($conn, $query);

	// $recordset = mysqli_query($conn, $query); 
	// if(!$recordset){	
	// 	echo "<br>";
	// 	die("Error KISEC : " .mysqli_error($conn));
	// }		
	// else {	
	// 	$result = mysqli_query($conn, $query);
	//     $re_cnt = mysqli_num_rows($result);	
	// 	$row = mysqli_fetch_array($result);
	// 	// 데이터베이스에서 가져온 해시화된 비밀번호
	//  	$hashed_password = $row['pw'];
	// 	$password_verified = password_verify($pw, $hashed_password);
	// 	$row = mysqli_fetch_array($recordset);
	// 	if($row["id"] or password_verify($pw, $hashed_password)) {	
	// 		$_SESSION['id'] = $id;
	//  		// 세션 데이터베이스에 저장
	//  		$session_id = session_id();
	//  		$query = "UPDATE users SET session_id = '$session_id' WHERE id = '$id'";
	//  		mysqli_query($conn, $query);	

	// 		$message = "Login SUCCESS!" . $row["id"] . " Welcome!";
	// 		echo "<script>
	// 				alert('$message')
	// 				window.location.href='/main.php'; 
	// 			</script>";
	// 	}else{		
	// 		$message = "계정 정보를 잘못 입력했습니다.";		
	// 		echo "<script>
	// 			alert('$message')
	// 			window.location.href='/main.php'; 
	// 		</script>";
	// 	}
	// }

	// mysqli_free_result($result);
	// mysqli_close($conn);
	// echo "<script>
	// 		window.location.href='/main.php'; 
	// 	</script>";


	mysqli_free_result($result);
	mysqli_close($conn);
	
?>
