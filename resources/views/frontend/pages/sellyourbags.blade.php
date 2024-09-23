@extends('frontend.layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12 mt-2" style="text-align: right;">
            <a href="{{ url('pos/index') }}" class="btn btn-success btn-sm bg-add" target="_blink">POs List</a>
        </div>
    </div>
    <div class="row">
        <form method="POST"  action="{{ route('sellyourbags.store') }}" class="dropzone-area" id="clientform"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mt-3 mb-2 px-0">
                    <h2 class="purchase-color fw-bold fs-3">PURCHASE ORDER</h2>
                    <p class="text-dark mt-4"><span class="p-style">
                  Please note that we only accept authentic items and
                  we ask that you be certain of an item's authenticity before sending it to us.
                  If the item is determined to not be authentic by our in-house experts,
                  it will be returned to you at your expense.</span>
                    </p>
                </div>
            </div>
            <div class="row bg-white">
                <div class="col-md-12 simple-heading-bg">
                    <h6 class="my-3 px-2 inside-head">CONTACT INFORMATION</h6>
                </div>
                <!-- <div class="col-md-12 bg-white px-5"> -->

                <div class="row my-4 px-5">
                    <div class="col-md-4">
                        <label class="form-label fw-bold my-0" for="name">FULL NAME<b class="text-danger">*</b></label>
                        <input type="text" class="form-control" placeholder="ENTER YOUR NAME" name="name" id="name">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror


                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold my-0" for="email">EMAIL <b class="text-danger">*</b></label>
                        <input type="email" class="form-control" placeholder="ENTER YOUR EMAIL" id="email" name="email"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <div class="error">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold my-0" for="phone">PHONE </label>
                        <input type="number" class="form-control" placeholder="ENTER YOUR PHONE" name="phone"
                               value="{{ old('phone') }}"/>
                        @error('phone')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row my-5 px-5 flex-d justify-content-between">
                    <div class="col-md-8">
                        <label class="form-label fw-bold my-0" for="address">ADDRESS </label>
                        <input type="text" class="form-control shadow-none" value="{{ old('address') }}"
                               placeholder="ENTER YOUR ADDRESS" name="address">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold my-0" for="phone">ID Card </label>
                        <input type="file" class="form-control filepond" name="id_card_image" id="id_card_image"
                               value="{{ old('id_card_image') }}"/>

                        @error('id_card_image')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- </div> -->
            </div>
            <div class="row" id="product-information-section">
                <div class="col-md-12 simple-heading-bg">
                    <h5 class="my-3 px-2 inside-head">PRODUCT INFORMATION</h5>
                </div>
                <div class="col-md-12 bg-white px-5">
                    {{-- <form> --}}

                    <span id="add-condition-error" class="error" style="font-weight: bold;
    font-size: 16px;"></span>
                    <div class="" id="dataAdd">
                        <div class="row my-3 abc">
                            <div class="col-md-4">
                                <label>

                                    {{-- <img src="{{ asset('app-assets/images/icons/icon.png') }}" class=""
                                    alt="Product Image" role="button" width="60px" /> --}}
                                    <input type="file" name="products[0]['image'][]" id="productImage"
                                           class="form-control filepond"/>
                                    <img id="blah" src="#" alt="your image" class="d-none blah"/>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control border-bottom border-1 input-border shadow-none"
                                       placeholder="Description" name="products[0]['name']" id="productName"/>
                            </div>
                            <div class="col-md-3">

                                <a class="btn btn-success btn-sm bg-add edit_unit_modal" id="add_condition_0" data-product-information-index="0">Add Condition</a>

                               <input type="hidden" name="products[0]['condition']" id="condition_one_0" value="">
                               <input type="hidden" name="products[0]['condition_two']" id="condition_two_0" value="">
                               <input type="hidden" name="products[0]['condition_three']" id="condition_three_0" value="">
                               <input type="hidden" name="products[0]['add_condition_add']" id="add_condition_add_0" value="false">
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control productPrice" placeholder="$ 0.00" value=""
                                       name="products[0]['price']" id="productPrice" required/>
                            </div>
                            {{-- <div class="col-md-1">
                                          <button class="btn btn-danger" id="deleteRow">X</button>
                                      </div> --}}
                        </div>
                    </div>

                    {{-- <div id="newRecord"></div>
                            <div class="row my-5 d-flex justify-content-between">
                                <div class="col-md-4">
                                    <button class="btn btn-success btn-lg bg-add" type="button" id="addRow">+</button>
                                </div>
                                <div class="col-md-4">
                                    <div id="total-container">

                                        <input type="number" class="form-control total" name="grand_total" id="grand_total"
                                            readonly />
                                        <label for="floatingInput" id="total-lable" class="fw-bold text-green fs-6">TOTAL :
                                            $</label>
                                    </div>

                                </div>
                            </div> --}}
                </div>
                <!-- <div class="col-md-12 bg-white px-5">
            {{-- <form> --}}
                <div class="" id="dataAdd">
                   <div class="row my-3 abc">
                      <div class="col-md-4">
                         <label>

{{-- <img src="{{ asset('app-assets/images/icons/icon.png') }}" class=""
                        alt="Product Image" role="button" width="60px" /> --}}
                <input type="file" name="products[1]['image'][]" id="productImage1"
                           class="form-control filepond" />
                        <img id="blah" src="#" alt="your image" class="d-none blah" />
                     </label>
                  </div>
                  <div class="col-md-3">
                     <input type="text" class="form-control border-bottom border-1 input-border shadow-none"
                        placeholder="Description" name="products[1]['name']" id="productName1" />
                  </div>
                  <div class="col-md-3">
                     <select class="form-select shadow-none" aria-label="Default select example"
                        name="products[1]['condition']" id="productCondition1">
                        <option value="">Conditon Rank</option>
                        <option value="A(Mint)">A(Mint)</option>
                        <option value="AB(Excellent)">AB(Excellent)</option>
                        <option value="B(Gently Used)">B(Gently Used)</option>
                        <option value="BC(Used)">BC(Used)</option>
                        <option value="C(Well Used)">C(Well Used)</option>
                        <option value="D(Need Repair)">D(Need Repair)</option>

                     </select>
                  </div>
                  <div class="col-md-2">
                     <input type="number" class="form-control productPrice" placeholder="$ 0.00" value=""
                        name="products[1]['price']" id="productPrice1" />
                  </div>
                  {{-- <div class="col-md-1">
                                <button class="btn btn-danger" id="deleteRow">X</button>
                            </div> --}}
                </div>
             </div>

{{-- <div id="newRecord"></div>
                    <div class="row my-5 d-flex justify-content-between">
                        <div class="col-md-4">
                            <button class="btn btn-success btn-lg bg-add" type="button" id="addRow">+</button>
                        </div>
                        <div class="col-md-4">
                            <div id="total-container">

                                <input type="number" class="form-control total" name="grand_total" id="grand_total"
                                    readonly />
                                <label for="floatingInput" id="total-lable" class="fw-bold text-green fs-6">TOTAL :
                                    $</label>
                            </div>

                        </div>
                    </div> --}}
                </div>
                <div class="col-md-12 bg-white px-5">
{{-- <form> --}}
                {{-- <div class="" id="dataAdd"> --}}
                <div class="row my-3 abc">
                   <div class="col-md-4">
                      <label>

{{-- <img src="{{ asset('app-assets/images/icons/icon.png') }}" class=""
                     alt="Product Image" role="button" width="60px" /> --}}
                <input type="file" name="products[2]['image'][]" id="productImage2" class="form-control filepond" />

                  </label>
               </div>
               <div class="col-md-3">
                  <input type="text" class="form-control border-bottom border-1 input-border shadow-none"
                     placeholder="Description" name="products[2]['name']" id="productName2" />
               </div>
               <div class="col-md-3">
                  <select class="form-select shadow-none" aria-label="Default select example"
                     name="products[2]['condition']" id="productCondition2">
                     <option value="">Conditon Rank</option>
                     <option value="A(Mint)">A(Mint)</option>
                     <option value="AB(Excellent)">AB(Excellent)</option>
                     <option value="B(Gently Used)">B(Gently Used)</option>
                     <option value="BC(Used)">BC(Used)</option>
                     <option value="C(Well Used)">C(Well Used)</option>
                     <option value="D(Need Repair)">D(Need Repair)</option>
                  </select>
               </div>
               <div class="col-md-2">
                  <input type="number" class="form-control productPrice" placeholder="$ 0.00" value=""
                     name="products[2]['price']" id="productPrice2" />
               </div>
               {{-- <div class="col-md-1">
                                <button class="btn btn-danger" id="deleteRow">X</button>
                            </div> --}}
                </div>
{{-- </div> --}}


                </div> -->

                <div id="newRecord" style="padding: 0px !important; background: white;"></div>

                <div class="col-md-12 bg-white px-5">
                    <div class="col-md-4">
                        <button class="btn btn-success btn-lg bg-add" type="button" id="addRow">+</button>
                    </div>
                </div>
            </div>
            {{-- <div id="newRecord"></div> --}}
            <div class="row  bg-white py-1 justify-content-end">
                {{-- <div class="col-md-4">
                           <button class="btn btn-success btn-lg bg-add" type="button" id="addRow">+</button>
                       </div> --}}
                <div class="col-md-4 text-align-right py-4">
                    <div id="new" class="total d-flex justify-content-start">
                        <label for="floatingInput" id="" class="fw-bold text-green fs-6 total-left">TOTAL :
                            $</label>
                        <input type="number" class="form-control total-right noscroll" name="grand_total"
                               id="grand_total"/>

                    </div>

                </div>
            </div>

            <div class="row d-flex">
                <div class="col-md-12 simple-heading-bg">
                    <h5 class="my-3 px-2 inside-head">PAYMENT METHOD</h5>
                </div>
            </div>
            <div class="row d-flex justify-content-start bg-white px-3">
                <div class="col-md-4 py-5">
                    <label class="fw-bold">CHOOSE YOUR PAYOUT:<b class="text-danger">*</b></label>
                    <select class="form-select shadow-none" aria-label="Default select example" name="payment_method"
                            id="payment_method" required>
                        <option value="" selected disabled>Select</option>

                        <option value="paypal" @if (old('payment_method')=='paypal' )
                            {{ 'selected' }}
                            @endif>Paypal
                        </option>
                        <option value="cheque" @if (old('payment_method')=='cheque' )
                            {{ 'selected' }}
                            @endif>Cheque
                        </option>
                        <option value="echeck" @if (old('payment_method')=='echeck' )
                            {{ 'selected' }}
                            @endif>E-check
                        </option>
                        <option value="direct" @if (old('payment_method')=='direct' )
                            {{ 'selected' }}
                            @endif>Direct Deposit
                        </option>
                        <option value="storecredit" @if (old('payment_method')=='storecredit' )
                            {{ 'selected' }}
                            @endif>Store
                            Credit
                        </option>
                    </select>
                    {{-- @if ($errors->has('payment_method'))
                            <span class="error">{{ $errors->first('payment_method') }}</span>
                    @endif --}}
                    @error('payment_method')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="row py-5 bg-white" id="storecredit">
                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <label class="fw-bold">Store Credit<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="storecredit" id="storecredit"
                           value="{{ old('storecredit') }}"/>
                </div>
            </div>

            <div class="row py-5 bg-white" id="paypal">
                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="payment_name_paypal" id="payment_name_paypal"
                           value="{{ old('payment_name_paypal') }}"/>
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
                           value="{{ old('payment_email_paypal') }}"/>
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
                    <input type="text" class="form-control" name="payment_full_name_cheque"
                           id="payment_full_name_cheque"
                           value="{{ old('payment_full_name_cheque') }}"/>
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
                           value="{{ old('payment_email_cheque') }}"/>
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
                    <input type="text" class="form-control" name="payment_full_name_echeck"
                           id="payment_full_name_echeck"
                           value="{{ old('payment_full_name_echeck') }}"/>
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
                           value="{{ old('payment_email_echeck') }}"/>
                    {{-- @if ($errors->has('payment_email_cheque'))
                            <span class="error">{{ $errors->first('payment_email_cheque') }}</span>
                    @endif --}}
                    @error('payment_email_echeck')
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
                                   value="{{ old('payment_full_name') }}"/>
                            @if ($errors->has('payment_full_name'))
                                <span class="error">{{ $errors->first('payment_full_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label class="fw-bold my-2">EMAIL ADDRESS<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="payment_email" id="payment_email"
                                   value="{{ old('payment_email') }}"/>
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
                                   id="payment_direct_bank_name"
                                   value="{{ old('payment_direct_bank_name') }}"/>
                            @if ($errors->has('payment_direct_bank_name'))
                                <span class="error">{{ $errors->first('payment_direct_bank_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label class="fw-bold my-2">ACCOUNT NUMBER</label>
                            <input type="text" class="form-control" name="payment_direct_account_number"
                                   id="payment_direct_account_number"
                                   value="{{ old('payment_direct_account_number') }}"/>
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
                                   id="payment_direct_routing_number"
                                   value="{{ old('payment_direct_routing_number') }}"/>
                            @if ($errors->has('payment_direct_routing_number'))
                                <span class="error">{{ $errors->first('payment_direct_routing_number') }}</span>
                            @endif
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <label class="fw-bold my-2">RE-ENTER ACCOUNT NUMBER</label>
                            <input type="text" onpaste="return false;" ondrop="return false;" autocomplete="off"
                                   class="form-control" name="payment_direct_re_enter_account_number"
                                   id="payment_direct_re_enter_account_number"
                                   value="{{ old('payment_direct_re_enter_account_number') }}"/>

                            <span id="re-enter-account-number-error" class="error"></span>
                            {{--               @if ($errors->has('payment_direct_re_enter_account_number'))
                                           <span class="error">{{ $errors->first('payment_direct_re_enter_account_number') }}</span>
                                           @endif--}}

                            {{--               <label class="fw-bold my-2">ACCOUNT TYPE</label>
                                    <select class="form-select" name="payment_direct_account_type" id="payment_direct_account_type">
                                              <option></option>
                                              <option value="Checking">Checking</option>
                                              <option value="Savings">Savings</option>
                                           </select>--}}

                            {{--	       <input type="text" class="form-control" name="payment_direct_account_type"
                                              id="payment_direct_account_type" value="{{ old('payment_direct_account_type') }}" />
                                           @if ($errors->has('payment_direct_account_type'))
                                           <span class="error">{{ $errors->first('payment_direct_account_type') }}</span>
                                           @endif--}}
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pt-3">
                    <div class="row pt-3">
                        <div class="col-md-1"></div>

                        <div class="col-md-4">
                            <label class="fw-bold my-2">ACCOUNT TYPE</label>
                            <select class="form-select" name="payment_direct_account_type"
                                    id="payment_direct_account_type">
                                <option></option>
                                <option value="Checking">Checking</option>
                                <option value="Savings">Savings</option>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">

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

            <div class="row py-5 d-flex flex-column bg-white px-3">
                <div class="row">
                    <div class="col-md-4">
                        <input class="form-check-input" type="checkbox" @if (old('disclaimer')) checked
                               @endif id="disclaimer"
                               name="disclaimer" required/>
                        <label class="fw-bold" for="flexCheckDefault">
                            DISCLAIMER
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><span class="p-style">
               The Seller named above undersigns and acknowledges that the items sold and listed here are
               authentic
               and have been acquired lawfully.
               Seller agrees to pay the damages if the items sold to Dallas Designer Handbags are not
               authentic
               or
               acquired with any unlawful means.
               Seller also agrees to pay authentication charges, $300 for Hermes and Chanel and $150 for all other brands
               if
               the item is NOT authentic.
               Seller is responsible to pick up their items within 30 days or else we dispose of
               them.
               Seller acknowledges that the quoted price is not a guaranteed payout amount and understands that it may change after a secondary review if additional wear is found on the item.
               </span>
                        </p>

                        @error('disclaimer')
                        <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row justify-content-center pb-5 bg-white px-3">
                <div class="col-md-4">
                    <label class="fw-bold" style="margin-top: 15px; margin-bottom: 6px;">Note</label>
                    <textarea class="form-control" rows="8" id="note" name="note">{{ old('note') }}</textarea>
                    @if ($errors->has('note'))
                        <span class="error">{{ $errors->first('note') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label class="fw-bold d-block">SIGNATURE:</label><span class="text-danger fw-lighter"
                                                                           style="font-size:11px;">You
         must provide your
         signature.</span>

                    <br/>
                    <div id="sig"></div>
                    <br/>
                    <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                    <textarea id="signature64" name="signature64" value="{{ old('signature64') }}" data-validate="true"
                              style="display: none" required></textarea>

                    @error('signature64')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-end pb-5 bg-white px-3">
                <div class="col-md-3 d-grid">
                    <button class="btn btn-success btn-lg  submit bg-add" type="submit"><span
                            class="btn-txt">SUBMIT</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>

            </div>
        </form>
    </div>
    @include('frontend.pages.modal.add_conditions')
@stop
