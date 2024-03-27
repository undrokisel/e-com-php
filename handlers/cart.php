<?php
session_start();


// если пришел запрос на добавление в корзину
if (isset ($_POST['add_to_cart'])) {

    // если козрзина для пользователя уже существует
    if (isset ($_SESSION['cart'])) {
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
} else if (isset ($_POST['remove_product'])) {


    $product_id = $_POST['product_id'];

    // Поиск массива с нужным product_id в корзине
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id) {
            // Удаление массива из корзины
            unset($_SESSION['cart'][$key]);
            break; // Прерываем цикл после удаления
        }
    }

    if (count($_SESSION['cart']) === 0) {
        unset($_SESSION['cart']);
    }

    // header('location: cart.php');
    calcTotalCart();



    // обработка запроса на изменение количества товара в корзине
} else if (isset ($_POST['edit_quantity'])) {



    // получаем id и количество из формы
    // $product_id = $_POST['product_id'];
    // $product_quantity = $_POST['product_quantity'];

    // получаем массив характеристик продукта из сессии
    // $product_array = $_SESSION['cart'][$product_id];

    // обновляем в этом массиве данные о количестве
    // $product_array['product_quantity'] = $product_quantity;

    // возвращаем обновленный товар в сессию
    // $_SESSION['cart'][$product_id] = $product_array;
    // calcTotalCart();

    header('location: cart.php?message="single-quantity"');

} else {

    // header('location: index.php');
}


function calcTotalCart()
{
    $total_price = 0;
    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {

        $product = $_SESSION['cart'][$key];


        $price = $product['product_price'];
        $quantity = $product['product_quantity'];


        $total_price += ($price * $quantity);

        $total_quantity += $quantity;

    }
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

}

?>
