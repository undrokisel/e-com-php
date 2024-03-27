<?php
include ('assets/constants/constants.php');
include ('server/connection.php');

session_start();

if (isset ($_POST["order_details_btn"]) && isset ($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();
    $total_order_price = calcTotalOrderPrice($order_details);
} else {
    header('location: account.php');
    exit();
}


function calcTotalOrderPrice($order_details)
{
    $total = 0;

    foreach ($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += $product_price * $product_quantity;
    }
    return $total;
}


?>