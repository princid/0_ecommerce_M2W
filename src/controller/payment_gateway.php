<?php
session_start();

// CONNECTION FILE
include '../../config/connection.php';

// USER ADDRESS MODEL FILE
include '../model/user_address.php';

// ORDERS MODEL FILE
include '../model/orders_model.php';

// STRIPE FILE 
include '../../stripe-php-master/init.php';

// USER ID
$user_id = $_SESSION['user_id'];


// PRODUCT DETAILS
$table_1 = "products_cart";
$table_2 = "products_table";
$condition_1 = "products_cart.product_id = products_table.id";
$condition_2 = "products_cart.user_id = $user_id";
$products_details_2 = fetchOrderDetails($table_1, $table_2, $condition_1, $condition_2);


// Required files to send mail using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// API KEYS
$publish_key = "pk_test_51OP1AZAFai3JwiWEqjLUhJSWCdT1lkwy86Ixqj7PUndeQw6Q9QJgXOmDvMFDpDzYzUz0J609Y5Sj7XfTUL09qvzZ00laZF95s1";
$secret_key = "sk_test_51OP1AZAFai3JwiWEPG6EJquL2WGT4Z1FkvqP5QISCOhN56r5V7Dxt7TDZ6tS20cORQpCCrUsSQaNpIVSGFghqNQ700YrRsUrgQ";
// API KEYS ENDS

// LOGIC FOR PAYMENT GATEWAY
\Stripe\Stripe::setApiKey($secret_key);
echo '<pre>';
\Stripe\Stripe::setVerifySslCerts(false);
print_r($_POST);

$grand_total = isset($_POST['grand_total']) ? $_POST['grand_total'] : null;
$token = $_POST['stripeToken'];
$address = $_POST['address_id'];

var_dump($grand_total, $token, $address);

try {
    echo "huhuhuh";

    $data = \Stripe\Charge::create(array(
        'amount' => $grand_total * 100,
        'currency' => "inr",
        'description' => "Please Enter Details",
        'source' => $token,
    ));

    $transaction_id = $data['id'];
    // var_dump("txn id", $transaction_id);
    // Output the charge details
    // echo '<pre>';
    // print_r($data);

    // LOGIC FOR SAVING DATA IN ORDERS TABLE 
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
    $keys = "user_id, address_id, total_price, total_products, tracking_number, invoice_number ,payment_status , payment_method , transaction_id";
    $values = "'$user_id', '$address_id', '$total_price', '$total_products', '$tracking_id', '$invoice_number' , '1' , 'card' , '$transaction_id'";
    $insert_order = insertOrders($table, $keys, $values);
    if ($insert_order) {
        // Get the order ID of the inserted order
        $order_id = mysqli_insert_id($conn);

        // LOGIC TO SEND DATA INTO ORDER_DETAILS TABLE  (ALL ORDERED PRODUCTS DETAILS)
        $insert_product_details = false;
        foreach ($products_details_2 as $p_details) {
            $product_id = $p_details['product_id'];
            $product_name = $p_details['product_name'];
            $product_price = $p_details['product_price'];
            $product_quantity = $p_details['quantity'];
            $product_size = $p_details['size'];
            $product_image = $p_details['selected_image'];

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
                // REDIRECT TO THANK YOU PAGE
                header("Location: ../view/thank-you.php");
            } catch (Exception $e) {
                echo "Email sending failed. Error: " . $mail->ErrorInfo;
            }
        } else {
            echo "sorry.. currently we are not receiving orders";
        }
    }
} catch (\Stripe\Exception\CardException $e) {
    // Handle specific CardException
    echo 'CardException Message: ' . $e->getMessage();
} catch (\Stripe\Exception\RateLimitException $e) {
    // Handle specific RateLimitException
    echo 'RateLimitException Message: ' . $e->getMessage();
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Handle specific InvalidRequestException
    echo 'InvalidRequestException Message: ' . $e->getMessage();
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Handle specific AuthenticationException
    echo 'AuthenticationException Message: ' . $e->getMessage();
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Handle specific ApiConnectionException
    echo 'ApiConnectionException Message: ' . $e->getMessage();
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle generic ApiErrorException
    echo 'ApiErrorException Message: ' . $e->getMessage();
} catch (Exception $e) {
    // Handle generic Exception
    echo 'Generic Exception Message: ' . $e->getMessage();
}
?>