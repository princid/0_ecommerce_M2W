<?php
session_start();
include '../../includes/header.php'; ?>

<!-- NAVBAR -->
<?php include_once '../../includes/nav.php' ?>


<!--start page content-->
<div class="page-content">


  <!--start breadcrumb-->
  <div class="py-4 border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Authentication</a></li>
          <li class="breadcrumb-item active" aria-current="page">Register</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->


  <!--start product details-->
  <section class="section-padding">
    <div class="container">

      <div class="row">
        <div class="col-12 col-lg-6 col-xl-5 col-xxl-5 mx-auto">
          <div class="card rounded-0">
            <div class="card-body p-4">
              <h4 class="mb-0 fw-bold text-center">Registration</h4>
              <hr>
              <div class="social-login mb-4">
              <form action="../controller/signupFormHandle.php" method="POST" id="signupForm">
                <?php
                $errors = [];
                if (isset($_GET['errors'])) {
                  $errors = $_GET['errors'];
                }

                // ALERT
                if (isset($_SESSION['email_fail'])) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $_SESSION['email_fail'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                  unset($_SESSION['email_fail']);
                }
                ?>


                <div class="row g-4">
                  <div class="col-12">
                    <label for="username" class="form-label">Name</label>
                    <input type="text" name="username" class="form-control rounded-0" id="username">
                    <span class="error-signupForm" id="usernameError"></span>
                  </div>
                  <div class="col-12">
                    <label for="mobile_number" class="form-label">Mobile</label>
                    <input type="text" name="mobile_number" class="form-control rounded-0" id="mobile_number">
                    <span class="error-signupForm" id="mobileError"></span>
                  </div>
                  <div class="col-12">
                    <label for="useremail" class="form-label">Email ID</label>
                    <input type="email" name="useremail" class="form-control rounded-0" id="useremail">
                    <span class="error-signupForm" id="emailError">
                    </span>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control rounded-0" id="password">
                    <span class="error-signupForm" id="passwordError">
                    </span>
                  </div>
                  <div class="col-12">
                    <hr class="my-0">
                  </div>
                  <div class="col-12">
                    <button type="submit" name="signup_btn" class="btn btn-dark rounded-0 btn-ecomm w-100">Sign
                      Up</button>
                  </div>
                  <div class="col-12 text-center">
                    <p class="mb-0 rounded-0 w-100">Already have an account? <a href="./login.php"
                        class="text-danger">Sign In</a></p>
                  </div>
                </div><!---end row-->
                <?php //} ?>
              </form>

              <div class="row mt-5 g-4">
                <?php
                ?>
              </div>

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


<!-- JavaScript files -->
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/plugins/slick/slick.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/loader.js"></script>

<script src="../../assets/js/validate-forms.js"></script>


</body>

</html>