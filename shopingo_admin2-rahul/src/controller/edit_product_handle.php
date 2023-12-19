<?php
include '../model/edit_product.php';


$product_id = $_GET['product_id'];
$table_1 = "products_category";
$table_2 = "products_table";
$table_3 = "product_images";
$col = "*";
$condition_1 = "products_category.id = products_table.category_id";
$condition_2 = "products_table.id = product_images.product_id";
$condition_3 = "products_table.id = $product_id";
$condition_4 = "products_table.id";
$product_data = fetchEditProducts($table_1, $table_2, $table_3, $col, $condition_1, $condition_2, $condition_3);

?>