<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('head.dependencies')
</head>
<body>
    
@php
    $currentRoute = Route::current();
    $routeParameters = json_decode(json_encode($currentRoute->parameters), FALSE);
@endphp

<nav class="main-navigation">
    <div class="header smallPadding rata-tengah">
        <div class="wrap super">
            <div class="icon mb-1">{{ $myData->initial }}</div>
            <h2>{{ $myData->name }}</h2>
        </div>
    </div>
    <ul>
        <a href="{{ route('admin.dashboard') }}">
            <li class="{{ $currentRoute->uri == 'admin/dashboard' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-home"></i></div>
                <div class="text">Dashboard</div>
            </li>
        </a>
        <a href="{{ route('admin.buku') }}">
            <li class="{{ $currentRoute->uri == 'admin/buku' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-book"></i></div>
                <div class="text">Buku</div>
            </li>
        </a>
        <a href="{{ route('admin.layananPerpustakaan') }}">
            <li class="{{ $currentRoute->uri == 'admin/layanan-perpustakaan' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-cogs"></i></div>
                <div class="text">Layanan</div>
            </li>
        </a>
        <a href="{{ route('admin.jadwal') }}">
            <li class="{{ $currentRoute->uri == 'admin/jadwal-perpustakaan' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-clock"></i></div>
                <div class="text">Jam Buka</div>
            </li>
        </a>
        <a href="{{ route('admin.visitor') }}">
            <li class="{{ $currentRoute->uri == 'admin/visitor' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="text">Pengunjung</div>
            </li>
        </a>
        {{-- <a href="#">
            <li class="{{ $currentRoute->getPrefix() == 'admin/user' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="text">Users
                    <i class="fas fa-angle-down"></i>
                </div>
                <ul>
                    <a href="{{ route('admin.agent') }}">
                        <li class="{{ Route::currentRouteName() == 'admin.agent' ? 'active' : '' }}">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <div class="text">Agents</div>
                        </li>
                    </a>
                    <a href="{{ route('admin.visitor') }}">
                        <li class="{{ Route::currentRouteName() == 'admin.visitor' ? 'active' : '' }}">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <div class="text">Visitors</div>
                        </li>
                    </a>
                </ul>
            </li>
        </a> --}}
        <a href="{{ route('admin.logout') }}">
            <li class="{{ $currentRoute->uri == 'admin/logout' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                <div class="text">Logout</div>
            </li>
        </a>
    </ul>
</nav>

<header>
    <h1>@yield('title')</h1>
    <div class="action">
        @yield('header.action')
    </div>
</header>

<div class="content">
    @yield('content')
    <div class="tinggi-70"></div>
</div>

<script src="{{ asset('js/base.js') }}"></script>
@yield('javascript')

</body>
</html>