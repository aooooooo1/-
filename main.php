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
			$query = "SELECT b.idx, u.userName, u.authority, b.title, b.content, b.wdate FROM board b JOIN users u ON u.id = b.userName";
			// 검색어가 있을 경우 쿼리문에 조건 추가
			if(!empty($searchKeyword)) {
				$query .= " WHERE title LIKE '%$searchKeyword%' OR content LIKE '%$searchKeyword%' OR userName LIKE '%$searchKeyword%'";
			}

			$query .= " ORDER BY CASE WHEN u.authority = 'admin' THEN 1 ELSE 2 END, b.idx DESC"; // 추가된 코드
            $result = mysqli_query($conn, $query);
			
			if (!$result) {
				die("Error: " . mysqli_error($conn));
			}
        ?>
		<!-- 검색 폼 -->
		<div style="text-align: center; margin: 10px;">
			<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="text" name="searchKeyword" placeholder="검색어를 입력하세요" value="<?php echo $searchKeyword; ?>" style="padding:7px; border-radius:10px; border-color:#e5e5e5; width: 450px">
				<input type="submit" class="btn1" value="검색">
			</form>
		</div>

		<!-- 게시판 -->
        <table style="margin : 0 auto;" >
            <thead>
                <tr>
                    <th>글쓴이</th>
					<th>제목</th>
					<th>내용</th>
                    <th>날짜</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $re_cnt = mysqli_num_rows($result);
                    if($re_cnt > 0){
                        while($row = mysqli_fetch_array($result)){
							$datetime = $row['wdate'];
							$timestamp = strtotime($datetime);
							$formatted_date = date("Y-m-d", $timestamp);
							// 권한이 admin인 경우 배경색을 연한 노랑색으로 설정
							$bgcolor = $row['authority'] === 'admin' ? 'background-color: lightyellow;' : '';
                ?>
                <tr style="<?php echo $bgcolor; ?>">
                    <td id="num">
						<?php echo $row['userName'] ?>
					</td>
                    <td>
						<a href="view.php?num=<?php echo $row['idx']; ?>"><?php echo $row['title'] ?>
					</td>
					<td>
						<?php echo $row['content'] ?>
					</td>
                    <td>
						<?php echo $formatted_date ?>
					</td>
                </tr>
                <?php
						}
					} else {
				?>
				<tr>
					<td colspan="4" style="text-align: center;">검색 결과가 없습니다.</td>
				</tr>
				<?php
					}
					mysqli_free_result($result);
					mysqli_close($conn);
				
				?>
            </tbody>
        </table>
		<div style="display: flex; justify-content: center;">
			<input class="btn1" type="button" value="글 쓰기" onClick=go_write()>
		</div>

        
        <script>
            function go_write(){
                window.location.href='/write.php';
            }

        </script>




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
