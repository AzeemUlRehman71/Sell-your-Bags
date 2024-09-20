<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label" for="name">Name <b class="text-danger">*</b></label>
            <input type="text" class="form-control" name="name" id="name"
                value="{{ old('name', $clientDetails->name) }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="email">Email <b class="text-danger">*</b></label>
            <input type="text" class="form-control" name="email" id="email"
                value="{{ old('email', $clientDetails->email) }}">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <label class="form-label" for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone"
                value="{{ old('phone', $clientDetails->phone) }}">
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Address </label>
            <input type="text" class="form-control" name="address" id="address" {{--  value="@isset($item->name) {{ $item->name }} @endisset{{ old('name')}}" --}}
                value="{{ old('address', $clientDetails->address) }}">
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <label class="form-label" for="phone">ID Card</label>
            <img src="{{ asset('/idcard/' . $clientDetails->id_card_image) }}" />
            <input type="file" class="form-control" name="id_card_image" id="id_card_image"
                value=" {{ old('id_card_image', $clientDetails->id_card_image) }}">
            @error('id_card_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>

    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <label class="form-label" for="payment_method">Payment Method</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="direct"
                    @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'direct') selected  @endif @endisset
                    selected>Direct</option>

                <option value="paypal"
                    @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'paypal') selected  @endif @endisset>
                    Paypal</option>
                <option value="cheque"
                    @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'cheque') selected  @endif @endisset>
                    Cheque</option>
                    <option value="cheque"
                    @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'echeck') selected  @endif @endisset>
                    E-Check</option>
            </select>

        </div>

    </div>

    {{-- @if ($clientDetails->payment_method && $clientDetails->payment_method == 'cheque')
        <div class="row mt-1" id="cheque_default">
            <div class="col-md-6">
                <label class="form-label" for="payment_full_name">Full Name</label>
                <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                    value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}">
                @error('payment_full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Email </label>
                <input type="text" class="form-control" name="payment_email" id="payment_email"
                    value="{{ old('payment_email', $clientDetails->payment_email) }}">
                @error('payment_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    @elseif($clientDetails->payment_method && $clientDetails->payment_method == 'paypal')
        <div class="row mt-1" id="paypal_default">
            <div class="col-md-6">
                <label class="form-label" for="payment_full_name">Name</label>
                <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                    value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}">
                @error('payment_full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="payment_email">Email </label>
                <input type="text" class="form-control" name="payment_email" id="payment_email"
                    value="{{ old('payment_email', $clientDetails->payment_email) }}">
                @error('payment_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    @else
        <div class="row mt-1" id="direct_default">
            <div class="col-md-6">
                <label class="form-label" for="payment_full_name">First Name</label>
                <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                    value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}">

                @error('payment_full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Email </label>
                <input type="text" class="form-control" name="payment_email" id="payment_email"
                    value="{{ old('payment_email', $clientDetails->payment_email) }}">
                @error('payment_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="payment_direct_phone_number">Phone Number</label>
                <input type="text" class="form-control" name="payment_direct_phone_number"
                    id="payment_direct_phone_number"
                    value="{{ old('payment_direct_phone_number', $clientDetails->payment_direct_phone_number) }}">
                @error('payment_direct_phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Account Number </label>
                <input type="text" class="form-control" name="payment_direct_account_number"
                    id="payment_direct_account_number"
                    value="{{ old('payment_direct_account_number', $clientDetails->payment_direct_account_number) }}">
                @error('payment_direct_account_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="payment_direct_phone_number">Routing Number</label>
                <input type="text" class="form-control" name="payment_direct_routing_number"
                    id="payment_direct_routing_number"
                    value="{{ old('payment_direct_routing_number', $clientDetails->payment_direct_routing_number) }}">
                @error('payment_direct_routing_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Account Type </label>
                <input type="text" class="form-control" name="payment_direct_account_type"
                    id="payment_direct_account_type"
                    value="{{ old('payment_direct_account_type', $clientDetails->payment_direct_account_type) }}">
                @error('payment_direct_account_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label class="form-label" for="address">Bank Name </label>
                <input type="text" class="form-control" name="payment_direct_bank_name"
                    id="payment_direct_bank_name"
                    value="{{ old('payment_direct_bank_name', $clientDetails->payment_direct_bank_name) }}">
                @error('payment_direct_bank_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    @endif --}}

    @if ($clientDetails->payment_method)
        <div class="row mt-1" id="direct_default">
            <div class="col-md-6">
                <label class="form-label" for="payment_full_name">First Name</label>
                <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                    value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}">

                @error('payment_full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Email </label>
                <input type="text" class="form-control" name="payment_email" id="payment_email"
                    value="{{ old('payment_email', $clientDetails->payment_email) }}">
                @error('payment_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="payment_direct_phone_number">Phone Number</label>
                <input type="text" class="form-control" name="payment_direct_phone_number"
                    id="payment_direct_phone_number"
                    value="{{ old('payment_direct_phone_number', $clientDetails->payment_direct_phone_number) }}">
                @error('payment_direct_phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Account Number </label>
                <input type="text" class="form-control" name="payment_direct_account_number"
                    id="payment_direct_account_number"
                    value="{{ old('payment_direct_account_number', $clientDetails->payment_direct_account_number) }}">
                @error('payment_direct_account_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="payment_direct_phone_number">Routing Number</label>
                <input type="text" class="form-control" name="payment_direct_routing_number"
                    id="payment_direct_routing_number"
                    value="{{ old('payment_direct_routing_number', $clientDetails->payment_direct_routing_number) }}">
                @error('payment_direct_routing_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>
            <div class="col-md-6">
                <label class="form-label" for="address">Account Type </label>
                <input type="text" class="form-control" name="payment_direct_account_type"
                    id="payment_direct_account_type"
                    value="{{ old('payment_direct_account_type', $clientDetails->payment_direct_account_type) }}">
                @error('payment_direct_account_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-6">
                <label class="form-label" for="address">Bank Name </label>
                <input type="text" class="form-control" name="payment_direct_bank_name"
                    id="payment_direct_bank_name"
                    value="{{ old('payment_direct_bank_name', $clientDetails->payment_direct_bank_name) }}">
                @error('payment_direct_bank_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
    @endif




    {{-- <div class="row mt-1" id="cheque">
        <div class="col-md-6">
            <label class="form-label" for="payment_full_name_cheque">Full Name</label>
            <input type="text" class="form-control" name="payment_full_name_cheque" id="payment_full_name_cheque"
                value="{{ old('payment_full_name_cheque') }}">
            @error('payment_full_name_cheque')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Email </label>
            <input type="text" class="form-control" name="payment_email_cheque" id="payment_email_cheque"
                value="{{ old('payment_email_cheque') }}">
            @error('payment_email_cheque')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="row mt-1" id="paypal">
        <div class="col-md-6">
            <label class="form-label" for="payment_name_paypal">Name</label>
            <input type="text" class="form-control" name="payment_name_paypal" id="payment_name_paypal"
                value="{{ old('payment_name_paypal') }}">
            @error('payment_name_paypal')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Email </label>
            <input type="text" class="form-control" name="payment_email_paypal" id="payment_email_paypal"
                value="{{ old('payment_email_paypal') }}">
            @error('payment_email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="row mt-1" id="direct">
        <div class="col-md-6">
            <label class="form-label" for="payment_full_name">First Name</label>
            <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                value="{{ old('payment_full_name') }}">
            @error('payment_full_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Email </label>
            <input type="text" class="form-control" name="payment_email" id="payment_email"
                value="{{ old('payment_email') }}">
            @error('payment_email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="payment_direct_phone_number">Phone Number</label>
            <input type="text" class="form-control" name="payment_direct_phone_number"
                id="payment_direct_phone_number" value="{{ old('payment_direct_phone_number') }}">
            @error('payment_direct_phone_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Account Number </label>
            <input type="text" class="form-control" name="payment_direct_account_number"
                id="payment_direct_account_number" value="{{ old('payment_direct_account_number') }}">
            @error('payment_direct_account_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label" for="payment_direct_phone_number">Routing Number</label>
            <input type="text" class="form-control" name="payment_direct_routing_number"
                id="payment_direct_routing_number" value="{{ old('payment_direct_routing_number') }}">
            @error('payment_direct_routing_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Account Type </label>
            <input type="text" class="form-control" name="payment_direct_account_type"
                id="payment_direct_account_type" value="{{ old('payment_direct_account_type') }}">
            @error('payment_direct_account_type')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-md-6">
            <label class="form-label" for="address">Bank Name </label>
            <input type="text" class="form-control" name="payment_direct_bank_name" id="payment_direct_bank_name"
                value="{{ old('payment_direct_bank_name') }}">
            @error('payment_direct_bank_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    </div> --}}



    {{-- commented this section because of this forms were getting nested 
    i-e form inside a form is getting created Gul --}}

    {{-- <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Products
                        </h4>
                        <button type="button" class="btn btn-sm btn-success add_picture" data-bs-toggle="modal"
                            data-bs-target="#add_picture" data-pic_product_id=""><i class="fa fa-plus"></i> Add
                        </button>

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
                                                    <img src="{{ asset('/products/' . $item->image_path) }}"
                                                        width="150px" height="150px" />
                                                @else
                                                    <span class="fw-bold"> No Image found</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->condition }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-edit edit_product_details"
                                                    data-bs-toggle="modal" data-bs-target="#edit_product_details"
                                                    data-change_product_id="{{ $item->id }}"
                                                    data-change_product_condition="{{ $item->condition }}"
                                                    data-change_product_name="{{ $item->name }}"
                                                    data-change_product_price="{{ $item->price }}"
                                                    data-total_amount="{{ $clientDetails->total_amount }}"
                                                    data-relevant_client_id={{ $clientDetails->id }}>
                                                    <i class="fa fa-edit"></i> Edit </a>

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
    </section> --}}

    {{-- @include('backend.client.modal.edit_product_details') --}}
</div>
