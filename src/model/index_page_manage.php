<?php

// CONNECTION FILE
include '../../config/connection.php';

function fetchFeaturedProducts($col , $table , $condition){
    global $conn;
    $data_container = array();
    $featured_product = "SELECT $col FROM $table WHERE $condition";
    $execute = mysqli_query($conn, $featured_product);
    while ($row = mysqli_fetch_assoc($execute)) {
        $data_container[] = $row;
    }
    return $data_container;
}
?>