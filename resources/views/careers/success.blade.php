@extends('layouts.app')

@section('title', 'Ứng tuyển thành công')

@section('content')
    <section class="section-space section-muted"><div class="container py-lg-5"><div class="row justify-content-center"><div class="col-lg-7"><div class="content-panel text-center py-5"><div class="feature-icon mx-auto mb-4"><i data-lucide="circle-check-big"></i></div><div class="eyebrow mb-3">Đã nhận hồ sơ</div><h1 class="section-heading mb-3">Ứng tuyển thành công!</h1><p class="section-lead mb-2">Cảm ơn {{ $submission['name'] }}.</p><p class="text-muted-valora mb-4">Hồ sơ ứng tuyển vị trí <strong>{{ $submission['job'] }}</strong> đã được gửi đến Valora.</p><div class="d-flex flex-column flex-sm-row justify-content-center gap-2"><a class="btn btn-primary" href="{{ route('careers.index') }}">Xem vị trí khác</a><a class="btn btn-outline-secondary" href="{{ route('home') }}">Về trang chủ</a></div></div></div></div></div></section>
@endsection
