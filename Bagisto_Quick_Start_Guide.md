# Bagisto Seeders and Factories - Quick Start Guide

This guide shows you how to quickly start using the existing Bagisto seeders and factories in your project.

## 🚀 Quick Start Commands

### 1. Run All Bagisto Seeders
```bash
# This will populate your database with all default Bagisto data
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\DatabaseSeeder
```

### 2. Run Specific Module Seeders
```bash
# Core data (channels, currencies, locales)
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\Core\\DatabaseSeeder

# Attributes and families
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\Attribute\\DatabaseSeeder

# Categories
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\Category\\DatabaseSeeder

# Sample products
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\ProductTableSeeder

# Customer groups
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\Customer\\DatabaseSeeder

# CMS pages
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\CMS\\DatabaseSeeder

# Users and roles
php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\User\\DatabaseSeeder
```

### 3. Use Factories in Development/Tinker
```bash
# Open tinker
php artisan tinker
```

```php
// Create 10 products
$products = Webkul\Product\Models\Product::factory()->count(10)->create();

// Create 5 customers
$customers = Webkul\Customer\Models\Customer::factory()->count(5)->create();

// Create 3 categories
$categories = Webkul\Category\Models\Category::factory()->count(3)->create();

// Create products with categories
$category = Webkul\Category\Models\Category::first();
$products = Webkul\Product\Models\Product::factory()->count(5)->create();
foreach ($products as $product) {
    $product->categories()->attach($category->id);
}

// Create orders for customers
$customer = Webkul\Customer\Models\Customer::first();
$order = Webkul\Sales\Models\Order::factory()->create([
    'customer_id' => $customer->id
]);
```

## 📋 Available Bagisto Factories

### Product Factories
```php
use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductInventory;
use Webkul\Product\Models\ProductReview;

// Basic product
$product = Product::factory()->create();

// Product with inventory
$product = Product::factory()->has(ProductInventory::factory(), 'inventories')->create();

// Product with reviews
$product = Product::factory()->has(ProductReview::factory()->count(5), 'reviews')->create();
```

### Customer Factories
```php
use Webkul\Customer\Models\Customer;
use Webkul\Customer\Models\CustomerAddress;
use Webkul\Customer\Models\CustomerGroup;

// Customer
$customer = Customer::factory()->create();

// Customer with addresses
$customer = Customer::factory()->has(CustomerAddress::factory()->count(2), 'addresses')->create();

// Customer group
$group = CustomerGroup::factory()->create();
```

### Category Factories
```php
use Webkul\Category\Models\Category;
use Webkul\Category\Models\CategoryTranslation;

// Category
$category = Category::factory()->create();

// Category with translations
$category = Category::factory()->has(CategoryTranslation::factory()->count(2), 'translations')->create();
```

### Sales Factories
```php
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\OrderItem;
use Webkul\Sales\Models\Invoice;
use Webkul\Sales\Models\Shipment;

// Order
$order = Order::factory()->create();

// Order with items
$order = Order::factory()->has(OrderItem::factory()->count(3), 'items')->create();

// Invoice
$invoice = Invoice::factory()->create();

// Shipment
$shipment = Shipment::factory()->create();
```

### Checkout Factories
```php
use Webkul\Checkout\Models\Cart;
use Webkul\Checkout\Models\CartItem;

// Cart
$cart = Cart::factory()->create();

// Cart with items
$cart = Cart::factory()->has(CartItem::factory()->count(5), 'items')->create();
```

### User Factories
```php
use Webkul\User\Models\Admin;
use Webkul\User\Models\Role;

// Admin user
$admin = Admin::factory()->create();

// Role
$role = Role::factory()->create();
```

## 🛠️ Common Usage Patterns

### Pattern 1: Create Related Data
```php
// Create a complete e-commerce scenario
$category = Webkul\Category\Models\Category::factory()->create();

$products = Webkul\Product\Models\Product::factory()->count(10)->create();
foreach ($products as $product) {
    $product->categories()->attach($category->id);
}

$customers = Webkul\Customer\Models\Customer::factory()->count(20)->create();

foreach ($customers as $customer) {
    $order = Webkul\Sales\Models\Order::factory()->create([
        'customer_id' => $customer->id
    ]);
    
    Webkul\Sales\Models\OrderItem::factory()->count(rand(1, 5))->create([
        'order_id' => $order->id,
        'product_id' => $products->random()->id
    ]);
}
```

### Pattern 2: Override Factory Defaults
```php
// Create products with specific attributes
$electronics = Webkul\Product\Models\Product::factory()->count(5)->create([
    'type' => 'simple',
    'attribute_family_id' => 1,
]);

// Create customers with specific group
$vipCustomers = Webkul\Customer\Models\Customer::factory()->count(10)->create([
    'customer_group_id' => 2, // VIP group
    'status' => 1,
]);
```

### Pattern 3: Chain Factory Creation
```php
// Create complex relationships
$order = Webkul\Sales\Models\Order::factory()
    ->has(Webkul\Sales\Models\OrderItem::factory()->count(3), 'items')
    ->has(Webkul\Sales\Models\Invoice::factory(), 'invoice')
    ->has(Webkul\Sales\Models\Shipment::factory(), 'shipment')
    ->create();
```

## 🧪 Testing with Factories

### Create Test Data
```php
// In your test file
public function test_product_creation()
{
    $product = Webkul\Product\Models\Product::factory()->create([
        'sku' => 'TEST-PRODUCT-001',
        'type' => 'simple',
    ]);

    $this->assertDatabaseHas('products', [
        'sku' => 'TEST-PRODUCT-001'
    ]);
}
```

### Create Multiple Test Records
```php
public function test_customer_list()
{
    $customers = Webkul\Customer\Models\Customer::factory()->count(50)->create();

    $response = $this->get(route('admin.customers.index'));

    $response->assertStatus(200);
    $this->assertCount(50, $customers);
}
```

## 🎯 Practical Examples

### Example 1: Populate Development Database
```php
// database/seeders/DevelopmentSeeder.php
public function run()
{
    // Create categories
    $categories = Webkul\Category\Models\Category::factory()->count(5)->create();
    
    // Create products in each category
    foreach ($categories as $category) {
        Webkul\Product\Models\Product::factory()->count(10)->create()->each(function ($product) use ($category) {
            $product->categories()->attach($category->id);
        });
    }
    
    // Create customers
    Webkul\Customer\Models\Customer::factory()->count(100)->create();
    
    // Create sample orders
    Webkul\Sales\Models\Order::factory()->count(200)->create();
}
```

### Example 2: Test Data for Specific Feature
```php
// Test product search functionality
$products = Webkul\Product\Models\Product::factory()->count(20)->create([
    'status' => 1
]);

// Test with different search terms
$searchTerms = ['phone', 'laptop', 'shirt', 'shoes'];
foreach ($searchTerms as $term) {
    $results = Webkul\Product\Models\Product::where('name', 'like', "%{$term}%")->get();
    // Assert search results...
}
```

### Example 3: Performance Testing
```php
// Create large dataset for performance testing
$products = Webkul\Product\Models\Product::factory()->count(1000)->create();
$customers = Webkul\Customer\Models\Customer::factory()->count(500)->create();
$orders = Webkul\Sales\Models\Order::factory()->count(2000)->create();

// Test query performance...
```

## 📝 Best Practices

1. **Use factories for tests**: Always use factories in test cases for consistent data
2. **Use seeders for initial data**: Use seeders to populate development/staging databases
3. **Override attributes when needed**: Pass custom attributes to factory methods for specific test cases
4. **Chain relationships**: Use factory relationships to create complex data structures
5. **Clean up in tests**: Use database transactions and rollbacks in tests
6. **Use realistic data**: Create data that resembles real-world scenarios

## 🔧 Troubleshooting

### Common Issues

1. **Factory not found**: Make sure you're using the correct namespace
   ```php
   use Webkul\Product\Models\Product;  // ✅ Correct
   // use App\Models\Product;         // ❌ Wrong for Bagisto
   ```

2. **Seeder not running**: Check class names and namespaces
   ```bash
   php artisan db:seed --class=Webkul\\Installer\\Database\\Seeders\\DatabaseSeeder
   ```

3. **Missing relationships**: Make sure to attach relationships after creation
   ```php
   $product = Product::factory()->create();
   $product->categories()->attach($categoryId);  // Don't forget this!
   ```

## 📚 Additional Resources

- [Bagisto Documentation](https://bagisto.com/en/)
- [Laravel Factory Documentation](https://laravel.com/docs/eloquent-factories)
- [Laravel Seeder Documentation](https://laravel.com/docs/seeding)

---

*This guide helps you quickly get started with Bagisto's powerful seeding and factory system!*
