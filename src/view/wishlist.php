<?php
session_start();
if (isset($_SESSION['user_login'])) {
  include '../../includes/header.php';

  //  NAVBAR
  include_once '../../includes/nav.php';

  include '../../config/connection.php';

  $user_id = $_SESSION['user_id'];

  // FETCH CART DATA
  $fetch_cart_query = "SELECT products_table.*
 FROM `products_table`
 INNER JOIN `product_wishlist` ON products_table.id = product_wishlist.product_id
 INNER JOIN `users_table` ON users_table.id = product_wishlist.user_id WHERE users_table.id = $user_id";

  $execute = mysqli_query($conn, $fetch_cart_query);
  $count = mysqli_num_rows($execute);
  $data_container = array();
  while ($row = mysqli_fetch_assoc($execute)) {
    $data_container[] = $row;
  }
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
            <li class="breadcrumb-item active" aria-current="page">Wishlist </li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <?php
    // ALERTS
    if (isset($_SESSION['item_add_wishlist'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_add_wishlist'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_add_wishlist']);
    }

    if (isset($_SESSION['item_add_wishlist_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_add_wishlist_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_add_wishlist_fail']);
    }


    if (isset($_SESSION['item_remove_wishlist'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_remove_wishlist'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_remove_wishlist']);
    }

    if (isset($_SESSION['item_remove_wishlist_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_remove_wishlist_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_remove_wishlist_fail']);
    }
    ?>


    <!--start product wishlist-->
    <section class="section-padding">
      <div class="container">
        <div class="d-flex align-items-center px-3 py-2 border mb-4">
          <div class="text-start">
            <h4 class="mb-0 h4 fw-bold">Wishlist (
              <?php echo $count; ?>)
            </h4>
          </div>
          <div class="ms-auto">
            <a href="./index.php"><button type="button" class="btn btn-light btn-ecomm">Continue Shopping</button></a>
          </div>
        </div>

        <div class="similar-products">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">

            <?php foreach ($data_container as $data) {

              // PRODUCT IMAGE
              $image = $data['featured_product_image'];

              // PRODUCT_ID
              $product_id = $data['id'];
              ?>
              <div class="col">
                <div class="card rounded-0" style="height:450px; width:252px ; ">

                  <form action="../controller/cart_handle.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <button type="submit" name="remove_wishlist_btn"
                      class="btn-close wishlist-close position-absolute end-0 top-0"></button>
                  </form>

                  <a href="javascript:;">
                    <a href="./product-details.php?product_id=<?php echo $product_id ?>"> <img height="300px" width="250px"
                        src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$image" ?>'
                         alt=""></a>
                  </a>
                  <div class="card-body border-top text-center">
                    <p class="mb-0 product-short-name">
                      <?php echo $data['product_name']; ?>
                    </p>
                    <div class="product-price d-flex align-items-center gap-2 mt-2 justify-content-center">
                      <div class="h6 fw-bold">
                        <?php echo $data['price'] ?>
                      </div>
                      <div class="h6 fw-bold text-danger">(70% off)</div>
                    </div>
                  </div>
                  <div class="card-footer bg-transparent text-center">
                    <a href="./product-details.php?product_id=<?php echo $product_id ?>" class="btn btn-ecomm w-100">
                      Details</a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
          <!--end row-->
        </div>
      </div>
    </section>
    <!--start product details-->

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
  <?php } else {
  header("Location: ./login.php");
}
?>