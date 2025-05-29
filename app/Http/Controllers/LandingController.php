<?php

namespace App\Http\Controllers;

use App\Models\Audio;
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
        $language = $request->query('language', 'id'); // default ke 'id'
        return view('user.cari-audio', compact('language', 'title'));
    }

   public function hasilAudio(Request $request)
{
    $title = 'Pilih Bahasa';
    $keyword = $request->input('keyword');
    $language = $request->input('language');

    $query = \App\Models\Audio::with('collection');

    // Filter language by prefix (id-ID, en-US, etc)
    if ($language && in_array($language, ['id', 'en'])) {
        $query->where('bahasa', 'like', $language . '%');
    }

    if ($keyword) {
        $keyword = trim($keyword);

        $query->whereHas('collection', function ($q) use ($keyword, $language) {
            if ($language === 'id') {
                $q->where(function ($subQ) use ($keyword) {
                    $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                        ->orWhere('nama_penulis', 'like', "%$keyword%")
                        ->orWhere('abstrak_indo', 'like', "%$keyword%")
                        ->orWhere('kata_kunci', 'like', "%$keyword%");
                });
            } elseif ($language === 'en') {
                $q->where(function ($subQ) use ($keyword) {
                    $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                        ->orWhere('nama_penulis', 'like', "%$keyword%")
                        ->orWhere('abstrak_eng', 'like', "%$keyword%")
                        ->orWhere('kata_kunci', 'like', "%$keyword%");
                });
            } else {
                $q->where(function ($subQ) use ($keyword) {
                    $subQ->where('judul_tugas_akhir', 'like', "%$keyword%")
                        ->orWhere('nama_penulis', 'like', "%$keyword%")
                        ->orWhere('abstrak_indo', 'like', "%$keyword%")
                        ->orWhere('abstrak_eng', 'like', "%$keyword%")
                        ->orWhere('kata_kunci', 'like', "%$keyword%");
                });
            }
        });
    }

    $results = $query->paginate(10)->withQueryString();

    return view('user.hasil-audio', compact('title', 'language', 'keyword', 'results'));
}



}
