$(document).ready(function () {
    $('.addToCarBtn').click(function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val(); 
        $.ajax({
            method: "POST",
            url: "config/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,  
                "scope": "add"
            },
            success: function (response) {
                if (response == 201) {
                    alertify.success("Product added to cart");
                } else if (response == 401) {
                    alertify.error("Login to continue");
                } else if (response == 500) {
                    alertify.error("Something went wrong!");
                }
            },
            error: function () {
                alertify.error("AJAX request failed!");
            }
        });
    });

    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
        
        // If this is in the cart, trigger the update
        if (button.hasClass('updateQty')) {
            var prod_id = button.closest('.product_data').find('.prodId').val();
            var price = parseFloat(button.closest('.product_data').find('td:nth-child(3) p').text().replace('$', ''));
            
            // Update the individual product total
            var productTotal = price * newVal;
            button.closest('.product_data').find('td:nth-child(5) p').text(productTotal + '$');
            
            // Update the grand total
            var grandTotal = 0;
            $('.product_data').each(function() {
                var itemTotal = parseFloat($(this).find('td:nth-child(5) p').text().replace('$', ''));
                grandTotal += itemTotal;
            });
            $('.bg-light .pe-4').text(grandTotal + ' $');
            
            $.ajax({
                method: "POST",
                url: "config/handlecart.php",
                data: {
                    "prod_id": prod_id,
                    "prod_qty": newVal,
                    "scope": "update"
                },
                success: function (response) {
                    if (response == 200) {
                        // Price already updated dynamically
                    } else {
                        alertify.error("Failed to update quantity");
                    }
                },
                error: function () {
                    alertify.error("Failed to update quantity");
                }
            });
        }
    });

    $(document).on('click', '.deleteItem', function(){
        var cart_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "config/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if (response == 200) {
                    location.reload();
                } else {
                    alertify.error(response);
                } 
            }
           
        });

    });
});
