<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ── Named route 'login' (safety net) ─────────────────────────────────────────
// Laravel auth middleware mencari named route 'login' saat user belum login.
// Route ini ada di sini agar tidak muncul RouteNotFoundException.
// Untuk request API → kembalikan JSON 401.
// Untuk request browser → redirect ke halaman CMS login di frontend.
Route::get('/login', function (Request $request) {
    if ($request->is('api/*') || $request->expectsJson()) {
        return response()->json([
            'message' => 'Unauthenticated. Login via POST /api/cms/login',
            'errors'  => [],
        ], 401);
    }
    // Browser langsung ke halaman CMS login (frontend SPA)
    return redirect('/cms/login');
})->name('login');

// Health check endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
});

// Serve official Acala Bar & Bistro website UI for all non-API web routes
Route::get('/{path?}', function () {
    $indexPath = public_path('index.html');
    if (file_exists($indexPath)) {
        return response()->file($indexPath, [
            'Content-Type' => 'text/html; charset=UTF-8',
        ]);
    }
    return view('welcome');
})->where('path', '^(?!api|health|up|storage).*$');
