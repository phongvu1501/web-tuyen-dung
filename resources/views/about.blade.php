@extends('layouts.app')

@section('title', 'Giới thiệu')

@section('content')

    <section class="page-hero">
        <div class="container">
            <div class="eyebrow mb-3">Về chúng tôi</div>

            <h1 class="display-5 fw-bold mb-3">
                Nơi những con người chủ động cùng nhau kiến tạo thành công
            </h1>

            <p class="lead mb-0 col-lg-8">
                VALORA TRADING &amp; SERVICES – Kết nối giá trị, kiến tạo thành công
                bằng những con người chủ động, trách nhiệm và dám tạo ra giá trị.
            </p>
        </div>

    </section>

    <section class="section-space">
        <div class="container">
            <div class="row g-5 align-items-start">

                <div class="col-lg-5" data-reveal>
                    <div class="eyebrow mb-3">
                        VALORA TRADING &amp; SERVICES
                    </div>

                    <h2 class="section-heading mb-4">
                        Doanh nghiệp được xây dựng từ những con người chủ động
                    </h2>
                </div>

                <div class="col-lg-7" data-reveal>
                    <p class="section-lead">
                        VALORA TRADING &amp; SERVICES là doanh nghiệp hoạt động trong
                        lĩnh vực Thương mại và Dịch vụ, được xây dựng với niềm tin rằng:
                        một doanh nghiệp phát triển bền vững không chỉ đến từ chiến lược
                        hay quy trình, mà bắt đầu từ chính những con người chủ động,
                        trách nhiệm và dám tạo ra giá trị.
                    </p>

                    <p class="text-muted-valora">
                        Với quy mô tinh gọn và môi trường làm việc năng động, VALORA đề cao
                        sự chủ động, minh bạch và tinh thần gắn kết. Mỗi thành viên được
                        khuyến khích đưa ra ý tưởng, chủ động giải quyết vấn đề và trực tiếp
                        đóng góp vào sự phát triển chung của doanh nghiệp.
                    </p>

                    <p class="text-muted-valora mb-0">
                        Tại VALORA, chúng tôi không đặt con người vào những khuôn mẫu
                        cứng nhắc. Bạn được trao không gian để thử sức, được tin tưởng
                        để đưa ra quyết định và được ghi nhận dựa trên kết quả thực tế.
                        Chúng tôi hướng tới một môi trường nơi mỗi cá nhân có thể phát huy
                        thế mạnh, học hỏi từ thử thách và từng bước
                        <strong>“Kiến tạo thành công”</strong> theo cách của riêng mình.
                    </p>
                </div>

            </div>
        </div>

    </section>

    <section class="section-space section-muted">
        <div class="container">

            <div class="text-center mb-5" data-reveal>
                <div class="eyebrow mb-3">
                    Điều tạo nên VALORA
                </div>

                <h2 class="section-heading">
                    Những giá trị chúng tôi cùng theo đuổi
                </h2>
            </div>

            <div class="row g-4">

                @foreach ([['lightbulb', 'Chủ động', 'Không chờ được giao việc – chủ động nhìn thấy vấn đề và tìm cách giải quyết.'], ['eye', 'Minh bạch', 'Giao tiếp cởi mở, thông tin rõ ràng và đánh giá dựa trên kết quả thực tế.'], ['users', 'Gắn kết', 'Mỗi cá nhân là một mắt xích tạo nên sức mạnh của tập thể.'], ['key-round', 'Trao quyền', 'Tin tưởng nhân sự, khuyến khích sáng kiến và tạo không gian để mỗi người phát triển.']] as [$icon, $title, $copy])
                    <div class="col-md-6 col-lg-3" data-reveal>
                        <div class="content-panel h-100">

                            <div class="feature-icon mb-4">
                                <i data-lucide="{{ $icon }}"></i>
                            </div>

                            <h3 class="h5 fw-bold mb-3">
                                {{ $title }}
                            </h3>

                            <p class="text-muted-valora mb-0">
                                {{ $copy }}
                            </p>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </section>

    <section class="section-space">
        <div class="container">

            <div class="row g-5 align-items-center">

                <div class="col-lg-5" data-reveal>
                    <div class="eyebrow mb-3">
                        Môi trường tại VALORA
                    </div>

                    <h2 class="section-heading mb-4">
                        Trao không gian để mỗi người tạo ra dấu ấn riêng
                    </h2>
                </div>

                <div class="col-lg-7" data-reveal>

                    <p class="section-lead">
                        Tại VALORA, chúng tôi tin rằng mỗi người đều có khả năng tạo ra
                        những giá trị khác biệt khi được trao đúng cơ hội và sự tin tưởng.
                    </p>

                    <p class="text-muted-valora">
                        Bạn được khuyến khích đưa ra ý tưởng, thử nghiệm những cách làm mới,
                        chủ động giải quyết vấn đề và chịu trách nhiệm với kết quả của mình.
                        Những thử thách trong công việc không chỉ là khó khăn, mà còn là
                        cơ hội để mỗi thành viên học hỏi và trưởng thành.
                    </p>

                    <p class="text-muted-valora mb-0">
                        Chúng tôi hướng tới một môi trường làm việc năng động, nơi sự đóng
                        góp của mỗi cá nhân được nhìn nhận và nơi thành công của doanh nghiệp
                        được tạo nên từ sự phát triển của cả tập thể.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section class="section-space section-muted">
        <div class="container">

            <div class="row g-5 align-items-start">

                <div class="col-lg-5" data-reveal>

                    <div class="eyebrow mb-3">
                        VALORA đang tìm kiếm ai?
                    </div>

                    <h2 class="section-heading mb-4">
                        Chúng tôi tìm những người muốn tạo ra giá trị
                    </h2>

                </div>

                <div class="col-lg-7" data-reveal>

                    <p class="section-lead">
                        Chúng tôi không chỉ tìm người “làm đúng việc”.
                        Chúng tôi tìm những người muốn tạo ra giá trị.
                    </p>

                    <p class="text-muted-valora mb-4">
                        Nếu bạn là người chủ động, cầu tiến, dám thử, dám chịu trách nhiệm
                        và muốn nhìn thấy dấu ấn của mình trong sự phát triển của doanh nghiệp,
                        VALORA có thể là nơi dành cho bạn.
                    </p>

                    <div class="d-flex align-items-start gap-3 mb-4">

                        <div class="feature-icon flex-shrink-0">
                            <i data-lucide="rocket"></i>
                        </div>

                        <div>
                            <h3 class="h5 fw-bold mb-2">
                                Chủ động tạo giá trị
                            </h3>

                            <p class="text-muted-valora mb-0">
                                Không ngại bắt đầu, chủ động tìm kiếm cơ hội và biến ý tưởng
                                thành hành động thực tế.
                            </p>
                        </div>

                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">

                        <div class="feature-icon flex-shrink-0">
                            <i data-lucide="trending-up"></i>
                        </div>

                        <div>
                            <h3 class="h5 fw-bold mb-2">
                                Không ngừng phát triển
                            </h3>

                            <p class="text-muted-valora mb-0">
                                Luôn cầu tiến, sẵn sàng học hỏi và phát triển bản thân
                                qua những thử thách trong công việc.
                            </p>
                        </div>

                    </div>

                    <div class="d-flex align-items-start gap-3">

                        <div class="feature-icon flex-shrink-0">
                            <i data-lucide="badge-check"></i>
                        </div>

                        <div>
                            <h3 class="h5 fw-bold mb-2">
                                Dám chịu trách nhiệm
                            </h3>

                            <p class="text-muted-valora mb-0">
                                Cam kết với công việc, chịu trách nhiệm với quyết định
                                và cùng tập thể hướng tới kết quả tốt nhất.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="cta-band py-5">
        <div class="container py-3 text-center" data-reveal>

            <h2 class="h2 fw-bold">
                Bạn đã sẵn sàng kiến tạo thành công?
            </h2>

            <p class="text-white-50 mb-4">
                Khám phá những cơ hội nghề nghiệp tại VALORA và tìm vị trí phù hợp với bạn.
            </p>

            <a class="btn btn-accent btn-icon" href="{{ route('careers.index') }}">
                Xem việc làm
                <i data-lucide="arrow-right" class="icon-sm"></i>
            </a>

        </div>

    </section>

@endsection
