<?php
// Database Connection
include '../../config/connection.php';

// INSERT QUERY
function addAddress($table, $col_keys, $col_values)
{
    global $conn;
    $col_values = implode(', ', array_map(function ($value) use ($conn) {
        return is_numeric($value) ? $value : "'" . mysqli_real_escape_string($conn, $value) . "'";
    }, explode(', ', $col_values)));
    $insert_query = "INSERT INTO $table ($col_keys) VALUES ($col_values)";
    $execute = mysqli_query($conn, $insert_query);
    return $execute;
}


// FETCH ADDRESS
function fetchAddress($user_id ,$condition_2)
{
    global $conn;
    $data_container = array();
    $fetch_query = "SELECT * FROM `user_address` WHERE user_id = ? AND $condition_2";
    $stmt = mysqli_prepare($conn, $fetch_query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $execute = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($execute)) {
        $data_container[] = $row;
    }
    return $data_container;
}



// EDIT ADDRESS
function editAddress($table, $set_val, $condition_1, $condition_2)
{
    global $conn;
    $edit_query = "UPDATE $table SET $set_val WHERE $condition_1 AND $condition_2";
    $execute = mysqli_query($conn, $edit_query);
    return $execute;
}

// EDIT ADDRESS
function editAddressZero($table, $set_val_2, $condition_1, $condition_3)
{
    global $conn;
    $edit_query = "UPDATE $table SET $set_val_2 WHERE $condition_1 AND $condition_3";
    $execute = mysqli_query($conn, $edit_query);
    return $execute;
}


// EDIT ADDRESS
function delAddress($table, $set_val, $condition)
{
    global $conn;
    $del_query = "UPDATE $table SET $set_val WHERE $condition";
    $execute = mysqli_query($conn, $del_query);
    return $execute;
}

?>