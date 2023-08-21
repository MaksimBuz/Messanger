<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$query = "SELECT `friends_id` FROM users WHERE `users`.`id` = '$user_id'";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);
$FriendsList = json_decode($userdata['friends_id']);
$ImgList = array();
$nicknameList = array();
foreach ($FriendsList  as $key => $value) {
    $query = "SELECT * FROM users WHERE `users`.`id` = '$key'";
    $success = $mysqli->query($query);
    $Friend = mysqli_fetch_assoc($success);
    if ($Friend['nicknameIsHidden'] == 1) {
        array_push($nicknameList, $Friend['email']);
    } else {
        array_push($nicknameList, $Friend['nickname']);
    }
    array_push($ImgList, $Friend['img']);
}
$resultList = array_combine($ImgList, $nicknameList);
$json = json_encode($resultList, JSON_UNESCAPED_UNICODE);
echo  $json;
