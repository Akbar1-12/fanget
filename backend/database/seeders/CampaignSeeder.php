<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;
use App\Models\Platform;
use App\Models\User;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Campaign::query()->delete();

        $user = User::first();

        if (!$user) {
            $this->command->error('No user found. Please run UserSeeder first.');
            return;
        }

        $campaign = Campaign::create([

            'user_id' => $user->id,

            'song_title' => 'Position',

            'slug' => 'position',

            'promo' => 'Available Everywhere',

            'artwork' => 'artists/camilla.png',

            'youtube_video_id' => 'dQw4w9WgXcQ',

            'youtube_channel_url' => 'https://www.youtube.com/@CamilaCabello',

            'youtube_button_text' => 'Subscribe',

            'youtube_button_url' => 'https://www.youtube.com/@CamilaCabello',

            'show_video' => true,

            'autoplay_video' => true,

            'autoplay_seconds' => 60,

            'published' => true,

        ]);

        foreach (Platform::all() as $platform) {

            $campaign->platforms()->attach($platform->id, [

                'destination_url' => '#',

                'enabled' => true,

            ]);

        }
    }
}
