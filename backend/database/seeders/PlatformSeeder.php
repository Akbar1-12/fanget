<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        Platform::query()->delete();

        Platform::insert([

            [
                'name' => 'Spotify',
                'slug' => 'spotify',
                'logo' => 'platforms/spotify.svg',
                'action' => 'Pre-save',
                'sort_order' => 1,
                'enabled' => true,
            ],

            [
                'name' => 'Apple Music',
                'slug' => 'apple',
                'logo' => 'platforms/apple-music.svg',
                'action' => 'Pre-add',
                'sort_order' => 2,
                'enabled' => true,
            ],

            [
                'name' => 'Boomplay',
                'slug' => 'boomplay',
                'logo' => 'platforms/boomplay.svg',
                'action' => 'Listen',
                'sort_order' => 3,
                'enabled' => true,
            ],

            [
                'name' => 'Audiomack',
                'slug' => 'audiomack',
                'logo' => 'platforms/audiomack.svg',
                'action' => 'Listen',
                'sort_order' => 4,
                'enabled' => true,
            ],

            [
                'name' => 'Deezer',
                'slug' => 'deezer',
                'logo' => 'platforms/deezer.svg',
                'action' => 'Pre-save',
                'sort_order' => 5,
                'enabled' => true,
            ],

            [
                'name' => 'YouTube Music',
                'slug' => 'youtube',
                'logo' => 'platforms/youtube-music.svg',
                'action' => 'Subscribe',
                'sort_order' => 6,
                'enabled' => true,
            ],

        ]);
    }
}
