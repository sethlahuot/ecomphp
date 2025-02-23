<?php
// Set the current page based on the 'p' parameter
$page = isset($_GET['p']) ? $_GET['p'] . ".php" : "home.php";
?>
<!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Phnom Penh</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">houthengsela@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small></a>
                        <a href="#" class="text-white"><small class="text-white mx-2"></small></a>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link <?= ($page == 'home.php') ? 'active' : '' ?>">Home</a>
                            <a href="index.php?p=shop" class="nav-item nav-link <?= ($page == 'shop.php') ? ' active' : '' ?>">Shop</a>
                            <a href="index.php?p=testimonial" class="nav-item nav-link <?= ($page == 'testimonial.php') ? ' active' : '' ?>">Testimonial</a>
                            <a href="index.php?p=contact" class="nav-item nav-link <?= ($page == 'contact.php') ? ' active' : '' ?>">Contact</a>
                            <a href="index.php?p=cart" class="nav-item nav-link <?= ($page == 'cart.php') ? ' active' : '' ?>">Cart</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            <a href="index.php?p=chackout" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">3</span>
                            </a>
                            <a href="register.php" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->