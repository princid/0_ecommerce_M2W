<?php
// CONTROLLER FILE
include '../model/category_handle.php';

// CATEGORY FETCH
$table = "products_category";
$col = "*";
$cat_rows = fetchCategory($table, $col);
?>