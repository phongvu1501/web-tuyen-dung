<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class ApplicationController extends Controller
{
    public function create(Job $job): View|RedirectResponse
    {
        if (! $job->isAcceptingApplications()) {
            return to_route('careers.show', $job)
                ->with('warning', 'Công việc này đã kết thúc tuyển dụng.');
        }

        return view('careers.apply', compact('job'));
    }

    public function store(ApplicationRequest $request, Job $job): RedirectResponse
    {
        if (! $job->isAcceptingApplications()) {
            return to_route('careers.show', $job)
                ->with('warning', 'Công việc này đã kết thúc tuyển dụng.');
        }

        $cv = $request->file('cv');
        $path = null;

        try {
            $application = DB::transaction(function () use ($request, $job, $cv, &$path) {
                $path = $cv->store('applications/cvs', 'local');

                if (! $path) {
                    throw new \RuntimeException('Không thể lưu tệp CV.');
                }

                return Application::create([
                    ...$request->safe()->except('cv'),
                    'job_id' => $job->id,
                    'cv_path' => $path,
                    'cv_original_name' => $cv->getClientOriginalName(),
                    'cv_mime_type' => $cv->getMimeType() ?: 'application/octet-stream',
                    'status' => 'new',
                ]);
            });
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('local')->delete($path);
            }

            report($exception);

            return back()->withInput()->with('error', 'Không thể gửi hồ sơ lúc này. Vui lòng thử lại.');
        }

        return to_route('applications.success')->with('application_success', [
            'name' => $application->full_name,
            'job' => $job->title,
        ]);
    }

    public function success(): View|RedirectResponse
    {
        if (! session()->has('application_success')) {
            return to_route('careers.index');
        }

        return view('careers.success', ['submission' => session('application_success')]);
    }
}
