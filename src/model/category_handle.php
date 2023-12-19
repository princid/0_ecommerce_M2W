<?php
include '../../config/connection.php';

function fetchCategory($table, $col)
{
    global $conn;
    $query = "SELECT $col FROM $table";
    $execute = mysqli_query($conn, $query);
    if (!$execute) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $cat_rows = array();
    while ($row = mysqli_fetch_assoc($execute)) {
        $cat_rows[] = $row;
    }
    return $cat_rows;
}
?>