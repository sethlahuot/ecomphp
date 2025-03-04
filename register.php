<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Signup Form</title>
    <link rel="stylesheet" href="css/SignUp_LogIn_Form.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">  
        <!-- Login Form -->
        <div class="form-box login">
            <form action="config/api/authcode.php" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="login_btn" class="btn">Login</button>
            </form>
        </div>

        <!-- Registration Form -->
        <div class="form-box register">
            <form action="config/api/authcode.php" method="POST">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['name'] ?? '') ?>" placeholder="Username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" placeholder="Email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" name="register_btn" class="btn">Register</button>
            </form>
        </div>

        <!-- Toggle Box -->
        <div class="toggle-box">
            <div  class="toggle-panel toggle-left">
              <img src="img/logo.png" alt="">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        <strong style="color: red;">Warning!</strong> <?= htmlspecialchars($_SESSION['message']); ?>
                    </div>
                    <?php unset($_SESSION['message']); 
                    endif; 
                ?>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an account?</p>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        <strong style="color: red;">Warning!</strong> <?= htmlspecialchars($_SESSION['message']); ?>
                    </div>
                    <?php unset($_SESSION['message']); 
                    endif; 
                ?>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
    <!-- Alert Message -->
    
    <!-- JavaScript for Form Toggle -->
    <script>
        const container = document.querySelector('.container');
        document.querySelector('.register-btn').addEventListener('click', () => {
            container.classList.add('active');
        });
        document.querySelector('.login-btn').addEventListener('click', () => {
            container.classList.remove('active');
        });
    </script>
</body>
</html>