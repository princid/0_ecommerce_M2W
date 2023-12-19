<?php
session_start();
// HEADER 
include '../../includes/header.php';

// NAVBAR
include_once '../../includes/nav.php';
?>

<style>
  .error-contact_us_form {
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
          <li class="breadcrumb-item"><a href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->


  <!--start product details-->
  <section class="section-padding">
    <div class="container">

      <div class="separator mb-3">
        <div class="line"></div>
        <h3 class="mb-0 h3 fw-bold">Find Us Map</h3>
        <div class="line"></div>
      </div>

      <div class="border p-3">
        <iframe class="w-100"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.31784765278!2d76.68604817631275!3d30.709463674595433!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fef14829cd74d%3A0x2e82a0ccfea177ea!2sMind2Web!5e0!3m2!1sen!2sin!4v1702550524274!5m2!1sen!2sin"
          height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="separator my-3">
        <div class="line"></div>
        <h3 class="mb-0 h3 fw-bold">Why Choose Us</h3>
        <div class="line"></div>
      </div>

      <div class="row g-4">
        <div class="col-xl-8">
          <div class="p-4 border">
            <?php
            // AFTER CONTACT US MESSAGE SEND
            if (isset($_SESSION['contact_form_success'])) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              ' . $_SESSION['contact_form_success'] . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
              unset($_SESSION['contact_form_success']);
            }

            // SERVER SIDE VALIDATION MESSAGE IF FORM IS NOT COMPLETELY FILLED
            if (isset($_SESSION['server_validation_contactForm'])) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $_SESSION['server_validation_contactForm'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
              unset($_SESSION['server_validation_contactForm']);
            }
            ?>
            <form action="../controller/contact_us_handle.php" id="contact_us_form" method="POST">
              <div class="form-body">
                <h4 class="mb-0 fw-bold">Drop Us a Line</h4>
                <div class="my-3 border-bottom"></div>
                <div class="mb-3">
                  <label class="form-label">Enter Your Name</label>
                  <input type="text" name="name" id="name" class="form-control rounded-0">
                  <span class="error-contact_us_form" id="nameError">
                  </span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Enter Email</label>
                  <input type="text" name="email" id="email" class="form-control rounded-0">
                  <span class="error-contact_us_form" id="emailError">
                  </span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="text" name="number" id="number" class="form-control rounded-0">
                  <span class="error-contact_us_form" id="numberError">
                  </span>
                </div>
                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea class="form-control rounded-0" id="message" name="message" rows="4" cols="4"></textarea>
                  <span class="error-contact_us_form" id="messageError">
                  </span>
                </div>
                <div class="mb-0">
                  <button type="submit" name="contact_us_btn" class="btn btn-dark btn-ecomm">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="p-3 border">
            <div class="address mb-3">
              <h5 class="mb-0 fw-bold">Address</h5>
              <p class="mb-0 font-12">123 Street Name, City, Australia</p>
            </div>
            <hr>
            <div class="phone mb-3">
              <h5 class="mb-0 fw-bold">Phone</h5>
              <p class="mb-0 font-13">Toll Free (123) 472-796</p>
              <p class="mb-0 font-13">Mobile : +91-9910XXXX</p>
            </div>
            <hr>
            <div class="email mb-3">
              <h5 class="mb-0 fw-bold">Email</h5>
              <p class="mb-0 font-13">mail@example.com</p>
            </div>
            <hr>
            <div class="working-days mb-0">
              <h5 class="mb-0 fw-bold">Working Days</h5>
              <p class="mb-0 font-13">Mon - FRI / 9:30 AM - 6:30 PM</p>
            </div>
          </div>
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

<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
<!--End Back To Top Button-->


<!-- JavaScript files -->
<script src="../../assets/js/contact_us_form.js" ></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/plugins/slick/slick.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/loader.js"></script>


</body>

</html>