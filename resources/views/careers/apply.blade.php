@extends('layouts.app')

@section('title', 'Ứng tuyển '.$job->title)

@section('content')
    <section class="page-hero py-5"><div class="container"><a class="text-white-50 btn-icon small mb-3" href="{{ route('careers.show', $job) }}"><i data-lucide="arrow-left" class="icon-sm"></i>Quay lại vị trí</a><h1 class="h2 fw-bold mb-2">Ứng tuyển {{ $job->title }}</h1><p class="mb-0">{{ $job->department->name }} · {{ $job->location }}</p></div></section>
    <section class="section-space section-muted">
        <div class="container">
            <div class="row justify-content-center"><div class="col-xl-9">
                <div class="form-panel">
                    <div class="mb-4"><h2 class="h4 fw-bold">Thông tin ứng viên</h2><p class="text-muted-valora mb-0">Các trường có dấu <span class="text-danger">*</span> là bắt buộc.</p></div>
                    <x-flash />
                    <form method="POST" action="{{ route('careers.apply.store', $job) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6"><label class="form-label" for="full_name">Họ và tên <span class="text-danger">*</span></label><input class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" autocomplete="name" required>@error('full_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label" for="email">Email <span class="text-danger">*</span></label><input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label" for="phone">Số điện thoại <span class="text-danger">*</span></label><input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" required>@error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-md-6"><label class="form-label" for="address">Địa chỉ</label><input class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" autocomplete="street-address">@error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-12"><label class="form-label" for="cv">CV <span class="text-danger">*</span></label><input class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv" type="file" accept=".pdf,.doc,.docx" required><div class="form-text">Định dạng PDF, DOC hoặc DOCX, tối đa 5 MB.</div>@error('cv')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                            <div class="col-12"><label class="form-label" for="cover_letter">Thư giới thiệu</label><textarea class="form-control @error('cover_letter') is-invalid @enderror" id="cover_letter" name="cover_letter" rows="7" placeholder="Chia sẻ ngắn gọn về kinh nghiệm và lý do bạn phù hợp với vị trí">{{ old('cover_letter') }}</textarea>@error('cover_letter')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-4 pt-4 border-top"><small class="text-muted-valora">Thông tin và CV chỉ được HR có thẩm quyền truy cập.</small><button class="btn btn-accent btn-icon flex-shrink-0" type="submit"><i data-lucide="send" class="icon-sm"></i>Gửi hồ sơ</button></div>
                    </form>
                </div>
            </div></div>
        </div>
    </section>
@endsection
