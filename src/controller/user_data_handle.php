<?php
include '../model/user_data_manage.php';
session_start();
$user_id = $_SESSION['user_id'];


$col = "*";
$table = "users_table";
$condition = "id = $user_id ";


// SHOWING FULL DATA OF USER
$data_container = fetchUserData($col, $table, $condition);



// EDIT OR UPDATE USER DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = trim(htmlentities($_POST['firstname'], ENT_QUOTES, 'UTF-8'));
    $lname = trim(htmlentities($_POST['lastname'], ENT_QUOTES, 'UTF-8'));
    $gender = isset($_POST['gender']) ? intval($_POST['gender']) : null;
    $dob = $_POST['dob'];

    $currentDateTime = date('Y-m-d H:i:s');
    $table = "users_table";
    $condition = "id = $user_id";

    $col_key = "first_name, last_name, gender, dob, updated_at";
    $col_value = "$fname, $lname, $gender, '$dob', $currentDateTime";

    $update_user = updateUserData($table, $col_key, $col_value, $condition);

    if ($update_user) {
        $_SESSION['user_updated'] = "Your profile has been updated";
        header("Location: ../view/account-edit-profile.php");
        exit;
    } else {
        $_SESSION['updation_fail'] = "Error in Updation";
        header("Location: ../view/account-edit-profile.php");
        exit;
    }
}


?>