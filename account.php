<?php
include('server/connection.php');
session_start();

// если еще не залогинен, то сразу отправим на страницу логина
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit();
}


if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit();
    }
}

if (isset($_POST['changePass'])) {

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

if (isset($_SESSION['logged_in'])) {
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


<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo md5_file('./assets/css/style.css') ?>">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ПРОФИЛЬ</title>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">

        <div class="container">

            <a class="navbar-brand" href="index.php">
                <!-- <img src="assets/images/logo.jpeg" alt=""> -->
                МАГАЗОН
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Главная</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Затариться</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="news.php">Новости</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Контакты</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.php">
                            <i class="fas fa-shopping-bag"></i>
                        </a>
                        <a href="account.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- account -->
    <section class="account my-5 py-5">
        <div class="row container mx-auto">

            <h4 class="text-success text-center">
                <?php if (isset($_GET['register_success'])) {
                    echo $_GET['register_success'];
                } ?>
            </h4>
            <h4 class="text-success text-center">
                <?php if (isset($_GET['login_success'])) {
                    echo $_GET['login_success'];
                } ?>
            </h4>

            <div class="text-center mt-3 pt-5 col-lg-5 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Досье</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Имя: <span>
                            <?php if (isset($_SESSION['user_name'])) {
                                echo $_SESSION['user_name'];
                            } ?>
                        </span></p>
                    <p>Почта: <span>
                            <?php if (isset($_SESSION['user_email'])) {
                                echo $_SESSION['user_email'];
                            } ?>
                        </span></p>
                    <p><a id="order-btn" href="#orders">МОИ ЗАКАЗЫ</a></p>

                    <p><a id="logout-btn" href="account.php?logout=1">Разлогиниться</a></p>

                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">

                <form action="account.php" method="POST" id="account-form">
                    <h3>Сменить пасс</h3>
                    <hr class="mx-auto">
                    <h4 class="text-danger text-center">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </h4>
                    <h4 class="text-success text-center">
                        <?php if (isset($_GET['message'])) {
                            echo $_GET['message'];
                        } ?>
                    </h4>


                    <div class="form-group">
                        <label>Пасс</label>
                        <input type="password" class="form-control" required name="password" id="account-password"
                            placeholder="Пасс">
                    </div>

                    <div class="form-group">
                        <label>Подтвердить пасс</label>
                        <input type="password" class="form-control" required name="confirmPassword"
                            id="account-password-confirm" placeholder="Пасс">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="changePass" class="btn btn-submit" value="Сохранить"
                            id="change-pass-btn">
                    </div>

                </form>
            </div>
        </div>
    </section>


    <!-- orders -->
    <section id="orders" class="orders container my-5 py-5">
        <div class="container mt-5 mx-auto">
            <h2 class="font-weight-bold text-center">Ваши заказы</h2>
            <hr class="mx-auto">

            <table class="mt-5 pt-5 mx-auto text-center">
                <tr>
                    <th>Номер заказа</th>
                    <th>Стоимость заказа</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Детали заказа</th>
                </tr>

                <?php while ($row = $orders->fetch_assoc()) { ?>

                    <tr>
                        <td>
                            <span>
                                <?php echo $row['order_id'] ?>
                            </span>
                        </td>

                        <td>
                            <span class="">
                                <?php echo $row['order_cost'] ?>
                            </span>
                        </td>
                        <td>
                            <span class="">
                                <?php echo $status_enam[$row['order_status']] ?>
                            </span>
                        </td>
                        <td>
                            <span class="">
                                <?php echo $row['order_date'] ?>
                            </span>
                        </td>
                        <td>
                            <form action="order_details.php" method="POST">
                                <input type="hidden" name="order_status" value="<?php echo $row['order_status'] ?>">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                <input class="btn order-details-btn" name="order_details_btn" type="submit"
                                    value="Подробнее">
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        </div>


    </section>


    <footer class="mt-5 py-5">

        <div class="row container mx-auto pt-5">

            <div class="footer-one col-lg-3 col-md-6col-sm-12">
                <img src="" alt="logo" class="logo">
                <p class="pt-3">Мы предлагаем хайповые вещи по незашкварным ценам</p>
            </div>

            <div class="footer-one col-lg-3 col-md-6col-sm-12">
                <h3 class="pb-2">Топчики:</h3>
                <ul class="text-uppercase">
                    <li><a href="#">Пацанам</a></li>
                    <li><a href="#">Девчулям</a></li>
                    <li><a href="#">Чушпанам мелким</a></li>
                    <li><a href="#">Их подружкам</a></li>
                    <li><a href="#">Новинки в обход санкций</a></li>
                    <li><a href="#">Шмотки</a></li>
                </ul>
            </div>

            <div class="footer-one col-lg-3 col-md-6col-sm-12">
                <h3 class="pb-2">На связи:</h3>
                <div class="">
                    <h6 class="text-uppercase">Адрес:</h6>
                    <p>г. Пермь, ул. Пушкина, д. 113:</pз>
                </div>
                <div class="">
                    <h6 class="text-uppercase">Телефон:</h6>
                    <p>+7989898798:</pз>
                </div>
                <div class="">
                    <h6 class="text-uppercase">Email:</h6>
                    <p>magazon@gmail.com:</pз>
                </div>
            </div>

            <div class="footer-one col-lg-3 col-md-6col-sm-12">
                <h5 class="pb-2">Вконтакте:</h5>
                <div class="row">
                    <img src="assets/images/featured1.png" class="img-fluid w-25 h-100 m-2" alt="">
                    <img src="assets/images/featured1.png" class="img-fluid w-25 h-100 m-2" alt="">
                    <img src="assets/images/featured1.png" class="img-fluid w-25 h-100 m-2" alt="">
                    <img src="assets/images/featured1.png" class="img-fluid w-25 h-100 m-2" alt="">
                    <img src="assets/images/featured1.png" class="img-fluid w-25 h-100 m-2" alt="">
                </div>
            </div>
        </div>





        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="/assets/images/" alt="карта мир">
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                    <p>МАГАЗОН @designed by Kisel Andrey</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>



    <!--  Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>


</body>

</html>