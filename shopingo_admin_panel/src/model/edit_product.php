<?php
include '../../config/connection.php';


// FETCH QUERY
// new branch
function fetchEditProducts($table_1, $table_2, $table_3, $col, $condition_1, $condition_2, $condition_3)
{
    global $conn;
    // $fetch_query = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 = $condition_2 WHERE $condition_3";
    $fetch_query = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 INNER JOIN $table_3 ON $condition_2 WHERE $condition_3";

    $execute = mysqli_query($conn, $fetch_query);
    if (!$execute) {
        die('Query failed: ' . mysqli_error($conn));
    } else {
        while ($row = mysqli_fetch_assoc($execute)) {
            return $row;
        }
    }
}



// UPDATE THE PRODUCT DETAILS
function updateProductData($table, $values, $condition)
{
    global $conn;
    $update_query = "UPDATE $table SET $values WHERE $condition";
    $execute = mysqli_query($conn , $update_query);
    return $execute;
}



function delMultipleimg($table , $condition){
    global $conn;
    $del_query = "DELETE FROM $table WHERE $condition";
    $execute = mysqli_query($conn , $del_query);
    return $execute;
}

?>