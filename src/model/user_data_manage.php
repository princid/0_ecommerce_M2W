<?php
include '../../config/connection.php';

// FETCH USER DATA
function fetchUserData($col, $table, $condition)
{
    global $conn;
    $data_container = array();
    $fetch_query = "SELECT $col FROM $table WHERE $condition";
    $execute = mysqli_query($conn, $fetch_query);
    while ($row = mysqli_fetch_array($execute, MYSQLI_ASSOC)) {
        array_push($data_container, $row);
    }
    if (!empty($data_container)) {
        return $data_container;
    } else {
        return false;
    }
}




// TO UPDATE THE USER DATA
function updateUserData($table, $col_key, $col_value, $condition)
{
    global $conn;
    $columns = explode(', ', $col_key);
    $values = explode(', ', $col_value);
    $set_values = '';
    $bindValues = [];
    for ($i = 0; $i < count($columns); $i++) {
        if ($columns[$i] === 'dob') {
            $set_values .= $columns[$i] . ' = ?';
            $bindValues[] = ($values[$i] !== '') ? date('Y-m-d', strtotime($values[$i])) : null;
        } elseif ($columns[$i] === 'gender') {
            $set_values .= $columns[$i] . ' = ?';
            $bindValues[] = ($values[$i] !== '') ? (int) $values[$i] : null;
        } elseif ($columns[$i] === 'updated_at') {
            $set_values .= $columns[$i] . ' = ?';
            $bindValues[] = $values[$i];
        } else {
            $set_values .= $columns[$i] . ' = ?';
            $bindValues[] = $values[$i];
        }
        if ($i < count($columns) - 1) {
            $set_values .= ', ';
        }
    }
    $update_query = "UPDATE $table SET $set_values WHERE $condition";
    $stmt = mysqli_prepare($conn, $update_query);
    if (!$stmt) {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
    $paramTypes = str_repeat('s', count($bindValues));
    call_user_func_array('mysqli_stmt_bind_param', array_merge([$stmt, $paramTypes], $bindValues));
    $execute = mysqli_stmt_execute($stmt);
    if (!$execute) {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);

    return $execute;
}
?>