<?php
include '../model/order_details_fetch.php';

$user_id = $_SESSION['user_id'];



// FETCH ORDERS
// $table = 'orders_table';
// $col = "*";
// $condition = "id IS NOT NULL";
// $fetch_orders = fetchOrders($col, $table, $condition);




$table_1 = "orders_table";
$table_2 = "order_details";
$col = "*";
$condition_1 = "orders_table.id  = order_details.order_id";
$condition_2 = "orders_table.user_id = $user_id";
$fetch_orders = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);


// // Check if 'user_id' is set in $GLOBALS array
// if (isset($GLOBALS['user_id']) && isset($GLOBALS['order_id'])) {
//     $user_id = $GLOBALS['user_id'];
//     $order_id = $GLOBALS['order_id'];

//     // FETCH USER DETAILS WITH JOINS
//     $table_1 = "orders_table";
//     $table_2 = "users_table";
//     $col = "*";
//     $condition_1 = "orders_table.user_id = users_table.id";
//     $condition_2 = "orders_table.user_id = $user_id AND orders_table.id = $order_id ";
//     $fetch_orders_user = fetchUserWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);


//     // FETCH USER ADDRESS
//     $table_1 = "orders_table";
//     $table_2 = "user_address";
//     $col = "*";
//     $condition_1 = "orders_table.address_id  = user_address.id";
//     $condition_2 = "orders_table.user_id = $user_id AND orders_table.id = $order_id ";
//     $fetch_user_address = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);

//     // FETCH PRODUCT ID 
//     $table_1 = "orders_table";
//     $table_2 = "products_cart";
//     $col = "*";
//     $condition_1 = "orders_table.user_id  = products_cart.user_id";
//     $condition_2 = "orders_table.user_id = $user_id";
//     $fetch_product_id = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);

//     // Check if 'product_id' is set in $fetch_product_id array
//     if (isset($fetch_product_id[0]['product_id'])) {
//         $ordered_product_id = $fetch_product_id[0]['product_id'];

//         // FETCH PRODUCT DETAILS
//         $table_1 = "order_details";
//         $table_2 = "orders_table";
//         $col = "*";
//         $condition_1 = "order_details.order_id = orders_table.id";
//         $condition_2 = "orders_table.user_id = $user_id";
//         $fetch_product_details = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);
//     }
// }



?>