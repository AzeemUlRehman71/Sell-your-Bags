@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}

@endsection

@section('pageName',__('Set Login Pin'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active">{{__('Set Login Pin')}}</li>
@endSection

@section('content')

<div class="card">
   <form method="post" action="{{ route('set_login_pin.store') }}">
      @csrf
      <div class="card-header">
         <h4 class="card-title">Set up a 4 digit login pin</h4>
      </div>
      <div class="card-body">
         <div class="form theme-form">
            <!-- Include Form -->
            <div class="form-group">
               <div class="row">
                  <div class="col-md-6">
                     <label for="name" class="form-label">Pin <b class="text-danger">*</b></label>
                     <input type="number" id="pin" class="form-control @error('pin') is-invalid state-invalid @enderror"
                        value="{{ isset(auth()->user()->pin) ? auth()->user()->pin : old('pin') }}" name="pin" required
                        placeholder="Enter Pin">

                     @error('pin')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
            </div>
         </div>

         <div class="clearfix" style="margin-top: 20px;"></div>
         <!-- =============================== -->
      </div>
</div>
<div class="card-footer" style="">
   <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i data-feather="save"></i>
      Save </button>
</div>
</form>
</div>

@endsection

@section('jsOutside')

{{-- Write script,link external JS files --}}

@endsection