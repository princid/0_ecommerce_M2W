<?php
// CONNECTION FILE
include '../../config/connection.php';

// PRODUCT DETAILS
function fetchProducts($col, $table_1, $condition_4, $condition_5)
{
    global $conn;
    $fetch_products = "SELECT $col FROM $table_1 WHERE $condition_4 AND $condition_5";
    $execute_fetch = mysqli_query($conn, $fetch_products);
    if (!$execute_fetch) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $rows = array();
    while ($row = mysqli_fetch_assoc($execute_fetch)) {
        $rows[] = $row;
    }
    return $rows;
}


// PRODUCT SUB IMAGES
function fetchProductSubImages($col, $table, $condition){
    global $conn;
    $fetch_products = "SELECT $col FROM $table WHERE $condition";
    $execute_fetch = mysqli_query($conn, $fetch_products);
    if (!$execute_fetch) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $img_rows = array();
    while ($row = mysqli_fetch_assoc($execute_fetch)) {
        $img_rows[] = $row;
    }
    return $img_rows;
}
?>