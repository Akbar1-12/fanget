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

            'name' => $this->artist_name,

            'song' => $this->song_title,

            'promo' => $this->promo,

            'artwork' => asset('storage/' . $this->artwork),

           'video' => [

    'video_id' => $this->youtube_video_id,

    'thumbnail' => $this->youtube_video_id
        ? "https://img.youtube.com/vi/{$this->youtube_video_id}/maxresdefault.jpg"
        : null,

    'channel_url' => $this->youtube_channel_url,

    'button_url' => $this->youtube_button_url,

    'button_text' => $this->youtube_button_text,

    'show' => (bool) $this->show_video,

    'autoplay' => (bool) $this->autoplay_video,

    'duration' => $this->autoplay_seconds,

],

            'platforms' => PlatformResource::collection(
                $this->platforms->sortBy('sort_order')
            ),
        ];
    }
}
