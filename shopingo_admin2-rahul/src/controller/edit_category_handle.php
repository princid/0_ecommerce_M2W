<?php

include '../model/category_insert.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $cat_name = $_POST['category_update'];
    $currentDateTime = date('Y-m-d H:i:s');
    // var_dump($_POST);
    // exit;
    $table = "products_category";
    $col_key = "category_name";
    $col_value = $cat_name;
    $condition = "id = $category_id";
    $cat_update = updateCategory($table, $col_key, $col_value, $condition);

    if ($cat_update) {
        $_SESSION['category_updated'] = "Category Updated Successfully";
        header("Location: ../view/insert_category.php");
        exit;
    } else {
        $_SESSION['category_update_failed'] = "Some Error Occured in Category Updation";
        header("Location: ../view/insert_category.php");
        exit;
    }

}