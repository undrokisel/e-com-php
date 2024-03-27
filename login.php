

<?php include('auth/login.php') ?>
<?php include('layouts/header.php') ?>


<!-- login -->
<section class="py-5 section-login">
    <div class="container text-center mt-3 pt-5">
        <!-- <h2 class="form-weight-bold">Заходи, не стесняйся</h2> -->
        <h2 class="form-weight-bold">Страница входа</h2>
        <hr class="mx-auto hr" />
    </div>
    <div class="mx-auto container">
        <form action="login.php" method="POST" id="login-form">

            <h4 class="text-danger">
                <?php if (isset($_GET['error'])) {
                    echo $_GET['error'];
                } ?>
            </h4>
            <h4 class="text-violet2">
                <?php if (isset($_GET['message'])) {
                    echo $_GET['message'];
                } ?>
            </h4>

            <div class="form-group">
                <label>Почта</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Почта" required />
            </div>

            <div class="form-group">
                <label>Пароль</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="пароль"
                    required />
            </div>

            <div class="form-group mt-3">
                <input type="submit" name="login" class="btn" id="login-btn" value="Войти" />
            </div>

            <div class="form-group mt-2">
                <a id="register-url" class="btn" href="register.php">Зарегистрироваться</a>
            </div>

        </form>
    </div>
</section>

<?php include('layouts/footer.php') ?>