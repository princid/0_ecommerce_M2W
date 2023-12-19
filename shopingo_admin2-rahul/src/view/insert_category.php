<?php

// header file
include '../../includes/header.php';


if (isset($_SESSION['admin_login'])) {


    // navbar file
    include '../../includes/nav.php';

    // Controller File
    include '../controller/category_handler.php';
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

                                <!-- FOR MESSAGE -->
                                <div class="alert alert-warning " id="errorMessage" style="display: none;" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>


                                <form action="" method="POST" id="insert_products-form">
                                    <div class="row g-4">
                                        <!-- Product Name -->
                                        <div class="col-12">
                                            <label for="category" class="form-label">Insert Category</label>
                                            <input type="text" name="category" class="form-control rounded-0" id="category">
                                            <span class="error-msg" id="categoryError"></span>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="Insert_category"
                                                class="btn btn-dark rounded-0 btn-ecomm w-100">Insert</button>
                                        </div>
                                    </div><!---end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLE -->
            <div class="container mt-5">
                <!-- Alert after Category Deletion -->
                <?php
                if (isset($_SESSION["delete_category"])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $_SESSION["delete_category"] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    unset($_SESSION["delete_category"]);
                }

                // Alert after Status Updation
                if (isset($_SESSION['status_update'])) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $_SESSION['status_update'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    unset($_SESSION['status_update']);
                }


                 // Alert After Category Name Updation
                if (isset($_SESSION['category_updated'])) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        ' . $_SESSION['category_updated'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    unset($_SESSION['category_updated']);
                }



                 // Alert After Catwgory Name Updation Fail
                 if (isset($_SESSION['category_update_failed'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ' . $_SESSION['category_update_failed'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    unset($_SESSION['category_update_failed']);
                }
                ?>
                <table id="catTable" class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">s no.</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Active Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($rows as $row_data) {
                            $cat_id = $row_data['id'];
                            ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $i; ?>
                                </th>
                                <td>
                                    <!-- category name -->
                                    <?php echo $row_data['category_name']; ?>
                                </td>
                                <td>
                                    <form action="../controller/category_handler.php" method="POST">
                                        <!-- category_id -->
                                        <input type="hidden" name="category_id_fetch" value="<?php echo $cat_id ?>">
                                        <!-- category_status -->
                                        <select class="form-select" name="status" id="status">
                                            <option selected value="">
                                                <?php
                                                if ($row_data['status'] == 1) {
                                                    echo "Active";
                                                } else {
                                                    echo "Inactive";
                                                } ?>
                                            </option>
                                            <option value="<?php echo "1" ?>">Active</option>
                                            <option value="<?php echo "0" ?>">In active</option>
                                        </select>
                                </td>
                                <td>
                                    <!-- <input type="hidden" name="product_fetch_id" value="<?php //echo $product_id; ?>"> -->
                                    <button name="update_category" class="btn btn-success">Update</button>
                                    <!-- <button name="delete_category" class="btn btn-danger">Delete</button> -->
                                    </form>
                                    <a href="./edit_category.php?cat_id=<?php echo $cat_id ?>"><button class="btn btn-primary">Edit</button></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>




    <!-- for jquery table -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#catTable').DataTable({
                "paging": true,
                "pageLength": 5,
                "order": 1,
            });
        });
    </script>
    <!-- jquery table ends -->


    <!-- js file -->
    <script src="../../assets/js/category_form.js"></script>
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