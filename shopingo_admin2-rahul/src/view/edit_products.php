<?php
// HEADER FILE
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {

    // NAVBAR FILES
    include '../../includes/nav.php';

    // CONTROLLER FILES
    include '../controller/category_handler.php';

    // CONTROLLER FILES
    include '../controller/edit_product_handle.php';

    // Fetch Product Id
    $product_id = $_GET['product_id'];
    ?>


    <style>
        .product_image {
            height: 300px;
            /* object-fit: cover; */
        }
    </style>


    <!--page loader-->
    <div class="loader-wrapper">
        <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!--end loader-->


    <div class="container" style="margin-top: 70px;">
        <div style="border: 1px solid grey;" class="row p-4 mb-5 rounded">
            <h2 class="text-center mb-3">Edit Product</h2>

            <?php
            // if (isset($_SESSION['product_updated'])) {
            //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            //         ' . $_SESSION['product_updated'] . '
            //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //       </div>';
            //     unset($_SESSION['product_updated']);
            // }
        
            // if (isset($_SESSION['product_update_fail'])) {
            //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            //         ' . $_SESSION['product_update_fail'] . '
            //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            //       </div>';
            //     unset($_SESSION['product_update_fail']);
            // }
            ?>


            <div class="col-md-5">
                <!-- FEATURED IMAGE -->
                <div>
                    <?php
                    $featured_image = $product_data['featured_product_image'];
                    $image_path = "../../assets/images/product_featured_images/$featured_image";
                    ?>
                    <div class="<?php echo $product_data['featured_product_image']; ?>">
                        <img src='<?php echo "../../assets/images/product_featured_images/$featured_image" ?>'
                            height="440px" width="420px" style=" object-fit: cover;"
                            class="d-block product_featured_image mx-auto" alt="...">
                    </div>
                </div>
                <!-- Button yo change image -->
                <div class="d-flex mb-5 justify-content-center">
                    <form action="../controller/update_image_handle.php" method="POST" enctype="multipart/form-data"
                        onsubmit="return validateForm()">
                        <!-- Product_id -->
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                        <input name="product_featured_image" type="file" class="custom-file-input rounded"
                            id="product_featured_image">

                        <button type="submit" class="btn btn-outline-secondary mt-1">update</button>
                    </form>
                </div>

                <!-- FEATURED IMAGE ENDS-->


                <!-- CAROUSEL FOR MULTIPLE IMAGES -->
                <div id="carouselExampleFade" class="carousel slide carousel-fade my-5" data-bs-ride="carousel">
                    <h4 class="text-center mt-5">Images</h4>
                    <!-- <form action="../controller/product_multiple_img_handle.php" method="POST"> -->
                    <div class="carousel-inner">
                        <?php
                        $query = "SELECT product_image FROM `product_images` WHERE `product_id` = $product_id";
                        $result = mysqli_query($conn, $query);
                        $images = array();
                        while ($row_image = mysqli_fetch_assoc($result)) {
                            $images[] = $row_image['product_image'];
                        }
                        foreach ($images as $index => $imageData) {
                            ?>
                            <div class="carousel-item <?php echo ($index == 0) ? 'active' : ''; ?>">
                                <img src='<?php echo "../../assets/images/product_image/$imageData" ?>' width="420px"
                                    height="260px" style="object-fit:fill;" class="d-block mx-auto" alt="...">

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- Button yo change image -->
                    <div class="d-flex mb-5 justify-content-center">
                        <!-- Product_id -->
                        <!-- <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"> -->
                        <!-- <input name="product_multiple_images" type="file" class="custom-file-input rounded"
                            id="product_multiple_images"> -->
                        <!-- <button type="submit" name="multiple_images_update_btn"
                                class="btn btn-outline-secondary mt-1">New Images</button> -->
                        <!-- <button type="submit" class="btn btn-danger" name="delete_multiple_img_btn">Delete</button> -->
                    </div>
                    <!-- </form> -->

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- CAROUSEL FOR MULTIPLE IMAGES ENDS-->

            <!-- PRODUCT DETAILS -->

            <div class="col-md-7">
                <form action="../controller/update_product.php" method="POST">
                    <!-- Product_id -->
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                    <!-- Name -->
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control mb-4" name="product_name"
                            value="<?php echo $product_data['product_name']; ?>">
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="product_price">Product Price</label>
                        <input type="text" class="form-control mb-4" name="product_price"
                            value="<?php echo $product_data['price']; ?>">
                    </div>

                    <!-- Stock -->
                    <div class="form-group">
                        <label for="product_stock">Product Stock</label>
                        <input type="text" class="form-control mb-4" name="product_stock"
                            value="<?php echo $product_data['stock']; ?>">
                    </div>

                    <!-- Brand -->
                    <div class="form-group">
                        <label for="product_brand">Product Brand</label>
                        <input type="text" class="form-control mb-4" name="product_brand"
                            value="<?php echo $product_data['brand']; ?>">
                    </div>

                    <!-- Sizes -->
                    <div class="form-group">
                        <label for="product_size" class="form-label">Product Size</label>
                        <select class="form-select mb-4" name="product_size[]" id="product_size" multiple>
                            <?php
                            $allSizes = ['0', 'l', 's', 'm', 'xl', 'xxl', '7', '8', '9', '10', '11'];
                            foreach ($allSizes as $size) {
                                $isSelected = false;
                                if (strpos($product_data['product_size'], $size) !== false) {
                                    $isSelected = true;
                                }
                                echo "<option value=\"$size\" ";
                                echo $isSelected ? 'selected' : '';
                                echo ">$size</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <!-- Category -->
                    <div class="form-group">
                        <label for="product_category">Product Category</label>
                        <input type="text" class="form-control mb-4" name="product_category"
                            value="<?php echo $product_data['category_name']; ?>" disabled>
                    </div>

                    <!-- Set Product is Featured or Not -->
                    <div class="col-12">
                        <label for="is_featured" class="form-label">Make Product Featured</label>
                        <select class="form-select mb-4" name="is_featured" id="is_featured">
                            <option value="<?php echo ($product_data['isFeatured'] == 1) ? '1' : '0'; ?>">
                                <?php echo ($product_data['isFeatured'] == 1) ? 'Featured' : 'Not Featured'; ?>
                            </option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>


                    <!-- Created At-->
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="text" class="form-control mb-4" name="created_at"
                            value="<?php echo $product_data['created_at']; ?>" disabled>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="product_description">Product Description</label>
                        <textarea class="form-control mb-4" name="product_description" rows="15"
                            cols="10"><?php echo $product_data['description']; ?></textarea>
                    </div>

                    <button type="submit" name="edit_product_btn" class="btn btn-primary px-3 ">Save</button>
                </form>
                <!-- <a href="./home_page.php"><button class="btn btn-secondary">Back to List</button></a> -->
            </div>
        </div>

        <!-- Validate image form -->
        <script>
            function validateForm() {
                var fileInput = document.getElementById('product_featured_image');
                var fileName = fileInput.value;
                if (fileName === '') {
                    alert('Please select a file');
                    return false;
                }
                return true;
            }
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