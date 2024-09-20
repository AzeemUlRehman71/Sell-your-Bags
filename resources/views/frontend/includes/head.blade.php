<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sell Your Bags</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    {{-- <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" /> --}}

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}"> --}}

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">

    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/style.css?v=1.2') }}">
    <!-- END: Custom CSS-->

    <link rel="stylesheet" type="text/css" href="https://keith-wood.name/css/jquery.signature.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery.signature.css') }}">

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

        <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') }}">

    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }

        #signed canvas {
            width: 100% !important;
            height: auto;
        }

        /* input[type="file" i] {
            appearance: inherit;
            background-color: inherit;
            cursor: inherit;
            align-items: inherit;
            color: inherit;
            text-overflow: inherit;
            white-space: inherit;
            text-align: inherit !important;
            padding: inherit;
            border: inherit;
            overflow: inherit !important;
        } */
        /* input[type="file" i] {
            cursor: inherit;
        } */

        .filepond--root {
            /* max-height: 20em; */
        }
        #sig > canvas {
           width: 100% !important;
           height: 100% !important;
        }
    </style>
</head>
