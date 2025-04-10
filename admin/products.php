<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12" >
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                    <a href="add-product.php" class="btn btn-primary float-end">Create</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $product = getAll("product");
                            if ($product && count($product) > 0) {
                                foreach ($product as $item) {
                                    ?> 
                                    <tr>
                                        <td><?= htmlspecialchars($item['id']); ?></td>
                                        <td><?= htmlspecialchars($item['name']); ?></td>
                                        <td>
                                            <img src="../uploads/<?= htmlspecialchars($item['image']); ?>" width="50px" height="50px" alt="<?= htmlspecialchars($item['id']); ?>">
                                        </td>
                                        <td>
                                            <?= $item['status'] == '0' ? "Visible" : "Hidden" ?>
                                        </td>
                                        <td>
                                            <a href="edit-product.php?id=<?= htmlspecialchars($item['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= htmlspecialchars($item['id']); ?>">Delete</button>                                        
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "No records found";
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