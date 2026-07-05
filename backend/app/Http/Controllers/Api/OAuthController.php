<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PlatformManager;

class OAuthController extends Controller
{
    public function redirect(string $platform, string $slug)
    {
        return PlatformManager::service($platform)
        ->redirect($slug);
    }
}
