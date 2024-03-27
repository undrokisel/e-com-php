<?php
// если нажали на кнопку поиск 
if (isset ($_POST['search']) || isset ($_GET['category'])) {


    // определяем категорию
    $category = $_POST['category'] ?? ($_GET['category']);

    // определяем цену
    if (isset ($_POST['price'])) {
        $price = round($_POST['price'] / 50) * 50;
    } else if (isset ($_GET['price'])) {
        $price = $_GET['price'];
    } else {
        $price = 10000;
    }

    // определяем номер страницы из урла, если он не установлен - дефолт 1
    if (isset ($_GET['page']) && $_GET['page'] != "") {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    // возвращаем КОЛИЧЕСТВО товаров по категориям для целей пагинации
    $stmt_pages_with_search = $conn->prepare("SELECT COUNT(*) as total_records from products WHERE product_category=? AND product_price<=?");
    $stmt_pages_with_search->bind_param("ss", $category, $price);
    $stmt_pages_with_search->execute();
    $stmt_pages_with_search->bind_result($total_records);
    $stmt_pages_with_search->store_result();
    $stmt_pages_with_search->fetch();



    // количество товаров на странице
    $total_records_per_page = 4;
    // сдвиг для запроса в базу под каждую страницу
    $offset = ($page - 1) * $total_records_per_page;
    $prev_page = $page - 1;
    $next_page = $page + 1;

    //количество страниц 
    $total_num_of_pages = ceil($total_records / $total_records_per_page);



    // Если категория не выбрана, а только цена 
    if ($category == null) {
        $total_records_per_page = 20;
        $total_num_of_pages = 1;
        
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_price<=? LIMIT $offset, $total_records_per_page");
        $stmt->bind_param("i", $price);
    }
    // если выбрана и категория и цена
    else {
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=? LIMIT $offset, $total_records_per_page");
        $stmt->bind_param("ss", $category, $price);
    }
    $stmt->execute();
    $products = $stmt->get_result();





    // если поиск не использован, то возрващаем все продукты 
} else {

    // определяем номер страницы из урла, если он не установлен - дефолт 1
    if (isset ($_GET['page']) && $_GET['page'] != "") {
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
    $total_records_per_page = 20;
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