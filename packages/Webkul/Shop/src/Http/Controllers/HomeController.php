<?php

namespace Webkul\Shop\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Product\Repositories\ProductFlatRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Shop\Http\Requests\ContactRequest;
use Webkul\Shop\Http\Resources\CategoryTreeResource;
use Webkul\Shop\Http\Resources\ProductResource;
use Webkul\Shop\Mail\ContactUs;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Using const variable for status
     */
    const STATUS = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected ThemeCustomizationRepository $themeCustomizationRepository,
        protected CategoryRepository $categoryRepository,
        protected ProductRepository $productRepository
    ) {
    }

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        visitor()->visit();

        $customizations = $this->themeCustomizationRepository->orderBy('sort_order')->findWhere([
            'status' => self::STATUS,
            'channel_id' => core()->getCurrentChannel()->id,
            'theme_code' => core()->getCurrentChannel()->theme,
        ]);

        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
        $categories = CategoryTreeResource::collection($categories);

        // Fetch all products server-side for better performance
        $featuredProducts = $this->getFeaturedProducts();
        $sweetProducts = $this->getProductsByCategory(12); // Sweet category
        $chocolateProducts = $this->getProductsByCategory(19); // Chocolate category
        $bestSellingProducts = $this->getBestSellingProducts();
        $popularProducts = $this->getPopularProducts();



        return view('shop::home.index', compact(
            'customizations',
            'categories',
            'featuredProducts',
            'sweetProducts',
            'chocolateProducts',
            'bestSellingProducts',
            'popularProducts'
        ));
    }

    /**
     * Get featured products (filtered by is_featured = 1, sorted by newest).
     */
    protected function getFeaturedProducts(): array
    {
        // $params = [
        //     'featured' => 1,
        //     'sort' => 'created_at',
        //     'order' => 'desc',
        //     'limit' => 12,
        // ];

        $params = [
            'featured' => 1,
            'status' => self::STATUS,
            'sort' => 'created_at',
            'order' => 'desc',
            'limit' => 12,
        ];

        $products = $this->productRepository->getAll($params);

        return ProductResource::collection($products)->resolve();
    }

    /**
     * Get products by category.
     */
    protected function getProductsByCategory(int $categoryId): array
    {
        $params = [
            'category_id' => $categoryId,
            'sort' => 'created_at',
            'order' => 'desc',
            'limit' => 8,
        ];

        $products = $this->productRepository->getAll($params);

        return ProductResource::collection($products)->resolve();
    }

    /**
     * Get best selling products based on actual order data
     *
     * @param  int  $limit
     * @return array
     */
    protected function getBestSellingProducts(int $limit = 12): array
    {
        // Get product IDs ordered by total quantity sold
        $productIds = DB::table('order_items')
            ->select('product_id')
            ->selectRaw('SUM(qty_ordered) as total_sold')
            ->where('product_type', 'Webkul\Product\Models\Product')
            ->whereNotNull('product_id')
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->limit($limit)
            ->pluck('product_id')
            ->toArray();

        // If no sales data, fall back to recent products
        if (empty($productIds)) {
            $params = [
                'status' => self::STATUS,
                'sort' => 'created_at',
                'order' => 'desc',
                'limit' => $limit,
            ];

            $products = $this->productRepository->getAll($params);
            return ProductResource::collection($products)->resolve();
        }

        // Fetch products with proper relationships using table-qualified column
        $products = \Webkul\Product\Models\Product::whereIn('products.id', $productIds)->get();

        // Sort by the order from the query (preserve best-selling order)
        $sortedProducts = collect($productIds)->map(function ($id) use ($products) {
            return $products->firstWhere('id', $id);
        })->filter();

        return ProductResource::collection($sortedProducts)->resolve();
    }

    /**
     * Get popular products based on wishlist, orders, and reviews
     *
     * @param  int  $limit
     * @return array
     */
    protected function getPopularProducts(int $limit = 8): array
    {
        $popularityScores = [];
        $allProductIds = collect();

        // Factor 1: Wishlist items (weight: 2x)
        $wishlistProductIds = DB::table('wishlist_items')
            ->select('product_id')
            ->selectRaw('COUNT(*) as wishlist_count')
            ->groupBy('product_id')
            ->orderBy('wishlist_count', 'desc')
            ->limit($limit * 2)
            ->get();

        foreach ($wishlistProductIds as $index => $item) {
            $score = ($wishlistProductIds->count() - $index) * 2;
            $popularityScores[$item->product_id] = ($popularityScores[$item->product_id] ?? 0) + $score;
            $allProductIds->push($item->product_id);
        }

        // Factor 2: Order frequency (weight: 1.5x)
        $orderProductIds = DB::table('order_items')
            ->select('product_id')
            ->selectRaw('COUNT(*) as order_count')
            ->where('product_type', 'Webkul\Product\Models\Product')
            ->whereNotNull('product_id')
            ->groupBy('product_id')
            ->orderBy('order_count', 'desc')
            ->limit($limit * 2)
            ->get();

        foreach ($orderProductIds as $index => $item) {
            $score = ($orderProductIds->count() - $index) * 1.5;
            $popularityScores[$item->product_id] = ($popularityScores[$item->product_id] ?? 0) + $score;
            $allProductIds->push($item->product_id);
        }

        // Factor 3: Reviews (weight: 1x)
        $reviewProductIds = DB::table('product_reviews')
            ->select('product_id')
            ->selectRaw('COUNT(*) as review_count')
            ->where('status', 'approved')
            ->groupBy('product_id')
            ->orderBy('review_count', 'desc')
            ->limit($limit * 2)
            ->get();

        foreach ($reviewProductIds as $index => $item) {
            $score = ($reviewProductIds->count() - $index);
            $popularityScores[$item->product_id] = ($popularityScores[$item->product_id] ?? 0) + $score;
            $allProductIds->push($item->product_id);
        }

        // Sort by combined popularity score
        $sortedProductIds = $allProductIds->unique()
            ->sort(fn($a, $b) => ($popularityScores[$b] ?? 0) <=> ($popularityScores[$a] ?? 0))
            ->take($limit)
            ->values()
            ->toArray();

        // If no popularity data, fall back to recent products
        if (empty($sortedProductIds)) {
            $params = [
                'status' => self::STATUS,
                'sort' => 'created_at',
                'order' => 'desc',
                'limit' => $limit,
            ];

            $products = $this->productRepository->getAll($params);
            return ProductResource::collection($products)->resolve();
        }

        // Fetch products using table-qualified column to avoid ambiguity
        $products = \Webkul\Product\Models\Product::whereIn('products.id', $sortedProductIds)->get();

        // Sort by popularity score order
        $sortedProducts = collect($sortedProductIds)->map(function ($id) use ($products) {
            return $products->firstWhere('id', $id);
        })->filter();

        return ProductResource::collection($sortedProducts)->resolve();
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Summary of contact.
     *
     * @return \Illuminate\View\View
     */
    public function contactUs()
    {
        return view('shop::home.contact-us');
    }

    /**
     * Summary of store.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendContactUsMail(ContactRequest $contactRequest)
    {
        try {
            Mail::queue(new ContactUs($contactRequest->only([
                'name',
                'email',
                'contact',
                'message',
            ])));

            session()->flash('success', trans('shop::app.home.thanks-for-contact'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            report($e);
        }

        return back();
    }
}
