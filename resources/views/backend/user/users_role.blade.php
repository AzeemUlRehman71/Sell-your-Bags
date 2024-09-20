@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}

@endsection

@section('pageName',__('Create User Role'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{__('User')}}</a></li>
<li class="breadcrumb-item active">{{__('Create User Role')}}</li>
@endSection

@section('content')

<div class="card">
   <form method="post" action="{{ route('user.role_store') }}">
      @csrf
      <div class="card-header">
         <h4 class="card-title">All fields marked with asterisks<span style="color:red"> (*)</span>are required.</h4>
      </div>
      <div class="card-body">
         <div class="form theme-form">
            <div class="form-group">
               <div class="row">
                  <div class="col-md-3">
                     <label for="user_role" class="form-label">User Role<b class="text-danger">*</b></label>
                     <input type="text" id="user_role"
                        class="form-control @error('user_role') is-invalid state-invalid @enderror"
                        value="{{ isset($user->user_role) ? $user->user_role : old('user_role') }}" name="user_role"
                        required placeholder="Enter User Role...">

                     @error('user_role')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="view" name="view">
                     <label for="view" class="form-label">View</label>
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="change_status" name="change_status">
                     <label for="change_status" class="form-label">Change Status</label>
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="edit" name="edit">
                     <label for="edit" class="form-label">Edit</label>
                  </div>
               </div>
            </div>
            <div class="clearfix" style="margin-top: 20px;"></div>
         </div>
      </div>
      <div class="card-footer" style="">
         <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i
               data-feather="save"></i> Save </button>
      </div>
   </form>
</div>

@endsection

@section('jsOutside')

{{-- Write script,link external JS files --}}

@endsection