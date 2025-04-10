<?php
include "config/userfunctions.php";

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product = getSlugActive("product", $product_slug);
    
    if ($product) {
        ?>
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
                <li class="breadcrumb-item active text-white"><?= htmlspecialchars($product['name']); ?></li>
            </ol>
        </div>
        <!-- Single Page Header End -->
<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
    <div class="container py-5">
        <div class="row g-4 mb-5">
            <div class="col-lg-8 col-xl-9">
                <div class="row g-4">
                    <div class="container">
                        <div class="row product_data align-items-center">
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="uploads/<?= htmlspecialchars($product['image']); ?>" class="img-fluid rounded" alt="Image">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?= htmlspecialchars($product['name']); ?></h4>
                                <p class="mb-3">Category: Vegetables</p>

                                <div class="d-flex mb-4">
                                    <h4 class="fw-bold me-2"><?= htmlspecialchars($product['selling_price']); ?> $</h4>
                                    <h4 class="text-danger text-decoration-line-through"><?= htmlspecialchars($product['original_price']); ?> $</h4>
                                </div>
                                <p class="mb-4"><?= htmlspecialchars($product['description']); ?></p>
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center input-qty border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary addToCarBtn" value="<?= htmlspecialchars($product['id']); ?>">
                                    <i class="fa  fa-shopping-cart me-2 text-primary"></i> Add to cart</button>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $products = getAllActive("product"); 
                        if (!empty($products)) { 
                    ?>
                    <h1 class="fw-bold mb-0">Related products</h1>
                    <div class="vesitable">
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
                                    <!-- <p><?= htmlspecialchars($items['description']); ?></p> -->
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
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="input-group w-100 mx-auto d-flex mb-4">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <?php 
                        $table = get4Products("product"); 
                        if (!empty($table)) { 
                        ?>
                        <h4 class="mb-4">Featured products</h4>
                        <?php foreach ($table as $pro) { ?>
                        <div class="d-flex align-items-center justify-content-start">
                            <div class="rounded" style="width: 100px; height: 100px;">
                                <img src="uploads/<?= htmlspecialchars($pro['image']); ?>" class="img-fluid rounded" alt="Image">
                            </div>
                            <div>
                                <h6 class="mb-2"><?= htmlspecialchars($pro['name']); ?></h6>
                                
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2"><?= htmlspecialchars($pro['selling_price']); ?> $</h5>
                                    <h5 class="text-danger text-decoration-line-through"><?= htmlspecialchars($pro['original_price']); ?> $</h5>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                        <div class="d-flex justify-content-center my-4">
                            <a href="shop.php" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!-- Single Product End --> 
        <?php
    }
}
?>