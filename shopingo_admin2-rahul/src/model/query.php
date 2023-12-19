<?php include '../../config/connection.php'; ?>

<?php

// FOR LOGIN
function loginQuery($col, $table, $condition_1, $condition_2)
{
    global $conn;
    $login_query = "SELECT $col FROM $table WHERE $condition_1 AND $condition_2";
    $execute = mysqli_query($conn, $login_query);
    $fetch = mysqli_fetch_assoc($execute);
    return $fetch;
}



// TO FETCH CATEGORY DETAILS
function categoryExists($table, $col, $category)
{
    global $conn;
    $category = mysqli_real_escape_string($conn, $category);
    $fetch_query = "SELECT COUNT(*) as count FROM $table WHERE $col = '$category'";
    $result = mysqli_query($conn, $fetch_query);
    $row = mysqli_fetch_assoc($result);
    return $row['count'] > 0;
}



// DELETE QUERY
function deleteQuery($table, $condition)
{
    global $conn;
    $delete_query = "DELETE FROM $table WHERE $condition";
    $execute_delete = mysqli_query($conn, $delete_query);
    return $execute_delete;
}


// FETCH DATA FOR MAIN PAGE CARD
function PRODUCTStats($col, $table, $condition)
{
    global $conn;
    $query = "SELECT $col FROM $table WHERE $condition";
    $execute = mysqli_query($conn, $query);
    if ($execute === false) {
        die("Database query error: " . mysqli_error($conn));
    }
    $count = mysqli_num_rows($execute);
    return $count;
}


//RESTORE DELETED PRODUCTS
function restoreProducts($table, $col_key, $col_value, $condition)
{
    global $conn;
    $query = "UPDATE $table SET $col_key = $col_value WHERE $condition";
    $execute = mysqli_query($conn, $query);
    return $execute;
}

?>