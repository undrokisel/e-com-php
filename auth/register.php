<?php


session_start();
include('server/connection.php');


if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit();
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $passConfirm = $_POST['confirmPassword'];

    if ($pass !== $passConfirm) {
        header('location: register.php?error=пароли не совпадают');
    } else if (strlen($pass) < 6) {
        header('location: register.php?error=длина пароля должна быть не меньше 6 символов');

        // если нет ошибок при заполнении формы
    } else {
        // проверка есть ли уже в базе юзер с такой почтой
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        // если пользователь с такой почтой уже был зарегистрирован ранее
        if ($num_rows != 0) {
            header('location: register.php?error=пользователь с такой почтой уже был зарегистрирован ранее');

            // если пользователь новый
        } else {
            // сохраняем нового юзера в базу
            $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password) VALUES (?,?,?)");
            $stmt->bind_param('sss', $name, $email, md5($pass));

            // в случае успешного сохранения в базе
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=Вы успешно зарегистрированы');
            } else {
                header('location: register.php?error=ошибка при создании аккаунта нового пользователя');
            }
        }

    }
} else if (isset($_SESSION['logged_in'])) {
    header('location:login.php');
    exit;
}


?>