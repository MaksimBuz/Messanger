<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$newMsgtext = $mysqli->real_escape_string(htmlspecialchars($_POST["newMsgtext"]));
$msgId =  $mysqli->real_escape_string(htmlspecialchars($_POST["msgId"]));
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
session_start();
if (strcasecmp($tocken, $_SESSION["CSRF"])) {
    $query = "SELECT user_id FROM `messages` WHERE id=$msgId";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
    if ($userdata['user_id'] == $user_id) {
        $query = "UPDATE `messages` SET `text` = '$newMsgtext' WHERE `messages`.`id` = $msgId;";
        $success = $mysqli->query($query);
    }
}
