<?php 

include "config/userfunctions.php";  
include "config/placeorder.php";  


?>
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="config/placeorder.php" method="POST">
            <div class="row g-5">
                <!-- Billing Details - Now on the Right -->
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Full Name<sup>*</sup></label>
                                <input type="text" name="name" id="name" required placeholder="Enter your full name . . ." class="form-control">
                                <small class="text-danger name"></small>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="text" name="email" id="email" required placeholder="Enter your Email address. . ." class="form-control">
                                <small class="text-danger email"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Phone Number<sup>*</sup></label>
                        <input type="text" name="phone" id="phone" required placeholder="Enter your phone number . . ." class="form-control">
                        <small class="text-danger phone"></small>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" name="address" id="address" required placeholder="Enter your address . . ." class="form-control" >
                        <small class="text-danger address"></small>
                    </div>
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                        <input type="text" name="pincode" id="pincode" required placeholder="Enter your Postcode/Zip . . ." class="form-control">
                        <small class="text-danger pincode"></small>
                        <hr>
                    <div class="form-item">
                        <label class="form-label my-3">Comments</label>
                        <textarea name="comments" id="comments" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"></textarea>
                    </div>
                </div>

                <!-- Order Summary - Now on the Left -->
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
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
                            <tbody>
                                <tr>
                                <?php 
                                    foreach($items as $citem) 
                                        {
                                    ?>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="uploads/<?= htmlspecialchars($citem['image']); ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5"><?= htmlspecialchars($citem['name']); ?></td>
                                    <td class="py-5"><?= htmlspecialchars($citem['selling_price']); ?>$</td>
                                    <td class="py-5">X<?= htmlspecialchars($citem['prod_qty']);?></td>
                                    <td class="py-5"><?= htmlspecialchars($citem['selling_price'] * $citem['prod_qty']); ?>$</td>
                                        </tr>
                                    <tr>
                                    <?php 
                                    $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                                        } 
                                    ?>
                                    <th scope="row"></th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL All Product</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark"><?= $totalPrice ?> $</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="sumbit" name="placeOrderBtn" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?currency=USD&client-id=AdAFOX0e1v_C2uEkFOtrooBbBvfoOr71TPgb0vA1E03j2_RRxRyYxcxRSpeVRktz8-xGzYT31xx--jgP"></script>
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?= isset($totalPrice) ? $totalPrice : "0" ?>' // Dynamic total price
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            const transaction = details.purchase_units[0].payments.captures[0]; // Corrected variable

            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var pincode = $('#pincode').val();

            var data = {
            'name': name,
            'email': email,
            'phone': phone,
            'pincode': pincode,
            'address': address,
            'payment_mode': "Paid by PayPal",
            'payment_id':  transaction.id,
            'placeOrderBtn': true
            }

            $.ajax({
                method: "POST",
                url: "config/placeorder.php",
                data: data,
                dataType: "",
                success: function (response){
                    if(response == 201)
                    {
                        alertify.success("Order Placed successfully");
                        window.location.href = 'my-orders.php';
                    }
                }
            });
        });
    },
    onClick: function() {
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var pincode = $('#pincode').val();
        if (name.length == 0) {
            $('.name').text("*The field is reqired");
        }else{
            $('.name').text("");
        }
        if (email.length == 0) {
            $('.email').text("*The field is reqired");
        }else{
            $('.email').text("");
        }
        if (phone.length == 0) {
            $('.phone').text("*The field is reqired");
        }else{
            $('.phone').text("");
        }
        if (address.length == 0) {
            $('.address').text("*The field is reqired");
        }else{
            $('.address').text("");
        }
        if (pincode.length == 0) {
            $('.pincode').text("*The field is reqired");
        }else{
            $('.pincode').text("");
        }
        if (name.length == 0 || email.length == 0 || phone.length == 0 || address.length == 0 || pincode.length == 0)
        {
            return false;
        }

    },
    onError: function(err) {
        console.error(err);
        alert('Something went wrong with the payment.');
    }
}).render('#paypal-button-container');
</script>
