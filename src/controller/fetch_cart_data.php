<?php
include '../../config/connection.php';

$user_id = $_SESSION['user_id'];

// FETCH CART DATA
$fetch_cart_query = "SELECT  products_table.* FROM `products_table` INNER JOIN `products_cart` ON products_table.id = products_cart.product_id 
 INNER JOIN `users_table` ON users_table.id = products_cart.user_id  WHERE users_table.id = $user_id AND products_cart.delete_status = 0";
$execute = mysqli_query($conn, $fetch_cart_query);
$count = mysqli_num_rows($execute);
while ($row = mysqli_fetch_assoc($execute)) {
  $data_container[] = $row;
}




// FETCH PRODUCT TOTAL PRICE AND COUNT
$fetch_data = "SELECT SUM(product_price * quantity) AS total_price, SUM(quantity) AS total_products FROM `products_cart` WHERE user_id = $user_id";
$execute = mysqli_query($conn, $fetch_data);
if (!$execute) {
  die("Query failed: " . mysqli_error($conn));
}
// Fetch the result
$result = mysqli_fetch_assoc($execute);
$total_price = $result['total_price'];
$total_products = $result['total_products'];





//  FETCH CART ITEMS DETAILS
// $query_cart = "SELECT * FROM `products_cart` WHERE product_id = $product_id ";
// $execute_query_cart = mysqli_query($conn, $query_cart);
// if (mysqli_num_rows($execute_query_cart)) {
//   while ($row = mysqli_fetch_assoc($execute_query_cart)) {
//     $data_container_cart[] = $row;
//   }
// }

?>