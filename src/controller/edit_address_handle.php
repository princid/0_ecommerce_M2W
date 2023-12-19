<?php
session_start();

// MODEL FILE
include '../model/user_address.php';

// ID OF LOGGED IN USER
$user_id = $_SESSION['user_id'];


// EDIT USER ADDRESS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit_address_btn'])) {
        $pincode = trim(htmlentities($_POST["pin_code"], ENT_QUOTES, 'UTF-8'));
        $address = trim(htmlentities($_POST["address"], ENT_QUOTES, 'UTF-8'));
        $state = trim(htmlentities($_POST["state"], ENT_QUOTES, 'UTF-8'));
        $city = trim(htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8'));
        $landmark = trim(htmlentities($_POST["landmark"], ENT_QUOTES, 'UTF-8'));
        $contact = trim(htmlentities($_POST["contact"], ENT_QUOTES, 'UTF-8'));
        $user_address_id = $_POST['user_specific_id'];
        $user_address_id = $_POST['user_specific_id'];

        
        $table = "user_address";
        $set_val = "pin_code='$pincode', address='$address', state='$state', city='$city', landmark='$landmark', contact_number='$contact'";
        $condition_1 = "user_id = $user_id";
        $condition_2 = "id = $user_address_id";
        $update_address = editAddress($table, $set_val, $condition_1, $condition_2);

        if ($update_address) {
            $_SESSION['user_address_update_success'] = "Address Updated Successfully";
            header("Location: ../view/account-saved-address.php");
            exit;
        } else {
            $_SESSION['user_address_update_fail'] = "Cannot Update User Address.... Try Again Later";
            header("Location: ../view/account-saved-address.php");
            exit;
        }

    }
}


// DELETE ADDRESS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_address_btn'])) {
        $address_id = $_POST['address_id'];
        $table = "user_address";
        $set_val = "isDeleted = 1";
        $condition = "id = $address_id ";
        $delete_address = delAddress($table, $set_val, $condition);
        if ($delete_address) {
            $_SESSION['remove_address'] = "Address Removed Successfully";
            header("Location: ../view/account-saved-address.php");
            exit;
        } else {
            $_SESSION['remove_address_fail'] = "Failed to remove address...  try again later";
            header("Location: ../view/account-saved-address.php");
            exit;
        }
    }
}
?>