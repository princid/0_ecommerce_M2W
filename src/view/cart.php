<?php
session_start();
if (isset($_SESSION['user_login'])) {
  include '../../includes/header.php';

  include_once '../../includes/nav.php';

  include '../../config/connection.php';

  include '../controller/fetch_cart_data.php';


  $user_id = $_SESSION['user_id'];
  // FOR PRODUCT ID
  if (!empty($$data_container)) {
    foreach ($data_container as $aa) {
      $id = $aa['id'];
    }
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
            <li class="breadcrumb-item active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <?php
    // ALERT
  
    // ADD CART ITEM
    if (isset($_SESSION['item_add_cart'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_add_cart'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_add_cart']);
    }
    if (isset($_SESSION['item_add_cart_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_add_cart_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_add_cart_fail']);
    }


    // DELETE CART ITEM
    if (isset($_SESSION['item_remove_cart'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_remove_cart'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_remove_cart']);
    }
    if (isset($_SESSION['item_remove_cart_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['item_remove_cart_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['item_remove_cart_fail']);
    }


    // UPDATE CART SIZE AND QUANTITY
    if (isset($_SESSION['size_and_quantity_success'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . $_SESSION['size_and_quantity_success'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['size_and_quantity_success']);
    }
    if (isset($_SESSION['size_and_quantity_fail'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        ' . $_SESSION['size_and_quantity_fail'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['size_and_quantity_fail']);
    }
    ?>


    <!--start product details-->
    <section class="section-padding">
      <div class="container">
        <div class="d-flex align-items-center px-3 py-2 border mb-4">
          <div class="text-start">
            <h4 class="mb-0 h4 fw-bold">My Bag (
              <?php echo $count ?>)
            </h4>
          </div>
          <div class="ms-auto">
            <a href="./index.php"><button type="button" class="btn btn-light btn-ecomm">Continue Shopping</button></a>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-12 col-xl-8">
            <?php
            if (!(empty($data_container))) {
              foreach ($data_container as $data) {
                // ptoduct id
                $product_id = $data['id'];

                // product price
                $product_price = $data['price'];

                // product size
                $size_product = $data['product_size'];
                $product_size = explode(" ", $size_product);


                // TO FETCH IMAGES FROM CART TABLE
                $query = "SELECT * FROM `products_cart` WHERE user_id = $user_id AND product_id = $product_id ";
                $execute_2 = mysqli_query($conn, $query);
                $data_container_2 = [];

                if ($execute_2) {
                  $count = mysqli_num_rows($execute_2);
                  while ($row_2 = mysqli_fetch_assoc($execute_2)) {
                    $data_container_2[] = $row_2;
                  }
                  foreach ($data_container_2 as $data_2) {
                    $images_cart = $data_2['selected_image'];
                    $cart_id = $data_2['id'];
                  }
                }


                // FETCH PRODUCT TOTAL PRICE AND COUNT
                $fetch_data = "SELECT image_id FROM `products_cart` WHERE user_id = $user_id";
                $execute = mysqli_query($conn, $fetch_data);
                $data_container_4 = [];
                while ($row = mysqli_fetch_assoc($execute)) {
                  $data_container_4[] = $row;
                }
                if (!empty($data_container_4)) {
                  $image_id = $data_container_4[0]['image_id'];
                  $fetch_data_1 = "SELECT * FROM `product_images` WHERE id = $image_id AND product_id = $product_id";
                  $execute_1 = mysqli_query($conn, $fetch_data_1);
                  if (!$execute_1) {
                    die('Error: ' . mysqli_error($conn));
                  }
                  $data_container_5 = [];
                  while ($row = mysqli_fetch_assoc($execute_1)) {
                    $data_container_5[] = $row;
                  }
                  foreach ($data_container_5 as $data_5) {
                    $id = $data_5['id'];
                  }
                } else {
                  echo "No image_id found in products_cart for user_id: $user_id";
                }

                ?>
                <div class="card rounded-0 mb-3">
                  <div class="card-body">
                    <div class="d-flex flex-column flex-lg-row gap-3">
                      <div class="product-img">

                        <a href="./product-details.php?product_id=<?php echo $product_id ?>">
                          <!-- <img src='<?php //echo "../../shopingo_admin2-rahul/assets/images/product_image/$images_cart" ?>'
                            class="" height="180px" width="170px" alt="."> -->
                          <img
                            src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$images_cart" ?>'
                            class="" height="180px" width="170px" alt=".">
                        </a>
                      </div>
                      <div class="product-info flex-grow-1">

                        <!-- product_name -->
                        <h5 class="fw-bold mb-0">
                          <?php echo $data['product_name']; ?>
                        </h5>
                        <div class="product-price d-flex align-items-center gap-2 mt-3">
                          <div class="h6 fw-bold">
                            <!-- product_price -->
                            <h5 class="fw-bold mb-0">
                              <?php echo $data['price']; ?> /-
                            </h5>
                          </div>
                          <div class="h6 fw-bold text-danger">(70% off)</div>
                        </div>

                        <div class="mt-3 hstack gap-2">
                          <!-- Product Size -->
                          <!-- <button type="button" class="btn btn-sm btn-light border rounded-0" data-bs-toggle="modal"
                            data-bs-target="#SizeModal<?= $product_id ?>">Size : M</button> -->
                          <!-- Product Quantity -->
                          <!-- <button type="button" class="btn btn-sm btn-light border rounded-0" data-bs-toggle="modal"
                            data-bs-target="#QtyModal">Qty : 1</button> -->



                          <!-- PRODUCT SIZE AND QUANTITY -->
                          <form action="../controller/cart_handle.php" id="sizeAndQuantityForm" method="POST">
                            <div class="container">
                              <div class="row text-left justify-content-left ">
                                <!-- fetch data of size and quantity of product -->
                                <?php $query = "SELECT * FROM `products_cart` WHERE product_id = $product_id AND user_id = $user_id";
                                $execute = mysqli_query($conn, $query);
                                $data_container_cart = array();
                                while ($row = mysqli_fetch_assoc($execute)) {
                                  $data_container_cart[] = $row;
                                }
                                foreach ($data_container_cart as $data_cart):
                                  $product_size = $data_cart['size'];
                                  $product_quantity = $data_cart['quantity'];
                                endforeach;
                                ?>
                                <!-- Product Size -->
                                <div class="col-md-5">
                                  <label for="">select size</label>
                                  <select style="width: 180px;" class="p-1" name="product_size" id="product_size">
                                    <option value="">Select Size</option>
                                    <?php foreach ($product_size as $size_item): ?>
                                      <?php //$size_item = $data_cart['size']; ?>
                                      <option value="<?php echo $size_item; ?>">
                                        <?php echo $size_item; ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>
                                  <span class="error-sizeAndQuantityForm" id="sizeError">

                                    <!-- temporary display of data size -->
                                    <div class="container">
                                      <div class="row">
                                        (
                                        <?php echo $product_size ?>)
                                      </div>
                                    </div>
                                </div>

                                <!-- Product Quantity -->
                                <div class="col-md-5">
                                  <label for="">select Quantity</label>
                                  <input style="width: 180px;" name="product_quantity" id="product_quantity" type="text"
                                    value="<?php echo $product_quantity; ?>" placeholder="enter quantity">
                                  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                </div>
                                <span class="error-sizeAndQuantityForm" id="quantityError">

                                  <div class="col-md-2">
                                    <button class="mt-4 btn btn-sm btn-dark border rounded-0"
                                      name="updatesize_quantity">save</button>
                                  </div>
                              </div>
                            </div>
                          </form>
                          <!-- PRODUCT SIZE AND QUANTITY ENDS-->
                        </div>
                      </div>



                      <div class="d-none d-lg-block vr"></div>
                      <div class="d-grid gap-2 align-self-start align-self-lg-center">
                        <form action="../controller/cart_handle.php" method="POST">
                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                          <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                          <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                          <button type="submit" name="remove_cart_btn" class="btn btn-ecomm"><i
                              class="bi bi-x-lg me-2"></i>Remove</button>
                        </form>

                        <!-- MODAL BUTTON -->
                        <a href="javascript:;" data-bs-toggle="modal" class="btn btn-ecomm"
                          data-bs-target="#QuickViewModal<?= $product_id ?>">
                          <button type="button"> <i class="bi bi-zoom-in"></i></button></a>
                      </div>
                    </div>
                  </div>
                </div>


                <!-- MODAL -->
                <div class="modal fade" id="QuickViewModal<?= $product_id ?>" tabindex="-1">
                  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-0">

                      <div class="modal-body">
                        <div class="row g-3">
                          <div class="col-12 col-xl-6">
                            <div class="wrap-modal-slider">
                              <!-- IMAGE -->
                              <div class="slider-for">
                                <div>
                                  <img
                                    src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$images_cart" ?>'
                                    class="img-fluid">
                                  <!-- <img
                                    src='<?php // echo "../../shopingo_admin2-rahul/assets/images/product_image/$images_cart" ?>'
                                    alt=""> -->
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="col-12 col-xl-6">
                            <div class="product-info">

                              <!-- PRODUCT NAME -->
                              <h4 class="product-title fw-bold mb-1">
                                <?php echo $data['product_name']; ?>
                              </h4>
                              <!-- <p class="mb-0">Women Pink & Off-White Printed Kurta with Palazzos</p> -->
                              <div class="product-rating">
                                <div class="hstack gap-2 border p-1 mt-3 width-content">
                                  <div><span class="rating-number">4.8</span><i class="bi bi-star-fill ms-1 text-success"></i>
                                  </div>
                                  <div class="vr"></div>
                                  <div>162 Ratings</div>
                                </div>
                              </div>
                              <hr>
                              <div class="product-price d-flex align-items-center gap-3">
                                <div class="h4 fw-bold">
                                  <?php echo $data['price']; ?> /-
                                </div>
                                <!-- <div class="h5 fw-light text-muted text-decoration-line-through"></div> -->
                                <div class="h4 fw-bold text-danger">(70% off)</div>
                              </div>
                              <p class="fw-bold mb-0 mt-1 text-success">inclusive of all taxes</p>
                              <p class="fw-bold mb-0 mt-1 text-dark"><b>Stock: </b>
                                <?php echo $data['stock']; ?>
                              </p>
                              <p class="fw-bold mb-0 mt-1 text-dark">
                                <?php echo $data['description']; ?>
                              </p>



                              <div class="cart-buttons mt-3">
                                <div class="buttons d-flex flex-column gap-3 mt-4">
                                  <!-- <a href="javascript:;" class="btn btn-lg btn-dark btn-ecomm px-5 py-3 flex-grow-1"><i
                                    class="bi bi-basket2 me-2"></i>Add to Bag</a> -->
                                  <form action="../controller/cart_handle.php" method="POST">
                                    <input type="hidden" name="product_id" value="
                                  <?php echo $product_id; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <button type="submit" name="wishlist_btn"
                                      class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3"><i
                                        class="bi bi-suit-heart me-2"></i>Wishlist</button>
                                  </form>
                                </div>
                              </div>
                              <hr class="my-3">

                            </div>
                          </div>
                        </div>
                        <!--end row-->
                      </div>

                    </div>
                  </div>
                </div>
                <!--end quick view-->


                <!--start size modal-->
                <div class="modal" id="SizeModal<?= $product_id ?>" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                      <div class="modal-body">
                        <div class="d-flex gap-3">
                          <div class="product-img">
                            <img src="../../assets/images/featured-products/01.webp" width="80" alt="">
                          </div>
                          <div class="product-info flex-grow-1">
                            <h6 class="fw-bold mb-0">AKS - Checked Straight Kurta</h6>
                            <div class="product-price d-flex align-items-center gap-2 mt-2">
                              <div class="h6 fw-bold">$458</div>
                              <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                              <div class="h6 fw-bold text-danger">(70% off)</div>
                            </div>
                          </div>
                          <div class="">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                        </div>
                        <hr>
                        <div class="size-chart mt-4">
                          <h5 class="fw-bold mb-4">Select Size</h5>
                          <?php foreach ($product_size as $size_item) { ?>
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                              <div class="">
                                <button type="button">
                                  <?php echo $size_item; ?>
                                </button>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                        <div class="d-grid mt-4">
                          <button type="button" class="btn btn-dark btn-ecomm">Done</button>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
                <!--end size modal-->

                <!-- ORDERS AND GRAND TOTAL CARD -->
                <?php
              }
              ?>

            </div>
            <div class="col-12 col-xl-4">
              <div class="card rounded-0 mb-3">
                <div class="card-body">
                  <h5 class="fw-bold mb-4">Order Summary</h5>
                  <!-- // Adjust total_price based on the total number of products
                  // $total_price *= $total_products; -->
                  <!-- total cart price -->
                  <div class="hstack align-items-center justify-content-between">
                    <p class="mb-0">Bag Total</p>
                    <p class="mb-0">
                      <?php echo $total_price; ?>/-
                    </p>
                  </div>

                  <hr>

                  <!-- delivery charges -->
                  <div class="hstack align-items-center justify-content-between">
                    <p class="mb-0">Delivery</p>
                    <?php $delivery_charges = 40; ?>
                    <p class="mb-0">
                      <?php
                      if ($total_price > 0 || $total_price <= 500) {
                        echo $delivery_charges;
                      } else {
                        echo 0;
                      } ?>/-
                    </p>
                  </div>
                  <hr>

                  <!-- grand total -->
                  <div class="hstack align-items-center justify-content-between fw-bold text-content">
                    <p class="mb-0">Total Amount</p>
                    <p class="mb-0">
                      <?php if ($total_price > 0) {
                        echo $total_price + $delivery_charges;
                      } else {
                        echo 0;
                      }
                      ?> /-
                    </p>
                  </div>
                  <div class="d-grid mt-4">
                    <a href="./address.php?user_id=<?php echo $user_id; ?>" class="btn btn-dark btn-ecomm py-3 px-5"> Place
                      Order</a>
                  </div>
                </div>
              </div>
            </div><!--end row-->
            <?php
            } else {
              echo '<h1 class="text-center mt-5" style="color: red; font-weight:bold ">Cart is empty</h1>';
            }
            ?>
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



  <!--start qty modal-->
  <div class="modal" id="QtyModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content rounded-0">
        <div class="modal-body">
          <div class="d-flex align-items-center justify-content-between">
            <div class="">
              <h5 class="fw-bold mb-0">Select Quantity</h5>
            </div>
            <div class="">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          </div>
          <hr>
          <div class="size-chart">
            <div class="d-flex align-items-center gap-3 flex-wrap">
              <div class="">
                <button type="button">1</button>
              </div>
              <div class="">
                <button type="button">2</button>
              </div>
              <div class="">
                <button type="button">3</button>
              </div>
              <div class="">
                <button type="button">4</button>
              </div>
              <div class="">
                <button type="button">5</button>
              </div>
              <div class="">
                <button type="button">6</button>
              </div>
              <div class="">
                <button type="button">7</button>
              </div>
              <div class="">
                <button type="button">8</button>
              </div>
              <div class="">
                <button type="button">9</button>
              </div>
              <div class="">
                <button type="button">10</button>
              </div>
              <div class="">
                <button type="button">11</button>
              </div>
              <div class="">
                <button type="button">12</button>
              </div>
            </div>
          </div>
          <div class="d-grid mt-4">
            <button type="button" class="btn btn-dark btn-ecomm">Done</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end qty modal-->


  <!--Start Back To Top Button-->
  <a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
  <!--End Back To Top Button-->


  <!-- JavaScript files -->
  <script>
    document.getElementById('sizeAndQuantityForm').addEventListener('submit', function (e) {
      e.preventDefault();
      let valid = true;
      // Reset error messages
      document.querySelectorAll('.error-sizeAndQuantityForm').forEach(function (error) {
        error.textContent = '';
      });
      // Validate Size
      const size = document.getElementById('product_size').value;
      if (!size) {
        document.getElementById('sizeError').textContent = '*Please Select Size';
        valid = false;
      }
      // Validate Quantity
      const quantity = document.getElementById('product_quantity').value;
      if (!quantity || quantity.value == 0) {
        document.getElementById('quantityError').textContent = '*Please Select Quantity';
        valid = false;
      }
      if (valid) {
        this.submit();
      }
    });
  </script>
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