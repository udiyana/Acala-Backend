<?php

use Illuminate\Support\Facades\Route;

// Health check endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
});

// ── CATATAN ───────────────────────────────────────────────────────────────────
// Semua API routes ada di routes/api.php (prefix /api otomatis).
// SPA catch-all dihapus karena frontend sekarang di-serve terpisah oleh Vite/CDN.
// ─────────────────────────────────────────────────────────────────────────────
