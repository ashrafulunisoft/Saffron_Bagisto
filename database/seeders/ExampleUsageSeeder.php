<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductFlat;
use Webkul\Customer\Models\Customer;
use Webkul\Customer\Models\CustomerGroup;
use Webkul\Category\Models\Category;
use Webkul\User\Models\Admin;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\OrderItem;
use Webkul\Checkout\Models\Cart;
use Webkul\Checkout\Models\CartItem;

class ExampleUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Starting Example Usage Seeder...');

        // 1. Create custom customer groups
        $this->createCustomerGroups();

        // 2. Create sample customers using factory
        $this->createSampleCustomers();

        // 3. Create sample categories
        $this->createSampleCategories();

        // 4. Create sample products using factory
        $this->createSampleProducts();

        // 5. Create sample orders
        $this->createSampleOrders();

        // 6. Create sample carts
        $this->createSampleCarts();

        $this->command->info('Example Usage Seeder completed successfully!');
    }

    /**
     * Create custom customer groups
     */
    private function createCustomerGroups()
    {
        $this->command->info('Creating customer groups...');

        $groups = [
            [
                'code' => 'vip',
                'name' => 'VIP Customers',
                'is_user_defined' => 1,
            ],
            [
                'code' => 'wholesale',
                'name' => 'Wholesale Buyers',
                'is_user_defined' => 1,
            ],
            [
                'code' => 'retail',
                'name' => 'Retail Customers',
                'is_user_defined' => 1,
            ],
        ];

        foreach ($groups as $group) {
            CustomerGroup::firstOrCreate(
                ['code' => $group['code']],
                $group
            );
        }
    }

    /**
     * Create sample customers using factory
     */
    private function createSampleCustomers()
    {
        $this->command->info('Creating sample customers...');

        // Get customer groups
        $vipGroup = CustomerGroup::where('code', 'vip')->first();
        $wholesaleGroup = CustomerGroup::where('code', 'wholesale')->first();
        $retailGroup = CustomerGroup::where('code', 'retail')->first();

        // Create VIP customers
        Customer::factory()->count(5)->create([
            'customer_group_id' => $vipGroup->id,
        ]);

        // Create wholesale customers
        Customer::factory()->count(10)->create([
            'customer_group_id' => $wholesaleGroup->id,
        ]);

        // Create retail customers
        Customer::factory()->count(20)->create([
            'customer_group_id' => $retailGroup->id,
        ]);
    }

    /**
     * Create sample categories
     */
    private function createSampleCategories()
    {
        $this->command->info('Creating sample categories...');

        $categories = [
            [
                'code' => 'electronics',
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'subcategories' => [
                    ['code' => 'smartphones', 'name' => 'Smartphones'],
                    ['code' => 'laptops', 'name' => 'Laptops'],
                    ['code' => 'accessories', 'name' => 'Accessories'],
                ],
            ],
            [
                'code' => 'fashion',
                'name' => 'Fashion',
                'description' => 'Clothing and fashion items',
                'subcategories' => [
                    ['code' => 'mens', 'name' => 'Men\'s Fashion'],
                    ['code' => 'womens', 'name' => 'Women\'s Fashion'],
                    ['code' => 'kids', 'name' => 'Kids Fashion'],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            // Create main category
            $category = Category::firstOrCreate(
                ['code' => $categoryData['code']],
                [
                    'parent_id' => 1, // Root category
                    'position' => 1,
                    'status' => 1,
                ]
            );

            // Create translation
            $category->translations()->firstOrCreate([
                'locale' => 'en',
                'category_id' => $category->id,
            ], [
                'name' => $categoryData['name'],
                'description' => $categoryData['description'],
                'url_path' => $categoryData['code'],
                'slug' => $categoryData['code'],
            ]);

            // Create subcategories
            foreach ($categoryData['subcategories'] as $subData) {
                $subCategory = Category::firstOrCreate(
                    ['code' => $subData['code']],
                    [
                        'parent_id' => $category->id,
                        'position' => 1,
                        'status' => 1,
                    ]
                );

                $subCategory->translations()->firstOrCreate([
                    'locale' => 'en',
                    'category_id' => $subCategory->id,
                ], [
                    'name' => $subData['name'],
                    'url_path' => $categoryData['code'] . '/' . $subData['code'],
                    'slug' => $subData['code'],
                ]);
            }
        }
    }

    /**
     * Create sample products using factory
     */
    private function createSampleProducts()
    {
        $this->command->info('Creating sample products...');

        // Get categories
        $smartphonesCategory = Category::where('code', 'smartphones')->first();
        $laptopsCategory = Category::where('code', 'laptops')->first();
        $mensCategory = Category::where('code', 'mens')->first();

        // Create smartphones
        for ($i = 1; $i <= 10; $i++) {
            $product = Product::factory()->create([
                'sku' => 'PHONE-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'attribute_family_id' => 1,
                'type' => 'simple',
            ]);

            // Create product flat data
            ProductFlat::create([
                'product_id' => $product->id,
                'locale' => 'en',
                'channel_id' => 1,
                'name' => "Smartphone Model {$i}",
                'url_key' => "smartphone-model-{$i}",
                'short_description' => "High-quality smartphone model {$i} with advanced features",
                'description' => "This is smartphone model {$i} with amazing features and specifications.",
                'price' => rand(299, 999),
                'status' => 1,
                'featured' => $i <= 3, // First 3 are featured
                'new' => $i <= 5, // First 5 are new
            ]);

            // Attach to category
            $product->categories()->attach($smartphonesCategory->id);
        }

        // Create laptops
        for ($i = 1; $i <= 8; $i++) {
            $product = Product::factory()->create([
                'sku' => 'LAPTOP-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'attribute_family_id' => 1,
                'type' => 'simple',
            ]);

            ProductFlat::create([
                'product_id' => $product->id,
                'locale' => 'en',
                'channel_id' => 1,
                'name' => "Laptop Model {$i}",
                'url_key' => "laptop-model-{$i}",
                'short_description' => "Powerful laptop model {$i} for professionals",
                'description' => "Professional laptop model {$i} with high performance specifications.",
                'price' => rand(799, 2499),
                'status' => 1,
                'featured' => $i <= 2,
            ]);

            $product->categories()->attach($laptopsCategory->id);
        }

        // Create men's fashion items
        for ($i = 1; $i <= 15; $i++) {
            $product = Product::factory()->create([
                'sku' => 'MENS-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'attribute_family_id' => 1,
                'type' => 'simple',
            ]);

            ProductFlat::create([
                'product_id' => $product->id,
                'locale' => 'en',
                'channel_id' => 1,
                'name' => "Men's Fashion Item {$i}",
                'url_key' => "mens-fashion-item-{$i}",
                'short_description' => "Stylish men's fashion item {$i}",
                'description' => "Trendy men's fashion item {$i} made from premium materials.",
                'price' => rand(29, 199),
                'status' => 1,
            ]);

            $product->categories()->attach($mensCategory->id);
        }
    }

    /**
     * Create sample orders
     */
    private function createSampleOrders()
    {
        $this->command->info('Creating sample orders...');

        $customers = Customer::take(10)->get();
        $products = Product::take(20)->get();

        foreach ($customers as $customer) {
            // Create 1-3 orders per customer
            $orderCount = rand(1, 3);

            for ($i = 1; $i <= $orderCount; $i++) {
                $order = Order::factory()->create([
                    'customer_id' => $customer->id,
                    'customer_email' => $customer->email,
                    'customer_first_name' => $customer->first_name,
                    'customer_last_name' => $customer->last_name,
                    'grand_total' => 0,
                    'status' => 'processing',
                ]);

                // Add 1-5 items per order
                $itemCount = rand(1, 5);
                $orderTotal = 0;

                for ($j = 1; $j <= $itemCount; $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $price = $product->product_flat->price;
                    $total = $price * $quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'sku' => $product->sku,
                        'name' => $product->product_flat->name,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total,
                        'product_type' => $product->type,
                    ]);

                    $orderTotal += $total;
                }

                // Update order total
                $order->update(['grand_total' => $orderTotal]);
            }
        }
    }

    /**
     * Create sample carts
     */
    private function createSampleCarts()
    {
        $this->command->info('Creating sample carts...');

        $customers = Customer::take(5)->get();
        $products = Product::take(10)->get();

        foreach ($customers as $customer) {
            $cart = Cart::factory()->create([
                'customer_id' => $customer->id,
                'is_guest' => 0,
                'customer_email' => $customer->email,
                'customer_first_name' => $customer->first_name,
                'customer_last_name' => $customer->last_name,
                'grand_total' => 0,
            ]);

            // Add 1-3 items to cart
            $itemCount = rand(1, 3);
            $cartTotal = 0;

            for ($i = 1; $i <= $itemCount; $i++) {
                $product = $products->random();
                $quantity = rand(1, 2);
                $price = $product->product_flat->price;
                $total = $price * $quantity;

                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'sku' => $product->sku,
                    'name' => $product->product_flat->name,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                    'product_type' => $product->type,
                ]);

                $cartTotal += $total;
            }

            $cart->update(['grand_total' => $cartTotal]);
        }
    }
}
