@extends('backend.layouts.layout')

@section('headInlineTag')
<style>
    /* Write Style,link external CSS files   */
    .simple-heading-bg {
        background-color: #1E7062;
    }

    .purchase-color {
        color: #1e7063;
    }

    .total {
        background-color: #1e7063;
        color: #fff;
        outline: none;
    }

    .contact-color {
        color: 206C5F;
    }

    .button-bg {
        background-color: #206C5F;

    }

    .button-bg:hover {
        background-color: #206C5F !important;
    }

    .print-border {
        background-color: gray;
    }

    .black-color {
        color: black !important;
    }

    .background-blue {
        background-color: #EAF2FA;
    }

    .background-white {

        background-color: #fff !important;
    }

    .kbw-signature {
        width: 100%;
        height: 200px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }

    .black {
        color: black;
    }

    @media only screen and (min-width: 240px) and (max-width: 319px) {
        .button-column {
            justify-content: center !important;


        }

        .total-column {
            justify-content: center !important;
        }
    }

    @media only screen and (min-width: 320px) and (max-width: 479px) {
        .button-column {
            justify-content: center !important;


        }

        .total-column {
            justify-content: center !important;
        }

    }

    @media only screen and (min-width: 360px) and (max-width: 479px) {

        h2 {
            margin: 7px;
        }

        p {
            margin: 0 10px;
        }

        button,
        input,
        optgroup,
        select,
        textarea {

            margin-top: 10px;
        }


    }
</style>
@endsection

@section('pageName', __('Edit Pos '))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">{{ __('Pos') }}</a></li>
<li class="breadcrumb-item active">{{ __('Edit Pos') }}</li>
@endSection

@section('content')

<div class="card">
    <form method="post" action="{{ route('client.update', ['id' => $clientDetails->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-header" style="width: 100%; padding: 10px 10px 10px 20px">
            <h4 class="card-title black">All fields marked with asterisks<span style="color:red"> (*) </span>are
                required.
            </h4>
        </div>
        <div class="card-body">
            <div class="form theme-form">
                <!-- Include Form -->
                @include('backend.client._form')
                <!-- =============================== -->
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i data-feather="save"></i>Update</button>
        </div>
    </form>

    {{-- <div class="row">
            <div class="col-12 gx-0"> --}}
    {{-- <div class="card">
            <div class="simple-heading-bg ">
                <h4 class="card-title text-white my-1 mx-2">
                    PRODUCT DETAILS
                </h4>


            </div>
            <div class="card-datatable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="8%">S#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Condition</th>
                            <th>Price</th>

                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($clientDetails->product->count())
                            @foreach ($clientDetails->product as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
    <td>
        @if ($item->image_path)
        <img src="{{ asset('/products/' . $item->image_path) }}" width="150px" height="150px" />
        @else
        <span class="fw-bold"> No Image found</span>
        @endif
    </td>

    <td>{{ $item->name }}</td>
    <td>{{ $item->condition }}</td>
    <td>{{ $item->price }}</td>
    <td>
        <a class="btn btn-sm btn-edit edit_product_details" data-bs-toggle="modal" data-bs-target="#edit_product_details" data-change_product_id="{{ $item->id }}" data-change_product_condition="{{ $item->condition }}" data-change_product_name="{{ $item->name }}" data-change_product_price="{{ $item->price }}" data-change_product_image="{{ $item->image_path }}" data-total_amount="{{ $clientDetails->total_amount }}" data-relevant_client_id={{ $clientDetails->id }}>

            <div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                    </path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                    </path>
                </svg></div>

    </td>
    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="3">
            <center>No Record Found</center>
        </td>
    </tr>
    @endif
    </tbody>
    </table>
</div>
</div> --}}
{{-- </div>
        </div> --}}
</div>

@endsection

@section('jsOutside')
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/jquery.signature.js') }}"></script>

{{-- Write script,link external JS files --}}
@include('backend.custom_js.init_js')
@include('backend.client.modal.edit_product_details')
@include('backend.client.modal.add_product_details')
@include('backend.client.modal.delete')
<script type="text/javascript">
    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG'
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

@endsection
