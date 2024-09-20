@extends('backend.layouts.layout')

@section('headInlineTag')

    {{-- Write Style,link external CSS files --}}

@endsection
{{-- @if (Auth::user()->utype == 'USR') --}}
@section('pageName', __('Create Sale'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="">Home</a></li>
    <li class="breadcrumb-item"><a href="">{{ __('Pos') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Create Pos') }}</li>
@endSection

@section('content')

    <div class="card">
        <form method="post" action="">
            @csrf
            <div class="card-header">
                <h4 class="card-title">All fields marked with asterisks<span style="color:red"> (*)</span>are required.</h4>
            </div>
            <div class="card-body">
                <div class="form theme-form">
                    <!-- Include Form -->
                    @include('sale._form')
                    <!-- =============================== -->
                </div>
            </div>
            <div class="card-footer" style="">
                <button type="submit" class="btn btn-success" style="float: right; margin-bottom: 10px"><i
                        data-feather="save"></i> Save </button>
            </div>
        </form>
    </div>

@endsection
{{-- @endif --}}

@section('jsOutside')

    {{-- Write script,link external JS files --}}
    @include('custom_js.init_js')

@endsection
