<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManageJobRequest;
use App\Models\Department;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        $jobs = Job::query()
            ->with('department')
            ->withCount('applications')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('keyword'), fn ($query) => $query->where('title', 'like', '%'.$request->string('keyword').'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.jobs.index', ['jobs' => $jobs, 'statuses' => Job::statusOptions()]);
    }

    public function create(): View
    {
        return view('admin.jobs.create', $this->formData());
    }

    public function store(ManageJobRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['created_by'] = $request->user()->id;

        $job = Job::create($data);

        return to_route('admin.jobs.show', $job)->with('success', 'Đã tạo vị trí tuyển dụng.');
    }

    public function show(Job $job): View
    {
        $job->load('department', 'creator')->loadCount('applications');

        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job): View
    {
        return view('admin.jobs.edit', [...$this->formData(), 'job' => $job]);
    }

    public function update(ManageJobRequest $request, Job $job): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $job->id);
        $job->update($data);

        return to_route('admin.jobs.show', $job)->with('success', 'Đã cập nhật vị trí tuyển dụng.');
    }

    public function destroy(Job $job): RedirectResponse
    {
        $cvPaths = $job->applications()->pluck('cv_path');

        DB::transaction(fn () => $job->delete());
        Storage::disk('local')->delete($cvPaths->all());

        return to_route('admin.jobs.index')->with('success', 'Đã xóa vị trí tuyển dụng và các hồ sơ liên quan.');
    }

    public function publish(Job $job): RedirectResponse
    {
        $job->update(['status' => Job::STATUS_PUBLISHED]);

        return back()->with('success', 'Vị trí đã được xuất bản.');
    }

    public function close(Job $job): RedirectResponse
    {
        $job->update(['status' => Job::STATUS_CLOSED]);

        return back()->with('success', 'Vị trí đã được đóng tuyển dụng.');
    }

    private function formData(): array
    {
        return [
            'departments' => Department::where('is_active', true)->orderBy('name')->get(),
            'statuses' => Job::statusOptions(),
            'employmentTypes' => Job::employmentTypeOptions(),
        ];
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'vi-tri-tuyen-dung';
        $slug = $base;
        $counter = 2;

        while (Job::where('slug', $slug)->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
