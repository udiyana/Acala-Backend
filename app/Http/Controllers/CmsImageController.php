<?php

namespace App\Http\Controllers;

use App\Models\CmsImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsImageController extends Controller
{
    /**
     * GET all images (admin, with all fields).
     */
    public function index(): JsonResponse
    {
        $images = CmsImage::query()
            ->orderBy('group')
            ->orderBy('label')
            ->get();

        return response()->json(['data' => $images]);
    }

    /**
     * GET all images (public API).
     * Returns a key=>{ path, alt } map for frontend consumption.
     */
    public function publicIndex(): JsonResponse
    {
        $images = \Illuminate\Support\Facades\Cache::rememberForever('cms.images.all', function () {
            return CmsImage::query()
                ->orderBy('group')
                ->orderBy('label')
                ->get(['key', 'path', 'alt'])
                ->mapWithKeys(fn (CmsImage $img) => [
                    $img->key => ['path' => $img->path, 'alt' => $img->alt],
                ]);
        });

        return response()
            ->json(['data' => $images])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    /**
     * PUT /api/cms/images/{key}
     * Update alt text and/or replace the image file.
     */
    public function upsert(Request $request, string $key): JsonResponse
    {
        $request->validate([
            'alt'  => ['nullable', 'string', 'max:500'],
            'file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:10240'],
        ]);

        $image = CmsImage::where('key', $key)->firstOrFail();

        $data = ['alt' => $request->input('alt', $image->alt)];

        // If a new file was uploaded, store it and update the path
        if ($request->hasFile('file')) {
            $file      = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename  = Str::random(32) . '.' . $extension;
            $path      = $file->storeAs('cms-media', $filename, 'public');
            $data['path'] = Storage::url($path);
        }

        $image->update($data);

        return response()->json([
            'message' => 'Image updated.',
            'data'    => $image->fresh(),
        ]);
    }
}
