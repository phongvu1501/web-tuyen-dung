@extends('layouts.app')

@section('title', 'Giới thiệu')

@section('content')
    <section class="page-hero">
        <div class="container"><div class="eyebrow mb-3">Về chúng tôi</div><h1 class="display-5 fw-bold mb-3">Cùng tạo ra giá trị bền vững</h1><p class="lead mb-0 col-lg-7">Valora Trading &amp; Services hướng đến một môi trường làm việc nơi con người, chất lượng phục vụ và tinh thần cải tiến cùng phát triển.</p></div>
    </section>
    <section class="section-space">
        <div class="container">
            <div class="alert alert-light border mb-5" role="note"><i data-lucide="info" class="icon-sm me-2"></i>Nội dung giới thiệu dưới đây là dữ liệu demo, không đại diện cho tuyên bố chính thức của doanh nghiệp và có thể cập nhật dễ dàng.</div>
            <div class="row g-5 align-items-start">
                <div class="col-lg-5" data-reveal><div class="eyebrow mb-3">Valora Trading &amp; Services</div><h2 class="section-heading mb-4">Doanh nghiệp được xây dựng từ những con người chủ động</h2></div>
                <div class="col-lg-7" data-reveal><p class="section-lead">Trong bản demo này, Valora được định vị là doanh nghiệp thương mại và dịch vụ chú trọng trải nghiệm khách hàng, hiệu quả vận hành và sự phát triển lâu dài của đội ngũ.</p><p class="text-muted-valora mb-0">Chúng tôi tin rằng kết quả tốt đến từ mục tiêu rõ ràng, cách làm minh bạch và khả năng phối hợp giữa nhiều chuyên môn.</p></div>
            </div>
        </div>
    </section>
    <section class="section-space section-muted">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6" data-reveal><div class="content-panel h-100"><div class="feature-icon mb-4"><i data-lucide="telescope"></i></div><h2 class="h4 fw-bold">Tầm nhìn</h2><p class="text-muted-valora mb-0">Trở thành một tổ chức thương mại và dịch vụ được tin cậy nhờ năng lực thực thi, chất lượng đội ngũ và khả năng thích ứng.</p></div></div>
                <div class="col-md-6" data-reveal><div class="content-panel h-100"><div class="feature-icon mb-4"><i data-lucide="target"></i></div><h2 class="h4 fw-bold">Sứ mệnh</h2><p class="text-muted-valora mb-0">Cung cấp giải pháp và trải nghiệm dịch vụ thiết thực, đồng thời tạo cơ hội để mỗi thành viên phát huy tốt năng lực của mình.</p></div></div>
            </div>
        </div>
    </section>
    <section class="section-space">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4" data-reveal><div class="eyebrow mb-3">Giá trị cốt lõi</div><h2 class="section-heading">Nguyên tắc định hướng cách chúng tôi làm việc</h2></div>
                <div class="col-lg-8">
                    @foreach ([['shield-check', 'Chính trực', 'Minh bạch trong cam kết, trao đổi và cách ra quyết định.'], ['handshake', 'Hợp tác', 'Tôn trọng chuyên môn và phối hợp trên tinh thần cùng giải quyết vấn đề.'], ['sparkles', 'Cải tiến', 'Luôn tìm cách đơn giản hóa, nâng chất lượng và tạo kết quả tốt hơn.'], ['heart-handshake', 'Khách hàng', 'Đặt nhu cầu thực tế và trải nghiệm bền vững vào trọng tâm.']] as [$icon, $title, $copy])
                        <div class="d-flex gap-3 pb-4 mb-4 border-bottom" data-reveal><div class="feature-icon flex-shrink-0"><i data-lucide="{{ $icon }}"></i></div><div><h3 class="h5 fw-bold">{{ $title }}</h3><p class="text-muted-valora mb-0">{{ $copy }}</p></div></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="cta-band py-5"><div class="container py-3 text-center" data-reveal><h2 class="h2 fw-bold">Tìm nơi bạn có thể tạo dấu ấn</h2><p class="text-white-50 mb-4">Xem các vị trí phù hợp với kinh nghiệm và định hướng của bạn.</p><a class="btn btn-accent btn-icon" href="{{ route('careers.index') }}">Xem việc làm<i data-lucide="arrow-right" class="icon-sm"></i></a></div></section>
@endsection
