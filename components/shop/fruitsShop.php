<?php
include "config/userfunctions.php";
?>
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
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3">                           
                                <option value="shop.php">All Products</option>
                                <option value="volvo">. . . </option>
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
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="all" id="allCategories" checked>
                                        <label class="form-check-label" for="allCategories">
                                            All Products
                                        </label>
                                    </div>
                                    <ul class="list-unstyled fruite-categorie">
                                    <?php 
                                        $categories = getAllActive("category");
                                        if ($categories) {
                                            foreach ($categories as $item) {
                                                ?>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input category-checkbox" type="checkbox" 
                                                                   value="<?= htmlspecialchars($item['slug']); ?>" 
                                                                   id="category<?= htmlspecialchars($item['id']); ?>">
                                                            <label class="form-check-label" for="category<?= htmlspecialchars($item['id']); ?>">
                                                                <?= htmlspecialchars($item['name']); ?>
                                                            </label>
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
                        // Get current page from URL, default to 1
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $productsPerPage = 9; // 3x3 grid
                        
                        // Get selected category from URL
                        $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
                        
                        // Get category ID if category is selected
                        if ($selectedCategory && $selectedCategory !== 'all') {
                            $categoryData = getSlugActive("category", $selectedCategory);
                            if ($categoryData) {
                                $product = getProdByCategory($categoryData['id']);
                            } else {
                                $product = getAllActive("product");
                            }
                        } else {
                            $product = getAllActive("product");
                        }
                        
                        if (!empty($product)) { 
                            // Calculate total pages
                            $totalProducts = count($product);
                            $totalPages = ceil($totalProducts / $productsPerPage);
                            
                            // Ensure page is within valid range
                            $page = max(1, min($page, $totalPages));
                            
                            // Get products for current page
                            $start = ($page - 1) * $productsPerPage;
                            $currentPageProducts = array_slice($product, $start, $productsPerPage);
                    ?>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($currentPageProducts as $item) { ?>
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                                        <a href="products.php?product=<?= htmlspecialchars($item['slug']); ?>">
                                            <img src="uploads/<?= htmlspecialchars($item['image']); ?>" class="card-img-top img-fluid" alt="Product Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title text-center"><?= htmlspecialchars($item['name']); ?></h5>
                                                
                                                <div class="text-center">
                                                    <span class="fs-5 fw-bold text-dark">$<?= htmlspecialchars($item['selling_price']); ?></span>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-white border-0 text-center">
                                                <a href="products.php?product=<?= htmlspecialchars($item['slug']); ?>" class="btn btn-outline-primary rounded-pill w-100">
                                                    <i class="fa fa-shopping-bag me-2"></i>More Detail
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Pagination -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo $selectedCategory ? '&category='.$selectedCategory : ''; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?><?php echo $selectedCategory ? '&category='.$selectedCategory : ''; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo $selectedCategory ? '&category='.$selectedCategory : ''; ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
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
document.addEventListener('DOMContentLoaded', function() {
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const allCategoriesCheckbox = document.getElementById('allCategories');
    
    // Handle "All Products" checkbox
    allCategoriesCheckbox.addEventListener('change', function() {
        if (this.checked) {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            window.location.href = 'shop.php';
        }
    });
    
    // Handle individual category checkboxes
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                allCategoriesCheckbox.checked = false;
                const categorySlug = this.value;
                window.location.href = `shop.php?category=${categorySlug}`;
            }
        });
    });
    
    // Check the appropriate checkbox based on current URL
    const urlParams = new URLSearchParams(window.location.search);
    const currentCategory = urlParams.get('category');
    if (currentCategory) {
        allCategoriesCheckbox.checked = false;
        const currentCheckbox = document.querySelector(`.category-checkbox[value="${currentCategory}"]`);
        if (currentCheckbox) {
            currentCheckbox.checked = true;
        }
    }
});
</script>
