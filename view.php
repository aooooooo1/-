<?php
session_start(); // 세션 시작
include "db_conn.php";
// 사용자가 로그인되어 있는지 확인
$session_id = session_id();
$query = "SELECT * FROM login WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$logged_in = $user !== null;

// mysqli_free_result($result);
// mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>view</title>
        <style>
            th, td{
                    text-align : center;
                    padding: 10px;
                    border-bottom: 1px solid #cdcdcd;
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
        <!-- 헤더 -->
	    <?php include 'header.php' ?>

        <?php
            include "db_conn.php";
            $idx = $_GET['num'];
            $query = "select title,wdate, content, userName from board where idx=" . $_GET['num'];
            $result = mysqli_query($conn, $query);
            $re_cnt = mysqli_num_rows($result);
            if($re_cnt > 0){
                $row = mysqli_fetch_array($result);
                // 데이터베이스에서 가져온 datetime 형식의 날짜
                $datetime = $row['wdate'];
                // 타임스탬프로 변환
                $timestamp = strtotime($datetime);
                // 원하는 날짜 형식으로 변환 (Y-m-d 형식, 예: 2024-05-26)
                $formatted_date = date("Y-m-d", $timestamp);
        ?>
        <div style="display:flex; justify-content:center;">
        <div style="min-width:450px;">
            <table style="width:100%;">
                <tr>
                    <td style="font-weight:bold;">제목</td>
                    <td><?php echo $row['title'] ?></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">이름</td>
                    <td style="color:gray;"><?php echo $row['userName'] ?></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">날짜</td>
                    <td style="color:gray;"><?php echo $formatted_date ?></td>
                </tr>
                <tr style="height:100px;">
                    <td style="font-weight:bold;">내용</td>
                    <td><?php echo $row['content'] ?></td>
                </tr>
                
            <?php
                }
                mysqli_free_result($result);
            ?>
            <?php
                $idx = $_GET['num'];
                // 해당 게시글에 연결된 파일 가져오기
                $query = "SELECT name_orig, file_id FROM upload_file WHERE board_num = $idx";
                $file_result = mysqli_query($conn, $query);
                if(mysqli_num_rows($file_result) > 0) {
                    // 파일이 존재하는 경우
                    $row = mysqli_fetch_assoc($file_result);
                    $name_orig = $row['name_orig'];
                    $file_path = "uploads/" . $name_orig;
                    // 파일을 웹상에 표시
            ?>
                    <tr>
                        <td style="font-weight:bold;">첨부파일</td>
                        <td>
<a href="download.php?file_id=<?php echo $row['file_id'] ?>" target="_blank">
    <?php echo $row['name_orig'] ?>
</a>
                        </td>
                    </tr>
                </table>
            <?php
                } else {
                    // 파일이 존재하지 않는 경우
            ?>
                    <tr>
                        <td style="font-weight:bold;">첨부파일</td>
                        <td style="color:gray;">
                            해당 게시글에는 파일이 첨부되어 있지 않습니다.
                        </td>
                    </tr>
                </table>
            <?php
                }
                mysqli_close($conn);
            ?>
                    
            <br>
            <br>
            <?php
                include "db_conn.php";
                $idx = $_GET['num'];
                $query = "select title,wdate, content, userName from board where idx=" . $_GET['num'];
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                if ($logged_in == $row['userName']): 
            ?>
            <div style="text-align:center;">
                <a href="/main.php" class="btn1">목록</a>
                <a class="btn1" href="/input_modify.php?num=<?php echo $_GET['num']; ?>" >글 수정</a>
                <a class="btn1" href="/input_delete.php?num=<?php echo $_GET['num']; ?>" >글 삭제</a>
            </div>
            <?php else: ?>
                <a href="/main.php" class="btn1">목록</a>
			<?php endif; ?>
        </div>
        </div>

        
        <footer>
			<p>&copy; 2024 Kisec. All rights reserved.</p>
			<p>본관 : 서울시 강남구 남부순환로 2645 한독빌딩 5층 SPACE HUM</p>
			<p>대표이사 : 이경빈 &nbsp;|&nbsp; 대표번호 : 02-921-1465 &nbsp;|&nbsp; 사업자등록번호 : 120-86-17944</p>
			<p></p>
		</footer>

    </body>
</html>