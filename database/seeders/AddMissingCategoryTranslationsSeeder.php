<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\Category;
use Webkul\Category\Models\CategoryTranslation;

class AddMissingCategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This seeder adds missing English translations for categories 3-7.
     * These categories exist in the database but have no translations in the 'en' locale,
     * which causes them to display as empty in the frontend menu.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting to add missing English translations for categories 3-7...');

        // Step 1: Get the locale_id for 'en' from the locales table
        $locale = DB::table('locales')
            ->where('code', 'en')
            ->first();

        if (!$locale) {
            $this->command->error('English locale not found in the locales table!');
            return;
        }

        $localeId = $locale->id;
        $this->command->info("✓ Found English locale with ID: {$localeId}");

        // Step 2: Define the categories and their translations
        $categories = [
            3 => [
                'name' => 'Category 3',
                'slug' => 'category-3',
            ],
            4 => [
                'name' => 'Category 4',
                'slug' => 'category-4',
            ],
            5 => [
                'name' => 'Category 5',
                'slug' => 'category-5',
            ],
            6 => [
                'name' => 'Category 6',
                'slug' => 'category-6',
            ],
            7 => [
                'name' => 'Category 7',
                'slug' => 'category-7',
            ],
        ];

        $addedCount = 0;
        $skippedCount = 0;

        // Step 3: Add translations for each category
        foreach ($categories as $categoryId => $translationData) {
            // Check if the category exists
            $category = Category::find($categoryId);

            if (!$category) {
                $this->command->warn("⚠ Category ID {$categoryId} does not exist. Skipping.");
                continue;
            }

            // Check if translation already exists
            $existingTranslation = CategoryTranslation::where('category_id', $categoryId)
                ->where('locale', 'en')
                ->first();

            if ($existingTranslation) {
                $this->command->info("⏭ Translation already exists for Category ID {$categoryId} in 'en' locale. Skipping.");
                $skippedCount++;
                continue;
            }

            // Create the translation
            CategoryTranslation::create([
                'category_id' => $categoryId,
                'locale' => 'en',
                'name' => $translationData['name'],
                'slug' => $translationData['slug'],
                'description' => null,
                'meta_title' => null,
                'meta_description' => null,
                'meta_keywords' => null,
                'url_path' => $translationData['slug'],
            ]);

            $this->command->info("✓ Added translation for Category ID {$categoryId}: {$translationData['name']}");
            $addedCount++;
        }

        // Step 4: Display summary
        $this->command->info('');
        $this->command->info('=== SUMMARY ===');
        $this->command->info("✓ Added translations: {$addedCount}");
        $this->command->info("⏭ Skipped (already exist): {$skippedCount}");
        $this->command->info('');
        $this->command->info('=== VERIFICATION ===');

        // Verify the translations were added
        foreach ($categories as $categoryId => $translationData) {
            $translation = CategoryTranslation::where('category_id', $categoryId)
                ->where('locale', 'en')
                ->first();

            if ($translation) {
                $this->command->info("✓ Category ID {$categoryId}: '{$translation->name}' (slug: {$translation->slug})");
            } else {
                $this->command->warn("✗ Category ID {$categoryId}: No translation found");
            }
        }

        $this->command->info('');
        $this->command->info('Missing English translations seeder completed successfully!');
    }
}