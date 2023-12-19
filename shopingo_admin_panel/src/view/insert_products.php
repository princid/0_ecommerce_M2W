<?php

// Header
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {


    // NAVBAR
    include '../../includes/nav.php';


    // CONTROLLER
    include '../controller/insert_product_handle.php'; ?>


    <!--page loader-->
    <div class="loader-wrapper">
        <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!--end loader-->

    <!--start page content-->
    <div class="page-content">

        <!--start product details-->
        <section class="section-padding">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                        <div class="card rounded-0">
                            <div class="card-body p-4">
                                <h4 class="mb-0 fw-bold text-center">Insert Products</h4>
                                <hr>
                                <!-- FOR ERROR MESSAGE -->
                                <div class="alert alert-danger" id="errorMessage" style="display: none;"></div>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col">

                                            <!-- Alert after Product Insertion -->
                                            <?php
                                            if (isset($_SESSION['Product_inserted'])) {
                                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            ' . $_SESSION['Product_inserted'] . '
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>';
                                                unset($_SESSION['Product_inserted']);
                                            }

                                            if (isset($_SESSION['Product_insert_error'])) {
                                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            ' . $_SESSION['Product_insert_error'] . '
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                          </div>';
                                                unset($_SESSION['Product_insert_error']);
                                            }
                                            ?>


                                            <form action="../controller/insert_product_handle.php" method="POST"
                                                id="insert_products_form" enctype="multipart/form-data">

                                                <div class="row g-4">

                                                    <!-- Product Name -->
                                                    <div class="col-12">
                                                        <label for="product_name" class="form-label">Product Name</label>
                                                        <input type="text" name="product_name"
                                                            class="form-control rounded-0" id="product_name">
                                                        <span class="error-msg" id="nameError"></span>
                                                    </div>

                                                    <!-- Product Description -->
                                                    <div class="col-12">
                                                        <label for="product_desc" class="form-label">Product
                                                            Description</label>
                                                        <input type="text" name="product_desc"
                                                            class="form-control rounded-0" id="product_desc">
                                                        <span class="error-msg" id="descError"></span>
                                                    </div>

                                                   <!-- Product Category -->
                                                    <div class="col-12">
                                                        <label for="product_category" class="form-label">Product
                                                            Category</label>
                                                        <select class="form-select" name="product_category"
                                                            id="product_category">
                                                            <option value="">Select Category</option>
                                                            <?php foreach ($rows as $category): ?>
                                                                <option value="<?php echo $category['id']; ?>">
                                                                    <?php echo $category['category_name']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <input type="hidden" name="selected_category_id"
                                                            id="selected_category_id" value="">
                                                        <span class="error-msg" id="categoryError"></span>
                                                    </div>

                                                    <!-- Product Sizes -->
                                                    <div class="col-12" >
                                                        <label for="product_size" class="form-label">Product Size</label>
                                                        <select class="form-select" name="product_size[]" id="product_size"
                                                            multiple>
                                                            <option value="0">No Size</option>
                                                            <option value="l">L</option>
                                                            <option value="s">S</option>
                                                            <option value="m">M</option>
                                                            <option value="xl">XL</option>
                                                            <option value="xxl">XXL</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            
                                                        </select>
                                                        <span class="error-msg" id="sizeError"></span>
                                                    </div>


                                                    <!-- Product Brand -->
                                                    <div class="col-12">
                                                        <label for="product_brand" class="form-label">Enter Brand</label>
                                                        <input type="text" name="product_brand"
                                                            class="form-control rounded-0" id="product_brand">
                                                        </span>
                                                        <span class="error-msg" id="brandError"></span>
                                                    </div>


                                                    <!-- Product Price -->
                                                    <div class="col-12">
                                                        <label for="product_price" class="form-label">Product Price</label>
                                                        <input type="text" name="product_price"
                                                            class="form-control rounded-0" id="product_price">
                                                        </span>
                                                        <span class="error-msg" id="priceError"></span>
                                                    </div>


                                                    <!-- Product Stock -->
                                                    <div class="col-12">
                                                        <label for="product_stock" class="form-label">Product Stock</label>
                                                        <input type="text" name="product_stock"
                                                            class="form-control rounded-0" id="product_stock">
                                                        <span class="error-msg" id="stockError"></span>
                                                    </div>

                                                    <input type="hidden" name="isDeleted" value="0">


                                                    <!--Featured Product Image -->
                                                    <div class="col-12">
                                                        <label for="featured_product_image" class="form-label">Product
                                                            Featured Image</label>
                                                        <input type="file" name="featured_product_image"
                                                            class="form-control rounded-0"
                                                            onchange="previewImage(this, 'main_image_preview')"
                                                            id="product_image" multiple>
                                                        <div id="main_image_preview"></div>
                                                        <span class="error-msg" id="imageError"></span>
                                                    </div>

                                                    <!-- Product Images -->
                                                    <div class="col-12">
                                                        <label for="product_display_image" class="form-label">Product
                                                            Display Image</label>
                                                        <input type="file" name="product_image[]"
                                                            class="form-control rounded-0"
                                                            onchange="previewImage(this, 'main_image_preview')"
                                                            id="product_image" multiple>
                                                        <div id="main_image_preview"></div>
                                                        <span class="error-msg" id="imageError"></span>
                                                    </div>


                                                    <div class="col-12">
                                                        <button type="submit" name="Insert_product" id="submitForm"
                                                            class="btn btn-dark rounded-0 btn-ecomm w-100">Insert</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </section>
    </div>

    <!-- script file -->
    <script src="../../assets/js/insert_product.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- TO SEND ID OF SELECTED CATEGORY -->
    <script>
        $(document).ready(function () {
            var categorySelect = document.getElementById("product_category");
            var selectedCategoryInput = document.getElementById("selected_category_id");
            categorySelect.addEventListener("change", function () {
                var selectedCategoryId = categorySelect.value;
                selectedCategoryInput.value = selectedCategoryId;
            });
        });
    </script>



    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Add script using jQuery -->
    <script>
        $(document).ready(function () {
            $('#product_category').change(function () {
                var selectedCategory = $(this).val();
                var sizeOptions = $('#sizeOptions');
                var productSizeDropdown = $('#product_size');

                // Check if the selected category is 'shoes' or 'clothes'
                if (selectedCategory === 'shoes' || selectedCategory === 'clothes') {
                    sizeOptions.show(); // Show the Product Size div
                    productSizeDropdown.prop('required', true); // Make the Product Size dropdown required
                } else {
                    sizeOptions.hide(); // Hide the Product Size div for other categories
                    productSizeDropdown.prop('required', false); // Remove the required attribute
                }
            });
        });
    </script>





    <!-- FOOTER -->
    <?php include '../../includes/footer_file.php'; ?>




<?php } else {
    ?>
    <?php
    // HEADER
    include '../../includes/header.php';

    include '../../includes/nav.php';
    ?>

    <div style="margin-top:280px;" class="container">
        <div class="row text-center">
            <h1 class="my-5" style="font-weight: 800;">Welcome To Shoppingo Admin Panel</h1>
            <h5 class="mb-3">Effortless E-Commerce Management Starts Here.</h5>
            <h5>Navigate Your E-Commerce Journey with Precision and Ease.</h5>
            <a href="./admin_login.php"><button class="btn btn-secondary p-2 mt-3">Login Admin</button></a>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include '../../includes/footer_file.php'; ?>
<?php
}
?>