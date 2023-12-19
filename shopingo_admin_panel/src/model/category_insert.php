<?php

include '../../config/connection.php';


// INSERT QUERY
function insertQuery($table, $col, $category)
{
    global $conn;
    $insert_query = "INSERT INTO $table ($col) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $insert_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'si', $category['category_name'], $category['status']);
        $category['category_name'] = mysqli_real_escape_string($conn, $category['category_name']);
        $category['status'] = intval($category['status']);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            echo "Error: " . mysqli_error($conn);
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    return false;
}




// FETCH QUERY
function fetchQuery($table, $col)
{
    global $conn;
    $fetch_query = "SELECT $col FROM $table";
    $execute = mysqli_query($conn, $fetch_query);
    if (!$execute) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $rows = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $rows[] = $row;
    }
    return $rows;
}


// DELETE QUERY
function deleteCat($table, $col, $condition)
{
    global $conn;
    $delete_query = "DELETE FROM $table WHERE $condition";
    $execute_delete = mysqli_query($conn, $delete_query);
    return $execute_delete;
}



// UPDATE QUERY
function UpdateQuery($table, $col_key, $col_value, $category_id)
{
    global $conn;
    $set_clauses = array();
    for ($i = 0; $i < count($col_key); $i++) {
        $set_clauses[] = "$col_key[$i] = '" . $col_value[$i] . "'";
    }
    $set_clause = implode(', ', $set_clauses);
    $update_query = "UPDATE $table SET $set_clause WHERE id = $category_id";
    $execute_update = mysqli_query($conn, $update_query);
    return $execute_update;
}



// EDIT CATEGORY
function updateCategory($table, $col_key, $col_value, $condition)
{
    global $conn;
    $query = "UPDATE $table SET $col_key = ? WHERE $condition";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $col_value);
    $execute_update = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $execute_update;
}

?>