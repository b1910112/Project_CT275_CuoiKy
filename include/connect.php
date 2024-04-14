<?php
    $severname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_ct275";

    $conn = mysqli_connect($severname, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed " . mysqli_connect_errno());
    }
    mysqli_select_db($conn, $dbname);

    // $checkvar = $conn->query("SELECT * FROM `user` WHERE `username` = '".$conn->real_escape_string($username)."'")->fetch_array();
?>