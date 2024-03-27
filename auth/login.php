<?php
include('server/connection.php');
session_start();

if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    // ищем в базе юзера по почте и паролю
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? AND user_password=? LIMIT 1");
    $stmt->bind_param('ss', $email, $pass);

    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=Успешно авторизован');
        } else {
            header('location: login.php?error=что-то пошло не так');
        }
    } 
}
?>
