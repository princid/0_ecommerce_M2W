<?php include '/var/www/html/shoppingo_project/src/model/authentication.php'; ?>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    $username = trim(htmlentities($_POST["username"], ENT_QUOTES, 'UTF-8'));
    $mobile_number = trim(htmlentities($_POST["mobile_number"], ENT_QUOTES, 'UTF-8'));
    $userpassword = trim(htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8'));
    $useremail = trim(htmlentities($_POST["useremail"], ENT_QUOTES, 'UTF-8'));

    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($mobile_number)) {
        $errors['mobile_number'] = "Mobile number is required";
    }
    if (empty($userpassword)) {
        $errors['password'] = "Password is required";
    }
    if (empty($useremail) || !filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $errors['useremail'] = "Valid email is required";
    }
    // Hash the password
    $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

    $table = "users_table";
    $keys = "username, email, password, mobile_number";

    $values = [
        'username' => $username,
        'useremail' => $useremail,
        'hashedPassword' => $hashedPassword,
        'mobile_number' => $mobile_number
    ];

    // Check if email already exists
    $check_query = "SELECT * FROM $table WHERE email = ?";
    $check_statement = mysqli_prepare($conn, $check_query);
    mysqli_stmt_bind_param($check_statement, 's', $values['useremail']);
    mysqli_stmt_execute($check_statement);
    mysqli_stmt_store_result($check_statement);

    if (mysqli_stmt_num_rows($check_statement) > 0) {
        $_SESSION['email_fail'] = 'Email address is already registered. Please use a different email.';
        header("Location: ../view/authentication-register.php");
        exit();
    }
    $insert_data = insertQuery($table, $keys, $values);
    if ($insert_data) {
        $_SESSION['signup_success'] = 'Sign Up Successful, Now Login';
        header("Location: ../view/login.php");
    } else {
        $_SESSION['signup_fail'] = 'An error occurred, please try again later';
        header("Location: ../view/authentication-register.php");
    }
} else {
    $error_query_string = http_build_query(['errors' => $errors]);
    header("Location: ../view/authentication-register.php?$error_query_string");
    exit();
}
?>