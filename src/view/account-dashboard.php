<?php
session_start();
if (isset($_SESSION['user_login'])) {
  // HEADER
  include '../../includes/header.php';

  //  NAVBAR 
  include_once '../../includes/nav.php';

  $user_mail = $_SESSION['email'];
  ?>


  <!--start page content-->
  <div class="page-content">


    <!--start breadcrumb-->
    <div class="py-4 border-bottom">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop With Grid</li>
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
            <h4 class="mb-0 h4 fw-bold">Account - Dashboard</h4>
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
                    <a href="account-dashboard.php" class="list-group-item active"><i
                        class="bi bi-house-door me-2"></i>Dashboard</a>
                    <a href="account-orders.php" class="list-group-item"><i class="bi bi-basket3 me-2"></i>Orders</a>
                    <a href="account-profile.php" class="list-group-item"><i class="bi bi-person me-2"></i>Profile</a>
                    <a href="account-edit-profile.php" class="list-group-item"><i class="bi bi-pencil me-2"></i>Edit
                      Profile</a>
                    <a href="account-saved-address.php" class="list-group-item"><i class="bi bi-pin-map me-2"></i>Saved
                      Address</a>
                    <a href="wishlist.php" class="list-group-item"><i class="bi bi-suit-heart me-2"></i>Wishlist</a>
                    <a href="../controller/logout.php" class="list-group-item"><i class="bi bi-power me-2"></i>Logout</a>
                  </div>
                </div>
              </div>
            </nav>
          </div>
          <div class="col-12 col-xl-9">
            <div class="card rounded-0 bg-light">
              <div class="card-body">
                <div class="d-flex flex-wrap flex-row align-items-center gap-3">
                  <div class="profile-pic">
                    <img src="../../assets/images/avatars/01.jpg" width="140" alt="">
                  </div>
                  <div class="profile-email flex-grow-1">
                    <p class="mb-0 fw-bold text-content">
                      <?php echo $user_mail ?>
                    </p>
                  </div>
                  <div class="edit-button align-self-start">
                    <a href="account-edit-profile.php" class="btn btn-outline-dark btn-ecomm"><i
                        class="bi bi-pencil-fill me-2"></i>Edit Profile</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="row row-cols-1 row-cols-lg-3 g-4 pt-4">
              <div class="col">
                <a href="account-orders.php">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-box-seam"></i></div>
                        <h6 class="mb-0">Orders</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="wishlist.php">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-suit-heart"></i></div>
                        <h6 class="mb-0">Wishlist</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="account-orders.php">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-arrow-clockwise"></i></div>
                        <h6 class="mb-0">Returns</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="account-saved-address.php">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-geo-alt"></i></div>
                        <h6 class="mb-0">Addresses</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="javascript:;">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-bookmarks"></i></div>
                        <h6 class="mb-0">Coupons</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="account-profile.php">
                  <div class="card rounded-0">
                    <div class="card-body p-5">
                      <div class="text-center">
                        <div class="fs-2 mb-3 text-content"><i class="bi bi-person"></i></div>
                        <h6 class="mb-0">Profile Details</h6>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

            </div><!--end row-->


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
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/plugins/slick/slick.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/loader.js"></script>


  </body>

  </html>

<?php } else {
  header("Location: ./login.php");
}
?>