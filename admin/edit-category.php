<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php 
            if (isset($_GET['id'])) 
            {
                $id = $_GET['id'];
                $category = getByID("category", $id);
                if ($category) {  
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category
                            <a href="category.php" class="btn btn-primary float-end">Back</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="db_category.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="category_id" value="<?= htmlspecialchars($category['id']) ?>">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" placeholder="Enter Category Name..." class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Slug</label>
                                        <input type="text" name="slug" value="<?= htmlspecialchars($category['slug']) ?>" placeholder="Enter Slug..." class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea rows="3" name="description" placeholder="Enter The Description..." class="form-control"><?= htmlspecialchars($category['description']) ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($category['image']); ?>">
                                        <img src="../uploads/<?= htmlspecialchars($category['image']); ?>" heigh="50px" width="50px" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?= htmlspecialchars($category['meta_title']) ?>" placeholder="Enter The Meta Title..." class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter The Meta Description..." class="form-control"><?= htmlspecialchars($category['meta_description']) ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter The Meta Keywords..." class="form-control"><?= htmlspecialchars($category['meta_keywords']) ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <input type="checkbox" <?= $category['status'] ? "checked" : "" ?> name="status">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Popular</label>
                                        <input type="checkbox" <?= $category['popular'] ? "checked" : "" ?> name="popular">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_category_btn">Update</button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "Category not found!";
                }
            } else {
                echo "ID missing from URL!";
            }
            ?>

        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>