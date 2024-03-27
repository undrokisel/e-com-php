<?php include ('handlers/cart.php') ?>
<?php include ('layouts/header.php') ?>


<!-- cart -->
<section class="cart container my-5 py-5 min-vh-60">



    <div class="container mt-5">
        <h2 class="font-weight-bold pt-5">Корзина</h2>
        <?php if (isset ($_GET['message'])) {
            echo "<h4 class='text-violet2'>Все товары пока доступны только в одном экземпляре<h3>";
        } ?>
        <hr class="">
    </div>


    <?php if (isset ($_SESSION['cart'])) { ?>
        <div class="table-wrapper">
            <table class="mt-5pt-5">
                <tr>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Стоимость</th>
                    <th></th>
                </tr>

                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="assets/images/<?php echo $value['product_image'] ?>" alt="" class="src" />

                                <div class="table-product-name">

                                    <div class="">
                                        <p>
                                            <?php echo $value['product_name'] ?>
                                        </p>
                                        <small>
                                            <?php echo $value['product_price'] ?>
                                            <span>руб.</span>
                                        </small>
                                    </div>

                                </div>

                            </div>
                        </td>

                        <td>
                            <form action="cart.php" method="POST" class="d-flex">
                                <input type="hidden" name="product_id" value=<?php echo $value['product_id'] ?>>
                                <input type="number" name="product_quantity" value="1" min="1" max="1" />
                                <input type="submit" name="edit_quantity" value="Изменить" class="btn edit-btn">
                            </form>
                        </td>

                        <td>
                            <span class="product-price">
                                <?php echo ($value['product_price'] * $value['product_quantity']) ?>
                            </span>
                            <span>руб.</span>
                        </td>

                        <td>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'] ?>">
                                <input class="btn remove-btn" type="submit" name="remove_product" value="Удалить">
                            </form>
                        </td>

                    </tr>
                <?php } ?>


            </table>
        </div>


        <div class="cart__total">
            <table>
                <tr>
                    <td class="product-price">Всего</td>
                    <td class="product-price">
                        <?php if (isset ($_SESSION['total'])) {
                            echo $_SESSION['total'];
                        } ?> руб.
                    </td>
                </tr>
            </table>
        </div>

        <div class="cart-btn-group">
            <div class="cart-btn-group__item">
                <a href="shop.php" class="btn btn-submit">Вернуться к шопингу</a>
            </div>
            <form class="cart-btn-group__item" action="checkout.php" method="POST">
                <input type="submit" name="checkout" value="К настройкам доставки" class="btn checkout-btn" />
            </form>

        </div>

    <?php } else { ?>
        <h4 class="">В корзине пока пусто &#9785</h4>

    <?php } ?>

</section>

<?php include ('layouts/footer.php') ?>