<script type="text/javascript">
    // Edit Product Status
    $(document).on('click', '.edit_product_unit', function() {

        //console.log('adfasdf');

        var product_id = $(this).data('edit_product_id');


        var client_status = $(this).data('edit_client_status');

        // alert(client_status);
        // var unit_val = $(this).data('edit_unit_value');
        // var unit_price = $(this).data('pro_unit_price');


        $('#edit_product_id').val(product_id);
        $('#client_status').val(client_status);
        // $('#unit_value').val(unit_val);
        // $('#edit_product_price').val(unit_price);
        // $('#edit_product_price').data('price', unit_price);
    });

    $(document).on('click', '.edit_product_details', function() {


        var product_id = $(this).data('change_product_id');


        var product_condtion = $(this).data('change_product_condition');

        var product_name = $(this).data('change_product_name');

        var product_price = $(this).data('change_product_price');

        var product_image = $(this).data('change_product_image');

        var total_amount = $(this).data('total_amount');

        var client_id = $(this).data('relevant_client_id');

        // alert(product_price);
        // var unit_val = $(this).data('edit_unit_value');
        // var unit_price = $(this).data('pro_unit_price');


        $('#edit_product_id_value').val(product_id);
        $('#productCondition_value').val(product_condtion);
        $('#productName_value').val(product_name);
        $('#productPrice_value').val(product_price);
        // $('#product_image_value').val(product_image[0]);
        // edit__product-images
        let imgs = "";
        if (product_image && product_image.length)
            product_image.forEach((img, index) => {
                imgs += "<div id='image-index-"+ index +"' style='width: 23%; position: relative; float: left;'><img src='/product/" + img + "' class='img-fluid' style='margin-right: 10px;' height='100' width='100' /><a href='#' onclick='deleteImage(event," + product_id + ", " + index + ")' style='position: absolute; top: 0; right: 5px; padding: 4px 5px 2px 6px !important; border-radius: 10px !important;' class='btn btn-danger btn-sm'><i class='fa fa-times'></i></a></div>"
            })
        $('#edit__product-images').html(imgs);
        $('#total_amount_value').val(total_amount);
        $('#client_id_value').val(client_id);
        // $('#edit_product_price').data('price', unit_price);
    });

    function deleteImage(e, productId, imageIndex)
    {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ url('/product/detail/delete-image') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                product_id: productId,
                image_index: imageIndex
            },
            success: function(response) {
                if (response) {
                    $('#image-index-' + imageIndex).remove();
                } else {
                    alert('Something went wrong!');
                }
            }
        });
    }


    $(document).on('click', '.add_product_details', function() {




        var client_id_add = $(this).data('relevant_client_id_add');
        // alert(client_id_add);

        $('#client_id_value_add').val(client_id_add);



    });
    $(document).on('click', '.delete_product', function() {

        var id = $(this).data('product_id');
        var client_id_del = $(this).data('relevant_client_id_del');




        $('#product_id').val(id);
        $('#relevant_client_id_del').val(client_id_del);

    });


    // Edit Sub unit calculations
    function edit_cal_sub_unit_price() {
        // var total = $('#total_amount_value').val();
        var price = $('#productPrice_value').val();
        var fix = $('#productPrice_value').data('price');



        if (price == '') {

            $('#productPrice_value').val(fix);
        } else {
            //var newTotal = Number(price) + Number(total);
            var newTotal = Number(price);
            // alert(newTotal);
            $('#newTotal').val(newTotal);


        }
    }

    // User Delete Modal Data Parse
    $(document).on('click', '.delete_user', function() {

        var id = $(this).data('user_id');

        $('#user_id').val(id);

    });
    // Product Delete Modal Data Parse
    // $(document).on('click', '.delete_product', function() {



    //     var id = $(this).data('product_id');


    //     $('#product_id').val(id);

    // })
    // $('#part_no').on('change', function() {

    //     var optionSelected =$(this).find("option:selected").attr('data-number');
    //     $('#number').val(optionSelected);
    // });

    //here to change the ProductNumber upon change of select option
    // $('.selectProductName').on('change', function() {

    //     var number = $(this).children('option:selected').data('number');
    //     $('#ProductNumber').val(number);
    // });


    //here calling database to get all the products Names on the change of first column i-e Product type
    // $('#inventory_type').on('change', function() {

    //     var optionSelected = $(this).find("option:selected");
    //     var product = optionSelected.val();



    //     $.ajax({
    //         type: "get",
    //         url: "",
    //         data: {
    //             "_token": "{{ csrf_token() }}",
    //             // accept:'application/json',
    //             product: product
    //         },
    //         success: function(response) {
    //             if (response.success) {

    //                 //  $('#product1_stock').val(response.product1_stock);
    //                 $('#part_no').empty();
    //                 $("#part_no").append('<option></option>');

    //                 for (var i = 0; i < response.productNames.length; i++) {
    //                     $('#part_no').append('<option value="' + response.productNames[i]
    //                         .ProductName + '" data-number="' + response.productNames[i]
    //                         .ProductNumber + '">' + response.productNames[i].ProductName +
    //                         '</option>')

    //                 }

    //             }
    //         }
    //     })
    // });

    //  function purchaseChequeClearence(id) {

    //  alert(id);
    // $('#cheque_status_value').val(id);
    // $('#cheque_status').modal('show');
    // var optionSelected = $('.cheque_status'+id).find("option:selected");
    //var status = optionSelected.val();
    // $('#cheque_status').val(id);

    //alert(status);
    // var id = $(this).data('confirm_id');

    //  $('#confirm_id').val(id);
    // }
    // Payment mathord confirmation
    /*  $(select).on('change', '.cheque_status', function () {
         alert();
        var optionSelected = $('.cheque_status'+id).find("option:selected");
        var status = optionSelected.val();
        var id = $(this).data('confirm_id');

        $('#confirm_id').val(id);
        }) */

    // ================================================
    // $("#payment_method").change(function() {
    //     var selectedVal = $("#payment_method option:selected").val();
    //     // alert(selectedVal);
    //     if (selectedVal == "paypal") {
    //         $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
    //         $("#direct").hide().addClass("noDisplay");
    //         $("#cheque").hide().addClass("noDisplay");
    //         $("#direct_default").hide().addClass("noDisplay");
    //         $("#cheque_default").hide().addClass("noDisplay");
    //     } else if (selectedVal == "cheque") {
    //         $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
    //         $("#paypal").hide().addClass("noDisplay");
    //         $("#direct").hide().addClass("noDisplay");
    //         $("#paypal_default").hide().addClass("noDisplay");
    //         $("#direct_default").hide().addClass("noDisplay");
    //     } else if (selectedVal == "direct") {
    //         $("#direct").show().addClass("lookAtMe").removeClass("noDisplay");
    //         $("#paypal").hide().addClass("noDisplay");
    //         $("#cheque").hide().addClass("noDisplay");
    //         $("#paypal_default").hide().addClass("noDisplay");
    //         $("#cheque_default").hide().addClass("noDisplay");
    //     } else {
    //         $("#direct").show().addClass("noDisplay");
    //         $("#paypal").hide().addClass("noDisplay");
    //         $("#cheque").hide().addClass("noDisplay");

    //     }
    // });
</script>
