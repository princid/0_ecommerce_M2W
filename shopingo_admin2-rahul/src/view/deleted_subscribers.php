<?php

// Header
include '../../includes/header.php';

if (isset($_SESSION['admin_login'])) {

    include '../../includes/nav.php';

    include '../controller/subscribers_handle.php';

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

                <!-- HEADING -->
                <h1 class="text-center mb-5">Subscribers</h1>

                <div class="row mt-5">
                    <div class="col-12 col-lg-9 col-xl-9 col-xxl-9 mx-auto">


                        <!-- Alert Messages -->
                        <?php
                        if (isset($_SESSION['restore_subscriber'])) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                ' . $_SESSION["restore_subscriber"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            unset($_SESSION["restore_subscriber"]);
                        }

                        if (isset($_SESSION["restore_subscriber_fail"])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_SESSION["restore_subscriber_fail"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                            unset($_SESSION["restore_subscriber_fail"]);
                        }
                        ?>

                        <!-- TABLE -->
                        <table id="myTable" class="display text-center">
                            <thead>
                                <tr>
                                    <th>s no.</th>
                                    <th>Email ID</th>
                                    <th>Subscribed on</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($subscribers_deleted as $s_data) {
                                    $subscriber_id = $s_data['id'];
                                    $date = $s_data['date'];
                                    $formatted_date = date('Y-m-d', strtotime($date));
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>

                                        <!-- SUBSCRIBER EMAIL -->
                                        <td>
                                            <?php echo $s_data['email'] ?>
                                        </td>

                                        <!-- SUBSCRIBED DATE -->
                                        <td>
                                            <?php echo $formatted_date ?>
                                        </td>

                                        <!-- ACTIONS -->
                                        <td>
                                            <form action="../controller/subscribers_handle.php" method="POST">
                                                <input type="hidden" name="subscriber_id" value="<?php echo $subscriber_id; ?>">
                                                <button name="restore_subscriber" class="btn btn-success">Restore</button>
                                            </form>

                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                } ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="./subscribers.php"><button class="btn btn-secondary">Back To List</button></a>
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