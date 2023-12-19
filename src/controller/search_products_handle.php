<?php
include '../../config/connection.php';

function searchProducts($query)
{
    global $conn;
    $searchQuery = isset($_GET['search_data']) ? $_GET['search_data'] : '';
    // $searchQuery = mysqli_real_escape_string($conn, $query);
    $sql = "SELECT * FROM `products_table` WHERE product_name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);
    $results = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $results[] = $row;
    }
    return $results;
}


// foreach ($search_result as $search) {
//     $product_name = $search['product_name'];
//     var_dump($product_name);
// }
?>


