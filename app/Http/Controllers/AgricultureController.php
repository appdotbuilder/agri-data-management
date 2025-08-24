<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\District;
use App\Models\Pest;
use App\Models\PestDetection;
use App\Models\Province;
use App\Models\Variety;
use Inertia\Inertia;

class AgricultureController extends Controller
{
    /**
     * Display the agriculture management dashboard.
     */
    public function index()
    {
        $statistics = [
            'provinces' => Province::count(),
            'districts' => District::count(),
            'commodities' => Commodity::count(),
            'varieties' => Variety::count(),
            'pests' => Pest::count(),
            'pest_detections' => PestDetection::count(),
            'pending_verifications' => PestDetection::where('status', 'pending')->count(),
        ];

        $recentDetections = PestDetection::with(['user', 'district', 'predictedPest'])
            ->latest()
            ->take(5)
            ->get();

        $commodities = Commodity::with(['varieties', 'pests'])->get();

        return Inertia::render('agriculture/dashboard', [
            'statistics' => $statistics,
            'recentDetections' => $recentDetections,
            'commodities' => $commodities,
        ]);
    }
}