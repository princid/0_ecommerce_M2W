<!-- UPDATE -->

<?php
// CONNECTION FILE
include '../../config/connection.php';


$product_img_name = $_FILES['product_featured_image']['name'];
$product_img_tmp = $_FILES['product_featured_image']['tmp_name'];

$product_id = $_POST['product_id'];

// Store the current datetime
$currentDateTime = date('Y-m-d H:i:s');

// Check if a new image is uploaded
if (!empty($_FILES['product_featured_image']['name'])) {
    // Retrieve the old image name from the database
    $query = "SELECT `featured_product_image` FROM `products_table` WHERE `id`='$product_id'";
    $result = mysqli_query($conn, $query);
    $target = mysqli_fetch_assoc($result);
    $old_product_img = $target['product_featured_image'];
    // Delete the old image from the folder
    if (!empty($old_product_img)) {
        $old_image_path = '../../assets/images/product_featured_images' . $old_product_img;
        if (file_exists($old_image_path)) {
            unlink($old_image_path); // Delete the old image
        }
    }
    // Image Name with timestamp and extension
    $file_extension = pathinfo($product_img_name, PATHINFO_EXTENSION);
    $timestamp = time();
    $random_number = rand(1000, 50000);
    $product_img = $timestamp . '-' . $random_number . '.' . $file_extension;
    $folder = '../../assets/images/product_featured_images/' . $product_img;
    // saving file in folder
    if (move_uploaded_file($product_img_tmp, $folder)) {
    }
} else {
    $query = "SELECT `featured_product_image` FROM `products_table` WHERE `id`='$product_id'";
    $result = mysqli_query($conn, $query);
    $target = mysqli_fetch_assoc($result);
    $profiproduct_imgle_img = $target['image'];
}

// Update SQL 
$update_sql = "UPDATE `products_table` SET  `featured_product_image`='$product_img' WHERE `id`='$product_id'";
$execute = mysqli_query($conn, $update_sql);

if ($update_sql) {
    header("Location: ../view/home_page.php");
    exit;
} else {
    echo "error";
}
?>