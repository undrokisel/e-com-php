


<?php include ('handlers/index.php') ?>

<?php include ('layouts/header.php') ?>



<!-- hero banner -->
<section id="hero">
    <div class="container">
        <div class="hero__text-items">

            <h4>Украшения ручной работы</h4>
            <h1>Найди <span>свою уникальность</span></h1>
            <p>Все изделия только в <b class="text-violet2">одном</b> экземпляре</p>

            <a href="shop.php">
                <button class="btn">В каталог</button>
            </a>
        </div>
    </div>
</section>



<!-- рекомендуемое featured -->
<section id="features" class="my-5 pb-5">
    <div class="text-center container mt-5 py-5">
        <h3>Наши любимые:</h3>
        <hr class='mx-auto'>
        <p class="cards__subtitle">Ознакомьтесь с нашими рекомендуемыми продуктами</p>

        <div class="row mx-auto container-fluid ">

            <!-- подключаем файл запроса продуктов -->
            <?php include ('server/get_feature_products.php'); ?>

            <!-- product  -->
            <!-- извлечение каждой строки результата запроса и сохранение ее в переменной $row 
                в виде ассоциативного массива.  -->
            <?php while ($row = $featured_products->fetch_assoc()) { ?>

                <div class="product text-center col-lg-3 col-md-4 col-sm-6 col-xsm-12">

                    <img class="img-fluid mb-3" src="assets/images/<?php echo $row['product_image'] ?>" />
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h5 class="p-name">
                            <?php echo $row['product_name'] ?>
                        </h5>
                        <h4 class="p-price">
                            <?php echo $row['product_price'] ?>
                        </h4>
                        <a href="<?php echo "single_product.php?product_id=" . $row['product_id']; ?>">
                            <button class="btn buy-btn">Подробнее</button>
                        </a>
                    </div>
                </div>

            <?php } ?>

        </div>
</section>

<!-- banner -->
<section id="hero2" class="my-5 py-5">
    <div class="container">
        <h2>Открой свое серце весне!</h2>

        <h1><span class="text-violet">Весенняя коллекция</span> <br>скидки до 30%</h1>

        <a href="shop.php" class="btn ">В каталог</a>
    </div>
</section>

<!-- товары по категориям -->

<?php foreach ($productsByCategory as $key => $products) { ?>

    <section id="categoriedProducts" class="my-2">
        <div class="text-center container mt-5 ">
            <h3 class="section-title">
                <?php echo $products[0]['product_category'] ?>
            </h3>
            <hr class="mx-auto">


            <div class="row mx-auto container-fluid ">

                <?php foreach ($products as $key => $product) { ?>


                    <!-- товар  -->
                    <div class="product text-center col-lg-3 col-md-4 col-sm-6 col-xsm-12">
                        <img class="img-fluid mb-3" src="assets/images/<?php echo $product['product_image'] ?>" />
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h5 class="p-name">
                                <?php echo $product['product_name'] ?>
                            </h5>
                            <h4 class="p-price">
                                <?php echo $product['product_price'] ?> руб
                            </h4>
                            <a href="<?php echo "single_product.php?product_id=" . $product['product_id']; ?>">
                                <button class="btn buy-btn">Подробнее</button>
                            </a>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>

<?php } ?>


<?php include ('layouts/footer.php') ?>