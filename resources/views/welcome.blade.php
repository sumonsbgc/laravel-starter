<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oikotan</title>
    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="welcome-page">

    <header class="welcome-header">
        <div class="flex">
            <ul class="auth-header">
                <li>
                    <a href="">Importer</a>
                    <ul>
                        <li><a href="{{ route('importer.login') }}">Login</a></li>
                        <li><a href="{{ route('importer.register') }}">Register</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Merchant</a>
                    <ul>
                        <li><a href="{{ route('merchant.login') }}">Login</a></li>
                        <li><a href="{{ route('merchant.register') }}">Register</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Courier</a>
                    <ul>
                        <li><a href="{{ route('courier.login') }}">Login</a></li>
                        <li><a href="{{ route('courier.register') }}">Register</a></li>
                    </ul>
                </li>
            </ul>

{{--            @if (Route::has('login'))--}}
{{--                @auth--}}
{{--                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>--}}

{{--                    @if (Route::has('register'))--}}
{{--                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            @endif--}}

        </div>
    </header>
</body>

</html>
