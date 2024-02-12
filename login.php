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

    } else {

    }


}





?>


<?php include('layouts/header.php') ?>


<!-- login -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Заходи, не стесняйся</h2>
        <hr class="mx-auto hr" />
    </div>
    <div class="mx-auto container">
        <form action="login.php" method="POST" id="login-form">

            <h4 class="text-danger">
                <?php if (isset($_GET['error'])) {
                    echo $_GET['error'];
                } ?>
            </h4>

            <div class="form-group">
                <label>Почта</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="email" required />
            </div>

            <div class="form-group">
                <label>Пароль</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="пароль"
                    required />
            </div>

            <div class="form-group mt-3">
                <input type="submit" name="login" class="btn" id="login-btn" value="Заходи, говорю" />
            </div>

            <div class="form-group mt-2">
                <a id="register-url" class="btn w-50" href="register.php">Зарегаться</a>
            </div>

        </form>
    </div>
</section>

<?php include('layouts/footer.php') ?>