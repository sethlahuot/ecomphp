<?php 
session_start();
include "includes/header.php";
include "../middleware/adminMiddleware.php"; 

// Fetch existing settings using PDO
try {
    $settings_query = "SELECT * FROM settings LIMIT 1";
    $stmt = $pdo->prepare($settings_query);
    $stmt->execute();
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Debug information
    if(isset($settings['image']) && !empty($settings['image'])) {
        $image_path = "../uploads/" . $settings['image'];
        echo "<!-- Debug: Image path: " . $image_path . " -->";
        echo "<!-- Debug: File exists: " . (file_exists($image_path) ? 'Yes' : 'No') . " -->";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Error fetching settings: " . $e->getMessage();
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php include('includes/alert.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h3>Settings</h3>
                </div>
                <div class="card-body">
                    <form action="setting_function.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        <h4 class="my-3">Home Page Information</h4>
                            <div class="col-md-6">
                                <label class="mb-0">Meta Logo</label>
                                <?php if(isset($settings['image']) && !empty($settings['image'])): ?>
                                    <div class="mb-2">
                                        <img src="../uploads/<?= $settings['image'] ?>" alt="Current Logo" class="img-fluid" style="max-height: 100px;">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label for="">Title</label>
                                <input type="text" name="title" placeholder="Enter Title" class="form-control" value="<?= $settings['title'] ?? '' ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="">URL / Domain</label>
                                <input type="email" name="slug" placeholder="Enter URL / Domain" class="form-control" value="<?= $settings['slug'] ?? '' ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" required name="meta_description" placeholder="Enter Meta Description..." class="form-control mb-2"><?= $settings['meta_description'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Small Description</label>
                                <textarea rows="3" required name="small_description" placeholder="Enter Small Description..." class="form-control mb-2"><?= $settings['small_description'] ?? '' ?></textarea>
                            </div>
                            <h4 class="my-3">About US Information</h4>
                            <div class="col-md-12">
                                <label for="">About us Description 1</label>
                                <textarea rows="3" required name="about_description1" placeholder="Enter About us Description 1" class="form-control mb-2"><?= $settings['about_description1'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">About us Description 2</label>
                                <textarea rows="3" required name="about_description2" placeholder="Enter About us Description 2" class="form-control mb-2"><?= $settings['about_description2'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">About us Description 3</label>
                                <textarea rows="3" required name="about_description3" placeholder="Enter About us Description 3" class="form-control mb-2"><?= $settings['about_description3'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">About us Description 4</label>
                                <textarea rows="3" required name="about_description4" placeholder="Enter About us Description 4" class="form-control mb-2"><?= $settings['about_description4'] ?? '' ?></textarea>
                            </div>
                            
                            <h4 class="my-3">Contact Information</h4>
                            <div class="col-md-6">
                                <label for="">Email 1</label>
                                <input type="email" name="email1" placeholder="Enter Email 1" class="form-control" value="<?= $settings['email1'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Email 2</label>
                                <input type="email" name="email2" placeholder="Enter Email 2" class="form-control" value="<?= $settings['email2'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone 1</label>
                                <input type="text" name="phone1" placeholder="Enter Phone 1" class="form-control" value="<?= $settings['phone1'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone 2</label>
                                <input type="text" name="phone2" placeholder="Enter Phone 2" class="form-control" value="<?= $settings['phone2'] ?? '' ?>">
                            </div>
                            <div class="col-md-12">
                                <label for="">Address</label>
                                <textarea rows="3" required name="address" placeholder="Enter Address" class="form-control mb-2"><?= $settings['address'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Contact Description</label>
                                <textarea rows="3" required name="contact_description" placeholder="Enter Contact Description" class="form-control mb-2"><?= $settings['contact_description'] ?? '' ?></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="save_setting_btn">Save Setting</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php" ?>