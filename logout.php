<?php
require_once("src/connection.php");
session_start();

unset($_SESSION['user']);
header("location: login.php");

?>
<form action = "logout.php" method="POST">
    <input type = "submit" value ="logout">
</form>