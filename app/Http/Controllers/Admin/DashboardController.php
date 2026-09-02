<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ContactMessage;
use App\Models\Job;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalJobs' => Job::count(),
            'activeJobs' => Job::acceptingApplications()->count(),
            'totalApplications' => Application::count(),
            'newApplications' => Application::where('status', 'new')->count(),
            'unreadContacts' => ContactMessage::whereNull('read_at')->count(),
            'recentApplications' => Application::with('job')->latest()->limit(6)->get(),
        ]);
    }
}
