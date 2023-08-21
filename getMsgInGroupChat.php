<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$chatId = $mysqli->real_escape_string(htmlspecialchars($_POST["chatId"]));
$query = "SELECT * FROM `messages` WHERE `recipientGroupChatId`=$chatId;";
$success = $mysqli->query($query);
while ($row =   $success->fetch_assoc()) {
    $usersMessage[] = $row;
}
$query = "SELECT SoundDisable FROM `group_chat` WHERE `id`=$chatId;";
$success = $mysqli->query($query);
$SoundCheck = mysqli_fetch_assoc($success);
$sound = $SoundCheck['SoundDisable'];
$jsonMsg = json_encode($usersMessage, JSON_UNESCAPED_UNICODE);
$jsonResult = json_encode([$jsonMsg, $sound]);
echo $jsonResult;
