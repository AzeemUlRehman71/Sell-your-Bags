@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Login With Pin') }}
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary pull-right">Login with Email</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login_with_pin') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="pin" class="col-md-4 col-form-label text-md-end">{{ __('Pin') }}</label>

                            <div class="col-md-6">
                                <input id="ping" type="password" class="form-control @error('pin') is-invalid @enderror" name="pin" value="{{ old('pin') }}" required autofocus>

                                @error('pin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
