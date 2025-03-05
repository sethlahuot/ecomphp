<?php
require_once 'connect.php'; // Ensure connect.php initializes $pdo correctly

try {
    // Function to create a user
    function createUser($pdo, $name, $email, $password, $role_as = 1) {
        $query = "INSERT INTO user (name, email, password, role_as) VALUES (:name, :email, :password, :role_as)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password, 
            ':role_as' => $role_as
        ]);
        return $pdo->lastInsertId();
    }

    // Ensure $pdo is available
    if (!isset($pdo)) {
        throw new Exception("Database connection is missing.");
    }
    $userId = createUser($pdo, 'admin', 'admin@gmail.com', '123'); // Storing password as plain text
    echo "User created with ID: " . $userId;

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
