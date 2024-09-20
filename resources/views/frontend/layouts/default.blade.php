<!DOCTYPE html>
<html lang="en">

@include('frontend.includes.head')

<body>
    <div class="container pb-5">

        @include('frontend.includes.header')

        @yield('content')
        {{-- @include('frontend.includes.footer') --}}
    </div>

    {{-- included this line and commented below includes --}}
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>

    {{-- commented this section which were the early files from htmilzation  --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script> --}}


    {{-- included these files for signatures --}}
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery.signature.js') }}"></script>
    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('app-assets/vendors/js/file-uploaders/dropzone.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/forms/form-file-uploader.js') }}"></script> --}}
    <!-- END: Page JS-->

    {{-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script> --}}
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js">
    </script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>


    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script src="{{ asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

    <script type="text/javascript">
        //Gul below addRow was used to add new rows dynamically to add new products at
        //front end but Image preview as not working with it from Filepond
        //so this code is no more used but kept here for future refrecece/idea

        var i = 2;
        $(document).on("click", "#addRow", function() {

            ++i;
            //alert('Hi there')
            var len = $("#dataAdd .abc").length + 1;

            // alert(len);

            $("#newRecord").append(
                `
                <div class="col-md-12 bg-white px-5">
              <div class="row my-3 abc">
                <div class="col-md-4">
                  <label>

                    <input type="file" name="products[` + i + `]['image'][]" id="productImage` + i + `"  data-max-files="10" class="form-control filepond productImage"  />
                  </label>
                </div>
                <div class="col-md-3">
                  <input
                    type="text"
                    class="form-control border-bottom border-1 input-border shadow-none"
                    placeholder="Description"
                    name="products[` + i + `]['name']" id="productName` + i + `"
                  />
                </div>
                <div class="col-md-3">
                  <select
                    class="form-select shadow-none"
                    aria-label="Default select example" name="products[` + i + `]['condition']" id="productCondition` + i + `"
                  >
                  <option value="">Conditon Rank</option>
                                <option value="A(Mint)">A(Mint)</option>
                                <option value="AB(Ecellent)">AB(Ecellent)</option>
                                <option value="B(Gently Used)">B(Gently Used)</option>
                                <option value="BC(Used)">BC(Used)</option>
                                <option value="C(Well Used)">C(Well Used)</option>
                                <option value="D(Need Prayers)">D(Need Prayers)</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <input
                    type="number"
                    class="form-control productPrice"
                    placeholder="$ 0.00"
                    value=""
                    name="products[` + i + `]['price']"
                    id="productPrice` + i + `"
                    required/>

                  <button class="btn btn-danger" id="deleteRow" style="float: right;">X</button>
                </div>
                {{--<div class="col-md-1">
                    <button class="btn btn-danger" id="deleteRow">X</button>
                </div>--}}
                </div>
                </div>


            `
            );

            $('.productPrice').change(function() {
                grand_calculation();
            });

            filepondInit(event);

            $('#productImage' + i).on('FilePond:processfile', function(e) {
                console.log('file added event', e.detail);
                document.getElementById('productPrice' + i).required = true;
            });
        });
        $(document).on("click", "#deleteRow", function(e) {
           e.preventDefault();
            var len = $("#newRecord .abc").length;

            //  alert(len);
            if (len > 0) {
                $("#newRecord .abc").last().remove();
            }
            grand_calculation();
            // else {
            //alert("Not able to Delete");
            // }
        });

        $(document).ready(function() {
            var selectedVal = $("#payment_method option:selected").val();
            //  alert(selectedVal);
            if (selectedVal == "") {
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
                $("#storecredit").hide().addClass("noDisplay");
            } else if (selectedVal == "paypal") {
                $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
                $("#storecredit").hide().addClass("noDisplay");
            } else if (selectedVal == "cheque") {
                $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
                $("#storecredit").hide().addClass("noDisplay");
            } else if (selectedVal == "echeck") {
                $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#storecredit").hide().addClass("noDisplay");
            } else if (selectedVal == "storecredit") {
                $("#storecredit").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
            } else {
                $("#paypal").hide().addClass("lookAtMe").removeClass("noDisplay");
                $("#direct").show().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
                $("#storecredit").hide().addClass("noDisplay");
            }
            $("#payment_method").change(function() {
                var selectedVal = $("#payment_method option:selected").val();
                // alert(selectedVal);
                if (selectedVal == "") {
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                    $("#storecredit").hide().addClass("noDisplay");
                } else if (selectedVal == "paypal") {
                    $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                    $("#storecredit").hide().addClass("noDisplay");
                } else if (selectedVal == "cheque") {
                    $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                    $("#storecredit").hide().addClass("noDisplay");
                } else if (selectedVal == "echeck") {
                    $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#storecredit").hide().addClass("noDisplay");
                } else if (selectedVal == "storecredit") {
                    $("#storecredit").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                } else {
                    $("#direct").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                    $("#storecredit").hide().addClass("noDisplay");
                }
            });
        });

        $(document).ready(function() {

            // $("#productImage1").on('change', function() {
            //     // alert('Works!!');
            //     document.getElementById('productPrice1').required = true;
            // });

            // function updateRequirements() {
            //     alert('dfdfd');
            //     const inputElement1 = document.querySelector('input[id="productImage"]');
            //     var image1 = document.getElementById('productImage1').value;
            //     if (image1 != null) {
            //         document.getElementById('productPrice1').required = true;
            //     } else {
            //         document.getElementById('productPrice1').required = false;
            //     }
            // }


        });

        //Gul here
        //not using this anymore fro image preview
        //just for record puprose here

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#category-img-tag').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#id_card_image").change(function() {
            readURL(this);
        });


        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });

        // Calculate all total for Grand total
        function grand_calculation() {
            var tpqm = 0;
            //alert(tpqm);

            $(".productPrice").each(function() {
                tpqm += Number($(this).val());
            });
            //  alert(tpqm);

            $('#grand_total').val(tpqm);
        }
        $('.productPrice').change(function() {
            grand_calculation();
        });

        //show loading spinner while form submision
        $(document).ready(function() {
            $("#clientform").submit(function() {
//                $(".spinner-border").removeClass("d-none");
//                $(".submit").attr("disabled", true);
//                $(".btn-txt").text("Processing ...");
		

		event.preventDefault();
                if ($('#payment_direct_account_number').val() != $('#payment_direct_re_enter_account_number').val()) {
			$('#re-enter-account-number-error').text('The Re-enter account number does not match.');

			//			swal('', "The Re-enter account number does not match.", 'warning');
//			Swal.fire({
//                        position: 'top-end',
//                        icon: 'warning',
//                        title: 'The Re-enter account number does not match.',
//                    });

			alert("The Re-enter account number does not match.");
                } else {
                    $(".spinner-border").removeClass("d-none");
                    $(".submit").attr("disabled", true);
                    $(".btn-txt").text("Processing ...");

                    this.submit();
                }
	    });

            //auto fill the Payment fields from client name and email address
            $(document).ready(function() {
                $('#name').on('change', function() {
                    $('#payment_full_name').val($(this).val());
                    $('#payment_name_paypal').val($(this).val());
                    $('#payment_full_name_cheque').val($(this).val());
                    $('#payment_full_name_echeck').val($(this).val());
                });
                $('#email').on('change', function() {
                    $('#payment_email').val($(this).val());
                    $('#payment_email_paypal').val($(this).val());
                    $('#payment_email_cheque').val($(this).val());
                    $('#payment_email_echeck').val($(this).val());
                });
            });
        });

        //Gul here
        //Register the Filepond plugines before they are used
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImageExifOrientation);
        FilePond.registerPlugin(FilePondPluginImageResize);
        FilePond.registerPlugin(FilePondPluginImageCrop);
        FilePond.registerPlugin(FilePondPluginImageTransform);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        // document.addEventListener('FilePond:loaded', (e) => {
        //      console.log('FilePond ready for use', e.detail);

        //  $(document).ready(function() {
        //  document.addEventListener('FilePond:loaded', (e) => {
        //  console.log('FilePond ready for use', e.detail);
        // Get a reference to the file input element
        // const inputElement = document.querySelector('input[id="id_card_image"]');
        //   const inputElements = document.querySelectorAll('input.filepond');

        // const inputElement1 = document.querySelector('input[id="productImage"]');
        // const inputElement2 = document.querySelector('input[id="productImage1"]');
        // const inputElement3 = document.querySelector('input[id="productImage2"]');

        document.addEventListener('FilePond:loaded', (e) => {
            filepondInit(e);
        });

        // document.addEventListener('FilePond:loaded', (e) => {
        function filepondInit(e) {
            console.log('FilePond ready for use', e.detail);
            // Get a reference to the file input element
            //basically We have used .filepond class in every file field
            //so getting all inputs here via querySelectorAll
            const inputElements = document.querySelectorAll('input.filepond');

            FilePond.setOptions({
                credits: false,
                server: {
                    process: './filepond-upload',
                    revert: './filepond-delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        //    'Access-Control-Expose-Headers': 'Content-Disposition,'
                        // 'Access-Control-Expose-Headers': 'Content-Disposition',
                    },

                }

            });

            // const pond = FilePond.create(inputElement, {

            //     files: [{
            //         source: 'id_card_image', // providing hardcode tmp folder id works
            //         options: {
            //             type: 'limbo',
            //         },

            //     }, ],

            // });
            Array.from(inputElements).forEach(inputElement => {

                // create a FilePond instance at the input element location
                // FilePond.create(inputElement);
                const pond = FilePond.create((inputElement), {
                    acceptedFileTypes: ['image/*'],
                    labelFileTypeNotAllowed: 'Please select a valid Image type PNG/JPG.',
                    allowImageCrop: true,
                    //   imageCropAspectRatio: '1:1',
                    allowImageExifOrientation: true,
                    allowImagePreview: true,
                    imagePreviewMinWidth: 100,
                    imagePreviewWidth: 100,
                    imagePreviewMinHeight: 80,
                    imagePreviewHeight: 80,
                    imagePreviewTransparencyIndicator: 'flex',
                    imagePreviewMarkupShow: false,
                    allowImageResize: true,
                    imageResizeTargetWidth: 500,
                    imageResizeTargetHeight: 350,
                    imageCropAspectRatio: '16:10',
                    // imageResizeMode: 'cover',
                    // imageResizeUpscale: true,
                    // imageResizeTargetWidth: 400,
                    // imageResizeTargetHeight: 200,
                    // imageResizeMode: 'force',
                    allowImageTransform: true,
                    imageTransformOutputQuality: 60,
                    allowMultiple: true,
                    maxFiles: 3

                });
                //  console.log('FilePond id', pond.serverId);
                // pond.onprocessfile = (error, file) => {
                //     var abc;
                //     abc = file.serverId;
                //     console.log(abc);
                //     // return abc;
                // };
                // 'addfile' instead of 'FilePond:addfile'
                // pond.on('addfile', (error, file) => {
                //     if (error) {
                //         console.log('Oh no');
                //         return;
                //     }
                //     document.getElementById('productPrice1').required = true;
                //     console.log('File added', file);
                // });
                // pond.on('processfile', (fieldName, file, metadata) => {
                //     console.log(fieldName);
                //     console.log(file.name);
                //     console.log(typeof metadata);
                // });
                // pond.on('processfilerevert', (error, file) => {

                //     document.getElementById('productPrice1').required = false;

                // });
                $('#productImage').on('FilePond:processfile', function(e) {
                    console.log('file added event', e.detail);
                    // document.getElementById('productPrice1').required = true;
                });
                $('#productImage1').on('FilePond:processfile', function(e) {
                    console.log('file added event', e.detail);
                    document.getElementById('productPrice1').required = true;
                });
                $('#productImage1').on('FilePond:processfilerevert', function(e) {

                    document.getElementById('productPrice1').required = false;
                });
                $('#productImage2').on('FilePond:processfile', function(e) {

                    document.getElementById('productPrice2').required = true;
                });
                $('#productImage2').on('FilePond:processfilerevert', function(e) {

                    document.getElementById('productPrice2').required = false;
                });

            });

            // $("#id_card_image").change(function() {
            //     alert('s');
            //     var fileInput = $(this);
            //     // console.log(fileInput.files.length);
            //     // console.log(fileInput.files);
            //     if (fileInput.files && fileInput.files[0]) {
            //         alert('s');
            //     // if (fileInput.files.length > 0) {
            //         const fileSize = fileInput.files.item(0).size;
            //         const fileMb = fileSize / 1024 ** 2;
            //         alert(fileMb);
            //         // if (fileMb >= 2) {
            //         // fileResult.innerHTML = "Please select a file less than 2MB.";
            //         // fileSubmit.disabled = true;
            //         // } else {
            //         // fileResult.innerHTML = "Success, your file is " + fileMb.toFixed(1) + "MB.";
            //         // fileSubmit.disabled = true;
            //         // }
            //     }
            //     alert('H');
            // });


        }
	// });
	

	$( "#payment_direct_re_enter_account_number" ).on( "blur", function() {
            if ($('#payment_direct_account_number').val() != $(this).val()) {
                $('#re-enter-account-number-error').text('The Re-enter account number does not match.');
            } else {
                $('#re-enter-account-number-error').text('');
            }
	});

	$( "#payment_direct_account_number" ).on( "blur", function() {
            if ($('#payment_direct_re_enter_account_number').val() != '' && $('#payment_direct_re_enter_account_number').val() != $(this).val()) {
                $('#re-enter-account-number-error').text('The Re-enter account number does not match.');
            } else {
                $('#re-enter-account-number-error').text('');
            }
        });
    </script>

</body>

</html>
