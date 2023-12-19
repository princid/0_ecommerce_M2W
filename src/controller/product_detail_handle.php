<?php
include '../model/product_details.php';
include '../model/category_handle.php';


// FETCH DATA FROM 2 TABLES
$col = "*";
$product_id = $_GET['product_id'];
$table_1 = "products_table";

// $condition_1 = "products_table.id";
// $condition_2 = "product_images.product_id";
$condition_5 = "products_table.isDeleted = 0";
$condition_4 = "id = $product_id";
$product_details = fetchProducts($col, $table_1, $condition_4, $condition_5);


// PRODUCT SUB IMAGES
$table = "product_images";
$condition = "product_id = $product_id";
$product_images = fetchProductSubImages($col, $table, $condition );



// $condition_5 = "products_table.isDeleted = 0";
// $condition_4 = "id = $product_id";
// $similar_product_details = fetchProducts($col, $table_1, $condition_4, $condition_5);
?>