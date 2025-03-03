<?php 

include "config/userfunctions.php";  
 
?>

<!-- Cart Page Start -->

<div class="container-fluid py-5">
            <div class="container py-5">
            <?php 
                $items = getCartItems(); 
                $totalPrice = 0;

                if (!$items) { ?>
                    <div class="container py-5">
                        <h3 class="text-center">Your cart is empty</h3>
                        <a href="shop.php" class="btn btn-primary mt-3 d-block text-center">Go to Shop</a>
                    </div>
                <?php 
                    exit(); // Stop rendering the page if cart is empty
                }
                ?>    
                <div class="table-responsive">
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $total = 0;
                            foreach($items as $citem) 
                                {
                            ?>
                            <tr class="product_data">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="uploads/<?= htmlspecialchars($citem['image']); ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?= htmlspecialchars($citem['name']); ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 "><?= htmlspecialchars($citem['selling_price']); ?>$</p>
                                </td>
                                <td>
                                    <input type="hidden" class="prodId" value="<?= htmlspecialchars($citem['prod_id']);?>" >
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border updateQty" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 input-qty" value="<?= htmlspecialchars($citem['prod_qty']);?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border updateQty">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <?php 
                                $total = $citem['selling_price'] * $citem['prod_qty'];
                                $totalPrice += $total; 
                                ?>
                                <td>
                                    <p class="mb-0 mt-4"><?= $total ?>$</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 deleteItem" value="<?= htmlspecialchars($citem['cid']);?>">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php    
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total All Product</h5>
                                <p class="mb-0 pe-4"><?= $totalPrice ?> $</p>
                            </div>
                            <a href="checkout.php">
                                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->