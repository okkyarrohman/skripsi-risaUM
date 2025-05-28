<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function selectLanguage()
    {
        $title = 'Pilih Bahasa';
        return view('user.select-language', compact('title'));
    }

    public function cariAudio(Request $request)
    {
        $title = 'Pilih Bahasa';
        $language = $request->query('language');
        return view('user.cari-audio', compact('language', 'title'));
    }

}
