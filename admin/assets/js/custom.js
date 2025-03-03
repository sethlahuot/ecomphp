$(document).ready(function () {
    $('.delete_product_btn').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You want to deleted it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                method: "POST",
                url: "db_category.php",
                data: {
                'product_id':id,
                'delete_product_btn': true
                },
                dataType: "",
                success: function (response) {
                    console.log(response);
                    if(response == 200)
                    {
                        Swal.fire({
                            title: "Success!",
                            text: "Product deleted successfully",
                            icon: "success"
                          });
                        location.reload();
                    }
                    else if(response == 500)
                    {
                        Swal.fire({
                            title: "Error!",
                            text: "Something was Wrong!",
                            icon: "error"
                          });
                    }
                }
              });
            } 
          });
    });
    $('.delete_category_btn').click(function (e) {
        e.preventDefault();
        var id = $(this).val();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-success",
              cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You want to deleted it!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                method: "POST",
                url: "db_category.php",
                data: {
                'category_id':id,
                'delete_category_btn': true
                },
                dataType: "",
                success: function (response) {
                    console.log(response);
                    if(response == 200)
                    {
                        Swal.fire({
                            title: "Success!",
                            text: "Category deleted successfully",
                            icon: "success"
                          });
                        location.reload();
                    }
                    else if(response == 500)
                    {
                        Swal.fire({
                            title: "Error!",
                            text: "Something was Wrong!",
                            icon: "error"
                          });
                    }
                }
              });
            } 
          });
    });
});