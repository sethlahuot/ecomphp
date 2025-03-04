<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "config/userfunctions.php";
include "config/connect.php";

if (!isset($_GET['t'])) {
    echo "<h4>Something went wrong</h4>";
    die();
}
$tracking_no = $_GET['t'];
$orderdata = checkTrackingNoValid($tracking_no);
global $pdo;
    $userId = $_SESSION['auth_user']['user_id'] ?? null;
    if (!$userId) {
        echo "<h1>Please login first!</h1>";
        exit();
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
                                <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, p.* 
                                            FROM orders o
                                            JOIN order_items oi ON oi.order_id = o.id
                                            JOIN product p ON p.id = oi.prod_id
                                            WHERE o.user_id = :user_id AND o.tracking_no = :tracking_no";
                                            $stmt = $pdo->prepare($order_query);
                                            $stmt->execute(['user_id' => $userId, 'tracking_no' => $tracking_no]);
                                            $order_query_run = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            echo "<pre>";
                                            print_r($order_query_run);
                                            echo "</pre>";
                                            if ($order_query_run) {
                                                foreach ($order_query_run as $item) {
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="uploads/<?= htmlspecialchars($item['image']); ?>" width="50px" height="50px" alt="<?= htmlspecialchars($item['name']); ?>">
                                                            <?= htmlspecialchars($item['name']); ?>
                                                        </td>
                                                        <td class="align-middle">
                                                        <?= htmlspecialchars($item['price']); ?>$
                                                        </td>
                                                        <td class="align-middle">
                                                        <?= htmlspecialchars($item['qty']); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                echo "<h4>error other</h4>";
                                                die();
                                            }
                                        ?>              
                                    </tbody>
                                </table>
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
