<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CmsMediaController extends Controller
{
    /**
     * Upload an image to public storage.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:10240'], // Max 10MB
        ]);

        $file = $request->file('file');
        
        // Generate a random, safe filename
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(32) . '.' . $extension;

        // Store the file in storage/app/public/cms-media
        $path = $file->storeAs('cms-media', $filename, 'public');

        // Return the public URL
        return response()->json([
            'message' => 'File uploaded successfully',
            'url'     => Storage::url($path),
        ]);
    }
}
