<script>


    // handling Payment method
    $('#payment_method').on('change', function () {
        var optionSelected = $(this).find("option:selected");
        var method = optionSelected.val();

        if(method == 'cheque') {
            $('.cheque_method').fadeIn('slow');
        } else {
            $('.cheque_method').fadeOut('slow');
        }
    })

    var count = 1;
    // Expense Row Add
    @if(Route::current()->getName() == 'expense.create')
        $(document).on('click', '.add_expense_row', function () {
            $('#expense_body').append(
                `
                    <tr>
                        <td>`+count+`</td>
                        <td>
                            <select class="form-control select2" name="expense_account[]" id="expense_account">
                                <option value="" selected disabled>Select Option</option>
                                @foreach($expense as $acc)
                                    <optgroup label="{{ ucwords($acc->name) }}">
                                        @foreach($acc->level2 as $ac2)
                                            <option value={{ $ac2->id }}">{{ ucwords($ac2->name) }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </td>
                        <td><textarea class="form-control" name="description[]" id="description" placeholder="Enter Description..." rows="1"></textarea></td>
                        <td><input type="number" class="form-control amount" id="amount" name="amount[]" onkeyup="grand_calculation()" placeholder="Amount..."></td>
                        <td><a href="javascript:void(0);" class="rem_expense_row btn btn-sm btn-danger"><i class="fa fa-minus"></i></a></td>
                    </tr>
                `
            )
        count++;
        })

        $("#expense_body").on('click','.rem_expense_row',function(){
            $(this).parent().parent().remove();

            grand_calculation();
        });
    @endif

    function grand_calculation() {
        var tpqm = 0;

        $(".amount").each(function() {
            tpqm += Number($(this).val());
        });

        $('#grand_total').val(tpqm);
    }

    // Store Expense Request
    $('#expense_create_btn').on('click',function(){
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
            // $('#'+ids).css('border', '1px solid lightgrey');
            var vals = required_inputs[i].value;
            if(vals == ''){
                count++;
                $('#'+ids).css('border', '1px solid red');
                setTimeout(function () {
                    toastr['error'](
                        'Some Required Fields are Not Filled',
                        'Ooops!',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        }

        if(count > 0){
            return false;
        }

        var formData = new FormData($('.expense_create_frm')[0]);

        $.ajax({
            url:"{{ route('expense.store') }}",
            data:formData,
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
                        window.location.href = '{{ route('expense.index') }}';;
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
