<?php
include '../model/subscriber_insert.php';

// CATEGORY INSERTION
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subscriber_mail = $_POST["subscriber_email"];
    $table = "subscribers";
    $col = "email";
    $subscriber = [
        'subscriber_email' => $subscriber_mail
    ];
    if (empty($subscriber_mail)) {
        echo "<span class='text-light'>Please enter Email ID</span>";
    } else {
        if (insertSubscriber($table, $col, $subscriber)) {
            echo "<span class='text-light'>You are a new subscriber</span>";
        } else {

        }
    }
}
?>