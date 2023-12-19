<?php

session_start();
if (isset($_SESSION['user_login'])) {

  include '../../includes/header.php';

  // NAVBAR dsc
  include_once '../../includes/nav.php';

  //CONTROLLER FILE
  include '../controller/user_address_handle.php';


  // FOR PRODUCT TOTAL PRICE
  include '../controller/fetch_cart_data.php';


  // LOGGED IN USER ID
  $user_id = $_SESSION['user_id'];


  // FETCH USER ADDRESS
  $fetch_cart_query = "SELECT * FROM `user_address` WHERE user_id = $user_id AND isDeleted = 0 ";
  $execute = mysqli_query($conn, $fetch_cart_query);
  $count = mysqli_num_rows($execute);
  while ($row = mysqli_fetch_assoc($execute)) {
    $address_container[] = $row;
  }

  
  // TOTAL PRODUCTS
  $total_products_query = "SELECT * FROM `products_cart` WHERE user_id = $user_id ";
  $execute_products_query = mysqli_query($conn, $total_products_query);
  $total_products = mysqli_num_rows($execute_products_query);
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
            <li class="breadcrumb-item active" aria-current="page">Address</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->
    <!--start product details-->
    <section class="section-padding">
      <div class="container">
        <div class="d-flex align-items-center px-3 py-2 border mb-4">
          <div class="text-start">
            <h4 class="mb-0 h4 fw-bold">Select Delivery Address (
              <?php echo $count; ?> Addresses Found)
            </h4>
          </div>
        </div>

        <form action="../controller/orders_handle.php?user_id=<?php echo $user_id; ?>" method="POST">
          <div class="row g-4">
            <div class="col-12 col-lg-8 col-xl-8">
              <?php
              foreach ($address_container as $address_data) {
                $address_id = $address_data['id'];
                ?>
                <div class="card rounded-0 mb-3">
                  <div class="card-body">
                    <div class="d-flex flex-column flex-xl-row gap-3">
                      <div class="address-info form-check flex-grow-1">

                        <!-- RADIO BUTTON -->
                        <input class="form-check-input" type="radio" name="selectedAddress" id="flexRadioDefault1"
                          value="<?php echo $address_id; ?>" checked >

                        <!-- USER ID -->
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

                        <!-- TOTAL PRODUCTS -->
                        <input type="hidden" name="total_products" value="<?php echo $total_products; ?>">


                        <label class="form-check-label" for="flexRadioDefault1">
                          <span class="fw-bold mb-0 h5">
                            <?php echo $address_data['pin_code']; ?>
                          </span><br>
                          <?php echo $address_data['address'] ?> <br>
                          <?php echo $address_data['city'] ?> ,
                          <?php echo $address_data['state'] ?> <br>
                          <?php echo "Landmark : " . $address_data['landmark'] ?> <br>
                          Mobile: <span class="text-dark fw-bold">
                            <?php echo $address_data['contact_number'] ?>
                          </span>
                        </label>
                      </div>
                      <div class="d-none d-xl-block vr"></div>
                    </div>
                  </div>
                </div>
              <?php }
              ?>
            </div>

            
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

                  <div class="d-grid mt-4">
                    <button type="submit" name="orders_address_btn"
                      class="btn btn-dark btn-ecomm py-3 px-5">Continue</button>
                    <!-- <a href="./billing-details.php" > -->
                  </div>
                </div>
              </div>
            </div>
          </div><!--end row-->
        </form>

        <div class="card rounded-0">
          <div class="card-body">
            <button type="button" class="btn btn-outline-dark btn-ecomm" data-bs-toggle="modal"
              data-bs-target="#NewAddress">Add New Address</button>
          </div>
        </div>
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

  <!-- New Address Modal -->
  <div class="modal" id="NewAddress" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Add New Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mt-4">
            <h6 class="fw-bold mb-3">Address</h6>

            <!-- FORM STARTS -->
            <form action="../controller/user_address_handle.php" method="POST" id="address_form">

              <!-- pin code -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="pin_code" id="floatingPinCode"
                  placeholder="Pin Code">
                <label for="floatingPinCode">Pin Code</label>
                <span class="error_address_form" id="pin_code_error"></span>
              </div>

              <!-- address -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="address" id="address"
                  placeholder="Address (House No, Building, Street, Area)">
                <label for="address">Address</label>
                <span class="error_address_form" id="address_error"></span>
              </div>

              <!-- mobile number -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="contact" id="contact"
                  placeholder="Enter Mobile Number">
                <label for="address">Contact Number</label>
                <span class="error_address_form" id="contact_error"></span>
              </div>

              <!-- landmark -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="landmark" id="landmark" placeholder="landmark">
                <label for="landmark">Landmark</label>
                <span class="error_address_form" id="landmark_error"></span>
              </div>

              <!-- city/district -->
              <div class="row">
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="city_district" id="city_district"
                      placeholder="City / District">
                    <label for="city_district">City / District</label>
                    <span class="error_address_form" id="city_error"></span>
                  </div>
                </div>

                <!-- state -->
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="state" id="state" placeholder="State">
                    <label for="state">State</label>
                    <span class="error_address_form" id="state_error"></span>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <div class="d-grid w-100">
                  <button type="submit" name="address_btn" class="btn btn-dark py-3 px-5 btn-ecomm">Add Address</button>
                </div>
              </div>
            </form>
            <!-- FORM ENDS -->


          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end New Address Modal -->




  <!-- Edit Address Modal -->
  <div class="modal" id="EditAddress<?= $user_id ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
          if (!empty($address_container)) {
            foreach ($address_container as $address_data) {
              $address_id = $address_data['user_id'];
              $user_address_id = $address_data['id'];
            }
          }
          ?>
          <!-- FORM STARTS -->
          <form action="../controller/edit_address_handle.php" method="POST" id="edit_address">
            <div class="mt-4">
              <h6 class="fw-bold mb-3">Address</h6>

              <!-- input field to send id  -->
              <input type="hidden" value="<?php echo $user_address_id ?>" name="user_specific_id">

              <!-- PIN CODE -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="pin_code" id="floatingPinCode2"
                  placeholder="Pin Code" value="<?php echo $address_data['pin_code']; ?>">
                <label for="floatingPinCode2">Pin Code</label>
              </div>

              <!-- ADDRESS -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="address" id="floatingAddress2"
                  placeholder="Address (House No, Building, Street, Area)"
                  value="<?php echo $address_data['address']; ?>">
                <label for="floatingAddress2">Address</label>
              </div>

              <!-- LANDMARK -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="landmark" id="floatingLocalityTown2"
                  value="<?php echo $address_data['landmark']; ?>" placeholder="Street Name">
                <label for="floatingLocalityTown2">Landmark</label>
              </div>

              <!-- CONTACT NUMBER -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="landmark" id="floatingLocalityTown2"
                  value="<?php echo $address_data['contact_number']; ?>" placeholder="Mobile Number">
                <label for="floatingLocalityTown2">Contact Number</label>
              </div>

              <div class="row">
                <!-- CITY -->
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="city" id="floatingCity2"
                      placeholder="City / District" value="<?php echo $address_data['city']; ?>">
                    <label for="floatingAddress2">City / District</label>
                  </div>
                </div>

                <!-- STATE -->
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="state" id="floatingState2" placeholder="State"
                      value="<?php echo $address_data['state']; ?>">
                    <label for="floatingState2">State</label>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <div class="d-grid w-100">
            <button type="submit" name="edit_address_btn" class="btn btn-dark py-3 px-5 btn-ecomm">Save Address</button>
          </div>
        </div>

        </form>
        <!-- FORM ENDS -->
      </div>
    </div>
  </div>
  <!-- end Edit Address Modal -->



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

<?php } else {
  header("Location: ./login.php");
}
?>