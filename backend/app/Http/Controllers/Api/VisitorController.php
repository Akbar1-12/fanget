<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\VisitorLog;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function store(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        VisitorLog::create([

            'campaign_id' => $campaign->id,

            'ip_address' => $request->ip(),

            'user_agent' => $request->userAgent(),

            'platform' => $request->input('platform'),

        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
