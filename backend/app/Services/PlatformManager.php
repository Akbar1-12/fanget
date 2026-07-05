<?php

namespace App\Services;

use App\Services\OAuth\SpotifyService;
use App\Services\OAuth\AppleMusicService;
use App\Services\OAuth\BoomplayService;
use App\Services\OAuth\AudiomackService;
use App\Services\OAuth\DeezerService;
use App\Services\OAuth\YoutubeService;
use InvalidArgumentException;

class PlatformManager
{
    public static function service(string $platform)
    {
        return match ($platform) {

            'spotify' => app(SpotifyService::class),

            'apple' => app(AppleMusicService::class),

            'boomplay' => app(BoomplayService::class),

            'audiomack' => app(AudiomackService::class),

            'deezer' => app(DeezerService::class),

            'youtube' => app(YoutubeService::class),

            default => throw new InvalidArgumentException(
                "Unsupported platform: {$platform}"
            ),

        };
    }
}
