<?php
session_start();
if (isset($_SESSION['user_login'])) {

  include '../../includes/header.php';

  // NAVBAR
  include_once '../../includes/nav.php';

  include '../controller/order_details_fetch_handle.php';
  // include '../../shopingo_admin2-rahul/src/controller/order_details_handle.php';
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
            <li class="breadcrumb-item active" aria-current="page">My orders</li>
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
            <h4 class="mb-0 h4 fw-bold">Account - Orders</h4>
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
                    <a href="account-orders.php" class="list-group-item active"><i
                        class="bi bi-basket3 me-2"></i>Orders</a>
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
            <!-- <div class="card rounded-0 mb-3 bg-light">
              <div class="card-body">
                <div class="d-flex flex-column flex-xl-row gap-3 align-items-center">
                  <div class="">
                    <h5 class="mb-1 fw-bold">All Orders</h5>
                    <p class="mb-0">for anytime</p>
                  </div>
                  <div class="order-search flex-grow-1">
                    <form>
                      <div class="position-relative">
                        <input type="text" class="form-control ps-5 rounded-0" placeholder="Search Product...">
                        <span class="position-absolute top-50 product-show translate-middle-y"><i
                            class="bi bi-search ms-3"></i></span>
                      </div>
                    </form>
                  </div>
                  <div class="filter">
                    <button type="button" class="btn btn-dark rounded-0" data-bs-toggle="modal"
                      data-bs-target="#FilterOrders"><i class="bi bi-filter me-2"></i>Filter</button>
                  </div>
                </div>
              </div>
            </div> -->


            <!-- ORDER DETAILS -->
            <?php foreach ($fetch_orders as $orders) {
              $product_name = $orders['o_product_name'];
              $product_price = $orders['o_product_price'];
              $product_quantity = $orders['o_product_quantity'];
              $product_id = $orders['o_product_id'];
              $product_image = $orders['o_product_image'];
              $product_size = $orders['o_product_size'];
              $order_date = $orders['order_date'];
              $product_status = $orders['status'];
              $formatted_date = date('Y-m-d', strtotime($order_date));

              ?>

              <div class="card rounded-0 mb-3">
                <div class="card-body">
                  <div class="d-flex flex-column flex-xl-row gap-3">
                    <div class="product-img">
                      <img src="assets/images/featured-products/05.webp" width="120" alt="">
                    </div>
                    <div class="product-info flex-grow-1">
                      <h5 class="fw-bold mb-1">
                        <?php echo $product_name ?>
                      </h5>
                      <p class="mb-0">price:
                        <?php echo $product_price ?> /-
                      </p>
                      <div class="mt-3 hstack gap-2">
                        <button type="button" class="btn btn-sm border rounded-0">Size :
                          <?php echo $product_size ?>
                        </button>
                        <button type="button" class="btn btn-sm border rounded-0">Qty :
                          <?php echo $product_quantity ?>
                        </button>
                      </div>

                      <div class="mt-2">
                        <p class="mb-1 fw-bold">Order Date :
                          <?php echo $formatted_date ?>
                        </p>
                      </div>

                      <div class="mt-2">
                        <p class="mb-1 fw-bold">Order Status :
                          <?php if ($product_status == 'n') {
                            echo "Ordered";
                          } else if ($product_status == 's') {
                            echo "Product Shipped";
                          } else {
                            echo "Delivered";
                          } ?>
                        </p>
                      </div>
                    </div>
                    <div class="d-none d-xl-block vr"></div>
                    <div class="d-grid align-self-start align-self-xl-center">
                      <img
                        src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$product_image" ?>'
                        class="" height="180px" width="170px" alt=".">
                    </div>
                  </div>
                </div>
                <div class="card-footer rounded-0 bg-transparent">
                  <div class="d-flex align-items-center gap-3">
                    <!-- <p class="mb-1 fw-bold">Order Date :
                      <?php echo $formatted_date ?>
                    </p> -->
                    <div class="ratings">
                      <!-- <i class="bi bi-star-fill text-warning h6"></i>
                      <i class="bi bi-star-fill text-warning h6"></i>
                      <i class="bi bi-star-fill text-warning h6"></i>
                      <i class="bi bi-star h6"></i>
                      <i class="bi bi-star h6"></i>
                    </div> -->
                    </div>
                  </div>
                </div>
              <?php } ?>
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
              <img src="assets/images/new-arrival/01.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/02.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/03.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/04.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/05.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/06.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/07.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/08.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/09.webp" width="60" alt="">
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
              <img src="assets/images/new-arrival/10.webp" width="60" alt="">
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

<?php } else {
  header("Location: ./login.php");
}
?>