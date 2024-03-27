<?php if ($page === 1 && $total_num_of_pages == 1) {
    echo "<h6 class='text-violet2'>Все товары, соответствующие критериям поиска, отображены на этой странице</h6>";
} else { ?>


    <nav aria-label="pagination">
        <ul class="pagination mt-5">

            <!-- предыдущая страница -->
            <li class="page-item <?php if ($page <= 1) {
                echo 'disabled';
            } ?>">
                <a href="<?php if ($page <= 1) {
                    echo '#';
                } else {
                    echo "?page=" . ($page - 1) . "&category=$category&price=$price";
                } ?>" class="page-link">
                    Предыдущая
                </a>
            </li>

            <!-- <li class="page-item"><a href="?page=1" class="page-link">1</a></li> -->
            <li class="page-item"><a href="?page=1&category=<?php echo $category ?>&price=<?php echo $price ?>"
                    class="page-link">1</a></li>
            <li class="page-item"><a href="?page=2&category=<?php echo $category ?>&price=<?php echo $price ?>"
                    class="page-link">2</a></li>

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
                    echo "?page=" . ($page + 1) . "&category=$category&price=$price";
                } ?>" class="page-link">
                    Следующая
                </a>
            </li>
        </ul>
    </nav>


<?php } ?>