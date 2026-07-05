<?php

namespace App\Services\OAuth;

class SpotifyService
{
    public function redirect(string $slug)
    {
       return redirect()->away("https://music.youtube.com");
    }
}
