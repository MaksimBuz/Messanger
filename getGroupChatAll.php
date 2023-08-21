<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$query = "SELECT `email` FROM `users` WHERE `id`=4;";
$success = $mysqli->query($query);
$userdata = mysqli_fetch_assoc($success);
$userEmail = $userdata['email'];
$query = "SELECT * FROM `group_chat`";
$success = $mysqli->query($query);
while ($row =   $success->fetch_assoc()) {
    $AllGroupChat[] = $row;
}
$resultList = array();
$IdList = array();
$NameList = array();
foreach ($AllGroupChat  as $key => $value) {
    $GroupChatList = json_decode($value['user_group']);
    $GroupChatList = (array) $GroupChatList;
    if (in_array($userEmail, $GroupChatList)) {
        array_push($IdList, $value['id']);
        array_push($NameList, $value['Name']);
        $resultList = array_combine($IdList, $NameList);
    }
}

$json = json_encode($resultList, JSON_UNESCAPED_UNICODE);
echo  $json;
