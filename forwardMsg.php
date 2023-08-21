<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$msgId =  $mysqli->real_escape_string(htmlspecialchars($_POST["msgId"]));
$recipientEmail = $mysqli->real_escape_string(htmlspecialchars($_POST["recipientEmail"]));
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
$query = "SELECT user_id FROM `messages` WHERE id=$msgId";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);

session_start();
if (strcasecmp($tocken, $_SESSION["CSRF"])) {
    if ($userdata['user_id'] == $user_id) {
        $query = "SELECT `friends_id` FROM users WHERE `users`.`id` = '$user_id'";
        $success = $mysqli->query($query);
        $userdata = mysqli_fetch_assoc($success);
        $FriendsList = json_decode($userdata['friends_id']);
        $resultList = array();
        foreach ($FriendsList  as $key => $value) {
            $query = "SELECT email FROM users WHERE `users`.`id` = '$key'";
            $success = $mysqli->query($query);
            $Friend = mysqli_fetch_assoc($success);
            array_push($resultList, $Friend['email']);
        }
        $recipientEmail = trim($recipientEmail);
        if (in_array($recipientEmail, $resultList)) {
            $query = "SELECT text FROM `messages` WHERE id=$msgId";
            $success = $mysqli->query($query);
            $MsgText = mysqli_fetch_assoc($success);
            $MsgText =  $MsgText['text'];
            $query = "SELECT `id` FROM users WHERE `email` = '$recipientEmail'";
            $success = $mysqli->query($query);
            $RecipientId = mysqli_fetch_assoc($success);
            $RecipientId = $RecipientId['id'];
            $query = " INSERT INTO `messages` ( `user_id`, `text`, `recipient`) VALUES ( '$user_id', '$MsgText', '$RecipientId')";
            $success = $mysqli->query($query);
        }
    }
}
