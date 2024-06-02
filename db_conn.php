<?php
    $conn = mysqli_connect("localhost", "root", "123", "Db");
    if(!$conn){
        echo "Error unable to connect to db",mysqli_connect_error();
        exit;
    }
    mysqli_query($conn, "SET NAMES utf8");
?>
