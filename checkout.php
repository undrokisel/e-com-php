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

<?php include('layouts/header.php') ?>


<!-- checkout -->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Адрес доставки:</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form action="server/place_order.php" method="POST" id="checkout-form">

            <p class="text-center text-danger">
                <?php if (isset($_GET['message'])) {
                    echo $_GET['message'];
                } ?>
            </p>
            <p class="text-center">
                <?php if (isset($_GET['message'])) { ?>
                    <a href="login.php" class="btn btn-primary">Войти</a>
                <?php } ?>
            </p>


            <div class="form-group checkout-small-element">
                <label>Как звать? Какой позывной?</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Вася" required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Почта</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="email" required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Телефон</label>
                <input type="tel" pattern="[0-9]*" class="form-control" id="checkout-phone" name="phone"
                    placeholder="цифры" required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Город</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Москве" required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Улица</label>
                <input type="text" class="form-control" id="checkout-street" name="street" placeholder="Ленина"
                    required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Дом</label>
                <input type="text" class="form-control" id="checkout-house" name="house" placeholder="1" required />
            </div>

            <div class="form-group checkout-small-element">
                <label>Квартира</label>
                <input type="number" min="1" class="form-control" id="checkout-flat" name="flat" placeholder="1"
                    required />
            </div>



            <div class="form-group checkout-btn-container">
                <p>Итого к оплате:
                    <?php
                    if (isset($_SESSION['total'])) {
                        echo $_SESSION['total'];
                    }
                    ?> руб
                </p>
                <input type="submit" name="place_order" class="btn" id="checkout-btn" value="Сохранить" />
            </div>


        </form>
    </div>
</section>


<?php include('layouts/footer.php') ?>