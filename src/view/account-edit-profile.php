<?php
session_start();
if (isset($_SESSION['user_login'])) {
  // HEADER 
  include '../../includes/header.php';

  // NAVBAR 
  include_once '../../includes/nav.php';

  //  CONTROLLER FILE
  require '../controller/user_data_handle.php';
  ?>

  <style>
    .error-editDetailsForm {
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

    <div class="container">
      <div class="row text-center">
        <div class="col">
          <?php
          // ALERTS
          if (isset($_SESSION['admin_login'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              ' . $_SESSION['admin_login'] . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            unset($_SESSION['admin_login']);
          }
          ?>
        </div>
      </div>
    </div>
    <!--start product details-->
    <section class="section-padding">
      <div class="container">
        <div class="d-flex align-items-center px-3 py-2 border mb-4">
          <div class="text-start">
            <h4 class="mb-0 h4 fw-bold">Account - Edit Profile</h4>
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
                    <a href="account-edit-profile.php" class="list-group-item active"><i
                        class="bi bi-pencil me-2"></i>Edit Profile</a>
                    <a href="account-saved-address.php" class="list-group-item"><i class="bi bi-pin-map me-2"></i>Saved
                      Address</a>
                    <a href="wishlist.php" class="list-group-item"><i class="bi bi-suit-heart me-2"></i>Wishlist</a>
                    <a href="../controller/logout.php" class="list-group-item"><i class="bi bi-power me-2"></i>Logout</a>
                  </div>
                </div>
              </div>
            </nav>
          </div>
          <div class="col-12 col-xl-7">
            <div class="card rounded-0">
              <div class="card-body p-lg-5">
                <h5 class="mb-0 fw-bold">Edit Details
                  <?php
                  // ALERTS
                  if (isset($_SESSION['user_updated'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              ' . $_SESSION['user_updated'] . '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                    unset($_SESSION['user_updated']);
                  }




                  if (isset($_SESSION['updation_fail'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              ' . $_SESSION['updation_fail'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                    unset($_SESSION['updation_fail']);
                  }
                  ?>
                </h5>
                <hr>


                <!-- EDIT DETAILS FORM -->
                <form action="../controller/user_data_handle.php" method="post" name="editDetailsForm"
                  id="editDetailsForm" onsubmit="return validateUserEditForm()">
                  <div class="row row-cols-1 g-3">
                    <!-- USER NAME -->
                    <div class="col-12">
                      <label for="username" class="form-label">User Name</label>
                      <input type="text" name="username" class="form-control rounded-0" id="username"
                        placeholder="User Name" value="<?php echo $data_container[0]['username']; ?>" disabled >
                      <span class="error-editDetailsForm" id="usernameError"></span>
                    </div>

                    <!-- FIRST NAME -->
                    <div class="col-12">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control rounded-0" id="firstname"
                        placeholder="First Name" value="<?php echo $data_container[0]['first_name']; ?>">
                      <span class="error-editDetailsForm" id="firstnameError"></span>
                    </div>

                    <!-- LAST NAME -->
                    <div class="col-12">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control rounded-0" id="lastname"
                        placeholder="Last Name" value="<?php echo $data_container[0]['last_name']; ?>">
                      <span class="error-editDetailsForm" id="lastnameError"></span>
                    </div>

                    <!-- MOBILE NUMBER -->
                    <div class="col-12">
                      <label for="floatingInputNumber" class="form-label">Mobile Number</label>
                      <input type="text" name="mobile_number" class="form-control rounded-0" id="floatingInputNumber"
                        placeholder="Mobile Number" value="<?php echo $data_container[0]['mobile_number']; ?>">
                      <span class="error-editDetailsForm" id="mobileNumberError"></span>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-12">
                      <label for="floatingInputEmail" class="form-label">Email</label>
                      <input type="text" name="email" class="form-control rounded-0" id="floatingInputEmail"
                        placeholder="Email" value="<?php echo $data_container[0]['email']; ?>" disabled>
                      <span class="error-editDetailsForm" id="emailError"></span>
                    </div>

                    <!-- GENDER -->
                    <div class="col-12 mb-2">
                      <label for="gender" class="form-label">Gender</label><br>
                      <?php
                      $savedGender = $data_container[0]['gender'];
                      $genders = [
                        ['id' => 'male', 'label' => 'Male', 'value' => '1'],
                        ['id' => 'female', 'label' => 'Female', 'value' => '0'],
                      ];
                      foreach ($genders as $gender) {
                        $checked = ($savedGender == $gender['value']) ? 'checked' : '';
                        echo '<input class="btn-check text-dark ml-4" type="radio" name="gender" id="' . $gender['id'] . '" value="' .
                          $gender['value'] . '" ' . $checked . '>';
                        echo '<label style="font-size:19px;" class="form-check-label btn" for="' . $gender['id'] . '">' .
                          $gender['label'] . '</label>';
                      }
                      ?>
                      <span class="error-editDetailsForm" id="genderError"></span>
                    </div>

                  </div>
                  <!-- DATE OF BIRTH -->
                  <div class="col-12 my-3">
                    <label for="floatingInputDOB" class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control rounded-0" max="2015-01-01" id="dob"
                      value="<?php echo $data_container[0]['dob']; ?>">
                    <span class="error-editDetailsForm" id="dobError"></span>
                  </div>

                  <!-- BUTTONS -->
                  <div class="col-12">
                    <button type="submit" name="edit_user_btn" class="btn btn-dark py-3 btn-ecomm w-100">Save
                      Details</button>
                  </div>
                  <!-- <div class="col-12">
                    <button type="button" class="btn btn-outline-dark py-3 btn-ecomm w-100" data-bs-toggle="modal"
                      data-bs-target="#ChangePasswordModal">Change Password</button>
                  </div> -->
              </div>
              </form>
              <!-- EDIT DETAILS FORM ENDS-->
            </div>
          </div>
        </div>
      </div><!--end row-->
  </div>
  </section>
  <!--start product details-->


  <!-- Change Password Modal -->
  <div class="modal" id="ChangePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content rounded-0">
        <div class="modal-body">
          <h5 class="fw-bold mb-3">Change Password</h5>
          <hr>
          <form>
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-0" id="floatingInputOldPass" placeholder="Old Password">
              <label for="floatingInputOldPass">Old Password</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-0" id="floatingInputNewPass" placeholder="New Password">
              <label for="floatingInputNewPass">New Password</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-0" id="floatingInputConPass" placeholder="Confirm Password">
              <label for="floatingInputConPass">Confirm Password</label>
            </div>
            <div class="d-grid gap-3 w-100">
              <button type="button" class="btn btn-dark py-3 btn-ecomm">Change</button>
              <button type="button" class="btn btn-outline-dark py-3 btn-ecomm" data-bs-dismiss="modal"
                aria-label="Close">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- end Change Password Modal -->


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
  <script src="../../assets/js/account_edit_profile.js"></script>


  </body>

  </html>

<?php } else {
  header("Location: ./login.php");
}
?>