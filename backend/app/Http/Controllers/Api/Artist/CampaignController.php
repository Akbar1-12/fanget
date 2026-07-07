<?php

namespace App\Http\Controllers\Api\Artist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\CreateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Artist Campaign List
     */
    public function index(): JsonResponse
    {
        $campaigns = auth()
            ->user()
            ->campaigns()
            ->with('platforms')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => CampaignResource::collection($campaigns),
        ]);
    }

    /**
     * Show Campaign
     */
    public function show(Campaign $campaign): JsonResponse
    {
        abort_unless(
            $campaign->user_id === auth()->id(),
            403
        );

        return response()->json([
            'success' => true,
            'data' => new CampaignResource(
                $campaign->load('platforms')
            ),
        ]);
    }

    /**
     * Create Campaign
     */
    public function store(CreateCampaignRequest $request): JsonResponse
    {
        try {

            $campaign = DB::transaction(function () use ($request) {

                $user = $request->user();

                /*
                |--------------------------------------------------------------------------
                | Generate unique slug
                |--------------------------------------------------------------------------
                */

                $slug = Str::slug(
                    $user->artist_name . '-' . $request->song_title
                );

                $originalSlug = $slug;

                $counter = 2;

                while (Campaign::where('slug', $slug)->exists()) {

                    $slug = "{$originalSlug}-{$counter}";

                    $counter++;

                }

                /*
                |--------------------------------------------------------------------------
                | Extract YouTube Video ID
                |--------------------------------------------------------------------------
                */

                $youtubeVideoId = null;

                if ($request->filled('youtube_video_url')) {

                    preg_match(
                        '/(?:youtube\.com\/.*v=|youtu\.be\/)([^&?\/]+)/',
                        $request->youtube_video_url,
                        $matches
                    );

                    $youtubeVideoId = $matches[1] ?? null;

                }

                /*
                |--------------------------------------------------------------------------
                | Upload Artwork
                |--------------------------------------------------------------------------
                */

                $artwork = $request
                    ->file('artwork')
                    ->store('artists', 'public');

                /*
                |--------------------------------------------------------------------------
                | Create Campaign
                |--------------------------------------------------------------------------
                */

                $campaign = Campaign::create([

                    'user_id' => $user->id,

                    'song_title' => $request->song_title,

                    'slug' => $slug,

                    'promo' => $request->promo,

                    'artwork' => $artwork,

                    'youtube_video_id' => $youtubeVideoId,

                    'youtube_channel_url' => $request->youtube_channel_url,

                    // Hard‑coded button text, and button URL uses channel URL
                    'youtube_button_text' => 'Subscribe',

                    'youtube_button_url' => $request->youtube_channel_url,

                    // NEW: renamed from 'show_video'
                    'show_video_buttons' => $request->boolean('show_video_buttons'),

                    'autoplay_video' => $request->boolean('autoplay_video'),

                    'autoplay_seconds' => $request->autoplay_seconds,

                    'published' => true,

                ]);

                /*
                |--------------------------------------------------------------------------
                | Attach Platforms (if provided)
                |--------------------------------------------------------------------------
                */

                if ($request->has('platforms') && !is_null($request->platforms)) {

                    $campaign->platforms()->sync(

                        collect($request->platforms)

                            ->mapWithKeys(fn ($platform) => [

                                $platform['platform_id'] => [

                                    'destination_url' => $platform['destination_url'],

                                    'enabled' => true,

                                ]

                            ])

                            ->toArray()

                    );

                }

                return $campaign->load('platforms');

            });

            return response()->json([

                'success' => true,

                'message' => 'Campaign created successfully.',

                'campaign' => new CampaignResource($campaign),

                'campaign_url' => rtrim(
                    config('app.frontend_url', env('FRONTEND_URL')),
                    '/'
                ) . '/campaign/' . $campaign->slug,

            ], 201);

        } catch (\Throwable $e) {

            Log::error($e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([

                'success' => false,

                'message' => 'Unable to create campaign.',

            ], 500);

        }
    }

    /**
     * Update Campaign
     */
    public function update(
        CreateCampaignRequest $request,
        Campaign $campaign
    ): JsonResponse {

        abort_unless(
            $campaign->user_id === auth()->id(),
            403
        );

        DB::transaction(function () use ($request, $campaign) {

            /*
            |--------------------------------------------------------------------------
            | Extract YouTube Video ID
            |--------------------------------------------------------------------------
            */

            $youtubeVideoId = null;

            if ($request->filled('youtube_video_url')) {

                preg_match(
                    '/(?:youtube\.com\/.*v=|youtu\.be\/)([^&?\/]+)/',
                    $request->youtube_video_url,
                    $matches
                );

                $youtubeVideoId = $matches[1] ?? null;

            }

            /*
            |--------------------------------------------------------------------------
            | Replace Artwork
            |--------------------------------------------------------------------------
            */

            $artwork = $campaign->artwork;

            if ($request->hasFile('artwork')) {

                Storage::disk('public')->delete($campaign->artwork);

                $artwork = $request
                    ->file('artwork')
                    ->store('artists', 'public');

            }

            /*
            |--------------------------------------------------------------------------
            | Update Campaign
            |--------------------------------------------------------------------------
            */

            $campaign->update([

                'song_title' => $request->song_title,

                'promo' => $request->promo,

                'artwork' => $artwork,

                'youtube_video_id' => $youtubeVideoId,

                'youtube_channel_url' => $request->youtube_channel_url,

                // Hard‑coded button text, and button URL uses channel URL
                'youtube_button_text' => 'Subscribe',

                'youtube_button_url' => $request->youtube_channel_url,

                // NEW: renamed from 'show_video'
                'show_video_buttons' => $request->boolean('show_video_buttons'),

                'autoplay_video' => $request->boolean('autoplay_video'),

                'autoplay_seconds' => $request->autoplay_seconds,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Sync Platforms (only if provided)
            |--------------------------------------------------------------------------
            */

            if ($request->has('platforms')) {

                $platforms = $request->platforms;

                $syncData = collect($platforms ?? [])
                    ->mapWithKeys(fn ($platform) => [
                        $platform['platform_id'] => [
                            'destination_url' => $platform['destination_url'],
                            'enabled' => true,
                        ]
                    ])
                    ->toArray();

                $campaign->platforms()->sync($syncData);

            }

        });

        return response()->json([

            'success' => true,

            'message' => 'Campaign updated successfully.',

            'campaign' => new CampaignResource(
                $campaign->fresh()->load('platforms')
            ),

        ]);
    }

    /**
     * Delete Campaign
     */
    public function destroy(Campaign $campaign): JsonResponse
    {
        abort_unless(
            $campaign->user_id === auth()->id(),
            403
        );

        Storage::disk('public')->delete($campaign->artwork);

        $campaign->delete();

        return response()->json([

            'success' => true,

            'message' => 'Campaign deleted successfully.',

        ]);
    }
}
