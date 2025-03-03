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
                $product = getByID("product", $id);
                if ($product && is_array($product)) { 
                ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit Product
                                <a href="products.php" class="btn btn-primary float-end">Back</a>
                            </h4>

                        </div>
                        <div class="card-body">
                            <form action="db_category.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-0">Select Category</label>
                                        <select name="category_id" class="form-select mb-2" required>
                                            <option selected>Select Category</option>
                                            <?php
                                                $category = getAll("category"); 
                                                if ($category && is_array($category) && count($category) > 0) { 
                                                    foreach ($category as $item) { 
                                            ?>
                                                <option value="<?= htmlspecialchars($item['id']); ?>" <?= isset($product['category_id']) && $product['category_id'] == $item['id'] ? 'selected' : '' ?> >
                                                <?= htmlspecialchars($item['name']); ?></option>
                                            <?php
                                                    }
                                                } else {
                                                    echo "<option disabled>No category available</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>"></input>
                                    <div class="col-md-6">
                                        <label class="mb-0">Name</label>
                                        <input type="text" required name="name" value="<?= htmlspecialchars($product['name']) ?>" placeholder="Enter Product Name..." class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Slug</label>
                                        <input type="text" required name="slug" value="<?= htmlspecialchars($product['slug']) ?>" placeholder="Enter Slug..." class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Small Description</label>
                                        <textarea rows="3" required name="small_description" placeholder="Enter Small Description..." class="form-control mb-2"><?= htmlspecialchars($product['small_description']) ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Description</label>
                                        <textarea rows="3" required name="description" placeholder="Enter Description..." class="form-control mb-2"><?= htmlspecialchars($product['description']) ?></textarea> 
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Original Price</label>
                                        <input type="text" required name="original_price" value="<?= htmlspecialchars($product['original_price']) ?>" placeholder="Enter Original Price..." class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Selling Price</label>
                                        <input type="text" required name="selling_price" value="<?= htmlspecialchars($product['selling_price']) ?>" placeholder="Enter Selling Price..." class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label class="mb-0">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?= htmlspecialchars($product['image']); ?>">
                                        <img src="../uploads/<?= htmlspecialchars($product['image']); ?>" heigh="50px" width="50px" alt="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-0">Quantity</label>
                                            <input type="number" required name="qty" value="<?=  htmlspecialchars($product['qty']) ?>" placeholder="Enter Quantity..." class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Status</label> <br>
                                            <input type="checkbox" <?= isset($product['status']) && $product['status'] ? "checked" : "" ?> name="status" >                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Trending</label> <br>
                                            <input type="checkbox" <?= isset($product['trending']) && $product['trending'] ? "checked" : "" ?> name="trending">                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Title</label>
                                        <input type="text" required name="meta_title" value="<?= htmlspecialchars($product['meta_title']) ?>" placeholder="Enter Meta Title..." class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Description</label>
                                        <textarea rows="3" required name="meta_description" placeholder="Enter Meta Description..." class="form-control mb-2"><?= htmlspecialchars($product['meta_description']) ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Keywords</label>
                                        <textarea rows="3" required name="meta_keywords" placeholder="Enter Meta Keywords..." class="form-control mb-2"><?= htmlspecialchars($product['meta_keywords']) ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php 
                }else{
                    echo "Product is not found";
                }
            }else{
                echo "ID is Missing";
            }
            ?>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>