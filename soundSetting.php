<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
$SoundChecked =  $mysqli->real_escape_string(htmlspecialchars($_POST["SoundChecked"]));
$name =  $mysqli->real_escape_string(htmlspecialchars($_POST["name"]));
session_start();
if ($tocken == $_SESSION["CSRF"]) {
    $query = "SELECT id FROM `users` WHERE nickname='$name';";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
    if (!$userdata) {
        $query = "SELECT id FROM `users` WHERE email='$name';";
        $success = $mysqli->query($query);
        $userdata = mysqli_fetch_assoc($success);
    }
    $friendId = $userdata['id'];
    $query = "INSERT INTO `SoundSetting` ( `user_id`, `sender_id`, `SoundDisable`) VALUES ( '$user_id', '$friendId', '$SoundChecked');";
    $success = $mysqli->query($query);
}
