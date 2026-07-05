<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [

        'artist_name',

        'song_title',

        'slug',

        'promo',

        'artwork',

        'youtube_video_id',

        'youtube_channel_url',

        'youtube_button_text',

        'youtube_button_url',

        'show_video',

        'autoplay_video',

        'autoplay_seconds',

        'release_date',

        'published',

    ];

    protected $casts = [

        'published' => 'boolean',

        'show_video' => 'boolean',

        'autoplay_video' => 'boolean',

        'release_date' => 'date',

    ];

    public function platforms()
    {
        return $this->belongsToMany(Platform::class)
            ->withPivot([
                'destination_url',
                'enabled',
            ])
            ->withTimestamps();
    }
}
