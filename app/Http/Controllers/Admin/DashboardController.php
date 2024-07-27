<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    function index()
    {
        return view('admin.landing.dashboard');
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
