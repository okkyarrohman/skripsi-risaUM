<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AudioController extends Controller
{
    public function index()
    {
        $title = "Admin - Data Audio";
        return view('admin.audio.index', compact('title')); // adjust view path as needed
    }
}

