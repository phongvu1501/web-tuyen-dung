@extends('layouts.admin')

@section('title', 'Tổng quan')
@section('page_title', 'Tổng quan')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4"><div><h1 class="h3 fw-bold mb-1">Dashboard tuyển dụng</h1><p class="text-muted-valora mb-0">Tình hình tuyển dụng hiện tại của Valora.</p></div><a class="btn btn-primary btn-icon" href="{{ route('admin.jobs.create') }}"><i data-lucide="plus" class="icon-sm"></i>Thêm việc làm</a></div>
    <div class="row g-3 mb-4">
        @foreach ([['briefcase-business', 'Tổng việc làm', $totalJobs, '#e8f2ee'], ['radio-tower', 'Việc đang tuyển', $activeJobs, '#e8f2ee'], ['users', 'Tổng ứng viên', $totalApplications, '#fff0ec'], ['user-plus', 'Ứng viên mới', $newApplications, '#fff0ec']] as [$icon, $label, $value, $background])
            <div class="col-sm-6 col-xl-3"><div class="admin-card stat-card h-100 d-flex align-items-center gap-3"><div class="stat-icon" style="background:{{ $background }}"><i data-lucide="{{ $icon }}"></i></div><div><div class="text-muted-valora small">{{ $label }}</div><div class="stat-value">{{ $value }}</div></div></div></div>
        @endforeach
    </div>
    <div class="row g-4">
        <div class="col-xl-9"><div class="admin-card"><div class="p-3 p-lg-4 border-bottom d-flex align-items-center justify-content-between"><h2 class="h5 fw-bold mb-0">Hồ sơ gần đây</h2><a class="small btn-icon" href="{{ route('admin.applications.index') }}">Xem tất cả<i data-lucide="arrow-right" class="icon-sm"></i></a></div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Ứng viên</th><th>Vị trí</th><th>Ngày nộp</th><th>Trạng thái</th><th class="text-end">Xem</th></tr></thead><tbody>@forelse ($recentApplications as $application)<tr><td><div class="fw-semibold">{{ $application->full_name }}</div><small class="text-muted-valora">{{ $application->email }}</small></td><td>{{ $application->job->title }}</td><td>{{ $application->created_at->format('d/m/Y') }}</td><td><span class="badge text-bg-light">{{ $application->statusLabel() }}</span></td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.applications.show', $application) }}" title="Xem hồ sơ" data-bs-toggle="tooltip"><i data-lucide="eye" class="icon-sm"></i></a></td></tr>@empty<tr><td colspan="5"><div class="empty-state border-0 py-5"><i data-lucide="inbox"></i><p class="mt-3 mb-0">Chưa có hồ sơ ứng tuyển.</p></div></td></tr>@endforelse</tbody></table></div></div></div>
        <div class="col-xl-3"><div class="admin-card p-4"><div class="stat-icon mb-4"><i data-lucide="mail"></i></div><div class="text-muted-valora small">Liên hệ chưa đọc</div><div class="stat-value mb-3">{{ $unreadContacts }}</div><a class="btn btn-outline-primary btn-sm w-100" href="{{ route('admin.contacts.index') }}">Mở hộp thư</a></div></div>
    </div>
@endsection
