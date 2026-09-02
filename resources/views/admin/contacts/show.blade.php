@extends('layouts.admin')

@section('title', 'Liên hệ từ '.$contact->full_name)
@section('page_title', 'Chi tiết liên hệ')

@section('content')
    <div class="mb-4"><a class="small btn-icon" href="{{ route('admin.contacts.index') }}"><i data-lucide="arrow-left" class="icon-sm"></i>Danh sách liên hệ</a><h1 class="h3 fw-bold mt-2 mb-1">Tin nhắn từ {{ $contact->full_name }}</h1><p class="text-muted-valora mb-0">Gửi lúc {{ $contact->created_at->format('d/m/Y H:i') }}</p></div>
    <div class="row g-4"><div class="col-xl-8"><div class="admin-card p-3 p-lg-4"><h2 class="h5 fw-bold mb-4">Nội dung</h2><div class="prose-block">{{ $contact->message }}</div></div></div><div class="col-xl-4"><div class="admin-card p-3 p-lg-4"><h2 class="h5 fw-bold mb-4">Thông tin người gửi</h2><div class="mb-3"><div class="small text-muted-valora">Họ và tên</div><div class="fw-semibold">{{ $contact->full_name }}</div></div><div class="mb-3"><div class="small text-muted-valora">Email</div><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></div><div><div class="small text-muted-valora">Số điện thoại</div><div>{{ $contact->phone ?: 'Không cung cấp' }}</div></div><a class="btn btn-primary btn-icon w-100 mt-4" href="mailto:{{ $contact->email }}"><i data-lucide="reply" class="icon-sm"></i>Phản hồi qua email</a></div></div></div>
@endsection
