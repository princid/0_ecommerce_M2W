<?php session_start();
include_once '../model/authentication.php'
    ?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["user_email"];
    $userpassword = $_POST["password"];
    if (empty($email) || empty($userpassword)) {
        echo "Please fill valid info";
    } else {
        $table = "users_table";
        $condition = "email = '$email'";
        $fetch = loginQuery($table, $condition);
        if (!empty($fetch)) {
            $db_password = $fetch["password"];
            var_dump($db_password);
            $username = $fetch['username'];
            $user_id = $fetch['id'];
            $user_email = $fetch['email'];
            if (password_verify($userpassword, $db_password)) {
                $_SESSION['user_login'] = "Login Success";
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $user_email;
                $userData = $fetch;
                header("Location: ../view/account-edit-profile.php");
                exit;
            } else {
                $_SESSION['login_fail'] = "Invalid Credentials";
                header("Location: ../view/login.php");
                exit;
            }
        } else {
            $_SESSION['login_fail'] = "Invalid Credentials";
            header("Location: ../view/login.php");
            exit;
        }
    }
}
?>