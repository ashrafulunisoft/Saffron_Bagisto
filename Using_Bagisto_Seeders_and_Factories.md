# Using Bagisto Seeders and Factories

This guide explains how to use the seeders and factories found in the Bagisto Webkul packages.

## Table of Contents
1. [Running Seeders](#running-seeders)
2. [Using Factories in Tests](#using-factories-in-tests)
3. [Creating Custom Seeders](#creating-custom-seeders)
4. [Creating Custom Factories](#creating-custom-factories)
5. [Examples](#examples)

## Running Seeders

### Method 1: Via Artisan Command
```bash
# Run all seeders
php artisan db:seed

# Run a specific seeder class
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\DatabaseSeeder

# Run individual module seeders
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\Core\\DatabaseSeeder
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\ProductTableSeeder
```

### Method 2: Programmatically in Code
```php
// In a controller, command, or service
use Webkul\Installer\Database\Seeders\DatabaseSeeder;

$seeder = new DatabaseSeeder();
$seeder->run();
```

### Method 3: During Installation
Seeders are automatically run during Bagisto installation via the web installer or console commands.

## Using Factories in Tests

### Basic Factory Usage
```php
use Webkul\Product\Models\Product;
use Webkul\Customer\Models\Customer;
use Webkul\User\Models\Admin;

// Create a single product
$product = Product::factory()->create();

// Create multiple products
$products = Product::factory()->count(10)->create();

// Create a product with specific attributes
$product = Product::factory()->create([
    'sku' => 'CUSTOM-SKU-001',
    'attribute_family_id' => 1,
]);

// Create a customer
$customer = Customer::factory()->create([
    'email' => 'test@example.com',
    'first_name' => 'John',
    'last_name' => 'Doe',
]);

// Create an admin user
$admin = Admin::factory()->create([
    'email' => 'admin@example.com',
    'name' => 'Test Admin',
]);
```

### Factory Relationships
```php
// Create product with relationships
$product = Product::factory()
    ->has(ProductInventory::factory()->count(3), 'inventories')
    ->has(ProductReview::factory()->count(5), 'reviews')
    ->create();

// Create order with items
$order = Order::factory()
    ->has(OrderItem::factory()->count(3), 'items')
    ->has(OrderAddress::factory(), 'billing_address')
    ->has(OrderAddress::factory(), 'shipping_address')
    ->create();
```

### Factory States
```php
// Create products with different states
$activeProducts = Product::factory()->count(5)->active()->create();
$featuredProducts = Product::factory()->count(3)->featured()->create();
$configurableProducts = Product::factory()->count(2)->configurable()->create();
```

## Creating Custom Seeders

### Step 1: Create a New Seeder
```php
<?php
// database/seeders/CustomProductSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductFlat;
use Webkul\Category\Models\Category;

class CustomProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get or create a category
        $category = Category::firstOrCreate([
            'code' => 'custom-category'
        ], [
            'parent_id' => 1,
            'position' => 1,
            'status' => 1,
        ]);

        // Create custom products
        $products = [
            [
                'sku' => 'CUSTOM-001',
                'name' => 'Custom Product 1',
                'price' => 99.99,
                'description' => 'Description for custom product 1',
            ],
            [
                'sku' => 'CUSTOM-002',
                'name' => 'Custom Product 2',
                'price' => 149.99,
                'description' => 'Description for custom product 2',
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::factory()->create([
                'sku' => $productData['sku'],
                'attribute_family_id' => 1,
                'type' => 'simple',
            ]);

            // Create product flat data
            ProductFlat::create([
                'product_id' => $product->id,
                'locale' => 'en',
                'channel_id' => 1,
                'name' => $productData['name'],
                'url_key' => str_slug($productData['name']),
                'short_description' => $productData['description'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'status' => 1,
            ]);

            // Attach to category
            $product->categories()->attach($category->id);
        }
    }
}
```

### Step 2: Register the Seeder
```php
// database/seeders/DatabaseSeeder.php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // Core Bagisto seeders
            \Webkul\Installer\Database\Seeders\DatabaseSeeder::class,
            
            // Your custom seeders
            \Database\Seeders\CustomProductSeeder::class,
        ]);
    }
}
```

## Creating Custom Factories

### Step 1: Create a Factory
```php
<?php
// database/factories/CustomProductFactory.php

namespace Database\Factories;

use Webkul\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => 'CUSTOM-' . $this->faker->unique()->numerify('######'),
            'attribute_family_id' => 1,
            'type' => 'simple',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the product is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 1,
            ];
        });
    }

    /**
     * Indicate that the product is featured.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function featured()
    {
        return $this->state(function (array $attributes) {
            return [
                'featured' => 1,
            ];
        });
    }

    /**
     * Create product with flat data.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFlatData()
    {
        return $this->afterCreating(function (Product $product) {
            $product->product_flat()->create([
                'product_id' => $product->id,
                'locale' => 'en',
                'channel_id' => 1,
                'name' => $this->faker->words(3, true),
                'url_key' => $this->faker->unique()->slug,
                'short_description' => $this->faker->sentence,
                'description' => $this->faker->paragraph,
                'price' => $this->faker->randomFloat(2, 10, 1000),
                'status' => 1,
            ]);
        });
    }
}
```

## Examples

### Example 1: Seeding Test Data
```php
<?php
// database/seeders/TestDataSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Customer\Models\Customer;
use Webkul\Product\Models\Product;
use Webkul\Sales\Models\Order;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Create 10 customers
        $customers = Customer::factory()->count(10)->create();

        // Create 50 products
        $products = Product::factory()
            ->count(50)
            ->hasFlatData()
            ->active()
            ->create();

        // Create orders for each customer
        foreach ($customers as $customer) {
            Order::factory()
                ->count(rand(1, 5))
                ->create(['customer_id' => $customer->id]);
        }
    }
}
```

### Example 2: Test Case Using Factories
```php
<?php
// tests/Feature/ProductTest.php

namespace Tests\Feature;

use Tests\TestCase;
use Webkul\Product\Models\Product;
use Webkul\Customer\Models\Customer;
use Webkul\User\Models\Admin;

class ProductTest extends TestCase
{
    /** @test */
    public function it_can_create_a_product()
    {
        $admin = Admin::factory()->create();
        
        $productData = [
            'sku' => 'TEST-PRODUCT-001',
            'name' => 'Test Product',
            'price' => 99.99,
            'type' => 'simple',
            'attribute_family_id' => 1,
        ];

        $response = $this->actingAs($admin, 'admin')
            ->post(route('admin.products.store'), $productData);

        $this->assertDatabaseHas('products', ['sku' => 'TEST-PRODUCT-001']);
    }

    /** @test */
    public function it_can_list_products()
    {
        $products = Product::factory()->count(10)->create();

        $response = $this->get(route('shop.products.index'));

        $response->assertStatus(200);
        $response->assertSee($products->first()->name);
    }

    /** @test */
    public function customer_can_place_order()
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->withFlatData()->create();

        $orderData = [
            'customer_id' => $customer->id,
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => $product->product_flat->price,
                ]
            ],
        ];

        $response = $this->actingAs($customer, 'customer')
            ->post(route('checkout.order.store'), $orderData);

        $this->assertDatabaseHas('orders', ['customer_id' => $customer->id]);
    }
}
```

### Example 3: Custom Seeder for Categories
```php
<?php
// database/seeders/CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Category\Models\Category;
use Webkul\Category\Models\CategoryTranslation;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'code' => 'electronics',
                'name' => 'Electronics',
                'description' => 'Electronic devices and gadgets',
                'subcategories' => [
                    ['code' => 'phones', 'name' => 'Mobile Phones'],
                    ['code' => 'laptops', 'name' => 'Laptops'],
                    ['code' => 'tablets', 'name' => 'Tablets'],
                ],
            ],
            [
                'code' => 'clothing',
                'name' => 'Clothing',
                'description' => 'Fashion and apparel',
                'subcategories' => [
                    ['code' => 'mens', 'name' => 'Men\'s Clothing'],
                    ['code' => 'womens', 'name' => 'Women\'s Clothing'],
                    ['code' => 'kids', 'name' => 'Kids Clothing'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            // Create main category
            $category = Category::create([
                'code' => $categoryData['code'],
                'parent_id' => 1, // Root category
                'position' => 1,
                'status' => 1,
            ]);

            // Create translation
            CategoryTranslation::create([
                'category_id' => $category->id,
                'locale' => 'en',
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'url_path' => $categoryData['code'],
                'slug' => $categoryData['code'],
            ]);

            // Create subcategories
            foreach ($categoryData['subcategories'] as $subData) {
                $subCategory = Category::create([
                    'code' => $subData['code'],
                    'parent_id' => $category->id,
                    'position' => 1,
                    'status' => 1,
                ]);

                CategoryTranslation::create([
                    'category_id' => $subCategory->id,
                    'locale' => 'en',
                    'name' => $subData['name'],
                    'url_path' => $categoryData['code'] . '/' . $subData['code'],
                    'slug' => $subData['code'],
                ]);
            }
        }
    }
}
```

## Running Custom Code

### Execute Custom Seeder
```bash
php artisan db:seed --class=Database\\Seeders\\TestDataSeeder
```

### Run in Development
```bash
# Fresh migration with seeders
php artisan migrate:fresh --seed

# Only run specific seeder
php artisan db:seed --class=Database\\Seeders\\CategorySeeder
```

### In Tinker
```bash
php artisan tinker
```
```php
// Create test data on the fly
$products = Product::factory()->count(10)->withFlatData()->create();
$customers = Customer::factory()->count(5)->create();
```

## Best Practices

1. **Use factories for testing**: Always use factories in test cases for consistent, predictable data
2. **Create meaningful seeders**: Organize seeders by functionality and make them idempotent
3. **Use relationships**: Leverage factory relationships to create complex data structures
4. **Custom states**: Create factory states for different variations of your models
5. **Clean up**: Always clean up test data after tests run
6. **Use transactions**: Wrap test database operations in transactions for rollback

---

This guide provides a comprehensive overview of using Bagisto's seeders and factories for development, testing, and data management.
