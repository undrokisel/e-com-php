<?php
include('server/connection.php');


// получаем все категории (для отражения в левом aside)
$stmtCategories = $conn->prepare("SELECT DISTINCT product_category from products");
$stmtCategories->execute();
$result = $stmtCategories->get_result();
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$categories = array_column($categories, 'product_category');




// если нажали на поиск
if (isset($_POST['search'])) {
    $category = $_POST['category'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
    $stmt->bind_param("si", $category, $price);
    $stmt->execute();
    $products = $stmt->get_result();

    // если поиск не использован, то возрващаем все продукты 
} else {
    // определяем номер страницы из урла, если он не установлен - дефолт 1
    if (isset($_GET['page']) && $_GET['page'] != "") {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    // возвращаем количество товаров в магазине
    $stmtPages = $conn->prepare("SELECT COUNT(*) as total_records from products");
    $stmtPages->execute();
    $stmtPages->bind_result($total_records);
    $stmtPages->store_result();
    $stmtPages->fetch();

    
    // количество товаров на странице
    $total_records_per_page = 1;
    // сдвиг для запроса в базу под каждую страницу
    $offset = ($page - 1) * $total_records_per_page;
    $prev_page = $page - 1;
    $next_page = $page + 1;
    // $adjacents = "2";
    
    //количество страниц 
    $total_num_of_pages = ceil($total_records / $total_records_per_page);

    // получаем товары, соответствующие странице
    // $offset - сдвиг от первой записи 
    $stmt = $conn->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
    $stmt->execute();
    $products = $stmt->get_result();


}

?>


<?php include('layouts/header.php') ?>



<!-- поиск search -->
<div class="d-flex">

    <aside id="search" class="my-5 pb-5 ms-2">
        <div class="container mt-5 py-5">
            <p>Поиск по товарам: </p>
            <hr>

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">

                        <p>Категории</p>

                        <?php foreach ($categories as $key => $category) { ?>


                            <div class="form-check">
                                <input type="radio" value="<?php echo $category ?>" name="category" id="category_one"
                                    class="form-check-input">
                                <label class="form-check-label" for="flexRadioDefault">
                                    <?php echo $category ?>
                                </label>
                            </div>


                        <?php } ?>

                    </div>
                </div>

                <div class="row mx-auto container mt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p>Цена</p>
                        <input type="range" name="price" value="10000" class="form-range w-150" min="1" max="10000"
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



    </aside>

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



                <nav aria-label="pagination">
                    <ul class="pagination mt-5">

                        <!-- предыдущая страница -->
                        <li class="page-item <?php if ($page <= 1) {
                            echo 'disabled';
                        } ?>">
                            <a href="<?php if ($page <= 1) {
                                echo '#';
                            } else {
                                echo "?page=" . ($page - 1);
                            } ?>" class="page-link">
                                Предыдущая
                            </a>
                        </li>

                        <li class="page-item"><a href="?page=1" class="page-link">1</a></li>
                        <li class="page-item"><a href="?page=2" class="page-link">2</a></li>

                        <?php if ($page >= 3) { ?>
                            <li class="page-item"><a href="#" class="page-link">...</a></li>
                            <li class="page-item">
                                <a href="<?php echo "?page=" . $page; ?>" class="page-link">
                                    <?php echo $page;
                                    ?>
                                </a>
                            </li>

                        <?php } ?>

                        <!-- следующая страница -->
                        <li class="page-item <?php if ($page >= $total_num_of_pages) {
                            echo 'disabled';
                        } ?>">
                            <a href="<?php if ($page >= $total_num_of_pages) {
                                echo '#';
                            } else {
                                echo "?page=" . ($page + 1);
                            } ?>" class="page-link">
                                Следующая
                            </a>
                        </li>
                    </ul>
                </nav>


            </div>
    </section>
</div>


<?php include('layouts/footer.php') ?>