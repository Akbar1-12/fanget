<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Campaign extends Model
{
    protected $fillable = [
        'user_id',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class)
            ->withPivot([
                'destination_url',
                'enabled',
                'clicks',
            ])
            ->withTimestamps();
    }

    public function visitors()
    {
        return $this->hasMany(VisitorLog::class);
    }
}
