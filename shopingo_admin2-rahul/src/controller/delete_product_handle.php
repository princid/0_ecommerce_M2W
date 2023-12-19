<?php

include '../../config/connection.php';

include '../model/fetch_products.php';

// FETCH DATA FROM 2 TABLES WITH DELETED VALUE (1)
$table_1 = "products_category";
$table_2 = "products_table";
$col = "*";
$condition_1 = "products_category.id";
$condition_2 = "products_table.category_id";
$condition_3 = "products_table.isDeleted = 1";
$rows = fetchProducts($col, $table_1, $table_2, $condition_1, $condition_2, $condition_3);

?>