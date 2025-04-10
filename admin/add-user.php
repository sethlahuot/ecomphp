<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
include "../config/connect.php"; // Include the PDO connection file

// Function to add new user
function addNewUser($name, $email, $password, $role_as) {
    global $pdo; // Use the PDO connection

    try {
        // Check if email already exists
        $check_email_query = "SELECT email FROM user WHERE email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            $_SESSION['message'] = "Email already exists";
            return false;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user using prepared statement
        $query = "INSERT INTO user (name, email, password, role_as) VALUES (:name, :email, :password, :role_as)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role_as', $role_as);
        
        if($stmt->execute()) {
            $_SESSION['message'] = "User added successfully";
            header('Location: users.php');
            exit();
            return true;
        } else {
            $_SESSION['message'] = "Something went wrong";
            return false;
        }
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        return false;
    }
}

// Handle form submission
if(isset($_POST['add_user_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];

    addNewUser($name, $email, $password, $role_as);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add User</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Name..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="Enter Email..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Role</label>
                                <select name="role_as" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Password</label>
                                <input type="password" name="password" placeholder="Enter Password..." class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="add_user_btn">Save</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>