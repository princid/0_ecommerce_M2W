<?php
include '../../config/connection.php';

global $conn;
// FUNCTION TO REGISTER A USER
function insertQuery($table, $keys, $values)
{
    global $conn;

    // if email already exists
    $check_query = "SELECT * FROM $table WHERE email = ?";
    $check_statement = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_statement, 's', $values['useremail']);
    mysqli_stmt_execute($check_statement);
    mysqli_stmt_store_result($check_statement);
    if (mysqli_stmt_num_rows($check_statement) > 0) {
        $_SESSION['email_fail'] = "Email Already Registered";
        return false;
    }
    // Email is unique, proceed with the insert
    $insert_query = "INSERT INTO $table ($keys) VALUES (?, ?, ?, ?)";
    $insert_statement = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_statement, 'ssss', $values['username'], $values['useremail'], $values['hashedPassword'], $values['mobile_number']);
    $execute = mysqli_stmt_execute($insert_statement);
    if (!$execute) {
        die("Error: " . mysqli_error($conn));
    } else {
        return $execute;
    }

}



// FOR LOGIN
function loginQuery($table, $condition)
{
    global $conn;
    $login_query = "SELECT * FROM $table WHERE $condition";
    $execute = mysqli_query($conn, $login_query);
    if (!$execute) {
        die("Query failed: " . mysqli_error($conn));
    }   
    $fetch = mysqli_fetch_assoc($execute);
    return $fetch;
}


?>