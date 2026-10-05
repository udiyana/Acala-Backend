<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('label');
            $table->text('description')->nullable();
            $table->json('data');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        $seedPath = database_path('seeders/data/cms_datasets.json');

        if (! File::exists($seedPath)) {
            return;
        }

        $datasets = json_decode(File::get($seedPath), true);

        if (! is_array($datasets)) {
            return;
        }

        $now = now();

        foreach ($datasets as $dataset) {
            DB::table('cms_datasets')->insert([
                'key' => $dataset['key'],
                'label' => $dataset['label'],
                'description' => $dataset['description'] ?? null,
                'data' => json_encode($dataset['data'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'sort_order' => $dataset['sort_order'] ?? 0,
                'is_published' => $dataset['is_published'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_datasets');
    }
};
