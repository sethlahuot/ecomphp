<?php

include "config/userfunctions.php";
?>
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h2>Our Category Products</h2>
                </div>
            </div>

            <?php 
                $categories = getAllActive("category"); 
                if (!empty($categories)) { 
            ?>
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <?php foreach ($categories as $item) { ?>
                                <div class="col-md-6 col-lg-4 col-xl-3"> 
                                    <div class="rounded position-relative fruite-item">
                                        <a href="category.php?category=<?= htmlspecialchars($item['slug']); ?>">
                                            <img src="uploads/<?= htmlspecialchars($item['image']); ?>" alt="Category Image" class="w-100">
                                            <h4 class="text-center mt-2"><?= htmlspecialchars($item['name']); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            <?php 
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            <?php 
                } else {
                    echo "<p>No data available</p>";
                }
            ?>
        </div>
    </div>
</div>
<!-- Fruits Shop End -->
