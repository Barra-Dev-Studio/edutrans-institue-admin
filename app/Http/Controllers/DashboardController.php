<?php

namespace App\Http\Controllers;

use App\Services\WidgetService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $widgets = [
            'course' => WidgetService::getTotalCourse(),
            'user' => WidgetService::getTotalUser(),
            'transaction' => WidgetService::getTotalTransaction(),
            'post' => WidgetService::getTotalPost()
        ];

        return view('dashboard', compact('widgets'));
    }

    /**
     * Display a listing of the resource.
     */
    public function profile()
    {
        return view('profile');
    }
}
