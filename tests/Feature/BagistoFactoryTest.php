<?php

namespace Tests\Feature;

use Tests\TestCase;
use Webkul\Product\Models\Product;
use Webkul\Customer\Models\Customer;
use Webkul\Category\Models\Category;
use Webkul\User\Models\Admin;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\OrderItem;
use Webkul\Checkout\Models\Cart;
use Webkul\Checkout\Models\CartItem;

class BagistoFactoryTest extends TestCase
{
    /** @test */
    public function it_can_create_products_using_bagisto_factory()
    {
        // Create products using existing Bagisto ProductFactory
        $products = Product::factory()->count(5)->create();

        $this->assertCount(5, $products);
        $this->assertDatabaseHas('products', [
            'sku' => $products->first()->sku,
        ]);
    }

    /** @test */
    public function it_can_create_customers_using_bagisto_factory()
    {
        // Create customers using existing Bagisto CustomerFactory
        $customers = Customer::factory()->count(3)->create();

        $this->assertCount(3, $customers);
        $this->assertDatabaseHas('customers', [
            'email' => $customers->first()->email,
        ]);
    }

    /** @test */
    public function it_can_create_categories_using_bagisto_factory()
    {
        // Create categories using existing Bagisto CategoryFactory
        $categories = Category::factory()->count(4)->create();

        $this->assertCount(4, $categories);
        $this->assertDatabaseHas('categories', [
            'code' => $categories->first()->code,
        ]);
    }

    /** @test */
    public function it_can_create_admins_using_bagisto_factory()
    {
        // Create admins using existing Bagisto AdminFactory
        $admins = Admin::factory()->count(2)->create();

        $this->assertCount(2, $admins);
        $this->assertDatabaseHas('admins', [
            'email' => $admins->first()->email,
        ]);
    }

    /** @test */
    public function it_can_create_orders_using_bagisto_factory()
    {
        // Create orders using existing Bagisto OrderFactory
        $orders = Order::factory()->count(3)->create();

        $this->assertCount(3, $orders);
        $this->assertDatabaseHas('orders', [
            'id' => $orders->first()->id,
        ]);
    }

    /** @test */
    public function it_can_create_carts_using_bagisto_factory()
    {
        // Create carts using existing Bagisto CartFactory
        $carts = Cart::factory()->count(2)->create();

        $this->assertCount(2, $carts);
        $this->assertDatabaseHas('carts', [
            'id' => $carts->first()->id,
        ]);
    }

    /** @test */
    public function it_can_create_cart_items_using_bagisto_factory()
    {
        // Create a cart first
        $cart = Cart::factory()->create();

        // Create cart items using existing Bagisto CartItemFactory
        $cartItems = CartItem::factory()->count(3)->create([
            'cart_id' => $cart->id,
        ]);

        $this->assertCount(3, $cartItems);
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
        ]);
    }

    /** @test */
    public function it_can_create_order_items_using_bagisto_factory()
    {
        // Create an order first
        $order = Order::factory()->create();

        // Create order items using existing Bagisto OrderItemFactory
        $orderItems = OrderItem::factory()->count(2)->create([
            'order_id' => $order->id,
        ]);

        $this->assertCount(2, $orderItems);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
        ]);
    }

    /** @test */
    public function it_can_create_related_data_using_bagisto_factories()
    {
        // Create a customer with addresses
        $customer = Customer::factory()
            ->has(\Webkul\Customer\Models\CustomerAddress::factory()->count(2), 'addresses')
            ->create();

        $this->assertDatabaseHas('customers', ['id' => $customer->id]);
        $this->assertEquals(2, $customer->addresses()->count());

        // Create a category with translations
        $category = Category::factory()
            ->has(\Webkul\Category\Models\CategoryTranslation::factory()->count(2), 'translations')
            ->create();

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertEquals(2, $category->translations()->count());

        // Create an order with items
        $order = Order::factory()
            ->has(OrderItem::factory()->count(3), 'items')
            ->create();

        $this->assertDatabaseHas('orders', ['id' => $order->id]);
        $this->assertEquals(3, $order->items()->count());
    }

    /** @test */
    public function it_can_create_complex_data_structure_using_bagisto_factories()
    {
        // Create a complete e-commerce scenario
        $categories = Category::factory()->count(3)->create();

        $products = collect();
        foreach ($categories as $category) {
            $categoryProducts = Product::factory()->count(2)->create();
            foreach ($categoryProducts as $product) {
                $product->categories()->attach($category->id);
                $products->push($product);
            }
        }

        $customers = Customer::factory()->count(5)->create();

        $orders = collect();
        foreach ($customers as $customer) {
            $customerOrders = Order::factory()->count(rand(1, 3))->create([
                'customer_id' => $customer->id,
            ]);

            foreach ($customerOrders as $order) {
                $orderItems = OrderItem::factory()->count(rand(1, 3))->create([
                    'order_id' => $order->id,
                    'product_id' => $products->random()->id,
                ]);
                $orders->push($order);
            }
        }

        // Verify the complete structure
        $this->assertEquals(3, $categories->count());
        $this->assertEquals(6, $products->count());
        $this->assertEquals(5, $customers->count());
        $this->assertGreaterThan(0, $orders->count());

        // Verify relationships
        foreach ($products as $product) {
            $this->assertGreaterThan(0, $product->categories()->count());
        }

        foreach ($orders as $order) {
            $this->assertGreaterThan(0, $order->items()->count());
            $this->assertNotNull($order->customer_id);
        }
    }

    /** @test */
    public function it_can_override_factory_attributes()
    {
        // Create products with custom attributes
        $customProducts = Product::factory()->count(3)->create([
            'sku' => 'CUSTOM-SKU-001',
            'attribute_family_id' => 2,
            'type' => 'configurable',
        ]);

        $this->assertCount(3, $customProducts);
        $this->assertEquals('CUSTOM-SKU-001', $customProducts->first()->sku);
        $this->assertEquals(2, $customProducts->first()->attribute_family_id);
        $this->assertEquals('configurable', $customProducts->first()->type);

        // Create customers with custom attributes
        $customCustomers = Customer::factory()->count(2)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'customer_group_id' => 2,
        ]);

        $this->assertCount(2, $customCustomers);
        $this->assertEquals('John', $customCustomers->first()->first_name);
        $this->assertEquals('Doe', $customCustomers->first()->last_name);
        $this->assertEquals('john.doe@example.com', $customCustomers->first()->email);
    }
}
