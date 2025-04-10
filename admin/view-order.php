<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 

if (!isset($_GET['id'])) {
    echo "<h4>Something went wrong</h4>";
    die();
}

$order_id = $_GET['id'];
global $pdo;

// Get order details
$order_query = "SELECT o.*, u.name as user_name 
                FROM orders o 
                LEFT JOIN user u ON o.user_id = u.id 
                WHERE o.id = :order_id";
$stmt = $pdo->prepare($order_query);
$stmt->execute(['order_id' => $order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<h4>Order not found</h4>";
    die();
}

// Get order items
$order_items_query = "SELECT oi.*, p.name as product_name, p.image 
                      FROM order_items oi 
                      JOIN product p ON oi.prod_id = p.id 
                      WHERE oi.order_id = :order_id";
$stmt = $pdo->prepare($order_items_query);
$stmt->execute(['order_id' => $order_id]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details
                        <a href="orders.php" class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <hr>
                            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']); ?></p>
                            <p><strong>Tracking No:</strong> <?= htmlspecialchars($order['tracking_no']); ?></p>
                            <p><strong>Order Date:</strong> <?= date('F j, Y', strtotime($order['created_at'])); ?></p>
                            <p><strong>Order Status:</strong> 
                                <span class="badge bg-<?= $order['status'] == 1 ? 'success' : 'warning'; ?>">
                                    <?= $order['status'] == 1 ? 'Completed' : 'Processing'; ?>
                                </span>
                            </p>
                            <p><strong>Payment Mode:</strong> <?= htmlspecialchars($order['payment_mode']); ?></p>
                            <?php if($order['payment_id']): ?>
                                <p><strong>Payment ID:</strong> <?= htmlspecialchars($order['payment_id']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <hr>
                            <p><strong>Name:</strong> <?= htmlspecialchars($order['name']); ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($order['email']); ?></p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']); ?></p>
                            <p><strong>Address:</strong> <?= htmlspecialchars($order['address']); ?></p>
                            <p><strong>Pincode:</strong> <?= htmlspecialchars($order['pincode']); ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Order Items</h5>
                            <hr>
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
                                    foreach ($order_items as $item) {
                                        $subtotal = $item['price'] * $item['qty'];
                                        $total += $subtotal;
                                        ?>
                                        <tr>
                                            <td class="align-middle">
                                                <img src="../uploads/<?= htmlspecialchars($item['image']); ?>" 
                                                     width="50px" height="50px" 
                                                     alt="<?= htmlspecialchars($item['product_name']); ?>">
                                                <?= htmlspecialchars($item['product_name']); ?>
                                            </td>
                                            <td class="align-middle"><?= number_format($item['price'], 2); ?>$</td>
                                            <td class="align-middle"><?= htmlspecialchars($item['qty']); ?></td>
                                            <td class="align-middle"><?= number_format($subtotal, 2); ?>$</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total Amount:</strong></td>
                                        <td><strong><?= number_format($total, 2); ?>$</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>