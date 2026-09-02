<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Cơ hội nghề nghiệp tại Valora Trading & Services.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cơ hội nghề nghiệp') | VALORA TRADING &amp; SERVICES</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body style="--hero-image: url('{{ asset('images/valora-team.jpg') }}')">
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg" aria-label="Điều hướng chính">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <x-brand />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Mở menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Giới thiệu</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('careers.*') ? 'active' : '' }}" href="{{ route('careers.index') }}">Việc làm</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.create') }}">Liên hệ</a></li>
                        {{-- <li class="nav-item ms-lg-2"><a class="btn btn-primary btn-icon" href="{{ route('careers.index') }}"><i data-lucide="search" class="icon-sm"></i>Xem việc làm</a></li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="site-main">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="row g-4 pb-4">
                <div class="col-lg-5">
                    <a class="navbar-brand text-white mb-3" href="{{ route('home') }}"><x-brand /></a>
                    <p class="mb-0 col-lg-9">Kết nối con người phù hợp với cơ hội phù hợp, hướng đến một môi trường làm việc chuyên nghiệp và bền vững.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-title mb-3">Khám phá</div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('about') }}">Giới thiệu</a>
                        <a href="{{ route('careers.index') }}">Việc làm</a>
                        <a href="{{ route('contact.create') }}">Liên hệ</a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-title mb-3">Tuyển dụng</div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('careers.index') }}">Vị trí đang tuyển</a>
                        <a href="{{ route('contact.create') }}">Hỗ trợ ứng viên</a>
                        <a href="{{ route('login') }}">HR đăng nhập</a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-title mb-3">VALORA TRADING &amp; SERVICES</div>
                    <p class="small mb-0">Thông tin địa chỉ và kênh liên hệ chính thức có thể cập nhật trong phần quản trị nội dung sau khi doanh nghiệp cung cấp.</p>
                </div>
            </div>
            <div class="border-top border-secondary pt-4 d-flex flex-column flex-sm-row justify-content-between gap-2 small">
                <span>&copy; {{ now()->year }} Valora Trading &amp; Services.</span>
                <span>Recruitment Portal</span>
            </div>
        </div>
    </footer>
</body>
</html>
