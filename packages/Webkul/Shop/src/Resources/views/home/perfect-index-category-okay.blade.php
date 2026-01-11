@php

    $channel = core()->getCurrentChannel();
@endphp

<!-- SEO Meta Content -->
@push('meta')
    <meta name="title" content="{{ $channel->home_seo['meta_title'] ?? '' }}" />

    <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}" />

    <meta name="keywords" content="{{ $channel->home_seo['meta_keywords'] ?? '' }}" />
@endPush

@push('scripts')
    <script>
        localStorage.setItem('categories', JSON.stringify(@json($categories)));
    </script>
@endpush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{ $channel->home_seo['meta_title'] ?? '' }}
    </x-slot>




   <!-- ----------------------------------------------- Static content : only Bootstrap ------------------------------------------------------------------------ -->

   <!-- 1. Task 1:   add here custom slider #customBootstrapCarousel -->

    <!-- Bootstrap Carousel Slider -->
    <div id="customBootstrapCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>

        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=1200&h=500&fit=crop"
                     class="d-block w-100"
                     alt="Delicious Sweets"
                     style="height: 500px; object-fit: cover;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Delicious Sweets</h3>
                    <p class="lead text-white mb-4 carousel-text">Taste the sweetness of our traditional & modern treats</p>
                    <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn">Shop Now</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200&h=500&fit=crop"
                     class="d-block w-100"
                     alt="Fresh Baked Goods"
                     style="height: 500px; object-fit: cover;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Fresh Baked Goods</h3>
                    <p class="lead text-white mb-4 carousel-text">Get up to 50% off on freshly baked items</p>
                    <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn">View Deals</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?w=1200&h=500&fit=crop"
                     class="d-block w-100"
                     alt="Special Cakes"
                     style="height: 500px; object-fit: cover;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Special Cakes</h3>
                    <p class="lead text-white mb-4 carousel-text">Celebrate with our premium cakes for every occasion</p>
                    <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn">Explore</a>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=1200&h=500&fit=crop"
                     class="d-block w-100"
                     alt="Premium Bakery"
                     style="height: 500px; object-fit: cover;">
                <div class="carousel-caption">
                    <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Premium Bakery</h3>
                    <p class="lead text-white mb-4 carousel-text">Experience the finest bakery products</p>
                    <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn text-white">Discover More</a>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Custom CSS for better slider appearance -->
    @push('styles')
        <style>
            #customBootstrapCarousel .carousel-item img {
                filter: brightness(0.85);
                backdrop-filter: blur(0.5px);
                opacity: 0.95;
                position: relative;
                transition: filter 0.5s ease, opacity 0.5s ease, backdrop-filter 0.5s ease;
            }

            #customBootstrapCarousel .carousel-item.active img {
                filter: brightness(0.95);
                backdrop-filter: blur(0px);
                opacity: 1;
            }

            #customBootstrapCarousel .carousel-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
                pointer-events: none;
            }

            #customBootstrapCarousel .carousel-caption {
                padding: 2rem;
                border-radius: 0 0 10px 10px;
                bottom: 0;
                background: transparent;
            }
            #customBootstrapCarousel .carousel-indicators {
                margin-bottom: 1rem;
            }
            #customBootstrapCarousel .carousel-indicators button {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                margin: 0 5px;
            }
            @media (max-width: 768px) {
                #customBootstrapCarousel .carousel-inner {
                    border-radius: 0;
                }

                #customBootstrapCarousel .carousel-item img {
                    height: 250px !important;
                }

                #customBootstrapCarousel .carousel-title {
                    font-size: 1.5rem !important;
                }

                #customBootstrapCarousel .carousel-text {
                    font-size: 0.9rem !important;
                }

                #customBootstrapCarousel .carousel-btn {
                    padding: 0.5rem 1rem !important;
                    font-size: 0.875rem !important;
                }

                #customBootstrapCarousel .carousel-caption {
                    padding: 1rem !important;
                    bottom: 0 !important;
                }
            }
        </style>
    @endpush

    <!-- JavaScript for carousel initialization -->
    @push('scripts-bottom')
        <script>
            (function initCustomCarousel() {
                if (typeof bootstrap !== 'undefined' && document.getElementById('customBootstrapCarousel')) {
                    var carousel = new bootstrap.Carousel('#customBootstrapCarousel', {
                        interval: 5000,
                        wrap: true,
                        pause: 'hover',
                        touch: true,
                        keyboard: true
                    });
                    console.log('Custom Bootstrap carousel initialized');
                } else {
                    setTimeout(initCustomCarousel, 100);
                }
            })();
        </script>
    @endpush

    <!-------------------------------- End Slider  ---------------------------------------------------------------->

    <!-------------------------------- Category Carousel (Swiper Carousel) ----------------->
    @if($categories && $categories->count() > 0)
        <section class="py-5 overflow-hidden">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-12">

                        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                            <h2 class="section-title">Shop by Category</h2>

                            <div class="d-flex align-items-center">
                                <div class="category-carousel-buttons">
                                    <button class="btn text-white btn-dark category-carousel-prev me-2" type="button">❮</button>
                                    <button class="btn text-white btn-dark category-carousel-next" type="button">❯</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="category-carousel swiper">
                                <div class="swiper-wrapper">

                                @php
                                    $subCategories = [];
                                    $categoriesArray = $categories->collection->toArray();
                                    foreach($categoriesArray as $category) {
                                        if (!empty($category['children'])) {
                                            $children = $category['children'];
                                            if (is_array($children)) {
                                                $subCategories = array_merge($subCategories, $children);
                                            } elseif (is_object($children) && method_exists($children, 'toArray')) {
                                                $subCategories = array_merge($subCategories, $children->toArray());
                                            }
                                        }
                                    }
                                    $subCategories = collect($subCategories)->take(12);
                                @endphp

                                @if(!empty($subCategories))
                                    @foreach($subCategories as $subCat)
                                        @php
                                            $catName = $subCat['name'] ?? 'Category';
                                            $catSlug = $subCat['slug'] ?? '#';
                                            $catImage = $subCat['logo_url'] ?? $subCat['image_url'] ?? $subCat['logo'] ?? $subCat['image'] ?? null;
                                        @endphp

                                        <div class="swiper-slide">
                                            <a href="{{ url('products/' . $catSlug) }}" class="nav-link text-center text-decoration-none text-dark">
                                                <div class="category-card d-flex flex-column align-items-center">
                                                    @if($catImage)
                                                        <img src="{{ $catImage }}"
                                                             alt="{{ $catName }}"
                                                             class="rounded-circle mb-3 img-fluid category-image"
                                                             style="width: 140px; height: 140px; object-fit: cover; border: 3px solid #dee2e6; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                                    @else
                                                        <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center bg-light"
                                                             style="width: 140px; height: 140px; border: 3px solid #dee2e6; margin: 0 auto;">
                                                            <span class="fw-bold text-secondary" style="font-size: 2rem;">{{ substr($catName, 0, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    <h4 class="fs-6 mt-3 fw-normal category-title text-dark text-center">{{ $catName }}</h4>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <div class="text-center text-muted py-4 w-100">
                                            <p>No sub-categories available</p>
                                        </div>
                                    </div>
                                @endif

                            </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-------------------------------- Category Carousel Styles ----------------->
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
        <style>
            .category-carousel {
                padding: 10px;
            }

            .category-card {
                padding: 1rem;
                border-radius: 10px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .category-card:hover .category-image {
                transform: scale(1.1);
                box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            }

            .category-title {
                transition: color 0.3s ease;
            }

            .category-card:hover .category-title {
                color: #0d6efd !important;
            }

            .category-carousel-buttons {
                display: flex;
                gap: 5px;
            }

            .category-carousel-prev,
            .category-carousel-next {
                padding: 0.5rem 1rem;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .category-carousel-prev:hover,
            .category-carousel-next:hover {
                transform: scale(1.1);
                background-color: #212529 !important;
            }

            .category-carousel-prev:disabled,
            .category-carousel-next:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            @media (max-width: 768px) {
                .category-image {
                    width: 100px !important;
                    height: 100px !important;
                }

                .category-carousel-prev,
                .category-carousel-next {
                    padding: 0.375rem 0.75rem;
                    font-size: 0.875rem;
                }

                .swiper-slide {
                    text-align: center;
                }

                .category-title {
                    text-align: center;
                    display: block;
                    width: 100%;
                }
            }
        </style>
    @endpush

    <!-------------------------------- Category Carousel Scripts ----------------->
    @push('scripts-bottom')
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script>
            var categorySwiper = null;

            function initCategoryCarousel() {
                console.log('Initializing category carousel...');

                if (typeof Swiper === 'undefined') {
                    console.log('Swiper not loaded yet, waiting...');
                    setTimeout(initCategoryCarousel, 500);
                    return;
                }

                var categoryCarouselEl = document.querySelector('.category-carousel');
                if (!categoryCarouselEl) {
                    console.log('Category carousel element not found');
                    return;
                }

                var prevButton = document.querySelector('.category-carousel-prev');
                var nextButton = document.querySelector('.category-carousel-next');

                console.log('Carousel element:', categoryCarouselEl);
                console.log('Prev button:', prevButton);
                console.log('Next button:', nextButton);

                if (categorySwiper) {
                    categorySwiper.destroy(true);
                }

                categorySwiper = new Swiper(categoryCarouselEl, {
                    slidesPerView: 6,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: nextButton,
                        prevEl: prevButton,
                        enabled: true,
                    },
                    on: {
                        init: function() {
                            console.log('Category swiper initialized successfully');
                        },
                        navigationShow: function() {
                            console.log('Navigation buttons shown');
                        },
                        navigationHide: function() {
                            console.log('Navigation buttons hidden');
                        },
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 2,
                            spaceBetween: 10,
                        },
                        480: {
                            slidesPerView: 3,
                            spaceBetween: 15,
                        },
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 20,
                        },
                        992: {
                            slidesPerView: 5,
                            spaceBetween: 25,
                        },
                        1200: {
                            slidesPerView: 6,
                            spaceBetween: 30,
                        },
                    },
                });

                console.log('Category carousel instance:', categorySwiper);
            }

            // Initialize on window load
            window.addEventListener('load', initCategoryCarousel);

            // Also try on DOMContentLoaded as fallback
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initCategoryCarousel, 500);
            });

            // Manual button control as backup
            document.addEventListener('click', function(e) {
                if (e.target.closest('.category-carousel-next') && categorySwiper) {
                    console.log('Next button clicked');
                    categorySwiper.slideNext();
                    e.preventDefault();
                }
                if (e.target.closest('.category-carousel-prev') && categorySwiper) {
                    console.log('Previous button clicked');
                    categorySwiper.slidePrev();
                    e.preventDefault();
                }
            }, true);

            console.log('Category carousel scripts loaded');
        </script>
    @endpush

    <!-------------------------------- End Category Carousel ----------------->


    <!-------------------------------- Best Selling Products ----------------->
    @php
        $productFlatRepository = app('Webkul\Product\Repositories\ProductFlatRepository');
        $featuredProducts = $productFlatRepository
            ->where('status', 1)
            ->where('featured', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
    @endphp

    @if($featuredProducts && $featuredProducts->count() > 0)
        <section class="py-5">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                            <h2 class="section-title">Best Selling Products</h2>

                            <div class="d-flex align-items-center">
                                <div class="product-carousel-buttons">
                                    <button class="btn btn-dark product-carousel-prev me-2" type="button">❮</button>
                                    <button class="btn btn-dark product-carousel-next" type="button">❯</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach($featuredProducts as $product)
                            @php
                                $productId = $product->product_id ?? $product->id;
                                $productName = $product->name;
                                $productRating = $product->rating ?? 0;

                                // Try multiple methods to get product image
                                $productImage = null;

                                // Method 1: Use product_image() helper
                                try {
                                    $productBaseImage = product_image()->getProductBaseImage($product);
                                    if (isset($productBaseImage['medium_image_url']) && !empty($productBaseImage['medium_image_url'])) {
                                        $productImage = $productBaseImage['medium_image_url'];
                                    }
                                } catch (\Exception $e) {
                                    // Silently fail if helper doesn't work
                                }

                                // Method 2: Check for images attribute if product object has it
                                if (!$productImage && isset($product->images) && $product->images && $product->images->count() > 0) {
                                    $firstImage = $product->images->first();
                                    if ($firstImage && isset($firstImage->path)) {
                                        $productImage = Storage::url($firstImage->path);
                                    }
                                }

                                // Method 3: Use default image
                                if (!$productImage) {
                                    $productImage = asset('images/default-product.png');
                                }
                            @endphp

                                        <div class="swiper-slide">
                                <div class="product-card h-100">
                                        <div class="product-image-container">
                                            <a href="{{ $product->url }}" class="text-decoration-none">
                                                <img src="{{ $productImage }}"
                                                     alt="{{ $productName }}"
                                                     class="product-image img-fluid w-100"
                                                     style="height: 250px; object-fit: cover;">
                                            </a>
                                        @if($product->is_in_stock)
                                            <span class="badge bg-success position-absolute top-0 end-0 m-3">In Stock</span>
                                        @else
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-3">Out of Stock</span>
                                        @endif
                                    </div>

                                    <div class="product-details p-3">
                                        <a href="{{ $product->url }}" class="text-decoration-none">
                                            <h5 class="product-title text-dark mb-2 text-truncate">{{ $productName }}</h5>
                                        </a>

                                        @if($productRating > 0)
                                            <div class="product-rating mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= round($productRating))
                                                        <span class="text-warning">★</span>
                                                    @else
                                                        <span class="text-muted">★</span>
                                                    @endif
                                                @endfor
                                                <span class="text-muted small ms-1">({{ $productRating }})</span>
                                            </div>
                                        @endif

                                        <div class="product-price mb-3">
                                            <span class="price fw-bold text-primary fs-5">
                                                @if(isset($product->price) && is_numeric($product->price))
                                                    ৳{{ number_format($product->price, 2) }}
                                                @else
                                                    ৳0.00
                                                @endif
                                            </span>
                                        </div>

                                        <div class="product-buttons d-flex gap-2">
                                            <a href="{{ $product->url }}"
                                               class="btn btn-primary btn-sm flex-grow-1 view-details-btn">
                                                View Details
                                            </a>
                                            @if($product->is_in_stock)
                                                <button class="btn btn-outline-dark btn-sm add-to-cart-btn"
                                                        onclick="event.preventDefault(); addToCart({{ $productId }})">
                                                    Add to Cart
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('shop.search.index') }}"
                       class="btn btn-dark btn-lg view-all-products-btn">
                        View All Products
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-------------------------------- Product Card Styles ----------------->
    @push('styles')
        <style>
            .product-card {
                border: 1px solid #dee2e6;
                border-radius: 10px;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                background: white;
            }

            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            }

            .product-image-container {
                position: relative;
                overflow: hidden;
            }

            .product-image-container::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
                pointer-events: none;
                z-index: 1;
            }

            .product-card:hover .product-image {
                transform: scale(1.05);
            }

            .product-image {
                transition: transform 0.3s ease;
            }

            .product-title {
                font-size: 1rem;
                font-weight: 600;
                transition: color 0.3s ease;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                height: 2.8rem;
            }

            .product-card:hover .product-title {
                color: #0d6efd !important;
            }

            .product-rating {
                font-size: 0.9rem;
            }

            .product-price {
                font-size: 1.25rem;
            }

            .product-buttons {
                display: flex;
                gap: 0.5rem;
            }

            .view-details-btn,
            .add-to-cart-btn {
                transition: all 0.3s ease;
                font-size: 0.875rem;
            }

            .view-details-btn:hover,
            .add-to-cart-btn:hover {
                transform: scale(1.05);
            }

            .view-all-products-btn {
                padding: 0.75rem 2rem;
                border-radius: 5px;
                transition: all 0.3s ease;
            }

            .view-all-products-btn:hover {
                transform: scale(1.05);
                background-color: #212529 !important;
            }

            .product-carousel-buttons {
                display: flex;
                gap: 5px;
            }

            .product-carousel-prev,
            .product-carousel-next {
                padding: 0.5rem 1rem;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .product-carousel-prev:hover,
            .product-carousel-next:hover {
                transform: scale(1.1);
                background-color: #212529 !important;
            }

            @media (max-width: 768px) {
                .product-image {
                    height: 200px !important;
                }

                .product-title {
                    font-size: 0.9rem;
                }

                .product-price {
                    font-size: 1.1rem;
                }

                .product-carousel-prev,
                .product-carousel-next {
                    padding: 0.375rem 0.75rem;
                    font-size: 0.875rem;
                }

                .view-all-products-btn {
                    padding: 0.5rem 1.5rem;
                    font-size: 0.9rem;
                }
            }
        </style>
    @endpush

    <!-------------------------------- Product Carousel Scripts ----------------->
    @push('scripts-bottom')
        <script>
            var productSwiper = null;

            function initProductCarousel() {
                console.log('Initializing product carousel...');

                if (typeof Swiper === 'undefined') {
                    console.log('Swiper not loaded yet, waiting...');
                    setTimeout(initProductCarousel, 500);
                    return;
                }

                var productCarouselEl = document.querySelector('.product-carousel');
                if (!productCarouselEl) {
                    console.log('Product carousel element not found');
                    return;
                }

                var prevButton = document.querySelector('.product-carousel-prev');
                var nextButton = document.querySelector('.product-carousel-next');

                console.log('Product carousel element:', productCarouselEl);
                console.log('Prev button:', prevButton);
                console.log('Next button:', nextButton);

                if (productSwiper) {
                    productSwiper.destroy(true);
                }

                productSwiper = new Swiper(productCarouselEl, {
                    slidesPerView: 4,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: nextButton,
                        prevEl: prevButton,
                        enabled: true,
                    },
                    on: {
                        init: function() {
                            console.log('Product swiper initialized successfully');
                        },
                    },
                    breakpoints: {
                        320: {
                            slidesPerView: 1,
                            spaceBetween: 15,
                        },
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 25,
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 30,
                        },
                    },
                });

                console.log('Product carousel instance:', productSwiper);
            }

            // Initialize on window load
            window.addEventListener('load', initProductCarousel);

            // Also try on DOMContentLoaded as fallback
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initProductCarousel, 500);
            });

            // Manual button control as backup
            document.addEventListener('click', function(e) {
                if (e.target.closest('.product-carousel-next') && productSwiper) {
                    console.log('Next button clicked');
                    productSwiper.slideNext();
                    e.preventDefault();
                }
                if (e.target.closest('.product-carousel-prev') && productSwiper) {
                    console.log('Previous button clicked');
                    productSwiper.slidePrev();
                    e.preventDefault();
                }
            }, true);

            function addToCart(productId) {
                console.log('Adding product to cart:', productId);
                // Add your add to cart logic here
                // This can call an API or use existing Bagisto cart functionality
            }

            console.log('Product carousel scripts loaded');
        </script>
    @endpush

    <!-------------------------------- End Best Selling Products ----------------->


</x-shop::layouts>
