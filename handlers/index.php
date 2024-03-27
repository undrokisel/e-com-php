<?php

include ('server/connection.php');

// получаем первые четыре категории
$stmt = $conn->prepare("SELECT DISTINCT product_category FROM products LIMIT 4");
$stmt->execute();
$result = $stmt->get_result();
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$categories = array_column($categories, 'product_category');

//на каждую из категорий получаем по 4 товара и сохраняем. 

foreach ($categories as $category) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT 4");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $productsByCategory[$category] = $products;
}

?>