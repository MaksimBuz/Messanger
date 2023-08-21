<?php 
    include './connect.php';
    if (isset($_COOKIE["id"])) {
        setcookie('id', '', time() - 3600, '/');
        unset($_COOKIE['id']);
        echo 'Вы вышли';
    }
?>