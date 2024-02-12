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

    <title>РЕГИСТРАЦИЯ</title>
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
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Вася"
                        required />
                </div>

                <div class="form-group">
                    <label>Почта</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="email"
                        required />
                </div>

                <div class="form-group">
                    <label>Пасс</label>
                    <input type="password" class="form-control" id="register-password" name="password"
                        placeholder="пароль" required />
                </div>

                <div class="form-group">
                    <label>Повтори пасс плиз</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                        placeholder="пароль" required />
                </div>

                <div class="form-group">
                    <input type="submit" name="register" class="btn" id="register-btn" value="Зарегаться" />
                </div>

                <div class="form-group">
                    <a id="register-url" class="btn" href="/login.php">Уже есть акк? Тогда заходи уже, не стесняйся</a>
                </div>

            </form>
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