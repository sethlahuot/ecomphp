<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category</h4>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $category = getAll("category");
                        if ($category && count($category) > 0) {
                            foreach ($category as $item) {
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
                                        <a href="edit-category.php?id=<?= htmlspecialchars($item['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= htmlspecialchars($item['id']); ?>">Delete</button>                                        
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
<?php include "includes/footer.php" ?>