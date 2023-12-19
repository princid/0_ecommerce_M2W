<?php
include '../../config/connection.php';

// INSERT QUERY
function insertSubscriber($table, $col, $subscriber)
{
    global $conn;
    $check_query = "SELECT COUNT(*) FROM $table WHERE $col = ?";
    $check_stmt = mysqli_prepare($conn, $check_query);
    if ($check_stmt) {
        mysqli_stmt_bind_param($check_stmt, 's', $subscriber['subscriber_email']);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $count);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);
        if ($count > 0) {
            echo "<span class='text-light' >Subscriber with this email already exists.</span>";
            return false;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    $insert_query = "INSERT INTO $table ($col) VALUES (?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    if ($insert_stmt) {
        mysqli_stmt_bind_param($insert_stmt, 's', $subscriber['subscriber_email']);
        $subscriber['subscriber_email'] = mysqli_real_escape_string($conn, $subscriber['subscriber_email']);
        if (mysqli_stmt_execute($insert_stmt)) {
            mysqli_stmt_close($insert_stmt);
            return true;
        } else {
            echo "Error: " . mysqli_error($conn);
            mysqli_stmt_close($insert_stmt);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    return false;
}
?>
