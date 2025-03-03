<?php 
include "config/userfunctions.php";  
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
        <h1 class="text-center text-white display-6">My Order</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">My Order</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">

                    <?php 
                    $orders = getOrders();

                    
                    ?>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if ($orders) 
                        {
                            foreach ($orders as $item){
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['id']); ?></td>
                                    <td><?= htmlspecialchars($item['tracking_no']); ?></td>
                                    <td><?= htmlspecialchars($item['total_price']); ?> $</td>
                                    <td><?= htmlspecialchars($item['created_at']); ?></td>
                                    <td>
                                        <a href="view-order.php?t=<?= htmlspecialchars($item['tracking_no']); ?>" class="btn btn-primary">View details</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else {
                            ?>
                            <tr>
                                <td colspan="5">No orders yet</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>   
</body>
</html> 
