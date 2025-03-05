<?php require_once "config/userfunctions.php"; ?>
<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable py-5">
    <div class="container py-5">
    <?php 
        $products = getAllActive("product"); 
        if (!empty($products)) { 
    ?>
        <h1 class="mb-0">Popular Products</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">                        
        <?php foreach ($products as $items) { ?>
        <div class="border border-primary rounded position-relative vesitable-item h-100 shadow-sm border-0 d-flex flex-column justify-content-center">
            <div class="vesitable-img">
            <a href="products.php?product=<?= htmlspecialchars($items['slug']); ?>">
                <img src="uploads/<?= htmlspecialchars($items['image']); ?>" class="img-fluid w-100 rounded-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                </a>
            </div>
            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= htmlspecialchars($items['meta_keywords']); ?></div>
            <div class="p-4 pb-0 rounded-bottom text-center">
                <h4><?= htmlspecialchars($items['name']); ?></h4>
              
                <div class="text-center">
                    <p class="text-dark fs-5 fw-bold"><?= htmlspecialchars($items['selling_price']); ?>$</p>                                    
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-center">
                <a href="products.php?product=<?= htmlspecialchars($items['slug']); ?>" class="btn btn-outline-primary rounded-pill w-100">
                <i class="fa fa-shopping-bag me-2"></i>More Detail
                </a>
            </div>
        </div>
        <?php } ?>
        </div>
        <?php } ?>    
    </div>
</div>
<!-- Vesitable Shop End -->