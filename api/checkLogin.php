<?php
    include "config.php";
    $username = mysqli_real_escape_string($_POST["username"]);
    $password = mysqli_real_escape_string($_POST["password"]);
    createQuery("SELECT FROM person WHERE username = ".$username." AND password =".md5($password).";");

?>
