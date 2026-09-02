@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    <section class="hero">
        <div class="container d-flex align-items-center">
            <div class="hero-content" data-reveal>
                <div class="eyebrow">Careers at Valora</div>
                <h1>Cơ hội nghề nghiệp tại Valora</h1>
                <p class="hero-lead">Tìm kiếm công việc phù hợp với bạn và cùng chúng tôi tạo nên những giá trị thiết thực mỗi ngày.</p>
                <form class="hero-search row g-2" method="GET" action="{{ route('careers.index') }}">
                    <div class="col-md">
                        <label class="visually-hidden" for="hero-keyword">Từ khóa công việc</label>
                        <div class="d-flex align-items-center px-2">
                            <i data-lucide="search" class="icon-sm text-muted"></i>
                            <input class="form-control" id="hero-keyword" name="keyword" placeholder="Vị trí, phòng ban hoặc địa điểm">
                        </div>
                    </div>
                    <div class="col-md-auto"><button class="btn btn-accent btn-icon" type="submit"><i data-lucide="arrow-right" class="icon-sm"></i>Tìm việc ngay</button></div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-space">
        <div class="container">
            <div class="row align-items-center g-5" data-reveal>
                <div class="col-lg-6">
                    <div class="eyebrow mb-3">Về Valora</div>
                    <h2 class="section-heading mb-4">Một nơi để năng lực được ghi nhận và phát triển</h2>
                    <p class="section-lead mb-4">Valora Trading &amp; Services xây dựng đội ngũ trên tinh thần hợp tác, chủ động và tôn trọng giá trị của mỗi cá nhân. Nội dung doanh nghiệp trong phiên bản này là dữ liệu demo, có thể thay thế khi có thông tin chính thức.</p>
                    <a class="btn btn-outline-primary btn-icon" href="{{ route('about') }}">Tìm hiểu thêm<i data-lucide="arrow-right" class="icon-sm"></i></a>
                </div>
                <div class="col-lg-6">
                    <div class="metric-row row g-4 text-center">
                        <div class="col-6"><div class="metric-value">{{ $activeJobCount }}+</div><div class="text-muted-valora">Vị trí đang tuyển</div></div>
                        <div class="col-6"><div class="metric-value">{{ $departmentCount }}</div><div class="text-muted-valora">Phòng ban</div></div>
                        <div class="col-6"><div class="metric-value">5</div><div class="text-muted-valora">Bước ứng tuyển</div></div>
                        <div class="col-6"><div class="metric-value">1</div><div class="text-muted-valora">Đội ngũ chung mục tiêu</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-space section-muted">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-5" data-reveal>
                <div><div class="eyebrow mb-3">Cơ hội mới</div><h2 class="section-heading mb-0">Các vị trí đang tuyển</h2></div>
                <a class="btn btn-outline-primary btn-icon" href="{{ route('careers.index') }}">Xem tất cả<i data-lucide="arrow-right" class="icon-sm"></i></a>
            </div>
            @if ($featuredJobs->isNotEmpty())
                <div class="row g-4">
                    @foreach ($featuredJobs as $job)
                        <div class="col-md-6 col-xl-4" data-reveal><x-job-card :job="$job" /></div>
                    @endforeach
                </div>
            @else
                <div class="empty-state bg-white"><i data-lucide="briefcase-business"></i><h3 class="h5 mt-3">Chưa có vị trí đang tuyển</h3><p class="text-muted-valora mb-0">Vui lòng quay lại sau để xem các cơ hội mới.</p></div>
            @endif
        </div>
    </section>

    <section class="section-space">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 660px" data-reveal>
                <div class="eyebrow mb-3">Làm việc tại Valora</div>
                <h2 class="section-heading">Vì sao bạn nên đồng hành cùng chúng tôi?</h2>
            </div>
            <div class="row g-4">
                @foreach ([['users', 'Hợp tác cởi mở', 'Trao đổi minh bạch, tôn trọng góc nhìn và cùng chịu trách nhiệm về kết quả.'], ['trending-up', 'Học hỏi liên tục', 'Khuyến khích chủ động nâng cao năng lực qua công việc và phản hồi thực tế.'], ['badge-check', 'Ghi nhận xứng đáng', 'Đóng góp được nhìn nhận dựa trên hiệu quả, tinh thần phối hợp và sự tiến bộ.']] as [$icon, $title, $copy])
                    <div class="col-md-4" data-reveal><div class="feature-icon mb-4"><i data-lucide="{{ $icon }}"></i></div><h3 class="h5 fw-bold">{{ $title }}</h3><p class="text-muted-valora mb-0">{{ $copy }}</p></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-band py-5">
        <div class="container py-3 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4" data-reveal>
            <div><h2 class="h2 fw-bold mb-2">Sẵn sàng cho bước tiếp theo?</h2><p class="mb-0 text-white-50">Khám phá cơ hội và gửi hồ sơ đến Valora ngay hôm nay.</p></div>
            <a class="btn btn-accent btn-icon flex-shrink-0" href="{{ route('careers.index') }}">Khám phá việc làm<i data-lucide="arrow-up-right" class="icon-sm"></i></a>
        </div>
    </section>
@endsection
