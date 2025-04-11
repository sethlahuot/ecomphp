<?php 
require_once "config/api/authcode.php";
require_once "config/userfunctions.php";
 
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1) ;

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
                        <a href="privacypolicy.php" class="text-white"><small class="text-white mx-2">Privacy Policy</small></a>
                        <?php 
                         if(isset($_SESSION['auth']))
                         {
                        ?>
                        <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white px-3 py-2 rounded-pill bg-primary" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-2"></i> <?= htmlspecialchars($_SESSION['auth_user']['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                            <li>
                                <a href="MyAccount.php" class="dropdown-item py-2">
                                    <i class="fas fa-user-circle me-2"></i> My Account
                                </a>
                            </li>
                            <li>
                                <a href="cart.php" class="dropdown-item py-2">
                                    <i class="fas fa-shopping-cart me-2"></i> Cart
                                </a>
                            </li>
                            
                            <li>
                                <a href="checkout.php" class="dropdown-item py-2">
                                    <i class="fas fa-credit-card me-2"></i> Checkout
                                </a>
                            </li>
                            <li>
                                <a href="my-orders.php" class="dropdown-item py-2">
                                    <i class="fas fa-comment-dots me-2"></i> My Orders
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a href="logout.php" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                        <?php } 
                        else{
                            ?>
                            <a href="register.php" class="text-white"><small class="text-white mx-2">Login or Register</small></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="index.php" class="navbar-brand">
                    <img src="uploads/<?= htmlspecialchars($settings['image']); ?>" alt="Logo" style="width: 100px;"></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link <?= $page =="index.php"? 'active': ''; ?>">Home</a>
                            <a href="shop.php" class="nav-item nav-link <?= $page =="shop.php"? 'active': ''; ?>">Shop</a>
                            <a href="contact.php" class="nav-item nav-link <?= $page =="contact.php"? 'active': ''; ?>">Contact</a>
                            <a href="about_us.php" class="nav-item nav-link <?= $page =="about_us.php"? 'active': ''; ?>">About Us</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                            
                            <a href="cart.php" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                                <?php 
                                if(isset($_SESSION['auth'])) {
                                    $items = getCartItems();
                                    $count = $items ? count($items) : 0;
                                    if($count > 0) {
                                ?>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; right: -5px; min-width: 20px; min-height: 20px;">
                                    <?php echo $count; ?>
                                </span>
                                <?php 
                                    }
                                }
                                ?>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->