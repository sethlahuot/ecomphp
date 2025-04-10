<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/head.php" ?> 
    <style>
        .view-mode {
            display: block;
        }
        .edit-mode {
            display: none;
        }
        .edit-btn {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include "includes/navber.php" ?>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">My Account</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item">My Account</li>
        </ol>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Personal Information</h4>
                        <button class="btn btn-primary edit-btn" onclick="toggleEdit('profile')">Edit Profile</button>
                    </div>
                    <div class="card-body">
                        <?php
                            require_once "config/connect.php";
                            $user_id = $_SESSION['auth_user']['user_id'];
                            
                            // Handle profile update
                            if(isset($_POST['update_btn'])) {
                                $name = $_POST['name'];
                                $email = $_POST['email'];
                                
                                // Check if email already exists for another user
                                $check_email = "SELECT id FROM user WHERE email = :email AND id != :user_id";
                                $stmt = $pdo->prepare($check_email);
                                $stmt->bindParam(':email', $email);
                                $stmt->bindParam(':user_id', $user_id);
                                $stmt->execute();
                                
                                if($stmt->rowCount() > 0) {
                                    echo '<div class="alert alert-danger">Email already exists!</div>';
                                } else {
                                    // Update user information
                                    $update_query = "UPDATE user SET name = :name, email = :email WHERE id = :user_id";
                                    $stmt = $pdo->prepare($update_query);
                                    $stmt->bindParam(':name', $name);
                                    $stmt->bindParam(':email', $email);
                                    $stmt->bindParam(':user_id', $user_id);
                                    
                                    if($stmt->execute()) {
                                        // Update session data
                                        $_SESSION['auth_user']['name'] = $name;
                                        $_SESSION['auth_user']['email'] = $email;
                                        echo '<div class="alert alert-success">Profile updated successfully!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger">Something went wrong!</div>';
                                    }
                                }
                            }

                            // Handle password change
                            if(isset($_POST['change_password_btn'])) {
                                $current_password = $_POST['current_password'];
                                $new_password = $_POST['new_password'];
                                $confirm_password = $_POST['confirm_password'];
                                
                                // Get current password from database
                                $get_password = "SELECT password FROM user WHERE id = :user_id";
                                $stmt = $pdo->prepare($get_password);
                                $stmt->bindParam(':user_id', $user_id);
                                $stmt->execute();
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                
                                if($current_password !== $user['password']) {
                                    echo '<div class="alert alert-danger">Current password is incorrect!</div>';
                                } elseif($new_password !== $confirm_password) {
                                    echo '<div class="alert alert-danger">New passwords do not match!</div>';
                                } elseif(strlen($new_password) < 6) {
                                    echo '<div class="alert alert-danger">Password must be at least 6 characters long!</div>';
                                } else {
                                    // Update password
                                    $update_password = "UPDATE user SET password = :password WHERE id = :user_id";
                                    $stmt = $pdo->prepare($update_password);
                                    $stmt->bindParam(':password', $new_password);
                                    $stmt->bindParam(':user_id', $user_id);
                                    
                                    if($stmt->execute()) {
                                        echo '<div class="alert alert-success">Password changed successfully!</div>';
                                    } else {
                                        echo '<div class="alert alert-danger">Something went wrong!</div>';
                                    }
                                }
                            }
                            
                            // Get current user data
                            $query = "SELECT name, email FROM user WHERE id = :user_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':user_id', $user_id);
                            $stmt->execute();
                            
                            if($stmt->rowCount() > 0) {
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <!-- View Mode -->
                        <div id="profile-view" class="view-mode">
                            <div class="mb-3">
                                <h5>Name</h5>
                                <p><?= htmlspecialchars($user['name']) ?></p>
                            </div>
                            <div class="mb-3">
                                <h5>Email</h5>
                                <p><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                        </div>

                        <!-- Edit Mode -->
                        <div id="profile-edit" class="edit-mode">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="update_btn" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" onclick="toggleEdit('profile')">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Change Password</h5>
                            <button class="btn btn-primary edit-btn" onclick="toggleEdit('password')">Change Password</button>
                        </div>

                        <!-- Password Change Form -->
                        <div id="password-edit" class="edit-mode">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm New Password</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="submit" name="change_password_btn" class="btn btn-primary">Save Password</button>
                                    <button type="button" class="btn btn-secondary" onclick="toggleEdit('password')">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <?php
                            } else {
                                echo '<p class="text-danger">User information not found</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEdit(section) {
            if(section === 'profile') {
                const viewMode = document.getElementById('profile-view');
                const editMode = document.getElementById('profile-edit');
                
                if(viewMode.style.display === 'block') {
                    viewMode.style.display = 'none';
                    editMode.style.display = 'block';
                } else {
                    viewMode.style.display = 'block';
                    editMode.style.display = 'none';
                }
            } else if(section === 'password') {
                const passwordEdit = document.getElementById('password-edit');
                
                if(passwordEdit.style.display === 'none') {
                    passwordEdit.style.display = 'block';
                } else {
                    passwordEdit.style.display = 'none';
                }
            }
        }
    </script>

    <?php include "includes/footer.php" ?>   
</body>
</html> 
