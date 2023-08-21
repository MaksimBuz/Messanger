<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$query = "SELECT `nickname`,nicknameIsHidden,email FROM users WHERE `users`.`id` = '$user_id'";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);
if ($userdata['nicknameIsHidden'] == 0) {
     echo $userdata['nickname'];
} else {
     echo $userdata['email'];
}
