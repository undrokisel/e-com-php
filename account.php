<?php
include('server/connection.php');
session_start();

// если еще не залогинен, то сразу отправим на страницу логина
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit();
}


if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        header('location: login.php');
        exit();
    }
}

if (isset($_POST['changePass'])) {

    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirmPassword'];
    $email = $_SESSION['user_email'];

    // если введенные пароли не совпадают
    if ($pass !== $confirm_pass) {
        header('location: account.php?error=пароли не совпадают');
    } else if (strlen($pass) < 6) {
        header('location: account.php?error=длина пароля должна быть не меньше 6 символов');
        // 
    } else {
        // если пароли совпадают, то сохраним пароль в таблицу
        $newHashedPass = md5($pass);
        $smtp = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $smtp->bind_param('ss', $newHashedPass, $email);
        if ($smtp->execute()) {
            header('location: account.php?message=Пароль успешно изменен');
        } else {
            header('location: account.php?error=не удалось изменить пароль');
        }
    }
}

// получаем заказы
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();


    $status_enam = [
        "on_hold" => 'в обработке',
        "not_paid" => 'не оплачен',
        "delivered" => 'доставлен',
    ];



}


?>


<?php include('layouts/header.php') ?>


    <!-- account -->
    <section class="account my-5 py-5">
        <div class="row container mx-auto">

            <h4 class="text-success text-center">
                <?php if (isset($_GET['register_success'])) {
                    echo $_GET['register_success'];
                } ?>
            </h4>
            <h4 class="text-success text-center">
                <?php if (isset($_GET['login_success'])) {
                    echo $_GET['login_success'];
                } ?>
            </h4>

            <div class="text-center mt-3 pt-5 col-lg-5 col-md-12 col-sm-12">
                <h3 class="font-weight-bold">Досье</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Имя: <span>
                            <?php if (isset($_SESSION['user_name'])) {
                                echo $_SESSION['user_name'];
                            } ?>
                        </span></p>
                    <p>Почта: <span>
                            <?php if (isset($_SESSION['user_email'])) {
                                echo $_SESSION['user_email'];
                            } ?>
                        </span></p>
                    <p><a id="order-btn" href="#orders">МОИ ЗАКАЗЫ</a></p>

                    <p><a id="logout-btn" href="account.php?logout=1">Разлогиниться</a></p>

                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">

                <form action="account.php" method="POST" id="account-form">
                    <h3>Сменить пасс</h3>
                    <hr class="mx-auto">
                    <h4 class="text-danger text-center">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </h4>
                    <h4 class="text-success text-center">
                        <?php if (isset($_GET['message'])) {
                            echo $_GET['message'];
                        } ?>
                    </h4>


                    <div class="form-group">
                        <label>Пасс</label>
                        <input type="password" class="form-control" required name="password" id="account-password"
                            placeholder="Пасс">
                    </div>

                    <div class="form-group">
                        <label>Подтвердить пасс</label>
                        <input type="password" class="form-control" required name="confirmPassword"
                            id="account-password-confirm" placeholder="Пасс">
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
                        <td>
                            <span>
                                <?php echo $row['order_id'] ?>
                            </span>
                        </td>

                        <td>
                            <span class="">
                                <?php echo $row['order_cost'] ?>
                            </span>
                        </td>
                        <td>
                            <span class="">
                                <?php echo $status_enam[$row['order_status']] ?>
                            </span>
                        </td>
                        <td>
                            <span class="">
                                <?php echo $row['order_date'] ?>
                            </span>
                        </td>
                        <td>
                            <form action="order_details.php" method="POST">
                                <input type="hidden" name="order_status" value="<?php echo $row['order_status'] ?>">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                <input class="btn order-details-btn" name="order_details_btn" type="submit"
                                    value="Подробнее">
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        </div>


    </section>

    <?php include('layouts/footer.php') ?>
