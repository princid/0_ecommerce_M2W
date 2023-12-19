<?php
session_start();
if (isset($_SESSION['user_login'])) {


  include '../../includes/header.php';

  // NAVBAR
  include_once '../../includes/nav.php';

  //  CONTROLLER FILE
  include '../controller/user_address_handle.php';
  ?>

  <style>
    .error_address_form {
      color: red;
    }
  </style>

  <!--start page content-->
  <div class="page-content">


    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <?php

    // ALERTS 
    // FOR ADDRESS UPDATION
    if (isset($_SESSION['user_address_update_success'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['user_address_update_success'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['user_address_update_success']);
    }
    if (isset($_SESSION['user_address_update_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['user_address_update_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['user_address_update_fail']);
    }

    // FOR DELETING ADDRESS
    if (isset($_SESSION['saved_address'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['saved_address'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['saved_address']);
    }
    if (isset($_SESSION['save_address_failed'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['save_address_failed'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['save_address_failed']);
    }
    ?>


    <!--start product details-->
    <section class="section-padding">
      <div class="container">
        <div class="d-flex align-items-center px-3 py-2 border mb-4">
          <div class="text-start">
            <h4 class="mb-0 h4 fw-bold">Account - Addresses</h4>
          </div>
        </div>
        <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y"
          data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter"><span><i
              class="bi bi-person me-2"></i>Account</span></div>
        <div class="row">
          <div class="col-12 col-xl-3 filter-column">
            <nav class="navbar navbar-expand-xl flex-wrap p-0">
              <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
                aria-labelledby="offcanvasNavbarFilterLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title mb-0 fw-bold text-uppercase" id="offcanvasNavbarFilterLabel">Account</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
                </div>
                <div class="offcanvas-body account-menu">
                  <div class="list-group w-100 rounded-0">
                    <a href="account-dashboard.php" class="list-group-item"><i
                        class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a href="account-orders.php" class="list-group-item"><i class="bi bi-basket3 me-2"></i>Orders</a>
                    <a href="account-profile.php" class="list-group-item"><i class="bi bi-person me-2"></i>Profile</a>
                    <a href="account-edit-profile.php" class="list-group-item"><i class="bi bi-pencil me-2"></i>Edit
                      Profile</a>
                    <a href="account-saved-address.php" class="list-group-item active"><i
                        class="bi bi-pin-map me-2"></i>Saved Address</a>
                    <a href="wishlist.php" class="list-group-item"><i class="bi bi-suit-heart me-2"></i>Wishlist</a>
                    <a href="../controller/logout.php" class="list-group-item"><i class="bi bi-power me-2"></i>Logout</a>
                  </div>
                </div>
              </div>
            </nav>
          </div>

          <div class="col-12 col-xl-9">
            <?php
            // ALERT
            if (isset($_SESSION['saved_address'])) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     ' . $_SESSION['saved_address'] . '
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
              unset($_SESSION['saved_address']);
            }



            if (isset($_SESSION['save_address_failed'])) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     ' . $_SESSION['save_address_failed'] . '
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
              unset($_SESSION['save_address_failed']);
            }
            ?>
            <div class="card rounded-0">
              <div class="card-header bg-light">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                    <h5 class="fw-bold mb-0">Saved Address</h5>
                  </div>
                </div>
              </div>

              <div class="card rounded-0 mb-3">
                <div class="card-body">
                  <?php
                  // DISPLAY USER ADDRESS
                  if (!empty($data_container)) {
                    foreach ($data_container as $address_data) {
                      $address_id = $address_data['user_id'];
                      $user_address_id = $address_data['id'];
                      ?>
                      <div class="card rounded-0 mb-3">
                        <div class="card-body">
                          <div class="d-flex flex-column flex-xl-row gap-3">
                            <div class="address-info form-check flex-grow-1">
                              <!-- Display address details here -->
                              <label class="form-check-label">
                                <span class="fw-bold mb-0 h5">
                                  <?php echo $_SESSION['username']; ?>
                                </span><br>
                                <br>
                                <?php echo '<b>Address:=></b>' . $address_data['address']; ?><br>
                                <?php echo '<b>City:=></b>' . $address_data['city'] ?> <br>
                                <?php echo '<b>Pin Code:=></b>' . $address_data['pin_code'] ?><br>
                                <?php echo '<b>Landmark:=></b>' . $address_data['landmark']; ?><br>
                                Mobile: <span class="text-dark fw-bold">
                                  <?php echo $address_data['contact_number']; ?>
                                </span>
                              </label>
                            </div>
                            <div class="d-none d-xl-block vr"></div>
                            <div class="d-grid gap-2 align-self-start align-self-xl-center">


                              <!-- BUTTON TO REMOVE ADDRESS -->
                              <form action="../controller/edit_address_handle.php" method="POST">
                                <input type="hidden" name="address_id" value="<?php echo $user_address_id ?>">
                                <button type="submit" name="delete_address_btn"
                                  class="btn btn-outline-dark px-5 btn-ecomm">Remove</button>
                              </form>


                              <button type="button" class="btn btn-outline-dark px-5 btn-ecomm edit-address-btn"
                                data-bs-toggle="modal" data-bs-target="#EditAddressModal"
                                data-address-id="<?php echo $address_data['id']; ?>"
                                data-pin-code="<?php echo $address_data['pin_code']; ?>"
                                data-address="<?php echo $address_data['address']; ?>"
                                data-landmark="<?php echo $address_data['landmark']; ?>"
                                data-city="<?php echo $address_data['city']; ?>"
                                data-state="<?php echo $address_data['state']; ?>"
                                data-contact="<?php echo $address_data['contact_number']; ?>" onclick="openEditModal(this)">
                                Edit
                              </button>





                            </div>
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                  } else {
                    echo '<p>No addresses found for the user.</p>';
                  } ?>
                </div>
                <div class="card rounded-0">
                  <div class="card-body">
                    <button type="button" class="btn btn-outline-dark btn-ecomm" data-bs-toggle="modal"
                      data-bs-target="#NewAddress<?= $user_address_id; ?>">Add New Address</button>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div><!--end row-->
      </div>
    </section>
    <!--start product details-->


    <!-- filter Modal -->
    <div class="modal" id="FilterOrders" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-0">
          <div class="modal-header">
            <h5 class="modal-title fw-bold">Filter Orders</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6 class="mb-3 fw-bold">Status</h6>
            <div class="status-radio d-flex flex-column gap-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                  All
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                  On the way
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                <label class="form-check-label" for="flexRadioDefault3">
                  Delivered
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                <label class="form-check-label" for="flexRadioDefault4">
                  Cancelled
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
                <label class="form-check-label" for="flexRadioDefault5">
                  Returned
                </label>
              </div>
            </div>
            <hr>
            <h6 class="mb-3 fw-bold">Time</h6>
            <div class="status-radio d-flex flex-column gap-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault6" checked>
                <label class="form-check-label" for="flexRadioDefault6">
                  Anytime
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault7">
                <label class="form-check-label" for="flexRadioDefault7">
                  Last 30 days
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault8">
                <label class="form-check-label" for="flexRadioDefault8">
                  Last 6 months
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioTime" id="flexRadioDefault9">
                <label class="form-check-label" for="flexRadioDefault9">
                  Last year
                </label>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <div class="d-flex align-items-center gap-3 w-100">
              <button type="button" class="btn btn-outline-dark btn-ecomm w-50">Clear Filters</button>
              <button type="button" class="btn btn-dark btn-ecomm w-50">Apply</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end Filters Modal -->


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
  <div class="modal" id="NewAddress<?= $user_address_id ?>" tabindex="-1">
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
  <div class="modal" id="EditAddressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-0">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Address</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
          if (!empty($data_container)) {
            foreach ($data_container as $address_data) {
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
              <input type="hidden" name="user_specific_id">

              <!-- PIN CODE -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="pin_code" id="floatingPinCode2"
                  placeholder="Pin Code" value="<?php echo $address_data['pin_code']; ?>">
                <label for="floatingPinCode2">Pin Code</label>
                <span class="error_edit_address" id="pin_code_error2"></span>
              </div>

              <!-- ADDRESS -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="address" id="floatingAddress2"
                  placeholder="Address (House No, Building, Street, Area)"
                  value="<?php echo $address_data['address']; ?>">
                <label for="floatingAddress2">Address</label>
                <span class="error_edit_address" id="address_error2"></span>
              </div>

              <!-- LANDMARK -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="landmark" id="floatingLandmark2"
                  value="<?php echo $address_data['landmark']; ?>" placeholder="Street Name">
                <label for="floatingLandmark2">Landmark</label>
                <span class="error_edit_address" id="landmark_error2"></span>
              </div>


              <!-- CONTACT NUMBER -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control rounded-0" name="contact" id="floatingContact2"
                  value="<?php echo $address_data['contact_number']; ?>" placeholder="Mobile Number">
                <label for="floatingContact2">Contact Number</label>
                <span class="error_edit_address" id="contact_error2"></span>
              </div>

              <div class="row">
                <!-- CITY -->
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="city" id="floatingCity2"
                      placeholder="City / District" value="<?php echo $address_data['city']; ?>">
                    <label for="floatingCity2">City / District</label>
                    <span class="error_edit_address" id="city_error2"></span>
                  </div>
                </div>

                <!-- STATE -->
                <div class="col">
                  <div class="form-floating">
                    <input type="text" class="form-control rounded-0" name="state" id="floatingState2" placeholder="State"
                      value="<?php echo $address_data['state']; ?>">
                    <label for="floatingState2">State</label>
                    <span class="error_edit_address" id="state_error2"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="d-grid w-100">
                <button type="submit" name="edit_address_btn" class="btn btn-dark py-3 px-5 btn-ecomm">Save
                  Address</button>
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
    <!-- <script src="../../assets/js/account-edit-address.js"></script> -->
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/plugins/slick/slick.min.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/loader.js"></script>
    <script src="../../assets/js/address_form.js"></script>

    <script>

    </script>


    <!-- SCRIPT TAG FOR EDIT ADDRESS MODAL -->
    <script>
      function editAddress(button) {
        // Retrieve data attributes from the button
        var addressId = button.getAttribute('data-address-id');
        var pinCode = button.getAttribute('data-pin-code');
        var address = button.getAttribute('data-address');
        var landmark = button.getAttribute('data-landmark');
        var city = button.getAttribute('data-city');
        var state = button.getAttribute('data-state');
        // Populate the modal fields with the retrieved data
        document.getElementById('floatingPinCode2').value = pinCode;
        document.getElementById('floatingAddress2').value = address;
        document.getElementById('floatingLocalityTown2').value = landmark;
        document.getElementById('floatingCity2').value = city;
        document.getElementById('floatingState2').value = state;
        // Open the modal
        var editAddressModal = new bootstrap.Modal(document.getElementById('EditAddress'));
        editAddressModal.show();
      }
      // Attach click event handler to all "Edit" buttons with the specified class
      document.querySelectorAll('.edit-address-btn').forEach(function (button) {
        button.addEventListener('click', function () {
          editAddress(this);
        });
      });
    </script>


    <script>
      function openEditModal(button) {
        var modal = document.getElementById('EditAddressModal');
        var userSpecificId = button.getAttribute('data-address-id');
        var pinCode = button.getAttribute('data-pin-code');
        var address = button.getAttribute('data-address');
        var landmark = button.getAttribute('data-landmark');
        var city = button.getAttribute('data-city');
        var state = button.getAttribute('data-state');
        var contact = button.getAttribute('data-contact');

        // Set values in the modal
        modal.querySelector('[name="user_specific_id"]').value = userSpecificId;
        modal.querySelector('[name="pin_code"]').value = pinCode;
        modal.querySelector('[name="address"]').value = address;
        modal.querySelector('[name="landmark"]').value = landmark;
        modal.querySelector('[name="city"]').value = city;
        modal.querySelector('[name="state"]').value = state;
        modal.querySelector('[name="contact"]').value = contact;

        // Open the modal
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
      }
    </script>


    <!-- <script>
      document.getElementById('edit_address').addEventListener('submit', function (e) {
        e.preventDefault();
        let valid = true;

        // Reset error messages
        document.querySelectorAll('.error_edit_address').forEach(function (error) {
          error.textContent = '';
        });

        // Validate Pin Code
        const pinCode = document.getElementById('floatingPinCode2').value;
        if (!pinCode) {
          document.getElementById('pin_code_error2').textContent = '*Pin Code is required';
          valid = false;
        }

        // Validate Address
        const address = document.getElementById('floatingAddress2').value;
        if (!address) {
          document.getElementById('address_error2').textContent = '*Address is required';
          valid = false;
        }

        // Validate Landmark
        const landmark = document.getElementById('floatingLandmark2').value;
        if (!landmark) {
          document.getElementById('landmark_error2').textContent = '*Landmark is required';
          valid = false;
        }

        // Validate Contact Number
        const contact = document.getElementById('floatingContact2').value;
        if (!contact) {
          document.getElementById('contact_error2').textContent = '*Contact Number is required';
          valid = false;
        }

        // Validate City/District
        const city = document.getElementById('floatingCity2').value;
        if (!city) {
          document.getElementById('city_error2').textContent = '*City/District is required';
          valid = false;
        }

        // Validate State
        const state = document.getElementById('floatingState2').value;
        if (!state) {
          document.getElementById('state_error2').textContent = '*State is required';
          valid = false;
        }

        if (valid) {
          this.submit();
        }
      });

    </script> -->




    </body>

    </html>

  <?php } else {
  header("Location: ./login.php");
}
?>