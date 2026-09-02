@extends('layouts.admin')

@section('title', 'Quản lý việc làm')
@section('page_title', 'Việc làm')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4"><div><h1 class="h3 fw-bold mb-1">Quản lý việc làm</h1><p class="text-muted-valora mb-0">Tạo, xuất bản và đóng các vị trí tuyển dụng.</p></div><a class="btn btn-primary btn-icon" href="{{ route('admin.jobs.create') }}"><i data-lucide="plus" class="icon-sm"></i>Thêm việc làm</a></div>
    <div class="admin-card">
        <form class="p-3 border-bottom" method="GET"><div class="row g-2"><div class="col-md"><input class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm theo tên vị trí"></div><div class="col-md-3"><select class="form-select" name="status"><option value="">Tất cả trạng thái</option>@foreach ($statuses as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select></div><div class="col-md-auto"><button class="btn btn-outline-primary btn-icon w-100" type="submit"><i data-lucide="search" class="icon-sm"></i>Tìm kiếm</button></div></div></form>
        <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Tên job</th><th>Phòng ban</th><th>Trạng thái</th><th>Deadline</th><th>Hồ sơ</th><th>Ngày tạo</th><th class="text-end">Action</th></tr></thead><tbody>
            @forelse ($jobs as $job)
                @php($badge = ['draft' => 'text-bg-secondary', 'published' => 'text-bg-success', 'closed' => 'text-bg-dark'][$job->status] ?? 'text-bg-light')
                <tr><td><a class="fw-semibold" href="{{ route('admin.jobs.show', $job) }}">{{ $job->title }}</a><div class="small text-muted-valora">{{ $job->location }}</div></td><td>{{ $job->department->name }}</td><td><span class="badge {{ $badge }}">{{ $job->statusLabel() }}</span></td><td>{{ $job->deadline?->format('d/m/Y') ?: 'Không giới hạn' }}</td><td>{{ $job->applications_count }}</td><td>{{ $job->created_at->format('d/m/Y') }}</td><td><div class="d-flex justify-content-end gap-1"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.jobs.show', $job) }}" title="Xem" data-bs-toggle="tooltip"><i data-lucide="eye" class="icon-sm"></i></a><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.jobs.edit', $job) }}" title="Sửa" data-bs-toggle="tooltip"><i data-lucide="pencil" class="icon-sm"></i></a>@if ($job->status !== 'published')<form method="POST" action="{{ route('admin.jobs.publish', $job) }}">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-success" title="Xuất bản" data-bs-toggle="tooltip"><i data-lucide="radio-tower" class="icon-sm"></i></button></form>@endif @if ($job->status !== 'closed')<form method="POST" action="{{ route('admin.jobs.close', $job) }}">@csrf @method('PATCH')<button class="btn btn-sm btn-outline-warning" title="Đóng tuyển" data-bs-toggle="tooltip"><i data-lucide="circle-stop" class="icon-sm"></i></button></form>@endif</div></td></tr>
            @empty
                <tr><td colspan="7"><div class="empty-state border-0"><i data-lucide="briefcase-business"></i><h2 class="h5 mt-3">Chưa có việc làm</h2><a class="btn btn-primary mt-2" href="{{ route('admin.jobs.create') }}">Tạo vị trí đầu tiên</a></div></td></tr>
            @endforelse
        </tbody></table></div>
        @if ($jobs->hasPages())<div class="p-3 border-top">{{ $jobs->links() }}</div>@endif
    </div>
@endsection
