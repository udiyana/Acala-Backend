<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
    }

    /**
     * Configure the rate limiters for the CMS routes.
     *
     * cms.login  – 5 requests / minute per IP (brute-force guard)
     * cms.admin  – 60 requests / minute per authenticated user
     * cms.public – 120 requests / minute per IP (public read API)
     */
    private function configureRateLimiting(): void
    {
        // ── CMS Login: 5 attempts per minute per IP ───────────────────────────
        RateLimiter::for('cms.login', function (Request $request) {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'message' => 'Terlalu banyak percobaan login. Coba lagi dalam beberapa menit.',
                    ], 429);
                });
        });

        // ── CMS Admin API: 60 requests per minute per authenticated user ──────
        RateLimiter::for('cms.admin', function (Request $request) {
            return Limit::perMinute(60)
                ->by(optional($request->user())->id ?: $request->ip());
        });

        // ── CMS Public API: 120 requests per minute per IP ───────────────────
        RateLimiter::for('cms.public', function (Request $request) {
            return Limit::perMinute(120)
                ->by($request->ip());
        });
    }
}
