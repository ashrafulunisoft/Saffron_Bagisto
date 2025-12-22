<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Product\Models\Product;
use Webkul\Customer\Models\Customer;
use Webkul\Category\Models\Category;
use Webkul\User\Models\Admin;
use Webkul\Sales\Models\Order;

class BagistoUsageExample extends Seeder
{
    /**
     * Run database seeds using existing Bagisto factories and seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Using existing Bagisto factories and seeders...');

        // 1. Use existing Bagisto factories to create sample data
        $this->createSampleDataWithFactories();

        // 2. Run existing Bagisto seeders for specific modules
        $this->runExistingSeeders();

        $this->command->info('Bagisto usage example completed!');
    }

    /**
     * Create sample data using existing Bagisto factories
     */
    private function createSampleDataWithFactories()
    {
        $this->command->info('Creating data with existing Bagisto factories...');

        // Use existing ProductFactory from Webkul\Product
        $products = Product::factory()->count(10)->create();
        $this->command->info("Created {$products->count()} products using Webkul\\Product\\Models\\Product factory");

        // Use existing CustomerFactory from Webkul\Customer
        $customers = Customer::factory()->count(5)->create();
        $this->command->info("Created {$customers->count()} customers using Webkul\\Customer\\Models\\Customer factory");

        // Use existing AdminFactory from Webkul\User
        $admins = Admin::factory()->count(3)->create();
        $this->command->info("Created {$admins->count()} admins using Webkul\\User\\Models\\Admin factory");

        // Use existing CategoryFactory from Webkul\Category
        $categories = Category::factory()->count(5)->create();
        $this->command->info("Created {$categories->count()} categories using Webkul\\Category\\Models\\Category factory");

        // Create orders using existing OrderFactory from Webkul\Sales
        $orders = Order::factory()->count(15)->create();
        $this->command->info("Created {$orders->count()} orders using Webkul\\Sales\\Models\\Order factory");
    }

    /**
     * Run existing Bagisto seeders
     */
    private function runExistingSeeders()
    {
        $this->command->info('Running existing Bagisto seeders...');

        // Run core seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Core\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Core seeders (channels, currencies, locales, etc.)');

        // Run attribute seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Attribute\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Attribute seeders (attributes, families, groups, options)');

        // Run category seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Category\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Category seeders');

        // Run customer seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Customer\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Customer seeders (customer groups)');

        // Run product seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\ProductTableSeeder::class,
        ]);
        $this->command->info('Ran Product seeders (sample products)');

        // Run CMS seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\CMS\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran CMS seeders (pages)');

        // Run user seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\User\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran User seeders (admins, roles)');

        // Run inventory seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Inventory\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Inventory seeders (inventory sources)');

        // Run shop seeders
        $this->call([
            \Webkul\Installer\Database\Seeders\Shop\DatabaseSeeder::class,
        ]);
        $this->command->info('Ran Shop seeders (theme customizations)');
    }
}
