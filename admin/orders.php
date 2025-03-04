<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders History</h4>
                </div>
                    <?php 
                    $orders = getAllOrders();
                    ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                
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
                                    <td><?= htmlspecialchars($item['name']); ?></td>
                                    <td><?= htmlspecialchars($item['tracking_no']); ?></td>
                                    <td><?= htmlspecialchars($item['total_price']); ?> $</td>
                                    <td><?= htmlspecialchars($item['created_at']); ?></td>
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
</div>
    <?php include "includes/footer.php" ?>