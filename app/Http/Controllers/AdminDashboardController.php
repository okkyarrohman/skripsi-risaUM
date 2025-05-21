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
}
