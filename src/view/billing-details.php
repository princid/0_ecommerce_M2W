<?php
session_start();
include '../../includes/header.php';

//NAVBAR  
include_once '/var/www/html/shoppingo_project/includes/nav.php';

// CONTROLLER FILE
include '../controller/orders_handle.php';

// FETCH PRODUCT PRICE DETAILS
// include '../controller/fetch_cart_data.php';


// FETCH PRODUCT TOTAL PRICE AND COUNT
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

?>


<!--start page content-->
<div class="page-content">

  <!--start breadcrumb-->
  <div class="py-4 border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">checkout</a></li>
          <li class="breadcrumb-item active" aria-current="page">Billing Details</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->


  <?php
  // PERSONAL DETAILS
  foreach ($data_container as $personal_info) {
    $fname = $personal_info['first_name'];
    $lname = $personal_info['last_name'];
    $email = $personal_info['email'];
    $mobile = $personal_info['mobile_number'];
  }


  // SHIPPING DETAILS
  foreach ($data_container_shipping as $shipping_details) {
    $pincode = $shipping_details['pin_code'];
    $city = $shipping_details['city'];
    $state = $shipping_details['state'];
    $address = $shipping_details['address'];
    $address_id = $shipping_details['id'];

  }


  // PRODUCT DETAILS
  foreach ($products_details_2 as $p_details) {
    // $total_products = $p_details['total_products'];
    $products_stock = $p_details['stock'];
    $product_name = $p_details['product_name'];
  }
  ?>

  <!--start product details-->
  <section class="section-padding">
    <div class="container">
      <div class="d-flex align-items-center px-3 py-2 border mb-4">
        <div class="text-start">
          <h4 class="mb-0 h4 fw-bold">Billing Details</h4>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-12 col-lg-8 col-xl-8">

          <h6 class="fw-bold mb-3 py-2 px-3 bg-light">Personal Details</h6>
          <div class="card rounded-0 mb-3">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12 col-lg-6">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" id="floatingFirstName"
                      value="<?php echo $fname; ?>" placeholder="First Name" disabled>
                    <label for="floatingFirstName">First Name</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" id="floatingLastName"
                      value="<?php echo $lname; ?>" placeholder="Last Name" disabled>
                    <label for="floatingLastName">Last Name</label>
                  </div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" id="floatingEmail" value="<?php echo $email; ?>"
                      placeholder="Email" disabled>
                    <label for="floatingEmail">Email</label>
                  </div>
                </div>

                <div class="col-12 col-lg-6">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" id="floatingMobileNo"
                      value="<?php echo $mobile; ?>" placeholder="Mobile No" disabled>
                    <label for="floatingMobileNo">Mobile No</label>
                  </div>
                </div>
              </div><!--end row-->
            </div>
          </div>


          <h6 class="fw-bold mb-3 py-2 px-3 bg-light">Shipping Details</h6>
          <div class="card rounded-0">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12 col-lg-12">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" value="<?php echo $address ?>"
                      id="floatingStreetAddress" placeholder="Street Address" disabled>
                    <label for="floatingStreetAddress">Street Address</label>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" value="<?php echo $pincode ?>"
                      id="floatingZipCode" placeholder="Zip Code" disabled>
                    <label for="floatingZipCode">Zip Code</label>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" value="<?php echo $city ?>" id="floatingCity"
                      placeholder="City" disabled>
                    <label for="floatingCity">City</label>
                  </div>
                </div>
                <div class="col-12 col-lg-4">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" value="<?php echo $state ?>" id="floatingCountry"
                      placeholder="State" disabled>
                    <label for="floatingCountry">State</label>
                  </div>
                </div>
              </div><!--end row-->
            </div>
          </div>


          <h6 class="fw-bold mb-3 py-2 px-3 bg-light">Other Details</h6>
          <div class="card rounded-0">
            <div class="card-body">
              <div class="row g-3">
                <div class="col-12 col-lg-4">

                  <!-- PRODUCTS COUNT -->
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" id="floatingZipCode"
                      value="<?php echo $total_products; ?>" placeholder="Zip Code" disabled>
                    <label for="floatingZipCode">Total Products</label>
                  </div>
                </div>


                <!-- PRODUCT DETAILS -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product Name</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Size</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($products_details_2 as $p_details_2) {
                      $p_name = $p_details_2['product_name'];
                      $quantity = $p_details_2['quantity'];
                      $size = $p_details_2['size'];
                      ?>
                      <tr>
                        <td>
                          <?php echo $p_name ?>
                        </td>
                        <td>
                          <?php echo $quantity ?>
                        </td>
                        <td>
                          <?php
                          if ($size == '' || $size == 0) {
                            echo "NA";
                          } else {
                            echo $size;
                          }
                          ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div><!--end row-->
            </div>
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

              <?php
              // Initialize an array to store all the information
              $orderDetails = array();
              // Personal Details
              $orderDetails['personal_info'] = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'mobile_number' => $mobile
              );
              // Shipping Details
              $orderDetails['shipping_details'] = array(
                'pin_code' => $pincode,
                'city' => $city,
                'state' => $state,
                'address' => $address,
                'id' => $address_id
              );
              // Other Details
              $orderDetails['other_details'] = array(
                'total_products' => $total_products
                // Add more details if needed
              );
              // Product Details
              $orderDetails['product_details'] = array();
              foreach ($products_details_2 as $p_details_2) {
                $orderDetails['product_details'][] = array(
                  'product_name' => $p_details_2['product_name'],
                  'quantity' => $p_details_2['quantity'],
                  'size' => ($p_details_2['size'] == '' || $p_details_2['size'] == 0) ? 'NA' : $p_details_2['size']
                );
              }
              // PRODUCTS_STOCK
              $orderDetails['stock_details'] = array(
                'stock' => $products_stock
                // Add more details if needed
              );
              // Total Price Details
              $orderDetails['total_price_details'] = array(
                'bag_total' => $total_price,
                'delivery_charges' => ($total_price > 0) ? $delivery_charges : 0,
                'grand_total' => ($total_price > 0) ? $total_price + $delivery_charges : 0
              );
              ?>
              <!-- GRAND TOTAL -->
              <input type="hidden" name="grand_total_price" value="<?php echo $grand_total; ?>">
              <div class="d-grid mt-4">
                <a href="./payment-method.php?allinfo=<?php echo urlencode(json_encode($orderDetails)); ?>"
                  class="btn btn-dark btn-ecomm py-3 px-5">Continue</a>

              </div>
            </div>
          </div>
        </div>
        <!-- PRODUCTS TOTAL PRICE ENDS-->
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


<!-- JavaScript files -->
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/plugins/slick/slick.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/loader.js"></script>


</body>

</html>