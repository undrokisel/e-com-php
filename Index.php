<?php include('layouts/header.php') ?>



<!-- hero banner -->
<section id="hero">
    <div class="container">
        <h4>НОВИНКИ</h4>
        <h1>У нас <span>лучшие цены</span></h1>
        <p>MAGAZON предлагает лучшие мерчи по незашкварным ценам </p>
        <button class="btn">Налетай-покупай</button>
    </div>
</section>


<!-- brands -->
<section id="brands" class="container">
    <div class="row">
        <img src="assets/images/brand1.jpg" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="assets/images/brand2.png" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="assets/images/brand3.jpg" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="assets/images/brand4.png" alt="brand" class="img-fluid col-lg-3 col-md-6 col-sm-12">
    </div>
</section>


<!-- New -->
<section id="new" class="container w-100">
    <div class="row p-0 m-0">

        <!-- 1 -->
        <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="assets/images/new1.jpg" alt="new" class="img-fluid">
            <div class="details">
                <h2>Зачетные буцы</h2>
                <button class="btn text-uppercase">Давай покупай</button>
            </div>
        </div>

        <!-- 2 -->
        <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="assets/images/new2.png" alt="new" class="img-fluid">
            <div class="details">
                <h2>Куртяжка топчик</h2>
                <button class="btn text-uppercase">Давай покупай</button>
            </div>
        </div>

        <!-- 3 -->
        <div class="new__item col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="assets/images/new3.png" alt="new" class="img-fluid">
            <div class="details">
                <h2>50% скидос на вотчез</h2>
                <button class="btn text-uppercase">Давай покупай</button>
            </div>
        </div>
    </div>
</section>


<!-- рекомендуемое featured -->
<section id="features" class="my-5 pb-5">
    <div class="text-center container mt-5 py-5">
        <h3>Хайп и топчик:</h3>
        <hr class='mx-auto'>
        <p>Ознакомьтесь с нашими рекомендуемыми продуктами</p>

        <div class="row mx-auto container-fluid ">

            <!-- подключаем файл запроса продуктов -->
            <?php include('server/get_feature_products.php'); ?>

            <!-- product  -->
            <!-- извлечение каждой строки результата запроса и сохранение ее в переменной $row 
                в виде ассоциативного массива.  -->
            <?php while ($row = $featured_products->fetch_assoc()) { ?>

                <div class="product text-center col-lg-3 col-md-4 col-sm-12">

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
                            <button class="btn buy-btn">Давай-покупай</button>
                        </a>
                    </div>
                </div>

            <?php } ?>

        </div>
</section>

<!-- banner -->
<section id="hero" class="my-5 py-5">
    <div class="container">
        <h4>Сезонный разгон</h4>
        <h1>Винтер коллекшн <br>дисконт до 30%</h1>
        <button class="btn text-uppercase">Давай-покупай</button>
    </div>
</section>

<!-- clothes -->
<section id="features" class="my-5">
    <div class="text-center container mt-5 py-5">
        <h3>Шмотки:</h3>
        <hr class="mx-auto">
        <p>Зацени шмотье:</p>

        <div class="row mx-auto container-fluid ">

            <!-- clothes 1 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 2 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 3 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 4 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>


        </div>
    </div>
</section>


<!-- watches -->
<section id="watches" class="my-5">
    <div class="text-center container mt-5 py-5">
        <h3>вотчи:</h3>
        <hr class="mx-auto">
        <p>Зацени вотчи:</p>

        <div class="row mx-auto container-fluid ">

            <!-- clothes 1 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 2 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 3 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 4 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>


        </div>
    </div>
</section>

<!-- shoes -->
<section id="shoes" class="my-5">
    <div class="text-center container mt-5 py-5">
        <h3>тяги:</h3>
        <hr class="mx-auto">
        <p>Зацени тяги:</p>

        <div class="row mx-auto container-fluid ">

            <!-- clothes 1 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 2 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 3 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- clothes 4 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/images/featured1.png" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Апль вижин китайский</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>


        </div>
    </div>
</section>


<?php include('layouts/footer.php') ?>