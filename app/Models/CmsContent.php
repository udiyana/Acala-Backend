<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    protected $fillable = [
        'page',
        'section',
        'label',
        'eyebrow',
        'title',
        'subtitle',
        'body',
        'image',
        'cta_label',
        'cta_url',
        'metadata',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
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
        static::saved(function (CmsContent $content) {
            \Illuminate\Support\Facades\Cache::forget("cms.page.{$content->page}");
        });

        static::deleted(function (CmsContent $content) {
            \Illuminate\Support\Facades\Cache::forget("cms.page.{$content->page}");
        });
    }
}
