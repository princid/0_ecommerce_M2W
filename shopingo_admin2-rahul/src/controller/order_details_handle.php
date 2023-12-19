<?php
include '../model/order_model.php';
session_start();


// Required files to send mail using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if 'user_id' is set in $GLOBALS array
if (isset($GLOBALS['user_id']) && isset($GLOBALS['order_id'])) {
    $user_id = $GLOBALS['user_id'];
    $order_id = $GLOBALS['order_id'];


    // FETCH ORDERS
    $table = 'orders_table';
    $col = "*";
    $condition = "id IS NOT NULL";
    $fetch_orders = fetchOrders($col, $table, $condition);


    // FETCH USER DETAILS WITH JOINS
    $table_1 = "orders_table";
    $table_2 = "users_table";
    $col = "*";
    $condition_1 = "orders_table.user_id = users_table.id";
    $condition_2 = "orders_table.user_id = $user_id AND orders_table.id = $order_id ";
    $fetch_orders_user = fetchUserWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);


    // FETCH USER ADDRESS
    $table_1 = "orders_table";
    $table_2 = "user_address";
    $col = "*";
    $condition_1 = "orders_table.address_id  = user_address.id";
    $condition_2 = "orders_table.user_id = $user_id AND orders_table.id = $order_id ";
    $fetch_user_address = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);


    // FETCH PRODUCT ID 
    $table_1 = "orders_table";
    $table_2 = "products_cart";
    $col = "*";
    $condition_1 = "orders_table.user_id  = products_cart.user_id";
    $condition_2 = "orders_table.user_id = $user_id";
    $fetch_product_id = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);


    // Check if 'product_id' is set in $fetch_product_id array
    if (isset($fetch_product_id[0]['product_id'])) {
        $ordered_product_id = $fetch_product_id[0]['product_id'];

        // FETCH PRODUCT DETAILS
        $table_1 = "order_details";
        $table_2 = "orders_table";
        $col = "*";
        $condition_1 = "order_details.order_id = orders_table.id";
        $condition_2 = "orders_table.user_id = $user_id AND orders_table.id = $order_id";
        $fetch_product_details = fetchOrdersWithJoins($col, $table_1, $table_2, $condition_1, $condition_2);
    }
}




// UPDATE THE  ORDER STATUS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_status_btn'])) {

        $status_val = $_POST['order_status'];
        $order_id = $_POST['order_id'];
        $user_mail = $_POST['user_mail'];
        $table = "orders_table";
        $values = "status = '$status_val'";
        $condition = " id = $order_id ";

        if (!empty($status_val)) {
            $update_order_status = updateQuery($table, $values, $condition);
            if ($update_order_status) {

                // // CODE TO SEND MAIL 
                // require '../../mailer_file/PHPMailer-master/src/PHPMailer.php';
                // require '../../mailer_file/PHPMailer-master/src/Exception.php';
                // require '../../mailer_file/PHPMailer-master/src/SMTP.php';

                // // Email content
                // $to = $user_mail;
                // $subject = "Your products have been shipped";
                // $message = "Order Shipped:\n\n";
                // $message .= "Your order is shipped. It will be delivered to you on time.\n\n";
                // $message .= "Thank You:\n\n";
                // $message .= "Team Shoppingo:\n\n";

                // $mail = new PHPMailer(true);
                // try {
                //     $mail->isSMTP();
                //     $mail->Host = 'smtp.gmail.com';
                //     $mail->SMTPAuth = true;
                //     $mail->Username = 'rahul.mind2web@gmail.com';
                //     $mail->Password = 'rrprzzsoczcghept';
                //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                //     $mail->Port = 465;
                //     $mail->setFrom('rahul.mind2web@gmail.com', 'Team Shoppingo');
                //     $mail->addAddress($to);
                //     $mail->Subject = $subject;
                //     $mail->Body = $message;
                //     $mail->SMTPDebug = 2;

                //     $mail->send();

                $_SESSION['update_order_status'] = "Order status updated";
                header("Location: ../view/orders.php");
                exit;

                // } catch (Exception $e) {
                //     echo "Email sending failed. Error: " . $mail->ErrorInfo;
                //     exit;
                // }
            } else {
                $_SESSION['update_order_status_fail'] = "Order status updatedion failed";
                header("Location: ../view/orders.php");
                exit;
            }
        } else {
            $_SESSION['update_order_status_notSelected'] = "Please Select order status";
            header("Location: ../view/orders.php");
            exit;
        }


    }
}
?>