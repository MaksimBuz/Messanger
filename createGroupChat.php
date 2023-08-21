<?php
include './connect.php';

$user_id = $mysqli->real_escape_string(htmlspecialchars($_COOKIE["id"]));
$ChatName = $mysqli->real_escape_string(htmlspecialchars($_POST["ChatName"]));
$ChatMembers = $mysqli->real_escape_string(htmlspecialchars($_POST["ChatMembers"]));
$ChatMembers = explode(',', $ChatMembers);
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
session_start();
if ($tocken == $_SESSION["CSRF"]) {
    $query = "SELECT `friends_id` FROM users WHERE `users`.`id` = '$user_id'";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
    $FriendsList = json_decode($userdata['friends_id']);
    $FriendtList = array();
    foreach ($FriendsList  as $key => $value) {
        $query = "SELECT * FROM users WHERE `users`.`id` = '$value'";
        $success = $mysqli->query($query);
        $Friend = mysqli_fetch_assoc($success);
        array_push($FriendtList, $Friend['email']);
    }
    $result = array_intersect($FriendtList, $ChatMembers);
    $jsonResult = json_encode($result, JSON_UNESCAPED_UNICODE);
    $query = "INSERT INTO `group_chat` ( `user_group`, `Name`) VALUES ( '$jsonResult', '$ChatName');";
    $success = $mysqli->query($query);
}

