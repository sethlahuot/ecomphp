<?php 
session_start();
include "../config/connect.php";
include "../config/api/myfunctions.php";

if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    
    $image = $_FILES['image']['name'];

    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;
    
    try {
        $query = "INSERT INTO category (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image) 
                  VALUES (:name, :slug, :description, :meta_title, :meta_description, :meta_keywords, :status, :popular, :image)";
        
        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':meta_title', $meta_title);
        $stmt->bindParam(':meta_description', $meta_description);
        $stmt->bindParam(':meta_keywords', $meta_keywords);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':popular', $popular);
        $stmt->bindParam(':image', $filename);
        
        if ($stmt->execute()) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            redirect("index.php?p=add-category", "Add Category Successfully");
        } else {
            redirect("index.php?p=add-category", "Something was Wrong");
        }
    } catch (PDOException $e) {
        redirect("index.php?p=add-category", "Database Error: " . $e->getMessage());
    }
}
else if (isset($_POST['update_category_btn'])) {


    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    $path = "../uploads/";

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    try {
        $update_query = "UPDATE category SET 
            name = :name, 
            slug = :slug, 
            description = :description, 
            meta_title = :meta_title, 
            meta_description = :meta_description, 
            meta_keywords = :meta_keywords, 
            status = :status, 
            popular = :popular, 
            image = :image 
            WHERE id = :category_id";

        $stmt = $pdo->prepare($update_query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':meta_title', $meta_title);
        $stmt->bindParam(':meta_description', $meta_description);
        $stmt->bindParam(':meta_keywords', $meta_keywords);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':popular', $popular);
        $stmt->bindParam(':image', $update_filename);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            if ($new_image != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . $update_filename);
                if (file_exists($path . $old_image)) {
                    unlink($path . $old_image);
                }
            }
            redirect("edit-category.php?id=$category_id", "Category Updated Successfully");
        } else {
            redirect("edit-category.php?id=$category_id", "Something went wrong");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else if (isset($_POST['delete_category_btn'])) {
    try {
        $category_id = $_POST['category_id'];
        $stmt = $pdo->prepare("SELECT image FROM category WHERE id = :category_id");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        $category_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($category_data) {
            $image = $category_data['image'];
            $delete_stmt = $pdo->prepare("DELETE FROM category WHERE id = :category_id");
            $delete_stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            if ($delete_stmt->execute()) {
                $image_path = "../uploads/" . $image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                //redirect("category.php", "Category deleted successfully");
                echo 200;
            } else {
                //redirect("category.php", "Something went wrong while deleting");
                echo 500;
            }
        } else {
            redirect("category.php", "Category not found");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "" && $slug != "" && $description != "") 
    {
        try {
            $query = "INSERT INTO product 
                (category_id, name, slug, small_description, description, original_price, selling_price, 
                qty, meta_title, meta_description, meta_keywords, status, trending, image) 
                VALUES 
                (:category_id, :name, :slug, :small_description, :description, :original_price, :selling_price, 
                :qty, :meta_title, :meta_description, :meta_keywords, :status, :trending, :image)";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':slug', $slug);
            $stmt->bindParam(':small_description', $small_description);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':original_price', $original_price);
            $stmt->bindParam(':selling_price', $selling_price);
            $stmt->bindParam(':qty', $qty);
            $stmt->bindParam(':meta_title', $meta_title);
            $stmt->bindParam(':meta_description', $meta_description);
            $stmt->bindParam(':meta_keywords', $meta_keywords);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':trending', $trending);
            $stmt->bindParam(':image', $filename);
            if ($stmt->execute()) 
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
                redirect("add-product.php", "Product Added Successfully");
            } 
            else 
            {
                redirect("add-product.php", "Something went wrong");
            }
        } catch (PDOException $e) {
            redirect("add-product.php", "Database Error: " . $e->getMessage());
        }
    } 
    else 
    {
        redirect("add-product.php", "All fields are mandatory");
    }
}
else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    
    $path = "../uploads/";
    
    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    try {
        $update_query = "UPDATE product SET 
            category_id = :category_id, 
            name = :name, 
            slug = :slug, 
            small_description = :small_description, 
            description = :description, 
            original_price = :original_price, 
            selling_price = :selling_price, 
            qty = :qty, 
            meta_title = :meta_title, 
            meta_description = :meta_description, 
            meta_keywords = :meta_keywords, 
            status = :status, 
            trending = :trending, 
            image = :image 
            WHERE id = :product_id";

        $stmt = $pdo->prepare($update_query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':small_description', $small_description);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':original_price', $original_price);
        $stmt->bindParam(':selling_price', $selling_price);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':meta_title', $meta_title);
        $stmt->bindParam(':meta_description', $meta_description);
        $stmt->bindParam(':meta_keywords', $meta_keywords);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':trending', $trending);
        $stmt->bindParam(':image', $update_filename);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            if ($new_image != "") {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . $update_filename);
                if (file_exists($path . $old_image)) {
                    unlink($path . $old_image);
                }
            }
            redirect("edit-product.php?id=$product_id", "Product Updated Successfully");
        } else {
            redirect("edit-product.php?id=$product_id", "Something went wrong");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else if (isset($_POST['delete_product_btn'])) {
    try {
        $product_id = $_POST['product_id'];
        $stmt = $pdo->prepare("SELECT image FROM product WHERE id = :product_id");
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $product_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($product_data) {
            $image = $product_data['image'];
            $delete_stmt = $pdo->prepare("DELETE FROM product WHERE id = :product_id");
            $delete_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            if ($delete_stmt->execute()) {
                $image_path = "../uploads/" . $image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                //redirect("products.php", "Product deleted successfully");
                echo 200;
            } else {
                //redirect("products.php", "Something went wrong while deleting");
                echo 500;
            }
        } else {
            redirect("products.php", "product not found");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>
