<?php

// Connection file
include '../../config/connection.php';


// FETCH DETAILS REGARDING ORDERS
function fetchOrders($col, $table, $condition) {
    global $conn;
    $fetch_orders = "SELECT $col FROM $table WHERE $condition ";
    $execute_fetch = mysqli_query($conn, $fetch_orders);
    if(!$execute_fetch) {
        die('Query failed: '.mysqli_error($conn));
    }
    $fetch_orders = array();
    while($row = mysqli_fetch_assoc($execute_fetch)) {
        $fetch_orders[] = $row;
    }
    return $fetch_orders;
}


// FETCH DETAILS REGARDING ORDERS WITH JOINS
function fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2) {
    global $conn;
    $fetch_orders = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 WHERE $condition_2";
    $execute_fetch = mysqli_query($conn, $fetch_orders);
    if(!$execute_fetch) {
        die('Query failed: '.mysqli_error($conn));
    }
    $fetch_orders_details = array();
    while($row = mysqli_fetch_assoc($execute_fetch)) {
        $fetch_orders_details[] = $row;
    }

    return $fetch_orders_details;
}


// FETCH USER DETAILS REGARDING ORDERS WITH JOINS WITH LIMIT
function fetchUserWithJoins($col, $table_1, $table_2, $condition_1, $condition_2) {
    global $conn;

    $fetch_orders = "SELECT $col FROM $table_1 INNER JOIN $table_2 ON $condition_1 WHERE $condition_2 ";
    $execute_fetch = mysqli_query($conn, $fetch_orders);

    if (!$execute_fetch) {
        die('Query failed: ' . mysqli_error($conn));
    }

    $fetch_orders_details = array();
    while ($row = mysqli_fetch_assoc($execute_fetch)) {
        $fetch_orders_details[] = $row;
    }

    return $fetch_orders_details;
}


?>