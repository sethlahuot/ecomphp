<?php
include "connect.php";

if (!function_exists('getAllActive')) {
    function getAllActive($table)
    {
        global $pdo;
        $query = "SELECT * FROM $table WHERE status = :status";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['status' => 0]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getSlugActive')) {
    function getSlugActive($table, $slug) 
    {
        global $pdo;
        $query = "SELECT * FROM $table WHERE LOWER(slug) = LOWER(:slug) AND status = 0 LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo()); 
            exit();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getProdByCategory')) {
    function getProdByCategory($category_id)
    {
        global $pdo;
        $query = "SELECT * FROM product WHERE category_id = :category_id AND status = :status";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'category_id' => $category_id,
            'status' => 0
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('get4Products')) {
    function get4Products($table) 
    {
        global $pdo;
        $query = "SELECT * FROM $table WHERE status = :status ORDER BY id DESC LIMIT 4";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['status' => 0]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getIDActive')) {
    function getIDActive($table, $id)
    {
        global $pdo;
        $query = "SELECT * FROM `$table` WHERE id = :id AND status = :status";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id, 'status' => 0]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if (!function_exists('getCartItems')) {
    function getCartItems()
    {
        global $pdo;
        $userId = $_SESSION['auth_user']['user_id'] ?? null;
        if (!$userId) {
            $_SESSION['message'] = "Please login to view your cart";
            header("Location: login.php");
            exit();
        }
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price
                  FROM carts c 
                  JOIN product p ON c.prod_id = p.id 
                  WHERE c.user_id = :user_id 
                  ORDER BY c.id DESC";
        $stmt = $pdo->prepare($query);
        if (!$stmt->execute([':user_id' => $userId])) {
            $_SESSION['message'] = "Error retrieving cart items. Please try again later.";
            return false;
        }
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($items)) {
            return false; 
        }
        return $items;
    }
}

if (!function_exists('getOrders')) {
    function getOrders()
    {
        global $pdo;
        $userId = $_SESSION['auth_user']['user_id'] ?? null;
        if (!$userId) {
            echo "<h1>Please login first!</h1>";
            exit();
        }
        $query = "SELECT * FROM orders WHERE user_id = :user_id";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':user_id' => $userId]);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $orders ?: [];
    }
}

if (!function_exists('redirect_user')) {
    function redirect_user($url, $message) 
    {
        $_SESSION['message'] = $message;
        header("Location: $url");
        exit();
    }
}

if (!function_exists('checkTrackingNoValid')) {
    function checkTrackingNoValid($trackingNo)
    {
        global $pdo;
        $userId = $_SESSION['auth_user']['user_id'] ?? null;
        if (!$userId) {
            echo "<h1>Please login first!</h1>";
            exit();
        }
        $query = "SELECT * FROM orders WHERE tracking_no = :tracking AND user_id = :user_id";
        $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':tracking' => $trackingNo,
                ':user_id' => $userId
            ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>