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
if (!$orderdata) {
    echo "<h4>Invalid tracking number</h4>";
    die();
}

global $pdo;
$userId = $_SESSION['auth_user']['user_id'] ?? null;
if (!$userId) {
    echo "<h1>Please login first!</h1>";
    exit();
}

// Get complete order details
$order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.qty as order_qty, oi.price as order_price, p.* 
                FROM orders o
                JOIN order_items oi ON oi.order_id = o.id
                JOIN product p ON p.id = oi.prod_id
                WHERE o.user_id = :user_id AND o.tracking_no = :tracking_no";
$stmt = $pdo->prepare($order_query);
$stmt->execute(['user_id' => $userId, 'tracking_no' => $tracking_no]);
$order_query_run = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$order_query_run) {
    echo "<h4>No order items found for this tracking number.</h4>";
    die();
}

// Get the first row for order details
$orderDetails = $order_query_run[0];
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
                        <div class="card-header">
                            <h4>Order Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5>Order Information</h5>
                                    <p><strong>Tracking Number:</strong> <?= htmlspecialchars($tracking_no); ?></p>
                                    <p><strong>Order Date:</strong> <?= date('F j, Y', strtotime($orderDetails['created_at'])); ?></p>
                                    <p><strong>Order Status:</strong> 
                                        <span class="badge bg-<?= $orderDetails['status'] == 'completed' ? 'success' : ($orderDetails['status'] == 'processing' ? 'warning' : 'danger'); ?>">
                                            <?= htmlspecialchars($orderDetails['status']); ?>
                                        </span>
                                    </p>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Order Items</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $total = 0;
                                                foreach ($order_query_run as $item) {
                                                    $subtotal = $item['order_price'] * $item['order_qty'];
                                                    $total += $subtotal;
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="uploads/<?= htmlspecialchars($item['image']); ?>" width="50px" height="50px" alt="<?= htmlspecialchars($item['name']); ?>">
                                                                <?= htmlspecialchars($item['name']); ?>
                                                        </td>
                                                        <td class="align-middle">
                                                        <?= number_format($item['order_price'], 2); ?>$
                                                        </td>
                                                        <td class="align-middle">
                                                        <?= htmlspecialchars($item['order_qty']); ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?= number_format($subtotal, 2); ?>$
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Total Amount:</strong></td>
                                                        <td><strong><?= number_format($total, 2); ?>$</strong></td>
                                                    </tr>
                                                    <?php
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
