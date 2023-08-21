<?php
include './connect.php';
$user_id = $_COOKIE["id"];
$nickname = $mysqli->real_escape_string(htmlspecialchars($_POST["new-nickname"]));
$file =  $mysqli->real_escape_string(htmlspecialchars($_POST["new_img"]));
$checkNickname =    $mysqli->real_escape_string(htmlspecialchars($_POST["check-nickname"]));
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
$nickname = trim($nickname);
session_start();
if ($tocken == $_SESSION["CSRF"]) {
    if (strlen($nickname) > 0) {
        try {
            $query = "UPDATE `users` SET `nickname` = '$nickname' WHERE `users`.`id` = '$user_id'";
            $success = $mysqli->query($query);
        } catch (\Throwable $th) {
            echo 'Никнейм должен быть уникальным';
        }
    }
    if (strlen($file)) {
        $query = "UPDATE `users` SET `img` = '$file' WHERE `users`.`id` = '$user_id'";
        $success = $mysqli->query($query);
    }
    if ($checkNickname) {
        $query = " UPDATE `users` SET `nicknameIsHidden` = '$checkNickname' WHERE `users`.`id` = $user_id;";
        $success = $mysqli->query($query);
    }
}
