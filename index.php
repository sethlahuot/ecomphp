<?php 
$page = "page/home.php";
if(isset($_GET['p']))
{
    $p = $_GET['p'];
    switch($p)
    {
        case "shop" : $page = "page/shop.php";
            break;
        case "contact" : $page = "page/contact.php";
            break;
        case "cart" : $page = "page/cart.php";
            break;
        case "chackout" : $page = "page/chackout.php";
            break;
        case "shop-detail" : $page = "page/shop-detail.php";
            break;
        case "testimonial" : $page = "page/testimonial.php";
            break;
    }
}
include($page);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "includes/head.php" ?>
       
    </head>
    <body>
        <?php include "includes/spinner.php" ?>
        <?php include "includes/navber.php" ?>
        <?php include "includes/modalSearch.php" ?>

        <?php include $page ?>
        
        <?php include "includes/footer.php" ?>
        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>