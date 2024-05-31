<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>수정</title>
    </head>
    <body>
        <?php
            include "db_conn.php";
            $idx = $_GET['num'];
            $query = "select title, name, email, wdate, content, pw from board where idx=$idx";
            $result = mysqli_query($conn, $query);
            $re_cnt = mysqli_num_rows($result);
            if($re_cnt > 0){
                $row = mysqli_fetch_array($result);
        ?>
        <form action="/input_modify.php" method="post">
            <table>
                <tr>
                    <td>제목</td>
                    <td><input type="text" name="title" value="<?php echo $row['title'] ?>"> </td>
                </tr>
                <tr>
                    <td>이름</td>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                    <td>이메일</td>
                    <td><?php echo $row['email'] ?></td>
                </tr>
                <tr>
                    <td>날짜</td>
                    <td><?php echo $row['wdate'] ?></td>
                </tr>
                <tr>
                    <td>내용</td>
                    <td> <textarea row="10" cols="50" name="content"> <?php echo $row['content'] ?> </textarea> </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td><input type="password" name="pw"></td>
                </tr>
            </table>
            <input type="hidden" name="num" value="<?php echo $idx ?>">
            <input type="submit" value="저장">
        </form>
        <?php
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
        <input type="button" value="뒤로가기" onClick=history.go(-1)>
    </body>
</html>