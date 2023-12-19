<?php
//CONNECTION
include '../../config/connection.php';

//HEADER
include '../../includes/header.php';

//NAVBAR 
include_once '../../includes/nav.php';

include '../controller/category_handler.php';
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


  <!--start product grid-->
  <section class="section-padding">
    <h5 class="mb-0 fw-bold d-none">Product Grid</h5>
    <div class="container">
      <div class="btn btn-dark btn-ecomm d-xl-none position-fixed top-50 start-0 translate-middle-y"
        data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarFilter"><span><i class="bi bi-funnel me-1"></i>
          Filters</span></div>
      <div class="row">
        <div class="col-12 col-xl-3 filter-column">
          <nav class="navbar navbar-expand-xl flex-wrap p-0">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbarFilter"
              aria-labelledby="offcanvasNavbarFilterLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title mb-0 fw-bold" id="offcanvasNavbarFilterLabel">Filters</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                  aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <div class="filter-sidebar">
                  <div class="card rounded-0">
                    <div class="card-header d-none d-xl-block bg-transparent">
                      <h5 class="mb-0 fw-bold">Filters</h5>
                    </div>
                    <div class="card-body">
                      <h6 class="p-1 fw-bold bg-light">Categories</h6>

                      <!-- Category Filters -->
                      <div class="categories">
                        <div class="categories-wrapper height-1 p-1">
                          <?php foreach ($cat_rows as $cats) {
                            $category_id = $cats['id'];
                            $category_name = $cats['category_name'];
                            ?>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="chekCate1">
                              <label class="form-check-label" for="chekCate1">
                                <span>
                                  <?php echo $category_name ?>
                                </span><span class="product-number">(1548)</span>
                              </label>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                      <!-- Category Filters Ends-->
                      <hr>
                      <div class="brands">
                        <h6 class="p-1 fw-bold bg-light">Brands</h6>
                        <div class="brands-wrapper height-1 p-1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand1">
                            <label class="form-check-label" for="chekBrand1">
                              <span>Samsung</span><span class="product-number">(1548)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand2">
                            <label class="form-check-label" for="chekBrand2">
                              <span>Sony</span><span class="product-number">(478)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand3">
                            <label class="form-check-label" for="chekBrand3">
                              <span>Microsoft</span><span class="product-number">(689)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand4">
                            <label class="form-check-label" for="chekBrand4">
                              <span>Reebok</span><span class="product-number">(987)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand5">
                            <label class="form-check-label" for="chekBrand5">
                              <span>Adidas</span><span class="product-number">(358)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand6">
                            <label class="form-check-label" for="chekBrand6">
                              <span>Puma</span><span class="product-number">(5682)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand7">
                            <label class="form-check-label" for="chekBrand7">
                              <span>Ajio</span><span class="product-number">(5712)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand8">
                            <label class="form-check-label" for="chekBrand8">
                              <span>Motorola</span><span class="product-number">(657)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand9">
                            <label class="form-check-label" for="chekBrand9">
                              <span>amazon</span><span class="product-number">(984)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand10">
                            <label class="form-check-label" for="chekBrand10">
                              <span>Canon</span><span class="product-number">(524)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand11">
                            <label class="form-check-label" for="chekBrand11">
                              <span>Apple</span><span class="product-number">(168)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekBrand12">
                            <label class="form-check-label" for="chekBrand12">
                              <span>Philips</span><span class="product-number">(279)</span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="Price">
                        <h6 class="p-1 fw-bold bg-light">Price</h6>
                        <div class="Price-wrapper p-1">
                          <div class="input-group">
                            <input type="text" class="form-control rounded-0" placeholder="$10">
                            <span class="input-group-text bg-section-1 border-0">-</span>
                            <input type="text" class="form-control rounded-0" placeholder="$10000">
                            <button type="button" class="btn btn-outline-dark rounded-0 ms-2"><i
                                class="bi bi-chevron-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <!-- <div class="colors">
                        <h6 class="p-1 fw-bold bg-light">Colors</h6>
                        <div class="color-wrapper height-1 p-1">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor1">
                            <label class="form-check-label" for="chekColor1">
                              <i class="bi bi-circle-fill me-1 text-danger"></i><span>Red</span><span
                                class="product-number">(845)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor2">
                            <label class="form-check-label" for="chekColor2">
                              <i class="bi bi-circle-fill me-1 text-primary"></i><span>Blue</span><span
                                class="product-number">(257)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor3">
                            <label class="form-check-label" for="chekColor3">
                              <i class="bi bi-circle-fill me-1 text-warning"></i><span>Yellow</span><span
                                class="product-number">(968)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor4">
                            <label class="form-check-label" for="chekColor4">
                              <i class="bi bi-circle-fill me-1 text-success"></i><span>Green</span><span
                                class="product-number">(478)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor5">
                            <label class="form-check-label" for="chekColor5">
                              <i class="bi bi-circle-fill me-1 text-info"></i><span>Skyblue</span><span
                                class="product-number">(256)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor6">
                            <label class="form-check-label" for="chekColor6">
                              <i class="bi bi-circle-fill me-1 text-dark"></i><span>Black</span><span
                                class="product-number">(124)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor7">
                            <label class="form-check-label" for="chekColor7">
                              <i class="bi bi-circle-fill me-1 text-purple"></i><span>Purple</span><span
                                class="product-number">(897)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor8">
                            <label class="form-check-label" for="chekColor8">
                              <i class="bi bi-circle-fill me-1 text-orange"></i><span>Orange</span><span
                                class="product-number">(68)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor9">
                            <label class="form-check-label" for="chekColor9">
                              <i class="bi bi-circle-fill me-1 text-cyane"></i><span>Cyane</span><span
                                class="product-number">(784)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor10">
                            <label class="form-check-label" for="chekColor10">
                              <i class="bi bi-circle-fill me-1 text-brown"></i><span>Brown</span><span
                                class="product-number">(532)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor11">
                            <label class="form-check-label" for="chekColor11">
                              <i class="bi bi-circle-fill me-1 text-ten"></i><span>Ten</span><span
                                class="product-number">(532)</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="chekColor12">
                            <label class="form-check-label" for="chekColor12">
                              <i class="bi bi-circle-fill me-1 text-pink"></i><span>Pink</span><span
                                class="product-number">(452)</span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <hr> -->
                      <!-- <div class="discount">
                        <h6 class="p-1 fw-bold bg-light">Discount Range</h6>
                        <div class="discount-wrapper p-1">
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option1"
                              id="chekDisc1">
                            <label class="form-check-label" for="chekDisc1">
                              10% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option2"
                              id="chekDisc2">
                            <label class="form-check-label" for="chekDisc2">
                              20% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option3"
                              id="chekDisc3">
                            <label class="form-check-label" for="chekDisc3">
                              30% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option4"
                              id="chekDisc4">
                            <label class="form-check-label" for="chekDisc4">
                              40% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option5"
                              id="chekDisc5">
                            <label class="form-check-label" for="chekDisc5">
                              50% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option6"
                              id="chekDisc6">
                            <label class="form-check-label" for="chekDisc6">
                              60% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option7"
                              id="chekDisc7">
                            <label class="form-check-label" for="chekDisc7">
                              70% and Above
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" name="exampleRadios" type="radio" value="option8"
                              id="chekDisc8">
                            <label class="form-check-label" for="chekDisc8">
                              80% and Above
                            </label>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
        <div class="col-12 col-xl-9">

          <!-- FETCH ALL PRODUCTS -->
          <?php
          $fetch = "SELECT * FROM `products_table` WHERE isDeleted =0 ";
          $execute = mysqli_query($conn, $fetch);
          if (!$execute) {
            die('Query failed: ' . mysqli_error($conn));
          }
          $data_rows = array();
          while ($row = mysqli_fetch_assoc($execute)) {
            $count = mysqli_num_rows($execute);
            $data_rows[] = $row;
          }
          ?>

          <div class="shop-right-sidebar">
            <div class="card rounded-0">
              <div class="card-body p-2">
                <div class="d-flex align-items-center justify-content-between bg-light p-2">
                  <div class="product-count">
                    <?php echo $count; ?> Items Found
                  </div>
                  <form>
                    <div class="input-group">
                      <span class="input-group-text bg-transparent rounded-0 border-0">Sort By</span>
                      <select class="form-select rounded-0">
                        <option selected>Whats'New</option>
                        <option value="1">Popularity</option>
                        <option value="2">Better Discount</option>
                        <option value="3">Price : Hight to Low</option>
                        <option value="4">Price : Low to Hight</option>
                        <option value="5">Custom Rating</option>
                      </select>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="product-grid mt-4">
              <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <?php foreach ($data_rows as $row) {
                  $image = $row['featured_product_image'];
                  $product_id = $row['id'];
                  ?>
                  <div class="col">
                    <div class="card border shadow-none" style="height:300px; width:252px;" >
                      <div class="position-relative overflow-hidden">
                        <div class="product-options d-flex align-items-center justify-content-center gap-2 mx-auto position-absolute bottom-0 start-0 
                        end-0">
                          <!-- <a href="javascript:;"><i class="bi bi-heart"></i></a>
                          <a href="javascript:;"><i class="bi bi-basket3"></i></a>
                          <a href="javascript:;"><i class="bi bi-zoom-in"></i></a> -->
                        </div>
                        <a href="./product-details.php?product_id=<?php echo $product_id ?>">
                          <img height="300px" width="250px"
                            src='<?php  echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$image" ?>'
                            style="height: 200px; width:250px; object-fit:cover ">
                        </a>
                      </div>
                      <div class="card-body border-top">
                        <h5 class="mb-0 fw-bold product-short-title">
                          <?php echo $row['product_name']; ?>
                        </h5>
                        <!-- <p class="mb-0 product-short-name">Color Printed Kurta</p> -->
                        <div class="product-price d-flex align-items-center gap-2 mt-2">
                          <div class="h6 fw-bold">
                            <?php echo $row['price'] ?>
                          </div>
                          <!-- <div class="h6 fw-light text-muted text-decoration-line-through">$2089</div> -->
                          <div class="h6 fw-bold text-danger">(70% off)</div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div><!--end row-->
            </div>

            <hr class="my-4">

            <!-- <div class="product-pagination">
              <nav>
                <ul class="pagination justify-content-center">
                  <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                  <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                  <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:;">Next</a>
                  </li>
                </ul>
              </nav>
            </div> -->

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


</body>

</html>