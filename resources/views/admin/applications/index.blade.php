@extends('layouts.admin')

@section('title', 'Quản lý ứng viên')
@section('page_title', 'Ứng viên')

@section('content')
    <div class="mb-4"><h1 class="h3 fw-bold mb-1">Hồ sơ ứng tuyển</h1><p class="text-muted-valora mb-0">Theo dõi và cập nhật tiến trình của từng ứng viên.</p></div>
    <div class="admin-card">
        <form class="p-3 border-bottom" method="GET"><div class="row g-2"><div class="col-md"><input class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Tên, email hoặc số điện thoại"></div><div class="col-md-3"><select class="form-select" name="status"><option value="">Tất cả trạng thái</option>@foreach ($statuses as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select></div><div class="col-md-auto"><button class="btn btn-outline-primary btn-icon w-100" type="submit"><i data-lucide="search" class="icon-sm"></i>Tìm kiếm</button></div></div></form>
        <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Ứng viên</th><th>Số điện thoại</th><th>Vị trí ứng tuyển</th><th>Ngày ứng tuyển</th><th>Trạng thái</th><th class="text-end">Action</th></tr></thead><tbody>
            @forelse ($applications as $application)
                <tr><td><a class="fw-semibold" href="{{ route('admin.applications.show', $application) }}">{{ $application->full_name }}</a><div class="small text-muted-valora">{{ $application->email }}</div></td><td>{{ $application->phone }}</td><td>{{ $application->job->title }}</td><td>{{ $application->created_at->format('d/m/Y H:i') }}</td><td><span class="badge text-bg-light">{{ $application->statusLabel() }}</span></td><td><div class="d-flex justify-content-end gap-1"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.applications.show', $application) }}" title="Xem chi tiết" data-bs-toggle="tooltip"><i data-lucide="eye" class="icon-sm"></i></a><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.applications.cv.download', $application) }}" title="Tải CV" data-bs-toggle="tooltip"><i data-lucide="download" class="icon-sm"></i></a></div></td></tr>
            @empty
                <tr><td colspan="6"><div class="empty-state border-0"><i data-lucide="users"></i><h2 class="h5 mt-3">Không có ứng viên</h2><p class="text-muted-valora mb-0">Hồ sơ mới sẽ xuất hiện tại đây.</p></div></td></tr>
            @endforelse
        </tbody></table></div>
        @if ($applications->hasPages())<div class="p-3 border-top">{{ $applications->links() }}</div>@endif
    </div>
@endsection
