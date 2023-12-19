<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.webp" type="image/webp" />

    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon-32x32.webp" type="image/webp" />

    <!-- CSS files -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="../../assets/plugins/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/plugins/slick/slick-theme.css" />

    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/dark-theme.css" rel="stylesheet">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Shopingo </title>
</head>

<body class="">

    <?php  // include '../controller/fetch_cart_data.php'; ?>
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
                <div class="offcanvas-body primary-menu">
                    <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="tv-shows.php"
                                data-bs-toggle="dropdown">
                                Categories
                            </a>
                            <div class="dropdown-menu dropdown-large-menu">
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Fashion</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Casual T-Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Formal Shirts</a>
                                            </li>
                                            <li><a href="javascript:;">Jackets</a>
                                            </li>
                                            <li><a href="javascript:;">Jeans</a>
                                            </li>
                                            <li><a href="javascript:;">Dresses</a>
                                            </li>
                                            <li><a href="javascript:;">Sneakers</a>
                                            </li>
                                            <li><a href="javascript:;">Belts</a>
                                            </li>
                                            <li><a href="javascript:;">Sports Shoes</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4">
                                        <h6 class="large-menu-title">Electronics</h6>
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:;">Mobiles</a>
                                            </li>
                                            <li><a href="javascript:;">Laptops</a>
                                            </li>
                                            <li><a href="javascript:;">Macbook</a>
                                            </li>
                                            <li><a href="javascript:;">Televisions</a>
                                            </li>
                                            <li><a href="javascript:;">Lighting</a>
                                            </li>
                                            <li><a href="javascript:;">Smart Watch</a>
                                            </li>
                                            <li><a href="javascript:;">Galaxy Phones</a>
                                            </li>
                                            <li><a href="javascript:;">PC Monitors</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end col-3 -->
                                    <div class="col-12 col-xl-4 d-none d-xl-block">
                                        <div class="pramotion-banner1">
                                            <img src="../assets/images/menu-img.webp" class="img-fluid" alt="" />
                                        </div>
                                    </div>
                                    <!-- end col-3 -->
                                </div>
                                <!-- end row -->
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Shop
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../view/cart.php">Shop Cart</a></li>
                                <li><a class="dropdown-item" href="../view/wishlist.php">Wishlist</a></li>
                                <!-- <li><a class="dropdown-item" href="../view/product-details.php">Product Details</a></li> -->
                                <!-- <li><a class="dropdown-item" href="../view/payment-method.php">Payment Method</a></li> -->
                                <!-- <li><a class="dropdown-item" href="../view/billing-details.php">Billing Details</a></li> -->
                                <!-- <li><a class="dropdown-item" href="../view/address.php">Addresses</a></li> -->
                                <li><a class="dropdown-item" href="../view/shop-grid.php">Shop Grid</a></li>
                                <!-- <li><a class="dropdown-item" href="../view/shop-grid-type-4.php">Shop Grid 4</a></li> -->
                                <!-- <li><a class="dropdown-item" href="../view/shop-grid-type-5.php">Shop Grid 5</a></li> -->
                                <li><a class="dropdown-item" href="../view/search.php">Search</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../view/about-us.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../view/contact-us.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../view/account-dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="../view/account-orders.php">My Orders</a></li>
                                <li><a class="dropdown-item" href="../view/account-profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="../view/account-edit-profile.php">Edit Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="../view/account-saved-address.php">Addresses</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php if (!isset($_SESSION['user_login'])) { ?>
                                    <li><a class="dropdown-item" href="../view/login.php">Login</a></li>
                                    <li><a class="dropdown-item" href="../view/authentication-register.php">Register</a>
                                    </li>
                                <?php }
                                ?>

                                <li><a class="dropdown-item"
                                        href="../view/authentication-reset-password.php">Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                                data-bs-toggle="dropdown">
                                Blog
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../view/blog-post.php">Blog Post</a></li>
                                <li><a class="dropdown-item" href="../view/blog-read.php">Blog Read</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav secondary-menu flex-row">
                <li class="nav-item">
                    <a class="nav-link dark-mode-icon" href="javascript:;">
                        <div class="mode-icon">
                            <i class="bi bi-moon"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/search.php"><i class="bi bi-search"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/wishlist.php"><i class="bi bi-suit-heart"></i></a>
                </li>
                <li class="nav-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                    <a class="nav-link position-relative" href=" ../view/cart.php ">
                        <div class="cart-badge"><?php // echo $count; ?></div>
                        <i class="bi bi-basket2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../view/account-dashboard.php"><i class="bi bi-person-circle"></i></a>
                </li>
            </ul>
        </nav>
    </header>
    <!--end top header-->

    <!-- JavaScript files -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/slick/slick.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/loader.js"></script>