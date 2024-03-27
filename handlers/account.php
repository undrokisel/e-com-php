<?php
include ('server/connection.php');
session_start();

// если еще не залогинен, то сразу отправим на страницу логина
if (!isset ($_SESSION['logged_in'])) {
    header('location: login.php');
    exit();
}


if (isset ($_GET['logout'])) {
    if (isset ($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        header('location: login.php');
        exit();
    }
}

if (isset ($_POST['changePass'])) {

    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirmPassword'];
    $email = $_SESSION['user_email'];

    // если введенные пароли не совпадают
    if ($pass !== $confirm_pass) {
        header('location: account.php?error=пароли не совпадают');
    } else if (strlen($pass) < 6) {
        header('location: account.php?error=длина пароля должна быть не меньше 6 символов');
        // 
    } else {
        // если пароли совпадают, то сохраним пароль в таблицу
        $newHashedPass = md5($pass);
        $smtp = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $smtp->bind_param('ss', $newHashedPass, $email);
        if ($smtp->execute()) {
            header('location: account.php?message=Пароль успешно изменен');
        } else {
            header('location: account.php?error=не удалось изменить пароль');
        }
    }
}

// получаем заказы
// if (isset($_SESSION['logged_in'])) {
//     $user_id = $_SESSION['user_id'];

//     $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
//     $stmt->bind_param('i', $user_id);
//     $stmt->execute();
//     $orders = $stmt->get_result();




if (isset ($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();



    $status_enam = [
        "on_hold" => 'в обработке',
        "not_paid" => 'не оплачен',
        "delivered" => 'доставлен',
    ];
}


?>