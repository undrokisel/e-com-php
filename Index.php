<?php

include('server/connection.php');


// получаем первые четыре категории
$stmt = $conn->prepare("SELECT DISTINCT product_category FROM products LIMIT 4");
$stmt->execute();
$result = $stmt->get_result();
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$categories = array_column($categories, 'product_category');

//на каждую из категорий получаем по 4 товара и сохраняем. 
$selectedProducts = array();

foreach ($categories as $category) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? LIMIT 4");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $productsByCategory[$category] = $products;
}



?>


<?php include('layouts/header.php') ?>



<!-- hero banner -->
<section id="hero">
    <div class="container">
        <h4>НОВИНКИ</h4>
        <h1>У нас <span>лучшие цены</span></h1>
        <p>MAGAZON предлагает лучшие мерчи по незашкварным ценам </p>

        <a href="shop.php">
            <button class="btn">Налетай-покупай</button>
        </a>
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

<!-- товары по категориям -->

<?php foreach ($productsByCategory as $key => $products) { ?>

    <section id="features" class="my-5">
        <div class="text-center container mt-5 py-5">
            <h3>
                <?php echo $products[0]['product_category'] ?>
            </h3>
            <hr class="mx-auto">
            <p>Зацени
                <?php echo $products[0]['product_category'] ?>:
            </p>

            <div class="row mx-auto container-fluid ">

                <?php foreach ($products as $key => $product) { ?>


                    <!-- товар  -->
                    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
                                <button class="btn buy-btn">Давай-покупай</button>
                            </a>
                        </div>
                    </div>

                <?php } ?>





            </div>
        </div>
    </section>

<?php } ?>


<?php include('layouts/footer.php') ?>