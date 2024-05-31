<!-- header.php -->
<style>
        .btn1{
            margin-top : 10px;
            padding : 10px 20px;
            font-size : 16px;
            border : none;
            border-radius: 20px;
            background-color : #7469B6;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn1:hover {
            background-color: #AD88C6; /* 호버 시 배경색 변경 */
        }
        .form-signin{
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within{
            z-index: 2;
        }

        .form-signin input[type="text"]{
            margin-bottom: 10px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"]{
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .hh {
            margin: 0 auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            /* background-color: #f8f8f8; */
            margin: 0 auto;
        }

        .header-links a {
            margin-left: 15px;
            text-decoration: none;
            color: #333;
            font-size: small;
        }

        nav {
            background-color: #333;
            margin: 0 auto;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 15px;
            display: block;
        }

        nav ul li a:hover {
            background-color: #555;
            color: white;
        }

        footer {
            background-color: #fcfbfb;
            text-align: center;
            padding: 30px;
            width: 100%;
            bottom: 0;
        }

        footer p {
            font-size: 12px;
            color: #6e6e6e;
            margin: 5px 0;
        }

        @media (min-width: 1000px) {
            header  {
                width: 700px;
                margin : 0 auto;
            }
        }
        .logo {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            padding: 0;
        }
        .logo:hover {
            color: red;
            text-decoration : underline;
        }
</style>
<?php
session_start(); // 세션 시작

// setcookie("PHPSESSID", session_id(), [
//     'httponly' => true,
//     'secure' => true,
//     'samesite' => 'Strict'
// ]);
// setcookie("user_role_cookie", "admin", [
//     'httponly' => true,
//     'secure' => true,
//     'samesite' => 'Strict'
// ]);


include "db_conn.php";
// 사용자가 로그인되어 있는지 확인
$session_id = session_id();
$query = "SELECT * FROM users WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$logged_in = $user !== null;

$queryA = "SELECT session_id FROM users WHERE id = 'admin'";
$resultA = mysqli_query($conn, $queryA);
$rowA = mysqli_fetch_assoc($resultA);
// 쿠키를 통해 사용자 권한 확인
$isAdmin = false;
if (isset($_COOKIE['user_role_cookie']) && $_COOKIE['user_role_cookie'] == 'admin' && $rowA['session_id'] == $session_id) {
    $isAdmin = true;
}

mysqli_free_result($result);
mysqli_close($conn);

$message = "";
?>
<div class="hh">
    <header>   
        <div>
            <a href="main.php">
                <img width="170px" src="./img/kisec.png">
            </a>
        </div>
        <?php if ($logged_in): ?>
            <div id="logout">
                <p style="margin:0; font-size:14px;">안녕하세요,<span style="font-weight: bold;"> <?php echo htmlspecialchars($user['userName']); ?> </span>님</p>
                <form action="logout.php" method="post" style="display:flex; justify-content:end;">
                    <input class="logo" type="submit" value="로그아웃">
                </form>
            </div>
        <?php else: ?>
        <div class="header-links">
            <a href="login_success.php">로그인</a>
            <a href="join.html">회원가입</a>
        </div>
        <?php endif; ?>
    </header>
    <nav>
        <ul>
            <li><a href="#">소개</a></li>
            <li><a href="#">공지사항</a></li>
            <li><a href="#">뉴스클리핑</a></li>
            <li><a href="#">교육과정</a></li>
            <?php if ($isAdmin): ?> 
                <li><a href="student.php">교육생 관리</a></li> <!-- 추가한 코드 -->
            <?php endif; ?>
        </ul>
    </nav>
</div>