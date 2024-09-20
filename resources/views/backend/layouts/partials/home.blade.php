@extends('backend.layouts.layout')

@section('headInlineTag')

    {{-- Write Style,link external CSS files --}}

@endsection

@section('pageName', __('Dashboard'))

@section('content')

    {{-- ********************************************************* --}}
    {{-- Super Admin and Admin Dashboard Start --}}
    {{-- @if (Auth::user()->utype == 'ADM') --}}
    <section id="dashboard-analytics">
        <div class="row match-height">
            <!-- Greetings Card starts -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img src="app-assets/images/elements/decore-left.png" class="congratulations-img-left"
                            alt="card-img-left">
                        <img src="app-assets/images/elements/decore-right.png" class="congratulations-img-right"
                            alt="card-img-right">
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-award font-large-1">
                                    <circle cx="12" cy="8" r="7"></circle>
                                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                                </svg>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Welcome to Admin Area,</h1>
                            <p class="card-text m-auto w-75">
                                You can manage the items from <strong> Left Side Menu</strong> .
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Greetings Card ends -->




        </div>


        <!--/ List DataTable -->
    </section>
    {{-- @endif --}}



    {{-- Super Admin and Admin Dashboard End --}}
    {{-- *************************************************** --}}

    {{-- *************************************************** --}}
    {{-- Driver Dashboard Start --}}

    {{-- *************************************************** --}}
@endsection

@section('jsOutside')

    {{-- Write script,link external JS files --}}
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>



    {{-- Include Dashboard Js --}}


@endsection
