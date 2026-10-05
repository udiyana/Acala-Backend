<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CmsAuthController extends Controller
{
    /**
     * Maximum failed login attempts before lockout.
     * Separate from the route-level throttle (5 req/min).
     * This blocks after N consecutive failures regardless of timing.
     */
    private const MAX_ATTEMPTS = 10;

    /**
     * Lockout duration in seconds after MAX_ATTEMPTS exceeded.
     */
    private const DECAY_SECONDS = 600; // 10 minutes

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'max:72'],
        ]);

        $throttleKey = $this->throttleKey($request);

        // Hard lockout check (separate from route-level throttle)
        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            Log::warning('CMS login lockout', [
                'ip'    => $request->ip(),
                'email' => $credentials['email'],
            ]);

            return response()->json([
                'message' => "Terlalu banyak percobaan gagal. Akun dikunci sementara. Coba lagi dalam {$seconds} detik.",
            ], 429);
        }

        if (! Auth::attempt($credentials, remember: false)) {
            // Increment failure counter
            RateLimiter::hit($throttleKey, self::DECAY_SECONDS);

            $remaining = self::MAX_ATTEMPTS - RateLimiter::attempts($throttleKey);

            Log::warning('CMS login failed', [
                'ip'        => $request->ip(),
                'email'     => $credentials['email'],
                'remaining' => max(0, $remaining),
            ]);

            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // Successful login – clear lockout counter and regenerate session
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        Log::info('CMS login success', [
            'ip'    => $request->ip(),
            'email' => $credentials['email'],
            'user'  => Auth::id(),
        ]);

        return response()->json([
            'message'    => 'Login berhasil.',
            'csrf_token' => csrf_token(),
            'user'       => [
                'id'    => Auth::id(),
                'name'  => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ])->header('X-CSRF-TOKEN', csrf_token());
    }

    public function logout(Request $request): JsonResponse
    {
        Log::info('CMS logout', [
            'ip'   => $request->ip(),
            'user' => Auth::id(),
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message'    => 'Logout berhasil.',
            'csrf_token' => csrf_token(),
        ])->header('X-CSRF-TOKEN', csrf_token());
    }

    public function me(Request $request): JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['authenticated' => false], 401);
        }

        return response()->json([
            'authenticated' => true,
            'user'          => [
                'id'    => Auth::id(),
                'name'  => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ]);
    }

    /**
     * Build a unique throttle key based on email + IP address.
     * Using both prevents one user from locking another's account,
     * and prevents a single attacker from using many email addresses.
     */
    private function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower($request->string('email')) . '|' . $request->ip()
        );
    }
}
