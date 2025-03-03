<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "connect.php";
if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $userId = $_SESSION['auth_user']['user_id'] ?? null;
                if (!$userId) {
                    echo "<h1>Please login first!</h1>";
                    exit();
                }

                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $phone = $_POST['phone'] ?? '';
                $pincode = $_POST['pincode'] ?? '';
                $address = $_POST['address'] ?? '';
                $payment_mode = $_POST['payment_mode'] ?? 'COD';
                $payment_id = $_POST['payment_id'] ?? '';

                if ($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "") {
                    $_SESSION['message'] = "All fields are mandatory";
                    header("Location: ../checkout.php");
                    exit();
                }

                $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price
                          FROM carts c 
                          JOIN product p ON c.prod_id = p.id 
                          WHERE c.user_id = :user_id 
                          ORDER BY c.id DESC";
                $stmt = $pdo->prepare($query);
                $stmt->execute([':user_id' => $userId]);
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($items)) {
                    echo "No cart items found for user_id = $userId";
                    exit();
                }

                $totalPrice = 0;
                foreach ($items as $citem) {
                    $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                }

                if (strlen($phone) < 3) {
                    echo "<h1>Invalid phone number</h1>";
                    exit();
                }

                $tracking_no = "sharmacoder" . rand(1111, 9999) . substr($phone, 2);

                $insert_query = "INSERT INTO orders 
                                (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) 
                                VALUES (:tracking_no, :user_id, :name, :email, :phone, :address, :pincode, :total_price, :payment_mode, :payment_id)";
                $stmt = $pdo->prepare($insert_query);
                $stmt->execute([
                    ':tracking_no' => $tracking_no,
                    ':user_id' => $userId,
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':address' => $address,
                    ':pincode' => $pincode,
                    ':total_price' => $totalPrice,
                    ':payment_mode' => $payment_mode,
                    ':payment_id' => $payment_id
                ]);

                $order_id = $pdo->lastInsertId();
                foreach ($items as $citem) {
                    $prod_id = $citem['prod_id'];
                    $prod_qty = $citem['prod_qty'];
                    $price = $citem['selling_price'];
                    $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) 
                                           VALUES (:order_id, :prod_id, :qty, :price)";
                    $stmt = $pdo->prepare($insert_items_query);
                    $stmt->execute([
                        ':order_id' => $order_id,
                        ':prod_id' => $prod_id,
                        ':qty' => $prod_qty,
                        ':price' => $price
                    ]);
                    $product_query = "SELECT qty FROM product WHERE id = :prod_id LIMIT 1";
                    $stmt = $pdo->prepare($product_query);
                    $stmt->execute([':prod_id' => $prod_id]);
                    $productData = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    if (!$productData) {
                        echo "Product with ID $prod_id not found!";
                        exit();
                    }
                    $current_qty = $productData['qty'];
                    $new_qty = max(0, $current_qty - $prod_qty);
                    $updateQty_query = "UPDATE product SET qty = :new_qty WHERE id = :prod_id";
                    $stmt = $pdo->prepare($updateQty_query);
                    if (!$stmt->execute([':new_qty' => $new_qty, ':prod_id' => $prod_id])) {
                        print_r($stmt->errorInfo()); 
                        exit();
                    }
                }
                $delete_cart_query = "DELETE FROM carts WHERE user_id = :user_id";
                $stmt = $pdo->prepare($delete_cart_query);
                $stmt->execute([':user_id' => $userId]);

                $_SESSION['message'] = "Order placed successfully";
                header('Location: ../my-orders.php');
                exit();

            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
                exit();
            }
        }
    }
} else {
    $_SESSION['message'] = "Please login first!";
    header('Location: ../index.php');
    exit();
}
?>
