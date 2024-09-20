<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="author" content="Gul Muhammad">
    <title>Sell Your Bags</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-print.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/printstyle.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">

                    <!-- Invoice -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="invoice-preview-card">
                            <div class="invoice-padding">
                                <!-- Header starts -->
                                {{-- <div class="d-flex  invoice-spacing mt-0"> --}}
                                <div class="row d-flex justify-content-center text-center mt-0" style=" width: 100%">
                                    <div class="logo-wrapper col-md-12 col-sm-12">
                                        <img src="{{ asset('app-assets\images\logo\final-logo.png') }}"
                                            style="width: 170px" class="invoice-logo" />
                                    </div>
                                    {{-- <div class="col-md-6 col-sm-6">
                                            <p class="card-text mb-25"
                                                style="line-height: 15px; text-align: left; font-weight: bold; font-size: 20px; margin-left: 35px; color: black">
                                                Sell Your Bags.</p>
                                            <p class="card-text mb-25"
                                                style="line-height: 8px; text-align: left; margin-left: 35px">14001 NW
                                                112 AVE STE 5 Hialeah Gardens, FL 33018</p>
                                            <p class="card-text mb-25"
                                                style="line-height: 8px; text-align: left; margin-left: 35px">(305)
                                                434-5267</p>
                                            <p class="card-text mb-0"
                                                style="line-height: 8px; text-align: left; margin-left: 35px">
                                                info@foodgroupinc.com</p>
                                            <p class="card-text mb-0"
                                                style="line-height: 30px; text-align: left; margin-left: 35px">
                                                WWW.FOODGROUPINC.COM</p>
                                        </div>
                                        <div class=" col-md-4 col-sm-4">
                                            <h2 style="text-align: right;">{{ ucfirst("dfdfdf") }} Expiry Report</h2>
                                        </div> --}}
                                </div>
                                {{-- </div> --}}
                                <!-- Header ends -->
                            </div>
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <h4 class="greenish-color fs-2">PURCHASE ORDER NO# {{ $clientDetails->po_number }}
                                    </h4>

                                </div>
                            </div>

                            <hr class="invoice-spacing" style="margin-top: 2px" />

                            {{-- <div class="row no-gutters"> --}}
                            <div class="col-md-12 d-flex justify-content-left print-border">
                                <h4 class="text-black black-color fs-2 m-2" style="font-weight: bold;">CONTACT
                                    INFORMATION</h4>
                            </div>

                            {{-- </div> --}}

                            <div class="row no-gutters   d-flex justify-content: space-around" style="">
                                <div class="pl-2 pt-4 d-flex justify-content: space-around">
                                    <label class="font-weight-bold black-color">FULL NAME:</label>
                                    <p style="margin-top: 1px;margin-left: 2px;">{{ $clientDetails->name }}</p>
                                </div>
                                <div class="pl-2 pt-4 d-flex justify-content: space-around">
                                    <label class="font-weight-bold black-color">EMAIL:</label>
                                    <p style="margin-top: 1px;margin-left: 2px;">{{ $clientDetails->email }}</p>
                                </div>
                                <div class="pl-2 pt-4 d-flex justify-content: space-around">
                                    <label class="font-weight-bold black-color">PHONE:</label>
                                    <p style="margin-top: 1px;margin-left: 2px;">{{ $clientDetails->phone }}</p>
                                </div>
                                <div class="pl-2 pt-4 d-flex flex-grow-1 justify-content: space-around">
                                    <label class="font-weight-bold black-color">ADDRESS:</label>
                                    <p style="margin-top: 1px;margin-left: 2px;">
                                        {{ $clientDetails->short_address }}
                                    </p>
                                </div>
                            </div>
                            {{-- <div class="row no-gutters d-flex background-white justify-content-left">
                                <div class="col-md-12 col-md-4 pl-5 pt-1">
                                    <label class="font-weight-bold black-color">ADDRESS</label>
                                    <p>{{ $clientDetails->short_address }}</p>
                                </div>

                            </div> --}}

                            <!-- Invoice Description starts -->
                            <div class="table-responsive mt-2">
                                <table class="table table-sm">
                                    <thead>
                                        <tr style="background-color: black !important;">
                                            <th style="font-weight: bold;font-size:1.5rem; color: black !important;">
                                                PRODUCT INFORMATION
                                            </th>
                                            <th style="">
                                            </th>
                                            <th style="">
                                            </th>
                                            <th style="">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientDetails->product as $item)
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td class="py-1 ps-4 mt-1">
                                                    {{-- <span class="fw-bold">{{ $item->image_path }}</span> --}}
                                                    @if (count($item->images()))
                                                        @foreach ($item->images() as $img)
                                                            <img src="{{ asset('product/' . $img) }}"  class="img-fluid" width="150px" height="150px" />
                                                        @endforeach
                                                    @else
                                                        <span class="fw-bold"> No Image found</span>
                                                    @endif
                                                </td>
                                                <td class="py-1 ps-4">
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                </td>
                                                <td class="py-1 ps-4">
                                                    <span class="fw-bold">{{ $item->condition }}</span>
                                                </td>
                                                <td class="py-1 ps-4">
                                                    <span class="fw-bold">${{ $item->price }}</span>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div class="row invoice-sales-total-wrapper total-amount mt-3 no-gutters mb-1"
                                style="border-color: rgba(34, 41, 47, 0.5) !important;">
                                <div class="col-md-12 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper">
                                        <div class="d-flex justify-content-center total-print">
                                            <p class="invoice-total-title">Total:</p>
                                            <p class="invoice-total-amount">${{ $clientDetails->total_amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row no-gutters  py-2  d-flex">
                                <div class="col-md-10  px-4 py-2">
                                    <h4 class="text-black black-color fs-2 my-2">DISCLAIMER</h4>

                                    <span>The Seller named above undersigns and acknowledges that the items sold
                                        and listed here are authentic and have been acquired lawfully. Seller agrees to
                                        pay the damages
                                        if the items sold to Dallas Designer Handbags are not authentic or acquired with
                                        any unlawful means.
                                        Seller also agrees to pay authentication charges,  $300 for Hermes and Chanel and $150 for all other 
                                        brands if the item is NOT authentic. Seller is responsible to pick up
                                        their items within 30 days or else we dispose of them. Seller acknowledges that the quoted price is 
                                        not a guaranteed payout amount and understands that it may change after a secondary review if additional wear is found on the item.</span>
                                </div>
                                @if ($clientDetails->signature)
                                    <div class="col-md-2  d-flex flex-column text-center px-4 py-2"
                                        style="padding-top: 7px;margin-top: 41px;">

                                        <img src="{{ asset('signature/' . $clientDetails->signature) }}"
                                            width="150px" height="80px" style="position:relative;top: 10px;">
                                        <h5 class="border-top"
                                            style="border-top: 1px solid #dee2e6!important;position: relative;top: 9px;">
                                            SIGNATURE</h5>

                                    </div>
                                @endif
                            </div>
                            <div class="row no-gutters  py-3  d-flex">
                                <div class="col-md-12">
                                    <div class="text-center p-3" id="print-div" style="width: 5in; margin: 0 auto;">
                                        {{--<p class="mb-1 black-color" style="font-size: 26px; line-height: 1.5rem;">{{ $clientDetails->name }}</p>--}}
                                        <img id="barcode-img" src="{{ asset('barcode/po_' . $clientDetails->po_number . '.svg?v=' . time() ) }}" style="width: 4.5in" alt="">
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- /Invoice -->
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-print.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
