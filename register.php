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

<?php include('layouts/header.php') ?>


<!-- register -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Привет, дорогой новорег!</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form action="register.php" id="register-form" method="POST">

            <h4 class="text-danger text-big">
                <?php if (isset($_GET['error'])) {
                    echo $_GET["error"];
                } ?>
            </h4>


            <div class="form-group">
                <label>Как звать? Какой позывной?</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Вася" required />
            </div>

            <div class="form-group">
                <label>Почта</label>
                <input type="email" class="form-control" id="register-email" name="email" placeholder="email"
                    required />
            </div>

            <div class="form-group">
                <label>Пасс</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="пароль"
                    required />
            </div>

            <div class="form-group">
                <label>Повтори пасс плиз</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                    placeholder="пароль" required />
            </div>

            <div class="form-group mt-3">
                <input type="submit" name="register" class="btn" id="register-btn" value="Зарегаться" />
            </div>

            <div class="form-group mt-2">
                <a id="register-url" class="btn w-50" href="/login.php">Войти</a>
            </div>

        </form>
    </div>
</section>


<?php include('layouts/footer.php') ?>
