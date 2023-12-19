<?php include_once '../model/query.php' ?>

<!-- FOR ADMIN LOGIN -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["admin_email"];
    $userpassword = $_POST["password"];

    if (empty($email) || empty($userpassword)) {
        echo "Please fill valid info";
    } else {
        $col = "user_email , password";
        $table = "admin_data";
        $condition_1 = "user_email = '$email'";
        $condition_2 = "password = '$userpassword'";
        $fetch = loginQuery($col, $table, $condition_1, $condition_2);
        if (!empty($fetch)) {
            // echo "success";
            session_start();
            $_SESSION['admin_login'] = "Login Success";
            header("Location: ../view/home_page.php");
        } else {
            echo "Please fill valid info";
        }
    }
}
?>