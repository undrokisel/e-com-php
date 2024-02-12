<?php
include('server/connection.php');

if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
    $stmt->bind_param("si", $category, $price);
    $stmt->execute();
    $products = $stmt->get_result();

    // если поиск не использован, то возрващаем все продукты
} else {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->get_result();
}

?>


<?php include('layouts/header.php') ?>



<!-- поиск search -->
<div class="d-flex">
    <section id="search" class="my-5 pb-5 ms-2">
        <div class="container mt-5 py-5">
            <p>Поиск по товарам: </p>
            <hr>

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Категории</p>

                        <div class="form-check">
                            <input type="radio" value="gadgets" name="category" id="category_one"
                                class="form-check-input" checked>
                            <label class="form-check-label" for="flexRadioDefault">
                                Гаджеты
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" value="toys" name="category" id="category_two" class="form-check-input"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Игрушки
                            </label>
                        </div>

                    </div>
                </div>

                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Цена</p>
                        <input type="range" name="price" value="1000" class="form-range w-150" min="1" max="10000"
                            id="customRange2">
                        <div class="w-50 d-flex justify-content-between gap-5">
                            <div class="">1</div>
                            <div class="">10000</div>
                        </div>
                    </div>
                </div>


                <div class="form-group my-3 mx-3">
                    <input type="submit" name="search" value="Искать" class="btn btn-primary">
                </div>


            </form>



    </section>

    <!-- shop -->
    <section id="features" class="my-5 pb-5">
        <div class="text-center container mt-5 py-5">
            <h3>Хайп и топчик:</h3>
            <hr class="mx-auto">
            <p>Ознакомьтесь с нашими рекомендуемыми продуктами</p>

            <div class="row mx-auto container-fluid ">

                <?php while ($row = $products->fetch_assoc()) { ?>

                    <div onclick="window.location.href='single_product.php'"
                        class="product text-center col-lg-3 col-md-4 col-sm-12">

                        <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image']; ?>" />
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h5 class="p-name">
                                <?php echo $row['product_name']; ?>
                            </h5>
                            <h4 class="p-price">
                                <?php echo $row['product_price']; ?> руб
                            </h4>
                            <a href="<?php echo "single_product.php?product_id=" . $row['product_id'] ?>"
                                class="btn shop-buy-btn">Давай-покупай</a>
                        </div>
                    </div>

                <?php } ?>

                <nav aria-label="Навигация">
                    <ul class="pagination mt-5">
                        <li class="page-item"><a href="#" class="page-link">Предыдущая</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">Следующая</a></li>
                    </ul>
                </nav>


            </div>
    </section>
</div>


<?php include('layouts/footer.php') ?>