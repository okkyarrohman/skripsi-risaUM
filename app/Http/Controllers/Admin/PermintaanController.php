<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PermintaanController extends Controller
{
    public function index()
    {
        $title = "Admin - Data Permintaan";
        return view('admin.permintaan.index', compact('title')); // adjust view path as needed
    }
}

