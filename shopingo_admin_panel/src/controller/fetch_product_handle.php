<?php
include_once '../model/fetch_products.php';
include_once '../model/query.php';


// FETCH DATA FROM 2 TABLES
$table_1 = "products_category";
$table_2 = "products_table";
$col = "*";
$condition_1 = "products_category.id";
$condition_2 = "products_table.category_id";
$condition_3 = "products_table.isDeleted = 0";
$rows = fetchProducts($col, $table_1, $table_2, $condition_1, $condition_2, $condition_3);



// DELETE PRODUCTS (Insert value 1 on deleted products)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_products'])) {
        $product_id = mysqli_real_escape_string($conn, $_POST['product_fetch_id']);
        $table = "products_table";
        $currentDateTime = date('Y-m-d H:i:s');
        $col_name = "isDeleted, deleted_at";
        $col_value = "1, $currentDateTime";
        $condition = "id = $product_id";
        $col_names = ["isDeleted", "deleted_at"];
        $col_values = ['1', "'$currentDateTime'"];
        $delete_product = deleteProduct($table, $col_names, $col_values, $condition);

        if ($delete_product) {
            $_SESSION['deleted_product'] = "Product Deleted Successfully";
            header("Location: ../view/home_page.php");
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    }
}

?>