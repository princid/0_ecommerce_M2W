<!-- Header -->
 <?php // include '/var/www/html/shopingo_admin/includes/header.php';

 // Header 
include ('/var/www/html/shoppingo_project/shopingo_admin2-rahul/headers/header.php');

//  include '/var/www/html/shoppingo_project/shopingo_admin2-rahul/includes/header.php';
 ?>
<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand-xl w-100 navbar-dark container gap-3">
        <a class="navbar-brand d-none d-xl-inline" href="index.php"><img src="../assets/images/logo.webp"
                class="logo-img" alt=""></a>
        <a class="mobile-menu-btn d-inline d-xl-none" href="javascript:;" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar">
            <i class="bi bi-list"></i>
        </a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <div class="offcanvas-logo"><img src="../assets/images/logo.webp" class="logo-img" alt="">
                </div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>

            <?php
            if (isset($_SESSION['admin_login'])) {
                echo '
            <div class="offcanvas-body primary-menu">
                <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                    <!-- homepage -->
                    <li class="nav-item">
                        <a class="nav-link" href="home_page.php">Home</a>
                    </li>

                    <!-- insert products -->
                    <li class="nav-item">
                        <a class="nav-link" href="../view/insert_products.php">Insert Products</a>
                    </li>

                    <!-- products category -->
                    <li class="nav-item">
                        <a class="nav-link" href="../view/insert_category.php"> Categories</a>
                    </li>

                    <!-- products category -->
                    <li class="nav-item">
                        <a class="nav-link" href="../view/orders.php"> Orders</a>
                    </li>

                    <!-- products category -->
                    <li class="nav-item">
                        <a class="nav-link" href="../view/subscribers.php">Subscribers</a>
                    </li>
                    
                </ul>
            </div>
        </div>

        <a href="../controller/logout_handle.php"><button class="btn btn-danger">Logout</button></a>
        ';
            } else {
                ?>
                <h4 style="font-weight: 900" class="text-center text-primary mt-3" >Please Login To Access Admin panel</h4>
           <?php }
            ?>
    </nav>
</header>
<!--end top header-->


<!-- footer -->
<?php include '/var/www/html/shopingo_admin/includes/footer_file.php' ?>


<!-- <ul class="navbar-nav secondary-menu flex-row">
             <li class="nav-item">
                 <a class="nav-link dark-mode-icon" href="javascript:;">
                     <div class="mode-icon">
                         <i class="bi bi-moon"></i>
                     </div>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" href="#"><i class="bi bi-person-circle"></i></a>
             </li>
         </ul> -->