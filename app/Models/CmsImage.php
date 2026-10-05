<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsImage extends Model
{
    protected $fillable = [
        'key',
        'group',
        'label',
        'path',
        'alt',
    ];

    protected static function booted(): void
    {
        $clearCache = function (CmsImage $image) {
            \Illuminate\Support\Facades\Cache::forget('cms.images.all');
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }
}
