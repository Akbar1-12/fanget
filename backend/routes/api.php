<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OAuthController;
use App\Http\Controllers\Api\PlatformController;

use App\Http\Controllers\Api\Artist\AuthController as ArtistAuthController;
use App\Http\Controllers\Api\Artist\CampaignController as ArtistCampaignController;
use App\Http\Controllers\Api\Artist\DashboardController as ArtistDashboardController;
use App\Http\Controllers\Api\VisitorController;

/*
|--------------------------------------------------------------------------
| Public APIs
|--------------------------------------------------------------------------
*/

Route::get('/campaigns/{slug}', [CampaignController::class, 'showPublic']);
Route::get('/platforms', [PlatformController::class, 'publicIndex']);
Route::get('/oauth/{platform}/{slug}', [OAuthController::class, 'redirect']);

// Visitor tracking
Route::post('/campaigns/{slug}/visit', [VisitorController::class, 'store']);

/*
|--------------------------------------------------------------------------
| API v1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
    |--------------------------------------------------------------------------
    */

    Route::post('/login', [AuthController::class, 'login']);

    /*
    |--------------------------------------------------------------------------
    | Artist Authentication
    |--------------------------------------------------------------------------
    */

    Route::prefix('artist')->group(function () {

        Route::post('/register', [ArtistAuthController::class, 'register']);
        Route::post('/login', [ArtistAuthController::class, 'login']);

        /*
        |--------------------------------------------------------------------------
        | Protected Artist Routes
        |--------------------------------------------------------------------------
        */

        Route::middleware('auth:sanctum')->group(function () {

            Route::post('/logout', [ArtistAuthController::class, 'logout']);
            Route::get('/me', [ArtistAuthController::class, 'me']);

            // Artist Dashboard
            Route::get('/dashboard', [ArtistDashboardController::class, 'index']);

            /*
            |--------------------------------------------------------------------------
            | Campaigns
            |--------------------------------------------------------------------------
            */

            Route::get('/campaigns', [ArtistCampaignController::class, 'index']);
            Route::post('/campaigns', [ArtistCampaignController::class, 'store']);
            Route::get('/campaigns/{campaign}', [ArtistCampaignController::class, 'show']);
            Route::put('/campaigns/{campaign}', [ArtistCampaignController::class, 'update']);
            Route::delete('/campaigns/{campaign}', [ArtistCampaignController::class, 'destroy']);

        });

    });

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')
        ->prefix('admin')
        ->group(function () {

            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/dashboard', [DashboardController::class, 'index']);
            Route::apiResource('campaigns', CampaignController::class);
            Route::apiResource('platforms', PlatformController::class);

        });

});
