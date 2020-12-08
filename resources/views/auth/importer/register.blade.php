@extends('layouts.auth-layouts')

@section('content')
    <div class="register-form card px-2">
        <div class="brand-logo flex justify-center mb-2">
            <img src="assets/images/admin-logo.svg" alt="Brand Logo" class="logo-img">
        </div>

        <form action="{{ route('importer.register')  }}" class="" method="post">
            @csrf
            <div class="my-1">
                <label for="first_name" class="label">Frist Name<span class="text-red">*</span></label>
                <input class="input-control @error('first_name') invalid @enderror" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" id="first_name" required/>

                @error('first_name')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
            <div class="my-1">
                <label for="last_name" class="label">Last Name<span class="text-red">*</span></label>
                <input class="input-control @error('last_name') invalid @enderror" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" id="last_name" required>

                @error('last_name')
                <span class="invalid-feedback" role="alert">
                <storng>{{ $message }}</storng>
            </span>
                @enderror
            </div>

            <div class="my-1">
                <label for="email" class="label">Email<span class="text-red">*</span></label>
                <input class="input-control @error('email') invalid @enderror" type="text" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" id="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                <storng>{{ $message }}</storng>
            </span>
                @enderror
            </div>

            <div class="my-1">
                <label for="password" class="label">Password<span class="text-red">*</span></label>
                <input class="input-control @error('password') invalid @enderror" type="password" name="password" placeholder="Password" value="" id="password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                <storng>{{ $message }}</storng>
            </span>
                @enderror
            </div>

            <div class="my-1">
                <label for="confirm-password" class="label">Confirm Password<span class="text-red">*</span></label>
                <input class="input-control @error('password_confirmation') invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Password" value="" id="confirm-password">

                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                <storng>{{ $message }}</storng>
            </span>
                @enderror
            </div>

            <div class="my-2 flex align-center justify-between">
                <input class="submit-control" type="submit" name="register" value="Register" id="register">
                <label for="" class="label">
                    <a href="{{ route('importer.login') }}" class="">Login</a>
                </label>
            </div>
        </form>
    </div>
@endsection
