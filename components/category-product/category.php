<?php
include "config/userfunctions.php";
if (!isset($_GET['category']) || empty($_GET['category'])) {
    die("Error: 'category' parameter is missing in the URL.");
} 
$category_slug = strtolower($_GET['category']);
var_dump($category_slug);
$category_data = getSlugActive("category", $category_slug);
if (!$category_data) {
    die("Error: No category found for slug '$category_slug'. Check the database.");
}
var_dump($category_data); 
$cid = $category_data['id']; 
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6"><?= htmlspecialchars($category_data['name']); ?></h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
        <li class="breadcrumb-item active text-white"><?= htmlspecialchars($category_data['name']); ?></li>
    </ol>
</div>
<!-- Single Page Header End -->
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                    <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">                           
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" onchange="redirectToPage(this.value)">
                                <option value="#">. . . </option>
                                <option value="shop.php">All Products</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <button class="border-0 form-select-sm bg-light me-3"><a href="shop.php">All Products</a></button>
                                    <ul class="list-unstyled fruite-categorie">
                                    <?php 
                                        $categories = getAllActive("category");
                                        if ($categories) {
                                            foreach ($categories as $item) {
                                                ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="category.php?category=<?= htmlspecialchars($item['slug']); ?>">
                                                                <?= htmlspecialchars($item['name']); ?>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php
                                            }
                                        } else {
                                            echo "<li>No data available</li>";
                                        }
                                    ?>
                                    </ul>
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
                    <?php 
                        $product = getProdByCategory($cid);
                        if (!empty($product)) { 
                    ?>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($product as $item) { ?>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                                    <a href="products.php?product=<?= htmlspecialchars($item['slug']); ?>">
                                        <img src="uploads/<?= htmlspecialchars($item['image']); ?>" class="card-img-top img-fluid" alt="Product Image" style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title text-center"><?= htmlspecialchars($item['name']); ?></h5>
                                            <p class="card-text text-muted text-center"><?= htmlspecialchars($item['description']); ?></p>
                                            <div class="text-center">
                                                <span class="fs-5 fw-bold text-dark">$<?= htmlspecialchars($item['selling_price']); ?></span>
                                            </div>
                                        </div>
                                        </a>
                                        <div class="card-footer bg-white border-0 text-center">
                                            <a href="#" class="btn btn-outline-primary rounded-pill w-100">
                                                <i class="fa fa-shopping-bag me-2"></i> Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <a href="#" class="rounded">&laquo;</a>
                                    <a href="#" class="active rounded">1</a>
                                    <a href="#" class="rounded">2</a>
                                    <a href="#" class="rounded">3</a>
                                    <a href="#" class="rounded">4</a>
                                    <a href="#" class="rounded">5</a>
                                    <a href="#" class="rounded">6</a>
                                    <a href="#" class="rounded">&raquo;</a>
                                </div>
                            </div>
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
    </div>
</div>
<!-- Fruits Shop End-->
<script>
function redirectToPage(value) {
    if (value) {
        window.location.href = value;
    }
}
</script>