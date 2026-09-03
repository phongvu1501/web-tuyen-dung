<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('meta_description', 'Cơ hội nghề nghiệp tại Valora Trading & Services.')">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Cơ hội nghề nghiệp') | VALORA TRADING &amp; SERVICES
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>

<body style="--hero-image: url('{{ asset('images/valora-team.jpg') }}')">

    {{-- HEADER --}}
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg" aria-label="Điều hướng chính">

            <div class="container">

                {{-- LOGO --}}
                <a class="navbar-brand valora-brand" href="{{ route('home') }}" aria-label="VALORA TRADING & SERVICES">
                    <x-brand />
                </a>

                {{-- MOBILE MENU --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Mở menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- MENU --}}
                <div class="collapse navbar-collapse" id="mainNavbar">

                    <ul class="navbar-nav ms-auto align-items-lg-center">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">
                                Trang chủ
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">
                                Giới thiệu
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('careers.*') ? 'active' : '' }}"
                                href="{{ route('careers.index') }}">
                                Việc làm
                            </a>
                        </li>
{{-- 
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}"
                                href="{{ route('news.index') }}">
                                Tin tức
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}"
                                href="{{ route('contact.create') }}">
                                Liên hệ
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </nav>
    </header>


    {{-- MAIN --}}
    <main class="site-main">
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer class="site-footer">

        <div class="container">

            <div class="row g-4 pb-4">

                {{-- BRAND --}}
                <div class="col-lg-4">

                    <a class="footer-brand d-inline-block mb-3" href="{{ route('home') }}"
                        aria-label="VALORA TRADING & SERVICES">
                        <img src="{{ asset('images/valora-logo.png') }}" alt="VALORA TRADING & SERVICES"
                            class="valora-footer-logo" width="128" height="128" loading="lazy">
                    </a>

                    <p class="mb-0 col-lg-10">
                        Kết nối những con người chủ động với những cơ hội phù hợp,
                        cùng nhau tạo ra giá trị và kiến tạo thành công.
                    </p>

                </div>


                {{-- KHÁM PHÁ --}}
                <div class="col-6 col-lg-2">

                    <div class="footer-title mb-3">
                        Khám phá
                    </div>

                    <div class="d-grid gap-2">

                        <a href="{{ route('about') }}">
                            Giới thiệu
                        </a>

                        <a href="{{ route('careers.index') }}">
                            Việc làm
                        </a>

                        {{-- <a href="{{ route('news.index') }}">
                            Tin tức
                        </a> --}}

                        <a href="{{ route('contact.create') }}">
                            Liên hệ
                        </a>

                    </div>

                </div>


                {{-- TUYỂN DỤNG --}}
                <div class="col-6 col-lg-2">

                    <div class="footer-title mb-3">
                        Tuyển dụng
                    </div>

                    <div class="d-grid gap-2">

                        <a href="{{ route('careers.index') }}">
                            Vị trí đang tuyển
                        </a>

                        <a href="{{ route('contact.create') }}">
                            Hỗ trợ ứng viên
                        </a>

                        {{-- <a href="{{ route('login') }}">
                            HR đăng nhập
                        </a> --}}

                    </div>

                </div>


                {{-- THÔNG TIN --}}
                <div class="col-lg-4">

                    <div class="footer-title mb-3">
                        Thông tin liên hệ
                    </div>

                    <address class="footer-contact-list mb-0">
                        <div class="footer-contact-item">
                            <i data-lucide="map-pin" class="footer-contact-icon"></i>
                            <span>Tầng 28, tòa nhà Handico, KĐT mới Mễ Trì Hạ, Nam Từ Liêm, Hà Nội</span>
                        </div>

                        <a class="footer-contact-item" href="tel:+842437875555">
                            <i data-lucide="phone" class="footer-contact-icon"></i>
                            <span>024.3787.5555</span>
                        </a>

                        <a class="footer-contact-item" href="mailto:hr@valorats.vn">
                            <i data-lucide="mail" class="footer-contact-icon"></i>
                            <span>hr@valorats.vn</span>
                        </a>

                        <a class="footer-contact-item" href="https://web-tuyen-dung-production-2c78.up.railway.app/" target="_blank" rel="noopener noreferrer">
                            <i data-lucide="globe-2" class="footer-contact-icon"></i>
                            <span>web-tuyen-dung-production-2c78.up.railway.app</span>
                        </a>
                    </address>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <div
                class="border-top border-secondary pt-4
                       d-flex flex-column flex-sm-row
                       justify-content-between gap-2 small">

                <span>
                    {{-- &copy; {{ now()->year }} --}}
                    VALORA TRADING &amp; SERVICES.
                </span>

                <span>
                    {{-- Recruitment Portal --}}
                </span>

            </div>

        </div>

    </footer>

</body>

</html>
