<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect(route('admin.dashboard'));
    }

    /**
     * Display the dashboard.
     * @return View
     */
    public function dashboard(): View
    {
        return view('dashboard');
    }

}
