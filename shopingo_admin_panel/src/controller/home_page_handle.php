<?php
include '../../config/connection.php';


// SHOW CARDS DATA OF HOMEPAGE
$col = "*";

// SHOW NUMBER OF PRODUCTS
$table = "products_table";
$condition = "id IS NOT NULL";
$count_products = productStats($col, $table, $condition);

//  SHOW NUMBER OF CATEGORIES
$table = "products_category";
$condition = "id IS NOT NULL";
$count_category = productStats($col, $table, $condition);

//  SHOW NUMBER OF ACTIVE USERS
$table = "users_table";
$condition = "id IS NOT NULL";
$count_users = productStats($col, $table, $condition);

//  SHOW NUMBER OF ACTIVE USERS
$table = "orders_table";
$condition = "id IS NOT NULL";
$count_orders = productStats($col, $table, $condition);


// SHOW PENDING ORDERS
$table = "orders_table";
$condition = "status = 'n' OR status = 's'";
$pending_orders = PRODUCTStats($col, $table, $condition) ;

// SHOW COMPLETED ORDERS
$table = "orders_table";
$condition = "status = 'y'";
$completed_orders = PRODUCTStats($col, $table, $condition) ;


// // SHOW ACTIVE ADMINS
// $condition = "active_status =  AND Role = 0";
// $count_active_admins = productStats($col, $table, $condition);
?>