@extends('backend.layouts.layout')

@section('headInlineTag')

    {{-- Write Style,link external CSS files --}}

@endsection

@section('pageName', __('Pos Details'))
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Home</a>
        {{-- <img src="{{ asset('storage/app/posts/tmp/post6399614a2e3724.06278339/images.png') }}"
                class="img-fluid"></p> --}}
        <?php //echo Storage::disk('public')->path('');
        ?>
    </li>
    <li class="breadcrumb-item"><a href="{{ route('pos.index') }}">{{ __('Pos') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Pos Detail') }}</li>
@endSection

{{-- @can('create product')
    @section('route', route('product.edit', ['id' => $detail->uid]))
@endcan --}}

@section('content')

    <!-- Invoice -->
    <div class="col-xl-12 col-md-12 col-12">
        <div class="invoice-preview-card">

            <div class="row no-gutters pt-1">
                <div class="col-md-6 d-flex justify-content-start">
                    <h4 class="greenish-color fs-2">PURCHASE ORDER NO# {{ $clientDetails->po_number }}
                    </h4>
                </div>


                <div class="col-md-6 d-flex justify-content-end">
                    <form method="post" action="{{ route('print', ['id' => $clientDetails->id]) }}">
                        @csrf
                        <button class="btn btn-sm simple-heading-bg text-white" type="submit" formtarget="_blank">PRINT
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-printer">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg></button>
                    </form>
                </div>
            </div>

            <hr class="invoice-spacing" style="margin-top: 10px" />

            <div class="row no-gutters simple-heading-bg">
                <div class="col-md-12 d-flex justify-content-left">
                    <h4 class="text-white  fs-4 my-1">CONTACT INFORMATION</h4>
                </div>

            </div>

            <div class="row no-gutters d-flex background-blue justify-content-center"
                style="background-color: #EAF2FA !important;">
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">FULL NAME</label>
                    <p>{{ $clientDetails->name }}</p>
                </div>
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">EMAIL</label>
                    <p>{{ $clientDetails->email }}</p>
                </div>
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">PHONE</label>
                    <p>{{ $clientDetails->phone }}</p>
                </div>
            </div>
            <div class="row no-gutters d-flex background-white justify-content-left">
                <div class="col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">ADDRESS</label>
                    <p>{{ $clientDetails->short_address }}</p>
                </div>
                <div class="col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">ID CARD</label>


                    <p><img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}" class="img-fluid">
                    </p>
                </div>

            </div>

            <!-- Invoice Description starts -->
            {{-- <div class="table-responsive mt-5">
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
                               
                                <td class="py-1 ps-4 mt-1">
                                  
                                    @if ($item->image_path)
                                        <img src="{{ asset('/products/' . $item->image_path) }}" width="150px"
                                            height="150px" />
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
            </div> --}}
            <div class="row">
                <div class="col-12 gx-0">
                    <div class="card">
                        <div class="simple-heading-bg ">
                            <h4 class="card-title text-white my-1 mx-2">
                                PRODUCT INFORMATION
                            </h4>
                        </div>
                        <div class="card-datatable">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Condition</th>
                                        <th>Price</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($clientDetails->product->count())
                                        @foreach ($clientDetails->product as $item)
                                            <tr>

                                                <td>
                                                    @if ($item->image_path)
                                                        <img src="{{ asset('product/' . $item->image_path) }}"
                                                            class="img-fluid" />
                                                    @else
                                                        <span class="fw-bold"> No Image found</span>
                                                    @endif
                                                </td>

                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->condition }}</td>
                                                <td>{{ $item->price }}</td>

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
                    </div>
                </div>
            </div>
            <div class="row invoice-sales-total-wrapper mt-1">
                {{-- <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                    <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> <span class="ms-75">Alfie Solomons</span></p>
                </div> --}}
                <div class="col-md-12 d-flex justify-content-end order-md-2 order-1">
                    <div class="invoice-total-wrapper">
                        {{-- <div class="invoice-total-item">
                            <p class="invoice-total-title">Subtotal:</p>
                            <p class="invoice-total-amount">$1800</p>
                        </div>
                        <div class="invoice-total-item">
                            <p class="invoice-total-title">Discount:</p>
                            <p class="invoice-total-amount">$28</p>
                        </div>
                        <div class="invoice-total-item">
                            <p class="invoice-total-title">Tax:</p>
                            <p class="invoice-total-amount">21%</p>
                        </div> --}}
                        {{-- <hr class="my-50"> --}}
                        <div class="d-flex justify-content-center">
                            <p class="invoice-total-title fw-bolder black fs-3">Total: </p>
                            <p class="invoice-total-amount fw-bolder black mx-1 fs-3"> ${{ $clientDetails->total_amount }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row no-gutters simple-heading-bg">
                <div class="col-md-12 d-flex justify-content-left">
                    <h4 class="text-white  fs-4 my-1">PAYMENT INFORMATION</h4>
                </div>

            </div>

            <div class="row no-gutters d-flex background-blue justify-content-center"
                style="background-color: #EAF2FA !important;">
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">PAYOUT</label>
                    <p>{{ $clientDetails->payment_method }}</p>
                </div>
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">NAME</label>
                    <p>{{ $clientDetails->payment_full_name }}</p>
                </div>
                <div class="col-md-4 col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">EMAIL</label>
                    <p>{{ $clientDetails->payment_email }}</p>
                </div>
            </div>
            @if ($clientDetails->payment_direct_account_number)
                <div class="row no-gutters d-flex background-blue justify-content-center"
                    style="background-color: #d3eaff !important;">
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">BANK NAME</label>
                        <p>{{ $clientDetails->payment_direct_bank_name }}</p>
                    </div>
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">ACCOUNT NUMBER</label>
                        <p>{{ $clientDetails->payment_direct_account_number }}</p>
                    </div>
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">ROUTING NUMBER</label>
                        <p>{{ $clientDetails->payment_direct_routing_number }}</p>
                    </div>
                    <div class="col-md-3  pl-5 pt-2">
                        <label class="fw-bolder black">ACCOUNT TYPE</label>
                        <p>{{ $clientDetails->payment_direct_account_type }}</p>
                    </div>

                </div>
            @endif


            <div class="row no-gutters justify-content-center  py-5 px-4" style="background-color:#fff;">

                @if ($clientDetails->signature)
                    <div class="col-md-12  justify-content-center">
                        <label class="fw-bolder black">SIGNATURE</label>
                        <P><img src="{{ asset('signature/' . $clientDetails->signature) }}" width="200px"></p>

                    </div>
                @endif
            </div>


        </div>
    </div>
    <!-- /Invoice -->





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
