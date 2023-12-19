<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
// CONNECTION FILE
include '../../config/connection.php';

// INSERT QUERY 
function insertQuery($table, $keys, $values, $uniqueColumn, $condition_1, $condition_2, $additionalColumns = [])
{
    global $conn;
    $check_query = "SELECT selected_image FROM $table WHERE $condition_1 AND $condition_2 AND selected_image = '$uniqueColumn'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        return false;
    } else {
        foreach ($additionalColumns as $column => $columnValue) {
            $keys .= ", $column";
            $values .= ", '$columnValue'";
        }

        $insert_query = "INSERT INTO $table ($keys) VALUES ($values)";
        $execute = mysqli_query($conn, $insert_query);
        return $execute;
    }
}

// INSERT QUERY 
function insertQueryWishlist($table, $keys, $values, $uniqueColumn, $condition_1, $condition_2, $additionalColumns = [])
{
    global $conn;
    $check_query = "SELECT product_id FROM $table WHERE $condition_1 AND $condition_2 AND product_id = '$uniqueColumn'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        return false;
    } else {
        foreach ($additionalColumns as $column => $columnValue) {
            $keys .= ", $column";
            $values .= ", '$columnValue'";
        }

        $insert_query = "INSERT INTO $table ($keys) VALUES ($values)";
        $execute = mysqli_query($conn, $insert_query);
        return $execute;
    }
}

// REMOVE CART ITEM
// function removeCartItem($table, $col_key, $col_value, $condition)
// {
//     global $conn;
//     $remove_query = "UPDATE $table SET $col_key = $col_value WHERE $condition";
//     $execute = mysqli_query($conn, $remove_query);
//     return $execute;
// }


// TO REMOVE CART ITEM 
function removeCartItem($table, $condition)
{
    global $conn;
    $remove_query = "DELETE FROM $table WHERE $condition";
    $execute = mysqli_query($conn, $remove_query);
    return $execute;
}



// UPDATE SIZE AND QUANTITY OF PRODUCT
function updateSizeAndQuantity($table, $set_val, $condition_1)
{
    global $conn;
    $edit_query = "UPDATE $table SET $set_val WHERE $condition_1";
    var_dump($edit_query);
    $execute = mysqli_query($conn, $edit_query);
    return $execute;
}


// FETCH QUERY
// function fetchCartProducts($col, $table_1, $table_2, $table_3, $condition_1, $condition_2)
// {
//     global $conn;
//     $fetch_cart = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 INNER JOIN $table_3 ON $condition_2";
//     $execute = mysqli_query($conn, $fetch_cart);
//     while ($row = mysqli_fetch_assoc($execute)) {
//         $data_container[] = $row;
//     }
//     return $data_container;
// }
