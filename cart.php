<?php
session_start();

// если пришел запрос на добавление в корзину
if (isset($_POST['add_to_cart'])) {

    // если козрзина для пользователя уже существует
    if (isset($_SESSION['cart'])) {
        // создадим массив с айдишниками товаров корзины
        $product_array_ids = array_column($_SESSION['cart'], "product_id");

        // если товар еще не добавлялся в корзину
        if (!in_array($_POST['product_id'], $product_array_ids)) {

            $product_id = $_POST['product_id'];

            // создадим массив с данными товара    
            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );

            // и добавим его в корзину
            $_SESSION['cart'][$product_id] = $product_array;

            // если товар уже добавлен в корзину
        } else {
            // выводим алерт
            echo '<script>alert("Товар уже в корзине")</script>';
            // перенаправляем на главную
            // echo '<script>window.location="index.php"</script>';
        }

        // если корзины еще не создано
    } else {
        // создадим массив с данными товара    
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );

        // создадим корзину и заодно добавим туда товар
        $_SESSION['cart'][$product_id] = $product_array;

    }
    // подсчет всей стоимости корзины
    calcTotalCart();

    // обработка запроса на удаление товара из корзины
} else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calcTotalCart();

    // обработка запроса на изменение количества товара в корзине
} else if (isset($_POST['edit_quantity'])) {
    // получаем id и количество из формы
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // получаем массив характеристик продукта из сессии
    $product_array = $_SESSION['cart'][$product_id];

    // обновляем в этом массиве данные о количестве
    $product_array['product_quantity'] = $product_quantity;

    // возвращаем обновленный товар в сессию
    $_SESSION['cart'][$product_id] = $product_array;
    calcTotalCart();

} else {
    // header('location: index.php');
}


function calcTotalCart()
{
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {

        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total += $price * $quantity;
    }
    $_SESSION['total'] = $total;
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

    <title>КОРЗИНА</title>
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

    <!-- cart -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Что-то мало набрали</h2>
            <hr class="">
        </div>
        <table class="mt-5pt-5">
            <tr>
                <th>Товар</th>
                <th>Количество</th>
                <th>Стоимость</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>

                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/images/<?php echo $value['product_image'] ?>" alt="" class="src" />
                            <div class="">
                                <p>
                                    <?php echo $value['product_name'] ?>
                                </p>
                                <small><span>деревянных:</span>
                                    <?php echo $value['product_price'] ?>
                                </small>
                                <br>

                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                    <input class="remove-btn" type="submit" name="remove_product" value="УДАЛИТЬ">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form action="cart.php" method="POST" class="d-flex">
                            <input type="hidden" name="product_id" value=<?php echo $value['product_id'] ?>>
                            <input type="number" min="1" name="product_quantity"
                                value="<?php echo $value['product_quantity'] ?>" />
                            <input type="submit" name="edit_quantity" value="Изменить" class="edit-btn">
                        </form>
                    </td>

                    <td>
                        <span>деревянных: </span>
                        <span class="product-price">
                            <?php echo ($value['product_price'] * $value['product_quantity']) ?>
                        </span>
                    </td>

                </tr>
            <?php } ?>


        </table>

        <div class="cart__total">
            <table>
                <?php echo $_SESSION['total']; ?> деревянных
                <tr>
                    <td>Всего</td>
                    <td>
                        <?php echo $_SESSION['total']; ?> деревянных
                    </td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form action="checkout.php" method="POST">

                <input type="submit" name="checkout" value="К настройкам доставки" class="btn checkout-btn" />
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