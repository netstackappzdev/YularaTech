@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body bd-example">
                    <h4 class="card-title mt-n1 text-center m-3">Log-in</h4>

                    <form class="p-3" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="col-md-12 mb-4">
                            <label for="email" class="form-label">{{ __('Email / Username') }}</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-light btn-lg w-100  text-uppercase">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </div>
                        <br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
