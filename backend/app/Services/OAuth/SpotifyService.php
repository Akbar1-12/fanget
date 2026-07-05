<?php

namespace App\Services\OAuth;

class SpotifyService
{
    public function redirect(string $slug)
    {
        /*
         * Temporary.
         * Later this becomes the Spotify OAuth URL.
         */

        return redirect()->away(
            "https://accounts.spotify.com/authorize"
        );
    }
}
