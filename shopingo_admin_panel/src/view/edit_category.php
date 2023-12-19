<?php

// header file
include '../../includes/header.php';


if (isset($_SESSION['admin_login'])) {


    // navbar file
    include '../../includes/nav.php';

    // Controller File
    include '../controller/edit_category_handle.php';
    ?>


    <!-- JQUERY -->
    <!-- Include CSS and JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">


    <!--page loader-->
    <div class="loader-wrapper">
        <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-dark" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!--end loader-->

    <?php
    $category_id = $_GET['cat_id'];
    ?>


    <!--start page content-->
    <div class="page-content">

        <h1 class="text-center">Categories</h1>
        <!--start product details-->
        <section class="section-padding">
            <div class="container">

                <div class="row ">
                    <div class="col-12 col-lg-6 col-xl-5 col-xxl-5 mx-auto">
                        <div class="card rounded-0">
                            <div class="card-body p-4">
                                <h4 class="mb-0 fw-bold text-center">Insert Category</h4>
                                <hr>
                                

                                <form action="../controller/edit_category_handle.php" method="POST">
                                    <div class="row g-4">
                                        <!-- Product Name -->
                                        <div class="col-12">
                                            <label for="category" class="form-label">Insert Category</label>
                                            <input type="text" name="category_update" class="form-control rounded-0"
                                                id="category_update">
                                            <input type="hidden" value="<?php echo $category_id ?>" name="category_id">
                                            <span class="error-msg" id="categoryError"></span>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-dark rounded-0 btn-ecomm w-100">Insert</button>
                                        </div>
                                    </div><!---end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>





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