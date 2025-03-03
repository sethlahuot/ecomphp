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

    $(document).on('click','.updateQty', function () {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "config/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,  
                "scope": "update"
            },
            success: function (response) {
                // if (response == 201) {
                //     alertify.success("Product added to cart");
                // } else if (response == 401) {
                //     alertify.error("Login to continue");
                // } else if (response == 500) {
                //     alertify.error("Something went wrong!");
                // }
                //alert(response);
            },
            error: function () {
                alertify.error("AJAX request failed!");
            }
        });
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
