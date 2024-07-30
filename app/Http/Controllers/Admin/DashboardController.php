<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    function index(DashboardService $dashboardService)
    {
        $data = $dashboardService->getDashboardData();
        return view('admin.landing.dashboard', $data);
    }

    function optimize()
    {
        Artisan::call('optimize:clear');
        return redirect()->back()->with("success", "Website optimized successfully");
    }

    function cacheClear()
    {
        Artisan::call('cache:clear');
        return redirect()->back()->with("success", "Website cache has been cleared successfully");
    }
}
