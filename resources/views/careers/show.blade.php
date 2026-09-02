@extends('layouts.app')

@section('title', $job->title)
@section('meta_description', 'Thông tin tuyển dụng '.$job->title.' tại Valora Trading & Services.')

@section('content')
    <section class="page-hero">
        <div class="container">
            <a class="text-white-50 btn-icon small mb-4" href="{{ route('careers.index') }}"><i data-lucide="arrow-left" class="icon-sm"></i>Tất cả việc làm</a>
            <div class="eyebrow mb-3">{{ $job->department->name }}</div><h1 class="display-5 fw-bold mb-4">{{ $job->title }}</h1>
            <div class="job-meta text-white-50"><span><i data-lucide="map-pin" class="icon-sm"></i>{{ $job->location }}</span><span><i data-lucide="briefcase-business" class="icon-sm"></i>{{ $job->employmentTypeLabel() }}</span><span><i data-lucide="wallet-cards" class="icon-sm"></i>{{ $job->salary ?: 'Thỏa thuận' }}</span></div>
        </div>
    </section>
    <section class="section-space">
        <div class="container">
            <x-flash />
            <div class="row g-5">
                <div class="col-lg-8">
                    @foreach ([['Mô tả công việc', $job->description], ['Yêu cầu ứng viên', $job->requirements], ['Quyền lợi', $job->benefits]] as [$heading, $copy])
                        <section class="mb-5"><h2 class="h4 fw-bold mb-3">{{ $heading }}</h2><div class="prose-block">{{ $copy }}</div></section>
                    @endforeach
                </div>
                <div class="col-lg-4">
                    <aside class="job-detail-sidebar content-panel">
                        <h2 class="h5 fw-bold mb-4">Thông tin vị trí</h2>
                        <dl class="row g-3 mb-4">
                            <dt class="col-5 text-muted-valora fw-normal">Phòng ban</dt><dd class="col-7 fw-semibold">{{ $job->department->name }}</dd>
                            <dt class="col-5 text-muted-valora fw-normal">Địa điểm</dt><dd class="col-7 fw-semibold">{{ $job->location }}</dd>
                            <dt class="col-5 text-muted-valora fw-normal">Loại hình</dt><dd class="col-7 fw-semibold">{{ $job->employmentTypeLabel() }}</dd>
                            <dt class="col-5 text-muted-valora fw-normal">Kinh nghiệm</dt><dd class="col-7 fw-semibold">{{ $job->experience ?: 'Không yêu cầu' }}</dd>
                            <dt class="col-5 text-muted-valora fw-normal">Mức lương</dt><dd class="col-7 fw-semibold">{{ $job->salary ?: 'Thỏa thuận' }}</dd>
                            <dt class="col-5 text-muted-valora fw-normal">Hạn nộp</dt><dd class="col-7 fw-semibold">{{ $job->deadline?->format('d/m/Y') ?: 'Không giới hạn' }}</dd>
                        </dl>
                        @if ($job->isAcceptingApplications())
                            <a class="btn btn-accent btn-icon w-100" href="{{ route('careers.apply', $job) }}"><i data-lucide="send" class="icon-sm"></i>Ứng tuyển ngay</a>
                        @else
                            <div class="alert alert-secondary mb-0"><i data-lucide="calendar-x" class="icon-sm me-1"></i>Công việc này đã kết thúc tuyển dụng.</div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>
    @if ($relatedJobs->isNotEmpty())
        <section class="section-space section-muted"><div class="container"><h2 class="section-heading mb-4">Vị trí liên quan</h2><div class="row g-4">@foreach ($relatedJobs as $relatedJob)<div class="col-md-6 col-xl-4"><x-job-card :job="$relatedJob" /></div>@endforeach</div></div></section>
    @endif
@endsection
