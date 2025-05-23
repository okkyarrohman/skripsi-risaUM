<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $title = 'Admin - Dashboard';
        return view('admin.index', compact('title'));
    }

    public function guideAdmin(Request $request)
    {
        $title = 'Admin - Panduan Admin';
        return view('admin.guide', compact('title'));
    }

    public function profile()
    {
        $title = 'Admin - Profile';
        return view('admin.profile', compact('title'));
    }

}
