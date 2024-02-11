<?php

session_start();
include('connection.php');

// обработка пост запроса на сохранение адреса доставки
if (isset($_POST['place_order'])) {

    // получаем информацию об адресе доставки и сохраняем в базу данных
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $house = $_POST['house'];
    $flat = $_POST['flat'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H-m-s');

    $stmt = $conn->prepare("INSERT INTO orders (
        order_cost,
        order_status,	
        user_id,
        user_phone,
        user_city,
        user_street,
        user_house,
        user_flat,
        order_date	
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?); ");
    $stmt->bind_param(
        "isiisssis",
        $order_cost,
        $order_status,
        $user_id,
        $phone,
        $city,
        $street,
        $house,
        $flat,
        $order_date
    );
    $stmt->execute();

    // 2. создаем и сохраняем новый заказ в базе
    $order_id = $stmt->insert_id;


    // 3. получаем товары из корзины (сессии)
    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];


        //4. сохраняем каждый товар в order_items базы
        $stmt1 = $conn->prepare("INSERT INTO order_items (
            order_id,
            product_id,
            product_name,
            product_image,
            product_price,
            product_quantity,
            user_id,
            order_date
        ) VALUES (?,?,?,?,?,?,?,?)");

        $stmt1->bind_param(
            "iissiiis",
            $order_id,
            $product_id,
            $product_name,
            $product_image,
            $product_price,
            $product_quantity,
            $user_id,
            $order_date
        );

        $stmt1->execute();
    }


    // 5. удалить все из корзины
    // unset($_SESSION['cart']);

    // 6. сообщить юзеру все ли в порядке или есть проблемки
    header('location: ../payment.php?order_status=Ваш заказ принят');






} else {

}