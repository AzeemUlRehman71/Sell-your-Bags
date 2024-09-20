<div class="row mt-2">
    @if (auth()->user())
        <div class="col-md-12 d-flex justify-content-end">

            {{-- <a href="{{ route('client.index') }}" role="button" class="btn btn-success pr-2 mx-2">Admin Panel</a> --}}

            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="pr-2 mx-2">Logout</button>
            </form> --}}
            {{-- <a href="javascript:void" class="text-decoration-none text-dark fw-bold" onclick="$('#logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form> --}}
        </div>
    @endif

</div>

<header class="d-flex justify-content-center mt-3 pb-3 border-bottom border-1 header-border-color">
    <a href="#" class="brand-logo">
        <img src="{{ asset('app-assets/images/logo/final-logo.png') }}" width="200px">
    </a>


</header>
