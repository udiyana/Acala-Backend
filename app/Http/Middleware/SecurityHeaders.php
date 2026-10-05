<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds security-hardening HTTP response headers to every response.
 *
 * - X-Frame-Options: blocks clickjacking
 * - X-Content-Type-Options: blocks MIME sniffing
 * - X-XSS-Protection: legacy XSS guard for older browsers
 * - Referrer-Policy: limits referrer data leakage
 * - Permissions-Policy: restricts sensitive browser APIs
 * - Content-Security-Policy: strict policy for the SPA
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');
        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://fonts.googleapis.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "img-src 'self' data: blob: https:; " .
            "connect-src 'self'; " .
            "frame-src 'self' https://www.google.com https://maps.google.com https://www.openstreetmap.org; " .
            "object-src 'none'; " .
            "base-uri 'self';"
        );

        return $response;
    }
}
