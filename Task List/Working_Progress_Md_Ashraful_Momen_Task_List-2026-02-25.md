# Homepage & Header Optimization Task List

## 📋 Overview
This document outlines the complete task list for optimizing homepage product fetching speed and fixing/optimizing the header with 100% success rate.

---

## 🎯 Phase 1: Homepage Product Fetching Optimization

### Task 1.1: Analyze Current Performance Bottlenecks
- [ ] **1.1.1** Identify N+1 query issues in HomeController
- [ ] **1.1.2** Review ProductRepository query complexity
- [ ] **1.1.3** Check for missing database indexes
- [ ] **1.1.4** Measure current page load time

### Task 1.2: Implement Parallel Product Fetching
**File:** `packages/Webkul/Shop/src/Http/Controllers/HomeController.php`

```php
// Current sequential fetching (SLOW - ~2-3 seconds)
$featuredProducts = $this->getFeaturedProducts();
$sweetProducts = $this->getProductsByCategory(12);
$cakeProducts = $this->getProductsByCategory(20);
$chocolateProducts = $this->getProductsByCategory(19);
$bestSellingProducts = $this->getBestSellingProducts();
$popularProducts = $this->getPopularProducts();

// Optimized parallel fetching (FAST - ~300-500ms)
$products = Parallel::run([
    fn() => $this->getFeaturedProducts(),
    fn() => $this->getProductsByCategory(12),
    fn() => $this->getProductsByCategory(20),
    fn() => $this->getProductsByCategory(19),
    fn() => $this->getBestSellingProducts(),
    fn() => $this->getPopularProducts(),
]);
```

**Implementation:**
- [ ] **1.2.1** Install Laravel Parallel package or use Symfony Concurrency
- [ ] **1.2.2** Refactor HomeController::index() method
- [ ] **1.2.3** Add fallback for parallel execution failure
- [ ] **1.2.4** Test parallel execution on staging

### Task 1.3: Add Query Caching
**Files to modify:**
- `packages/Webkul/Shop/src/Http/Controllers/HomeController.php`
- `packages/Webkul/Product/src/Repositories/ProductRepository.php`

```php
// Cache product queries for 5-15 minutes
Cache::remember('homepage_featured_products', 600, function() {
    return $this->getFeaturedProducts();
});
```

**Implementation:**
- [ ] **1.3.1** Add cache tags for product collections
- [ ] **1.3.2** Implement cache invalidation on product update
- [ ] **1.3.3** Set appropriate TTL for each product type
- [ ] **1.3.4** Add cache warming on admin product save

### Task 1.4: Optimize ProductRepository Queries
**File:** `packages/Webkul/Product/src/Repositories/ProductRepository.php`

```php
// Before: Heavy query with many joins
$query->with([
    'attribute_family',
    'images',
    'videos',
    'attribute_values',
    'price_indices',
    'inventory_indices',
    'reviews',
    'variants',
    // ... more relations
]);

// After: Optimized with select and whereHas
$query->with(['images', 'price_indices', 'inventory_indices'])
    ->select(['products.id', 'products.type', 'products.sku'])
    ->whereHas('inventory_indices', fn($q) => $q->where('qty', '>', 0));
```

**Implementation:**
- [ ] **1.4.1** Optimize getAll() method - reduce eager loading
- [ ] **1.4.2** Add specific column selection
- [ ] **1.4.3** Implement whereHas for filtering
- [ ] **1.4.4** Add query result limits for homepage

### Task 1.5: Database Index Optimization
**Files:** Database migrations in `database/migrations/`

```php
// Add composite indexes for common queries
Schema::table('product_price_indices', function (Blueprint $table) {
    $table->index(['product_id', 'customer_group_id', 'min_price']);
});

Schema::table('order_items', function (Blueprint $table) {
    $table->index(['product_id', 'qty_ordered']);
});

Schema::table('wishlist_items', function (Blueprint $table) {
    $table->index(['product_id']);
});

Schema::table('product_reviews', function (Blueprint $table) {
    $table->index(['product_id', 'status']);
});
```

**Implementation:**
- [ ] **1.5.1** Create migration for product_price_indices index
- [ ] **1.5.2** Create migration for order_items index
- [ ] **1.5.3** Create migration for wishlist_items index
- [ ] **1.5.4** Create migration for product_reviews index
- [ ] **1.5.5** Run ANALYZE on tables after adding indexes

### Task 1.6: Image Optimization
**File:** `packages/Webkul/Shop/src/Resources/views/home/index.blade.php`

```html
<!-- Before -->
<img src="{{ $productImage }}" alt="{{ $product['name'] }}" loading="lazy">

<!-- After - Add srcset and modern formats -->
<img 
    src="{{ $productImage }}"
    srcset="{{ $productImageMobile }} 480w, {{ $productImageTablet }} 768w, {{ $productImage }} 1200w"
    sizes="(max-width: 480px) 480px, (max-width: 768px) 768px, 1200px"
    loading="lazy"
    decoding="async"
    fetchpriority="high"
>
```

**Implementation:**
- [ ] **1.6.1** Add srcset for responsive images
- [ ] **1.6.2** Add fetchpriority for above-fold images
- [ ] **1.6.3** Implement lazy loading with Intersection Observer
- [ ] **1.6.4** Add image placeholders (blurhash)

---

## 🎯 Phase 2: Header Optimization

### Task 2.1: Header Performance Analysis
- [ ] **2.1.1** Identify header render-blocking resources
- [ ] **2.1.2** Analyze mini-cart query performance
- [ ] **2.1.3** Check header component loading order
- [ ] **2.1.4** Measure header JavaScript execution time

### Task 2.2: Optimize Mini-Cart Queries
**Files:**
- `packages/Webkul/Shop/src/Resources/views/components/layouts/header/desktop/bottom.blade.php`
- `packages/Webkul/Checkout/src/Repositories/CartRepository.php`

```php
// Optimized mini-cart query - select only needed fields
public function getMiniCart($cartId) {
    return Cart::with(['items.product.images', 'items.product.price_indices' => function($q) {
        $q->select('product_id', 'min_price', 'max_price');
    }])
    ->select('id', 'customer_id', 'items_count', 'grand_total')
    ->find($cartId);
}
```

**Implementation:**
- [ ] **2.2.1** Optimize CartRepository::getCart() method
- [ ] **2.2.2** Reduce mini-cart relations loading
- [ ] **2.2.3** Add caching for mini-cart data
- [ ] **2.2.4** Implement mini-cart stale-while-revalidate

### Task 2.3: Header Component Lazy Loading
**Files:**
- `packages/Webkul/Shop/src/Resources/views/components/layouts/header/index.blade.php`

```html
<!-- Defer non-critical header components -->
<v-header-switcher>
    <v-desktop-header v-if="isDesktop"></v-desktop-header>
    <v-mobile-header v-else></v-mobile-header>
</v-header-switcher>

<!-- Load compare/wishlist on interaction -->
<template #lazy-compare>
    <x-shop::layouts.header.desktop.compare />
</template>
```

**Implementation:**
- [ ] **2.3.1** Implement Vue Suspense for header components
- [ ] **2.3.2** Defer loading of profile dropdown
- [ ] **2.3.3** Lazy load compare dropdown
- [ ] **2.3.4** Use intersection observer for visibility

### Task 2.4: Optimize Header Search
**File:** `packages/Webkul/Shop/src/Resources/views/components/layouts/header/desktop/bottom.blade.php`

```javascript
// Debounced search with caching
const searchProducts = debounce(async (query) => {
    if (query.length < 3) return;
    
    // Check cache first
    const cached = await caches.match(`/api/search?q=${query}`);
    if (cached) return cached.json();
    
    const response = await fetch(`/api/search?q=${query}&limit=5`);
    caches.put(`/api/search?q=${query}`, response.clone());
    return response.json();
}, 300);
```

**Implementation:**
- [ ] **2.4.1** Add debounce to search input (300ms)
- [ ] **2.4.2** Implement search result caching
- [ ] **2.4.3** Add search API response caching
- [ ] **2.4.4** Optimize search suggestion queries

### Task 2.5: Header CSS/JS Optimization
**Files:**
- `packages/Webkul/Shop/src/Resources/views/components/layouts/header/index.blade.php`
- `resources/themes/<current-theme>/assets/css/`

```html
<!-- Inline critical header CSS -->
<style>
    .header-critical { /* critical styles */ }
</style>

<!-- Defer non-critical JS -->
<script defer src="{{ asset('js/header-non-critical.js') }}"></script>
```

**Implementation:**
- [ ] **2.5.1** Extract critical CSS for header
- [ ] **2.5.2** Inline critical header styles
- [ ] **2.5.3** Defer non-critical header JavaScript
- [ ] **2.5.4** Add preconnect for external resources

---

## 🎯 Phase 3: Testing & Verification

### Task 3.1: Performance Testing
- [ ] **3.1.1** Run Lighthouse performance audit
- [ ] **3.1.2** Measure Time to First Byte (TTFB)
- [ ] **3.1.3** Measure First Contentful Paint (FCP)
- [ ] **3.1.4** Measure Largest Contentful Paint (LCP)
- [ ] **3.1.5** Measure Time to Interactive (TTI)

### Task 3.2: Load Testing
- [ ] **3.2.1** Run Apache Bench or k6 load test
- [ ] **3.2.2** Test with 100 concurrent users
- [ ] **3.2.3** Test with 500 concurrent users
- [ ] **3.2.4** Verify cache hit rates

### Task 3.3: Error Handling & Fallback
- [ ] **3.3.1** Test parallel execution failure fallback
- [ ] **3.3.2** Test cache unavailable scenarios
- [ ] **3.3.3** Test database connection issues
- [ ] **3.3.4** Verify graceful degradation

---

## 🎯 Phase 4: Deployment

### Task 4.1: Pre-deployment Checklist
- [ ] **4.1.1** Run all unit tests
- [ ] **4.1.2** Run all integration tests
- [ ] **4.1.3** Clear all application caches
- [ ] **4.1.4** Verify database migrations

### Task 4.2: Deployment Steps
```bash
# Step 1: Run migrations
php artisan migrate

# Step 2: Clear and rebuild caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Step 3: Warm up caches
php artisan cache:warm

# Step 4: Restart queue workers
php artisan queue:restart
```

### Task 4.3: Post-deployment Verification
- [ ] **4.3.1** Verify homepage loads correctly
- [ ] **4.3.2** Verify header functionality
- [ ] **4.3.3** Check error logs
- [ ] **4.3.4** Monitor performance metrics

---

## 📊 Expected Results

| Metric | Before | After | Improvement |
|--------|--------|-------|-------------|
| Homepage Load Time | ~3-5s | ~500ms-1s | 80-90% faster |
| Time to First Byte | ~500ms | ~100ms | 80% faster |
| First Contentful Paint | ~2s | ~400ms | 80% faster |
| Header Render Time | ~500ms | ~100ms | 80% faster |
| Database Queries (Homepage) | 50+ | 10-15 | 70% reduction |

---

## 🔧 Code Snippets Summary

### HomeController Optimized Code
```php
<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Http\Resources\CategoryTreeResource;
use Webkul\Shop\Http\Resources\ProductResource;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

class HomeController extends Controller
{
    const STATUS = 1;
    const CACHE_TTL = 600; // 10 minutes

    public function __construct(
        protected ThemeCustomizationRepository $themeCustomizationRepository,
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository
    ) {}

    public function index()
    {
        visitor()->fetch();

        // Load non-blocking with parallel execution
        $data = $this->fetchHomepageData();

        return view('shop::home.index', $data);
    }

    protected function fetchHomepageData(): array
    {
        // Use parallel execution for independent queries
        $results = parallel([
            fn() => $this->getCachedFeaturedProducts(),
            fn() => $this->getCachedProductsByCategory(12),
            fn() => $this->getCachedProductsByCategory(20),
            fn() => $this->getCachedProductsByCategory(19),
            fn() => $this->getCachedBestSellingProducts(),
            fn() => $this->getCachedPopularProducts(),
        ]);

        return [
            'customizations' => $this->getCustomizations(),
            'categories' => $this->getCategories(),
            'featuredProducts' => $results[0] ?? [],
            'sweetProducts' => $results[1] ?? [],
            'cakeProducts' => $results[2] ?? [],
            'chocolateProducts' => $results[3] ?? [],
            'bestSellingProducts' => $results[4] ?? [],
            'popularProducts' => $results[5] ?? [],
        ];
    }

    protected function getCachedFeaturedProducts(): array
    {
        return Cache::remember('homepage_featured_products', self::CACHE_TTL, function() {
            $params = [
                'featured' => 1,
                'status' => self::STATUS,
                'sort' => 'created_at',
                'order' => 'desc',
                'limit' => 12,
            ];
            $products = $this->productRepository->getHomepageProducts($params);
            return ProductResource::collection($products)->resolve();
        });
    }

    // ... similar methods for other product types
}
```

### ProductRepository Optimized Scope Query
```php
public function getHomepageProducts(array $params = [])
{
    return $this->with([
        'images' => fn($q) => $q->select('id', 'product_id', 'path', 'type'),
        'price_indices' => fn($q) => $q->select('id', 'product_id', 'min_price', 'max_price'),
        'inventory_indices' => fn($q) => $q->select('id', 'product_id', 'qty'),
    ])
    ->scopeQuery(fn($query) => $query
        ->select('products.id', 'products.type', 'products.sku', 'products.parent_id')
        ->where('products.status', 1)
        ->whereHas('inventory_indices', fn($q) => $q->where('qty', '>', 0))
        ->orderBy('products.created_at', 'desc')
    )
    ->paginate($params['limit'] ?? 12);
}
```

---

## ✅ Success Criteria

1. **100% Success Rate Requirements:**
   - [ ] Homepage loads without errors
   - [ ] All product sections display correctly
   - [ ] Header functions work properly
   - [ ] Cart operations work correctly
   - [ ] Search functionality works
   - [ ] Mobile responsive works
   - [ ] No JavaScript console errors

2. **Performance Requirements:**
   - [ ] Homepage loads in < 1 second
   - [ ] Header renders in < 200ms
   - [ ] No N+1 query issues
   - [ ] Cache hit rate > 80%

3. **Compatibility:**
   - [ ] Works with existing Bagisto extensions
   - [ ] Maintains backward compatibility
   - [ ] Works in all supported browsers

---

## 📝 Notes

- All cache keys should be prefixed with `homepage_`
- Use cache tags for better cache management
- Always provide fallback for cache failures
- Monitor cache hit rates in production
- Consider using Redis for better performance

---

**Created:** February 25, 2026
**Last Updated:** February 25, 2026
**Status:** Ready for Implementation
