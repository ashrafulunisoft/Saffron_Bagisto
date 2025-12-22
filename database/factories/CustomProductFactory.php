<?php

namespace Database\Factories;

use Webkul\Product\Models\Product;
use Webkul\Product\Models\ProductFlat;
use Webkul\Product\Models\ProductInventory;
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
        return $this->afterCreating(function (Product $product) {
            $product->product_flat()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'status' => 1,
                ]
            );
        });
    }

    /**
     * Indicate that the product is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->afterCreating(function (Product $product) {
            $product->product_flat()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'status' => 0,
                ]
            );
        });
    }

    /**
     * Indicate that the product is featured.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function featured()
    {
        return $this->afterCreating(function (Product $product) {
            $product->product_flat()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'featured' => 1,
                ]
            );
        });
    }

    /**
     * Indicate that the product is new.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function isNew()
    {
        return $this->afterCreating(function (Product $product) {
            $product->product_flat()->updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'new' => 1,
                ]
            );
        });
    }

    /**
     * Create product with complete flat data.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withFlatData()
    {
        return $this->afterCreating(function (Product $product) {
            $name = $this->faker->words(3, true);
            $price = $this->faker->randomFloat(2, 10, 1000);

            ProductFlat::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'name' => $name,
                    'url_key' => $this->faker->unique()->slug,
                    'short_description' => $this->faker->sentence,
                    'description' => $this->faker->paragraph(3),
                    'price' => $price,
                    'special_price' => $this->faker->optional(0.3, null)->randomFloat(2, $price * 0.5, $price * 0.9),
                    'cost' => $this->faker->randomFloat(2, $price * 0.3, $price * 0.7),
                    'meta_title' => $name,
                    'meta_description' => $this->faker->sentence,
                    'meta_keywords' => $this->faker->words(5, true),
                    'status' => 1,
                    'featured' => $this->faker->boolean(30), // 30% chance of being featured
                    'new' => $this->faker->boolean(40), // 40% chance of being new
                    'visible_individually' => 1,
                    'guest_checkout' => 1,
                    'manage_stock' => 1,
                    'length' => $this->faker->randomFloat(2, 5, 50),
                    'width' => $this->faker->randomFloat(2, 5, 50),
                    'height' => $this->faker->randomFloat(2, 5, 50),
                    'weight' => $this->faker->randomFloat(2, 0.1, 10),
                ]
            );
        });
    }

    /**
     * Create product with inventory.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withInventory()
    {
        return $this->afterCreating(function (Product $product) {
            ProductInventory::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'inventory_source_id' => 1, // Default inventory source
                ],
                [
                    'qty' => $this->faker->numberBetween(10, 100),
                ]
            );
        });
    }

    /**
     * Create product with categories.
     *
     * @param array $categoryIds
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withCategories(array $categoryIds)
    {
        return $this->afterCreating(function (Product $product) use ($categoryIds) {
            $product->categories()->attach($categoryIds);
        });
    }

    /**
     * Create electronic product.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function electronic()
    {
        return $this->afterCreating(function (Product $product) {
            $name = $this->faker->randomElement(['Smartphone', 'Laptop', 'Tablet', 'Headphones', 'Smartwatch']) . ' ' . $this->faker->randomElement(['Pro', 'Max', 'Plus', 'Elite', 'Ultra']);
            $price = $this->faker->randomFloat(2, 199, 1999);

            ProductFlat::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'name' => $name,
                    'url_key' => $this->faker->unique()->slug,
                    'short_description' => "Latest {$name} with advanced features",
                    'description' => "Experience the best with our new {$name}. Features cutting-edge technology and premium build quality.",
                    'price' => $price,
                    'status' => 1,
                    'featured' => $this->faker->boolean(50),
                    'new' => $this->faker->boolean(60),
                ]
            );
        });
    }

    /**
     * Create fashion product.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function fashion()
    {
        return $this->afterCreating(function (Product $product) {
            $name = $this->faker->randomElement(['T-Shirt', 'Jeans', 'Jacket', 'Dress', 'Shoes']) . ' ' . $this->faker->randomElement(['Classic', 'Modern', 'Premium', 'Sport', 'Elegant']);
            $price = $this->faker->randomFloat(2, 19, 299);

            ProductFlat::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'name' => $name,
                    'url_key' => $this->faker->unique()->slug,
                    'short_description' => "Stylish {$name} for modern lifestyle",
                    'description' => "Premium quality {$name} made from finest materials. Perfect for any occasion.",
                    'price' => $price,
                    'status' => 1,
                    'featured' => $this->faker->boolean(30),
                    'new' => $this->faker->boolean(40),
                ]
            );
        });
    }

    /**
     * Create product with specific price range.
     *
     * @param float $min
     * @param float $max
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function priceRange(float $min, float $max)
    {
        return $this->afterCreating(function (Product $product) use ($min, $max) {
            ProductFlat::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'locale' => 'en',
                    'channel_id' => 1,
                ],
                [
                    'price' => $this->faker->randomFloat(2, $min, $max),
                ]
            );
        });
    }

    /**
     * Create product with specific SKU prefix.
     *
     * @param string $prefix
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function skuPrefix(string $prefix)
    {
        return $this->state(function (array $attributes) use ($prefix) {
            return [
                'sku' => $prefix . '-' . $this->faker->unique()->numerify('######'),
            ];
        });
    }
}
