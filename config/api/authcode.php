<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/ecomphp/config/connect.php";
require_once "myfunctions.php";
session_start(); 
if (isset($_POST['register_btn'])) 
{
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $check_email_query = "SELECT email FROM user WHERE email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = "Email already registered!";
            header('Location: ../../register.php');
            exit();
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $pdo->prepare($insert_query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../../register.php');
                exit();
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header('Location: ../../register.php');
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }
}
else if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        $login_query = "SELECT * FROM user WHERE email = :email AND password = :password";
        $stmt = $pdo->prepare($login_query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $_SESSION['auth'] = true;
            $userdata = $stmt->fetch(PDO::FETCH_ASSOC);

            $userId = $userdata['id'];
            $username = $userdata['name'];
            $useremail = $userdata['email']; 
            $role_as = $userdata['role_as']; 
            $_SESSION['auth_user'] = [
                'user_id' => $userId,
                'name' => $username,
                'email' => $useremail
            ];
            $_SESSION['role_as'] = $role_as;

            if($role_as == 1)
            {
                redirect("../../admin/index.php","Welcome To Dashboard");
            }
            else
            {
                redirect("../../index.php","Logged In Successfully");
            }
        } else {
            redirect("../../register.php","Email or Password is incorrced");
        }
    } catch (PDOException $e) {
        echo "Error at login: " . $e->getMessage();
    }
}
?>