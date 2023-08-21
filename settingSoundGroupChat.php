<?php
include './connect.php';
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
$user_id = $_COOKIE["id"];
session_start();
if ($tocken==$_SESSION["CSRF"]) {
    $SoundChecked = $mysqli->real_escape_string(htmlspecialchars($_POST["SoundChecked"]));
    $ChatId =  $mysqli->real_escape_string(htmlspecialchars($_POST["ChatId"]));
    $query = "UPDATE `group_chat` SET `SoundDisable` = '$SoundChecked' WHERE `group_chat`.`id` = '$ChatId'";
    $success = $mysqli->query($query);
}

