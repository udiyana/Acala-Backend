<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GoogleAnalyticsService;
use Illuminate\Http\JsonResponse;

class CmsAnalyticsController extends Controller
{
    public function index(GoogleAnalyticsService $analyticsService): JsonResponse
    {
        $ga4Data = $analyticsService->getGa4Metrics();
        $gscData = $analyticsService->getGscMetrics();
        $isConfigured = $analyticsService->isConfigured();

        return response()->json([
            'isConfigured' => $isConfigured,
            'ga4' => $ga4Data,
            'gsc' => $gscData,
        ]);
    }
}
