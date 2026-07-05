<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Platform;
use App\Models\VisitorLog;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([

            'campaigns' => Campaign::count(),

            'platforms' => Platform::count(),

            'visitors' => VisitorLog::count(),

            'clicks' => VisitorLog::sum('clicks'),

        ]);
    }
}
