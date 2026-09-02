@extends('layouts.admin')
@section('title', 'Sửa '.$job->title)
@section('page_title', 'Chỉnh sửa việc làm')
@section('content')
    <div class="mb-4"><a class="small btn-icon" href="{{ route('admin.jobs.show', $job) }}"><i data-lucide="arrow-left" class="icon-sm"></i>Quay lại</a><h1 class="h3 fw-bold mt-2">Chỉnh sửa {{ $job->title }}</h1></div>
    <form method="POST" action="{{ route('admin.jobs.update', $job) }}">@csrf @method('PUT') @include('admin.jobs._form')</form>
@endsection
