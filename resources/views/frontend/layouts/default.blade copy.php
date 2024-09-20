<!DOCTYPE html>
<html lang="en">
{{-- <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sell</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
    />
    <link href="style.css" rel="stylesheet" />
  </head> --}}
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
    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery.signature.js') }}"></script>
    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('app-assets/vendors/js/file-uploaders/dropzone.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/forms/form-file-uploader.js') }}"></script> --}}
    <!-- END: Page JS-->

    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script type="text/javascript">
        var i = 0;
        $(document).on("click", "#addRow", function() {

            ++i;
            //alert('Hi there')
            var len = $("#dataAdd .abc").length + 1;

            // alert(len);

            $("#newRecord").append(
                `
              <div class="row my-5 abc">
                <div class="col-md-3">
                  <label>
                   
                    <input type="file" name="products[` + i + `]['image']" id="productImage" class="form-control"  />
                  </label>
                </div>
                <div class="col-md-3">
                  <input
                    type="text"
                    class="form-control border-bottom border-1 input-border shadow-none"
                    placeholder="ADD ITEM"
                    name="products[` + i + `]['name']" id="productName"
                  />
                </div>
                <div class="col-md-3">
                  <select
                    class="form-select shadow-none"
                    aria-label="Default select example" name="products[` + i + `]['condition']" id="productCondition"
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
                    id="productPrice"
                    required/>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger" id="deleteRow">X</button>
                </div>
                </div>


            `
            );

            $('.productPrice').change(function() {
                grand_calculation();
            });
        });
        $(document).on("click", "#deleteRow", function() {
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
            if (selectedVal == "paypal") {
                $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");

            } else if (selectedVal == "cheque") {
                $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
            } else if (selectedVal == "echeck") {
                $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#direct").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
            } else {
                $("#direct").show().addClass("lookAtMe").removeClass("noDisplay");
                $("#paypal").hide().addClass("noDisplay");
                $("#cheque").hide().addClass("noDisplay");
                $("#echeck").hide().addClass("noDisplay");
            }
            $("#payment_method").change(function() {
                var selectedVal = $("#payment_method option:selected").val();
                // alert(selectedVal);
                if (selectedVal == "paypal") {
                    $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                } else if (selectedVal == "cheque") {
                    $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                } else if (selectedVal == "echeck") {
                    $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#direct").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                } else {
                    $("#direct").show().addClass("lookAtMe").removeClass("noDisplay");
                    $("#paypal").hide().addClass("noDisplay");
                    $("#cheque").hide().addClass("noDisplay");
                    $("#echeck").hide().addClass("noDisplay");
                }
            });
        });

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
                $(".spinner-border").removeClass("d-none");
                $(".submit").attr("disabled", true);
                $(".btn-txt").text("Processing ...");
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


        FilePond.registerPlugin(FilePondPluginImagePreview);
        // document.addEventListener('FilePond:loaded', (e) => {
        //      console.log('FilePond ready for use', e.detail);

        // $(document).ready(function() {
        document.addEventListener('FilePond:loaded', (e) => {
            console.log('FilePond ready for use', e.detail);
            // Get a reference to the file input element
            const inputElement = document.querySelector('input[id="id_card_image"]');

            FilePond.setOptions({
                credits: false,
                server: {
                    process: {
                        url: './filepond-upload',
                        method: 'POST',
                        // onload: (error,file) => {
                        //     // select the right value in the response here and return
                        //     console.log('done',file.serverId);
                        // },
                        onload: function(response) {
                          //  console.log(JSON.parse(response).id);
                            //  return JSON.parse(responce).id // added
                        },

                    },
                    revert: './filepond-delete',
                    //  restore: './filepond-restore/',
                    restore: {
                        url: './filepond-restore/',
                        method: 'GET',
                        onload: (response) => response.key,
                        // onload: (response) => response.key,
                        //onerror: (response) => response.data,
                        // ondata: (formData) => {
                        //     formData.append('csrf_token', document.getElementById('csrf_token').value)
                        //     return formData;
                        // },

                    },
                    onload: (response) => {
                        serverResponse = JSON.parse(response);
                    },

                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        //    'Access-Control-Expose-Headers': 'Content-Disposition,'
                        // 'Access-Control-Expose-Headers': 'Content-Disposition',
                    }

                }

            });

            const pond = FilePond.create(inputElement, {

                files: [{
                    source: 'id_card_image', // providing hardcode tmp folder id works 
                    options: {
                        type: 'limbo',
                    },

                }, ],

            });
            console.log('FilePond id', pond.serverId);
            pond.onprocessfile = (error, file) => {
                var abc;
                abc = file.serverId;
                console.log(abc);
               // return abc;
            };

        });
    </script>




</body>

</html>
