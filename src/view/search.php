<?php include '../../includes/header.php';

//include_once '../../includes/nav.php';

//  NAVBAR
include_once '../../includes/nav.php';

include '../../config/connection.php';


// FUNCTION FOR SEARCHING
function searchProducts()
{
  global $conn;
  $searchQuery = isset($_GET['search_data']) ? $_GET['search_data'] : '';
  $searchedQuery = mysqli_real_escape_string($conn, $searchQuery);
  $sql = "SELECT * FROM `products_table` INNER JOIN `products_category` ON products_table.category_id = products_category.id WHERE product_name LIKE '%$searchQuery%' OR description LIKE '%$searchedQuery%' OR category_name LIKE '%$searchedQuery%' ";
  $result = mysqli_query($conn, $sql);
  $results = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
  }
  return $results;
}

?>

<!--start page content-->

<section class="section-padding bg-section-2">
  <div class="container">
    <div class="d-flex align-items-center">
      <div class="">
        <h3 class="mb-0 fw-bold">Search Products</h3>
      </div>
      <div class="ms-auto">
        <button type="button" class="btn-close" onclick="history.back()" aria-label="Close"></button>
      </div>
    </div>
    <div class="search-box position-relative mt-4">

      <!-- SEARCH FORM STARTS -->
      <form action="" method="GET">
        <div class="row">
          <div class="col-md-11">
            <div class="position-absolute position-absolute top-50 start-0 translate-middle ms-4 fs-5"><i
                class="bi bi-search"></i></div>
            <input class="form-control form-control-lg ps-5 rounded-0" type="search" name="search_data"
              placeholder="Type here to search">
          </div>
          <div class="col-md-1">
            <button type="submit" class="btn btn-secondary" value="Search" name="search_data_product"
              style="height: 47px;">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!--start page content-->
<div class="page-content">
  <!--start breadcrumb-->
  <div class="py-4 border-bottom">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:;">Shop</a></li>
          <li class="breadcrumb-item active" aria-current="page">Search products Results</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->

  <!--SEARCH CONTAINER-->
  <section class="section-padding">
    <div class="container">
      <div class="similar-products">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-4">

          <?php
          if (isset($_GET['search_data_product'])) {
            $search_result = searchProducts();
            foreach ($search_result as $search) {
              $product_name = $search['product_name'];
              $product_price = $search['price'];
              $product_id = $search['id'];
              $image = $search['featured_product_image'];

              ?>
              <div class="col">
                <div class="card rounded-0" style="height:500px">
                  <a href="javascript:;">
                    <a href="./product-details.php?product_id=<?php echo $product_id ?>"> <img height="300px" width="250px"
                        style="object-fit:contain"
                        src='<?php echo "../../shopingo_admin2-rahul/assets/images/product_featured_images/$image" ?>'
                        alt=""></a>
                  </a>
                  <div class="card-body border-top text-center">
                    <p class="mb-0 product-short-name">
                      <?php echo $product_name; ?>
                    </p>
                    <div class="product-price d-flex align-items-center  mt-1 justify-content-center">
                      <div class="h6 fw-bold">
                        <?php echo $product_price; ?>
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
            <?php }
          }
          ?>
        </div>
        <!--end row-->
      </div>
    </div>
  </section>
  <!--SEARCH CONTAINER ENDS-->

  <section class="section-padding">
    <div class="container">
      <h5 class="mb-0 fw-bold">Explore by categories</h5>
      <div class="search-categories mt-4">
        <div class="row row-cols-1 row-cols-lg-3 row-cols-xl-5 g-4">
          <div class="col">
            <div class="card border-0 rounded-0 shadow bg-green">
              <div class="card-body p-4">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0 fw-bold text-white">Men Fashion</h5>
                  </div>
                  <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-cast"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card border-0 rounded-0 shadow bg-pink">
              <div class="card-body p-4">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0 fw-bold text-white">Kids Wear</h5>
                  </div>
                  <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-boombox"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card border-0 rounded-0 shadow bg-skyblue">
              <div class="card-body p-4">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0 fw-bold text-white">Electronics</h5>
                  </div>
                  <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-film"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card border-0 rounded-0 shadow bg-purple">
              <div class="card-body p-4">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0 fw-bold text-white">Furniture</h5>
                  </div>
                  <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-music-note-beamed"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card border-0 rounded-0 shadow bg-yellow">
              <div class="card-body p-4">
                <div class="d-flex align-items-center">
                  <div>
                    <h5 class="mb-0 fw-bold text-white">Sports</h5>
                  </div>
                  <div class="ms-auto fs-1 text-white">
                    <i class="bi bi-person-lines-fill"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!--end row-->

        <h5 class="fw-bold mb-3 mt-5">Trending Searches</h5>
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
          <div class="col">
            <div class="list-group list-group-flush search-categories">
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Women Topwear Fashion</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Kids School Dresses</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Best Mobile in Samsung</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Top Selling Brands</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Men'sports Watches</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Formal Shirts for Women</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Casual Pants for Men</a>
            </div>
          </div>
          <div class="col">
            <div class="list-group list-group-flush search-categories">
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Women Topwear Fashion</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Kids School Dresses</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Best Mobile in Samsung</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Top Selling Brands</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Men'sports Watches</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Formal Shirts for Women</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Casual Pants for Men</a>
            </div>
          </div>
          <div class="col">
            <div class="list-group list-group-flush search-categories">
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Women Topwear Fashion</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Kids School Dresses</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Best Mobile in Samsung</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Top Selling Brands</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Men'sports Watches</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Formal Shirts for Women</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Casual Pants for Men</a>
            </div>
          </div>
          <div class="col">
            <div class="list-group list-group-flush search-categories">
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Women Topwear Fashion</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Kids School Dresses</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Best Mobile in Samsung</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Top Selling Brands</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Men'sports Watches</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Formal Shirts for Women</a>
              <a href="javascript:;" class="list-group-item list-group-item-action py-3"><i
                  class="bi bi-arrow-up-right me-2"></i>Casual Pants for Men</a>
            </div>
          </div>
        </div><!--end row-->
      </div>
    </div>
  </section>
  <!--end page content-->


  <!-- FOOTER -->
  <?php include '../../includes/footer.php' ?>

  <!-- JS FILES -->
  <script src="../../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/plugins/slick/slick.min.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/loader.js"></script>

  </body>

  </html>