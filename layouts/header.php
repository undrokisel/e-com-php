<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo md5_file('assets/css/style.css') ?>">


    <link href="assets/css/bootstrap-5.0.2/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Главная</title>
    <style>
        .navbar-brand span {
            color: #000;
        }
    </style>

</head>

<body>

    <header class="header">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top">

            <div class="container">

                <a class="navbar-brand" href="index.php">
                    <span class="logo">Александрия</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">

                    <ul class="navbar-nav navbar-nav-header me-auto mb-2 mb-lg-0">


                        <div class="header-menu-items">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Главная</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="shop.php">Каталог</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="news.php">Новости</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="about.php">О нас</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Контакты</a>
                            </li>
                        </div>

                        <li class="nav-item nav-item-btns d-flex gap-3 badges align-items-center">
                            <a href="cart.php" class="cart-link-with-badge header-link-item">
                                <img src="assets/images/basket.png" alt="">
                                <?php if (isset ($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                                    <div class="badge">
                                        <?php echo $_SESSION['quantity']; ?>
                                    </div>
                                <?php } ?>
                            </a>
                            <a href="account.php" class="header-link-item">
                                <img src="assets/images/queen.png" alt="">
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>