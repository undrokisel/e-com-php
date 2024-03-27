<?php
include ('server/connection.php');
include ('handlers/getAllCategories.php');
include ('handlers/shop.php');

include ('layouts/header.php') ?>


<!-- поиск search -->
<div id="shop" class="d-flex container">

    <aside id="search" class="my-5 ms-2">
        <div class="ps-4 search-container">
            <h3><b>Поиск по товарам:</b> </h3>
            <hr>

            <form action="shop.php" method="POST">
                <div class="row mx-auto container">
                    <div class="col-lg-12 col-md-12 col-sm-12">


                        <div class="categories-label" onClick="toggleShowCategories()">
                            <b>Категории</b>
                            <img class="arrow arrow-reversed" src="assets/images/arrow.png" alt="">
                        </div>

                        <div class="search-categories">
                            <?php foreach ($categories as $key => $category_check) { ?>
                                <div class="form-check">
                                    <input type="radio" value="<?php echo $category_check ?>" name="category"
                                        id="category_one" <?php if (isset ($category) && $category === $category_check) {
                                            echo 'checked';
                                        } ?> class="form-check-input">
                                    <label class="form-check-label" for="flexRadioDefault">
                                        <?php echo $category_check ?>
                                    </label>
                                </div>


                            <?php } ?>
                        </div>


                    </div>
                </div>

                <div class="container aside-search-bottom">

                    <div class="aside-body">
                        <div class="search-range-group col-lg-12 col-md-12 col-sm-12">

                            <p><b>Цена</b></p>

                            <div class="search-range">
                                <input type="range" name="price" value=<?php echo isset ($price) ? $price : 10000 ?>
                                    class="form-range w-150" min="1" max="10000" id="customRange2">

                                <div class="d-flex justify-content-between gap-5">
                                    <div class=""><b>1</b></div>
                                    <div class="price-display"><b>10000</b></div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="form-group my-3 mx-3">
                        <input type="submit" name="search" value="Искать" class="btn btn-primary">
                    </div>
                </div>


            </form>



    </aside>

    <!-- shop -->
    <section id="features" class="pb-5">
        <div class="text-center container mt-5 py-5">
            <h3>Каталог:</h3>
            <hr class="mx-auto">
            <p class="cards__subtitle">Ознакомьтесь с нашими рекомендуемыми продуктами</p>

            <div class="row mx-auto container-fluid ">

                <?php while ($row = $products->fetch_assoc()) { ?>

                    <div onclick="window.location.href=`single_product.php?product_id=<?php echo $row['product_id']; ?>`"
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
                                class="btn shop-buy-btn">Подробнее</a>
                        </div>
                    </div>

                <?php } ?>


                <!-- Пагинация -->
                <?php include ('layouts/pagination.php') ?>

            </div>
    </section>
</div>


<?php include ('layouts/footer.php') ?>

<script>

    const toggleShowCategories = async () => {

        const searchCategories = await document.getElementsByClassName('search-categories')[0]
        const categoriesLabel = await document.getElementsByClassName('categories-label')[0]
        const asideSearchBottom = await document.getElementsByClassName('aside-search-bottom')[0]
        const arrow = await document.getElementsByClassName('arrow')[0]


        toggleClass(searchCategories, 'display-none');
        toggleClass(asideSearchBottom, 'display-none');
        toggleClass(arrow, 'arrow-reversed');

        function toggleClass(el, cl) {
            el.classList.contains(cl) ? el.classList.remove(cl) : el.classList.add(cl)
        }
    }



    // Получаем элементы ползунка и отображения цены
    const range = document.querySelector('input[name="price"]');
    const priceDisplay = document.querySelector('.price-display');

    // Устанавливаем начальное значение цены
    priceDisplay.textContent = range.value;

    // Обновляем значение цены при изменении положения ползунка
    range.addEventListener('input', function () {
        // Вычисляем новое значение цены с градацией в 50 рублей
        let price = Math.round(range.value / 50) * 50;

        // Обновляем отображение цены
        priceDisplay.textContent = price;
    });


</script>