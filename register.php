<?php
require_once("src/connection.php");
session_start();

if(isset($_SESSION['user']) != false){
    header("location: main.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $newUser = user::register($_POST['email'], $_POST['password'], $_POST['password2'],$_POST['description']);
    if($newUser != false){
        $_SESSION['user'] = $newUser;
        header ('location: main.php');
    }
    echo "register error";
}


?>



<form method="POST" action="register.php">
    <input type= "text" name="email" placeholder="enter mail"><br>
    <input type= "text" name="password" placeholder="enter password"><br>
    <input type= "text" name="password2" placeholder="repeat password"><br>
    <input type= "text" name="description" placeholder="napisz cos o sobie"><br>
    <input type= "submit" value ="register">
</form>