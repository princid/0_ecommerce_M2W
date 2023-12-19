<?php

// Header
include '../../includes/header.php';


if (isset($_SESSION['admin_login'])) {

    // NAVBAR
    include '../../includes/nav.php';

    // CONTROLLER FILE
    include '../controller/delete_product_handle.php';
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
            <div class="container">

                <div class="row mt-5">
                    <div class="col-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">
                        <h2 class="mb-0 fw-bold text-center">Deleted Products</h2>
                        <hr>

                        <?php if (isset($_SESSION['restore_product'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ' . $_SESSION['restore_product'] . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                            unset($_SESSION['restore_product']);
                        }
                        ?>
                        <!-- TABLE -->
                        <table id="myTable" class="display text-center">
                            <thead>
                                <tr>
                                    <th>s no.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Category Status</th>
                                    <th>Deleted At</th>
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
                                            <?php echo $row_data['price'] ?> /-
                                        </td>
                                        <td>
                                            <?php echo $row_data['stock'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['category_name'] ?>
                                        </td>
                                        <td>
                                            <?php if ($row_data['status'] == 1) {
                                                echo "Active";
                                            } else {
                                                echo "Inactive";
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $row_data['deleted_at'] ?>
                                        </td>
                                        <td>
                                            <form action="../controller/restore_products_handle.php" method="POST">
                                                <input type="hidden" name="product_id_value" value="<?php echo $product_id;?>" >
                                                <button type="submit" name="restore_deleted_product"
                                                    class="btn btn-success">Restore</button>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                } ?>
                            </tbody>
                        </table>

                        <div class="text-center">
                            <a href="./home_page.php"><button class="btn btn-secondary px-4 py-2">Back</button></a>
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
                "pageLength": 5,
                "order": 1,
            });
        });
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