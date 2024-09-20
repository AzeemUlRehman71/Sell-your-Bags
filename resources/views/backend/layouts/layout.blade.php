<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ============================= -->
    <!-- Head Section Include -->
    @include('backend.layouts.partials.header')
    <!-- End head Section -->
    <!-- ============================= -->
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- ================================ -->
    <!-- Page Header Start-->
    @include('backend.layouts.partials.head')
    <!-- Page Header Ends -->
    <!-- ================================ -->
    <!-- Page Body Start-->
    <!-- ===================================== -->
    <!-- Page Sidebar Start-->
    @include('backend.layouts.partials.menu')
    <!-- Page Sidebar Ends-->
    <!-- ===================================== -->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">@yield('pageName')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                                    </li> --}}
                                    @yield('breadcrumb')
                                    {{-- <li class="breadcrumb-item active"><a href="#">@yield('pageName')</a>
                                    </li> --}}
                                    {{-- <li class="breadcrumb-item active">Breadcrumbs --}}
                                    {{-- </li> --}}
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                    <div class="mb-1 breadcrumb-right">
                        @if (last(request()->segments()) == 'index' && View::hasSection('route'))
                        <a href="@yield('route')" class="btn-icon btn btn-success btn-rounds"><i data-feather="plus"></i> Create</a>
                        @elseif(last(request()->segments()) == 'view' && View::hasSection('route'))
                        <a href="@yield('route')" class="btn-icon btn btn-warning btn-rounds"><i data-feather="edit-2"></i> Edit</a>
                        @elseif(last(request()->segments()) == 'index' && View::hasSection('modal'))
                        <button type="button" id="@yield('modal')" class="btn-icon btn btn-success btn-rounds" data-bs-toggle="modal" data-bs-target="@yield('modal_target')">
                            <i data-feather="plus"></i> Create
                        </button>
                        @endif
                        @hasSection('print')
                        <a href="@yield('print')" class="btn-icon btn btn-info btn-rounds"><i data-feather="printer"></i>Print</a>
                        @endif
                        @hasSection('csv')
                        <a href="@yield('csv')" class="btn-icon btn btn-info btn-rounds">Import Csv</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- ================================= -->
                <!-- Start Main Content -->
                @yield('content')
                <!-- End Main content -->
                <!-- ================================= -->
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- Footer start-->
    @include('backend.layouts.partials.footer')
    <!-- Footer End -->
    <!-- =================================== -->
    {{-- <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button> --}}
    <button class="btn btn-primary btn-icon scroll-top waves-effect waves-float waves-light" type="button" style="display: inline-block;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-line cap="round" stroke-linejoin="round" class="feather feather-arrow-up">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg>
    </button>
    <!-- ====================================== -->
    <!-- Jquery section Include-->
    @include('backend.layouts.partials.script')
    <!-- Jquery Section End -->
    <!-- ====================================== -->
    <!-- Include Alert File -->
    @include('backend.layouts.partials.alert')
    <!-- End Alert File -->
    <!-- ====================================== -->
</body>

</html>