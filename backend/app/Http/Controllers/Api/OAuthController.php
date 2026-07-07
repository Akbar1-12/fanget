<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class OAuthController extends Controller
{
    public function redirect(Request $request, $platform, $slug)
    {
        $campaign = Campaign::where('slug', $slug)
            ->with('platforms')
            ->firstOrFail();

        $link = $campaign->platforms
            ->firstWhere('slug', $platform);

        if (!$link) {
            abort(404);
        }

        $link->pivot->increment('clicks');

        return redirect($link->pivot->destination_url);
    }
}
