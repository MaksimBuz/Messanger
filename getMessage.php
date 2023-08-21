<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$name = $mysqli->real_escape_string(htmlspecialchars($_POST["user_name"]));
$name = trim($name);
$query = "SELECT id FROM `users` WHERE nickname='$name';";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);

if (!$userdata) {
    $query = "SELECT id FROM `users` WHERE email='$name';";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
}
$friendId = $userdata['id'];
$query = "SELECT text, id FROM `messages` WHERE (recipient =  $friendId AND user_id=  $user_id) or (recipient =  $user_id AND user_id=  $friendId)";
$success = $mysqli->query($query);
while ($row =   $success->fetch_assoc()) {
    $usersMessage[] = $row;
}
$query = "SELECT * FROM `SoundSetting` WHERE (user_id =  $user_id AND sender_id=   $friendId)";
$success = $mysqli->query($query);
while ($row =   $success->fetch_assoc()) {
    $SoundCheck[] = $row;
}
$sound = end($SoundCheck);
$sound = $sound['SoundDisable'];
try {
    $jsonMsg = json_encode($usersMessage, JSON_UNESCAPED_UNICODE);
} catch (\Throwable $th) {
}

$jsonResult = json_encode([$jsonMsg, $sound]);
echo $jsonResult;
