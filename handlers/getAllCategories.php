<?php include ('server/connection.php');

// получаем все категории (для отражения в левом aside)
$stmt_categories = $conn->prepare("SELECT DISTINCT product_category from products");

$stmt_categories->execute();
$result = $stmt_categories->get_result();
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$categories = array_column($categories, 'product_category');

