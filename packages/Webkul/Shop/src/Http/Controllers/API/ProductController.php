<?php

namespace Webkul\Shop\Http\Controllers\API;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Marketing\Jobs\UpdateCreateSearchTerm as UpdateCreateSearchTermJob;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Http\Resources\ProductResource;

class ProductController extends APIController
{
    /**
     * Create a controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository
    ) {}

    /**
     * Product listings.
     */
    public function index(): JsonResource
    {
        $searchEngine = 'database';

        if (core()->getConfigData('catalog.products.search.engine') == 'elastic') {
            $searchEngine = core()->getConfigData('catalog.products.search.storefront_mode');
        }

        $searchData = $this->resolveSearchQueryData($searchEngine);

        $query = $searchData['effective_query'] ?? $searchData['original_query'];

        $products = $this->productRepository
            ->setSearchEngine($searchEngine)
            ->getAll(array_merge(request()->query(), [
                'query'                => $query,
                'channel_id'           => core()->getCurrentChannel()->id,
                'status'               => 1,
                'visible_individually' => 1,
            ]));

        if (! empty($query)) {
            /**
             * Update or create search term only if
             * there is only one filter that is query param
             */
            if (count(request()->except(['mode', 'sort', 'limit'])) == 1) {
                UpdateCreateSearchTermJob::dispatch([
                    'term'       => $query,
                    'results'    => $products->total(),
                    'channel_id' => core()->getCurrentChannel()->id,
                    'locale'     => app()->getLocale(),
                ]);
            }
        }

        return ProductResource::collection($products);
    }

    /**
     * Resolve search query data.
     */
    protected function resolveSearchQueryData($searchEngine): array
    {
        if (request()->query('suggest', '') === '0') {
            return [
                'original_query'  => request()->query('query', ''),
                'effective_query' => null,
            ];
        }

        $originalQuery = request()->query('query', '');

        return [
            'original_query'  => $originalQuery,
            'effective_query' => $this->getEffectiveQuery($originalQuery, $searchEngine),
        ];
    }

    /**
     * It will return the effective query based on the search engine.
     */
    protected function getEffectiveQuery(string $originalQuery, string $searchEngine): ?string
    {
        $effectiveQuery = $this->productRepository->setSearchEngine($searchEngine)->getSuggestions($originalQuery);

        return $effectiveQuery;
    }

    /**
     * Related product listings.
     *
     * @param  int  $id
     */
    public function relatedProducts($id): JsonResource
    {
        $product = $this->productRepository->findOrFail($id);

        $relatedProducts = $product->related_products()
            ->take(core()->getConfigData('catalog.products.product_view_page.no_of_related_products'))
            ->get();

        return ProductResource::collection($relatedProducts);
    }

    /**
     * Up-sell product listings.
     *
     * @param  int  $id
     */
    public function upSellProducts($id): JsonResource
    {
        $product = $this->productRepository->findOrFail($id);

        $upSellProducts = $product->up_sells()
            ->take(core()->getConfigData('catalog.products.product_view_page.no_of_up_sells_products'))
            ->get();

        return ProductResource::collection($upSellProducts);
    }

    /**
     * Popular product listings (based on customer interactions).
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function popular(): JsonResource
    {
        try {
            $limit = (int) request()->get('limit', 8);

            // Get popular product IDs from wishlist items
            $wishlistProductIds = DB::table('wishlist')
                ->select('product_id')
                ->selectRaw('COUNT(*) as popularity_score')
                ->groupBy('product_id')
                ->orderBy('popularity_score', 'desc')
                ->limit($limit)
                ->pluck('product_id');

            // Get popular product IDs from order items (all orders, not just completed)
            $orderProductIds = DB::table('order_items')
                ->select('product_id')
                ->selectRaw('COUNT(*) as order_count')
                ->where('product_type', 'Webkul\Product\Models\Product')
                ->groupBy('product_id')
                ->orderBy('order_count', 'desc')
                ->limit($limit)
                ->pluck('product_id');

            // Combine both sources and calculate combined popularity
            $allProductIds = collect();
            $popularityScores = [];

            // Add wishlist scores (higher weight)
            foreach ($wishlistProductIds as $index => $productId) {
                $score = (count($wishlistProductIds) - $index) * 2;
                $popularityScores[$productId] = ($popularityScores[$productId] ?? 0) + $score;
                $allProductIds->push($productId);
            }

            // Add order scores (slightly lower weight)
            foreach ($orderProductIds as $index => $productId) {
                $score = (count($orderProductIds) - $index);
                $popularityScores[$productId] = ($popularityScores[$productId] ?? 0) + $score;
                $allProductIds->push($productId);
            }

            // If no popular products, return empty collection
            if ($allProductIds->isEmpty()) {
                return ProductResource::collection([]);
            }

            // Sort by combined popularity score
            $sortedProductIds = $allProductIds->unique()->sort(function($a, $b) use ($popularityScores) {
                return ($popularityScores[$b] ?? 0) <=> ($popularityScores[$a] ?? 0);
            })->values()->take($limit);

            // Fetch products directly using model query
            $products = \Webkul\Product\Models\Product::with([
                'attribute_family',
                'images',
                'videos',
                'attribute_values',
                'price_indices',
                'inventory_indices',
                'reviews',
                'variants',
                'variants.attribute_family',
                'variants.attribute_values',
                'variants.price_indices',
                'variants.inventory_indices',
            ])
            ->whereIn('id', $sortedProductIds)
            ->get();

            // Sort products by popularity score
            $products = $products->sortBy(function($product) use ($popularityScores, $sortedProductIds) {
                return array_search($product->id, $sortedProductIds->toArray());
            })->values();

            return ProductResource::collection($products);

        } catch (\Exception $e) {
            // Log error and return empty collection
            Log::error('Popular products error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return ProductResource::collection([]);
        }
    }

    /**
     * Best selling product listings.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function bestSelling(): JsonResource
    {
        try {
            $limit = (int) request()->get('limit', 8);

            // Get product IDs with sales data from order items
            // product_type is full class name: Webkul\Product\Models\Product
            $productIds = DB::table('order_items')
                ->select('product_id')
                ->selectRaw('SUM(qty_ordered) as total_sold')
                ->where('product_type', 'Webkul\Product\Models\Product')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('orders')
                        ->whereColumn('order_items.order_id', 'orders.id')
                        ->where('orders.status', 'completed');
                })
                ->groupBy('product_id')
                ->orderBy('total_sold', 'desc')
                ->limit($limit)
                ->pluck('product_id');

            // If no best selling products, return empty collection
            if ($productIds->isEmpty()) {
                return ProductResource::collection([]);
            }

            // Fetch products directly using model query
            $products = \Webkul\Product\Models\Product::with([
                'attribute_family',
                'images',
                'videos',
                'attribute_values',
                'price_indices',
                'inventory_indices',
                'reviews',
                'variants',
                'variants.attribute_family',
                'variants.attribute_values',
                'variants.price_indices',
                'variants.inventory_indices',
            ])
            ->whereIn('id', $productIds)
            ->get();

            // Sort products by sales order
            $products = $products->sortBy(function($product) use ($productIds) {
                return array_search($product->id, $productIds->toArray());
            })->values();

            return ProductResource::collection($products);

        } catch (\Exception $e) {
            // Log error and return empty collection
            Log::error('Best selling products error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return ProductResource::collection([]);
        }
    }
}