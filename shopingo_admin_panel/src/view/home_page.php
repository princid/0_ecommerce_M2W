<?php

// Header
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {

    include '../../includes/nav.php';

    include '../controller/fetch_product_handle.php';

    include '../controller/home_page_handle.php';
    ?>

    <!-- JQUERY -->
    <!-- Include CSS and JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <!-- NAVBAR -->
    <?php include '../../includes/nav.php' ?>

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
            <div class="container-fluid">
                <!-- HEADING -->
                <h1 class="text-center mb-5">Shoppingo Admin Panel</h1>

                <!-- TOP CARDS -->
                <div class="row justify-content-center text-center ">
                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">

                            <div class="card-body">
                                <h5 class="card-title">Total Products</h5>
                                <p class="card-text">
                                    <?php echo $count_products; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total Categories</h5>
                                <p class="card-text">
                                    <?php echo $count_category; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">
                                    <?php echo $count_users; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Total Orders</h5>
                                <p class="card-text">
                                    <?php echo $count_orders; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Completed Orders</h5>
                                <p class="card-text">
                                    <?php echo $completed_orders; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card text-center" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Pending Orders</h5>
                                <p class="card-text">
                                    <?php echo $pending_orders; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TOP CARDS ENDS -->



                <div class="row mt-5">
                    <div class="col-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                        <h2 class="mb-0 fw-bold text-center">All Products</h2>
                        <hr>


                        <!-- Alert Messages -->
                        <?php
                        if (isset($_SESSION['Product_inserted'])) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ' . $_SESSION["deleted_product"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            unset($_SESSION["deleted_product"]);
                        }

                        if (isset($_SESSION["delete_product_fail"])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_SESSION["delete_product_fail"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            unset($_SESSION["delete_product_fail"]);
                        }


                        if (isset($_SESSION["deleted_product"])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_SESSION["deleted_product"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            unset($_SESSION["deleted_product"]);
                        }


                        if (isset($_SESSION['product_updated'])) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                           ' . $_SESSION['product_updated'] . '
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>';
                            unset($_SESSION['product_updated']);
                        }

                        if (isset($_SESSION['product_update_fail'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ' . $_SESSION['product_update_fail'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                            unset($_SESSION['product_update_fail']);
                        }
                        ?>

                        <!-- TABLE -->
                        <table id="myTable" class="display text-center">
                            <thead>
                                <tr>
                                    <th>s no.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Is Featured</th>
                                    <th>Category Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($rows as $row_data) {
                                    $product_id = $row_data['id'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['product_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['description'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['brand'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['price'] ?> /-
                                        </td>
                                        <td>
                                            <?php echo $row_data['stock'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['category_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo ($row_data['isFeatured'] == 1) ? 'Featured' : 'Not Featured'; ?>
                                        </td>
                                        <td>
                                            <?php if ($row_data['status'] == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Inactive";
                                            } ?>
                                        </td>
                                        <td>
                                            <form action="../controller/fetch_product_handle.php" method="POST">
                                                <!-- Get product id -->
                                                <input type="hidden" onclick=" return confirmDeleteProduct()"
                                                    name="product_fetch_id" value="<?php echo $product_id; ?>">
                                                <button name="delete_products" class="btn btn-danger">Delete</button>

                                                <!-- EDIT BUTTONS -->
                                                <a class="btn btn-primary"
                                                    href="./edit_products.php?product_id=<?php echo $product_id ?>">Edit</a>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                } ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="./deleted_products.php"><button class="btn btn-secondary">Show Deleted
                                    Products</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    <!-- FOOTER -->
    <?php include '../../includes/footer_file.php'; ?>

    <!-- for jquery table -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "paging": true,
                "pageLength": 10,
                "order": 1,
            });
        });
    </script>

    <!-- confirmation to delete image -->
    <script>
        function confirmDeleteProduct() {
            if (confirm("Are you sure you want to remove profile...")) {
                // document.getElementById("imageDeleteForm").submit();
            } else {
                return false;
            }
        }
    </script>



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