@extends('frontend.layouts.default')
@section('content')

    <form method="POST" action="{{ route('sellyourbags.store') }}" id="clientform" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 my-5 px-0">
                <h2 class="purchase-color fw-bold fs-2">PURCHASE ORDER</h2>
                <p>
                    Please note that we only accept authentic items and
                    we ask that you be certain of an item's authenticity before sending it to us.
                    If the item is determined to not be authentic by our in-house experts,
                    it will be returned to you at your expense.
                </p>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-md-12 simple-heading-bg">
                <h5 class="text-white my-2">CONTACT INFORMATION</h5>
            </div>
            <!-- <div class="col-md-12 bg-white px-5"> -->

            <div class="row my-4">
                <div class="col-md-3">
                    <label class="form-label fw-bold" for="name">FULL NAME<b class="text-danger">*</b></label>
                    <input type="text" class="form-control" placeholder="Enter Your Name" name="name" id="name"
                        required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror


                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold" for="email">EMAIL: <b class="text-danger">*</b></label>
                    <input type="email" class="form-control" placeholder="Enter Your Email" id="email" name="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold" for="phone">PHONE: </label>
                    <input type="number" class="form-control" placeholder="Enter Your Phone" name="phone"
                        value="{{ old('phone') }}" />
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-5 flex-d justify-content-between">
                <div class="col-md-8">
                    <label class="form-label fw-bold" for="address">ADDRESS: </label>
                    <input type="text" class="form-control shadow-none"
                     value="{{ old('address') }}" 
                     placeholder="Enter Your Address"
                     name="address"
                        >
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold" for="phone">ID Card: </label>
                    <input type="file" class="form-control" name="id_card_image" id="id_card_image"
                        value="{{ old('id_card_image') }}" />

                    @error('id_card_image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    {{-- <img src="#" id="category-img-tag" width="200px" /> --}}
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
                        <div class="col-md-3">
                            <label>

                                {{-- <img src="{{ asset('app-assets/images/icons/icon.png') }}" class=""
                                    alt="Product Image" style="" role="button" width="60px" /> --}}
                                <input type="file" name="products[0]['image']" id="productImage" class="form-control" />
                            </label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control border-bottom border-1 input-border shadow-none"
                                placeholder="ADD ITEM" name="products[0]['name']" id="productName" />
                        </div>
                        <div class="col-md-3">
                            <select class="form-select shadow-none" aria-label="Default select example"
                                name="products[0]['condition']" id="productCondition">
                                <option value="">Conditon Rank</option>
                                <option value="A(Mint)">A(Mint)</option>
                                <option value="AB(Ecellent)">AB(Ecellent)</option>
                                <option value="B(Gently Used)">B(Gently Used)</option>
                                <option value="BC(Used)">BC(Used)</option>
                                <option value="C(Well Used)">C(Well Used)</option>
                                <option value="D(Need Prayers)">D(Need Prayers)</option>

                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control productPrice" placeholder="$ 0.00" value=""
                                name="products[0]['price']" id="productPrice" required />
                        </div>
                        <div class="col-md-1">
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
                        <label for="floatingInput" class="fw-bold text-green fs-6">TOTAL</label>
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
                <label class="fw-bold">CHOOSE YOUR PAYOUT:<b class="text-danger">*</b></label>
                <select class="form-select shadow-none" aria-label="Default select example" name="payment_method"
                    id="payment_method" required>
                    <option option value="" selected disabled>Select</option>
                    <option value="direct" @if (old('payment_method') == 'direct') {{ 'selected' }} @endif>Direct Deposit
                    </option>
                    <option value="paypal" @if (old('payment_method') == 'paypal') {{ 'selected' }} @endif>Paypal</option>
                    <option value="cheque" @if (old('payment_method') == 'cheque') {{ 'selected' }} @endif>Cheque</option>
                    <option value="echeck" @if (old('payment_method') == 'echeck') {{ 'selected' }} @endif>E-check</option>
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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-4">
                        <label class="fw-bold my-2">FULL NAME<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
                            value="{{ old('payment_full_name') }}" />
                        @if ($errors->has('payment_full_name'))
                            <span class="error">{{ $errors->first('payment_full_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <label class="fw-bold my-2">EMAIL ADDRESS<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="payment_email" id="payment_email"
                            value="{{ old('payment_email') }}" />
                        @if ($errors->has('payment_email'))
                            <span class="error">{{ $errors->first('payment_email') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 pt-3">
                <div class="row pt-3">
                    <div class="col-md-1"></div>

                    {{-- <div class="col-md-4">
                        <label class="fw-bold my-2">PHONE NUMBER</label>
                        <input type="text" class="form-control" name="payment_direct_phone_number"
                            id="payment_direct_phone_number" value="{{ old('payment_direct_phone_number') }}" />
                        @if ($errors->has('payment_direct_phone_number'))
                            <span class="error">{{ $errors->first('payment_direct_phone_number') }}</span>
                        @endif
                    </div> --}}
                    <div class="col-md-4">
                        <label class="fw-bold my-2">BANK NAME</label>
                        <input type="text" class="form-control" name="payment_direct_bank_name"
                            id="payment_direct_bank_name" value="{{ old('payment_direct_bank_name') }}" />
                        @if ($errors->has('payment_direct_bank_name'))
                            <span class="error">{{ $errors->first('payment_direct_bank_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <label class="fw-bold my-2">ACCOUNT NUMBER</label>
                        <input type="text" class="form-control" name="payment_direct_account_number"
                            id="payment_direct_account_number" value="{{ old('payment_direct_account_number') }}" />
                        @if ($errors->has('payment_direct_account_number'))
                            <span class="error">{{ $errors->first('payment_direct_account_number') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 pt-3">
                <div class="row pt-3">
                    <div class="col-md-1"></div>

                    <div class="col-md-4">
                        <label class="fw-bold my-2">ROUTING NUMBER</label>
                        <input type="text" class="form-control" name="payment_direct_routing_number"
                            id="payment_direct_routing_number" value="{{ old('payment_direct_routing_number') }}" />
                        @if ($errors->has('payment_direct_routing_number'))
                            <span class="error">{{ $errors->first('payment_direct_routing_number') }}</span>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <label class="fw-bold my-2">ACCOUNT TYPE</label>
                        <input type="text" class="form-control" name="payment_direct_account_type"
                            id="payment_direct_account_type" value="{{ old('payment_direct_account_type') }}" />
                        @if ($errors->has('payment_direct_account_type'))
                            <span class="error">{{ $errors->first('payment_direct_account_type') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-12 pt-3">
                <div class="row pt-3">
                    <div class="col-md-1"></div>

                    <div class="col-md-4">
                        <label class="fw-bold my-2">BANK NAME</label>
                        <input type="text" class="form-control" name="payment_direct_bank_name"
                            id="payment_direct_bank_name" value="{{ old('payment_direct_bank_name') }}" />
                        @if ($errors->has('payment_direct_bank_name'))
                            <span class="error">{{ $errors->first('payment_direct_bank_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row py-5 bg-white" id="paypal">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
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
                <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
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

        <div class="row py-5 bg-white" id="echeck">
            <div class="col-md-1"></div>

            <div class="col-md-4">
                <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_full_name_echeck" id="payment_full_name_echeck"
                    value="{{ old('payment_full_name_echeck') }}" />
                {{-- @if ($errors->has('payment_full_name_cheque'))
                    <span class="error">{{ $errors->first('payment_full_name_cheque') }}</span>
                @endif --}}
                @error('payment_full_name_echeck')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <label class="fw-bold">EMAIL ADDRESS<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="payment_email_echeck" id="payment_email_echeck"
                    value="{{ old('payment_email_echeck') }}" />
                {{-- @if ($errors->has('payment_email_cheque'))
                    <span class="error">{{ $errors->first('payment_email_cheque') }}</span>
                @endif --}}
                @error('payment_email_echeck')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row py-5 d-flex flex-column bg-white px-3">
            <div class="row">
                <div class="col-md-4">
                    <input class="form-check-input" type="checkbox" @if (old('disclaimer')) checked @endif
                        id="disclaimer" name="disclaimer" required />
                    <label class="fw-bold" for="flexCheckDefault">
                        DISCLAIMER
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        The Seller named above undersigns and acknowledges that the items sold and listed here are authentic
                        and have been acquired lawfully.
                        Seller agrees to pay the damages if the items sold to Dallas Designer Handbags are not authentic or
                        acquired with any unlawful means.
                        Seller also agrees to pay authentication charges, $150 for Hermes and $100 for all other brands if
                        the item is NOT authentic.
                        Seller is responsible to pick up their items within 30 days or else we dispose of them
                    </p>

                    @error('disclaimer')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div class="row justify-content-end pb-5 bg-white px-3">
            <div class="col-md-4">
                <label class="fw-bold">SIGNATURE:</label><span class="text-danger fw-lighter" style="font-size:11px;">You
                    must provide your
                    signature.</span>

                <br />
                <div id="sig"></div>
                <br />
                <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                <textarea id="signature64" name="signature64" value="{{ old('signature64') }}" data-validate="true"
                    style="display: none" required></textarea>

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
                <button class="btn btn-success btn-lg submit" type="submit"><span class="btn-txt">SUBMIT</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>

        </div>
    </form>
@stop
