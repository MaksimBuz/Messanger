<?php 
    include './connect.php';
    $user_id=$_COOKIE["id"];
    $query="SELECT `img` FROM users WHERE `users`.`id` = '$user_id'";
    $success = $mysqli->query($query);
    $userdata = mysqli_fetch_assoc($success);
    echo $userdata['img'];
    
?>