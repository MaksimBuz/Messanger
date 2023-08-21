<?php
include './connect.php';
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
session_start();
if (strcasecmp($tocken ,$_SESSION["CSRF"])) {
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST["user_email"]));
    $nickname = $mysqli->real_escape_string(htmlspecialchars($_POST["user_nickname"]));
    $password = $mysqli->real_escape_string(htmlspecialchars($_POST["user_pass"]));
    $query = "INSERT INTO `users` ( `email`, `nickname`,`password`) VALUES ( '$email', '$nickname','$password')";
    $success = $mysqli->query($query);
}


