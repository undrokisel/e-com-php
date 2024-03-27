

<?php include('auth/register.php') ?>
<?php include('layouts/header.php') ?>


<!-- register -->
<section class="py-5 section-register">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Давайте знакомиться!</h2>
        <hr class="mx-auto" />
    </div>
    <div class="mx-auto container">
        <form action="register.php" id="register-form" method="POST">

            <h4 class="text-danger text-big">
                <?php if (isset($_GET['error'])) {
                    echo $_GET["error"];
                } ?>
            </h4>


            <div class="form-group">
                <label>Ваше имя</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Имя" required />
            </div>

            <div class="form-group">
                <label>Почта</label>
                <input type="email" class="form-control" id="register-email" name="email" placeholder="Почта"
                    required />
            </div>

            <div class="form-group">
                <label>Пароль</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Пароль"
                    required />
            </div>

            <div class="form-group">
                <label>Повторите пароль</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                    placeholder="Пароль" required />
            </div>

            <div class="form-group mt-3">
                <input type="submit" name="register" class="btn" id="register-btn" value="Сохранить" />
            </div>

            <div class="form-group mt-2">
                <a id="register-url" class="btn" href="/login.php">Войти</a>
            </div>

        </form>
    </div>
</section>


<?php include('layouts/footer.php') ?>
