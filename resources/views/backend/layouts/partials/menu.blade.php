 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
     <div class="navbar-header">
         <ul class="nav navbar-nav flex-row">
             <li class="nav-item me-auto"><a class="navbar-brand" href=""><span class="brand-logo">
                         <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="35">

                             <img src="{{ asset('app-assets\images\logo\final-logo.png') }}">
                         </svg>
                     </span>
                 </a>
             </li>
             <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
         </ul>
     </div>
     <div class="shadow-bottom"></div>
     <div class="main-menu-content">
         <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
             <li class="nav-item {{ request()->is('home') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('home') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
             </li>
             {{-- <span class="badge badge-light-warning rounded-pill ms-auto me-1">2</span> --}}</a>
             {{-- <ul class="menu-content"> --}}
             <li class="{{ request()->is('clients/*') ? 'active' : '' }}">
                 <a class="d-flex align-items-center" href="{{ route('pos.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Pos</span></a>

             </li>
             {{-- @if (Auth::user()->utype == 'ADM') --}}
             {{-- <li class="{{ request()->is('stores/*') ? 'active' : '' }}">
             <a class="d-flex align-items-center" href="{{ route('store.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Stores</span></a>
             </li>
             <li class="{{ request()->is('products/*') ? 'active' : '' }}">
                 <a class="d-flex align-items-center" href="{{ route('product.index') }}"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Products</span></a>
             </li> --}}
             {{-- @endif --}}

             {{-- </ul> --}}
             </li>
             {{-- <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="app-email.html"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Email">Email</span></a>
            </li> --}}
            @if(Auth::user()->user_role == "Admin")
             <li class="{{ request()->is('clients/*') ? 'active' : '' }}">
                 <a class="d-flex align-items-center" href="{{ route('user.index') }}"><i data-feather="user"></i><span class="menu-item text-truncate" data-i18n="Analytics">Users</span></a>

             </li>
             <li class="{{ request()->is('clients/*') ? 'active' : '' }}">
                 <a class="d-flex align-items-center" href="{{ route('user.user_role') }}"><i data-feather="user"></i><span class="menu-item text-truncate" data-i18n="Analytics">Users Role</span></a>

             </li>
             @endif
             <li class="{{ request()->is('set-login-pin') ? 'active' : '' }}">
                 <a class="d-flex align-items-center" href="{{ route('set_login_pin') }}"><i data-feather="key"></i><span class="menu-item text-truncate" data-i18n="Analytics">Set Login Pin</span></a>
             </li>

         </ul>
     </div>
 </div>
 <!-- END: Main Menu-->