<?php
session_start();
// MODEL FILE
include '../model/user_address.php';


// ID OF LOGGED IN USER
$user_id = $_SESSION['user_id'];


// SHOWING ADDRESSES OF A USER
$condition_2 = "isDeleted = 0";
$data_container = fetchAddress($user_id ,$condition_2);



// INSERT USER ADDRESS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pincode = trim(htmlentities($_POST["pin_code"], ENT_QUOTES, 'UTF-8'));
    $address = trim(htmlentities($_POST["address"], ENT_QUOTES, 'UTF-8'));
    $state = trim(htmlentities($_POST["state"], ENT_QUOTES, 'UTF-8'));
    $district = trim(htmlentities($_POST["city_district"], ENT_QUOTES, 'UTF-8'));
    $landmark = trim(htmlentities($_POST["landmark"], ENT_QUOTES, 'UTF-8'));
    $contact = trim(htmlentities($_POST["contact"], ENT_QUOTES, 'UTF-8'));

    $table = "user_address";
    $col_keys = "user_id, pin_code, address, state, city, landmark, contact_number";
    $col_values = "$user_id, $pincode, $address, $state, $district, $landmark, $contact";
    $condition = " id IS NOT NULL";

    $insert_address = addAddress($table, $col_keys, $col_values);

    if ($insert_address) {
        $_SESSION['saved_address'] = "Address saved successfully";
        header("Location: ../view/account-saved-address.php");
        exit;
    } else {
        $_SESSION['save_address_failed'] = "Address save failed.. Please try again later";
        header("Location: ../view/account-saved-address.php");
        exit;
    }
}

?>