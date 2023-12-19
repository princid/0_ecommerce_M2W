<?php
require_once '../model/insert_products.php';
require_once '../model/query.php';
session_start();

// FETCH CATEGORIES DATA FROM DATABASE
$table = "products_category";
$col = "*";
$rows = fetchData($table, $col);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // INSERTION OF DATA
    $productName = trim($_POST['product_name']);
    if (empty($productName)) {
        echo "Product Name is required.";
        $errorFlag = true;
    }
    $productDescription = trim($_POST['product_desc']);
    if (empty($productDescription)) {
        echo "Product Description is required.";
        $errorFlag = true;
    }
    $productCategory = intval($_POST['product_category']);
    if ($productCategory <= 0) {
        echo "Please select a valid Product Category.";
        $errorFlag = true;
    }
    $productPrice = floatval($_POST['product_price']);
    if ($productPrice <= 0) {
        echo "Product Price must be a valid positive number.";
        $errorFlag = true;
    }
    $productStock = intval($_POST['product_stock']);
    if ($productStock <= 0) {
        echo "Product Stock must be a valid positive integer.";
        $errorFlag = true;
    }

    $productSizes = $_POST['product_size'];
    $data['product_sizes'] = $productSizes;

    $productbrand = $_POST['product_brand'];
    $data['product_brand'] = $productbrand;


    // var_dump($_POST);
    // exit;
    if (!isset($errorFlag)) {
        $uploadDir = "../../assets/images/product_featured_images/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $real_img_name = $_FILES['featured_product_image']['name'];
        $extension = pathinfo($real_img_name, PATHINFO_EXTENSION);
        $new_img_name = uniqid() . '_' . mt_rand(1000, 9999) . '.' . $extension;

        $uploadedFile = $uploadDir . $new_img_name;

        if (move_uploaded_file($_FILES['featured_product_image']['tmp_name'], $uploadedFile)) {
            $data['product_name'] = $productName;
            $data['product_desc'] = $productDescription;
            $data['product_price'] = $productPrice;
            $data['product_brand'] = $productbrand;
            $data['product_stock'] = $productStock;
            $data['product_category'] = $productCategory;
            $data['featured_product_image'] = $new_img_name;

            // FUNCTION CALL TO INSERT PRODUCT DETAILS
            $table = "products_table";
            $insert_product = insertProductQuery($table, $data);

            if ($insert_product) {
                // GET PRODUCT ID 
                $ProductId = mysqli_insert_id($conn);

                // INSERTION OF IMAGES
                if (!empty($_FILES['product_image']['name'][0])) {
                    if (!file_exists('../../assets/images/product_image/')) {
                        mkdir('../../assets/images/product_image/', 0755, true);
                    }

                    foreach ($_FILES['product_image']['tmp_name'] as $key => $tmp_name) {
                        $product_img_name = $_FILES['product_image']['name'][$key];
                        $product_img_tmp = $_FILES['product_image']['tmp_name'][$key];
                        // IMAGE NAME 
                        $timestamp = time();
                        $file_extension = pathinfo($product_img_name, PATHINFO_EXTENSION);
                        $product_img = $timestamp . '_' . $key . '.' . $file_extension;

                        // FOLDER PATH
                        $destination = '../../assets/images/product_image/' . $product_img;
                        if (move_uploaded_file($product_img_tmp, $destination)) {
                            $table_image = "product_images";
                            $col_key = "product_image, product_id";
                            $col_value = "'$product_img', '$ProductId'";
                            $insert_image = insertImage($table_image, $col_key, $col_value);

                            if (!$insert_image) {
                                echo "Error in image insertion.";
                                $_SESSION['Product_insert_error'] = "Product insertion failed.";
                                header("Location: ../view/insert_products.php");
                                exit;
                            }
                        } else {
                            echo "Error moving uploaded file.";
                            $_SESSION['Product_insert_error'] = "Product insertion failed.";
                            header("Location: ../view/insert_products.php");
                            exit;
                        }
                    }
                }
                if ($insert_image) {
                    $_SESSION['Product_inserted'] = "Product inserted Successfully";
                    header("Location: ../view/insert_products.php");
                } else {
                    $_SESSION['Product_insert_error'] = "Image insertion failed.";
                    header("Location: ../view/insert_products.php");
                    exit;
                }
            } else {
                $_SESSION['Product_insert_error'] = "Product insertion failed.";
                header("Location: ../view/insert_products.php");
                exit;
            }
        }
    }
}
?>