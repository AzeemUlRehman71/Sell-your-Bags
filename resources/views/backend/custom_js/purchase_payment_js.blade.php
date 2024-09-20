<script>

    // Get Pending Payments Purchase and payment No Generate
    $('#supplier').on('change', function () {
        var optionSelected = $(this).find("option:selected");
        var supplier = optionSelected.val();

        $.ajax({
            type: "get",
            url: "{{ route('purchase_payment.get_pending') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                supplier: supplier
            },
            success:function(response) {
                if (response.success) {
                    $('#payment_no').empty();
                    $('#payment_no').val(response.data['payment_no']);

                    $('#pending_payments_body').empty();

                    for(var i = 0; i < response.data['pending_list'].length; i++) {

                        $('#pending_payments_body').append(
                            `
                                <tr>
                                    <td><input type="checkbox" class="checkbox payment_row_selection" data-id="`+response.data['pending_list'][i].id+`" name="payment_row_select[]" id="payment_row_select"></td>
                                    <td><input type="text" class="form-control" id="name" value="`+response.data['pending_list'][i].date+`" readonly> </td>
                                    <td><input type="text" class="form-control" value="`+response.data['pending_list'][i].purchase_no+`" readonly> </td>
                                    <td><input type="text" class="form-control" value="`+response.data['pending_list'][i].total_qty+`" readonly> </td>
                                    <td><input type="text" class="form-control" value="`+response.data['pending_list'][i].total_amount+`" readonly> </td>
                                    <td><input type="text" class="form-control" value="`+response.data['pending_list'][i].pending_amount+`" id="pending_amount`+response.data['pending_list'][i].id+`" readonly ></td>
                                    <td><input type="text" class="form-control received_amount" onkeyup="grand_calculation(`+response.data['pending_list'][i].id+`)" id="received_amount`+response.data['pending_list'][i].id+`" placeholder="Enter Received Amount..." readonly required></td>
                                </tr>
                            `
                        );
                    }
                }
            }
        })
    });

    $(document).ready(function() {
        // Select All Payrolls
        $(document).on('click', '.all_pending_item', function () {
            if ($(this).is(':checked')) {
                $('.payment_row_selection').map(function () {
                    var id = $(this).data('id');
                    if (!$(this).is(':checked')) {
                        $(this).prop('checked', true);
                        $('#received_amount'+id).removeAttr('readonly',false);
                        $('#received_amount'+id).attr('required',true);
                    }
                });
            } else {
                $('.payment_row_selection').map(function () {
                    var id = $(this).data('id');
                    if ($(this).is(':checked')) {
                        $(this).prop('checked', false);
                        $('#received_amount'+id).val('');
                        $('#received_amount'+id).attr('readonly', true);
                        $('#received_amount'+id).removeAttr('required',true);
                        grand_calculation();
                    }
                });
            }
        });
    });

    $(document).on('click', '.payment_row_selection', function() {
        var validateAllPayrolls = [];

        $('.payment_row_selection').map(function() {
            if ($(this).is(':checked'))
            {
                var id = $(this).data('id');
                validateAllPayrolls.push(true);
                $('#received_amount'+id).removeAttr('readonly',true);
                $('#received_amount'+id).attr('required',true);
            }
            else
            {
                var id = $(this).data('id');
                validateAllPayrolls.push(false);
                $('#received_amount'+id).val('');
                $('#received_amount'+id).attr('readonly', true);
                $('#received_amount'+id).removeAttr('required',true);
                grand_calculation();
            }
        });

        if (validateAllPayrolls.includes(false))
        {
            if ($('.all_pending_item').is(':checked'))
            {
                $('.all_pending_item').prop('checked', false);
            }
        }
        else
        {
            if (!$('.all_pending_item').is(':checked'))
            {
                $('.all_pending_item').prop('checked', true);
            }
        }
    });

    function grand_calculation(id) {
        var tpqm = 0;

        var pending_amount = $('#pending_amount'+id).val();
        var received_amount = $('#received_amount'+id).val();

        if(Number(received_amount) > Number(pending_amount)) {
            setTimeout(function () {
                toastr['warning'](
                    'Receiving Amount is Greater than Pending',
                    'Ooops!',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);

            $('#received_amount'+id).val('');
        }

        $(".received_amount").each(function() {
            tpqm += Number($(this).val());
        });

        $('#total_receiving').val(tpqm);
    }

    // handling Payment method
    $('#payment_method').on('change', function () {
        var optionSelected = $(this).find("option:selected");
        var method = optionSelected.val();

        if(method == 'cheque') {
            $('.cheque_method').fadeIn('slow');
            $('.ach').fadeOut('slow');
        } else if(method == 'ach') {
            $('.ach').fadeIn('slow');
            $('.cheque_method').fadeOut('slow');
        }else {
            $('.cheque_method').fadeOut('slow');
            $('.ach').fadeOut('slow');
        }
    })



    // Store Purchase Payment
    $('#add_purchase_payment_btn').on('click',function(){
        // Button Loading
        $('.btn').attr('disabled','disabled');
        $('.btn_ico').hide();
        $('.spinner_cls').show();
        setTimeout(function() {
            $('.btn_ico').show();
            $('.spinner_cls').hide();
            $('.btn').removeAttr('disabled');
        }, 3000);

        $(document).ready(function() {
            setTimeout(function () {
                toastr['warning'](
                    'Please Wait Your request has been Processed',
                    'Warning!',
                    {
                        closeButton: true,
                        tapToDismiss: false
                    }
                );
            }, 2000);
        });

        var required_inputs = $('input, textarea, select').filter('[required]:visible');
        var count = 0;
        for(var i = 0; i < required_inputs.length; i++){
            var ids = required_inputs[i].id;
            $('#'+ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if(vals == ''){
                count++;
                $('#'+ids).css('border', '1px solid red');
            }
        }

        if(count > 0){
            return false;
        }

        var payment_paid_data = [];

        $('.payment_row_selection').map(function() {``
            if ($(this).is(':checked'))
            {
                var id = $(this).data('id');
                var amount = $('#received_amount'+id).val();

                payment_paid_data.push(
                    {
                        'purchase_id': $(this).data('id'),
                        'received_amount': amount
                    }
                );
            }
        });

        $('#payment_data').val(JSON.stringify(payment_paid_data));

        var formData = new FormData($('.add_purchase_payment_frm')[0]);

        $.ajax({
            url:"{{ route('purchase_payment.store') }}",
            data: formData,
            type:"post",
            processData:false,
            cache:false,
            contentType:false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                if(response.success == true){
                    $(document).ready(function() {
                        setTimeout(function () {
                            toastr['success'](
                                'Data Saved',
                                'Well done!',
                                {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                    setTimeout(function(){
                        window.location.href = '{{ route('purchase_payment.index') }}';
                    }, 3000);
                }else{
                    $(document).ready(function() {
                        setTimeout(function () {
                            toastr['error'](
                                'something went wrong, please try again later..',
                                'ERROR!',
                                {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);
                    });
                }
            },
            error:function(e){
                $(document).ready(function() {
                    setTimeout(function () {
                        toastr['error'](
                            'Some required fields are not valid...',
                            'ERROR!',
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                });
            }
        });
    });


</script>
