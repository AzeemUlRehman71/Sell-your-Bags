<script>
      $('#product1').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var product = optionSelected.val();

       // alert(product);

        $.ajax({
            type: "get",
            url: "{{ route('product_inventory.quantity') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                product: product
            },
            success: function(response) {
                if (response.success) {
                    /* $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Tranfer No Generated Successfully',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    }); */
                    $('#product1_stock').val(response.product1_stock);
                    $('#product2').empty();
                    $("#product2").append('<option>--Select Product--</option>');

                    for(var i = 0; i < response.secondProductDrop.length; i++){
                            $('#product2').append('<option value="'+response.secondProductDrop[i].id+'" data-unit2="'+response.secondProductDrop[i].unit_name+'">'+response.secondProductDrop[i].name+'</option>')
                        }

                }
            }
        })
    });
    function quantityCalculation() {


       var givenValue = $('.item-value1').val();
       var availableStock = $('.stock_qty').val();

       if (Number(givenValue) > Number(availableStock)) {

            /* setTimeout(function() {
                toastr['warning'](
                    'Less Stock! Reduce Quantity',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000); */
            $(".less-stock-error").removeClass('d-none');
            $(".submit-transfer").attr('disabled',true);


            } else {
                $(".less-stock-error").addClass('d-none');
                $(".submit-transfer").attr('disabled',false);


            $('.item-value1').val(givenValue);

            }


    }
    $('#transfer_supplier').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var supplier = optionSelected.val();

        $.ajax({
            type: "get",
            url: "{{ route('transfer_inventory.get_no') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                supplier: supplier
            },
            success: function(response) {
                if (response.success) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Tranfer No Generated Successfully',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    $('#tranfer_no').val(response.tranfer_no);
                }
            }
        })
    });
    $('#purchase_supplier').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var supplier = optionSelected.val();

        $.ajax({
            type: "get",
            url: "{{ route('purchase_inventory.get_no') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                supplier: supplier
            },
            success: function(response) {
                if (response.success) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Purchase No Generated Successfully',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    $('#purchase_no').val(response.purchase_no);
                }
            }
        })
    });

    var rowCount = 1;

    // Add Products in Table For Add Inventory
    $('#search_products').on('change', function() {

        //added these lines for populating the hidden text field in Create inventory
        var unit1 = $(this).children('option:selected').data('unit1');
        $('#unit1').val(unit1);




        var optionSelected = $(this).find("option:selected");
        var product = optionSelected.val();

        $.ajax({
            type: "get",
            url: "{{ route('purchase_inventory.get_product_detail') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                product: product
            },
            success: function(response) {
                if (response.success) {

                    if (!response.detail.unit_value) {
                        setTimeout(function() {
                            toastr['warning'](
                                'Please Set Default Unit First...',
                                'Warning!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                        return false;
                    }
                    $('#inventory_body').append(
                        `
                            <tr>
                                <td>` + rowCount + `</td>
                                <td>
                                    <select class="form-control  product_id` + rowCount + `" name="product_id[]" id="product_id">
                                        <option value="` + response.detail.id + `">` + response.detail.name + `</option>
                                    </select>
                                </td>
                                <td>

                                    <input class="form-control unit` + rowCount + `" type="text" readonly value="` +
                        response.detail.unit_name + ` (` + response.detail.unit_value +
                        `)" name="unit_id[]" id="unit_id" onkeyup="unit_weight(` + rowCount + `,'purchase')">

                                    <input type="hidden" id="weight` + rowCount + `" name="unit_weight[]">
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="expiry_date[]" id="expiry_date" required>
                                </td>
                                <td>

                                    <input type="number" class="form-control price` + rowCount +
                        `" onkeyup="purchaseCalculation(` + rowCount + `)" value="` + response
                        .detail.price + `" name="price[]" id="price"  required placeholder="Price...">
                                </td>
                                <td>
                                    <input type="number" class="form-control qty` + rowCount +
                        `" onkeyup="purchaseCalculation(` + rowCount + `)" name="qty[]" id="qty" required placeholder="Quantity...">
                                </td>
                                <td>
                                    <input type="number" class="form-control total_price total` + rowCount + `" name="total[]" id="total" readonly required placeholder="Total Amount">
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="remCF btn btn-sm btn-danger"><center><i class="fa fa-minus"></i></center></a>
                                </td>
                            </tr>
                        `
                    );
                    rowCount++;

                }
            }
        })
    });

    // For Remove Row

    $("#inventory_body").on('click', '.remCF', function() {
        $(this).parent().parent().remove();
        grand_calculation();
    });

    // Price and Qty calculation

    function purchaseCalculation(id) {

        var price = $('.price' + id).val();
        var qty = $('.qty' + id).val();
        var weight = $('#weight' + id).val();

        var current = Number(weight) * Number(qty);

        // if (Number(weight) == 0) {
        var total = Number(price) * Number(qty);
        // } else {
        //     var total = Number(price) * Number(current);
        // }

        $('.total' + id).val(total);

        grand_calculation();
    }

    // Calculate all total for Grand total
    function grand_calculation() {
        var tpqm = 0;

        $(".total_price").each(function() {
            tpqm += Number($(this).val());
        });

        $('#grand_total').val(tpqm);
    }

    // Store Purchase Inventory
    $('#add_inventory_btn').on('click', function() {
        // Button Loading
        $('.btn').attr('disabled', 'disabled');
        $('.btn_ico').hide();
        $('.spinner_cls').show();
        setTimeout(function() {
            $('.btn_ico').show();
            $('.spinner_cls').hide();
            $('.btn').removeAttr('disabled');
        }, 3000);

        $(document).ready(function() {
            setTimeout(function() {
                toastr['warning'](
                    'Please Wait Your request has been Processed',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });

        var required_inputs = $('input, textarea, select').filter('[required]:visible');
        var count = 0;
        for (var i = 0; i < required_inputs.length; i++) {
            var ids = required_inputs[i].id;
            $('#' + ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if (vals == '') {
                count++;
                $('#' + ids).css('border', '1px solid red');
            }
        }

        if (count > 0) {
            return false;
        }

        var formData = new FormData($('.add_inventory_frm')[0]);

        $.ajax({
            url: "{{ route('purchase_inventory.store') }}",
            data: formData,
            type: "post",
            processData: false,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Data Saved',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    setTimeout(function() {
                        window.location.href = '{{ route('purchase_inventory.index') }}';;
                    }, 3000);
                } else {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'ERROR!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            },
            error: function(e) {
                $(document).ready(function() {
                    setTimeout(function() {
                        toastr['error'](
                            'Some required fields are not valid...',
                            'ERROR!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                });
            }
        });
    });

    $('#client').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var client = optionSelected.val();

        $.ajax({
            type: "get",
            url: "{{ route('sale.get_no') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                client: client
            },
            success: function(response) {
                if (response.success) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Sale No Generated Successfully',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    $('#sale_no').val(response.sale_no);
                }
            }
        })
    });

    var saleCount = 500;
    // Sale Product Get
    $('#sale_products').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var product = optionSelected.val();
        var table = document.getElementById("inventoryTable");
        var tbodyRowCount = table.tBodies[0].rows.length + 1; // 3

        var client = $('#client').val();

        if (client == null) {
            setTimeout(function() {
                toastr['warning'](
                    'Select Client First',
                    'Ooops!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);

            return;
        }

        $.ajax({
            type: "get",
            url: "{{ route('sale.get_products') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                product: product,
                client: client
            },
            success: function(response) {
                if (response.success) {

                    if (response.product.pricing == null) {
                        setTimeout(function() {
                            toastr['warning'](
                                'Attach Profit Tier to Client',
                                'Ooops!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);

                        return;
                    }
                    var units = '';
                    // Product Unit Loop
                    // for (var i = 0; i < response.product.prod.unit.length; i++)
                    for (var i = 0; i < response.product.prod.unit_value.length; i++) {
                        // units += '<option value="'+response.product.prod.unit[i].id+'">'+response.product.prod.unit[i].unit_name+' | '+response.product.prod.unit[i].value+'</option>';
                        units += '<input type="text" readonly value="' + response.product.prod
                            .unit_value.id + '">' + response.product.prod.unit_name + ' | ' +
                            response.product.prod.unit_value + '/>';
                    }

                    $('#sale_product_body').append(
                        `
                            <tr>
                                <td>` + tbodyRowCount + `</td>
                                <td>
                                    <select class="form-control product_id` + saleCount + `" name="product_id[]" id="product_id">
                                        <option value="` + response.product.prod.id + `">` + response.product.prod
                        .name + `</option>
                                    </select>
                                    <input type="hidden" value="` + response.product.margin + `" id="margin_product` +
                        saleCount + `">
                                    <input type="hidden" id="current_margin` + saleCount + `" value="` + response
                        .product.margin + `" name="product_margin[]"
                                    <input type="hidden" id="inventory` + saleCount + `" value="` + response.product
                        .inv + `">
                                </td>
                                <td>
                                    <input class="form-control unit` + saleCount + `" type="text" readonly
                                     value="` + response.product.prod.unit_name + ` (` + response.product.prod
                        .unit_value + `)"
                                     name="unit_id[]" id="unit_id" onkeyup="unit_weight(` + saleCount + `,'sale')">

                                    <input type="hidden" id="weight` + saleCount + `" name="unit_weight[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control price` + saleCount +
                        `" onkeyup="saleCalculation(` + saleCount +
                        `)" name="price[]" id="price" required readonly value="` + response
                        .product.pricing.sell_price + `" placeholder="Price...">
                                </td>
                                <td>
                                    <input type="number" class="form-control qty` + saleCount +
                        `" onkeyup="saleCalculation(` + saleCount + `)" name="qty[]" id="qty" required placeholder="Quantity...">
                                </td>
                                <td>
                                    <input type="number" class="form-control total_price total` + saleCount + `" name="total[]" id="total" readonly required placeholder="Total Amount">
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="remSale btn btn-sm btn-danger"><center><i class="fa fa-minus"></i></center></a>
                                </td>
                            </tr>
                        `
                    );
                    saleCount++;

                } else if (response.error) {
                    setTimeout(function() {
                        toastr['warning'](
                            response.message,
                            'Warning!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                }
            }
        })
    });

    $("#sale_product_body").on('click', '.remSale', function() {
        $(this).parent().parent().remove();
        grand_calculation();
    });


    $(document).ready(function() {
        grand_calculation();
    });

    // Get Unit Weight
    function unit_weight(id, type) {
        var unit = $('.unit' + id).val();
        // var unit = id;

        var product = $('.product_id' + id).val();

        if (type == 'sale') {
            var client = $('#client').val();
        } else {
            var client = null;
        }

        $.ajax({
            type: "get",
            url: "{{ route('sale.get_unit_weight') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                unit: unit,
                product: product,
                type: type,
                client: client
            },
            success: function(response) {
                if (response.success) {
                    $('.qty' + id).val('');
                    $('.total' + id).val('');

                    if (response.unit.type == 'purchase') {
                        $('#weight' + id).val(response.unit.detail.weight);
                        $('.price' + id).val(response.unit.price.price);
                    } else {
                        $('#weight' + id).val(response.unit.detail.value);
                        $('.price' + id).val(response.unit.price.sell_price);
                        $('#margin_product' + id).val(response.unit.price.margin);
                        $('#current_margin' + id).val(response.unit.price.margin);
                    }

                    grand_calculation();
                }
            }
        })
    }

    // Sale Calculation and Stock Validation

    function saleCalculation(id) {

        var unit = $('.unit' + id).val();


        if (unit == null) {
            setTimeout(function() {
                toastr['warning'](
                    'Please Select Unit First',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
            $('.qty' + id).val('');

            return false;
        }

        var weight = $('#weight' + id).val();
        var inv = $('#inventory' + id).val();
        var margin = $('#margin_product' + id).val();
        var price = $('.price' + id).val();
        var qty = $('.qty' + id).val();

        var current = Number(weight) * Number(qty);

        // if (Number(weight) == 0) {
        var total = Number(price) * Number(qty);
        var current_margin = Number(margin);
        // } else {
        //     var total = Number(price) * Number(current);
        //     var current_margin = Number(margin) * Number(weight);
        // }

        $('#current_margin' + id).val(current_margin);

        // if(Number(weight) == 0) {
        //
        //     if(Number(qty) > Number(inv) ) {
        //
        //         $('.qty'+id).val('');
        //         $('.total'+id).val('');
        //         grand_calculation();
        //
        //         setTimeout(function () {
        //             toastr['warning'](
        //                 'Less Stock! Reduce Quantity',
        //                 'Warning!',
        //                 {
        //                     closeButton: true,
        //                     tapToDismiss: false
        //                 }
        //             );
        //         }, 2000);
        //
        //     } else {

        $('.total' + id).val(total);

        grand_calculation();

        //     }
        //
        // } else {
        //     if(Number(current) > Number(inv) ) {
        //
        //         $('.qty'+id).val('');
        //         $('.total'+id).val('');
        //         grand_calculation();
        //
        //         setTimeout(function () {
        //             toastr['warning'](
        //                 'Less Stock! Reduce Quantity',
        //                 'Warning!',
        //                 {
        //                     closeButton: true,
        //                     tapToDismiss: false
        //                 }
        //             );
        //         }, 2000);
        //
        //     } else {
        //
        //         $('.total'+id).val(total);
        //
        //         grand_calculation();
        //
        //     }
        // }
    }

    // Store Sale in Database
    $('#create_sale_btn').on('click', function() {
        // Button Loading
        $('.btn').attr('disabled', 'disabled');
        $('.btn_ico').hide();
        $('.spinner_cls').show();
        setTimeout(function() {
            $('.btn_ico').show();
            $('.spinner_cls').hide();
            $('.btn').removeAttr('disabled');
        }, 3000);

        $(document).ready(function() {
            setTimeout(function() {
                toastr['warning'](
                    'Please Wait Your request has been Processed',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });

        var required_inputs = $('input, textarea, select').filter('[required]:visible');
        var count = 0;
        for (var i = 0; i < required_inputs.length; i++) {
            var ids = required_inputs[i].id;
            $('#' + ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if (vals == '') {
                count++;
                $('#' + ids).css('border', '1px solid red');
                setTimeout(function() {
                    toastr['error'](
                        'Some Required Fields are Not Filled',
                        'Ooops!', {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        }

        if (count > 0) {
            return false;
        }

        var formData = new FormData($('.create_sale_frm')[0]);

        $.ajax({
            url: "{{ route('sale.store') }}",
            data: formData,
            type: "post",
            processData: false,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Data Saved',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    setTimeout(function() {
                        window.location.href = '{{ route('sale.index') }}';;
                    }, 3000);
                } else {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'ERROR!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            },
            error: function(e) {
                $(document).ready(function() {
                    setTimeout(function() {
                        toastr['error'](
                            'Some required fields are not valid...',
                            'ERROR!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                });
            }
        });
    });

    // Update Sale
    $('#edit_sale_btn').on('click', function() {
        // Button Loading
        $('.btn').attr('disabled', 'disabled');
        $('.btn_ico').hide();
        $('.spinner_cls').show();
        setTimeout(function() {
            $('.btn_ico').show();
            $('.spinner_cls').hide();
            $('.btn').removeAttr('disabled');
        }, 3000);

        $(document).ready(function() {
            setTimeout(function() {
                toastr['warning'](
                    'Please Wait Your request has been Processed',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });

        var required_inputs = $('input, textarea, select').filter('[required]:visible');
        var count = 0;
        for (var i = 0; i < required_inputs.length; i++) {
            var ids = required_inputs[i].id;
            $('#' + ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if (vals == '') {
                count++;
                $('#' + ids).css('border', '1px solid red');
                setTimeout(function() {
                    toastr['error'](
                        'Some Required Fields are Not Filled',
                        'Ooops!', {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        }

        if (count > 0) {
            return false;
        }

        var formData = new FormData($('.edit_sale_frm')[0]);

        $.ajax({
            url: "{{ route('sale.update') }}",
            data: formData,
            type: "post",
            processData: false,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Data Saved',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    setTimeout(function() {
                        window.location.href = '{{ route('sale.index') }}';;
                    }, 3000);
                } else {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'ERROR!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            },
            error: function(e) {
                $(document).ready(function() {
                    setTimeout(function() {
                        toastr['error'](
                            'Some required fields are not valid...',
                            'ERROR!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                });
            }
        });
    });

    // Store Sale Invoice
    $('#create_sale_invoice_btn').on('click', function() {
        // Button Loading
        $('.btn').attr('disabled', 'disabled');
        $('.btn_ico').hide();
        $('.spinner_cls').show();
        setTimeout(function() {
            $('.btn_ico').show();
            $('.spinner_cls').hide();
            $('.btn').removeAttr('disabled');
        }, 3000);

        $(document).ready(function() {
            setTimeout(function() {
                toastr['warning'](
                    'Please Wait Your request has been Processed',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });

        var required_inputs = $('input, textarea, select').filter('[required]:visible');
        var count = 0;
        for (var i = 0; i < required_inputs.length; i++) {
            var ids = required_inputs[i].id;
            // $('#'+ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if (vals == '') {
                count++;
                $('#' + ids).css('border', '1px solid red');
                setTimeout(function() {
                    toastr['error'](
                        'Some Required Fields are Not Filled',
                        'Ooops!', {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        }

        if (count > 0) {
            return false;
        }

        var formData = new FormData($('.create_sale_invoice_frm')[0]);

        $.ajax({
            url: "{{ route('invoice.store') }}",
            data: formData,
            type: "post",
            processData: false,
            cache: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['success'](
                                'Data Saved',
                                'Well done!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    setTimeout(function() {
                        window.location.href = '{{ route('sale.index') }}';;
                    }, 3000);
                } else {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'ERROR!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            },
            error: function(e) {
                $(document).ready(function() {
                    setTimeout(function() {
                        toastr['error'](
                            'Some required fields are not valid...',
                            'Oh snap!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                });
            }
        });
    });

    // On Shippment Calculation Stock and Qty Equal or Not
    function shipCalculation(id) {
        var s_qty = $('.shipped_qty' + id).val();
        var unit = $('.unit' + id).val();

        /* if(unit == null) {
            setTimeout(function () {
                toastr['warning'](
                    'Please Select Unit First',
                    'Warning!',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
            $('.shipped_qty'+id).val('');

            return false;
        } */

        var weight = $('#weight' + id).val();
        var inv = $('#inventory' + id).val();
        var margin = $('#margin_product' + id).val();
        var price = $('.price' + id).val();
        var qty = $('.qty' + id).val();
        var old_shipped = $('.old_shipped' + id).val();

        // var current = Number(weight) * Number(s_qty);
        var current = Number(s_qty);

        // if (Number(weight) == 0) {
        var total = Number(price) * Number(s_qty);
        var current_margin = Number(margin);
        // } else {
        //     var total = Number(price) * Number(current);
        // var current_margin = Number(margin) * Number(weight);
        // }

        var current_qty = Number(old_shipped) + Number(current);
        // var total_s_qty = Number(weight) * Number(qty);
        var total_s_qty = Number(qty);

        if (Number(current_qty) > Number(total_s_qty)) {
            $('.shipped_qty' + id).val('');
            $('.total' + id).val('');
            grand_calculation();

            setTimeout(function() {
                toastr['warning'](
                    'Order Quantity is Less',
                    'Warning!', {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);

            return false;
        }

        $('#current_margin' + id).val(current_margin);

        if (Number(weight) == 0) {

            if (Number(s_qty) > Number(inv)) {

                $('.shipped_qty' + id).val('');
                $('.total' + id).val('');
                grand_calculation();

                setTimeout(function() {
                    toastr['warning'](
                        'Less Stock! Reduce Quantity',
                        'Warning!', {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);

            } else {

                $('.total' + id).val(total);

                grand_calculation();
            }

        } else {
            if (Number(current) > Number(inv)) {

                $('.shipped_qty' + id).val('');
                $('.total' + id).val('');
                grand_calculation();

                setTimeout(function() {
                    toastr['warning'](
                        'Less Stock! Reduce Quantity',
                        'Warning!', {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);

            } else {

                $('.total' + id).val(total);

                grand_calculation();

            }
        }
    }

    // handling Payment method
    $('#payment_method').on('change', function() {
        var optionSelected = $(this).find("option:selected");
        var method = optionSelected.val();

        if (method == 'cheque') {
            $('.cheque_method').fadeIn('slow');
            $('.ach').fadeOut('slow');
        } else if (method == 'ach') {
            $('.ach').fadeIn('slow');
            $('.cheque_method').fadeOut('slow');
        } else {
            $('.cheque_method').fadeOut('slow');
            $('.ach').fadeOut('slow');
        }
    })

    // Cheque Status Dealing
    function cheque_clearence(id) {
        var optionSelected = $('.cheque_status' + id).find("option:selected");
        var status = optionSelected.val();

        $.ajax({
            type: "post",
            url: "{{ route('sale.payment_clearance') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                status: status,
                id: id
            },
            success: function(response) {
                if (response.success) {
                    setTimeout(function() {
                        toastr['success'](
                            'Cheque Clear',
                            'Well done!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);

                } else if (response.date_error) {
                    setTimeout(function() {
                        toastr['error'](
                            'Cheque Clearance Date is Not there!',
                            'Error!', {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                } else {
                    $(document).ready(function() {
                        setTimeout(function() {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'Error!', {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            }
        })
    }
</script>
