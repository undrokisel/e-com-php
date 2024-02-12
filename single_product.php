<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result(); //[]
} else {
    header('location:index.php');
}
?>

<?php include('layouts/header.php') ?>


<!-- single-product -->
<section class="container single-product my-5 pt-5">
    <div class="row mt-5">

        <?php while ($row = $product->fetch_assoc()) { ?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img id="mainImg" src="assets/images/<?php echo $row['product_image'] ?>" alt=""
                    class="img-fluid w-100 pb-1" />
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image'] ?>" width:"100%" alt="" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image2'] ?>" width:"100%" alt=""
                            class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image3'] ?>" width:"100%" alt=""
                            class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="/assets/images/<?php echo $row['product_image4'] ?>" width:"100%" alt=""
                            class="small-img">
                    </div>
                </div>
            </div>



            <div class="col-lg-6 col-md-12 col-12">
                <h6>Эпль вижн китайский</h6>
                <h3 class="py-4">
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
                    <input type="number" name="product_quantity" value="1" />
                    <button class="btn buy-btn" type="submit" name="add_to_cart">
                        Добавить в корзину
                    </button>
                </form>

                <h4 class="my-5">Подробнее</h4>
                <span>
                    <?php echo $row['product_description'] ?>
                </span>
            </div>


        <?php } ?>
    </div>
</section>

<!-- related products -->
<section id="related-products" class="my-5 pb-5">
    <div class="text-center container mt-5 py-5">
        <h3>Вместе с этим покупают:</h3>
        <hr class="mx-auto">
        <div class="row mx-auto container-fluid ">

            <!-- product 1 -->
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


            <!-- product 2 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">

                <img class="img-fluid mb-3" src="assets/images/featured2.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Шузы маломерки</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- product 3 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">

                <img class="img-fluid mb-3" src="assets/images/featured3.jpeg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Подкрадули рус</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>

            <!-- product 4 -->
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">

                <img class="img-fluid mb-3" src="assets/images/featured4.jpg" />
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="p-name">Спортикс шуз</h5>
                    <h4 class="p-price">199,8 руб</h4>
                    <button class="btn buy-btn">Давай-покупай</button>
                </div>
            </div>
        </div>
</section>




<!--  Bootstrap в связке с Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

<script>
    const mainImg = document.getElementById("mainImg");
    const smallImgs = document.getElementsByClassName("small-img");
    console.log(smallImgs)
    Array.from(smallImgs).forEach(smallImg => smallImg.onclick = () => mainImg.src = smallImg.src)

</script>

<?php include('layouts/footer.php') ?>
