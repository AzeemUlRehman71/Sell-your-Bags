<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Sell Your Bags">
    <meta name="keywords" content="Sell Your Bags">
    <meta name="author" content="https://www.linkedin.com/in/gul-muhammad-285a7b41/"">
    <title>Sell Your Bags</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/avatar.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css?v=1.2') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- DataTable Links -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">

    <!-- DataTable Links End -->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">


    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
    <!-- BEGIN: Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css') }}"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/editpagestyle.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="//keith-wood.name/css/jquery.signature.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.signature.css') }}">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />



    <style>
        .simple-heading-bg {
            background-color: #1E7062;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        ul {
            margin-left: 10px;
        }

        .wtree li {
            list-style-type: none;
            margin: 10px 0 10px 10px;
            position: relative;
        }

        .wtree li:before {
            content: "";
            position: absolute;
            top: -10px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            width: 20px;
            height: 30px;
        }

        .wtree li:after {
            position: absolute;
            content: "";
            top: 5px;
            left: -20px;
            border-left: 1px solid #ddd;
            border-top: 1px solid #ddd;
            width: 20px;
            height: 100%;
        }

        .wtree li:last-child:after {
            display: none;
        }

        .wtree li span {
            display: block;
            border: 1px solid #ddd;
            padding: 10px;
            color: #888;
            text-decoration: none;
        }

        .wtree li span:hover,
        .wtree li span:focus {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }

        .wtree li span:hover+ul li span,
        .wtree li span:focus+ul li span {
            background: #eee;
            color: #000;
            border: 1px solid #aaa;
        }

        .wtree li span:hover+ul li:after,
        .wtree li span:hover+ul li:before,
        .wtree li span:focus+ul li:after,
        .wtree li span:focus+ul li:before {
            border-color: #aaa;
        }



        html {
            height: 100%;
        }

        .loader_body {
            position: absolute;
            width: 96%;
            height: 82%;
            border-radius: 50%;
            perspective: 800px;
        }

        .loader {
            position: absolute;
            top: calc(50% - 32px);
            left: calc(50% - 32px);
            width: 64px;
            height: 64px;
            border-radius: 50%;
            perspective: 800px;
        }

        .inner {
            position: absolute;
            box-sizing: border-box;
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .inner.one {
            left: 0%;
            top: 0%;
            animation: rotate-one 1s linear infinite;
            border-bottom: 3px solid black;
        }

        .inner.two {
            right: 0%;
            top: 0%;
            animation: rotate-two 1s linear infinite;
            border-right: 3px solid black;
        }

        .inner.three {
            right: 0%;
            bottom: 0%;
            animation: rotate-three 1s linear infinite;
            border-top: 3px solid black;
        }

        @keyframes rotate-one {
            0% {
                transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
            }

            100% {
                transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
            }
        }

        @keyframes rotate-two {
            0% {
                transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
            }

            100% {
                transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
            }
        }

        @keyframes rotate-three {
            0% {
                transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
            }

            100% {
                transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
            }
        }

        /** Checkbox Css **/
        .checkbox {
            position: relative;
            margin: 0 1rem 0 0;
            cursor: pointer;
        }

        .checkbox:before {
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
            content: "";
            position: absolute;
            left: 0;
            z-index: 1;
            width: 1rem;
            height: 1rem;
            border: 2px solid #f2f2f2;
        }

        .checkbox:checked:before {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
            height: 0.5rem;
            border-color: #009688;
            border-top-style: none;
            border-right-style: none;
        }

        .checkbox:after {
            content: "";
            position: absolute;
            top: -0.125rem;
            left: 0;
            width: 1.1rem;
            height: 1.1rem;
            background: #fff;
            cursor: pointer;
        }

        .button--round {
            -webkit-transition: 0.3s background ease-in-out;
            -moz-transition: 0.3s background ease-in-out;
            transition: 0.3s background ease-in-out;
            width: 2rem;
            height: 2rem;
            background: #5677fc;
            border-radius: 50%;
            box-shadow: 0 0.125rem 0.3125rem 0 rgba(0, 0, 0, 0.25);
            color: #fff;
            text-decoration: none;
            text-align: center;
        }

        .button--round i {
            font-size: 1rem;
            line-height: 220%;
            vertical-align: middle;
        }

        .button--round:hover {
            background: #3b50ce;
        }

        .button--sticky {
            position: fixed;
            right: 2rem;
            top: 16rem;
        }

        @-webkit-keyframes slideUp {
            0% {
                -webkit-transform: translateY(6.25rem);
                transform: translateY(6.25rem);
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            0% {
                -webkit-transform: translateY(6.25rem);
                transform: translateY(6.25rem);
            }

            100% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
        }

        /** Inner Table Loader **/

        .loader {
            width: 100px;
            height: 100px;
            border-radius: 100%;
            position: relative;
            margin: 0 auto;
        }

        #loader-6 {
            top: 40px;
            left: -2.5px;
        }

        #loader-6 span {
            display: inline-block;
            width: 5px;
            height: 20px;
            background-color: #9187F4;
        }

        #loader-6 span:nth-child(1) {
            animation: grow 1s ease-in-out infinite;
        }

        #loader-6 span:nth-child(2) {
            animation: grow 1s ease-in-out 0.15s infinite;
        }

        #loader-6 span:nth-child(3) {
            animation: grow 1s ease-in-out 0.30s infinite;
        }

        #loader-6 span:nth-child(4) {
            animation: grow 1s ease-in-out 0.45s infinite;
        }

        @keyframes grow {

            0%,
            100% {
                -webkit-transform: scaleY(1);
                -ms-transform: scaleY(1);
                -o-transform: scaleY(1);
                transform: scaleY(1);
            }

            50% {
                -webkit-transform: scaleY(1.8);
                -ms-transform: scaleY(1.8);
                -o-transform: scaleY(1.8);
                transform: scaleY(1.8);
            }
        }

        /** ************************************************* */
        /** Moving car Css */
        *,
        :after,
        :before {
            box-sizing: border-box
        }

        .pull-left {
            float: left
        }

        .pull-right {
            float: right
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table
        }

        .clearfix:after {
            clear: both;
            display: block
        }

        .car .mirror-wrap:before,
        .car .mirror-wrap:after,
        .car .mirror-inner:before,
        .car .mirror-inner:after,
        .car .middle .top:before,
        .car .middle .top:after,
        .car .lights:before,
        .car .lights:after,
        .car .bumper .top:before,
        .car .bumper .top:after,
        .car .bumper .middle:before,
        .car .tyres .tyre:before,
        .car .tyres .tyre:after {
            content: '';
            position: absolute;
        }

        .car {
            z-index: 1;
            margin-left: 70px;
            position: relative;
            display: inline-block;
        }

        .car .body {
            z-index: 1;
            position: relative;
            animation: suspension 4s linear infinite;
        }

        .car .mirror-wrap {
            width: 88px;
            height: 30px;
            margin: auto;
            position: relative;
            background-color: #fff;
            border-top-left-radius: 45px 10px;
            border-top-right-radius: 45px 10px;
        }

        .car .mirror-wrap:before,
        .car .mirror-wrap:after {
            top: 8px;
            border: 5px solid #1a1c20;
            border-top: 15px solid transparent;
        }

        .car .mirror-wrap:before {
            left: -5px;
            border-left: 0 solid transparent;
        }

        .car .mirror-wrap:after {
            right: -5px;
            border-right: 0 solid transparent;
        }

        .car .mirror-inner {
            top: 2px;
            width: inherit;
            height: inherit;
            margin: inherit;
            position: inherit;
            background-color: #1a1c20;
            border-top-left-radius: 50px 8px;
            border-top-right-radius: 50px 8px;
        }

        .car .mirror-inner:before,
        .car .mirror-inner:after {
            bottom: 0;
            width: 10px;
            height: 8px;
            background-color: #252525;
        }

        .car .mirror-inner:before {
            left: -12px;
            border-radius: 2px 0 0 5px;
        }

        .car .mirror-inner:after {
            right: -12px;
            border-radius: 0 2px 5px 0;
        }

        .car .mirror {
            width: 100%;
            z-index: 10;
            height: 25px;
            ;
            overflow: hidden;
            position: relative;
            border-top-left-radius: 45px 10px;
            border-top-right-radius: 45px 10px;
        }

        .car .mirror .shine {
            left: 50%;
            width: 5px;
            z-index: -1;
            height: 40px;
            position: absolute;
            margin-left: -2.5px;
            background-color: #3d3e3e;
            animation: shine 4s linear infinite;
        }

        .car .middle {
            z-index: 1;
            margin-top: -2px;
        }

        .car .middle .top {
            width: 98px;
            height: 14px;
            margin: auto;
            position: relative;
            background-color: #f7f7f7;
        }

        .car .middle .top:before,
        .car .middle .top:after {
            top: 0;
            border: 5px solid #f7f7f7;
            border-top: 9px solid transparent;
        }

        .car .middle .top:before {
            left: -7px;
            border-left: 2px solid transparent;
        }

        .car .middle .top:after {
            right: -7px;
            border-right: 2px solid transparent;
        }

        .car .middle .top .line {
            top: 2px;
            height: 1px;
            width: 44px;
            margin: auto;
            position: relative;
            background-color: #bebebe;
        }

        .car .middle .bottom {
            margin: auto;
            width: 115px;
            height: 20px;
            margin-top: -2px;
            background-color: #dfdfdf;
            border-top-left-radius: 4px 5px;
            border-top-right-radius: 4px 5px;
        }

        .car .lights {
            top: 5px;
            width: 111px;
            height: 12px;
            margin: auto;
            position: relative;
            border-radius: 2px;
            background-color: #6a6a6a;
        }

        .car .lights:before,
        .car .lights:after {
            top: 50%;
            width: 16px;
            height: 16px;
            margin-top: -8px;
            border-radius: 50%;
            background-color: #fff;
            border: 1px solid #777;
        }

        .car .lights:before {
            left: 3px
        }

        .car .lights:after {
            right: 3px
        }

        .car .lights .line {
            top: 50%;
            left: 50%;
            width: 50%;
            height: 1px;
            background: #fff;
            position: absolute;
            transform: translateX(-50%);
        }

        .car .bumper .top {
            width: 110px;
            height: 10px;
            margin: auto;
            position: relative;
            background-color: #202428;
            border-radius: 0 0 6px 6px;
            border-top: 1px solid #474949;
            border-bottom: 1px solid #474949;
        }

        .car .bumper .top:before,
        .car .bumper .top:after {
            top: 50%;
            width: 10px;
            height: 4px;
            margin-top: -2px;
            border-radius: 1px;
            background-color: #FB8C00;
        }

        .car .bumper .top:before {
            left: 5px
        }

        .car .bumper .top:after {
            right: 5px
        }

        .car .bumper .middle {
            height: 8px;
            width: 102px;
            margin: auto;
            position: relative;
            background-color: #cfcfcf;
            border-radius: 0 0 6px 6px;
        }

        .car .bumper .middle:before {
            top: 50%;
            left: 50%;
            color: #fff;
            height: 12px;
            font-size: 8px;
            padding: 1px 4px;
            font-weight: 500;
            margin-top: -6px;
            line-height: 10px;
            text-align: center;
            white-space: nowrap;
            content: attr(data-numb);
            background-color: #7367F0;
            transform: translateX(-50%);
        }

        .car .bumper .bottom {
            height: 6px;
            width: 85px;
            margin: auto;
            position: relative;
            background-color: #202428;
            border-radius: 0 0 6px 6px;
            box-shadow: 0 1px 11px rgba(0, 0, 0, .75);
        }

        .car .tyres {
            margin: auto;
            width: 110px;
            position: relative;
        }

        .car .tyres .tyre {
            width: 100%;
            height: 40px;
            bottom: -6.5px;
            position: absolute;
        }

        .car .tyres .tyre:before {
            left: -5px;
            box-shadow: -2px 2px 0 #b7b7b8 inset;
        }

        .car .tyres .tyre:after {
            right: -5px;
            box-shadow: 2px 2px 0 #b7b7b8 inset;
        }

        .car .tyres .tyre:before,
        .car .tyres .tyre:after {
            width: 18px;
            height: 40px;
            border-radius: 6px;
            background-color: #1a1c20;
            background: linear-gradient(to right, #333 50%, #555 50%);
            background-size: 2px;
        }

        .car .tyres .tyre.back:before,
        .car .tyres .tyre.back:after {
            bottom: 3px
        }

        .car .tyres .tyre.back:before {
            left: 12px
        }

        .car .tyres .tyre.back:after {
            right: 12px
        }


        @keyframes shine {

            0%,
            80%,
            100% {
                transform: translateX(-55px) rotate(24deg);
            }

            5%,
            15%,
            25%,
            35%,
            45%,
            55%,
            65%,
            75%,
            85%,
            95% {
                background-color: #2d2d2d
            }

            0%,
            10%,
            20%,
            30%,
            40%,
            50%,
            60%,
            70%,
            80%,
            90%,
            100% {
                background-color: #4d4d4d
            }

            33%,
            44% {
                transform: translateX(30px) rotate(-14deg);
            }

            66% {
                transform: translateX(0px) rotate(-10deg);
            }
        }

        @keyframes lane {
            0% {
                transform: translateY(320px);
            }

            100% {
                transform: translateY(-160px);
            }
        }

        @keyframes steer {

            0%,
            100% {
                transform: translateX(-15px) rotate(5deg);
            }

            50% {
                transform: translateX(15px) rotate(-5deg)
            }
        }

        @keyframes suspension {

            0%,
            75%,
            100% {
                transform: rotate(3deg)
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                top: 0
            }

            20%,
            40%,
            60%,
            80%,
            100% {
                top: -1px
            }

            25%,
            50% {
                transform: rotate(-3deg)
            }

            20% {
                transform: rotate(0deg)
            }

            90% {
                transform: rotate(-1deg)
            }
        }

        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
        .filepond--item {
            width: calc(50% - 0.5em);
        }

        .filepond--credits {
            display: none;
        }


        @media (min-width: 30em) {
            .filepond--item {
                width: calc(50% - 0.5em);
            }
        }

        @media (min-width: 50em) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        }

    </style>
    <!-- ============================================= -->
    <!-- outside css style -->
    @yield('headInlineTag')
    <!-- End Outside css style -->
    <!-- ============================================= -->
