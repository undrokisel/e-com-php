

<?php include ('handlers/single_products.php') ?>
<?php include ('layouts/header.php') ?>


<!-- single-product -->
<section class="container single-product pt-5">
    <div class="row mt-5">

        <?php while ($row = $product->fetch_assoc()) { ?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img id="mainImg" src="assets/images/<?php echo $row['product_image'] ?>" alt=""
                    class="img-fluid w-100 mb-1" />
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image'] ?>" width:"100%" height="100%" alt=""
                            class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image2'] ?>" width:"100%" height="100%" alt=""
                            class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image3'] ?>" width:"100%" height="100%" alt=""
                            class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image4'] ?>" width:"100%" height="100%" alt=""
                            class="small-img">
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-12 col-12 mt-3">
                <h6><b>Категория:</b> <b>
                        <?php echo $row['product_category'] ?>
                    </b></h6>
                <h3 class="py-4">
                    <b>Модель: </b>
                    <?php echo $row['product_name'] ?>
                </h3>
                <h2>
                    <?php echo $row['product_price'] ?> руб.
                </h2>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>">

                    <div class="form-btn-row">
                        <input type="number" name="product_quantity" value="1" min="1" max="1" />
                        <button class="btn buy-btn" type="submit" name="add_to_cart">
                            Добавить в корзину
                        </button>
                    </div>
                </form>

                <h4 class="my-5">Информация о товаре:</h4>
                <span class="single-product__description">
                    <?php echo $row['product_description'] ?>
                </span>
            </div>


        <?php } ?>
    </div>
</section>

<!-- related products -->
<section id="related-products" class="my-5 pb-5">
    <div class="text-center container mt-5 py-5">
        <h3>Вместе с этим смотрят:</h3>
        <hr class="mx-auto">
        <div class="row mx-auto container-fluid ">

            <!-- product  -->

            <?php foreach ($productsRecomended as $key => $product) {
            
                ?>
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
                            <button class="btn buy-btn">Подробнее</button>
                        </a>

                    </div>
                </div>

            <?php } ?>



        </div>
</section>


<script src="assets/css/bootstrap-5.0.2/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

<script>
    const mainImg = document.getElementById("mainImg");
    const smallImgs = document.getElementsByClassName("small-img");
    console.log(smallImgs)
    Array.from(smallImgs).forEach(smallImg => smallImg.onclick = () => mainImg.src = smallImg.src)

</script>

<?php include ('layouts/footer.php') ?>