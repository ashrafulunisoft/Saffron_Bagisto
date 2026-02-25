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
    ) {}

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        visitor()->visit();

        $customizations = $this->themeCustomizationRepository->orderBy('sort_order')->findWhere([
            'status'     => self::STATUS,
            'channel_id' => core()->getCurrentChannel()->id,
            'theme_code' => core()->getCurrentChannel()->theme,
        ]);

        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
        $categories = CategoryTreeResource::collection($categories);

        // Fetch all products server-side for better performance
        $featuredProducts = $this->getFeaturedProducts();
        $sweetProducts = $this->getProductsByCategory(12); // Sweet category
        $chocolateProducts = $this->getProductsByCategory(19); // Chocolate category
        $bestSellingProducts = $this->getBestSellingProducts($featuredProducts);
        $popularProducts = $this->getPopularProducts($featuredProducts, $bestSellingProducts);



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
        'status'   => self::STATUS,
        'sort'     => 'created_at',
        'order'    => 'desc',
        'limit'    => 12,
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
     * Get best selling products - exclude featured products to show different products
     */
    protected function getBestSellingProducts(array $featuredProducts): array
    {
        // Get featured product IDs to exclude
        $featuredIds = array_map(function($p) { return $p['id']; }, $featuredProducts);

        // First try: get products sorted randomly but exclude featured
        $params = [
            'sort' => 'rand',
            'limit' => 12,
        ];

        $products = $this->productRepository->getAll($params);
        $productCollection = ProductResource::collection($products)->resolve();

        // Filter out featured products
        $filtered = array_filter($productCollection, function($p) use ($featuredIds) {
            return !in_array($p['id'], $featuredIds);
        });

        // If we have enough non-featured products, return them
        if (count($filtered) >= 4) {
            return array_values(array_slice($filtered, 0, 12));
        }

        // Otherwise return all non-featured
        return array_values($filtered);



    }




    /**
     * Get popular products - exclude featured and best selling products
     */
    protected function getPopularProducts(array $featuredProducts, array $bestSellingProducts): array
    {
        // Get IDs to exclude
        $excludeIds = array_merge(
            array_map(function($p) { return $p['id']; }, $featuredProducts),
            array_map(function($p) { return $p['id']; }, $bestSellingProducts)
        );

        $params = [
            'sort' => 'rand',
            'limit' => 8,
        ];

        $products = $this->productRepository->getAll($params);
        $productCollection = ProductResource::collection($products)->resolve();

        // Filter out excluded products
        $filtered = array_filter($productCollection, function($p) use ($excludeIds) {
            return !in_array($p['id'], $excludeIds);
        });

        return array_values(array_slice($filtered, 0, 8));
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
