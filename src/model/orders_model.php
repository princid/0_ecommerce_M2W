<?php
include '../../config/connection.php';


// FETCH ORDER DETAILS WITH JOINS
function fetchOrderDetails($table_1, $table_2, $condition_1, $condition_2)
{
    global $conn;
    $query = "SELECT * FROM $table_1 INNER JOIN $table_2 ON $condition_1 WHERE $condition_2";
    $execute = mysqli_query($conn, $query);
    $data_container = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $data_container[] = $row;
    }
    return $data_container;
}


// FETCH ORDER DETAILS 
function fetchOrderDetailsSimple($table_1, $condition)
{
    global $conn;
    $query = "SELECT * FROM $table_1 WHERE $condition";
    $execute = mysqli_query($conn, $query);
    $data_container_2 = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $data_container_2[] = $row;
    }
    return $data_container_2;
}


// ORDERS TABLE DATA INSERTION 
function insertOrders($table, $keys, $values)
{
    global $conn;
    $insert_orders_query = "INSERT INTO $table ($keys) VALUES ($values)";
    $execute_insert_orders = mysqli_query($conn, $insert_orders_query);
    return $execute_insert_orders;
}


// ORDERS TABLE DATA INSERTION 
function insertOrdersProductDetails($table, $keys, $values)
{
    global $conn;
    $insert_orders_query = "INSERT INTO $table ($keys) VALUES ($values)";
    $execute_insert_orders = mysqli_query($conn, $insert_orders_query);
    return $execute_insert_orders;
}

// FUNCTION TO UPDATE THE STOCK
function updateStockCount($productId, $orderedQuantity)
{
    global $conn;
    $sql_update_stock = "UPDATE products_table SET stock = stock - $orderedQuantity WHERE id = $productId";
    $execute_update_stock = mysqli_query($conn, $sql_update_stock);
    return $execute_update_stock;
}

?>