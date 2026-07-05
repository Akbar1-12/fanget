<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OAuthController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\Artist\AuthController as ArtistAuthController;

/*
|--------------------------------------------------------------------------
| Public APIs
|--------------------------------------------------------------------------
*/

Route::get('/campaigns/{slug}', [CampaignController::class, 'showPublic']);

Route::get('/oauth/{platform}/{slug}', [OAuthController::class, 'redirect']);

/*
|--------------------------------------------------------------------------
| API v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Authentication
    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Artist Authentication
    |--------------------------------------------------------------------------
    */

    Route::prefix('artist')->group(function () {
        Route::post('/register', [ArtistAuthController::class, 'register']);
        Route::post('/login', [ArtistAuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [ArtistAuthController::class, 'logout']);
            Route::get('/me', [ArtistAuthController::class, 'me']);
        });
    });

    // Protected Admin Routes
    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::apiResource('campaigns', CampaignController::class);
        Route::apiResource('platforms', PlatformController::class);
    });
});
