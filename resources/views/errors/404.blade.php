@extends('layouts.app')
@section('title', 'Không tìm thấy trang')
@section('content')<section class="section-space section-muted"><div class="container py-lg-5"><div class="empty-state bg-white"><i data-lucide="file-question"></i><div class="eyebrow mt-4 mb-2">Lỗi 404</div><h1 class="section-heading">Không tìm thấy trang</h1><p class="text-muted-valora">Trang bạn đang tìm có thể đã được di chuyển hoặc không còn tồn tại.</p><a class="btn btn-primary" href="{{ route('home') }}">Về trang chủ</a></div></div></section>@endsection
