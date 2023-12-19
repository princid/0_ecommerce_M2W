<?php
// DB CONNECTION
include '../../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id_value'];
    $currentDateTime = date('Y-m-d H:i:s');
    $query = "UPDATE `products_table` SET `isDeleted` = 0 , `restored_at`='$currentDateTime' WHERE id= $product_id ";
    $execute = mysqli_query($conn, $query);
    if ($execute) {
        $_SESSION['restore_product'] = "Product Restored";
        header("Location: ../view/deleted_products.php");
    }
}
?>