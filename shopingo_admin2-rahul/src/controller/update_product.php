<?php

include '../model/edit_product.php';
// UPDATE THE PRODUCT DETAILS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_product_btn'])) {
        $product_id = $_POST['product_id'];
        $product_name = trim(htmlentities($_POST['product_name'], ENT_QUOTES, 'UTF-8'));
        $product_price = trim(htmlentities($_POST['product_price'], ENT_QUOTES, 'UTF-8'));
        $product_description = trim(htmlentities($_POST['product_description'], ENT_QUOTES, 'UTF-8'));
        $product_stock = trim(htmlentities($_POST['product_stock'], ENT_QUOTES, 'UTF-8'));
        $product_category = trim(htmlentities($_POST['product_category'], ENT_QUOTES, 'UTF-8'));
        $product_featured = trim(htmlentities($_POST['is_featured'], ENT_QUOTES, 'UTF-8'));
        $product_brand = trim(htmlentities($_POST['product_brand'], ENT_QUOTES, 'UTF-8'));
        $product_size = $_POST['product_size'];
        $sizes = implode(', ', $product_size);

        // CHECK IF ALL FIELDS ARE FILLED
        if (!empty($product_name) && !empty($product_description) && !empty($product_stock) && !empty($product_size) && !empty($product_price)) {
            $table = "products_table";
            $values = "product_name = '$product_name', description= '$product_description', price= '$product_price', stock= '$product_stock', product_size ='$sizes', isFeatured= '$product_featured' , brand = '$product_brand'";
            $condition = "id = $product_id";
            $update_product = updateProductData($table, $values, $condition);
            if ($update_product) {
                $_SESSION['product_updated'] = "Product Updated Successfully";
                header("Location: ../view/home_page.php");
                exit;
            } else {
                $_SESSION['product_update_fail'] = "Error in Updation.. Try Again Later";
                header("Location: ../view/edit_products.php");
                exit;
            }
        } else {
            // $_SESSION['fill_all_fields'] = "Please fill all fields";
            // header("Location: ../view/edit_products.php");
            // exit;
            echo "<h3 class='text-center text-danger' >Please fill all fields</h3>";
        }

    }
}
?>