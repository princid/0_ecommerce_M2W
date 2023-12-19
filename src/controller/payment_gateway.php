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
$publish_key = "pk_test_51OMoU7SDZQL6WmwFS5hycFlwCdbF3wO73iKHaFxLBadta4SIDyubgcIRy44FzliaBLVkzXpYWGSFQJxQH2PALKso00SUASag1M";
$secret_key = "sk_test_51OMoU7SDZQL6WmwFN1A3Hx791lNkwxjz5l5UqHk4ILpb2H6sK6wjSOa7hjkO6yySgmndwOTNatpEw0xHg51fiMqT00iPDWzvLn";
// API KEYS ENDS

// LOGIC FOR PAYMENT GATEWAY
\Stripe\Stripe::setApiKey($secret_key);
$grand_total = isset($_POST['grand_total']) ? $_POST['grand_total'] : null;
$token = $_POST['stripeToken'];
$address = $_POST['address_id'];
try {
    // \stripe\stripe::setVerifySslCerts(false);
    // // Create PaymentIntent
    // $intent = \Stripe\PaymentIntent::create([
    //     'amount' => $grand_total * 100,
    //     'currency' => 'inr',
    //     'description' => 'Please Enter Details',
    //     'payment_method_data' => [
    //         'type' => 'card',
    //         'card' => ['token' => $token],
    //     ],
    //     'automatic_payment_methods' => [
    //         'enabled' => true,
    //         'allow_redirects' => 'never',
    //     ],
    //     'setup_future_usage' => 'off_session',
    // ]);
    // if ($intent->status === 'requires_action') {
    //     echo json_encode(['requires_action' => true, 'payment_intent_client_secret' => $intent->client_secret]);
    //     exit;
    // }
    // $intent->confirm();
    // $transaction_id = $intent->id;
    // $client_secret = $intent->client_secret;
    // print_r($intent);
    // echo json_encode(['success' => true, 'transaction_id' => $transaction_id, 'client_secret' => $client_secret]);


    \stripe\stripe::setVerifySslCerts(false);
    // Create PaymentIntent
    $intent = \Stripe\Charge::create(array(
        'amount' => $grand_total * 100,
        'currency' => 'inr',
        'description' => 'Please Enter Details',
        'source' => $token
        // 'payment_method_data' => [
        //     'type' => 'card',
        //     'card' => ['token' => $token],
        // ],
    ));
    print_r($intent);
    ?>
    <!-- Include Stripe.js library -->
    <!-- <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('your_publishable_key');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');
        function handlePaymentConfirmation(clientSecret) {
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                },
            }).then(function (result) {
                if (result.error) {
                    console.error(result.error);
                } else {
                    window.location.href = 'http://localhost/shoppingo_project/src/view/thank-you.php';
                }
            });
        }
        var obtainedClientSecret = $client_secret;
        handlePaymentConfirmation(obtainedClientSecret);
    </script> -->
    <?php
    exit;



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
    // Handle card errors
    echo 'Card Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\RateLimitException $e) {
    // Handle rate limit errors
    echo 'Rate Limit Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Handle invalid request errors
    echo 'Invalid Request Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Handle authentication errors
    echo 'Authentication Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Handle API connection errors
    echo 'API Connection Error: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle other API errors
    echo 'Stripe API Error: ' . $e->getError()->message;
} catch (Exception $e) {
    // Handle other errors
    echo 'Error: ' . $e->getMessage();
}
?>