<?php
// Header
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {

    // NAVBAR
    include '../../includes/nav.php';

    // CONNECTION FILE
    include '../../config/connection.php';

    // CONTROLLER
    include '../controller/order_details_handle.php';


    // FETCH ORDER DETAILS SCRIPT
    $fetch_orders = "SELECT * FROM `orders_table`";
    $execute_fetch = mysqli_query($conn, $fetch_orders);
    if (!$execute_fetch) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $fetch_orders = array();
    while ($row = mysqli_fetch_assoc($execute_fetch)) {
        $fetch_orders[] = $row;
    }


    // foreach($fetch_orders_user as $order_user) {
    //     $user_email = $order_user['email'];
    // }
    ?>


    <!-- JQUERY -->
    <!-- Include CSS and JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">


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
                <div class="row">

                    <?php
                    if (isset($_SESSION['update_order_status'])) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ' . $_SESSION["update_order_status"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                        unset($_SESSION["update_order_status"]);
                    }

                    if (isset($_SESSION["update_order_status_fail"])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_SESSION["update_order_status_fail"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                        unset($_SESSION["update_order_status_fail"]);
                    }

                    if (isset($_SESSION["update_order_status_notSelected"])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_SESSION["update_order_status_notSelected"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                        unset($_SESSION["update_order_status_notSelected"]);
                    }
                    ?>

                    <h3 class="text-center text-secondary mt-5">ORDERED PRODUCTS</h3>
                    <div class="col-12 col-lg-12 col-xl-12 col-xxl-12 mx-auto">

                        <table id="orders_table" class="display text-center">
                            <thead>
                                <tr>
                                    <th>s no.</th>
                                    <th>User_id</th>
                                    <th>order_id</th>
                                    <th>Tracking_no.</th>
                                    <th>Invoice no.</th>
                                    <th>Total Products</th>
                                    <th>Total Price</th>
                                    <th>Address ID</th>
                                    <th>Payment Status</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $i = 1;
                                foreach ($fetch_orders as $orders) {
                                    $user_id = $orders['user_id'];
                                    $order_id = $orders['id'];


                                    // TO RETRIEVE EMAIL ID 
                                    // $query = "SELECT email FROM `users_table` WHERE  id = $user_id";
                                    // $execute = mysqli_query($conn, $query);
                                    // if(!$execute) {
                                    //     die('Query failed: '.mysqli_error($conn));
                                    // }
                                    // $fetch_user_id = array();
                                    // while($row = mysqli_fetch_assoc($execute)) {
                                    //     $fetch_user_id[] = $row;
                                    // }
                                    // foreach($fetch_user_id as $user_id) {
                                    //     $user_mail = $user_id['email'];
                                    // }
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['user_id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['tracking_number'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['invoice_number'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['total_products'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['total_price'] ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['address_id'] ?>
                                        </td>
                                        <td>
                                            <?php if ($orders['payment_status'] == 0) {
                                                echo "pending";
                                            } else {
                                                echo "completed";
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $orders['order_date'] ?>
                                        </td>
                                        <form action="../controller/order_details_handle.php" method="POST"
                                            style="display: inline;">
                                            <!-- hidden input field to send order id  -->
                                            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                                            <!-- <input type="hidden" name="user_mail" value="<?php //echo $user_mail ?>"> -->
                                            <td>
                                                <div class="col-12">
                                                    <select class="form-select order-status" name="order_status"
                                                        id="order_status">
                                                        <option value="">
                                                            <?php
                                                            if ($orders['status'] == 'n') {
                                                                echo "pending";
                                                            } else if ($orders['status'] == 's') {
                                                                echo "shipped";
                                                            } else {
                                                                echo "delivered";
                                                            } ?>
                                                        </option>
                                                        <option value="n">Pending</option>
                                                        <option value="s">Shipped</option>
                                                        <option value="y">Delivered</option>
                                                    </select>
                                                    <span class="error-msg" id="statusError"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <button name="order_status_btn" class="btn btn-primary">Update</button>
                                        </form>
                                        <a href="./order_details.php?user_id=<?php echo $user_id; ?>&order_id=<?php echo $order_id; ?>"
                                            class="btn btn-secondary">View</a>

                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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