<?php

use App\Http\Controllers\Api\CmsAnalyticsController;
use App\Http\Controllers\CmsAuthController;
use App\Http\Controllers\CmsContentController;
use App\Http\Controllers\CmsDatasetController;
use App\Http\Controllers\CmsImageController;
use App\Http\Controllers\CmsMediaController;
use Illuminate\Support\Facades\Route;

// ── CMS Auth ─────────────────────────────────────────────────────────────────
// Login is rate-limited to 5 attempts/min per IP to prevent brute-force.
// Logout and /me are throttled lightly as they are low-risk.
Route::prefix('cms')->group(function () {
    Route::post('/login', [CmsAuthController::class, 'login'])
        ->middleware('throttle:cms.login');

    Route::post('/logout', [CmsAuthController::class, 'logout'])
        ->middleware('throttle:30,1');          // 30 req/min – safety valve

    Route::get('/me', [CmsAuthController::class, 'me'])
        ->middleware('throttle:60,1');          // 60 req/min – polling guard
});

// ── CMS Public API ────────────────────────────────────────────────────────────
// Read-only, no auth. Rate-limited to 120 req/min per IP.
Route::prefix('cms')->middleware('throttle:cms.public')->group(function () {
    Route::get('/public/{page}', [CmsContentController::class, 'publicPage']);
    Route::get('/public-datasets', [CmsDatasetController::class, 'publicIndex']);
    Route::get('/public-datasets/{key}', [CmsDatasetController::class, 'publicShow']);
    Route::get('/public-images', [CmsImageController::class, 'publicIndex']);
});

// ── CMS Admin API ─────────────────────────────────────────────────────────────
// Requires Sanctum session auth. Rate-limited to 60 req/min per authenticated user.
Route::prefix('cms')
    ->middleware(['auth:sanctum', 'throttle:cms.admin'])
    ->group(function () {
        Route::get('/contents', [CmsContentController::class, 'index']);
        Route::post('/contents', [CmsContentController::class, 'store']);
        Route::put('/contents/{cmsContent}', [CmsContentController::class, 'update']);
        Route::delete('/contents/{cmsContent}', [CmsContentController::class, 'destroy']);

        Route::get('/analytics', [CmsAnalyticsController::class, 'index']);

        Route::get('/datasets', [CmsDatasetController::class, 'index']);
        Route::post('/datasets', [CmsDatasetController::class, 'store']);
        Route::put('/datasets/{cmsDataset}', [CmsDatasetController::class, 'update']);
        Route::delete('/datasets/{cmsDataset}', [CmsDatasetController::class, 'destroy']);

        Route::post('/media/upload', [CmsMediaController::class, 'upload']);

        Route::get('/images', [CmsImageController::class, 'index']);
        Route::put('/images/{key}', [CmsImageController::class, 'upsert'])
            ->where('key', '.+');
    });
