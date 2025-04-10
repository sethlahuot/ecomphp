<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
include "../config/connect.php";

// Handle user deletion
if(isset($_POST['delete_user_btn'])) {
    try {
        $user_id = $_POST['user_id'];
        // Check if user exists first
        $check_stmt = $pdo->prepare("SELECT id FROM user WHERE id = :user_id");
        $check_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $check_stmt->execute();
        
        if ($check_stmt->rowCount() > 0) {
            $delete_stmt = $pdo->prepare("DELETE FROM user WHERE id = :user_id");
            $delete_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            
            if ($delete_stmt->execute()) {
                $_SESSION['message'] = "User deleted successfully";
                header("Location: users.php");
                exit();
            } else {
                $_SESSION['message'] = "Failed to delete user";
                header("Location: users.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "User not found";
            header("Location: users.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
        header("Location: users.php");
        exit();
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User</h4>
                    <a href="add-user.php" class="btn btn-primary float-end">Create</a>
                </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>role_as</th>
                                <th>Edit</th>
                                <th>Delete</th> 
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                            $query = "SELECT * FROM user ORDER BY id DESC";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if($users) {
                                foreach($users as $user) {
                                    ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['role_as'] == 1 ? 'Admin' : 'User' ?></td>
                                        <td>
                                            <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                <button type="submit" name="delete_user_btn" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No users found</td>
                                </tr>
                                <?php
                            }
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include "includes/footer.php" ?>