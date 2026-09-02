<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationStatusRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $applications = Application::query()
            ->with('job')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = '%'.$request->string('keyword').'%';
                $query->where(fn ($query) => $query->where('full_name', 'like', $keyword)
                    ->orWhere('email', 'like', $keyword)
                    ->orWhere('phone', 'like', $keyword));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.applications.index', [
            'applications' => $applications,
            'statuses' => Application::statusOptions(),
        ]);
    }

    public function show(Application $application): View
    {
        $application->load('job.department');

        return view('admin.applications.show', [
            'application' => $application,
            'statuses' => Application::statusOptions(),
        ]);
    }

    public function updateStatus(ApplicationStatusRequest $request, Application $application): RedirectResponse
    {
        $application->update($request->validated());

        return back()->with('success', 'Đã cập nhật trạng thái ứng viên.');
    }

    public function viewCv(Application $application): BinaryFileResponse
    {
        abort_unless(Storage::disk('local')->exists($application->cv_path), 404);

        return response()->file(Storage::disk('local')->path($application->cv_path), [
            'Content-Type' => $application->cv_mime_type,
            'Content-Disposition' => 'inline; filename="'.addslashes($application->cv_original_name).'"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    public function downloadCv(Application $application): BinaryFileResponse
    {
        abort_unless(Storage::disk('local')->exists($application->cv_path), 404);

        return response()->download(
            Storage::disk('local')->path($application->cv_path),
            $application->cv_original_name,
            ['Content-Type' => $application->cv_mime_type, 'X-Content-Type-Options' => 'nosniff']
        );
    }

    public function destroy(Application $application): RedirectResponse
    {
        $path = $application->cv_path;
        $application->delete();
        Storage::disk('local')->delete($path);

        return to_route('admin.applications.index')->with('success', 'Đã xóa hồ sơ ứng viên.');
    }
}
