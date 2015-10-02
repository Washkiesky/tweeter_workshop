<?php

require_once("src/connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = User::logIn($_POST['mail'], $_POST['password']);
    if($user != false){
        $_SESSION['user'] = $user;
        header("location: main.php");
    }
    echo("z³y login lub haslo chuju");
}
?>

<form action = "login.php" method="POST">
    <input type = "text" name="mail" placeholder="enter mail">
    <input type ="text" name="password" placeholder="enter password">
    <input type = "submit" value ="login">
</form>
