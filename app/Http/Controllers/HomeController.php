<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Job;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $featuredJobs = Job::query()
            ->with('department')
            ->acceptingApplications()
            ->orderByDesc('is_featured')
            ->latest()
            ->limit(6)
            ->get();

        return view('home', [
            'featuredJobs' => $featuredJobs,
            'activeJobCount' => Job::acceptingApplications()->count(),
            'departmentCount' => Department::where('is_active', true)->count(),
        ]);
    }
}
