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
{
    {
        --Categories stored in localStorage
        for other features--
    }
}
@if(isset($categories) && $categories)
localStorage.setItem('categories', JSON.stringify(@json($categories)));
@endif
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
        <div id="customBootstrapCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="5000"
            data-bs-pause="hover">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#customBootstrapCarousel" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>

            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=1200&h=500&fit=crop"
                        class="d-block w-100" alt="Delicious Sweets" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Delicious Sweets</h3>
                        <p class="lead text-white mb-4 carousel-text">Taste sweetness of our traditional & modern treats
                        </p>
                        <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn"
                            style="color:#f8f9fa!important">Shop Now</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=1200&h=500&fit=crop"
                        class="d-block w-100" alt="Fresh Baked Goods" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Fresh Baked Goods</h3>
                        <p class="lead text-white mb-4 carousel-text">Get up to 50% off on freshly baked items</p>
                        <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn">View
                            Deals</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1551024601-bec78aea704b?w=1200&h=500&fit=crop"
                        class="d-block w-100" alt="Special Cakes" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Special Cakes</h3>
                        <p class="lead text-white mb-4 carousel-text">Celebrate with our premium cakes for every
                            occasion</p>
                        <a href="{{ route('shop.search.index') }}"
                            class="btn text-white btn-dark carousel-btn">Explore</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=1200&h=500&fit=crop"
                        class="d-block w-100" alt="Premium Bakery" style="height: 500px; object-fit: cover;">
                    <div class="carousel-caption">
                        <h3 class="display-4 fw-bold text-white mb-3 carousel-title">Premium Bakery</h3>
                        <p class="lead text-white mb-4 carousel-text">Experience finest bakery products</p>
                        <a href="{{ route('shop.search.index') }}"
                            class="btn text-white btn-dark carousel-btn text-white">Discover More</a>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#customBootstrapCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#customBootstrapCarousel"
                data-bs-slide="next">
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
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 100%);
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
                                    <button class="btn text-white btn-dark category-carousel-prev me-2"
                                        type="button">❮</button>
                                    <button class="btn text-white btn-dark category-carousel-next"
                                        type="button">❯</button>
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
                                $catImage = $subCat['logo_url'] ?? $subCat['image_url'] ?? $subCat['logo'] ??
                                $subCat['image'] ?? null;
                                @endphp

                                <div class="swiper-slide">
                                    <a href="{{ url('products/' . $catSlug) }}"
                                        class="nav-link text-center text-decoration-none text-dark">
                                        <div class="category-card d-flex flex-column align-items-center">
                                            @if($catImage)
                                            <img src="{{ $catImage }}" alt="{{ $catName }}"
                                                class="rounded-circle mb-3 img-fluid category-image"
                                                style="width: 140px; height: 140px; object-fit: cover; border: 3px solid #dee2e6; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                            @else
                                            <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center bg-light"
                                                style="width: 140px; height: 140px; border: 3px solid #dee2e6; margin: 0 auto;">
                                                <span class="fw-bold text-secondary"
                                                    style="font-size: 2rem;">{{ substr($catName, 0, 2) }}</span>
                                            </div>
                                            @endif
                                            <h4 class="fs-6 mt-3 fw-normal category-title text-dark text-center">
                                                {{ $catName }}</h4>
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
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


        <!-------------------------------- About Saffron Sweets & Bakery Section ----------------->
        <section class="py-5 about-section">
            <div class="container-lg">
                <div class="row align-items-center g-5">
                    <!-- Image Column -->
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <div class="about-image-wrapper position-relative rounded-4 overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=800&h=600&fit=crop"
                                alt="Saffron Sweets and Bakery" class="img-fluid w-100"
                                style="height: 500px; object-fit: cover;">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(135deg, rgba(255, 215, 0, 0.3) 0%, rgba(139, 69, 19, 0.2) 100%);">
                            </div>

                            <!-- Decorative Elements -->
                            <div class="position-absolute top-4 end-4 bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                style="width: 80px; height: 80px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <span class="fw-bold" style="color: #d4af37; font-size: 1.5rem;">25+</span>
                            </div>
                            <div
                                class="position-absolute bottom-4 start-4 bg-dark text-white rounded-3 px-4 py-2 shadow">
                                <p class="mb-0 fw-bold fs-5">Premium Quality</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="col-lg-6 col-md-12">
                        <div class="about-content h-100 d-flex flex-column justify-content-center">
                            <div class="section-badge d-inline-block mb-3">
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">WHO WE
                                    ARE</span>
                            </div>

                            <h2 class="display-4 fw-bold mb-4 text-dark"
                                style="font-family: 'Playfair Display', serif;">
                                Authentic Saffron Sweets & Traditional Bakery
                            </h2>

                            <p class="lead text-secondary mb-4">
                                Welcome to Saffron, where tradition meets excellence. We bring you to finest collection
                                of authentic Bengali sweets and premium bakery items, crafted with love and the purest
                                saffron.
                            </p>

                            <p class="text-muted mb-4">
                                Our skilled artisans use time-honored recipes passed down through generations to create
                                mouth-watering treats that will transport you to the streets of Bangladesh. From
                                roshogolla to sandesh, from freshly baked cakes to artisan cookies – every bite is a
                                celebration of flavor.
                            </p>

                            <!-- Features Grid -->
                            <div class="row g-3 mb-5">
                                <div class="col-6">
                                    <div class="feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="feature-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🌟</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Premium Quality</h6>
                                            <small class="text-muted">Best Ingredients</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="feature-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">👨‍🍳</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Expert Chefs</h6>
                                            <small class="text-muted">Skilled Artisans</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="feature-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🚚</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Fast Delivery</h6>
                                            <small class="text-muted">Quick Service</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="feature-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">💯</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Fresh Daily</h6>
                                            <small class="text-muted">Always Fresh</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('shop.search.index') }}"
                                    class="btn btn-dark btn-lg rounded-3 px-5 text-white">
                                    <i class="bi bi-cart me-2"></i>Shop Now
                                </a>
                                <a href="#" class="btn btn-outline-dark btn-lg rounded-3 px-5">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .about-section {
            background: linear-gradient(135deg, #fff9e6 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .about-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
        }

        .about-image-wrapper {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            cursor: pointer;
        }

        .about-image-wrapper:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2) !important;
        }

        .about-image-wrapper img {
            transition: transform 0.5s ease;
        }

        .about-image-wrapper:hover img {
            transform: scale(1.1);
        }

        .overlay {
            transition: opacity 0.3s ease;
        }

        .about-image-wrapper:hover .overlay {
            opacity: 0.5;
        }

        .feature-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            border-color: #d4af37;
        }

        .feature-icon {
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: rotate(360deg) scale(1.1);
        }

        @media (max-width: 992px) {
            .about-image-wrapper img {
                height: 400px !important;
            }
        }

        @media (max-width: 768px) {
            .about-section {
                padding: 3rem 0 !important;
            }

            .about-image-wrapper img {
                height: 300px !important;
            }

            .display-4 {
                font-size: 2rem !important;
            }

            .lead {
                font-size: 1rem !important;
            }

            .feature-card {
                padding: 1.5rem !important;
            }

            .btn-lg {
                padding: 0.5rem 1.5rem !important;
                font-size: 0.9rem !important;
            }
        }
        </style>
        @endpush

        <!-------------------------------- End About Section ----------------->


        <!-------------------------------- Featured Products (Using Bagisto Routes) ----------------->
        <section class="py-5" id="featured-products-section">
            <div class="container-lg">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h2 class="section-title">Featured Products</h2>
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('shop.search.index') }}" class="btn btn-dark d-lg-none text-white">
                            View All
                        </a>
                        <button id="products-prev" class="btn btn-dark " type="button">❮</button>
                        <button id="products-next" class="btn btn-dark" type="button">❯</button>
                    </div>
                </div>

                <div id="products-carousel" class="row gx-3 gy-4">
                    <!-- Products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-dark btn-lg text-white">
                        View All Products
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .product-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            padding: 2px;
            background: linear-gradient(135deg, #d4af37, #ff8c00);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.25);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 280px;
            background: linear-gradient(135deg, #fef9e7 0%, #fff3cd 100%);
        }

        .product-image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.05) 100%);
            pointer-events: none;
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .product-image {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            color: #1a1a1a;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 3rem;
            line-height: 1.5;
            margin-bottom: 0.5rem;
        }

        .product-card:hover .product-name {
            color: #d4af37 !important;
            transform: translateX(5px);
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #d4af37, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .badge-sale {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 3;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-new {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 3;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .action-icons {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 4;
            transform: translateX(20px);
        }

        .product-card:hover .action-icons {
            opacity: 1;
            transform: translateX(0);
        }

        .action-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(212, 175, 55, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #333;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .action-icon:hover {
            background: linear-gradient(135deg, #d4af37, #ff8c00);
            color: white;
            border-color: transparent;
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.5);
        }

        .action-icon.active {
            color: #dc3545;
            border-color: #dc3545;
            background: rgba(255, 255, 255, 0.95);
        }

        .action-icon.active:hover {
            color: white;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-color: transparent;
        }

        .btn-add-cart {
            width: 100%;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%) !important;
            color: white !important;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 14px 20px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-add-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-add-cart:hover::before {
            left: 100%;
        }

        .btn-add-cart:hover {
            background: linear-gradient(135deg, #d4af37 0%, #ff8c00 100%) !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-add-cart:disabled {
            background: #9ca3af !important;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .btn-add-cart:disabled::before {
            display: none;
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 220px;
            }

            .product-name {
                font-size: 1rem;
                height: 2.6rem;
            }

            .product-price {
                font-size: 1.3rem;
            }

            .action-icons {
                opacity: 1;
                transform: translateX(0);
            }

            .action-icon {
                width: 38px;
                height: 38px;
                font-size: 1.1rem;
            }

            .btn-add-cart {
                padding: 12px 16px;
                font-size: 0.9rem;
            }
        }
        </style>
        @endpush

        @push('scripts')
        <!-- SweetAlert2 for beautiful notifications -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @endpush

        @push('scripts-bottom')
        <script>
        // Configure SweetAlert2 default settings
        if (typeof Swal !== 'undefined') {
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            console.log('SweetAlert2 initialized');
        }

        var products = [];
        var currentOffset = 0;
        var productScrollAmount = 300;

        function loadFeaturedProducts() {
            const url = "{{ route('shop.api.products.index') }}?featured=1&sort=created_at&limit=8";

            console.log('Loading products from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Try different data structures based on Laravel API response
                    if (Array.isArray(data)) {
                        products = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        products = data.data;
                    } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
                        products = data.data.data;
                    } else if (data.data && data.data.data && data.data.data.data && Array.isArray(data.data.data
                            .data)) {
                        products = data.data.data.data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        products = [];
                    }

                    console.log('Products array length:', products.length);
                    console.log('Products array:', products);
                    renderProducts();
                    setupNavigationButtons();
                })
                .catch(error => {
                    console.error('Error loading products:', error);
                    document.getElementById('products-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading products: ' + error.message +
                        '</div>';
                });
        }

        function renderProducts() {
            const carousel = document.getElementById('products-carousel');

            if (!products || products.length === 0) {
                carousel.innerHTML = '<div class="col-12 text-center text-muted">No featured products available.</div>';
                return;
            }

            let html =
                '<div class="d-flex gap-4" id="products-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch;">';

            products.forEach(product => {
                const isSaleable = product.is_saleable !== false;
                const isOnSale = product.on_sale === true;
                const isNew = product.is_new === true;
                const isWishlisted = product.is_wishlist === true;
                const productUrl = "{{ route('shop.product_or_category.index', '') }}/" + product.url_key;
                const productImage = product.base_image?.medium_image_url || '/images/default-product.png';
                const priceHtml = product.price_html || '৳0.00';
                const ratings = product.ratings?.average || 0;
                const ratingsTotal = product.ratings?.total || 0;

                html += `
                        <div class="product-card flex-shrink-0" style="width: 280px; min-width: 280px;">
                            <div class="product-image-container">
                                ${isOnSale ? '<span class="badge-sale">Sale</span>' : ''}
                                ${isNew && !isOnSale ? '<span class="badge-new">New</span>' : ''}

                                <a href="${productUrl}" class="text-decoration-none">
                                    <img src="${productImage}" alt="${product.name}" class="product-image">
                                </a>

                                <div class="action-icons">
                                    <button class="action-icon ${isWishlisted ? 'active' : ''}"
                                            onclick="addToWishlist('${product.id}', this)"
                                            title="Add to Wishlist">
                                        ${isWishlisted ? '♥' : '♡'}
                                    </button>
                                    <button class="action-icon"
                                            onclick="addToCompare('${product.id}')"
                                            title="Add to Compare">
                                        ⤢
                                    </button>
                                </div>

                                ${ratingsTotal > 0 ? `
                                    <div style="position: absolute; bottom: 10px; left: 10px; background: rgba(255,255,255,0.9); padding: 5px 10px; border-radius: 5px; z-index: 1;">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-3">
                                    ${priceHtml}
                                </div>

                                <button class="btn btn-add-cart"
                                        ${!isSaleable ? 'disabled' : ''}
                                        onclick="addToCart('${product.id}', this)">
                                    Add To Cart
                                </button>
                            </div>
                        </div>
                    `;
            });

            html += '</div>';
            carousel.innerHTML = html;
        }

        function renderStars(rating) {
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= Math.round(rating)) {
                    stars += '★';
                } else {
                    stars += '☆';
                }
            }
            return `<span style="color: #ffc107; font-size: 14px;">${stars}</span>`;
        }

        function addToCart(productId, button) {
            if (!productId) return;

            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Adding...';

            const url = "{{ route('shop.api.checkout.cart.store') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                document.querySelector('input[name="_token"]')?.value;

            console.log('Add to cart clicked for product:', productId);
            console.log('CSRF Token:', csrfToken);

            // Function to reset button state
            const resetButton = () => {
                button.disabled = false;
                button.innerHTML = 'Add To Cart';
                console.log('Button reset');
            };

            // Use fetch API (native browser API)
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: new URLSearchParams({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Cart response SUCCESS:', data);

                    // Check for redirect first (e.g., for configurable products)
                    if (data.redirect_uri) {
                        window.location.href = data.redirect_uri;
                        return;
                    }

                    // Fetch updated cart data from API to ensure accurate cart count
                    const cartApiUrl = "{{ route('shop.api.checkout.cart.index') }}";
                    fetch(cartApiUrl, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(cartResponse => {
                            console.log('Fetched updated cart data:', cartResponse.data);

                            // Emit update-mini-cart event using Vue emitter - this updates cart counter
                            if (window.app && window.app.config && window.app.config.globalProperties && window
                                .app.config.globalProperties.$emitter) {
                                window.app.config.globalProperties.$emitter.emit('update-mini-cart',
                                    cartResponse.data);
                                console.log('Emitted update-mini-cart event with cart data:', cartResponse
                                .data);
                            } else if (window.app && window.app._context && window.app._context.provides &&
                                window.app._context.provides.emitter) {
                                // Alternative access path for emitter
                                window.app._context.provides.emitter.emit('update-mini-cart', cartResponse
                                .data);
                                console.log('Emitted update-mini-cart event (alternative path) with cart data:',
                                    cartResponse.data);
                            } else {
                                console.warn('Vue emitter not accessible, attempting DOM update as fallback');

                                // Fallback: Direct DOM update for cart counter
                                const cartData = cartResponse.data;
                                if (cartData) {
                                    const badgeSelectors = [
                                        '.absolute.-top-4.rounded-\\[44px\\].bg-navyBlue',
                                        'span[class*="cart"] span[class*="-top-4"]',
                                        'span[style*="position: absolute"][style*="-top"]'
                                    ];

                                    badgeSelectors.forEach(selector => {
                                        const badges = document.querySelectorAll(selector);
                                        badges.forEach(badge => {
                                            const displayMode =
                                                "{{ core()->getConfigData('sales.checkout.my_cart.summary') }}";
                                            const newValue = displayMode ===
                                                'display_item_quantity' ? cartData.items_qty :
                                                cartData.items_count;
                                            badge.textContent = newValue;
                                            console.log('Updated cart counter to:', newValue);
                                        });
                                    });
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching cart data:', error);
                        });

                    // Emit add-flash event (shows toaster notification)
                    if (window.app && window.app.$emitter) {
                        if (data.message) {
                            window.app.$emitter.emit('add-flash', {
                                type: 'success',
                                message: data.message
                            });
                        } else {
                            window.app.$emitter.emit('add-flash', {
                                type: 'warning',
                                message: data.data.message
                            });
                        }
                        console.log('Emitted add-flash event');
                    } else {
                        // Show SweetAlert2 toast notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart',
                            text: data.message || 'Product added to cart successfully!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }

                    resetButton();
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);

                    let errorMessage = 'Failed to add product to cart. Please try again.';

                    // Try to get error message from response
                    if (error.response) {
                        errorMessage = error.response?.data?.message ||
                            error.response?.message ||
                            error.message ||
                            errorMessage;
                    } else {
                        errorMessage = error.message || errorMessage;
                    }

                    console.log('Error message:', errorMessage);

                    // Emit error flash
                    if (window.app && window.app.$emitter) {
                        window.app.$emitter.emit('add-flash', {
                            type: 'error',
                            message: errorMessage
                        });
                    } else {
                        // Show SweetAlert2 error notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }

                    resetButton();
                });
        }

        function addToWishlist(productId, button) {
            if (!productId) return;

            const isLoggedIn = "{{ auth()->guard('customer')->check() }}" === "1";

            if (!isLoggedIn) {
                window.location.href = "{{ route('shop.customer.session.index')}}";
                return;
            }

            const url = "{{ route('shop.api.customers.account.wishlist.store') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                document.querySelector('input[name="_token"]')?.value;

            const formData = new FormData();
            formData.append('product_id', productId);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Wishlist response:', data);

                    // Show SweetAlert2 wishlist notification
                    Swal.fire({
                        icon: 'success',
                        title: button.classList.contains('active') ? 'Removed from Wishlist' :
                            'Added to Wishlist',
                        text: data.data?.message || 'Wishlist updated successfully!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    // Toggle button state
                    if (button.classList.contains('active')) {
                        button.classList.remove('active');
                        button.innerHTML = '♡';
                    } else {
                        button.classList.add('active');
                        button.innerHTML = '♥';
                    }
                })
                .catch(error => {
                    console.error('Error adding to wishlist:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Wishlist Error',
                        text: 'Failed to update wishlist. Please try again.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                });
        }

        function addToCompare(productId) {
            if (!productId) return;

            const isLoggedIn = "{{ auth()->guard('customer')->check() }}" === "1";

            if (isLoggedIn) {
                const url = "{{ route('shop.api.compare.store') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                    document.querySelector('input[name="_token"]')?.value;

                const formData = new FormData();
                formData.append('product_id', productId);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Compare response:', data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Compare',
                            text: data.data?.message || 'Product added to compare list successfully!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    })
                    .catch(error => {
                        console.error('Error adding to compare:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Compare Error',
                            text: 'Failed to add to compare. Please try again.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
            } else {
                // Handle guest users
                let items = JSON.parse(localStorage.getItem('compare_items') || '[]');

                if (!items.includes(productId)) {
                    items.push(productId);
                    localStorage.setItem('compare_items', JSON.stringify(items));
                    Swal.fire({
                        icon: 'success',
                        title: 'Added to Compare',
                        text: 'Product added to compare list successfully!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Already in Compare',
                        text: 'Product already in compare list!',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            }
        }

        // Setup navigation buttons after products are loaded
        function setupNavigationButtons() {
            const prevBtn = document.getElementById('products-prev');
            const nextBtn = document.getElementById('products-next');

            if (!prevBtn || !nextBtn) {
                console.warn('Navigation buttons not found');
                return;
            }

            // Remove old event listeners
            const newPrevBtn = prevBtn.cloneNode(true);
            const newNextBtn = nextBtn.cloneNode(true);
            prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
            nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);

            // Add new event listeners
            newPrevBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('products-scroll-container');
                if (container) {
                    container.scrollBy({
                        left: -productScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Previous clicked, scrollLeft:', container.scrollLeft);
                } else {
                    console.error('Scroll container not found');
                }
            });

            newNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('products-scroll-container');
                if (container) {
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                        container.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                        console.log('Reached end, scrolling to start');
                    } else {
                        container.scrollBy({
                            left: productScrollAmount,
                            behavior: 'smooth'
                        });
                        console.log('Next clicked, scrollLeft:', container.scrollLeft);
                    }
                } else {
                    console.error('Scroll container not found');
                }
            });

            console.log('Navigation buttons setup complete');
        }

        // Load products on page load
        document.addEventListener('DOMContentLoaded', loadFeaturedProducts);
        </script>
        @endpush

        <!-------------------------------- End Featured Products --->


        <!-------------------------------- Traditional Bengali Sweets Section ----------------->
        <section class="py-5 sweets-section">
            <div class="container-lg">
                <div class="row align-items-center g-5">
                    <!-- Content Column -->
                    <div class="col-lg-6 col-md-12">
                        <div class="sweets-content h-100 d-flex flex-column justify-content-center">
                            <div class="section-badge d-inline-block mb-3">
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">OUR
                                    SPECIALTY</span>
                            </div>

                            <h2 class="display-4 fw-bold mb-4 text-dark"
                                style="font-family: 'Playfair Display', serif;">
                                Authentic Bengali Sweets Collection
                            </h2>

                            <p class="lead text-secondary mb-4">
                                Indulge in the rich heritage of Bengal with our exquisite collection of traditional
                                sweets, crafted with love and the finest ingredients.
                            </p>

                            <p class="text-muted mb-4">
                                From the melt-in-your-mouth roshogolla to the delicate sandesh, our sweets are made
                                using recipes passed down through generations. Each sweet is a celebration of authentic
                                Bengali tradition, bringing you the true taste of home.
                            </p>

                            <!-- Sweet Types Grid -->
                            <div class="row g-3 mb-5">
                                <div class="col-6">
                                    <div class="sweet-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="sweet-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🍯</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Roshogolla</h6>
                                            <small class="text-muted">Classic Sweet</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="sweet-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="sweet-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🧀</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Sandesh</h6>
                                            <small class="text-muted">Traditional</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="sweet-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="sweet-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🥧</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Ras Malai</h6>
                                            <small class="text-muted">Creamy Delight</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="sweet-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="sweet-icon bg-warning rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🍰</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Mishti Doi</h6>
                                            <small class="text-muted">Sweet Yogurt</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('shop.search.index') }}"
                                    class="btn btn-dark btn-lg rounded-3 px-5 text-white">
                                    <i class="bi bi-basket me-2"></i>Order Sweets
                                </a>
                                <a href="#" class="btn btn-outline-dark btn-lg rounded-3 px-5">
                                    View Menu
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <div class="sweets-image-wrapper position-relative rounded-4 overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1607330289024-1535c6b4e1c1?w=800&h=600&fit=crop"
                                alt="Bengali Sweets" class="img-fluid w-100" style="height: 500px; object-fit: cover;">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(135deg, rgba(255, 215, 0, 0.25) 0%, rgba(255, 140, 0, 0.15) 100%);">
                            </div>

                            <!-- Decorative Elements -->
                            <div class="position-absolute top-4 start-4 bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                style="width: 80px; height: 80px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <span class="fw-bold" style="color: #d4af37; font-size: 1.5rem;">50+</span>
                            </div>
                            <div class="position-absolute bottom-4 end-4 bg-dark text-white rounded-3 px-4 py-2 shadow">
                                <p class="mb-0 fw-bold fs-5">Fresh Daily</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .sweets-section {
            background: linear-gradient(135deg, #fff5e6 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .sweets-section::before {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 140, 0, 0.1);
            border-radius: 50%;
        }

        .sweets-image-wrapper {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            cursor: pointer;
        }

        .sweets-image-wrapper:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2) !important;
        }

        .sweets-image-wrapper img {
            transition: transform 0.5s ease;
        }

        .sweets-image-wrapper:hover img {
            transform: scale(1.1);
        }

        .sweet-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .sweet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            border-color: #ff8c00;
        }

        .sweet-icon {
            transition: transform 0.3s ease;
        }

        .sweet-card:hover .sweet-icon {
            transform: rotate(360deg) scale(1.1);
        }

        @media (max-width: 992px) {
            .sweets-image-wrapper img {
                height: 400px !important;
            }
        }

        @media (max-width: 768px) {
            .sweets-section {
                padding: 3rem 0 !important;
            }

            .sweets-image-wrapper img {
                height: 300px !important;
            }

            .display-4 {
                font-size: 2rem !important;
            }

            .lead {
                font-size: 1rem !important;
            }

            .sweet-card {
                padding: 1.5rem !important;
            }

            .btn-lg {
                padding: 0.5rem 1.5rem !important;
                font-size: 0.9rem !important;
            }
        }
        </style>
        @endpush

        <!-------------------------------- End Traditional Bengali Sweets Section --->


</x-shop::layouts>