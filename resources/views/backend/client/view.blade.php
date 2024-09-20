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
    <div class="col-xl-12 col-md-12 col-12" style="text-align: right;">
        @if(isset($backClient))
            <a href="{{ route('client.view', ['id' => $backClient->id]) }}"
               class="btn btn-sm simple-heading-bg text-white waves-effect waves-float waves-light"><i
                    class="fas fa-arrow-left"></i></a>
        @endif

        @if(isset($nextClient))
            <a href="{{ route('client.view', ['id' => $nextClient->id]) }}"
               class="btn btn-sm simple-heading-bg text-white waves-effect waves-float waves-light"><i
                    class="fas fa-arrow-right"></i></a>
        @endif
    </div>
    <div class="col-xl-12 col-md-12 col-12">
        <div class="invoice-preview-card">

            <div class="row no-gutters pt-1">
                <div class="col-md-6 d-flex justify-content-start">
                    <h4 class="greenish-color fs-2">PURCHASE ORDER NO# {{ $clientDetails->po_number }}
                    </h4>
                </div>


                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ url('/barcode-print/' . $clientDetails->id) }}" class="btn btn-info"
                       style="margin-right: 3px;" target="_blank">Barcode <i class="fas fa-barcode nav-icon"></i></a>
                    <a style="margin-right: 3px;" class="btn btn-warning edit_product_unit" data-bs-toggle="modal"
                       data-bs-target="#edit_unit" data-edit_product_id="{{ $clientDetails->id }}"
                       data-edit_client_status="{{ $clientDetails->client_status }}">Change Status</a>
                    <a style="margin-right: 3px;" href="{{ route('client.edit', ['id' => $clientDetails->id]) }}"
                       class="btn btn-primary">Edit</a>
                    <form method="post" action="{{ route('print', ['id' => $clientDetails->id]) }}">
                        @csrf
                        <button class="btn simple-heading-bg text-white" type="submit" formtarget="_blank">PRINT
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-printer">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path
                                    d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <hr class="invoice-spacing" style="margin-top: 10px"/>

            <div class="row no-gutters simple-heading-bg">
                <div class="col-md-12 d-flex justify-content-left">
                    <h4 class="text-white  fs-4 my-1">CONTACT INFORMATION</h4>
                </div>

            </div>

            <div class="row no-gutters d-flex background-blue justify-content-center"
                 style="background-color: #EAF2FA !important;">
                <div class="col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">FULL NAME</label>
                    <p>{{ $clientDetails->name }}</p>
                </div>
                <div class="col-md-5 pl-5 pt-2">
                    <label class="fw-bolder black">EMAIL</label>
                    <p>{{ $clientDetails->email }}</p>
                </div>
                <div class="col-md-3 pl-5 pt-2">
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

                    @if ($clientDetails->id_card_image)
                        <p><img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}"
                                style="height: 100px; width:120px;" id="idimg">
                        </p>
                    @else
                        <p>No Image Found
                        </p>
                    @endif
                </div>

                <div class="col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">Status</label>
                    <p>{{ $clientDetails->client_status }}</p>
                </div>


                {{--<div class="col-md-2 pl-5 pt-2">
                    <label class="fw-bolder black">Tagged</label>
                    <p class="ps-2"><input type="checkbox" onclick="handleTagged({{ $clientDetails->id }})" {{ $clientDetails->tagged == 1 ? 'checked' : '' }}></p>
                </div>--}}

            </div>

            <div class="row no-gutters d-flex background-white justify-content-left">
                <div class="col-md-4 pl-5 pt-2">
                    <label class="fw-bolder black">Tracking</label>
                    <p>{{ $clientDetails->tracking ? $clientDetails->tracking : '---' }}</p>
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
                        <div class="card-datatable table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Condition</th>
                                    <th>Price</th>
                                    <th class="text-center">Tagged</th>
                                    <th class="text-center">Condition Report</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if ($clientDetails->product->count())
                                    @foreach ($clientDetails->product as $item)
                                        <tr>
                                            <td>{{ $item->sku }}</td>
                                            <td>
                                                @if (count($item->images()))
                                                    @foreach ($item->images() as $img)
                                                        <img src="{{ asset('product/' . $img) }}"
                                                             imgname="{{ asset('product/' . $img) }}" class="img-fluid"
                                                             style="height: 75px; width:80px; margin: 5px; object-fit: cover;"
                                                             id="tableimg"/>
                                                    @endforeach
                                                @else
                                                    <span class="fw-bold"> No Image found</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <ul>
                                                    <li>{{ $item->condition }}</li>
                                                    <li>{{ $item->condition_two }}</li>
                                                    <li>{{ $item->condition_three }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $item->price }}</td>
                                            <td class="text-center"><input type="checkbox"
                                                                           onclick="taggedProductItem({{ $item->id }})" {{ $item->tagged == 1 ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-primary" style="padding: 0.486rem .5rem;"
                                                        onclick="fetchConditionReport({{ $item->id }})"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Condition Report"><i class="fas fa-pen-to-square"></i>
                                                </button>
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
                    </div>
                </div>
            </div>
            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                 aria-hidden="true" style="background: #111111cc;">
                <div class="modal-dialog" role="document" style="max-width: 500px;top: 30%;bottom: 0;margin: 0 auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close"
                                    style="margin-left: auto;font-size: 26px;padding: 0;" id="closemodal">
                                X
                            </button>
                        </div>
                        {{--<div class="modal-body">
                            <div class="form-group">
                                <img src="{{ asset('product/' . $item->image_path) }}"style="width: 100%;height: auto;object-fit: contain;" class="tableimg"/>--}}
                        @if (isset($item))
                            <img src="{{ asset('product/' . $item->image_path) }}"
                                 style="width: 100%;height: 350px;object-fit: cover;" class="tableimg"/>
                        @endif
                        {{--</div>
                    </div>--}}
                    </div>
                </div>
            </div>
            <div class="modal fade" id="demoModal1" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                 aria-hidden="true" style="background: #111111cc;">
                <div class="modal-dialog" role="document" style="max-width: 400px;top: 30%;bottom: 0;margin: 0 auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn" data-dismiss="modal" aria-label="Close"
                                    style="margin-left: auto;font-size: 26px;padding: 0;" id="closemodal">
                                X
                            </button>
                        </div>
                        {{--<div class="modal-body">
                            <div class="form-group">--}}
                        {{--<img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}" style="width: 100%;height: auto;object-fit: contain;" id="idimg">--}}
                        <img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}"
                             style="width: 100%;height: 240px;object-fit: cover;" id="idimg">
                        {{--</div>
                    </div>--}}
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
                            <p class="invoice-total-amount fw-bolder black mx-1 fs-3">
                                ${{ $clientDetails->total_amount }}
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
            {{-- @if ($clientDetails->payment_method == 'direct') --}}
            <div class="row no-gutters d-flex background-blue justify-content-center"
                 style="background-color: #d3eaff !important;">
                @if ($clientDetails->payment_direct_bank_name)
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">BANK NAME</label>
                        <p>{{ $clientDetails->payment_direct_bank_name }}</p>
                    </div>
                @endif
                @if ($clientDetails->payment_direct_account_number)
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">ACCOUNT NUMBER</label>
                        <p>{{ $clientDetails->payment_direct_account_number }}</p>
                    </div>
                @endif
                @if ($clientDetails->payment_direct_routing_number)
                    <div class="col-md-3 pl-5 pt-2">
                        <label class="fw-bolder black">ROUTING NUMBER</label>
                        <p>{{ $clientDetails->payment_direct_routing_number }}</p>
                    </div>
                @endif
                @if ($clientDetails->payment_direct_account_type)
                    <div class="col-md-3  pl-5 pt-2">
                        <label class="fw-bolder black">ACCOUNT TYPE</label>
                        <p>{{ $clientDetails->payment_direct_account_type }}</p>
                    </div>
                @endif

            </div>
            {{-- @endif --}}

            <div class="row my-2">
                <p><b>Note: </b> {{ $clientDetails->note }}</p>
            </div>

            <div class="row no-gutters justify-content-center  py-5 px-4" style="background-color:#fff;">

                @if ($clientDetails->signature)
                    <div class="col-md-12  justify-content-center">
                        <P><img src="{{ asset('signature/' . $clientDetails->signature) }}" width="200px"></p>
                        <h5 class=""
                            style="border-top: 1px solid #dee2e6!important;
                            position: relative;
                            top: -49px;">
                            SIGNATURE</h5>

                    </div>
                @endif

                <p class="text-end fw-bold">
                    <label
                        class="fw-bolder black">Date:</label> {{ date('m-d-Y', strtotime($clientDetails->created_at)) }}
                    <br>
                    <label class="fw-bolder black">Created by:</label> {{ $clientDetails->user_create }}
                </p>
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


    @include('backend.client.modal.edit_product_unit')

    @include('backend.client.modal.condition_report_modal')

@endsection

@section('jsOutside')
    <script>
        $(document).on('click', '#tableimg', function (event) {
            var source = $(this).attr('imgname');
            $('.tableimg').attr('src', source);
            $('#demoModal').modal("show");
        });
        $(document).on('click', '#idimg', function (event) {
            $('#demoModal1').modal("show");
        });
        $(document).on('click', '#closemodal', function (event) {
            $('#demoModal1').modal("hide");
            $('#demoModal').modal("hide");
        });

    </script>
    <script>


    </script>

    <script>
        //    var url = "{{ url('pos/tagged') }}";
        //    function handleTagged(id) {
        //       $.get(url + '/' + id, function () {
        //          // alert('Tagged successfully');
        //       });
        //    }

        function taggedProductItem(id) {
            var url = "{{ url('pos/product-item-tagged') }}";
            $.get(url + '/' + id, function () {
                // alert('Tagged successfully');
            });
        }

        $(document).on('click', '#condition-form-save', function (event) {
            var identifier = $('.nav-link.active').data('identifier');

            var url = "{{ url('pos/save-condition-reoprt') }}";
            var serializeData = $('#' + identifier + '-form').serialize();

            var _token = "{{ csrf_token() }}";
            serializeData = serializeData + '&_token=' + _token;

            $.post(url, serializeData, function (res) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: $('#' + identifier + '-condition-report-title').text() + ' Saved Successfully',
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            });
        });

        function fetchConditionReport(clientId) {
            var url = "{{ url('pos/fetch-condition-report') }}";

            $.get(url + '/' + clientId, function (res) {
                $('#first-inspection-container').html(res.first_inspection);
                $('#second-inspection-container').html(res.second_inspection);
                $('#third-inspection-container').html(res.third_inspection);

                $('#condition-report-modal').modal('show');
            });
        }

        function showInput(that, ifValue, id) {
            if ($(that).val() == ifValue) {
                $('#' + id).show();
            } else {
                $('#' + id).val('');
                $('#' + id).hide();
            }
        }

        function fetchComparisonReport() {
            var url = "{{ url('pos/fetch-comparison-report') }}";
            var productId = $('.po-product-id').val();
            $.get(url + '/' + productId, function (res) {
                console.log(res);

                $('.condition-report').hide();
                $('#condition-form-save').hide();
                $('#condition-report-title').text('Condition - Comparison Report');

                $('#comparison-report-btn').hide();
                $('#condition-report-btn').show();

                $('#comparison-report').html(res.comparison_report);
                $('#comparison-report').show();
            });
        }

        function showConditionReport() {
            $('.condition-report').show();
            $('#condition-form-save').show();
            $('#condition-report-title').text('Condition Report');

            $('#comparison-report-btn').show();
            $('#condition-report-btn').hide();

            $('#comparison-report').hide();
        }


    </script>

    {{-- Write script,link external JS files --}}
    {{-- Include Custom js File --}}
    @include('backend.custom_js.init_js')

@endsection
