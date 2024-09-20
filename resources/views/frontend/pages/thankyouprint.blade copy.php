<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content=".">
    <meta name="keywords" content="">
    <meta name="author" content="IKONIC">
    <title>Sell Your Bages</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
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
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div class="row" style=" width: 100%">
                                    <div class="logo-wrapper col-md-2 col-sm-2">
                                        <img src="{{ asset('app-assets\images\logo\food_logo.png') }}" style="width: 170px" class="invoice-logo">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <p class="card-text mb-25" style="line-height: 15px; text-align: left; font-weight: bold; font-size: 20px; margin-left: 35px; color: black">100% Food Group INC.</p>
                                        <p class="card-text mb-25" style="line-height: 8px; text-align: left; margin-left: 35px">14001 NW 112 AVE STE 5 Hialeah Gardens, FL 33018</p>
                                        <p class="card-text mb-25" style="line-height: 8px; text-align: left; margin-left: 35px">(305) 434-5267</p>
                                        <p class="card-text mb-0" style="line-height: 8px; text-align: left; margin-left: 35px">info@foodgroupinc.com</p>
                                        <p class="card-text mb-0" style="line-height: 30px; text-align: left; margin-left: 35px">WWW.FOODGROUPINC.COM</p>
                                    </div>
                                    <div class=" col-md-4 col-sm-4">
                                        <h2 style="text-align: right;"> Expiry Report</h2>
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->
                        </div>

                        <hr class="invoice-spacing" style="margin-top: 20px"/>
                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                <tr style="background-color: black !important;">
                                    <th style="background-color: grey !important; color: white !important;">S#</th>
                                    <th style="background-color: grey !important; color: white !important;">product</th>
                                    <th style="background-color: grey !important; color: white !important;">Unit</th>
                                    <th style="background-color: grey !important; color: white !important;">Qty</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- @foreach($list as $item) --}}
                                    <tr>
                                        <td>sdfsdf</td>
                                        <td class="">
                                            <span class="fw-bold">dfdf</span>
                                        </td>
                                        <td class="">
                                            <span class="fw-bold">dasfasfd</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">adsfasdf</span>
                                        </td>

                                    </tr>
                                {{-- @endforeach --}}
                                </tbody>
                            </table>
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
