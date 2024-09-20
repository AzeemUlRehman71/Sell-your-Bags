@extends('backend.layouts.layout')

@section('headInlineTag')

    {{-- Write Style,link external CSS files --}}

@endsection

@section('pageName',__('Edit User'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item" ><a href="">{{__('User')}}</a></li>
<li class="breadcrumb-item active">{{__('Edit User')}}</li>
@endSection

@section('content')

    <div class="card">
        <form method="post" action="{{ route('user.update',['id'=>$user->id]) }}">
            @csrf
            <div class="card-header" style="width: 100%; padding: 10px 10px 10px 20px">
                <h4 class="card-title">All fields marked with asterisks<span style="color:red"> (*)</span>are required.</h4>
            </div>
            <div class="card-body">
                <div class="form theme-form">
                    <!-- Include Form -->
                @include('backend.user._form')
                <!-- =============================== -->
                </div>
            </div>
            <div class="card-footer" style="">
                <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i data-feather="save"></i> Update </button>
            </div>
        </form>
    </div>

@endsection

@section('jsOutside')

   
@endsection
