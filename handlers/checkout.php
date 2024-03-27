<?php

include('server/place_order.php');
session_start();

// если переход был из непустой корзины
if (!empty($_SESSION['cart'])) {

} else {
    header("location: index.php");
    exit;
}

?>
