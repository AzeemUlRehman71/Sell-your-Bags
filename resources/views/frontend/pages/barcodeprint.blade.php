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
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-print.css') }}"> -->
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/printstyle.css') }}"> -->
    <!-- END: Custom CSS-->

    <style>
        @media print 
        {
            @page
            {
                size: 2in 2in;
                margin: 0;
            }
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    {{--<div class="text-center p-2" style="width: 4in; height: 2in; border: 1px dotted #ccc">
        <p class="mb-1">{{ $client->name }}</p>
        <img src="{{ asset('barcode/' . $id . '.svg') }}" style="width: 3in; height: 2in" alt="">
    </div>--}}

    @foreach ($client->product as $key => $item)
        <div>
            <div class="text-center p-3" id="print-div" style="width: 3in; height: 3in; vertical-align: middle; display: table-cell;">
                <p class="mb-1" style="font-size: 18px; line-height: 1.5rem;">{{ $item->name . ((count($client->product) > 1) ? ' (' . ($key + 1) . ' of ' . count($client->product) . ')' : '') }}</p>
                @if (isset($item->sku) && $item->sku)
                    <img id="barcode-img" src="{{ asset('barcode/' . $item->sku . '.svg?v=' . time() ) }}" style="width: 2.5in" alt="">
                @else
                    <img id="barcode-img" src="{{ asset('barcode/' . $client->po_number . '.svg?v=' . time() ) }}" style="width: 2.5in" alt="">
                @endif
            </div>
        </div>
    @endforeach
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
