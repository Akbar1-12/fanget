<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'slug' => $this->slug,

            'name' => $this->user->artist_name,

            'song' => $this->song_title,

            'promo' => $this->promo,

            'artwork' => asset('storage/' . $this->artwork),

            /*
            |--------------------------------------------------------------------------
            | YouTube
            |--------------------------------------------------------------------------
            */

            'video' => [

                'video_id' => $this->youtube_video_id,

                'thumbnail' => $this->youtube_video_id
                    ? "https://img.youtube.com/vi/{$this->youtube_video_id}/maxresdefault.jpg"
                    : null,

                'channel_url' => $this->youtube_channel_url,

                // Subscribe button destination
                'button_url' => $this->youtube_button_url,

                // Always "Subscribe"
                'button_text' => 'Subscribe',

                // Controls whether BOTH buttons appear
                'show_buttons' => (bool) $this->show_video_buttons,

                'autoplay' => (bool) $this->autoplay_video,

                'duration' => $this->autoplay_seconds,

            ],

            /*
            |--------------------------------------------------------------------------
            | Statistics
            |--------------------------------------------------------------------------
            */

            'total_clicks' => $this->platforms->sum(
                fn ($platform) => $platform->pivot->clicks ?? 0
            ),

            /*
            |--------------------------------------------------------------------------
            | Platforms
            |--------------------------------------------------------------------------
            */

            'platforms' => PlatformResource::collection(
                $this->platforms->sortBy('sort_order')
            ),

        ];
    }
}
