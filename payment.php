<?php

include('assets/constants/constants.php');
session_start();

if (isset($_POST['order_pay_btn'])) {
    $_POST["order_status"];
    $_POST["total_order_price"];

}



?>

<?php include('layouts/header.php') ?>


<!-- payment -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Оплата:</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container text-center">

        <?php if (isset($_SESSION['total']) && ($_SESSION['total'] != 0)) { ?>
            <p>К оплате всего:
                <?php echo $_SESSION['total']; ?>
            </p>
            <input class="btn-primary btn" type="submit" value="Оплатить сейчас">

        <?php } else if (isset($_POST['order_status']) && $_POST['order_status'] == $NOT_PAID) { ?>
                <p>Всего к оплате:
                <?php echo $_POST['total_order_price'] ?> руб.
                </p>
                <input class="btn-primary btn" type="submit" value="Оплатить сейчас">


        <?php } else { ?>
                <p>Нет неоплаченных заказов</p>
        <?php } ?>






    </div>
</section>


<?php include('layouts/footer.php') ?>