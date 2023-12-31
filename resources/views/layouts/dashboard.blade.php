<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/project/versaleicon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="d-block headerlogo" src="{{ asset('img/icon/logo.png') }}" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role === 'buyer')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('request.index') }}">My Requests</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ Auth::user()->buyer->image }}" alt="userimage"
                                            class="nav-profile-img">
                                        {{ Auth::user()->buyer->username }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('buyer.index') }}">
                                            My Profile
                                        </a>
                                        <a class="dropdown-item" href="{{ route('order.index') }}">
                                            My Purchase
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif (Auth::user()->role === 'seller')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seller.request.index') }}">Explore Requests</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('seller.overview') }}">Dashboard</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ Auth::user()->seller->image }}" alt="userimage"
                                            class="nav-profile-img">
                                        {{ Auth::user()->seller->username }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('seller.index') }}">
                                            Profile
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @elseif (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.overview') }}">Dashboard</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ Auth::user()->admin->image }}" alt="userimage"
                                            class="nav-profile-img">
                                        {{ Auth::user()->admin->username }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            Profile
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if (Auth::user()->role === 'seller')
                <div class="sidebar col-2 position-fixed p-0">
                    <ul class="mx-0 mt-3 p-0">
                        <a href="{{ route('seller.overview') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'seller.overview' ? 'active' : '' }}">
                                <h6><i class="fas fa-tachometer-alt mr-3 col-1"></i> Overview</h6>
                            </li>
                        </a>
                        <a href="{{ route('product.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'product.index' || Route::currentRouteName() == 'product.createIndex' ? 'active' : '' }}">
                                <h6><i class="fas fa-box-open mr-3 col-1"></i> My Products</h6>
                            </li>
                        </a>
                        <a href="{{ route('offer.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'offer.index' ? 'active' : '' }}">
                                <h6><i class="fas fa-hand-holding-usd mr-3 col-1"></i> My Offers</h6>
                            </li>
                        </a>
                        <a href="{{ route('seller.order.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'seller.order.index' ? 'active' : '' }}">
                                <h6><i class="fas fa-shipping-fast mr-3 col-1"></i> My Orders</h6>
                            </li>
                        </a>
                    </ul>
                </div>
            @elseif (Auth::user()->role === 'admin')
                <div class="sidebar col-2 position-fixed p-0">
                    <ul class="mx-0 mt-3 p-0">
                        <a href="{{ route('admin.overview') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'admin.overview' ? 'active' : '' }}">
                                <h6><i class="fas fa-tachometer-alt mr-3 col-1"></i> Overview</h6>
                            </li>
                        </a>
                        <a href="{{ route('admin.project.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'admin.project.index' || Route::currentRouteName() == 'admin.project.createIndex' ? 'active' : '' }}">
                                <h6><i class="fas fa-book-open mr-3 col-1"></i> Proyectos</h6>
                            </li>
                        </a>
                        <a href="{{ route('admin.project.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'admin.user.index' || Route::currentRouteName() == 'admin.user.createIndex' ? 'active' : '' }}">
                                <h6><i class="fas fa-box mr-3 col-1"></i> Herramienta</h6>
                            </li>
                        </a>
                        <a href="{{ route('admin.map.index') }}">
                            <li class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'admin.map.index' ? 'active' : '' }}">
                                <h6><i class="fas fa-globe-americas mr-3 col-1"></i> Google Maps</h6>
                            </li>
                        </a>
                        <a href="{{ route('admin.user.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'admin.user.index' || Route::currentRouteName() == 'admin.user.createIndex' ? 'active' : '' }}">
                                <h6><i class="fas fa-users mr-3 col-1"></i> Usuarios</h6>
                            </li>
                        </a>
                        <a href="{{ route('feedbacks.index') }}">
                            <li
                                class="text-7 sidebar-list py-4 px-4 w-100 h-100 cursor-pointer {{ Route::currentRouteName() == 'feedbacks.index' ? 'active' : '' }}">
                                <h6><i class="fas fa-comment-dots mr-3 col-1"></i> Feedbacks</h6>
                            </li>
                        </a>
                    </ul>
                </div>
            @endif

            <div class="row p-0 m-0">
                <div class="col-2 p-0 m-0">

                </div>
                <div class="col-10 py-0 m-0">
                    @yield('content')
                </div>
            </div>

        </main>
    </div>


</body>

</html>
