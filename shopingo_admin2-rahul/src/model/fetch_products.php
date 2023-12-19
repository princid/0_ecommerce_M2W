<?php

include '../../config/connection.php';


// FETCH PRODUCTS
function fetchProducts($col, $table_1, $table_2, $condition_1, $condition_2 , $condition_3)
{
    global $conn;
    $fetch_products = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 = $condition_2 WHERE $condition_3";
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


// FETCH QUERY
function fetchQuery($table, $col)
{
    global $conn;
    $fetch_query = "SELECT $col FROM $table";
    $execute = mysqli_query($conn, $fetch_query);
    if (!$execute) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $rows = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $rows[] = $row;
    }
    return $rows;
}


// SOFT DELETE PRODUCT
function deleteProduct($table, $col_names, $col_values, $condition)
{
    global $conn;

    $set_clause = '';
    for ($i = 0; $i < count($col_names); $i++) {
        $set_clause .= $col_names[$i] . ' = ' . $col_values[$i];
        if ($i < count($col_names) - 1) {
            $set_clause .= ', ';
        }
    }

    $update_query = "UPDATE $table SET $set_clause WHERE $condition";
    $execute_update = mysqli_query($conn, $update_query);

    return $execute_update;
}



