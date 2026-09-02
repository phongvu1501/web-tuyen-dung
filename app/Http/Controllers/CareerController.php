<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
            'department' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'employment_type' => ['nullable', 'string', 'max:50'],
        ]);

        $jobs = Job::query()
            ->with('department')
            ->acceptingApplications()
            ->filter($filters)
            ->orderByDesc('is_featured')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $locations = Job::query()
            ->acceptingApplications()
            ->select('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('careers.index', [
            'jobs' => $jobs,
            'departments' => Department::where('is_active', true)->orderBy('name')->get(),
            'locations' => $locations,
            'employmentTypes' => Job::employmentTypeOptions(),
        ]);
    }

    public function show(Job $job): View
    {
        abort_if($job->status === Job::STATUS_DRAFT, 404);

        $job->load('department');

        $relatedJobs = Job::query()
            ->with('department')
            ->acceptingApplications()
            ->where('department_id', $job->department_id)
            ->whereKeyNot($job->id)
            ->limit(3)
            ->get();

        return view('careers.show', compact('job', 'relatedJobs'));
    }
}
