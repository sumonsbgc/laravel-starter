@extends('layouts.auth-layouts')

@section('content')
    <div class="login-form card px-2 pb-2">
        <div class="brand-logo flex justify-center mb-2">
            <img src="{{ asset('assets/admin-logo.svg') }}" alt="Brand Logo" class="logo-img">
        </div>
        <form action="{{ route('courier.login') }}" class="" method="POST">
            @csrf
            <div class="my-1">
                <label for="" class="label">Email<span class="text-red">*</span></label>
                <input class="input-control @error('email') invalid @enderror " type="text" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" id="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="my-1">
                <label for="" class="label">Password<span class="text-red">*</span></label>
                <input class="input-control @error('password') invalid @enderror" type="password" name="password" placeholder="Password" value="" id="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mt-2 flex align-center justify-between">
                <label for="remember" class="label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>

                @if (Route::has('courier.password.request'))
                    <label for="" class="label">
                        <a class="" href="{{ route('courier.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </label>
                @endif
            </div>
            <div class="mt-1">
                <input class="submit-control" type="submit" name="login" value="Login" id="login">
            </div>
        </form>
    </div>
@endsection
