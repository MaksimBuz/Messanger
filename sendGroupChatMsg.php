<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$recipientGroupChatId =   $mysqli->real_escape_string(htmlspecialchars($_POST["recipientGroupChatId"]));
$MsgText =    $mysqli->real_escape_string(htmlspecialchars($_POST["MsgText"]));
$query = "INSERT INTO `messages` ( `user_id`, `text`, `recipientGroupChatId`) VALUES ( '$user_id', '$MsgText', ' $recipientGroupChatId')";
$success = $mysqli->query($query);
