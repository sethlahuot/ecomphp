<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../config/connect.php";

if (isset($_POST['save_setting_btn'])) {
    try {
        $image_name = null;
        
        // Handle image upload if provided
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['image']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            
            // Validate file type
            if(!in_array(strtolower($filetype), $allowed)) {
                $_SESSION['message'] = "Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.";
                header('Location: settings.php');
                exit();
            }

            // Create uploads directory if it doesn't exist
            $upload_dir = "../uploads/";
            if(!file_exists($upload_dir)) {
                if(!mkdir($upload_dir, 0777, true)) {
                    $_SESSION['message'] = "Failed to create upload directory.";
                    header('Location: settings.php');
                    exit();
                }
            }

            $image_name = time() . '_' . $filename;
            $upload_path = $upload_dir . $image_name;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $_SESSION['message'] = "Failed to upload image. Error: " . error_get_last()['message'];
                header('Location: settings.php');
                exit();
            }
        }

        // Check if settings already exist
        $check = $pdo->query("SELECT COUNT(*) FROM settings")->fetchColumn();
        
        if($check > 0) {
            // Update existing settings
            if($image_name) {
                $stmt = $pdo->prepare("UPDATE settings SET 
                    image = :image,
                    title = :title,
                    slug = :slug,
                    meta_description = :meta_description,
                    small_description = :small_description,
                    about_description1 = :about_description1,
                    about_description2 = :about_description2,
                    about_description3 = :about_description3,
                    about_description4 = :about_description4,
                    email1 = :email1,
                    email2 = :email2,
                    phone1 = :phone1,
                    phone2 = :phone2,
                    address = :address,
                    contact_description = :contact_description
                    WHERE id = 1");
            } else {
                $stmt = $pdo->prepare("UPDATE settings SET 
                    title = :title,
                    slug = :slug,
                    meta_description = :meta_description,
                    small_description = :small_description,
                    about_description1 = :about_description1,
                    about_description2 = :about_description2,
                    about_description3 = :about_description3,
                    about_description4 = :about_description4,
                    email1 = :email1,
                    email2 = :email2,
                    phone1 = :phone1,
                    phone2 = :phone2,
                    address = :address,
                    contact_description = :contact_description
                    WHERE id = 1");
            }
        } else {
            // Insert new settings
            if(!$image_name) {
                $_SESSION['message'] = "Image is required for new settings.";
                header('Location: settings.php');
                exit();
            }
            
            $stmt = $pdo->prepare("INSERT INTO settings (
                image, title, slug, meta_description, small_description,
                about_description1, about_description2, about_description3, about_description4,
                email1, email2, phone1, phone2, address, contact_description
            ) VALUES (
                :image, :title, :slug, :meta_description, :small_description,
                :about_description1, :about_description2, :about_description3, :about_description4,
                :email1, :email2, :phone1, :phone2, :address, :contact_description
            )");
        }

        // Prepare parameters
        $params = [
            ':title' => $_POST['title'],
            ':slug' => $_POST['slug'],
            ':meta_description' => $_POST['meta_description'],
            ':small_description' => $_POST['small_description'],
            ':about_description1' => $_POST['about_description1'],
            ':about_description2' => $_POST['about_description2'],
            ':about_description3' => $_POST['about_description3'],
            ':about_description4' => $_POST['about_description4'],
            ':email1' => $_POST['email1'],
            ':email2' => $_POST['email2'],
            ':phone1' => $_POST['phone1'],
            ':phone2' => $_POST['phone2'],
            ':address' => $_POST['address'],
            ':contact_description' => $_POST['contact_description']
        ];

        // Add image parameter if provided
        if($image_name) {
            $params[':image'] = $image_name;
        }

        // Execute the statement
        $stmt->execute($params);

        $_SESSION['message'] = "Settings saved successfully!";
        header('Location: settings.php');
        exit();

    } catch (PDOException $e) {
        $_SESSION['message'] = "Database Error: " . $e->getMessage();
        header('Location: settings.php');
        exit();
    }
}
?>