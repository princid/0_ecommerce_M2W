<?php
// CONTROLLER FILE
include '../model/index_page_manage.php';

$col = "*";
$table = "products_table";
$condition = "isFeatured = 1 AND isDeleted = 0";
$data_container = fetchFeaturedProducts($col, $table, $condition);
?>