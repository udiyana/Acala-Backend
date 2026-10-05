<?php

namespace Database\Seeders;

use App\Models\CmsDataset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CmsDatasetSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = __DIR__ . '/cms_datasets.json';
        if (!File::exists($jsonPath)) {
            $this->command->error("cms_datasets.json not found.");
            return;
        }

        $datasets = json_decode(File::get($jsonPath), true);
        if (!$datasets) {
            $this->command->error("Failed to parse JSON.");
            return;
        }

        $sortOrder = 10;
        foreach ($datasets as $key => $data) {
            $label = ucwords(str_replace('_', ' ', $key));

            CmsDataset::updateOrCreate(
                ['key' => $key],
                [
                    'label' => $label,
                    'description' => "Seeded dataset for $label",
                    'data' => $data,
                    'sort_order' => $sortOrder,
                    'is_published' => true,
                ]
            );

            $sortOrder += 10;
        }

        $this->command->info("Successfully seeded " . count($datasets) . " datasets.");
    }
}
