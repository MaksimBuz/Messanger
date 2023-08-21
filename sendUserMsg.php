<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$recepientName = $mysqli->real_escape_string(htmlspecialchars($_POST["recepientName"]));
$MsgText = $mysqli->real_escape_string(htmlspecialchars($_POST["MsgText"]));
$query = "SELECT id FROM `users` WHERE nickname='$recepientName';";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);
if (!$userdata) {
    $query = "SELECT id FROM `users` WHERE email='$recepientName';";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
}
$recepientId = $userdata['id'];
$query = "INSERT INTO `messages` ( `user_id`, `text`, `recipient`) VALUES ( '$user_id', '$MsgText', ' $recepientId')";
$success = $mysqli->query($query);
