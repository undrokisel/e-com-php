<!doctype html>
<html lang="ru">

<head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./assets/css/style.css">


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


    <!-- hero banner -->
    <section id="hero">
        <div class="container">
            <h5>НОВИНКИ</h5>
            <h1><span>Лучшие цены</span></h1>
            <p>MAGAZON предлагает лучшие мерчи по незашкварным ценам </p>
            <button>Налетай-покупай</button>
        </div>
    </section>


    <!-- brands -->
    <section id="brands" class="container">
        <div class="row">
            <img src="assets/images/brand1.jpg" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/images/brand2.png" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/images/brand3.jpg" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
            <img src="assets/images/brand4.png" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        </div>
    </section>


    <!-- New -->
    <section id="new" class="container w-100">
        <div class="row p-0 m-0">

            <!-- 1 -->
            <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/images/new1.jpg" alt="new" class="img-fluid">
                <div class="details">
                    <h2>Зачетные буцы</h2>
                    <button class="text-uppercase">Давай покупай</button>
                </div>
            </div>

            <!-- 2 -->
            <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/images/new2.png" alt="new" class="img-fluid">
                <div class="details">
                    <h2>Куртяжка топчик</h2>
                    <button class="text-uppercase">Давай покупай</button>
                </div>
            </div>

            <!-- 3 -->
            <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
                <img src="assets/images/new3.png" alt="new" class="img-fluid">
                <div class="details">
                    <h2>50% скидос на вотчез</h2>
                    <button class="text-uppercase">Давай покупай</button>
                </div>
            </div>
        </div>
    </section>


    <!-- рекомендуемое featured -->
    <section id="features" class="my-5 pb-5">
        <div class="text-center container mt-5 py-5">
            <h3>Хайп и топчик:</h3>
            <hr class='mx-auto'>
            <p>Ознакомьтесь с нашими рекомендуемыми продуктами</p>

            <div class="row mx-auto container-fluid ">

                <!-- подключаем файл запроса продуктов -->
                <?php include('server/get_feature_products.php'); ?>

                <!-- product  -->
                <!-- извлечение каждой строки результата запроса и сохранение ее в переменной $row 
                в виде ассоциативного массива.  -->
                <?php while ($row = $featured_products->fetch_assoc()) { ?>

                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">

                        <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image'] ?>" />
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h5 class="p-name">
                                <?php echo $row['product_name'] ?>
                            </h5>
                            <h4 class="p-price">
                                <?php echo $row['product_price'] ?>
                            </h4>
                            <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
                                <button class="buy-btn">Давай-покупай</button>
                            </a>
                        </div>
                    </div>

                <?php } ?>

            </div>
    </section>

    <!-- banner -->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>Сезонный разгон</h4>
            <h1>Винтер коллекшн <br>дисконт до 30%</h1>
            <button class="text-uppercase">Давай-покупай</button>
        </div>
    </section>

    <!-- clothes -->
    <section id="features" class="my-5">
        <div class="text-center container mt-5 py-5">
            <h3>Шмотки:</h3>
            <hr class="mx-auto">
            <p>Зацени шмотье:</p>

            <div class="row mx-auto container-fluid ">

                <!-- clothes 1 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 2 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 3 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 4 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>


            </div>
        </div>
    </section>


    <!-- watches -->
    <section id="watches" class="my-5">
        <div class="text-center container mt-5 py-5">
            <h3>вотчи:</h3>
            <hr class="mx-auto">
            <p>Зацени вотчи:</p>

            <div class="row mx-auto container-fluid ">

                <!-- clothes 1 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 2 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 3 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 4 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- shoes -->
    <section id="shoes" class="my-5">
        <div class="text-center container mt-5 py-5">
            <h3>тяги:</h3>
            <hr class="mx-auto">
            <p>Зацени тяги:</p>

            <div class="row mx-auto container-fluid ">

                <!-- clothes 1 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 2 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 3 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>

                <!-- clothes 4 -->
                <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">Апль вижин китайский</h5>
                        <h4 class="p-price">199,8 руб</h4>
                        <button class="buy-btn">Давай-покупай</button>
                    </div>
                </div>


            </div>
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