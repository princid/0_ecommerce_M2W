<?php
session_start();
include '../../includes/header.php';

// NAVBAR
include_once '../../includes/nav.php';

// CONTROLLER FILE
include '../controller/product_detail_handle.php';

// USER ID
$user_id = $_SESSION['user_id'];
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
          <li class="breadcrumb-item active" aria-current="page">Product Details</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->


  <!--start product details-->
  <section class="py-4">
    <div class="container">
      <div class="row g-4">
        <!-- PRODUCT AL IMAGES -->
        <div class="col-12 col-xl-7">
          <div class="product-images">
            <div class="product-zoom-images">
              <div class="row row-cols-1 text-center mt-5 g-3">
                <?php foreach ($product_details as $row_data) {
                  // PRODUCT IMAGE
                  $featured_image = $row_data['featured_product_image'];
                  // PRODUCT ID
                  $id = $row_data['id'];
                  ?>
                  <!-- FORM STARTS -->
                  <form action="../controller/cart_handle.php" method="POST">
                    <!-- hidden input tag -->

                    <!-- tag to store image id -->
                    <input type="hidden" name="selected_image" id="selected_image" value="<?= $id ?>">
                    <input type="hidden" name="selected_image_names" id="selected_image_names"
                      value="<?= $featured_image ?>">
                    <div class="col mt-5">
                      <div class="img-thumb-container overflow-hidden position-relative" data-fancybox="gallery"
                        data-featured-image="<?php echo $featured_image; ?>" data-other-image="<?php echo $images; ?>">
                        <img
                          src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$featured_image" ?>'
                          class="img-fluid" style="height: 300px; width: 300px; " id="img_frame"
                          data-image-id="<?= $image_id; ?>" alt="">
                      </div>
                    </div>


                </div><!--end row-->
              </div>
            </div>
          </div>
          <!-- PRODUCT ALL IMAGES EN-->

          <!-- SUB IMAGES -->
          <div class=" col-12 col-xl-5">
            <div class="product-info">

              <!-- PRODUCT NAME -->
              <div class="h4 fw-bold">
                <?php echo $row_data['product_name'];
                ?>
              </div>

              <!-- PRODUCT PRICE -->
              <div class="product-price d-flex align-items-center gap-3">
                <div class="h4 fw-bold">
                  <?php echo $row_data['price'] . '/-' ?>
                </div>
                <!-- <div class="h5 fw-light text-muted text-decoration-line-through">
                  1 crore
                </div> -->
                <!-- <div class="h4 fw-bold text-danger">(70% off)</div> -->
              </div>
              <p class="fw-bold mb-0 mt-1 text-success">inclusive of all taxes</p><br>

              <!-- PRODUCT Size -->
              <div class="h5 fw-bold">
                <?php echo '<span class="text-danger font-weight-bold" >Available Sizes:</span>' . $row_data['product_size'];
                ?>
              </div><br>

              <!-- PRODUCT BRAND -->
              <div class="h5 fw-bold">
                <?php echo '<span class="text-danger font-weight-bold" >Product Brand: </span>' . $row_data['brand'];
                ?>
              </div>

            <?php } ?>
            <div class="more-colors mt-4">
              <h6 class="fw-bold mb-3">More Views</h6>
              <div class="d-flex align-items-center gap-3">
                <?php foreach ($product_images as $img_data) {
                  $images = $img_data['product_image'];
                  $image_id = $img_data['id'];
                  ?>
                  <div class="">
                    <input type="hidden" id="selected_image_id" value="<?php echo $image_id ?>" name="variant_id">
                    <img src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_image/$images" ?>' width="65"
                      class="sub_frame" alt="" data-image-id="<?= $image_id; ?>">

                    <!-- send image name -->
                    <input type="hidden" name="selected_image_name" id="selected_image_name" value="<?= $images; ?>">
                  </div>
                <?php } ?>
              </div>
            </div>
            <!-- SUB IMAGES ENDS-->

            <!-- PRODUCT SIZE -->
            <div class="size-chart mt-4">
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <?php
                foreach ($product_details as $row_data) {
                  ?>

                </div>
              </div>

              <!-- Buttons -->
              <?php
              if (!isset($_SESSION['user_login'])) { ?>
                <div class="cart-buttons mt-3">
                  <div class="buttons d-flex flex-column flex-lg-row gap-3 mt-4">
                    <button type="submit" name="cart_btn" class="btn btn-lg btn-dark btn-ecomm px-5 py-3 col-lg-6"
                      disabled><i class="bi bi-basket2 me-2"></i>Add to Bag</button>
                    <a href="#" class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3"><i
                        class="bi bi-suit-heart me-2"></i>Wishlist</a>
                  </div>
                  <h6 class="text-danger">Please login to access them</h6>
                </div>
              <?php } else { ?>

                <div class="cart-buttons mt-3">
                  <div class="buttons d-flex flex-column flex-lg-row gap-3 mt-4">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row_data['price']; ?>">
                    <button type="submit" name="cart_btn" class="btn btn-lg btn-dark btn-ecomm px-5 py-3 col-lg-6"><i
                        class="bi bi-basket2 me-2"></i>Add to Bag</button>
                    <button type="submit" name="wishlist_btn" class="btn btn-lg btn-outline-dark btn-ecomm px-5 py-3"><i
                        class="bi bi-suit-heart me-2"></i>Wishlist</button>
                  </div>
                </div>
                </form>
              <?php }
              ?>


              <!-- Buttons -->
              <form action="" method="POST">

              </form>

              <hr class="my-3">
              <div class="product-info">
                <h6 class="fw-bold mb-3">Product Details</h6>
                <p class="mb-1">
                  <?php echo $row_data['description'] ?>
                </p>
              </div>
            <?php } ?>
            <hr class="my-3">
            <div class="customer-ratings">
              <h6 class="fw-bold mb-3">Customer Ratings</h6>
              <div class="d-flex align-items-center gap-4 gap-lg-5 flex-wrap flex-lg-nowrap">
                <div class="">
                  <h1 class="mb-2 fw-bold">4.8<span class="fs-5 ms-2 text-warning"><i
                        class="bi bi-star-fill"></i></span>
                  </h1>
                  <p class="mb-0">3.8k Verified Buyers</p>
                </div>
                <div class="vr d-none d-lg-block"></div>
                <div class="w-100">
                  <div class="rating-wrrap hstack gap-2 align-items-center">
                    <p class="mb-0">5</p>
                    <div class=""><i class="bi bi-star"></i></div>
                    <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 75%"></div>
                    </div>
                    <p class="mb-0">1528</p>
                  </div>
                  <div class="rating-wrrap hstack gap-2 align-items-center">
                    <p class="mb-0">4</p>
                    <div class=""><i class="bi bi-star"></i></div>
                    <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                    </div>
                    <p class="mb-0">253</p>
                  </div>
                  <div class="rating-wrrap hstack gap-2 align-items-center">
                    <p class="mb-0">3</p>
                    <div class=""><i class="bi bi-star"></i></div>
                    <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 45%"></div>
                    </div>
                    <p class="mb-0">258</p>
                  </div>
                  <div class="rating-wrrap hstack gap-2 align-items-center">
                    <p class="mb-0">2</p>
                    <div class=""><i class="bi bi-star"></i></div>
                    <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 35%"></div>
                    </div>
                    <p class="mb-0">78</p>
                  </div>
                  <div class="rating-wrrap hstack gap-2 align-items-center">
                    <p class="mb-0">1</p>
                    <div class=""><i class="bi bi-star"></i></div>
                    <div class="progress flex-grow-1 mb-0 rounded-0" style="height: 4px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"></div>
                    </div>
                    <p class="mb-0">27</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div><!--end row-->
    </div>
  </section>
  <!--start product details-->


  <!--start product details-->
  <section class="section-padding">
    <div class="container">
      <div class="separator pb-3">
        <div class="line"></div>
        <h3 class="mb-0 h3 fw-bold">Similar Products</h3>
        <div class="line"></div>
      </div>
      <div class="similar-products">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/best-sellar/03.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/new-arrival/02.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/best-sellar/02.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/new-arrival/04.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/new-arrival/05.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/trending-product/03.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/featured-products/05.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold productshort-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/trending-product/05.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/trending-product/01.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="javascript:;">
              <div class="card rounded-0">
                <img src="../../assets/images/trending-product/02.webp" alt="" class="card-img-top rounded-0">
                <div class="card-body border-top">
                  <h5 class="mb-0 fw-bold product-short-title">Syndrona</h5>
                  <p class="mb-0 product-short-name">Color Printed Kurta</p>
                  <div class="product-price d-flex align-items-center gap-3 mt-2">
                    <div class="h6 fw-bold">$458</div>
                    <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div>
                    <div class="h6 fw-bold text-danger">(70% off)</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
  </section>
  <!--end product details-->


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


<script>
  let frame = document.getElementById('img_frame');
  let thumbnails = document.getElementsByClassName('sub_frame');
  let selectedImageInput = document.getElementById('selected_image');
  let imgname = document.getElementById('selected_image_names');
  let selectedImageNameInput = document.getElementById('selected_image_name');
  let selectedImageIdInput = document.getElementById('selected_image_id');

  for (let i = 0; i < thumbnails.length; i++) {
    thumbnails[i].addEventListener('click', function () {
      let currentSrc = frame.src;
      frame.src = this.src;
      this.src = currentSrc;

      // Determine which data attribute to use based on the clicked thumbnail
      let imageName;
      // if (this.hasAttribute('data-featured-image')) {
      //   imageName = this.getAttribute('data-featured-image');
      // // }
      //  else if (this.hasAttribute('data-other-image')) {
      //   imageName = this.getAttribute('data-other-image');
      // }

      selectedImageNameInput.value = frame.src.split("/").pop();
      // selectedImageNameInput.value = imageName;

      let imageId = this.getAttribute('data-image-id');
      selectedImageInput.value = imageId;
    });
  }

</script>
<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
<!--End Back To Top Button-->


<!-- JavaScript files -->
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="../../assets/plugins/slick/slick.min.js"></script>
<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/index.js"></script>
<script src="../../assets/js/loader.js"></script>




</body>

</html>