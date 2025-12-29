<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixChannelRootCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This seeder fixes the category visibility issue by updating the channel's
     * root_category_id from 1 to 2. The issue was that category ID 1 is not a root
     * category (it has parent_id = 2), but the channel was configured with
     * root_category_id = 1. This caused the frontend to return an empty category tree.
     *
     * The actual root category is ID 2 ("Test Category") which has parent_id = NULL.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Fixing channel root_category_id...');

        // Update channel ID 1's root_category_id from 1 to 2
        $updated = DB::table('channels')
            ->where('id', 1)
            ->update(['root_category_id' => 2]);

        if ($updated) {
            $this->command->info('✓ Successfully updated channel ID 1 root_category_id from 1 to 2');
        } else {
            $this->command->warn('⚠ Channel ID 1 not found or root_category_id already set to 2');
        }

        // Verify the fix
        $channel = DB::table('channels')->where('id', 1)->first();
        if ($channel) {
            $this->command->info("✓ Channel ID 1 root_category_id is now: {$channel->root_category_id}");
        }

        $this->command->info('Channel root category fix completed!');
    }
}