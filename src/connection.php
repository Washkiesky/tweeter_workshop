<?php

require_once("users.php");

$username = "root";
$pass = "coderslab";
$host = "localhost";
$dbName = "tweeter";

$conn =  new mysqli($host, $username, $pass, $dbName);
    if($conn == false){
        die ("cannot");
    }
    else{
        echo "connection work";
    }


User::setConnection($conn);
