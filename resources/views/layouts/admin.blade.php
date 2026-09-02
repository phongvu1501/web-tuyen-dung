<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Quản trị') | VALORA HR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <aside class="admin-sidebar p-3">
        <a class="navbar-brand text-white mb-4 px-2" href="{{ route('admin.dashboard') }}"><x-brand /></a>
        <nav class="nav flex-column" aria-label="Điều hướng quản trị">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i data-lucide="layout-dashboard" class="icon-sm"></i>Tổng quan</a>
            <a class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}" href="{{ route('admin.jobs.index') }}"><i data-lucide="briefcase-business" class="icon-sm"></i>Việc làm</a>
            <a class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}"><i data-lucide="users" class="icon-sm"></i>Ứng viên</a>
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}"><i data-lucide="messages-square" class="icon-sm"></i>Liên hệ</a>
        </nav>
        <div class="position-absolute bottom-0 start-0 end-0 p-3 border-top border-secondary">
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i data-lucide="external-link" class="icon-sm"></i>Xem website</a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-link border-0 bg-transparent w-100" type="submit"><i data-lucide="log-out" class="icon-sm"></i>Đăng xuất</button></form>
        </div>
    </aside>

    <div class="admin-content">
        <header class="admin-topbar d-flex align-items-center px-3 px-lg-4">
            <button class="btn btn-outline-secondary btn-sm mobile-admin-nav me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminMenu" aria-label="Mở menu"><i data-lucide="menu" class="icon-sm"></i></button>
            <div><div class="fw-semibold">@yield('page_title', 'Quản trị tuyển dụng')</div><small class="text-muted-valora">VALORA TRADING &amp; SERVICES</small></div>
            <div class="ms-auto d-flex align-items-center gap-2"><span class="stat-icon" style="height:38px;width:38px"><i data-lucide="user-round"></i></span><span class="d-none d-sm-block small fw-semibold">{{ auth()->user()->name }}</span></div>
        </header>
        <main class="admin-page">
            <x-flash />
            @yield('content')
        </main>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="adminMenu" aria-labelledby="adminMenuLabel">
        <div class="offcanvas-header"><h2 class="offcanvas-title h5" id="adminMenuLabel">VALORA HR</h2><button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Đóng"></button></div>
        <div class="offcanvas-body"><nav class="nav flex-column gap-2"><a class="nav-link" href="{{ route('admin.dashboard') }}">Tổng quan</a><a class="nav-link" href="{{ route('admin.jobs.index') }}">Việc làm</a><a class="nav-link" href="{{ route('admin.applications.index') }}">Ứng viên</a><a class="nav-link" href="{{ route('admin.contacts.index') }}">Liên hệ</a><hr><a class="nav-link" href="{{ route('home') }}">Xem website</a><form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-link nav-link" type="submit">Đăng xuất</button></form></nav></div>
    </div>
</body>
</html>
