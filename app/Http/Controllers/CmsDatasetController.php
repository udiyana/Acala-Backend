<?php

namespace App\Http\Controllers;

use App\Models\CmsDataset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CmsDatasetController extends Controller
{
    public function index(): JsonResponse
    {
        $datasets = CmsDataset::query()
            ->orderBy('sort_order')
            ->orderBy('key')
            ->get();

        return response()->json([
            'data' => $datasets,
        ]);
    }

    public function publicIndex(): JsonResponse
    {
        $datasets = \Illuminate\Support\Facades\Cache::rememberForever('cms.datasets.all', function () {
            return CmsDataset::query()
                ->published()
                ->orderBy('sort_order')
                ->orderBy('key')
                ->get(['key', 'data'])
                ->mapWithKeys(fn (CmsDataset $dataset) => [$dataset->key => $dataset->data]);
        });

        return response()
            ->json(['data' => $datasets])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function publicShow(string $key): JsonResponse
    {
        $cacheKey = "cms.dataset.{$key}";

        $datasetData = \Illuminate\Support\Facades\Cache::rememberForever($cacheKey, function () use ($key) {
            return CmsDataset::query()
                ->published()
                ->where('key', $key)
                ->firstOrFail(['data'])
                ->data;
        });

        return response()
            ->json(['data' => $datasetData])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function store(Request $request): JsonResponse
    {
        $dataset = CmsDataset::create($this->validateDataset($request));

        return response()->json([
            'message' => 'Dataset created.',
            'data'    => $dataset,
        ], 201);
    }

    public function update(Request $request, CmsDataset $cmsDataset): JsonResponse
    {
        $cmsDataset->update($this->validateDataset($request, $cmsDataset));

        return response()->json([
            'message' => 'Dataset updated.',
            'data'    => $cmsDataset->fresh(),
        ]);
    }

    public function destroy(CmsDataset $cmsDataset): JsonResponse
    {
        $cmsDataset->delete();

        return response()->json([
            'message' => 'Dataset deleted.',
        ]);
    }

    private function validateDataset(Request $request, ?CmsDataset $cmsDataset = null): array
    {
        return $request->validate([
            'key'         => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z0-9_\-\.]+$/',
                Rule::unique('cms_datasets', 'key')->ignore($cmsDataset?->id),
            ],
            'label'       => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:1000'],
            'data'        => ['required'],
            'sort_order'  => ['required', 'integer', 'min:0'],
            'is_published' => ['required', 'boolean'],
        ]);
    }
}
