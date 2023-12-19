<?php
session_start();
unset($_SESSION['admin_login']);
session_destroy();
session_write_close();
header("location: ../view/index.php");
?>