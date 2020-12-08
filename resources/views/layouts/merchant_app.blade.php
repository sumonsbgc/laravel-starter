<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config()->get('app.name', 'Encoder IT Solution') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div id="page-wrapper">        
        <header>
            <div class="collapse-menu">
                <button id="toggle-sidebar"> <i class="fas fa-bars"></i> </button>
            </div>

            <div class="brand-logo">
                <img src="{{ asset('assets/images/admin-logo.svg') }}" alt="">
            </div>

            <div class="front-link">
                <i class="fas fa-home"></i>
                <a href="{{ route("merchant.dashboard") }}">Oikotan</a>
            </div>

            <ul class="top-menu">
                <li id="notification-count-box">
                    <div class="header-option">
                        <i class="fas fa-bell"></i>
                        <span class="count">5</span>
                    </div>
                    <div class="option-dropdown header-notification-box">
                        <div class="notification-head">
                            <strong>Notification</strong>
                            <small>Clear All</small>
                        </div>
                        <div class="notification-body">
                            <ul>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                                        <span>Hello World</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="notification-footer">
                            <a href="">View All</a>
                        </div>
                    </div>
                </li>
                <!-- <li>
                    <a href="" class="">
                        <i class="fas fa-comments"></i>
                        <span class="count">5</span>
                    </a>
                </li> -->
                <li id="">
                    <div class="header-option">
                    <span class="user_name">{{ Auth::user()->name }}</span>
                        <img src="{{ asset('assets/images/mohammad.jpg') }}" alt="">
                    </div>
                    <div class="option-dropdown header-profile-box">
                        <ul class="user-info">
                            <li><a href="{{ route("merchant.profile") }}">My Profile</a></li>
                            <li><a href="">Edit Profile</a></li>
                            <li>
                                <a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('merchant.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </header>

        <aside class="left-sidebar" id="left-sidebar">
            <ul class="sidebar-menu">
                <li><a href="" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-sticky-note"></i> Posts</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">Posts</a></li>
                        <li><a href="">Add New Post</a></li>
                        <li><a href="">Add Category</a></li>
                    </ul>
                </li>
                <li><a href="" class=""><i class="fas fa-book"></i> Pages</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-shopping-cart"></i> Products</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">Products</a></li>
                        <li><a href="">Add New Product</a></li>
                    </ul>
                </li>
                <li><a href="" class=""><i class="fas fa-tachometer-alt"></i> Menu</a></li>
                <li><a href="" class=""><i class="fas fa-tachometer-alt"></i> Options</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-user"></i> Users</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">Users</a></li>
                        @auth
                            <li><a href="{{ route("merchant.profile") }}">Profile</a></li>
                        @endauth
                    </ul>
                </li>
                <li><a href="" class=""><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="components.html" class=""><i class="fas fa-tools"></i> Components</a></li>
            </ul>
        </aside>

        @yield('content')

    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    @stack('script')
</body>

</html>