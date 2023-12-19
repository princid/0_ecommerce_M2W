<?php
session_start();
unset($_SESSION['admin_login']);
session_unset();
session_destroy(); 
header("Location: ../view/login.php");
?>