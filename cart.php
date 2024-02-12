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
    header('location: index.php');
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



<?php include('layouts/header.php') ?>


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
                            <small>
                                <?php echo $value['product_price'] ?>
                                <span>руб.</span>
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
                    <span class="product-price">
                        <?php echo ($value['product_price'] * $value['product_quantity']) ?>
                    </span>
                    <span>руб.</span>
                </td>

            </tr>
        <?php } ?>


    </table>

    <div class="cart__total">
        <table>
            <tr>
                <td>Всего</td>
                <td>
                    <?php if (isset($_SESSION['total'])) {
                        echo $_SESSION['total'];
                    } ?> руб.
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

<?php include('layouts/footer.php') ?>