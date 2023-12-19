<?php

// INSERT QUERY
function insertProductQuery($table, $data)
{
    global $conn;
    $insert_query = "INSERT INTO $table (`product_name`, `description`, `price`, `stock`, `category_id`, `featured_product_image`, `product_size` , `brand`) VALUES (?, ?, ?, ?, ?, ?, ? , ?)";
    $stmt = mysqli_prepare($conn, $insert_query);
    if (!$stmt) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
    $sizes = implode(', ', $data['product_sizes']);
    mysqli_stmt_bind_param(
        $stmt,
        "ssdiisss",
        $data['product_name'],
        $data['product_desc'],
        $data['product_price'],
        $data['product_stock'],
        $data['product_category'],
        $data['featured_product_image'],
        $sizes,
        $data['product_brand']
    );
    $execute = mysqli_stmt_execute($stmt);

    if (!$execute) {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
    return $execute;
}








function insertImage($table_image, $col_key, $col_value)
{
    global $conn;
    $insert_query = "INSERT INTO $table_image ($col_key) values ($col_value)";
    $execute_query = mysqli_query($conn, $insert_query);
    return $execute_query;
}


// FETCH DATA FROM A TABLE
function fetchData($table, $col)
{
    global $conn;
    $fetch_query = "SELECT $col FROM $table";
    $execute = mysqli_query($conn, $fetch_query);
    $rows = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $rows[] = $row;
    }
    return $rows;
}
?>