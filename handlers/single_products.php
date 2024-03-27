<?php

include ('server/connection.php');

if (isset ($_GET['product_id'])) {

    // получаем данные о продукте
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result(); //[]


    // получаем случайных 4 товара . 
    $stmtRecommended = $conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 4");
    $stmtRecommended->execute();
    $result = $stmtRecommended->get_result();
    $productsRecomended = mysqli_fetch_all($result, MYSQLI_ASSOC);



} else {
    header('location:index.php');
}





?>