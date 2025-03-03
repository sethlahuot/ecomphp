<?php
include "connect.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['auth'])) {
    echo 401; 
    exit();
}
if (isset($_POST['scope'])) {
    $scope = $_POST['scope'];

    switch ($scope) {
        case "add":
            if (!isset($_POST['prod_id'], $_POST['prod_qty'])) {
                echo 500; 
                exit();
            }

            $prod_id = $_POST['prod_id'];
            $prod_qty = $_POST['prod_qty'];
            $user_id = $_SESSION['auth_user']['user_id'];

            if (empty($prod_id) || empty($prod_qty)) {
                echo 500;
                exit();
            }

            try {
                $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES (:user_id, :prod_id, :prod_qty)";
                $stmt = $pdo->prepare($insert_query);
                $success = $stmt->execute([
                    ':user_id' => $user_id,
                    ':prod_id' => $prod_id,
                    ':prod_qty' => $prod_qty
                ]);

                if ($success) {
                    echo 201;
                } else {
                    echo 500;
                }
            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        break;
        case "update":
            if (!isset($_SESSION['auth_user']['user_id'])) {
                echo "User not logged in!";
                exit();
            }
        
            $prod_id = $_POST['prod_id'];
            $prod_qty = $_POST['prod_qty'];
            $user_id = $_SESSION['auth_user']['user_id'];
        
            try {
                // Check if the product exists in the cart
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = :prod_id AND user_id = :user_id";
                $stmt = $pdo->prepare($chk_existing_cart);
                $stmt->execute([
                    ':prod_id' => $prod_id,
                    ':user_id' => $user_id
                ]);
        
                if ($stmt->rowCount() > 0) {
                    // Update quantity
                    $update_query = "UPDATE carts SET prod_qty = :prod_qty WHERE prod_id = :prod_id AND user_id = :user_id";
                    $update_stmt = $pdo->prepare($update_query);
                    $update_status = $update_stmt->execute([
                        ':prod_qty' => $prod_qty,
                        ':prod_id' => $prod_id,
                        ':user_id' => $user_id
                    ]);
        
                    if ($update_status) {
                        echo 200; // Success
                    } else {
                        echo 500; // Update failed
                    }
                } else {
                    echo "Something went wrong. Product not found in cart.";
                }
            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        break;
        case "delete":           
            $cart_id = $_POST['cart_id'];
            $user_id = $_SESSION['auth_user']['user_id'];
            try {
                // Check if the product exists in the cart
                $chk_existing_cart = "SELECT * FROM carts WHERE id = :cart_id AND user_id = :user_id";
                $stmt = $pdo->prepare($chk_existing_cart);
                $stmt->execute([
                    ':cart_id' => $cart_id,
                    ':user_id' => $user_id
                ]);
        
                if ($stmt->rowCount() > 0) {
                    // Update quantity
                    $delete_query = "DELETE FROM carts WHERE id = :cart_id";
                    $delete_stmt = $pdo->prepare($delete_query);
                    $delete_status = $delete_stmt->execute([
                        ':cart_id' => $cart_id
                    ]);
        
                    if ($delete_status) {
                        echo 200; 
                    } else {
                        echo "something was wrong";
                    }
                } else {
                    echo "Something went wrong";
                }
            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }


        break;
    }
}
?>
