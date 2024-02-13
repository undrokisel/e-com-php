<?php
include('assets/constants/constants.php');
include('server/connection.php');

session_start();

if (isset($_POST["order_details_btn"]) && isset($_POST['order_id'])) {
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


<?php include('layouts/header.php') ?>


<!-- order details -->
<section id="orders" class="orders container my-5 py-5">
    <div class="container mt-5 mx-auto">
        <h2 class="font-weight-bold text-center">Детали заказа</h2>
        <hr class="mx-auto">

        <table class="mt-5 pt-5 mx-auto text-center">
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>

            <?php foreach ($order_details as $row) { ?>

                <tr>
                    <td>
                        <div class="">
                            <img src="assets/images/<?php echo $row['product_image'] ?>" alt="" class="src" />
                            <div class="">
                                <p>
                                    <?php echo $row['product_name'] ?>
                                </p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="">
                            <?php echo $row['product_price'] ?>
                            руб.
                        </span>
                    </td>
                    <td>
                        <span class="">
                            <?php echo $row['product_quantity'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="">
                            <?php echo $row['order_status'] ?>
                        </span>
                    </td>

                </tr>
            <?php } ?>
        </table>

        <?php if ($order_status === $NOT_PAID) { ?>
            <form action="payment.php" method="POST" class='d-flex justify-content-end'>
                <input type="hidden" name="order_id" value=<?php echo $order_id; ?>>
                <input type="hidden" name="total_order_price" value=<?php echo $total_order_price; ?>>
                <input type="hidden" name="order_status" value=<?php echo $order_status; ?>>
                <input type="submit" name="order_pay_btn" class="btn btn-warning mx-auto" value="Оплатить сейчас">
            </form>
        <?php } ?>
    </div>


</section>


<?php include('layouts/footer.php') ?>