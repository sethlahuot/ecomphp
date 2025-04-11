<?php
include "connect.php";

function getTotalProducts() {
    global $pdo;
    $query = "SELECT COUNT(*) as total FROM product WHERE status = 0";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function getTotalUsers() {
    global $pdo;
    $query = "SELECT COUNT(*) as total FROM user";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function getTotalOrders() {
    global $pdo;
    $query = "SELECT COUNT(*) as total FROM orders";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

function getTotalSales() {
    global $pdo;
    $query = "SELECT SUM(total_price) as total FROM orders";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    return $total ? $total : 0;
}
?> 