<?php

return [
    'application_credentials' => env('GOOGLE_APPLICATION_CREDENTIALS', storage_path('app/analytics/service-account.json')),
    'ga4_property_id' => env('GA4_PROPERTY_ID'),
    'gsc_site_url' => env('GSC_SITE_URL'),
];
