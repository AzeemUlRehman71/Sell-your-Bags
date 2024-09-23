{{-- @extends('frontend.layouts.default')
@section('content') --}}

<style>
.fw-bold {
   font-weight: 700 !important;
   color: black;
}
</style>
<div class="row bg-white">

   <!-- <div class="col-md-12 bg-white px-5"> -->

   <div class="row my-2">
      <div class="col-md-3">
         <label class="form-label fw-bolder black" for="name">FULL NAME<b class="text-danger">*</b></label>
         <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $clientDetails->name) }}"
            required>
         @error('name')
         <div class="error">{{ $message }}</div>
         @enderror


      </div>
      <div class="col-md-6">
         <label class="form-label fw-bolder black" for="email">EMAIL: <b class="text-danger">*</b></label>
         <input type="email" class="form-control" id="email" name="email"
            value="{{ old('email', $clientDetails->email) }}" required>
         @error('email')
         <div class="error">{{ $message }}</div>
         @enderror

      </div>
      <div class="col-md-3">
         <label class="form-label fw-bolder black" for="phone">PHONE: </label>
         <input type="number" class="form-control" name="phone" value="{{ old('phone', $clientDetails->phone) }}" />
         @error('phone')
         <div class="error">{{ $message }}</div>
         @enderror
      </div>
   </div>
   <div class="row my-2 flex-d justify-content-between">
      <div class="col-md-6">
         <label class="form-label fw-bolder black" for="address">ADDRESS: </label>
         <input type="text" class="form-control shadow-none" value="{{ old('address', $clientDetails->address) }}"
            name="address">
      </div>
      <div class="col-md-6">
         <label class="form-label fw-bolder black" for="id_card_image">ID Card: </label>
         <img src="{{ asset('idcard/' . $clientDetails->id_card_image) }}" class="pb-2 img-fluid" />
         <input type="file" class="form-control black" name="id_card_image" id="id_card_image"
            value=" {{ old('id_card_image', $clientDetails->id_card_image) }}" />

         @error('id_card_image')
         <div class="error">{{ $message }}</div>
         @enderror
         {{-- <img src="#" id="category-img-tag" width="200px" /> --}}
      </div>
   </div>

   <div class="row my-2 flex-d justify-content-between">
      <div class="col-md-6">
         <label class="form-label fw-bolder black" for="tracking">TRACKING: </label>
         <input type="text" class="form-control shadow-none" value="{{ old('tracking', $clientDetails->tracking) }}"
            name="tracking">
      </div>
   </div>

   <!-- </div> -->
</div>
{{-- <section id="basic-datatable"> --}}

{{-- </section> --}}

{{-- Gul here
Here I am using modal popup to edit the product.
In this way we can nest forms inside a form
so the only way to nest form insdie a form is Modal Popup --}}
{{-- <div class="row no-gutters pt-1">



    <div class="col-md-12 d-flex justify-content-end">
        <a class="btn btn-sm btn-add add_product_details" data-bs-toggle="modal" data-bs-target="#add_product_details"
            data-relevant_client_id_add="{{ $clientDetails->id }}">

<div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
      class="feather feather-plus-square">
      <rect x="3" y="3" width="18" height="18" rx="2" ry="2">
      </rect>
      <line x1="12" y1="8" x2="12" y2="16"></line>
      <line x1="8" y1="12" x2="16" y2="12"></line>
   </svg></div>
</a>
</div>
</div> --}}
<div class="row">
   <div class="col-12 gx-0">
      <div class="card">
         <div class="simple-heading-bg ">
            <h4 class="card-title text-white my-1 mx-2">
               PRODUCT DETAILS
            </h4>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>S#</th>
                     <th>Image</th>
                     <th>Name</th>
                     <th>Condition</th>
                     <th>Price</th>
                     <th>Status</th>

                     <th width="15%">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if ($clientDetails->product->count())
                  @foreach ($clientDetails->product as $item)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>
                        <!-- @if ($item->image_path)
                        <img src="{{ asset('product/' . $item->image_path) }}" class="img-fluid" />
                        @else
                        <span class="fw-bold"> No Image found</span>
                        @endif -->
                        @if (count($item->images()))
                            @foreach ($item->images() as $img)
                                <img src="{{ asset('/product/' . $img) }}" class="img-fluid" style="height: 75px; width:80px; margin: 5px; object-fit: cover;" />
                            @endforeach
                        @else
                        <span class="fw-bold"> No Image found</span>
                        @endif
                     </td>

                     <td>{{ $item->name }}</td>
                     <td> <ul>
                             <li><b>Overall Condition :</b> {{ $item->condition }}</li>
                             <li><b>Smell:</b> {{ $item->condition_two }}</li>
                             <li><b>Corners Rubbing:</b> {{ $item->condition_three }}</li>
                         </ul>
                     </td>
                     <td>{{ $item->price }}</td>
                     <td class="text-center" style="width: 23%;">

                          <select class="form-select shadow-none" data-product-id="{{$item->id}}"
                                  aria-label="Default select example"
                                  id="productInformationStatus">
                              <option value="">Select Status</option>
                              <option value="Item Received/Delivered" {{ $item->status === 'Item Received/Delivered' ? 'selected' : '' }}>Item Received/Delivered
                              </option>
                              <option value="Item Under Discussion" {{ $item->status === 'Item Under Discussion' ? 'selected' : '' }}>Item Under Discussion</option>
                              <option value="Authentication in Process" {{ $item->status === 'Authentication in Process' ? 'selected' : '' }}>Authentication in
                                  Process
                              </option>
                              <option value="Authentication Completed" {{ $item->status === 'Authentication Completed' ? 'selected' : '' }}>Authentication Completed
                              </option>
                              <option value="Rejected" {{ $item->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                              <option value="Fake" {{ $item->status === 'Fake' ? 'selected' : '' }}>Fake</option>
                              <option value="Item Returned" {{ $item->status === 'Item Returned' ? 'selected' : '' }}>Item Returned</option>

                          </select>
                          {{--                                                <input type="checkbox"--}}
                          {{--                                                       onclick="taggedProductItem({{ $item->id }})" {{ $item->tagged == 1 ? 'checked' : '' }}>--}}
                      </td>
                     <td class="">
                        <div class="d-flex text-center align-middle">
                           <a class="btn btn-sm btn-edit edit_product_details" data-bs-toggle="modal"
                              data-bs-target="#edit_product_details" data-change_product_id="{{ $item->id }}"
                              data-change_product_condition="{{ $item->condition }}"
                              data-change_product_condition_two="{{ $item->condition_two }}"
                              data-change_product_condition_three="{{ $item->condition_three }}"
                              data-change_product_name="{{ $item->name }}"
                              data-change_product_price="{{ $item->price }}"
                              data-change_product_image="{{ $item->image_path }}"
                              data-total_amount="{{ $clientDetails->total_amount }}"
                              data-relevant_client_id="{{ $clientDetails->id }}">
                              {{-- <i class="fa fa-edit"></i> Edit </a> --}}
                              <div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                    </path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                    </path>
                                 </svg></div>
                           </a>
                           <a class="btn btn-sm btn-delete delete_product" href="#" data-bs-toggle="modal"
                              data-bs-target="#delete_product" data-product_id="{{ $item->id }}"
                              data-relevant_client_id_del="{{ $clientDetails->id }}">
                              <div class="icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                       d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                 </svg></div>
                           </a>
                        </div>


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
<div class="row invoice-sales-total-wrapper">


   {{-- <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
        <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> <span class="ms-75">Alfie Solomons</span></p>
    </div> --}}
   <div class="col-md-6 button-column col-xs-12 col-sm-12 d-flex justify-content-start ">
      <a class="btn btn-sm btn-add add_product_details" style="padding-top: 0px;" data-bs-toggle="modal" data-bs-target="#add_product_details"
         data-relevant_client_id_add="{{ $clientDetails->id }}">
         {{-- <i class="fa fa-edit"></i> Edit </a> --}}
         <button class="btn btn-success btn-sm bg-add" style="margin-top: 0px; font-size: 25px !important; background-color: #1E7062 !important; border-color: #1E7062 !important;" type="button" id="addRow">+</button>
      </a>
   </div>
   <div class="col-md-6 total-column col-xs-12 col-sm-12 d-flex justify-content-end order-md-2 order-1">

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

<div class="row d-flex">
   <div class="col-md-12 simple-heading-bg">
      <h4 class="text-white my-1">PAYMENT METHOD</h4>
   </div>
</div>
<div class="row d-flex justify-content-start bg-white px-3 py-1">
   <div class="col-md-4 py-5">
      <label class="fw-bold">CHOOSE YOUR PAYOUT:<b class="text-danger">*</b></label>
      <select class="form-select shadow-none" aria-label="Default select example" name="payment_method"
         id="payment_method" required>
         <option option value="" selected disabled>Select</option>
         <option value="direct" @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'direct')
            selected @endif @endisset
            selected>Direct Deposit
         </option>
         <option value="paypal" @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'paypal')
            selected @endif @endisset>Paypal
         </option>
         <option value="cheque" @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'cheque')
            selected @endif @endisset>Cheque
         </option>
         <option value="echeck" @isset($clientDetails->payment_method) @if ($clientDetails->payment_method == 'echeck')
            selected @endif @endisset>E-check
         </option>
         <option value="storecredit" @isset($clientDetails->payment_method) @if ($clientDetails->payment_method ==
            'storecredit')
            selected @endif @endisset>Store Credit
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
<div class="row py-5 bg-white" id="direct" style="margin-top: -100px;">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-1"></div>

         <div class="col-md-4">
            <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="payment_full_name" id="payment_full_name"
               value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}" />
            @if ($errors->has('payment_full_name'))
            <span class="error">{{ $errors->first('payment_full_name') }}</span>
            @endif
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-4">
            <label class="fw-bold">EMAIL ADDRESS<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="payment_email" id="payment_email"
               value="{{ old('payment_email', $clientDetails->payment_email) }}" />
            @if ($errors->has('payment_email'))
            <span class="error">{{ $errors->first('payment_email') }}</span>
            @endif
         </div>
      </div>
   </div>
   <div class="col-md-12 pt-1">
      <div class="row pt-1">
         <div class="col-md-1"></div>
         <div class="col-md-4">
            <label class="fw-bold">BANK NAME</label>
            <input type="text" class="form-control" name="payment_direct_bank_name" id="payment_direct_bank_name"
               value="{{ old('payment_direct_bank_name', $clientDetails->payment_direct_bank_name) }}" />
            @if ($errors->has('payment_direct_bank_name'))
            <span class="error">{{ $errors->first('payment_direct_bank_name') }}</span>
            @endif
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-4">
            <label class="fw-bold">ACCOUNT NUMBER</label>
            <input type="text" class="form-control" name="payment_direct_account_number"
               id="payment_direct_account_number"
               value="{{ old('payment_direct_account_number', $clientDetails->payment_direct_account_number) }}" />
            @if ($errors->has('payment_direct_account_number'))
            <span class="error">{{ $errors->first('payment_direct_account_number') }}</span>
            @endif
         </div>
      </div>
   </div>

   <div class="col-md-12 pt-1">
      <div class="row pt-1">
         <div class="col-md-1"></div>

         <div class="col-md-4">
            <label class="fw-bold">ROUTING NUMBER</label>
            <input type="text" class="form-control" name="payment_direct_routing_number"
               id="payment_direct_routing_number"
               value="{{ old('payment_direct_routing_number', $clientDetails->payment_direct_routing_number) }}" />
            @if ($errors->has('payment_direct_routing_number'))
            <span class="error">{{ $errors->first('payment_direct_routing_number') }}</span>
            @endif
         </div>
         <div class="col-md-1"></div>
         <div class="col-md-4">
	    <label class="fw-bold">ACCOUNT TYPE</label>

            <input type="text" class="form-control" name="payment_direct_account_type" id="payment_direct_account_type"
               value="{{ old('payment_direct_account_type', $clientDetails->payment_direct_account_type) }}" />
            @if ($errors->has('payment_direct_account_type'))
            <span class="error">{{ $errors->first('payment_direct_account_type') }}</span>
            @endif
         </div>
      </div>
   </div>
</div>

<div class="row py-5 bg-white" id="paypal" style="margin-top: -100px;">
   <div class="col-md-1"></div>

   <div class="col-md-4">
      <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="payment_name_paypal" id="payment_name_paypal"
         value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}" />
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
         value="{{ old('payment_email', $clientDetails->payment_email) }}" />
      {{-- @if ($errors->has('payment_email_paypal'))
                    <span class="error">{{ $errors->first('payment_email_paypal') }}</span>
      @endif --}}
      @error('payment_email_paypal')
      <div class="error">{{ $message }}</div>
      @enderror
   </div>
</div>

<div class="row py-5 bg-white" id="cheque" style="margin-top: -100px;">
   <div class="col-md-1"></div>

   <div class="col-md-4">
      <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="payment_full_name_cheque" id="payment_full_name_cheque"
         value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}" />
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
         value="{{ old('payment_email', $clientDetails->payment_email) }}" />
      {{-- @if ($errors->has('payment_email_cheque'))
                    <span class="error">{{ $errors->first('payment_email_cheque') }}</span>
      @endif --}}
      @error('payment_email_cheque')
      <div class="error">{{ $message }}</div>
      @enderror
   </div>
</div>
<div class="row py-5 bg-white" id="storecredit" style="margin-top: -100px;">
   <div class="col-md-1"></div>

   <div class="col-md-4">
      <label class="fw-bold">Store Credit<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="storecredit" id="storecredit"
         value="{{ old('storecredit', $clientDetails->store_credit) }}" />
   </div>
</div>
<div class="row py-5 bg-white" id="echeck" style="margin-top: -100px;">
   <div class="col-md-1"></div>

   <div class="col-md-4">
      <label class="fw-bold">FULL NAME<span class="text-danger">*</span></label>
      <input type="text" class="form-control" name="payment_full_name_echeck" id="payment_full_name_echeck"
         value="{{ old('payment_full_name', $clientDetails->payment_full_name) }}" />
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
         value="{{ old('payment_email', $clientDetails->payment_email) }}" />
      {{-- @if ($errors->has('payment_email_cheque'))
                    <span class="error">{{ $errors->first('payment_email_cheque') }}</span>
      @endif --}}
      @error('payment_email_echeck')
      <div class="error">{{ $message }}</div>
      @enderror
   </div>
</div>




<div class="row justify-content-between pt-2 pb-2  px-3">
   <div class="col-md-4">
      <label class="fw-bolder black">SIGNATURE:</label>
      <img src="{{ asset('/signature/' . $clientDetails->signature) }}" class="img-fluid" />
      <input type="hidden" value="{{ $clientDetails->signature }}" name="oldsignature" id="oldsignature" />

   </div>
   <div class="col-md-4">
      <label class="fw-bold">Note</label>
      <textarea class="form-control" rows="8" id="note" name="note">{{ old('note') ? old('note') : $clientDetails->note }}</textarea>
      @if ($errors->has('note'))
      <span class="error">{{ $errors->first('note') }}</span>
      @endif
   </div>
   <div class="col-md-4">
      <label class="fw-bolder black"> UPDATE SIGNATURE:</label>

      <br />
      <div id="sig"></div>
      <br />
      <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
      <textarea id="signature64" name="signature64" data-validate="true" style="display: none"></textarea>

      @error('signature64')
      <div class="error">{{ $message }}</div>
      @enderror
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
   var selectedVal = $("#payment_method option:selected").val();
   //  alert(selectedVal);
   if (selectedVal == "paypal") {
      $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
      $("#direct").hide().addClass("noDisplay");
      $("#cheque").hide().addClass("noDisplay");
      $("#echeck").hide().addClass("noDisplay");
      $("#storecredit").hide().addClass("noDisplay");
   } else if (selectedVal == "cheque") {
      $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
      $("#paypal").hide().addClass("noDisplay");
      $("#direct").hide().addClass("noDisplay");
      $("#echeck").hide().addClass("noDisplay");
      $("#storecredit").hide().addClass("noDisplay");
   } else if (selectedVal == "echeck") {
      $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
      $("#paypal").hide().addClass("noDisplay");
      $("#direct").hide().addClass("noDisplay");
      $("#cheque").hide().addClass("noDisplay");
      $("#storecredit").hide().addClass("noDisplay");
   } else if (selectedVal == "storecredit") {
      $("#storecredit").show().addClass("lookAtMe").removeClass("noDisplay");
      $("#paypal").hide().addClass("noDisplay");
      $("#direct").hide().addClass("noDisplay");
      $("#cheque").hide().addClass("noDisplay");
      $("#echeck").hide().addClass("noDisplay");
   } else {
      $("#paypal").hide().addClass("lookAtMe").removeClass("noDisplay");
      $("#direct").show().addClass("noDisplay");
      $("#cheque").hide().addClass("noDisplay");
      $("#echeck").hide().addClass("noDisplay");
      $("#storecredit").hide().addClass("noDisplay");
   }
   $("#payment_method").change(function() {
      var selectedVal = $("#payment_method option:selected").val();
      // alert(selectedVal);
      if (selectedVal == "paypal") {
         $("#paypal").show().addClass("lookAtMe").removeClass("noDisplay");
         $("#direct").hide().addClass("noDisplay");
         $("#cheque").hide().addClass("noDisplay");
         $("#echeck").hide().addClass("noDisplay");
         $("#storecredit").hide().addClass("noDisplay");
      } else if (selectedVal == "cheque") {
         $("#cheque").show().addClass("lookAtMe").removeClass("noDisplay");
         $("#paypal").hide().addClass("noDisplay");
         $("#direct").hide().addClass("noDisplay");
         $("#echeck").hide().addClass("noDisplay");
         $("#storecredit").hide().addClass("noDisplay");
      } else if (selectedVal == "echeck") {
         $("#echeck").show().addClass("lookAtMe").removeClass("noDisplay");
         $("#paypal").hide().addClass("noDisplay");
         $("#direct").hide().addClass("noDisplay");
         $("#cheque").hide().addClass("noDisplay");
         $("#storecredit").hide().addClass("noDisplay");
      } else if (selectedVal == "storecredit") {
         $("#storecredit").show().addClass("lookAtMe").removeClass("noDisplay");
         $("#paypal").hide().addClass("noDisplay");
         $("#direct").hide().addClass("noDisplay");
         $("#cheque").hide().addClass("noDisplay");
         $("#echeck").hide().addClass("noDisplay");
      } else {
         $("#direct").show().addClass("lookAtMe").removeClass("noDisplay");
         $("#paypal").hide().addClass("noDisplay");
         $("#cheque").hide().addClass("noDisplay");
         $("#echeck").hide().addClass("noDisplay");
         $("#storecredit").hide().addClass("noDisplay");
      }
   });

    $(document).on('change', '#productInformationStatus', function (event) {

        var status = $(this).find('option:selected').val();
        if(status === ''){
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Please select status.',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        }else {

            var id = $(this).data('product-id');
            var request = {"status": status, "id": id};


            var url = "{{ url('pos/product-item-tagged') }}";
            $.get(url + '/' + id,request, function (res) {
                debugger;
                if (res == 1) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Status Updated Successfully.',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                }
            });
        }
    });
});
</script>

{{-- @stop --}}
