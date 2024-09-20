@extends('backend.layouts.layout')

@section('headInlineTag')

{{-- Write Style,link external CSS files --}}

@endsection

@section('pageName',__('Create User'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{__('User')}}</a></li>
<li class="breadcrumb-item active">{{__('Create User')}}</li>
@endSection

@section('content')

<div class="card">
   <form method="post" action="{{ route('user.store') }}">
      @csrf
      <div class="card-header">
         <h4 class="card-title">All fields marked with asterisks<span style="color:red"> (*)</span>are required.</h4>
      </div>
      <div class="card-body">
         <div class="form theme-form">
            <!-- Include Form -->
            <div class="form-group">
               <div class="row">
                  <div class="col-md-3">
                     <label for="name" class="form-label">Name <b class="text-danger">*</b></label>
                     <input type="text" id="name" class="form-control @error('name') is-invalid state-invalid @enderror"
                        value="{{ isset($user->name) ? $user->name : old('name') }}" name="name" required
                        placeholder="Enter Name...">

                     @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-md-3">
                     <label for="email" class="form-label">Email <b class="text-danger">*</b></label>
                     <input type="email" id="email"
                        class="form-control @error('email') is-invalid state-invalid @enderror"
                        {{-- value="@isset($user->email) {{ $user->email }} @endisset{{ old('email') }}" --}}
                        value="{{ isset($user->email) ? $user->email : old('email') }}" name="email" required
                        placeholder="Enter Email...">

                     @error('email')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  {{-- <div class="col-md-4">
            <label for="utype" class="form-label">User Type <b class="text-danger">*</b></label>
            <select id="utype" class="form-control @error('utype') is-invalid state-invalid @enderror select" name="utype"
                required value="{{ old('utype') }}">
                  <option value="" selected disabled>Select Option</option>

                  <option value="USR" selected>Normal User</option>

                  <option value="ADM">
                     Admin</option>
                  </select>

                  @error('utype')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div> --}}
               <div class="col-md-3">
                  <label for="password" class="form-label">Password <b class="text-danger">*</b></label>
                  <input type="password" id="password"
                     class="form-control @error('password') is-invalid state-invalid @enderror" name="password"
                     placeholder="Password">

                  @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>
               <div class="col-md-3">
                  <label for="password_confirmation" class="form-label">Confirm Password <b
                        class="text-danger">*</b></label>
                  <input type="password" id="password_confirmation"
                     class="form-control @error('password_confirmation') is-invalid state-invalid @enderror"
                     name="password_confirmation" placeholder="Confirm Password">

                  @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
               </div>
               <div class="col-md-3">
                  <label for="user_role" class="form-label">User Role<b class="text-danger">*</b></label>
                  <select class="form-control" name="user_role" required id="user_role">
                     <option value="option_select">Select User Role</option>
                     @foreach($user_role as $role)
                     <option value="{{ $role->user_role }}">
                        {{ $role->user_role}}
                     </option>
                     @endforeach
                  </select>
                  @error('user_role')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
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