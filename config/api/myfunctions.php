<?php

include "C:/xampp/htdocs/project1/config/connect.php";

function getAll($table)
{
    global $pdo;
    $query = "SELECT * FROM " . $table;
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getByID($table, $id)
{
    global $pdo;

    $query = "SELECT * FROM `$table` WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header("Location: $url");
    exit();
}
function getAllOrders()
{
    global $pdo;
    $query = "SELECT * FROM orders WHERE status = :status ";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['status' => 0]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>



