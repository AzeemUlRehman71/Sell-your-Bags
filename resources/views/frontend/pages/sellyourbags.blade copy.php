@extends('frontend.layouts.default')
@section('content')

    <form method="POST" action="{{ route('sellyourbags.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 my-5 px-0">
                <h2 class="purchase-color fw-bold fs-2">PURCHASE ORDER</h2>
                <p>
                    is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the
                    1500s, when an unknown printer took a galley of type and scrambled
                    it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining
                    essentially unchanged.
                </p>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-md-12 simple-heading-bg">
                <h5 class="text-white my-2">CONTACT INFORMATION</h5>
            </div>
            <!-- <div class="col-md-12 bg-white px-5"> -->

            <div class="row my-5">
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="name">FULL NAME:<b class="text-danger">*</b></label>
                    <input type="text" class="form-control shadow-none" id="name" placeholder="Enter Your Name"
                        name="name" value="{{ old('name') }}" required />
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    {{-- @if ($errors->has('name'))
                        <span class="error">{{ $errors->first('name') }}</span>
                    @endif --}}

                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="email">EMAIL: <b class="text-danger">*</b></label>
                    <input type="text" class="form-control shadow-none" placeholder="Enter Your Email" id="email"
                        name="email" value="{{ old('email') }}" required>
                    {{-- @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif --}}
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="phone">PHONE: </label>
                    <input type="number" class="form-control shadow-none" placeholder="Enter Your Phone" name="phone"
                        value="{{ old('phone') }}" required />
                    {{-- @if ($errors->has('phone'))
                        <span class="error">{{ $errors->first('phone') }}</span>
                    @endif --}}
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-5 flex-d justify-content-between">
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="address">ADDRESS: </label>
                    <input type="text" class="form-control shadow-none" value="{{ old('address') }}"
                        placeholder="Enter Your Address" name="address">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="phone">ID Card: </label>
                    <input type="file" class="form-control" name="id_card_image" id="id_card_image"
                        value="{{ old('id_card_image') }}" />
                    {{-- @if ($errors->has('id_card_image'))
                        <span class="error">{{ $errors->first('id_card_image') }}</span>
                    @endif --}}
                    @error('id_card_image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <img src="#" id="category-img-tag" width="200px" />
                </div>
            </div>

            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-md-12 simple-heading-bg">
                <h5 class="text-white my-2">PRODUCT INFORMATION</h5>
            </div>
            <div class="col-md-12 bg-white px-5">
                {{-- <form> --}}
                <div class="" id="dataAdd">
                    <div class="row my-5 abc">
                        <div class="col-md-2">
                            <label>
                                {{-- <img src="images/logo1.jpg" width="60px" role="button" /> --}}
                                <input type="file" name="productImage[]" id="productImage" class="form-control" />
                            </label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control border-bottom border-1 input-border shadow-none"
                                placeholder="ADD ITEM" name="productName[]" id="productName" />
                        </div>
                        <div class="col-md-2">
                            <select class="form-select shadow-none" aria-label="Default select example"
                                name="productCondition[]" id="productCondition">
                                <option selected>Select Condition</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control productPrice" placeholder="$ 0.00"
                                name="productPrice[]" id="productPrice" required />
                            @error('productPrice')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger" id="deleteRow">X</button>
                        </div>
                    </div>
                </div>

                <div id="newRecord"></div>
                <div class="row my-5 d-flex justify-content-between">
                    <div class="col-md-4">
                        <button class="btn btn-success btn-lg" type="button" id="addRow">+</button>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control total" name="grand_total" id="grand_total" readonly
                            placeholder="Grand Total" />
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-12 simple-heading-bg">
                <h5 class="text-white my-2">PAYMENT METHOD</h5>
            </div>
        </div>
        <div class="row d-flex justify-content-start bg-white px-3">
            <div class="col-md-4 py-5">
                <label class="fw-bold">CHOOSE YOUR PAYOUT:</label>
                <select class="form-select shadow-none" aria-label="Default select example" name="payment_method"
                    id="payment_method" required>
                    <option option value="" selected disabled>Select</option>
                    <option value="direct" @if (old('payment_method') == 'direct') {{ 'selected' }} @endif>Direct Deposit
                    </option>
                    <option value="paypal" @if (old('payment_method') == 'paypal') {{ 'selected' }} @endif>Paypal</option>
                    <option value="cheque" @if (old('payment_method') == 'cheque') {{ 'selected' }} @endif>Cheque</option>
                </select>
                {{-- @if ($errors->has('payment_method'))
                    <span class="error">{{ $errors->first('payment_method') }}</span>
                @endif --}}
                @error('payment_method')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row py-5 bg-white" id="direct">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                    value="{{ old('payment_full_name') }}" />
                {{-- @if ($errors->has('payment_full_name'))
                    <span class="error">{{ $errors->first('payment_full_name') }}</span>
                @endif --}}
                @error('payment_full_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <label class="fw-bold">EMAIL ADDRESS<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_email" id="payment_email"
                    value="{{ old('payment_email') }}" />
                {{-- @if ($errors->has('payment_email'))
                    <span class="error">{{ $errors->first('payment_email') }}</span>
                @endif --}}
                @error('payment_email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row py-5 bg-white" id="paypal">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <label class="fw-bold">FULL NAME paypal<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_name_paypal" id="payment_name_paypal"
                    value="{{ old('payment_name_paypal') }}" />
                {{-- @if ($errors->has('payment_name_paypal'))
                    <span class="error">{{ $errors->first('payment_name_paypal') }}</span>
                @endif --}}
                @error('payment_name_paypal')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <label class="fw-bold">EMAIL ADDRESS<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_email_paypal" id="payment_email_paypal"
                    value="{{ old('payment_email_paypal') }}" />
                {{-- @if ($errors->has('payment_email_paypal'))
                    <span class="error">{{ $errors->first('payment_email_paypal') }}</span>
                @endif --}}
                @error('payment_email_paypal')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row py-5 bg-white" id="cheque">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <label class="fw-bold">FULL NAME Cheque<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_full_name_cheque" id="payment_full_name_cheque"
                    value="{{ old('payment_full_name_cheque') }}" />
                {{-- @if ($errors->has('payment_full_name_cheque'))
                    <span class="error">{{ $errors->first('payment_full_name_cheque') }}</span>
                @endif --}}
                @error('payment_full_name_cheque')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <label class="fw-bold">EMAIL ADDRESS<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_email_cheque" id="payment_email_cheque"
                    value="{{ old('payment_email_cheque') }}" />
                {{-- @if ($errors->has('payment_email_cheque'))
                    <span class="error">{{ $errors->first('payment_email_cheque') }}</span>
                @endif --}}
                @error('payment_email_cheque')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row py-5 d-flex flex-column bg-white px-3">
            <div class="col-md-4">
                <input class="form-check-input" type="checkbox" {{ !old('disclaimer') ?: 'checked' }} id="disclaimer"
                    name="disclaimer" />
                <label class="form-check-label" for="disclaimer">
                    DISCLAIMER
                </label>
            </div>

            <div class="col-md-8">
                <p>
                    simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the
                    1500s, when an unknown printer took a galley of type and scrambled
                    it to make a type specimen book. It has survived not only five
                    centuries, but also the leap into electronic typesetting, remaining
                </p>

                @error('disclaimer')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row justify-content-end pb-5 bg-white px-3">
            <div class="col-md-4">
                <label class="fw-bold">SIGNATURE<span class="text-danger">*</span></label>
                {{-- <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea> --}}
                <br />
                <div id="sig"></div>
                <br />
                <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                <textarea id="signature64" name="signature64" value="{{ old('signature64') }}" style="display: none"></textarea>
                {{-- @if ($errors->has('signature64'))
                    <span class="error">{{ $errors->first('signature64') }}</span>
                @endif --}}
                @error('signature64')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-between pb-5 bg-white px-3">
            <div class="col-md-4">
                <p class="fw-bold mb-1">FOR QURIES CONTACT US:</p>
                <p class="contact-color mb-1">
                    <i class="bi bi-telephone-forward" style="font-size: 1rem; color: #206c5f"></i>
                    +9552525-525
                </p>
                <p class="mb-1">
                    <i class="bi bi-envelope-fill" style="font-size: 1rem; color: #206c5f"></i>
                    mail@mail.com
                </p>
            </div>
            <div class="col-md-4 d-grid">
                <button class="btn btn-success btn-lg" type="submit">SUBMIT</button>
            </div>

        </div>
    </form>
@stop
