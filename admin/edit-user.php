<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 

// Get user data
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    
    if($stmt->rowCount() > 0) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        redirect("users.php", "User not found");
    }
} else {
    redirect("users.php", "User ID not provided");
}

// Update user
if(isset($_POST['update_user_btn'])) {
    $user_id = $_GET['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_as = $_POST['role_as'];

    // Check if email already exists for other users
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email AND id != :id");
    $stmt->execute([
        'email' => $email,
        'id' => $user_id
    ]);

    if($stmt->rowCount() > 0) {
        redirect("edit-user.php?id=".$user_id, "Email already exists");
    }

    // Update user data
    $stmt = $pdo->prepare("UPDATE user SET name = :name, email = :email, role_as = :role_as WHERE id = :id");
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'role_as' => $role_as,
        'id' => $user_id
    ]);

    if($stmt->rowCount() > 0) {
        redirect("users.php", "User updated successfully");
    } else {
        redirect("edit-user.php?id=".$user_id, "Something went wrong");
    }
}

// Handle password change
if(isset($_POST['change_password_btn'])) {
    $user_id = $_GET['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Get current password hash
    $stmt = $pdo->prepare("SELECT password FROM user WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify current password
    if(!password_verify($current_password, $user['password'])) {
        redirect("edit-user.php?id=".$user_id, "Current password is incorrect");
    }

    // Check if new passwords match
    if($new_password !== $confirm_password) {
        redirect("edit-user.php?id=".$user_id, "New passwords do not match");
    }

    // Update password
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("UPDATE user SET password = :password WHERE id = :id");
    $stmt->execute([
        'password' => $hashed_password,
        'id' => $user_id
    ]);

    if($stmt->rowCount() > 0) {
        redirect("edit-user.php?id=".$user_id, "Password changed successfully");
    } else {
        redirect("edit-user.php?id=".$user_id, "Something went wrong");
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?= $user_data['name'] ?? '' ?>" placeholder="Enter Name..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Email</label>
                                <input type="email" name="email" value="<?= $user_data['email'] ?? '' ?>" placeholder="Enter Email..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Role</label>
                                <select name="role_as" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option value="0" <?= ($user_data['role_as'] == 0) ? 'selected' : '' ?>>User</option>
                                    <option value="1" <?= ($user_data['role_as'] == 1) ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="update_user_btn">Update Profile</button>
                            </div>
                        </div> 
                    </form>

                    <hr class="my-4">
                    
                    <h5 class="mb-3">Change Password</h5>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Current Password</label>
                                <input type="password" name="current_password" placeholder="Enter Current Password..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">New Password</label>
                                <input type="password" name="new_password" placeholder="Enter New Password..." class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Confirm New Password</label>
                                <input type="password" name="confirm_password" placeholder="Confirm New Password..." class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="change_password_btn">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>