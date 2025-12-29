<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Models\Category;
use Webkul\Category\Models\CategoryTranslation;
use Webkul\Core\Models\Channel;

class FixCategoryStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting category structure fix...');

        // Step 1: Check if category ID 2 already exists
        $category2 = Category::find(2);

        if ($category2) {
            $this->command->info('Category ID 2 already exists. Skipping creation.');
        } else {
            // Step 2: Create category ID 2 named "Test Category" as root
            $this->command->info('Creating category ID 2 "Test Category"...');

            $category2 = Category::create([
                'id' => 2,
                'parent_id' => null,
                'status' => 1,
                'position' => 1,
                'display_mode' => 'products_and_description',
                'description' => 'Test Category',
                'meta_title' => 'Test Category',
                'meta_description' => 'Test Category',
                'meta_keywords' => 'test,category',
                'additional' => null,
            ]);

            $this->command->info('Category ID 2 created successfully.');
        }

        // Step 3: Update category ID 1 to have parent_id = 2
        $this->command->info('Updating category ID 1 to be a child of category ID 2...');

        $category1 = Category::find(1);

        if ($category1) {
            $category1->update([
                'parent_id' => 2,
            ]);
            $this->command->info('Category ID 1 updated successfully.');
        } else {
            $this->command->warn('Category ID 1 not found. Skipping update.');
        }

        // Step 4: Create translations for category ID 2
        $this->command->info('Creating translations for category ID 2...');

        $locales = ['en', 'ar', 'bn', 'es', 'fa', 'fr', 'he', 'hi_IN', 'it', 'ja', 'nl', 'pl', 'pt_BR', 'ru', 'sin', 'tr', 'uk', 'zh_CN'];

        foreach ($locales as $locale) {
            $translation = CategoryTranslation::where('category_id', 2)
                ->where('locale', $locale)
                ->first();

            if (!$translation) {
                CategoryTranslation::create([
                    'category_id' => 2,
                    'locale' => $locale,
                    'name' => 'Test Category',
                    'slug' => 'test-category',
                    'description' => 'Test Category',
                    'meta_title' => 'Test Category',
                    'meta_description' => 'Test Category',
                    'meta_keywords' => 'test,category',
                    'url_path' => 'test-category',
                ]);
                $this->command->info("Translation created for locale: {$locale}");
            } else {
                $this->command->info("Translation already exists for locale: {$locale}");
            }
        }

        // Step 5: Update channel's root_category_id to 2
        $this->command->info('Updating channel root_category_id to 2...');

        $channel = Channel::first();

        if ($channel) {
            $channel->update([
                'root_category_id' => 2,
            ]);
            $this->command->info("Channel (ID: {$channel->id}) root_category_id updated to 2.");
        } else {
            $this->command->warn('No channel found. Skipping channel update.');
        }

        // Step 6: Fix the nested set structure
        $this->command->info('Fixing nested set structure...');

        try {
            Category::fixTree();
            $this->command->info('Nested set structure fixed successfully.');
        } catch (\Exception $e) {
            $this->command->error('Error fixing nested set structure: ' . $e->getMessage());
        }

        // Step 7: Display verification information
        $this->command->info('');
        $this->command->info('=== VERIFICATION ===');

        $cat1 = Category::find(1);
        $cat2 = Category::find(2);
        $channel = Channel::first();

        if ($cat2) {
            $this->command->info("Category ID 2:");
            $this->command->info("  - Name: Test Category");
            $this->command->info("  - Parent ID: " . ($cat2->parent_id ?? 'null'));
            $this->command->info("  - Status: {$cat2->status}");
            $this->command->info("  - Position: {$cat2->position}");
            $this->command->info("  - Lft: {$cat2->lft}");
            $this->command->info("  - Rgt: {$cat2->rgt}");
        }

        if ($cat1) {
            $this->command->info("Category ID 1:");
            $this->command->info("  - Parent ID: " . ($cat1->parent_id ?? 'null'));
            $this->command->info("  - Lft: {$cat1->lft}");
            $this->command->info("  - Rgt: {$cat1->rgt}");
        }

        if ($channel) {
            $this->command->info("Channel:");
            $this->command->info("  - Root Category ID: {$channel->root_category_id}");
        }

        $this->command->info('');
        $this->command->info('Category structure fix completed successfully!');
    }
}
