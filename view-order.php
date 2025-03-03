<?php 
include "config/userfunctions.php";

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];
    $orderData = checkTrackingNoValid($tracking_no);
    if(!$orderData){
    ?>
        <h4>Something was Worng</h4>
    <?php
    die();
    }
}else{
    ?>
        <h4>Something was Worng</h4>
    <?php
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php" ?> 
</head>
<body>
    <?php include "includes/navber.php" ?>
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">View Order</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="my-orders.php">My Orders</a></li>
            <li class="breadcrumb-item">View Order</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="crad-header">
                            View Order
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>   
</body>
</html> 
