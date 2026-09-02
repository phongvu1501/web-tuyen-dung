<?php

namespace App\Http\Middleware;

use App\Models\Job;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJobAcceptsApplications
{
    public function handle(Request $request, Closure $next): Response
    {
        $job = $request->route('job');

        if ($job instanceof Job && ! $job->isAcceptingApplications()) {
            return to_route('careers.show', $job)
                ->with('warning', 'Công việc này đã kết thúc tuyển dụng.');
        }

        return $next($request);
    }
}
