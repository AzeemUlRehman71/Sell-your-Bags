@extends('backend.layouts.layout')

@section('headInlineTag')

    {{-- Write Style,link external CSS files --}}

@endsection

@section('pageName', __('Pos Details'))
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Home</a>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('pos.index') }}">{{ __('Pos') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Pos Detail') }}</li>
@endSection

{{-- @can('create product')
    @section('route', route('product.edit', ['id' => $detail->uid]))
@endcan --}}

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-right no-gutters py-1 px-0 mx-0">

                <div class="col-md-12 d-flex justify-content-end">
                    <form method="post" action="{{ route('print', ['id' => $clientDetails->id]) }}">
                        @csrf
                        <button class="btn btn-sm btn-success" type="submit" formtarget="_blank">PRINT PAGE<i
                                class="bi bi-printer"></i></button>
                    </form>
                </div>
            </div>
            <div class="card">


                <table class="table  table-bordered">
                    <tr>

                        <td><b class="text-primary">PO Number</b></td>
                        <td>{{ $clientDetails->po_number }}</td>


                    </tr>
                    <tr>

                        <td><b class="text-primary">Name</b></td>
                        <td>{{ ucwords($clientDetails->name) }}</td>
                        <td><b class="text-primary">Phone</b></td>
                        <td>{{ $clientDetails->phone }}</td>


                    </tr>

                    <tr>

                        <td><b class="text-primary">Address</b></td>
                        <td>{{ $clientDetails->address }}</td>
                        <td style="font-size: 16px;color:brown"><b>Status</b></td>
                        @if ($clientDetails->client_status == 'Approved')
                            <td><span class="badge rounded-pill badge-light-success" text-capitalized="">Approved</span>
                            </td>
                        @elseif($clientDetails->client_status == 'Pending')
                            <td><span class="badge rounded-pill badge-light-secondary" text-capitalized="">Pending</span>
                            </td>
                        @else
                            <td><span class="badge rounded-pill badge-light-danger" text-capitalized="">Rejected</span></td>
                        @endif
                    </tr>
                    <tr>
                        <td><b class="text-primary">ID Card</b></td>
                        <td>
                            @if ($clientDetails->id_card_image)
                                <img src="{{ asset('/idcard/' . $clientDetails->id_card_image) }}" width="300px"
                                    height="150px" />
                            @else
                                <span class="fw-bold"> No Image found</span>
                            @endif
                        </td>
                        <td><b class="text-primary">Email </b></td>
                        <td>{{ $clientDetails->email }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Products
                        </h4>
                        {{-- <h5><b class="text-primary">Total Amount:</b>${{ $clientDetails->total_amount }} </h5> --}}
                        {{-- <button type="button" class="btn btn-sm btn-success add_picture" data-bs-toggle="modal"
                            data-bs-target="#add_picture" data-pic_product_id=""><i class="fa fa-plus"></i> Add </button> --}}
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

                                    {{-- <th width="15%">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($clientDetails->product->count())
                                    @foreach ($clientDetails->product as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($item->image_path)
                                                    <img src="{{ asset('/products/' . $item->image_path) }}" width="150px"
                                                        height="150px" />
                                                @else
                                                    <span class="fw-bold"> No Image found</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->condition }} </td>
                                            <td>${{ $item->price }} </td>

                                            {{-- <td>
                                                <button class="btn btn-sm btn-danger remove_product" data-bs-toggle="modal"
                                                    data-bs-target="#remove_product" data-remove_picture_id=""><i
                                                        class="fa fa-times"></i>
                                                    Remove </button>
                                            </td>  --}}
                                        </tr>
                                    @endforeach
                                    <tr>


                                        <td colspan="5" style="text-align:right;">
                                            <h5><b class="text-primary">Total
                                                    Amount: </b>${{ $clientDetails->total_amount }} </h5>
                                        </td>
                                    </tr>
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
                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-md-12">

            <div class="card">


                <table class="table  table-bordered">

                    <tr>
                        <td><b class="text-primary">Payout</b></td>
                        <td>{{ $clientDetails->payment_method }}</td>
                        <td><b class="text-primary">Email </b></td>
                        <td>{{ $clientDetails->payment_email }}</td>
                        <td><b class="text-primary">Name</b></td>
                        <td>{{ $clientDetails->payment_full_name }}</td>

                    </tr>


                </table>



            </div>
        </div>
    </div>





    {{-- Include Attach Unit Modal --}}
    {{-- @include('product.modal.attach_unit') --}}
    {{-- Include Detach Unit Model --}}
    {{-- @include('product.modal.detach_unit') --}}
    {{-- Include Add Picture Modal --}}
    {{-- @include('product.modal.add_picture') --}}
    {{-- Include Remoce Picture Modal --}}
    {{-- @include('product.modal.remove_picture') --}}
    {{-- Include Edit Unit Modal --}}
    {{-- @include('backend.client.modal.edit_product_unit') --}}
@endsection

@section('jsOutside')

    {{-- Write script,link external JS files --}}
    {{-- Include Custom js File --}}
    {{-- @include('backend.custom_js.init_js') --}}
@endsection
