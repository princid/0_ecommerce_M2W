<?php
session_start();
include_once '../model/query.php';
include_once '../model/category_insert.php';



// CATEGORY LISTING
$table = "products_category";
$col = "*";
$rows = fetchQuery($table, $col);
foreach ($rows as $row) {
    $Category_id = $row['id'];
    $Category_name = $row['category_name'];
}


// CATEGORY INSERTION
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST["category"];
    $status = 1;
    $col = "category_name, status";
    $category = [
        'category_name' => $category_name,
        'status' => $status
    ];
    if (empty($category_name)) {
        echo "Please enter a category";
    } else {
        if (insertQuery($table, $col, $category)) {
            echo "Success";
        } else {
            echo "Category insertion failed: " . mysqli_error($conn);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // CATEGORY UPDATION
      if (isset($_POST["update_category"])) {
        $table = "products_category";
        $status = $_POST['status'];
        $currentDateTime = date('Y-m-d H:i:s');
        $category_id = $_POST['category_id_fetch'];
        $col_key = array('status', 'updated_at');
        $col_value = array($status, $currentDateTime);
        $update_status = updateQuery($table, $col_key, $col_value, $category_id);
        if ($update_status) {
            $_SESSION['status_update'] = "Status Updated Successfully";
            header("Location: ../view/insert_category.php");
        } else {
            echo 'Failed: ' . mysqli_error($conn);
        }
    }


    // CATEGORY DELETION
    if (isset($_POST["delete_category"])) {
        $table = "products_category";
        $category_id = $_POST['category_id_fetch'];
        $condition = "id = $category_id";
        $delete = deleteQuery($table, $condition);
        if ($delete) {
            $_SESSION["delete_category"] = "Category Deleted Successfully";
            header("Location: ../view/insert_category.php");
        } else {
            echo "deletion failed";
        }
    }

}



// DELETE PRODUCTS (Insert value 1 on deleted products)
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['products_category'])) {
//         $category_id = mysqli_real_escape_string($conn, $_POST['category_id_fetch']);
//         $table = "products_category";
//         $currentDateTime = date('Y-m-d H:i:s');
//         $col_value = "1, $currentDateTime";
//         $condition = "id = $product_id";
//         $col_names = ["isDeletedCat", "deleted_at"];
//         $col_values = ['1', "'$currentDateTime'"];
//         $delete_product = deleteCat($table, $col_names, $col_values, $condition);

//         if ($delete_product) {
//             $_SESSION['deleted_product'] = "Product Deleted Successfully";
//             header("Location: ../view/product_list.php");
//         } else {
//             echo "Error deleting product: " . mysqli_error($conn);
//         }
//     }
// }

?>