<?php

// Header
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {


    // NAVBAR
    include '../../includes/nav.php';

    // CONNECTION FILE
    include '../../config/connection.php';


    // SETTING THE $user_id VARIABLE AS GLOBAL
    $user_id = $_GET['user_id'];
    $GLOBALS['user_id'] = $user_id;


    $order_id = $_GET['order_id'];
    $GLOBALS['order_id'] = $order_id;


    // CONTROLLER FILE
    include '../controller/order_details_handle.php';



    // USER ADDRESS DETAILS
    foreach ($fetch_user_address as $user_address) {
        $user_order_address = $user_address['address'];
        $user_pin = $user_address['pin_code'];
        $user_state = $user_address['state'];
        $user_city = $user_address['city'];
        $user_landmark = $user_address['landmark'];
    }
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
        <!--start product details-->
        <section class="section-padding">
            <div class="container-fluid">
                <div class="row mt-5">

                    <!-- TABLE TO DISPLAY USER DATA -->
                    <h3 class="text-center text-secondary">USER DETAILS</h3>
                    <div class="col-12 col-lg-11 col-xl-11 col-xxl-11 mx-auto">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>User_id</th>
                                        <th>Username</th>
                                        <th>Email_ID</th>
                                        <th>Mobile_Number</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fetch_orders_user as $order_user) {
                                        ?>
                                        <tr>
                                            <!-- USER ID -->
                                            <td>
                                                <?php echo $order_user['user_id'] ?>
                                            </td>

                                            <!-- USER NAME -->
                                            <td>
                                                <?php echo $order_user['username'] ?>
                                            </td>

                                            <!-- USER_EMAIL -->
                                            <td>
                                                <?php echo $order_user['email'] ?>

                                            </td>

                                            <!-- USER CONTACT NUMBER -->
                                            <td>
                                                <?php echo $order_user['mobile_number'] ?>
                                            </td>

                                            <!-- USER ADDRESS -->
                                            <td>
                                                <?php echo "$user_order_address, $user_pin,<br>  $user_city , $user_state <br> <b>Landmark:</b> 
                                                 $user_landmark"; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- TABLE TO DISPLAY USER DATA ENDS-->





                    <!-- TABLE TO DISPLAY PRODUCT INFO -->
                    <h3 class="text-center text-secondary mt-5">PRODUCT DETAILS</h3>
                    <div class="col-12 col-lg-11 col-xl-11 col-xxl-11 mx-auto">
                        <!-- TABLE TO DISPLAY USER DATA -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product_id</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <!-- <th>Image</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // FETCH PRODUCT DETAILS
                                    foreach ($fetch_product_details as $product_details) {
                                        ?>
                                        <tr>
                                            <!-- PRODUCT ID -->
                                            <td>
                                                <?php echo $product_details['o_product_id'] ?>
                                            </td>

                                            <!-- PRODUCT NAME -->
                                            <td>
                                                <?php echo $product_details['o_product_name'] ?>
                                            </td>

                                            <!-- PRODUCT QUANTITY -->
                                            <td>
                                                <?php echo $product_details['o_product_quantity'] ?>
                                            </td>

                                            <!-- PRODUCT SIZED -->
                                            <td>
                                                <?php if ($product_details['o_product_size'] == 0 || $product_details['o_product_size'] == '') {
                                                    echo "NA";
                                                } else {
                                                    echo $product_details['o_product_size'];
                                                }
                                                ?>
                                            </td>

                                            <!-- PRODUCT PRICE -->
                                            <td>
                                                <?php echo $product_details['o_product_price'] . '/-' ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center px-3 mt-4">
                        <a href="./orders.php"><button class="btn btn-secondary">Back to list</button></a>
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
            $('#orders_table').DataTable({
                "paging": true,
                "pageLength": 10,
                "order": 1,
            });
        });
    </script>
    <?php
}
?>