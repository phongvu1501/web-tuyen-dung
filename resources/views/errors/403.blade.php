@extends('layouts.app')
@section('title', 'Không có quyền truy cập')
@section('content')<section class="section-space section-muted"><div class="container py-lg-5"><div class="empty-state bg-white"><i data-lucide="shield-alert"></i><div class="eyebrow mt-4 mb-2">Lỗi 403</div><h1 class="section-heading">Không có quyền truy cập</h1><p class="text-muted-valora">Tài khoản của bạn không được phép mở nội dung này.</p><a class="btn btn-primary" href="{{ route('home') }}">Về trang chủ</a></div></div></section>@endsection
