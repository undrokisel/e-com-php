


<?php include ('handlers/account.php') ?>

<?php include ('layouts/header.php') ?>


<!-- account -->
<section class="account section-account py-5">
    <div class="row container mx-auto">

        <h4 class="text-success text-center">
            <?php if (isset ($_GET['register_success'])) {
                echo $_GET['register_success'];
            } ?>
        </h4>
        <h4 class="text-success text-center">
            <?php if (isset ($_GET['login_success'])) {
                echo $_GET['login_success'];
            } ?>
        </h4>

        <div class="text-center pt-4 mt-5 col-lg-6 col-md-12 col-sm-12">
            <h3 class="font-weight-bold">Данные аккаунта</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p class="personal-text">Имя: <span>
                        <?php if (isset ($_SESSION['user_name'])) {
                            echo $_SESSION['user_name'];
                        } ?>
                    </span></p>
                <p class="personal-text">Почта: <span>
                        <?php if (isset ($_SESSION['user_email'])) {
                            echo $_SESSION['user_email'];
                        } ?>
                    </span></p>
                <p><a id="order-btn" href="#orders">Мои заказы</a></p>

                <p><a id="logout-btn" href="account.php?logout=1">Выйти из системы</a></p>

                <p class="">
                    <a href="shop.php" class="btn btn-submit account-left-btn">Вернуться к шопингу</a>
                </p>
                <p class="">
                    <a href="cart.php" class="btn btn-submit account-left-btn">Вернуться к корзине</a>
                </p>


            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 mt-5">

            <form action="account.php" method="POST" id="account-form">
                <h3>Сменить пароль</h3>
                <hr class="mx-auto">
                <h4 class="text-danger text-center">
                    <?php if (isset ($_GET['error'])) {
                        echo $_GET['error'];
                    } ?>
                </h4>
                <h4 class="text-success text-center">
                    <?php if (isset ($_GET['message'])) {
                        echo $_GET['message'];
                    } ?>
                </h4>


                <div class="form-group">
                    <label class="personal-text">Новый пароль</label>
                    <input type="password" class="form-control" required name="password" id="account-password"
                        placeholder="новый пароль">
                </div>

                <div class="form-group">
                    <label class="personal-text">Подтвердить пароль</label>
                    <input type="password" class="form-control" required name="confirmPassword"
                        id="account-password-confirm" placeholder="новый пароль">
                </div>

                <div class="form-group">
                    <input type="submit" name="changePass" class="btn btn-submit" value="Сохранить"
                        id="change-pass-btn">
                </div>

            </form>
        </div>
    </div>
</section>






<!-- orders -->
<section id="orders" class="orders container my-5 py-5">
    <div class="container mt-5 mx-auto">
        <h2 class="font-weight-bold text-center">Ваши заказы</h2>
        <hr class="mx-auto">




        <div class="table-wrapper">

            <!-- // Проверка, есть ли заказы -->
            <h4 class="text-violet2 text-center">
                <?php if ($orders->num_rows == 0) {
                    echo "Кажется, заказов от вас еще не было &#9785";
                } else { ?>
                </h4>
                <table class="mt-5 pt-5 mx-auto text-center">
                    <tr>
                        <th>Номер заказа</th>
                        <th>Стоимость заказа</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Детали заказа</th>
                    </tr>




                    <?php while ($row = $orders->fetch_assoc()) { ?>

                        <tr>

                            <!-- order_id -->
                            <td>
                                <span>
                                    <?php echo $row['order_id'] ?>
                                </span>
                            </td>
                            <!-- order_cost -->
                            <td>
                                <span class="">
                                    <?php echo $row['order_cost'] ?>
                                </span>
                            </td>
                            <!-- order_status -->
                            <td>
                                <span class="">
                                    <?php echo $status_enam[$row['order_status']] ?>
                                </span>
                            </td>
                            <!-- order_date -->
                            <td>
                                <span class="">
                                    <?php echo $row['order_date'] ?>
                                </span>
                            </td>
                            <!-- Подробнее -->
                            <td>
                                <form action="order_details.php" method="POST">
                                    <input type="hidden" name="order_status" value="<?php echo $row['order_status'] ?>">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <input class="btn order-details-btn" name="order_details_btn" type="submit"
                                        value="Подробнее">
                                </form>
                            </td>

                        </tr>
                    <?php }
                } ?>

            </table>
        </div>

    </div>


</section>

<?php include ('layouts/footer.php') ?>