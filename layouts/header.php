<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo md5_file('assets/css/style.css') ?>">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Главная</title>
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
