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
                <a href="{{ route("admin.dashboard") }}">Oikotan</a>
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
                    <span class="author_name">{{ Auth::user()->name }}</span>
                        @if(!empty(Auth::user()->profile_pic))
                            <img src="{{ Storage::url(Auth::user()->profile_pic) }}" alt="{{ Auth::user()->name }}">
                        @else
                            <img src="{{ asset('assets/images/male_demo_profile.jpg') }}" alt="{{ Auth::user()->name }}">
                        @endif
                    </div>
                    <div class="option-dropdown header-profile-box">
                        <ul class="user-info">
                            <li><a href="{{ route( "admin.user.edit", Auth::user()->id ) }}">My Profile</a></li>
                            <li>
                                <a href="javascript:void" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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
                <li><a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-sticky-note"></i> Posts</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">Posts</a></li>
                        <li><a href="">Add New Post</a></li>
                    </ul>
                </li>
                <li><a href="" class=""><i class="fas fa-book"></i> Pages</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-shopping-cart"></i> Products</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">All Products</a></li>
                        <li><a href="">Add New Product</a></li>
                        <li><a href="{{ route('admin.attributes') }}">Manage Attribute</a></li>
                        <li><a href="{{ route('admin.categories') }}">Manage Category</a></li>
                    </ul>
                </li>
                <li><a href="" class=""><i class="fas fa-tachometer-alt"></i> Menu</a></li>
                <li><a href="" class=""><i class="fas fa-tachometer-alt"></i> Order Management</a></li>
                <li><a href="" class=""><i class="fas fa-tachometer-alt"></i> Options</a></li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-user"></i> Users</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="{{ route('admin.users') }}">All Users</a></li>
                        <li><a href="{{ route('admin.user.create') }}">Add New User</a></li>
                        <li><a href="{{ route( "admin.user.edit", Auth::user()->id ) }}">Profile</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void" class="{{ Route::currentRouteName() == 'admin.roles' ? 'active' : '' }}"><i class="fas fa-user"></i> Access Management</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="{{ route('admin.roles') }}">Roles</a></li>
                        @auth @endauth
                    </ul>
                </li>
                <li>
                    <a href="javascript:void" class=""><i class="fas fa-shopping-cart"></i> Reports</a>
                    <ul class="sub-menu" id="sub-menu">
                        <li><a href="">Stock Report</a></li>
                        <li><a href="">Sale Report</a></li>
                        {{-- <li><a href=""></a></li> --}}
                    </ul>
                </li>
                <li><a href="{{ route('admin.settings') }}" class="{{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}"><i class="fas fa-cog"></i> Settings</a></li>
                {{-- <li><a href="components.html" class=""><i class="fas fa-tools"></i> Components</a></li> --}}
            </ul>
        </aside>

        @yield('content')

    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script>
        @if(!empty(session()->has('status')))
            var type = "{{ session()->get('status', 'success') }}";

            switch (type) {
                case 'info': {
                    toastr.info("{{ session()->get('message') }}")
                    break;
                }
                case 'success': {
                    toastr.success("{{ session()->get('message') }}")
                    break;
                }
                case 'error': {
                    toastr.error("{{ session()->get('message') }}")
                    break;
                }
                case 'warning': {
                    toastr.warning("{{ session()->get('message') }}")
                    break;
                }
            }
        @endif
    </script>
    @stack('script')
</body>

</html>