<script>

    // Tree Loading Js

    $.fn.extend({
        treed: function (o) {

            var openedClass = 'glyphicon-minus-sign';
            var closedClass = 'glyphicon-plus-sign';

            if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                }
            };

            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            // tree.find('li').has("ul").each(function () {
            //     var branch = $(this); //li with children ul
            //     branch.prepend("<i class='indicator " + closedClass + "'></i>");
            //     branch.addClass('branch');
            //     branch.on('click', function (e) {
            //         if (this == e.target) {
            //             var icon = $(this).children('i:first');
            //             icon.toggleClass(openedClass + " " + closedClass);
            //             $(this).children().children().toggle();
            //         }
            //     })
            //     branch.children().children().toggle();
            // });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

    //Initialization of treeviews
    $('#tree3').treed();

    // Dealing Account Store Type
    $('#as_child').on('click', function () {
        if($("#as_child").prop('checked') == true){
            $('#parent_account').removeAttr('disabled');
        } else {
            $('#parent_account').attr('disabled', true);
        }
    })

    // Get Parent Account in Creation form
    $('#account_creation').on('click', function (){
        $.ajax({
            type: "get",
            url: "{{ route('account.parent_get') }}",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success:function(response) {
                if (response.success) {
                    $('#parent_account').empty();
                    $('#parent_account').append('<option value="" selected disabled>Select Option</option>');
                    for (var i = 0; i < response.parent.length; i++) {
                        $('#parent_account').append('<option value="'+response.parent[i].id+'">'+response.parent[i].name+'</option>');
                    }
                }
            }
        })
    });

    // *********************************************************
    // Setup Account
    $(document).ready(function() {
        setTimeout(function() {
            deploy_coa();
        }, 1000);
    });

    // Deploy Coa Function
    function deploy_coa() {
        $.ajax({
            type: "get",
            url: "{{ route('account.setup') }}",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success:function(response) {
                if (response.success) {
                    $('#loader_tr').hide();
                    $('#account_setup').html(response.code);
                }
            }
        })
    }

    // Account Store Request
    // Store Sale Invoice
    $('#create_account_btn').on('click',function(){
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

        var formData = new FormData($('#create_account_frm')[0]);

        $.ajax({
            url:"{{ route('account.store') }}",
            data:formData,
            type:"post",
            processData:false,
            cache:false,
            contentType:false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                if(response.success == true){
                    $('#account_create_modal').modal('toggle');
                    $('#account_name').val('');
                    $('#as_child').prop('checked', false);
                    $('#parent_account').val('');
                    $('#description').val('');

                        setTimeout(function () {
                            toastr['success'](
                                'Your data Saved Successfully',
                                'Well done!',
                                {
                                    closeButton: true,
                                    tapToDismiss: false
                                }
                            );
                        }, 2000);

                    setTimeout(function() {
                        $('#account_setup').empty();
                        $('#loader_tr').show();
                        deploy_coa();
                    }, 1000);

                } else if(response.duplicate_error == true) {
                    setTimeout(function () {
                        toastr['warning'](
                            'Account Already Exists..',
                            'Ooops!',
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                }else{

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

    // Account Edit Modal Data Parse
    $(document).on('click', '.account_edit', function() {
        var account_id = $(this).data('id');
        var name = $(this).data('name');
        var parent_id = $(this).data('parent');
        var parent_name = $(this).data('parent_name');
        var description = $(this).data('description');

        $('#account_id').val(account_id);
        $('#name').val(name);
        $('#_child').prop('checked', false);
        $('#_account').empty();

        if(parent_id != null) {
            $('#_child').prop('checked', true);
            $('#_account').append('<option value="'+parent_id+'" selected>'+parent_name+'</option>');
        }

        $('#_description').val(description);

    })

    // Edit Accounts
    $('#edit_account_btn').on('click',function(){
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

        var formData = new FormData($('#edit_account_frm')[0]);

        $.ajax({
            url:"{{ route('account.update') }}",
            data:formData,
            type:"post",
            processData:false,
            cache:false,
            contentType:false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                if(response.success == true){
                    $('#account_edit_modal').modal('toggle');
                    $('#account_name').val('');
                    $('#as_child').prop('checked', false);
                    $('#parent_account').val('');
                    $('#description').val('');

                    setTimeout(function () {
                        toastr['success'](
                            'Your data Updated Successfully',
                            'Well done!',
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);

                    setTimeout(function() {
                        $('#account_setup').empty();
                        $('#loader_tr').show();
                        deploy_coa();
                    }, 1000);

                } else if(response.duplicate_error == true) {
                    setTimeout(function () {
                        toastr['warning'](
                            'Account Already Exists..',
                            'Ooops!',
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                }else{

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
