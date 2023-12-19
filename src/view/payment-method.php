<?php
session_start();
include '../../includes/header.php';

// NAVBAR
include_once '../../includes/nav.php';

// CONTROLLER FILE
include '../controller/orders_handle.php';

// USER ID
$user_id = $_SESSION['user_id'];

include '../../stripe-php-master/init.php';
$publish_key = "pk_test_51OMoU7SDZQL6WmwFS5hycFlwCdbF3wO73iKHaFxLBadta4SIDyubgcIRy44FzliaBLVkzXpYWGSFQJxQH2PALKso00SUASag1M";
$secret_key = "sk_test_51OMoU7SDZQL6WmwFN1A3Hx791lNkwxjz5l5UqHk4ILpb2H6sK6wjSOa7hjkO6yySgmndwOTNatpEw0xHg51fiMqT00iPDWzvLn";
\stripe\stripe::setApiKey($secret_key);
\stripe\stripe::setVerifySslCerts(false);


// FETCH PRODUCT TOTAL PRICE AND COUNT
$fetch_data = "SELECT SUM(product_price * quantity) AS total_price, SUM(quantity) AS total_products FROM `products_cart` WHERE user_id = $user_id";
$execute = mysqli_query($conn, $fetch_data);
if (!$execute) {
  die("Query failed: " . mysqli_error($conn));
}
// Fetch the result
$result = mysqli_fetch_assoc($execute);
$total_price = $result['total_price'];
$total_products = $result['total_products'];

// Retrieve the 'allinfo' parameter from the URL

$allinfo = isset($_GET['allinfo']) ? json_decode(urldecode($_GET['allinfo']), true) : array();

// Accessing data from the array
if (!empty($allinfo)) {
  // Accessing personal details
  $fname = $allinfo['personal_info']['first_name'];
  $lname = $allinfo['personal_info']['last_name'];
  $email = $allinfo['personal_info']['email'];
  $mobile = $allinfo['personal_info']['mobile_number'];

  // Accessing shipping details
  $pincode = $allinfo['shipping_details']['pin_code'];
  $city = $allinfo['shipping_details']['city'];
  $state = $allinfo['shipping_details']['state'];
  $address = $allinfo['shipping_details']['address'];
  $address_id = $allinfo['shipping_details']['id'];

  // Accessing other details
  $total_products = $allinfo['other_details']['total_products'];

  // Accessing product details
  $products_details = $allinfo['product_details'];

  // var_dump($products_details);

  // Accessing total price details
  $bag_total = $allinfo['total_price_details']['bag_total'];
  $delivery_charges = $allinfo['total_price_details']['delivery_charges'];
  $grand_total = $allinfo['total_price_details']['grand_total'];

  // PRODUCTS STOCK
  $stock = $allinfo['stock_details']['stock'];
} else {
  echo "No data available";
}


// INVOICE NUMBER (DATETIME BASED)
$invoiceNumber = 'INV-' . date('Ymd') . '-' . generateUniqueIdentifier();
function generateUniqueIdentifier()
{
  $randomPart = str_pad(mt_rand(1, 9999), 3, '0', STR_PAD_LEFT);
  return $randomPart;
}


// TRACKING ID (RANDOM ALPHANUMERIC BASED)
$trackingID = 'TRK-' . generateRandomCode(8);
function generateRandomCode($length)
{
  $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $code;
}

// PAYMENT METHOD
$payment_method = "cod";
?>






<!--start page content-->
<div class="page-content">
  <!--start breadcrumb-->
  <div class="py-4 border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Checkout</a></li>
          <li class="breadcrumb-item active" aria-current="page">Payment Method</li>
        </ol>
      </nav>
    </div>
  </div>

  <!--end breadcrumb-->
  <h3 class="text-center text-danger">CASH ON DELIVERY (or) PAY WITH CARD only/-</h3>

  <?php
  // foreach($products_details_2 as $product_details) {
  //   $product_name = $product_details['product_name'];
  //   $product_price = $product_details['product_price'];
  //   $product_quantity = $product_details['quantity'];
  //   $product_size = $product_details['size'];
  // $table = "order_details";
  // $keys = "order_id , o_product_name , o_product_quantity , o_product_size ,  o_product_price";
  // $values = "'$user_id', '$product_name' , '$total_price' , '$total_products', '$tracking_id' , '$invoice_number'";
  // $insert_product_details = insertOrders($table, $keys, $values);
  // echo $product_name;
  // }
  ?>
  <!--start product details-->
  <section class="section-padding">
    <div class="container">
      <div class="d-flex align-items-center px-3 py-2 border mb-4">
        <div class="text-start">
          <h4 class="mb-0 h4 fw-bold">Select Payment Method</h4>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-12 col-lg-8 col-xl-8">
          <div class="card rounded-0 payment-method">
            <div class="row g-0">
              <div class="col-12 col-lg-4 bg-light">
                <div class="nav flex-column nav-pills">
                  <button class="nav-link rounded-0" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                    type="button"><i class="bi bi-cash-stack me-2"></i>Cash On Delivery</button>
                  <button class="nav-link rounded-0" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                    type="button"><i class="bi bi-paypal me-2"></i>Paypal</button>
                  <button class="nav-link active rounded-0" data-bs-toggle="pill" data-bs-target="#v-pills-messages"
                    type="button"><i class="bi bi-credit-card-2-back me-2"></i>Credit/Debit Card</button>
                  <button class="nav-link rounded-0 border-bottom-0" id="v-pills-settings-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-settings" type="button"><i class="bi bi-bank2 me-2"></i>Net
                    Banking</button>
                </div>
              </div>
              <div class="col-12 col-lg-8">
                <div class="tab-content p-3">
                  <!-- OFFLINE PAYMENT METHOD -->
                  <div class="tab-pane fade" id="v-pills-home">
                    <h5 class="mb-3 fw-bold">I would like to pay after product delivery</h5>
                    <form action="../controller/orders_handle.php" method="POST">

                      <!-- user id -->
                      <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

                      <!-- address id -->
                      <input type="hidden" name="address_id" value="<?php echo $address_id ?>">

                      <!-- total products -->
                      <input type="hidden" name="total_products" value="<?php echo $total_products ?>">

                      <!-- total price -->
                      <input type="hidden" name="grand_total" value="<?php echo $grand_total ?>">

                      <!-- invoice number -->
                      <input type="hidden" name="invoice_number" value="<?php echo $invoiceNumber ?>">

                      <!-- tracking id -->
                      <input type="hidden" name="tracking_id" value="<?php echo $trackingID ?>">

                      <!-- payment method -->
                      <input type="hidden" name="payment_method" value="<?php echo $payment_method ?>">

                      <!-- email -->
                      <input type="hidden" name="email_id" value="<?php echo $email ?>">

                      <!-- first name -->
                      <input type="hidden" name="fname" value="<?php echo $fname ?>">

                      <!-- products stock -->
                      <input type="hidden" name="stock" value="<?php echo $stock ?>">

                      <!-- product details -->
                      <input type="hidden" name="products_details"
                        value="<?php echo htmlentities(json_encode($products_details)); ?>">

                      <!-- place order button -->
                      <button type="submit" name="place_order_btn" class="btn btn-ecomm btn-dark w-100 py-3 px-5">Place
                        Order</button>
                    </form>
                  </div>
                  <!-- OFFLINE PAYMENT METHOD -->


                  <!-- PAYMENT WITH PAYPAL -->
                  <div class="tab-pane fade" id="v-pills-profile">
                    <div class="mb-3">
                      <p>Select your Paypal Account type</p>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                          value="option1">
                        <label class="form-check-label" for="inlineRadio1">Domestic</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                          value="option2">
                        <label class="form-check-label" for="inlineRadio2">International</label>
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="d-block"> <a href="javscript:;" class="btn btn-outline-dark btn-ecomm rounded-0"><i
                            class="bi bi-paypal me-2"></i>Login to my Paypal</a>
                      </div>
                    </div>
                    <div class="mb-3">
                      <p class="mb-0">Note: After clicking on the button, you will be directed to a secure gateway for
                        payment. After completing the payment process, you will be redirected back to the website to
                        view details of your order.</p>
                    </div>
                    <button type="button" class="btn btn-ecomm btn-dark w-100 py-3 px-5">Pay Now</button>
                  </div>
                  <!-- PAYMENT WITH PAYPAL ENDS-->



                  <!-- PAYMENT WITH CARD -->
                  <div class="tab-pane fade show active" id="v-pills-messages">
                    <form action="../controller/payment_gateway.php" id="payment-form" method="POST">
                      <!-- user id -->
                      <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

                      <!-- address id -->
                      <input type="hidden" name="address_id" value="<?php echo $address_id ?>">

                      <!-- total products -->
                      <input type="hidden" name="total_products" value="<?php echo $total_products ?>">

                      <!-- total price -->
                      <input type="hidden" name="grand_total" value="<?php echo $grand_total ?>">

                      <!-- invoice number -->
                      <input type="hidden" name="invoice_number" value="<?php echo $invoiceNumber ?>">

                      <!-- tracking id -->
                      <input type="hidden" name="tracking_id" value="<?php echo $trackingID ?>">

                      <!-- payment method -->
                      <input type="hidden" name="payment_method" value="<?php echo $payment_method ?>">

                      <!-- email -->
                      <input type="hidden" name="email_id" value="<?php echo $email ?>">

                      <!-- first name -->
                      <input type="hidden" name="fname" value="<?php echo $fname ?>">

                      <!-- products stock -->
                      <input type="hidden" name="stock" value="<?php echo $stock ?>">

                      <!-- product details -->
                      <input type="hidden" name="products_details"
                        value="<?php echo htmlentities(json_encode($products_details)); ?>">

                      <div id="error-message"></div>

                      <script src="https://checkout.stripe.com/checkout.js" id="card-element" class="stripe-button"
                        data-key="<?php echo $publish_key ?>" data-amount="<?php echo $grand_total * 100 ?>"
                        data-name="Please Enter Card Details" data-description="Please Proceed to shop the products"
                        data-currency="inr" data-email="<?php echo $email ?>">
                        </script>
                      <input type="hidden" id="submit-button" name="grand_total" value="<?php echo $grand_total; ?>">
                    </form>
                  </div>
                  <!-- PAYMENT WITH CARD ENDS-->



                  <!-- NET BANKING -->
                  <div class="tab-pane fade" id="v-pills-settings">
                    <div class="mb-3">
                      <p>Select your Bank</p>
                      <select class="form-select form-select-lg rounded-0" aria-label="Default select example">
                        <option selected="">--Please Select Your Bank--</option>
                        <option value="1">Bank Name 1</option>
                        <option value="2">Bank Name 2</option>
                        <option value="3">Bank Name 3</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-ecomm btn-dark w-100 py-3 px-5 mb-3">Pay Now</button>
                    <div class="">
                      <p class="mb-0">Note: After clicking on the button, you will be directed to a secure gateway for
                        payment. After completing the payment process, you will be redirected back to the website to
                        view details of your order.</p>
                    </div>
                  </div>
                  <!-- NET BANKING ENDS-->

                </div>
              </div>
            </div><!--end row-->
          </div>




        </div>
        <!-- PRODUCTS TOTAL PRICE -->
        <div class="col-12 col-lg-4 col-xl-4">
          <div class="card rounded-0 mb-3">
            <div class="card-body">
              <h5 class="fw-bold mb-4">Order Summary</h5>
              <div class="hstack align-items-center justify-content-between">
                <p class="mb-0">Bag Total</p>
                <p class="mb-0">
                  <?php echo $total_price; ?>
                </p>
              </div>
              <hr>
              <div class="hstack align-items-center justify-content-between">
                <p class="mb-0">Delivery</p>
                <p class="mb-0">
                  <?php $delivery_charges = 40; ?>
                <p class="mb-0">
                  <?php
                  if ($total_price > 0) {
                    echo $delivery_charges;
                  } else {
                    echo 0;
                  } ?>/-
                </p>
              </div>
              <hr>
              <div class="hstack align-items-center justify-content-between fw-bold text-content">
                <p class="mb-0">Total Amount</p>
                <p class="mb-0">
                  <?php if ($total_price > 0) {
                    $grand_total = $total_price + $delivery_charges;
                    echo $grand_total;
                  } else {
                    echo 0;
                  }
                  ?> /-
                </p>
              </div>
              <!-- GRAND TOTAL -->
              <input type="hidden" name="grand_total_price" value="<?php echo $grand_total; ?>">

            </div>
          </div>
        </div>
      </div><!--end row-->

    </div>
  </section>
  <!--start product details-->




</div>
<!--end page content-->


<!-- FOOTER -->
<?php include '../../includes/footer.php' ?>


<!--start cart-->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRight"
  aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header bg-section-2">
    <h5 class="mb-0 fw-bold" id="offcanvasRightLabel">8 items in the cart</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="cart-list">

      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/01.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/02.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/03.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/04.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/05.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/06.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/07.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/08.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/09.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
      <hr>
      <div class="d-flex align-items-center gap-3">
        <div class="bottom-product-img">
          <a href="product-details.php">
            <img src="../../assets/images/new-arrival/10.webp" width="60" alt="">
          </a>
        </div>
        <div class="">
          <h6 class="mb-0 fw-light mb-1">Product Name</h6>
          <p class="mb-0"><strong>1 X $59.00</strong>
          </p>
        </div>
        <div class="ms-auto fs-5">
          <a href="javascript:" class="link-dark"><i class="bi bi-trash"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="offcanvas-footer p-3 border-top">
    <div class="d-grid">
      <button type="button" class="btn btn-lg btn-dark btn-ecomm px-5 py-3">Checkout</button>
    </div>
  </div>

</div>
<!--end cat-->


<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
<!--End Back To Top Button-->

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

<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/plugins/slick/slick.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/loader.js"></script>
</body>

</html>