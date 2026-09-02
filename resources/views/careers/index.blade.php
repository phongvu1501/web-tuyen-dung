@extends('layouts.app')

@section('title', 'Cơ hội nghề nghiệp')

@section('content')
    <section class="page-hero">
        <div class="container"><div class="eyebrow mb-3">Cơ hội nghề nghiệp</div><h1 class="display-5 fw-bold mb-3">Tìm công việc phù hợp với bạn</h1><p class="lead mb-0">Khám phá các vị trí đang mở tại Valora Trading &amp; Services.</p></div>
    </section>
    <section class="section-space section-muted">
        <div class="container">
            <x-flash />
            <form class="filter-panel mb-5" method="GET" action="{{ route('careers.index') }}">
                <div class="row g-3">
                    <div class="col-lg-4"><label class="form-label" for="keyword">Từ khóa</label><div class="input-group"><span class="input-group-text bg-white"><i data-lucide="search" class="icon-sm"></i></span><input class="form-control" id="keyword" name="keyword" value="{{ request('keyword') }}" placeholder="Tên vị trí hoặc từ khóa"></div></div>
                    <div class="col-sm-6 col-lg-2"><label class="form-label" for="department">Phòng ban</label><select class="form-select" id="department" name="department"><option value="">Tất cả</option>@foreach ($departments as $department)<option value="{{ $department->slug }}" @selected(request('department') === $department->slug)>{{ $department->name }}</option>@endforeach</select></div>
                    <div class="col-sm-6 col-lg-2"><label class="form-label" for="location">Địa điểm</label><select class="form-select" id="location" name="location"><option value="">Tất cả</option>@foreach ($locations as $location)<option value="{{ $location }}" @selected(request('location') === $location)>{{ $location }}</option>@endforeach</select></div>
                    <div class="col-sm-6 col-lg-2"><label class="form-label" for="employment_type">Loại hình</label><select class="form-select" id="employment_type" name="employment_type"><option value="">Tất cả</option>@foreach ($employmentTypes as $value => $label)<option value="{{ $value }}" @selected(request('employment_type') === $value)>{{ $label }}</option>@endforeach</select></div>
                    <div class="col-sm-6 col-lg-2 d-flex align-items-end"><button class="btn btn-primary btn-icon w-100" type="submit"><i data-lucide="list-filter" class="icon-sm"></i>Lọc việc làm</button></div>
                </div>
                @if (request()->hasAny(['keyword', 'department', 'location', 'employment_type']))
                    <div class="mt-3"><a class="small btn-icon" href="{{ route('careers.index') }}"><i data-lucide="x" class="icon-sm"></i>Xóa bộ lọc</a></div>
                @endif
            </form>

            <div class="d-flex align-items-center justify-content-between mb-4"><h2 class="h4 fw-bold mb-0">{{ $jobs->total() }} vị trí phù hợp</h2><span class="small text-muted-valora">Trang {{ $jobs->currentPage() }}/{{ max(1, $jobs->lastPage()) }}</span></div>
            @if ($jobs->isNotEmpty())
                <div class="row g-4">
                    @foreach ($jobs as $job)<div class="col-md-6 col-xl-4" data-reveal><x-job-card :job="$job" /></div>@endforeach
                </div>
                <div class="mt-5">{{ $jobs->links() }}</div>
            @else
                <div class="empty-state bg-white"><i data-lucide="search-x"></i><h2 class="h5 mt-3">Không tìm thấy việc làm</h2><p class="text-muted-valora">Thử thay đổi từ khóa hoặc bộ lọc để xem thêm cơ hội.</p><a class="btn btn-outline-primary" href="{{ route('careers.index') }}">Xem tất cả việc làm</a></div>
            @endif
        </div>
    </section>
@endsection
