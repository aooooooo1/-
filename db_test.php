<?php
    include "db_conn.php";

    $qurey = "SELECT * FROM login";
    $result = mysqli_query($conn, $qurey);
    $re_cnt = mysqli_num_rows($result);
    if($re_cnt > 0){
        while($row = mysqli_fetch_array($result)){
            echo "<br>Number : ", $row['idx'], "<br> ID : ",$row['id'], "<br> PW : ",$row['pw'],"<br>==============";
        }
    }
    else{
        echo "Not Found Result";
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>