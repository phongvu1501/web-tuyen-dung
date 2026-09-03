@extends('layouts.app')

@section('title', 'Tin tức')
@section('meta_description', 'Tin tức, câu chuyện văn hóa và góc nhìn nghề nghiệp từ Valora Trading & Services.')

@section('content')
    @php
        $articles = [
            [
                'icon' => 'sparkles',
                'category' => 'Văn hóa Valora',
                'date' => '12/08/2026',
                'title' => 'Chủ động tạo nên khác biệt trong mỗi hành trình nghề nghiệp',
                'excerpt' => 'Tại Valora, mỗi thành viên được trao không gian để thử sức, chia sẻ góc nhìn và biến sáng kiến thành giá trị thực tế.',
            ],
            [
                'icon' => 'file-check-2',
                'category' => 'Góc ứng viên',
                'date' => '05/08/2026',
                'iso_date' => '2026-08-05',
                'title' => '5 bước chuẩn bị hồ sơ nổi bật cho vị trí bạn mong muốn',
                'excerpt' => 'Một hồ sơ rõ ràng, chân thực và tập trung vào kết quả sẽ giúp bạn tạo ấn tượng tốt ngay từ vòng đầu tiên.',
            ],
            [
                'icon' => 'route',
                'category' => 'Phát triển nghề nghiệp',
                'date' => '29/07/2026',
                'iso_date' => '2026-07-29',
                'title' => 'Kết nối năng lực với cơ hội phát triển dài hạn',
                'excerpt' => 'Khám phá cách Valora đồng hành cùng nhân sự qua công việc thực tế, phản hồi cởi mở và mục tiêu rõ ràng.',
            ],
            [
                'icon' => 'handshake',
                'category' => 'Hoạt động',
                'date' => '18/07/2026',
                'iso_date' => '2026-07-18',
                'title' => 'Cùng nhau xây dựng một môi trường làm việc đáng tin cậy',
                'excerpt' => 'Sự gắn kết bắt đầu từ những trao đổi minh bạch và tinh thần sẵn sàng hỗ trợ nhau mỗi ngày.',
            ],
            [
                'icon' => 'lightbulb',
                'category' => 'Góc nhìn Valora',
                'date' => '10/07/2026',
                'iso_date' => '2026-07-10',
                'title' => 'Từ một ý tưởng nhỏ đến giá trị lớn cho khách hàng',
                'excerpt' => 'Những cải tiến bền bỉ trong công việc là nền tảng để đội ngũ tạo ra trải nghiệm tốt hơn cho khách hàng.',
            ],
        ];
    @endphp

    <section class="page-hero">
        <div class="container">
            <div class="eyebrow mb-3">Tin tức Valora</div>
            <h1 class="display-5 fw-bold mb-3">Câu chuyện, con người và những góc nhìn mới</h1>
            <p class="lead mb-0 col-lg-8">Cập nhật hoạt động tuyển dụng, văn hóa làm việc và những điều đang tạo nên hành trình phát triển tại Valora Trading &amp; Services.</p>
        </div>
    </section>

    <section class="section-space section-muted">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-3 mb-5" data-reveal>
                <div>
                    <div class="eyebrow mb-3">Mới nhất</div>
                    <h2 class="section-heading mb-0">Tin nổi bật từ Valora</h2>
                </div>
                <a class="btn btn-outline-primary btn-icon" href="{{ route('careers.index') }}">
                    Xem cơ hội việc làm
                    <i data-lucide="arrow-up-right" class="icon-sm"></i>
                </a>
            </div>

            <article class="news-featured" data-reveal>
                <div class="news-featured-media">
                    <img src="{{ asset('images/valora-team.jpg') }}" alt="Đội ngũ Valora cùng làm việc" width="960" height="640">
                </div>
                <div class="news-featured-body">
                    <div class="news-meta mb-3">
                        <span class="badge-soft">Văn hóa Valora</span>
                        <span class="news-meta-separator">•</span>
                        <time datetime="2026-08-12">12/08/2026</time>
                    </div>
                    <h2 class="h3 fw-bold mb-3">Chủ động tạo nên khác biệt trong mỗi hành trình nghề nghiệp</h2>
                    <p class="text-muted-valora mb-4">Tại Valora, mỗi thành viên được trao không gian để thử sức, chia sẻ góc nhìn và biến sáng kiến thành giá trị thực tế.</p>
                    <a class="news-read-more mt-auto" href="#tin-moi-nhat">
                        Đọc câu chuyện
                        <i data-lucide="arrow-right"></i>
                    </a>
                </div>
            </article>
        </div>
    </section>

    <section class="section-space" id="tin-moi-nhat">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 680px" data-reveal>
                <div class="eyebrow mb-3">Góc thông tin</div>
                <h2 class="section-heading mb-3">Đọc thêm từ Valora</h2>
                <p class="section-lead mb-0">Những bài viết ngắn giúp bạn hiểu hơn về đội ngũ, công việc và cơ hội đang chờ đón.</p>
            </div>

            <div class="row g-4">
                @foreach (array_slice($articles, 1) as $article)
                    <div class="col-md-6 col-xl-4" data-reveal>
                        <article class="news-card">
                            <div class="news-card-media" aria-hidden="true">
                                <i data-lucide="{{ $article['icon'] }}"></i>
                            </div>
                            <div class="news-card-body">
                                <div class="news-meta mb-3">
                                    <span>{{ $article['category'] }}</span>
                                    <span class="news-meta-separator">•</span>
                                    <time datetime="{{ $article['iso_date'] }}">{{ $article['date'] }}</time>
                                </div>
                                <h3 class="fw-bold mb-3">{{ $article['title'] }}</h3>
                                <p class="text-muted-valora mb-4">{{ $article['excerpt'] }}</p>
                                <a class="news-read-more" href="#tin-moi-nhat">
                                    Đọc thêm
                                    <i data-lucide="arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cta-band py-5">
        <div class="container py-3 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4" data-reveal>
            <div>
                <h2 class="h2 fw-bold mb-2">Sẵn sàng cho chương tiếp theo?</h2>
                <p class="mb-0 text-white-50">Tìm vị trí phù hợp và bắt đầu hành trình cùng Valora.</p>
            </div>
            <a class="btn btn-accent btn-icon flex-shrink-0" href="{{ route('careers.index') }}">
                Khám phá việc làm
                <i data-lucide="arrow-up-right" class="icon-sm"></i>
            </a>
        </div>
    </section>
@endsection
