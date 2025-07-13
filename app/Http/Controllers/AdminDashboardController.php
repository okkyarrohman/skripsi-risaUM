<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Collection;
use App\Models\TextRequest;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $title = 'Admin - Dashboard';

        $textCollectionsCount = Collection::count();
        $audioCollectionsCount = Audio::count();
        $pendingRequestsCount = TextRequest::where('status', 'Belum Dikirim')->count();

        $rawConversionData = Audio::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $conversionData = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $conversionData->push((object)[
                'date' => $date,
                'total' => $rawConversionData[$date] ?? 0,
            ]);
        }

        return view('admin.index', compact(
            'title',
            'textCollectionsCount',
            'audioCollectionsCount',
            'pendingRequestsCount',
            'conversionData'
        ));
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
