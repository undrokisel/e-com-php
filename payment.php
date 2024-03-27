

<?php include ('handlers/payment.php') ?>
<?php include ('layouts/header.php') ?>


<!-- payment -->
<section class="section__payment my-5 py-5">
    <div class="container text-center mt-3 pt-5 ">
        <?php
        if (isset ($_GET['order_status'])) {
            echo "<h3 class='text-success mb-4'>" . $_GET['order_status'] . "</h3>";
        }
        ?>
        <h2 class="form-weight-bold">Оплата:</h2>
        <hr class="mx-auto" />
    </div>

    <div class="mx-auto container text-center">

        <?php if (isset ($_SESSION['total']) && ($_SESSION['total'] != 0)) { ?>
            <p class="payment__text">К оплате всего:
                <?php echo $_SESSION['total']; ?>
            </p>
            <!-- <input class="btn-primary btn" type="submit" value="Оплатить сейчас"> -->
            <button onClick="alert('Внесите оплату на карту 1234 1234 1234 1234')" class="btn-primary btn">
                Оплатить сейчас</button>

        <?php } else if (isset ($_POST['order_status']) && $_POST['order_status'] == $NOT_PAID) { ?>
                <p>Всего к оплате:
                <?php echo $_POST['total_order_price'] ?> руб.
                </p>
                <button onClick="alert('Внесите оплату на карту 1234 1234 1234 1234')" class="btn-primary btn">
                    Оплатить сейчас</button>


        <?php } else { ?>
                <p>Нет неоплаченных заказов</p>
        <?php } ?>






    </div>
</section>


<?php include ('layouts/footer.php') ?>