<?php
session_start();
// USER ADDRESS MODEL FILE
include '../model/user_address.php';

// ORDERS MODEL FILE
include '../model/orders_model.php';

// USER ID
$user_id = $_SESSION['user_id'];


// Required files to send mail using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// SAVING SELECTED USER ADDRESS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['orders_address_btn'])) {
        $address_id = $_POST['selectedAddress'];
        $user_id = $_POST['user_id'];
        $set_val = " selected_address = 1";
        $set_val_2 = " selected_address = 0";
        $table = "user_address";
        $condition_1 = "user_id = $user_id";
        $condition_2 = "id = $address_id";
        $condition_3 = "id != $address_id";
        $update_address = editAddress($table, $set_val, $condition_1, $condition_2);
        $update_address_2 = editAddressZero($table, $set_val_2, $condition_1, $condition_3);
        if ($update_address && $update_address_2) {
            header("Location: ../view/billing-details.php");
            exit;
        } else {
            header("Location: ../view/billing-details.php");
            exit;
        }
    }
}


// PERSONAL DETAILS
$table_1 = "products_cart";
$table_2 = "users_table";
$condition_1 = "products_cart.user_id = users_table.id";
$condition_2 = "products_cart.user_id = $user_id";
$data_container = fetchOrderDetails($table_1, $table_2, $condition_1, $condition_2);



// SHIPPING DETAILS
$table_1 = "products_cart";
$table_2 = "user_address";
$condition_1 = "products_cart.user_id = user_address.user_id";
$condition_2 = "products_cart.user_id = $user_id AND user_address.selected_address = 1 ";
$data_container_shipping = fetchOrderDetails($table_1, $table_2, $condition_1, $condition_2);



// ORDER DETAILS
$table = "orders_table";
$condition = "user_id = $user_id";
$product_details = fetchOrderDetailsSimple($table_1, $condition);



// PRODUCT DETAILS
$table_1 = "products_cart";
$table_2 = "products_table";
$condition_1 = "products_cart.product_id = products_table.id";
$condition_2 = "products_cart.user_id = $user_id";
$products_details_2 = fetchOrderDetails($table_1, $table_2, $condition_1, $condition_2);




// SAVING ORDERS TABLE DATA
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['place_order_btn'])) {

        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id'];
        $invoice_number = $_POST['invoice_number'];
        $tracking_id = $_POST['tracking_id'];
        $total_price = $_POST['grand_total'];
        $total_products = $_POST['total_products'];
        $user_email = $_POST['email_id'];
        $user_name = $_POST['fname'];


        // Insert order into orders_table
        $table = "orders_table";
        $keys = "user_id, address_id, total_price, total_products, tracking_number, invoice_number";
        $values = "'$user_id', '$address_id', '$total_price', '$total_products', '$tracking_id', '$invoice_number'";
        $insert_order = insertOrders($table, $keys, $values);



        if ($insert_order) {
            // Get the order ID of the inserted order
            $order_id = mysqli_insert_id($conn);

            $insert_product_details = false;
            foreach ($products_details_2 as $p_details) {
                $product_id = $p_details['product_id'];
                $product_name = $p_details['product_name'];
                $product_price = $p_details['product_price'];
                $product_quantity = $p_details['quantity'];
                $product_size = $p_details['size'];
                $product_image = $p_details['selected_image'];

                // var_dump($order_id);
                // var_dump($product_id);
                // var_dump($product_name);
                // var_dump($product_price);
                // var_dump($product_quantity);
                // var_dump($product_size);
                // var_dump($product_image);
            
                $table = "order_details";
                $keys = "order_id, o_product_id, o_product_name, o_product_quantity, o_product_size, o_product_price , o_product_image";
                $values = "'$order_id', '$product_id' ,'$product_name', '$product_quantity', '$product_size', '$product_price' , '$product_image'";
                // Insert product details
                $insert_product_details = insertOrdersProductDetails($table, $keys, $values);
            }

            if ($insert_product_details) {
                // Logic to update the stocks
                foreach ($products_details_2 as $product) {
                    $productId = $product['product_id'];
                    $stock = $product['stock'];
                    $orderedQuantity = $product['quantity'];
                    var_dump($stock);
                    $update_stock = updateStockCount($productId, $orderedQuantity);
                }

                // CODE TO SEND MAIL AFTER ORDER PLACING
                require '../../mailer_file/PHPMailer-master/src/PHPMailer.php';
                require '../../mailer_file/PHPMailer-master/src/Exception.php';
                require '../../mailer_file/PHPMailer-master/src/SMTP.php';

                // Email content
                $to = $user_email;
                $subject = "Your order has been placed";
                $message = "Order Details:\n\n";
                $message .= "Total Products: $total_products\n\n";
                $message .= "Grand Total: $total_price\n\n";
                $message .= "Invoice Number: $invoice_number\n\n";
                $message .= "Tracking Id: $tracking_id\n\n";
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'rahul.mind2web@gmail.com';
                    $mail->Password = 'rrprzzsoczcghept';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('rahul.mind2web@gmail.com', 'Team Shoppingo');
                    $mail->addAddress($to, $user_name);

                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->send();


                    //     // REDIRECT TO THANK YOU PAGE
                    header("Location: ../view/thank-you.php");
                } catch (Exception $e) {
                    echo "Email sending failed. Error: " . $mail->ErrorInfo;
                }

            } else {
                echo "sorry.. currently we are not receiving orders";
            }
        }
    }
}
?>





<!-- // SAVING ORDERS TABLE DATA
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['place_order_btn'])) {

        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id'];
        $invoice_number = $_POST['invoice_number'];
        $tracking_id = $_POST['tracking_id'];
        $total_price = $_POST['grand_total'];
        $total_products = $_POST['total_products'];
        $user_email = $_POST['email_id'];
        $user_name = $_POST['fname'];

        // function credentials
        $table = "orders_table";
        $keys = "user_id , address_id , total_price , total_products ,  tracking_number , invoice_number";
        $values = "'$user_id', '$address_id' , '$total_price' , '$total_products', '$tracking_id' , '$invoice_number'";
        $insert_order = insertOrders($table, $keys, $values);



        // Logic to update the stocks
        foreach($products_details_2 as $product) {
            $productId = $product['product_id'];
            $stock = $product['stock'];
            $orderedQuantity = $product['quantity'];
            var_dump($stock);
            $update_stock = updateStockCount($productId, $orderedQuantity);
        }

        if($insert_order) {

            $order_id = mysqli_insert_id($conn);

            foreach($products_details_2 as $product_details) {
                $product_name = $product_details['product_name'];
                $product_price = $product_details['product_price'];
                $product_quantity = $product_details['quantity'];
                $product_size = $product_details['size'];
                $table = "order_details";
                $keys = "order_id , o_product_name , o_product_quantity , o_product_size ,  o_product_price";
                $values = "'$order_id', '$product_name' , '$product_quantity' , '$product_size', '$product_price'";
                $insert_product_details = insertOrders($table, $keys, $values);
            }


            // // CODE TO SEND MAIL AFTER ORDER PLACING
            // require '../../mailer_file/PHPMailer-master/src/PHPMailer.php';
            // require '../../mailer_file/PHPMailer-master/src/Exception.php';
            // require '../../mailer_file/PHPMailer-master/src/SMTP.php';

            // // Email content
            // $to = $user_email;
            // $subject = "Your order has been placed";
            // $message = "Order Details:\n\n";
            // $message .= "Total Products: $total_products\n\n";
            // $message .= "Grand Total: $total_price\n\n";
            // $message .= "Invoice Number: $invoice_number\n\n";
            // $message .= "Tracking Id: $tracking_id\n\n";
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
            //     $mail->addAddress($to, $user_name);

            //     $mail->Subject = $subject;
            //     $mail->Body = $message;
            //     $mail->send();


            //     // REDIRECT TO THANK YOU PAGE
                header("Location: ../view/thank-you.php");
            // } catch (Exception $e) {
            //     echo "Email sending failed. Error: ".$mail->ErrorInfo;
            // }

        } else {
            echo "sorry.. currently we are not receiving orders";
        }
    }
} -->