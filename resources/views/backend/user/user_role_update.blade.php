@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}

@endsection

@section('pageName',__('Edit user_role'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="">{{__('user_role')}}</a></li>
<li class="breadcrumb-item active">{{__('Edit user_role')}}</li>
@endSection

@section('content')

<div class="card">
   <form method="post" action="{{ route('user_role.update',['id'=>$user_role->id]) }}">
      @csrf
      <div class="card-header" style="width: 100%; padding: 10px 10px 10px 20px">
         <h4 class="card-title">All fields marked with asterisks<span style="color:red"> (*)</span>are required.</h4>
      </div>
      <div class="card-body">
         <div class="form theme-form">
            <div class="form-group">
               <div class="row">
                  <div class="col-md-3">
                     <label for="user_role" class="form-label">user_role <b class="text-danger">*</b></label>
                     <input type="text" id="user_role"
                        class="form-control @error('user_role') is-invalid state-invalid @enderror"
                        value="{{ isset($user_role->user_role) ? $user_role->user_role : old('user_role') }}"
                        name="user_role" required placeholder="Enter Name...">

                     @error('user_role')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="view" name="view" {{ $user_role->view==1 ? 'checked': '' }}>
                     <label for="view" class="form-label">View</label>
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="change_status" name="change_status"
                        {{ $user_role->change_status==1 ? 'checked': '' }}>
                     <label for="change_status" class="form-label">Change Status</label>
                  </div>
               </div>
               <div class="row mt-1">
                  <div class="col-md-3">
                     <input type="checkbox" id="edit" name="edit" {{ $user_role->edit==1 ? 'checked': '' }}>
                     <label for="edit" class="form-label">Edit</label>
                  </div>
               </div>
            </div>

            <div class="clearfix" style="margin-top: 20px;"></div>
         </div>
      </div>
      <div class="card-footer" style="">
         <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i
               data-feather="save"></i> Update </button>
      </div>
   </form>
</div>

@endsection

@section('jsOutside')


@endsection