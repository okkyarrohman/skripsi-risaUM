<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'Beranda';
        return view('landing', compact('title'));
    }

    public function about()
    {
        $title = 'Tentang Kami';
        return view('user.about', compact('title'));
    }

    public function guide()
    {
        $title = 'Panduan';
        return view('user.guide', compact('title'));
    }
}
