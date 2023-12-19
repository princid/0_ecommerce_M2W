<?php 
session_start();
include '../../config/connection.php';

// SUBSCRIBERS FETCH
$fetch_query = "SELECT * FROM `subscribers` WHERE isDeleted = 0";
$execute = mysqli_query($conn , $fetch_query);
$subscribers = array();
while ($row = mysqli_fetch_assoc($execute)) {
    $subscribers[] = $row;
}



// DELETED SUBSCRIBERS FETCH
$fetch_query = "SELECT * FROM `subscribers` WHERE isDeleted = 1";
$execute = mysqli_query($conn , $fetch_query);
$subscribers_deleted = array();
while ($row = mysqli_fetch_assoc($execute)) {
    $subscribers_deleted[] = $row;
}



// DELETE A SUBSCRIBER
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['del_subscriber'])){
        $subscriber_id = $_POST['subscriber_id'];
        $query = "UPDATE `subscribers` SET isDeleted = 1 WHERE id = $subscriber_id ";
        $execute = mysqli_query($conn , $query);
        if($query){
            $_SESSION['delete_subscriber'] = "Subscriber Deleted Successfully";
            header("Location: ../view/subscribers.php");
            exit;
        }
        else{
            $_SESSION['delete_subscriber_fail'] = "Error in deleting subscriber";
            header("Location: ../view/subscribers.php");
            exit;
        }
    }
}



// RESTORE A SUBSCRIBER
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['restore_subscriber'])){
        $subscriber_id = $_POST['subscriber_id'];
        $query = "UPDATE `subscribers` SET isDeleted = 0 WHERE id = $subscriber_id ";
        $execute = mysqli_query($conn , $query);
        if($query){
            $_SESSION['restore_subscriber'] = "Subscriber Restored Successfully";
            header("Location: ../view/deleted_subscribers.php");
            exit;
        }
        else{
            $_SESSION['restore_subscriber_fail'] = "Error in Restoring subscriber";
            header("Location: ../view/deleted_subscribers.php");
            exit;
        }
    }
}
?>