<?php
include './connect.php';
$email = $mysqli->real_escape_string(htmlspecialchars($_POST["user_email_auth"]));
$pass = $mysqli->real_escape_string(htmlspecialchars($_POST["user_pass_auth"]));
$tocken = $mysqli->real_escape_string(htmlspecialchars($_POST["token"]));
$pass = trim($pass);
$email = trim($email);

session_start();
if ($tocken == $_SESSION["CSRF"]) {
    if (strlen($_POST['user_email_auth']) > 0    && strlen($_POST['user_pass_auth']) > 0) {
        $query = "SELECT * FROM users WHERE email='" . $email . "' AND PASSWORD='" .  $pass . "'";
        $success = $mysqli->query($query);
        $userdata = mysqli_fetch_assoc($success);
        if (mysqli_num_rows($success) > 0) {
            echo 'Вы вошли';
            setcookie("id", $userdata['id'], time() + 3600 * 24 * 30 * 12, "/");
            mail("$email", "Регистрация успешна", "Регистрация успешно завершена");
        } else {
            setcookie('id', '', time() - 3600, '/');
            unset($_COOKIE['id']);
        }
    }
}
