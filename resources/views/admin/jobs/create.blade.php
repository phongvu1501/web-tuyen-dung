@extends('layouts.admin')
@section('title', 'Thêm việc làm')
@section('page_title', 'Thêm việc làm')
@section('content')
    <div class="mb-4"><a class="small btn-icon" href="{{ route('admin.jobs.index') }}"><i data-lucide="arrow-left" class="icon-sm"></i>Quay lại</a><h1 class="h3 fw-bold mt-2">Tạo vị trí tuyển dụng</h1></div>
    <form method="POST" action="{{ route('admin.jobs.store') }}">@csrf @include('admin.jobs._form')</form>
@endsection
