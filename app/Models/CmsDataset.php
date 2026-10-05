<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CmsDataset extends Model
{
    protected $fillable = [
        'key',
        'label',
        'description',
        'data',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    protected static function booted(): void
    {
        $clearCache = function (CmsDataset $dataset) {
            \Illuminate\Support\Facades\Cache::forget('cms.datasets.all');
            \Illuminate\Support\Facades\Cache::forget("cms.dataset.{$dataset->key}");
            if ($dataset->key === 'site_scripts') {
                \Illuminate\Support\Facades\Cache::forget('site_scripts');
            }
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }
}
