<?php

namespace App\Http\Controllers;

use App\Models\CmsContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CmsContentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = CmsContent::query()
            ->when($request->filled('page'), fn ($query) => $query->where('page', $request->string('page')))
            ->orderBy('page')
            ->orderBy('sort_order')
            ->orderBy('section');

        return response()->json([
            'data' => $query->get(),
        ]);
    }

    public function publicPage(string $page): JsonResponse
    {
        $cacheKey = "cms.page.{$page}";

        $contents = \Illuminate\Support\Facades\Cache::rememberForever($cacheKey, function () use ($page) {
            return CmsContent::query()
                ->published()
                ->where('page', $page)
                ->orderBy('sort_order')
                ->orderBy('section')
                ->get(['section', 'label', 'eyebrow', 'title', 'subtitle', 'body', 'image', 'cta_label', 'cta_url', 'metadata']);
        });

        return response()
            ->json(['data' => $contents])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validateContent($request);
        $content = CmsContent::create($data);

        return response()->json([
            'message' => 'Content block created.',
            'data'    => $content,
        ], 201);
    }

    public function update(Request $request, CmsContent $cmsContent): JsonResponse
    {
        $data = $this->validateContent($request, $cmsContent);
        $cmsContent->update($data);

        return response()->json([
            'message' => 'Content block updated.',
            'data'    => $cmsContent->fresh(),
        ]);
    }

    public function destroy(CmsContent $cmsContent): JsonResponse
    {
        $cmsContent->delete();

        return response()->json([
            'message' => 'Content block deleted.',
        ]);
    }

    private function validateContent(Request $request, ?CmsContent $cmsContent = null): array
    {
        $page = (string) $request->input('page', $cmsContent?->page);

        return $request->validate([
            'page'       => ['required', 'string', 'max:80', 'regex:/^[a-z0-9-]+$/'],
            'section'    => [
                'required',
                'string',
                'max:80',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('cms_contents', 'section')
                    ->where(fn ($query) => $query->where('page', $page))
                    ->ignore($cmsContent?->id),
            ],
            'label'      => ['nullable', 'string', 'max:120'],
            'eyebrow'    => ['nullable', 'string', 'max:160'],
            'title'      => ['nullable', 'string', 'max:255'],
            'subtitle'   => ['nullable', 'string', 'max:1000'],
            'body'       => ['nullable', 'string'],
            'image'      => ['nullable', 'string', 'max:500'],
            'cta_label'  => ['nullable', 'string', 'max:160'],
            'cta_url'    => ['nullable', 'string', 'max:500'],
            'metadata'   => ['nullable', 'array'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_published' => ['required', 'boolean'],
        ]);
    }
}
