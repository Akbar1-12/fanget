<?php

namespace App\Http\Controllers\Api\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $campaigns = $user->campaigns();

        return response()->json([

            'campaigns' => $campaigns->count(),

            'published' => $campaigns
                ->where('published', true)
                ->count(),

            'visitors' => 0,

            'subscribers' => 0,

        ]);
    }
}
