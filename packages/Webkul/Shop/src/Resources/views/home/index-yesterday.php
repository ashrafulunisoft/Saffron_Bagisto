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

        <!-------------------------------- Spectacular Hero Banner ----------------->
        <section class="hero-banner-section">
            <div class="hero-container">
                <!-- Animated Background -->
                <div class="hero-background">
                    <div class="gradient-layer layer-1"></div>
                    <div class="gradient-layer layer-2"></div>
                    <div class="gradient-layer layer-3"></div>
                    <div class="particle-field"></div>
                </div>

                <!-- Floating Elements -->
                <div class="floating-elements">
                    <div class="floating-item item-1">🎂</div>
                    <div class="floating-item item-2">🍬</div>
                    <div class="floating-item item-3">🍩</div>
                    <div class="floating-item item-4">🧁</div>
                    <div class="floating-item item-5">🍰</div>
                    <div class="floating-item item-6">🍪</div>
                    <div class="floating-item item-7">🥧</div>
                    <div class="floating-item item-8">🍫</div>
                </div>

                <!-- Hero Content -->
                <div class="hero-content">
                    <div class="container-lg">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="hero-text-wrapper">
                                    <div class="hero-badge animate-fade-in-up">
                                        <span class="badge-inner">
                                            <span class="badge-icon">✨</span>
                                            Welcome To Saffron Sweets & Bakery
                                        </span>
                                    </div>

                                    <h1 class="hero-title animate-slide-in-left">
                                        <span class="title-word word-1">Tradition Meets</span>
                                        <span class="title-word word-2">Excellence in</span>
                                        <span class="title-word word-3">Every Bite</span>
                                    </h1>

                                    <p class="hero-subtitle animate-slide-in-left delay-2">
                                        Discover Bangladesh's finest collection of authentic Bengali sweets, premium
                                        chocolates, and freshly baked treats made with pure saffron and love. Crafted
                                        using time-honored recipes passed down through generations.
                                    </p>

                                    <div class="hero-buttons animate-fade-in-up delay-3">
                                        <a href="{{ route('shop.search.index') }}"
                                            class="btn btn-hero btn-primary-hero">
                                            <span class="btn-text">Shop Now</span>
                                            <span class="btn-icon">→</span>
                                        </a>
                                        <a href="#about-section" class="btn btn-hero btn-secondary-hero">
                                            <span class="btn-text">Our Story</span>
                                            <span class="btn-icon">↓</span>
                                        </a>
                                    </div>

                                    <!-- Stats -->
                                    <div class="hero-stats animate-fade-in-up delay-4">
                                        <div class="stat-item">
                                            <div class="stat-number">500</div>
                                            <div class="stat-label">Products</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">1000</div>
                                            <div class="stat-label">Happy Customers</div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-number">25</div>
                                            <div class="stat-label">Years Experience</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="hero-image-wrapper animate-float">
                                    <div class="hero-image-container">
                                        <div class="image-glow"></div>
                                        <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=800&h=600&fit=crop"
                                            alt="Delicious Sweets" class="hero-image">
                                        <div class="image-overlay"></div>
                                    </div>

                                    <!-- Floating Labels -->
                                    <div class="floating-label label-1 animate-bounce">
                                        <div class="label-icon">⭐</div>
                                        <div class="label-text">Premium Quality</div>
                                    </div>
                                    <div class="floating-label label-2 animate-bounce delay-1">
                                        <div class="label-icon">🚚</div>
                                        <div class="label-text">Fast Delivery</div>
                                    </div>
                                    <div class="floating-label label-3 animate-bounce delay-2">
                                        <div class="label-icon">💯</div>
                                        <div class="label-text">Fresh Daily</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scroll Indicator -->
                <div class="scroll-indicator">
                    <div class="scroll-text">Scroll Down</div>
                    <div class="scroll-arrow">
                        <span class="arrow"></span>
                    </div>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        /* Hero Banner Section */
        .hero-banner-section {
            position: relative;
            min-height: 40vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, #fff9e6 0%, #fff5f0 50%, #fff5f5 100%);
        }

        /* Animated Background Layers */
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .gradient-layer {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.6;
            animation: gradient-shift 15s ease-in-out infinite;
        }

        .layer-1 {
            background: radial-gradient(ellipse at 20% 50%, rgba(255, 193, 7, 0.15) 0%, transparent 50%);
        }

        .layer-2 {
            background: radial-gradient(ellipse at 80% 20%, rgba(255, 87, 34, 0.12) 0%, transparent 50%);
            animation-delay: -5s;
        }

        .layer-3 {
            background: radial-gradient(ellipse at 50% 80%, rgba(233, 30, 99, 0.1) 0%, transparent 50%);
            animation-delay: -10s;
        }

        @keyframes gradient-shift {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.1) rotate(5deg);
            }
        }

        /* Particle Field */
        .particle-field {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle-field::before,
        .particle-field::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffc107' fill-opacity='0.03'%3E%3Cpath d='M30 20c-1.1 0-2 0.9-2 2s0.9 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2-0.9 2-2-0.9-2-2-2zM15 10c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zM45 10c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z'/%3E%3C/g%3E%3C/svg%3E");
            animation: particle-float 20s linear infinite;
        }

        .particle-field::after {
            animation-delay: -10s;
            opacity: 0.5;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-60px);
            }
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }

        .floating-item {
            position: absolute;
            font-size: 2.5rem;
            animation: float-emoji 8s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .item-1 {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .item-2 {
            top: 20%;
            right: 10%;
            animation-delay: -1s;
        }

        .item-3 {
            top: 60%;
            left: 8%;
            animation-delay: -2s;
        }

        .item-4 {
            top: 70%;
            right: 5%;
            animation-delay: -3s;
        }

        .item-5 {
            top: 40%;
            left: 15%;
            animation-delay: -4s;
        }

        .item-6 {
            top: 50%;
            right: 15%;
            animation-delay: -5s;
        }

        .item-7 {
            top: 30%;
            left: 3%;
            animation-delay: -6s;
        }

        .item-8 {
            top: 80%;
            right: 12%;
            animation-delay: -7s;
        }

        @keyframes float-emoji {

            0%,
            100% {
                transform: translateY(0) rotate(0deg) scale(1);
                opacity: 0.8;
            }

            50% {
                transform: translateY(-20px) rotate(10deg) scale(1.1);
                opacity: 1;
            }
        }

        /* Hero Content */
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 10px 0;
        }

        .hero-text-wrapper {
            padding-right: 30px;
        }

        /* Hero Badge */
        .hero-badge {
            display: inline-block;
            margin-bottom: 2rem;
        }

        .badge-inner {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 193, 7, 0.15);
            border: 2px solid rgba(255, 193, 7, 0.3);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            color: #e65100;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .badge-inner:hover {
            background: rgba(255, 193, 7, 0.25);
            border-color: rgba(255, 193, 7, 0.5);
            transform: scale(1.05);
        }

        .badge-icon {
            font-size: 1.25rem;
            animation: badge-pulse 2s ease-in-out infinite;
        }

        @keyframes badge-pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
        }

        /* Hero Title */
        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            font-family: 'Playfair Display', serif;
        }

        .title-word {
            display: block;
            opacity: 0;
            transform: translateY(30px);
        }

        .word-1 {
            background: linear-gradient(135deg, #ffc107, #ff9800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: word-reveal 0.8s ease-out forwards 0.2s;
        }

        .word-2 {
            background: linear-gradient(135deg, #e65100, #d84315);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: word-reveal 0.8s ease-out forwards 0.4s;
        }

        .word-3 {
            background: linear-gradient(135deg, #ff5722, #f44336);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: word-reveal 0.8s ease-out forwards 0.6s;
        }

        @keyframes word-reveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero Subtitle */
        .hero-subtitle {
            font-size: 1.25rem;
            color: #616161;
            line-height: 1.8;
            margin-bottom: 2.5rem;
            opacity: 0;
            transform: translateX(-30px);
        }

        .animate-slide-in-left {
            animation: slide-in-left 1s ease-out forwards;
        }

        @keyframes slide-in-left {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .delay-2 {
            animation-delay: 0.8s;
        }

        .delay-3 {
            animation-delay: 1s;
        }

        .delay-4 {
            animation-delay: 1.2s;
        }

        /* Hero Buttons */
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, #ffc107, #ff9800, #f57c00);
            color: #212529;
            box-shadow: 0 8px 25px rgba(255, 152, 0, 0.4);
            border: none;
        }

        .btn-primary-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-hero:hover::before {
            left: 100%;
        }

        .btn-primary-hero:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255, 152, 0, 0.5);
        }

        .btn-secondary-hero {
            background: transparent;
            color: #212529;
            border: 3px solid #212529;
        }

        .btn-secondary-hero:hover {
            background: #212529;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(33, 37, 41, 0.3);
        }

        .btn-icon {
            transition: transform 0.3s ease;
        }

        .btn-hero:hover .btn-icon {
            transform: translateX(5px);
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            gap: 3rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffc107, #e65100);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #757575;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Hero Image */
        .hero-image-wrapper {
            position: relative;
            text-align: center;
        }

        .hero-image-container {
            position: relative;
            display: inline-block;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .image-glow {
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.3), rgba(255, 87, 34, 0.3));
            border-radius: 50%;
            filter: blur(40px);
            z-index: -1;
        }

        .hero-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 30px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 30px;
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(255, 87, 34, 0.1));
            pointer-events: none;
        }

        /* Floating Labels */
        .floating-label {
            position: absolute;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 193, 7, 0.3);
        }

        .label-1 {
            top: 10%;
            right: -10%;
        }

        .label-2 {
            bottom: 20%;
            left: -5%;
        }

        .label-3 {
            bottom: 10%;
            right: 5%;
        }

        .label-icon {
            font-size: 1.5rem;
        }

        .label-text {
            font-weight: 700;
            font-size: 0.9rem;
            color: #212529;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .delay-1 {
            animation-delay: -1s;
        }

        .delay-2 {
            animation-delay: -2s;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 2;
        }

        .scroll-text {
            font-size: 0.85rem;
            color: #757575;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .scroll-arrow {
            width: 30px;
            height: 50px;
            border: 2px solid #ffc107;
            border-radius: 25px;
            position: relative;
            margin: 0 auto;
        }

        .arrow {
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 6px;
            background: #ffc107;
            border-radius: 50%;
            animation: scroll-bounce 2s ease-in-out infinite;
        }

        @keyframes scroll-bounce {

            0%,
            100% {
                top: 8px;
                opacity: 1;
            }

            50% {
                top: 30px;
                opacity: 0.3;
            }
        }

        /* Animation Classes */
        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fade-in-up 1s ease-out forwards;
        }

        @keyframes fade-in-up {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3.5rem;
            }

            .hero-image {
                max-width: 400px;
            }

            .hero-stats {
                gap: 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-banner-section {
                min-height: auto;
                padding: 20px 0;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-text-wrapper {
                padding-right: 0;
                text-align: center;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-stats {
                justify-content: center;
                flex-wrap: wrap;
                gap: 1.5rem;
            }

            .hero-image {
                max-width: 300px;
                margin-top: 2rem;
            }

            .floating-item {
                font-size: 1.5rem;
            }

            .floating-label {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .btn-hero {
                padding: 0.875rem 2rem;
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .stat-number {
                font-size: 1.75rem;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        // Parallax effect for floating elements
        document.addEventListener('mousemove', function(e) {
            const floatingItems = document.querySelectorAll('.floating-item');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            floatingItems.forEach((item, index) => {
                const speed = (index + 1) * 0.5;
                const x = (mouseX - 0.5) * speed * 50;
                const y = (mouseY - 0.5) * speed * 50;

                item.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
        </script>
        @endpush

        <!-------------------------------- End Spectacular Hero Banner --->




        <!-- ----------------------------------------------- Static content : only Bootstrap ------------------------------------------------------------------------ -->

        <!-- 1. Task 1:   add here custom slider #customBootstrapCarousel -->

        <!-- Bootstrap Carousel Slider -->
        {{-- <div id="customBootstrapCarousel" class="carousel slide mb-4" data-bs-ride="carousel" data-bs-interval="5000"
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
                <a href="{{ route('shop.search.index') }}" class="btn text-white btn-dark carousel-btn">Explore</a>
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
        </div> --}}

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
        <section class="py-5 featured-products-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="featured-header mb-3">
                        <span class="featured-icon">✨</span>
                        <h2 class="section-title">Featured Products</h2>
                        <span class="featured-icon">✨</span>
                    </div>
                    <p class="text-muted mb-0">Discover our handpicked selection of finest products</p>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3 mb-4 text-white">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-outline-success d-lg-none">
                        View All
                    </a>
                    <button id="products-prev" class="btn btn-outline-success product-nav-btn" type="button"
                        onclick="scrollProducts('prev')">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button id="products-next" class="btn btn-outline-success product-nav-btn" type="button"
                        onclick="scrollProducts('next')">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="products-carousel" class="row gx-3 gy-4">
                    <!-- Products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-success btn-lg px-5">
                        View All Products
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
        .featured-products-section {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 30%, #ffffff 70%, #f0fdf4 100%);
            position: relative;
            overflow: hidden;
        }

        .featured-products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2328a745' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .featured-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .featured-icon {
            font-size: 2rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        @keyframes sparkle {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.2) rotate(10deg);
                opacity: 0.8;
            }
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .product-card {
            border: 2px solid #e8f5e9;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(40, 167, 69, 0.12);
            position: relative;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 14px;
            padding: 3px;
            background: linear-gradient(135deg, #28a745, #20c997, #16a34a);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 50px rgba(40, 167, 69, 0.25);
            border-color: #28a745;
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            z-index: 1;
        }

        .product-image-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 70%, rgba(40, 167, 69, 0.05) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-image {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: relative;
            z-index: 1;
        }

        .product-name {
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #2d3748;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.5rem;
            line-height: 1.25;
            margin-bottom: 0.5rem;
        }

        .product-card:hover .product-name {
            color: #28a745 !important;
            transform: translateX(3px);
        }

        .product-price {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 0.5rem;
        }

        .price-current {
            font-size: 1.15rem;
            font-weight: 700;
            color: #28a745;
            line-height: 1;
        }

        .price-original {
            font-size: 0.85rem;
            color: #9ca3af;
            text-decoration: line-through;
            font-weight: 400;
        }

        .badge-sale {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #ff4757 0%, #dc3545 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 800;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .badge-new {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 8px 18px;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 800;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            animation: pulse-badge 2s ease-in-out infinite;
        }

        .action-icons {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 3;
            transform: translateX(15px);
        }

        .product-card:hover .action-icons {
            opacity: 1;
            transform: translateX(0);
        }

        .action-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(40, 167, 69, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #4a5568;
            font-size: 1.1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .action-icon:hover {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-color: transparent;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 12px 16px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 10px rgba(40, 167, 69, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
            cursor: pointer;
        }

        .btn-add-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-add-cart:hover::before {
            left: 100%;
        }

        .btn-add-cart:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%) !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        }

        .btn-add-cart:disabled {
            background: #a0aec0 !important;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .btn-add-cart:disabled::before {
            display: none;
        }

        .product-nav-btn {
            width: 45px;
            height: 45px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .product-nav-btn:hover {
            background: #28a745 !important;
            color: white !important;
            transform: scale(1.1);
        }

        /* Center products in featured carousel */
        #products-scroll-container {
            justify-content: center;
        }

        #products-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        #products-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #products-scroll-container::-webkit-scrollbar-thumb {
            background: #28a745;
            border-radius: 10px;
        }

        #products-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #20c997;
        }

        @media (max-width: 768px) {
            .product-image-container {
                height: 160px;
            }

            .product-name {
                font-size: 0.85rem;
                height: 2.3rem;
            }

            .price-current {
                font-size: 1rem;
            }

            .price-original {
                font-size: 0.75rem;
            }

            .action-icons {
                opacity: 1;
                transform: translateX(0);
            }

            .action-icon {
                width: 35px;
                height: 35px;
                font-size: 1rem;
            }

            .btn-add-cart {
                padding: 10px 14px;
                font-size: 0.85rem;
            }

            .product-nav-btn {
                width: 38px;
                height: 38px;
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
                '<div class="d-flex gap-4" id="products-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch; padding-bottom: 10px;">';

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
                        <div class="product-card flex-shrink-0" style="width: 270px; min-width: 270px;">
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
                                    <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3" style="position: relative; z-index: 1;">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-2">
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

        // Helper function for Featured Products scrolling (inline onclick backup)
        function scrollProducts(direction) {
            const container = document.getElementById('products-scroll-container');
            if (!container) {
                console.error('Featured scroll container not found');
                return;
            }

            if (direction === 'prev') {
                container.scrollBy({
                    left: -productScrollAmount,
                    behavior: 'smooth'
                });
                console.log('Featured Previous clicked, scrollLeft:', container.scrollLeft);
            } else if (direction === 'next') {
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log('Featured reached end, scrolling to start');
                } else {
                    container.scrollBy({
                        left: productScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Featured Next clicked, scrollLeft:', container.scrollLeft);
                }
            }
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


        <!-------------------------------- Sweet Category Products Section ----------------->
        <section class="py-5 sweet-category-products-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="sweet-header mb-3">
                        <span class="sweet-icon">🍬</span>
                        <h2 class="section-title">Sweet Category Products</h2>
                        <span class="sweet-icon">🍬</span>
                    </div>
                    <p class="text-muted mb-0">Discover our delicious collection of sweets</p>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-outline-warning d-lg-none">
                        View All
                    </a>
                    <button id="sweets-prev" class="btn btn-outline-warning sweet-nav-btn" type="button"
                        onclick="scrollSweets('prev')">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button id="sweets-next" class="btn btn-outline-warning sweet-nav-btn" type="button"
                        onclick="scrollSweets('next')">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="sweets-carousel" class="row gx-3 gy-4">
                    <!-- Sweet products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-warning btn-lg px-5 text-white">
                        View All Sweets
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .sweet-category-products-section {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 30%, #ffffff 70%, #fff9e6 100%);
            position: relative;
            overflow: hidden;
        }

        .sweet-category-products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffc107' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .sweet-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .sweet-icon {
            font-size: 2rem;
            animation: bounce-sweet 2s ease-in-out infinite;
        }

        @keyframes bounce-sweet {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .sweet-category-products-section .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #ffc107, #ff9800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sweet-nav-btn {
            width: 45px;
            height: 45px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .sweet-nav-btn:hover {
            background: #ffc107 !important;
            color: #212529 !important;
            transform: scale(1.1);
        }

        /* Center products in sweet carousel */
        #sweets-scroll-container {
            justify-content: center;
        }

        #sweets-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        #sweets-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #sweets-scroll-container::-webkit-scrollbar-thumb {
            background: #ffc107;
            border-radius: 10px;
        }

        #sweets-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #ff9800;
        }

        @media (max-width: 768px) {
            .sweet-nav-btn {
                width: 38px;
                height: 38px;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        var sweetProducts = [];
        var sweetScrollAmount = 300;

        function loadSweetCategoryProducts() {
            const url = "{{ route('shop.api.products.index') }}?category_id=12&limit=8";

            console.log('Loading sweet products from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Sweet products response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Sweet products API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Try different data structures based on Laravel API response
                    if (Array.isArray(data)) {
                        sweetProducts = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        sweetProducts = data.data;
                    } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
                        sweetProducts = data.data.data;
                    } else if (data.data && data.data.data && data.data.data.data && Array.isArray(data.data.data
                            .data)) {
                        sweetProducts = data.data.data.data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        sweetProducts = [];
                    }

                    console.log('Sweet products array length:', sweetProducts.length);
                    console.log('Sweet products array:', sweetProducts);
                    renderSweetProducts();
                    setupSweetNavigationButtons();
                })
                .catch(error => {
                    console.error('Error loading sweet products:', error);
                    document.getElementById('sweets-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading sweet products: ' + error
                        .message + '</div>';
                });
        }

        function renderSweetProducts() {
            const carousel = document.getElementById('sweets-carousel');

            if (!sweetProducts || sweetProducts.length === 0) {
                carousel.innerHTML = '<div class="col-12 text-center text-muted">No sweet products available.</div>';
                return;
            }

            let html =
                '<div class="d-flex gap-4" id="sweets-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch; padding-bottom: 10px;">';

            sweetProducts.forEach(product => {
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
                        <div class="product-card flex-shrink-0" style="width: 270px; min-width: 270px;">
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
                                    <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3" style="position: relative; z-index: 1;">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-2">
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

        function setupSweetNavigationButtons() {
            const prevBtn = document.getElementById('sweets-prev');
            const nextBtn = document.getElementById('sweets-next');

            if (!prevBtn || !nextBtn) {
                console.warn('Sweet navigation buttons not found');
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
                const container = document.getElementById('sweets-scroll-container');
                if (container) {
                    container.scrollBy({
                        left: -sweetScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Sweet Previous clicked, scrollLeft:', container.scrollLeft);
                } else {
                    console.error('Sweet scroll container not found');
                }
            });

            newNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('sweets-scroll-container');
                if (container) {
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                        container.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                        console.log('Sweet reached end, scrolling to start');
                    } else {
                        container.scrollBy({
                            left: sweetScrollAmount,
                            behavior: 'smooth'
                        });
                        console.log('Sweet Next clicked, scrollLeft:', container.scrollLeft);
                    }
                } else {
                    console.error('Sweet scroll container not found');
                }
            });

            console.log('Sweet navigation buttons setup complete');
        }

        // Helper function for Sweet Category Products scrolling (inline onclick backup)
        function scrollSweets(direction) {
            const container = document.getElementById('sweets-scroll-container');
            if (!container) {
                console.error('Sweet scroll container not found');
                return;
            }

            if (direction === 'prev') {
                container.scrollBy({
                    left: -sweetScrollAmount,
                    behavior: 'smooth'
                });
                console.log('Sweet Previous clicked, scrollLeft:', container.scrollLeft);
            } else if (direction === 'next') {
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log('Sweet reached end, scrolling to start');
                } else {
                    container.scrollBy({
                        left: sweetScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Sweet Next clicked, scrollLeft:', container.scrollLeft);
                }
            }
        }

        // Load sweet products on page load
        document.addEventListener('DOMContentLoaded', loadSweetCategoryProducts);
        </script>
        @endpush

        <!-------------------------------- End Sweet Category Products Section --->

        <!-------------------------------- Chocolate Section ----------------->
        <section class="py-5 chocolate-section">
            <div class="container-lg">
                <div class="row align-items-center g-5">
                    <!-- Image Column -->
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <div class="chocolate-image-wrapper position-relative rounded-4 overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=800&h=600&fit=crop"
                                alt="Premium Chocolate Collection" class="img-fluid w-100"
                                style="height: 500px; object-fit: cover;">
                            <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(135deg, rgba(139, 69, 19, 0.3) 0%, rgba(210, 180, 140, 0.2) 100%);">
                            </div>

                            <!-- Decorative Elements -->
                            <div class="position-absolute top-4 end-4 bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                                style="width: 80px; height: 80px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                                <span class="fw-bold" style="color: #8B4513; font-size: 1.5rem;">30+</span>
                            </div>
                            <div
                                class="position-absolute bottom-4 start-4 bg-dark text-white rounded-3 px-4 py-2 shadow">
                                <p class="mb-0 fw-bold fs-5">Handcrafted</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content Column -->
                    <div class="col-lg-6 col-md-12">
                        <div class="chocolate-content h-100 d-flex flex-column justify-content-center">
                            <div class="section-badge d-inline-block mb-3">
                                <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold">CHOCOLATE
                                    PARADISE</span>
                            </div>

                            <h2 class="display-4 fw-bold mb-4 text-dark"
                                style="font-family: 'Playfair Display', serif;">
                                Premium Chocolate & Cocoa Delights
                            </h2>

                            <p class="lead text-secondary mb-4">
                                Experience the ultimate indulgence with our exquisite collection of handcrafted
                                chocolates, made from the finest cocoa beans sourced from around the world.
                            </p>

                            <p class="text-muted mb-4">
                                From silky smooth dark chocolate to creamy milk chocolate truffles, our master
                                chocolatiers create artisanal pieces that will delight your senses. Each chocolate is
                                carefully crafted to deliver an unforgettable taste experience, perfect for gifts or
                                personal indulgence.
                            </p>

                            <!-- Features Grid -->
                            <div class="row g-3 mb-5">
                                <div class="col-6">
                                    <div
                                        class="chocolate-feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="chocolate-feature-icon bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🍫</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Premium Cocoa</h6>
                                            <small class="text-muted">Finest Quality</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                        class="chocolate-feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="chocolate-feature-icon bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">👨‍🍳</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Expert Makers</h6>
                                            <small class="text-muted">Master Chocolatiers</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                        class="chocolate-feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="chocolate-feature-icon bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">🎁</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Gift Ready</h6>
                                            <small class="text-muted">Beautiful Packaging</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div
                                        class="chocolate-feature-card bg-light rounded-3 p-3 d-flex align-items-center gap-3">
                                        <div class="chocolate-feature-icon bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px;">
                                            <span style="font-size: 1.5rem;">💝</span>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">Made with Love</h6>
                                            <small class="text-muted">Artisan Crafted</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Buttons -->
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('shop.search.index') }}"
                                    class="btn btn-danger btn-lg rounded-3 px-5 text-white">
                                    <i class="bi bi-cart me-2"></i>Chocolates
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-lg rounded-3 px-5">
                                    Explore Collection
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .chocolate-section {
            background: linear-gradient(135deg, #fff5f0 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .chocolate-section::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(139, 69, 19, 0.1);
            border-radius: 50%;
        }

        .chocolate-image-wrapper {
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            cursor: pointer;
        }

        .chocolate-image-wrapper:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2) !important;
        }

        .chocolate-image-wrapper img {
            transition: transform 0.5s ease;
        }

        .chocolate-image-wrapper:hover img {
            transform: scale(1.1);
        }

        .overlay {
            transition: opacity 0.3s ease;
        }

        .chocolate-image-wrapper:hover .overlay {
            opacity: 0.5;
        }

        .chocolate-feature-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .chocolate-feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
            border-color: #8B4513;
        }

        .chocolate-feature-icon {
            transition: transform 0.3s ease;
        }

        .chocolate-feature-card:hover .chocolate-feature-icon {
            transform: rotate(360deg) scale(1.1);
        }

        @media (max-width: 992px) {
            .chocolate-image-wrapper img {
                height: 400px !important;
            }
        }

        @media (max-width: 768px) {
            .chocolate-section {
                padding: 3rem 0 !important;
            }

            .chocolate-image-wrapper img {
                height: 300px !important;
            }

            .display-4 {
                font-size: 2rem !important;
            }

            .lead {
                font-size: 1rem !important;
            }

            .chocolate-feature-card {
                padding: 1.5rem !important;
            }

            .btn-lg {
                padding: 0.5rem 1.5rem !important;
                font-size: 0.9rem !important;
            }
        }
        </style>
        @endpush

        <!-------------------------------- End Chocolate Section --->


        <!-------------------------------- Chocolate Category Products Section ----------------->
        <section class="py-5 chocolate-category-products-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="chocolate-header mb-3">
                        <span class="chocolate-icon">🍫</span>
                        <h2 class="section-title">Chocolate Category Products</h2>
                        <span class="chocolate-icon">🍫</span>
                    </div>
                    <p class="text-muted mb-0">Discover our exquisite collection of premium chocolates</p>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-outline-danger d-lg-none">
                        View All
                    </a>
                    <button id="chocolate-prev" class="btn btn-outline-danger chocolate-nav-btn" type="button"
                        onclick="scrollChocolates('prev')">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button id="chocolate-next" class="btn btn-outline-danger chocolate-nav-btn" type="button"
                        onclick="scrollChocolates('next')">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="chocolate-carousel" class="row gx-3 gy-4">
                    <!-- Chocolate products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-danger btn-lg px-5 text-white">
                        View All Chocolates
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .chocolate-category-products-section {
            background: linear-gradient(135deg, #fff5f0 0%, #ffe4e1 30%, #ffffff 70%, #fff5f0 100%);
            position: relative;
            overflow: hidden;
        }

        .chocolate-category-products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238B4513' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .chocolate-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .chocolate-icon {
            font-size: 2rem;
            animation: bounce-chocolate 2s ease-in-out infinite;
        }

        @keyframes bounce-chocolate {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .chocolate-category-products-section .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #8B4513, #D2691E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .chocolate-nav-btn {
            width: 45px;
            height: 45px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .chocolate-nav-btn:hover {
            background: #8B4513 !important;
            color: white !important;
            transform: scale(1.1);
        }

        /* Center products in chocolate carousel */
        #chocolates-scroll-container {
            justify-content: center;
        }

        #chocolates-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        #chocolates-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #chocolates-scroll-container::-webkit-scrollbar-thumb {
            background: #8B4513;
            border-radius: 10px;
        }

        #chocolates-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #D2691E;
        }

        @media (max-width: 768px) {
            .chocolate-nav-btn {
                width: 38px;
                height: 38px;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        var chocolateProducts = [];
        var chocolateScrollAmount = 300;

        function loadChocolateCategoryProducts() {
            const url = "{{ route('shop.api.products.index') }}?category_id=19&limit=8";

            console.log('Loading chocolate products from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Chocolate products response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Chocolate products API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Try different data structures based on Laravel API response
                    if (Array.isArray(data)) {
                        chocolateProducts = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        chocolateProducts = data.data;
                    } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
                        chocolateProducts = data.data.data;
                    } else if (data.data && data.data.data && data.data.data.data && Array.isArray(data.data.data
                            .data)) {
                        chocolateProducts = data.data.data.data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        chocolateProducts = [];
                    }

                    console.log('Chocolate products array length:', chocolateProducts.length);
                    console.log('Chocolate products array:', chocolateProducts);
                    renderChocolateProducts();
                    setupChocolateNavigationButtons();
                })
                .catch(error => {
                    console.error('Error loading chocolate products:', error);
                    document.getElementById('chocolate-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading chocolate products: ' + error
                        .message + '</div>';
                });
        }

        function renderChocolateProducts() {
            const carousel = document.getElementById('chocolate-carousel');

            if (!chocolateProducts || chocolateProducts.length === 0) {
                carousel.innerHTML =
                '<div class="col-12 text-center text-muted">No chocolate products available.</div>';
                return;
            }

            let html =
                '<div class="d-flex gap-4" id="chocolates-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch; padding-bottom: 10px;">';

            chocolateProducts.forEach(product => {
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
                        <div class="product-card flex-shrink-0" style="width: 270px; min-width: 270px;">
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
                                    <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3" style="position: relative; z-index: 1;">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-2">
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

        function setupChocolateNavigationButtons() {
            const prevBtn = document.getElementById('chocolate-prev');
            const nextBtn = document.getElementById('chocolate-next');

            if (!prevBtn || !nextBtn) {
                console.warn('Chocolate navigation buttons not found');
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
                const container = document.getElementById('chocolates-scroll-container');
                if (container) {
                    container.scrollBy({
                        left: -chocolateScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Chocolate Previous clicked, scrollLeft:', container.scrollLeft);
                } else {
                    console.error('Chocolate scroll container not found');
                }
            });

            newNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('chocolates-scroll-container');
                if (container) {
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                        container.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                        console.log('Chocolate reached end, scrolling to start');
                    } else {
                        container.scrollBy({
                            left: chocolateScrollAmount,
                            behavior: 'smooth'
                        });
                        console.log('Chocolate Next clicked, scrollLeft:', container.scrollLeft);
                    }
                } else {
                    console.error('Chocolate scroll container not found');
                }
            });

            console.log('Chocolate navigation buttons setup complete');
        }

        // Helper function for Chocolate Category Products scrolling (inline onclick backup)
        function scrollChocolates(direction) {
            const container = document.getElementById('chocolates-scroll-container');
            if (!container) {
                console.error('Chocolate scroll container not found');
                return;
            }

            if (direction === 'prev') {
                container.scrollBy({
                    left: -chocolateScrollAmount,
                    behavior: 'smooth'
                });
                console.log('Chocolate Previous clicked, scrollLeft:', container.scrollLeft);
            } else if (direction === 'next') {
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log('Chocolate reached end, scrolling to start');
                } else {
                    container.scrollBy({
                        left: chocolateScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Chocolate Next clicked, scrollLeft:', container.scrollLeft);
                }
            }
        }

        // Load chocolate products on page load
        document.addEventListener('DOMContentLoaded', loadChocolateCategoryProducts);
        </script>
        @endpush

        <!-------------------------------- End Chocolate Category Products Section --->


        <!-------------------------------- Best Selling Products Section ----------------->
        <section class="py-5 best-selling-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="best-selling-header mb-3">
                        <span class="best-selling-icon">🏆</span>
                        <h2 class="section-title">Best Selling Products</h2>
                        <span class="best-selling-icon">🏆</span>
                    </div>
                    <p class="text-muted mb-0">Top products our customers love the most</p>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-outline-success d-lg-none">
                        View All
                    </a>
                    <button id="best-selling-prev" class="btn btn-outline-success best-selling-nav-btn" type="button"
                        onclick="scrollBestSelling('prev')">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button id="best-selling-next" class="btn btn-outline-success best-selling-nav-btn" type="button"
                        onclick="scrollBestSelling('next')">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="best-selling-carousel" class="row gx-3 gy-4">
                    <!-- Best selling products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-success btn-lg px-5 text-white">
                        View All Products
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .best-selling-section {
            background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 30%, #ffffff 70%, #e8f5e9 100%);
            position: relative;
            overflow: hidden;
        }

        .best-selling-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2328a745' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .best-selling-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .best-selling-icon {
            font-size: 2rem;
            animation: trophy-glow 2s ease-in-out infinite;
        }

        @keyframes trophy-glow {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.2) rotate(10deg);
                opacity: 0.9;
            }
        }

        .best-selling-section .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .best-selling-nav-btn {
            width: 45px;
            height: 45px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .best-selling-nav-btn:hover {
            background: #28a745 !important;
            color: white !important;
            transform: scale(1.1);
        }

        /* Center products in best selling carousel */
        #best-selling-scroll-container {
            justify-content: center;
        }

        #best-selling-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        #best-selling-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #best-selling-scroll-container::-webkit-scrollbar-thumb {
            background: #28a745;
            border-radius: 10px;
        }

        #best-selling-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #20c997;
        }

        @media (max-width: 768px) {
            .best-selling-nav-btn {
                width: 38px;
                height: 38px;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        var bestSellingProducts = [];
        var bestSellingScrollAmount = 300;

        function loadBestSellingProducts() {
            const url = "{{ route('shop.api.products.best-selling.index') }}?limit=8";

            console.log('Loading best selling products from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Best selling products response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Best selling products API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Try different data structures based on Laravel API response
                    if (Array.isArray(data)) {
                        bestSellingProducts = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        bestSellingProducts = data.data;
                    } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
                        bestSellingProducts = data.data.data;
                    } else if (data.data && data.data.data && data.data.data.data && Array.isArray(data.data.data
                            .data)) {
                        bestSellingProducts = data.data.data.data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        bestSellingProducts = [];
                    }

                    console.log('Best selling products array length:', bestSellingProducts.length);
                    console.log('Best selling products array:', bestSellingProducts);
                    renderBestSellingProducts();
                    setupBestSellingNavigationButtons();
                })
                .catch(error => {
                    console.error('Error loading best selling products:', error);
                    document.getElementById('best-selling-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading best selling products: ' + error
                        .message + '</div>';
                });
        }

        function renderBestSellingProducts() {
            const carousel = document.getElementById('best-selling-carousel');

            if (!bestSellingProducts || bestSellingProducts.length === 0) {
                carousel.innerHTML =
                    '<div class="col-12 text-center text-muted">No best selling products available.</div>';
                return;
            }

            let html =
                '<div class="d-flex gap-4" id="best-selling-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch; padding-bottom: 10px;">';

            bestSellingProducts.forEach(product => {
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
                        <div class="product-card flex-shrink-0" style="width: 270px; min-width: 270px;">
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
                                    <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3" style="position: relative; z-index: 1;">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-2">
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

        function setupBestSellingNavigationButtons() {
            const prevBtn = document.getElementById('best-selling-prev');
            const nextBtn = document.getElementById('best-selling-next');

            if (!prevBtn || !nextBtn) {
                console.warn('Best selling navigation buttons not found');
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
                const container = document.getElementById('best-selling-scroll-container');
                if (container) {
                    container.scrollBy({
                        left: -bestSellingScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Best selling Previous clicked, scrollLeft:', container.scrollLeft);
                } else {
                    console.error('Best selling scroll container not found');
                }
            });

            newNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('best-selling-scroll-container');
                if (container) {
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                        container.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                        console.log('Best selling reached end, scrolling to start');
                    } else {
                        container.scrollBy({
                            left: bestSellingScrollAmount,
                            behavior: 'smooth'
                        });
                        console.log('Best selling Next clicked, scrollLeft:', container.scrollLeft);
                    }
                } else {
                    console.error('Best selling scroll container not found');
                }
            });

            console.log('Best selling navigation buttons setup complete');
        }

        // Helper function for Best Selling Products scrolling (inline onclick backup)
        function scrollBestSelling(direction) {
            const container = document.getElementById('best-selling-scroll-container');
            if (!container) {
                console.error('Best selling scroll container not found');
                return;
            }

            if (direction === 'prev') {
                container.scrollBy({
                    left: -bestSellingScrollAmount,
                    behavior: 'smooth'
                });
                console.log('Best selling Previous clicked, scrollLeft:', container.scrollLeft);
            } else if (direction === 'next') {
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log('Best selling reached end, scrolling to start');
                } else {
                    container.scrollBy({
                        left: bestSellingScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Best selling Next clicked, scrollLeft:', container.scrollLeft);
                }
            }
        }

        // Load best selling products on page load
        document.addEventListener('DOMContentLoaded', loadBestSellingProducts);
        </script>
        @endpush

        <!-------------------------------- Popular Products Section ----------------->
        <section class="py-5 popular-products-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="popular-header mb-3">
                        <span class="popular-icon">🔥</span>
                        <h2 class="section-title">Popular Products</h2>
                        <span class="popular-icon">🔥</span>
                    </div>
                    <p class="text-muted mb-0">Most viewed and loved products</p>
                </div>
                <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-outline-danger d-lg-none">
                        View All
                    </a>
                    <button id="popular-prev" class="btn btn-outline-danger popular-nav-btn" type="button"
                        onclick="scrollPopular('prev')">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button id="popular-next" class="btn btn-outline-danger popular-nav-btn" type="button"
                        onclick="scrollPopular('next')">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                <div id="popular-carousel" class="row gx-3 gy-4">
                    <!-- Popular products will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4 d-none d-lg-block">
                    <a href="{{ route('shop.search.index') }}" class="btn btn-danger btn-lg px-5 text-white">
                        View All Products
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .popular-products-section {
            background: linear-gradient(135deg, #fff5f5 0%, #ffebee 30%, #ffffff 70%, #fff5f5 100%);
            position: relative;
            overflow: hidden;
        }

        .popular-products-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23dc3545' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .popular-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .popular-icon {
            font-size: 2rem;
            animation: fire-pulse 2s ease-in-out infinite;
        }

        @keyframes fire-pulse {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.2) rotate(10deg);
                opacity: 0.9;
            }
        }

        .popular-products-section .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #dc3545, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .popular-nav-btn {
            width: 45px;
            height: 45px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .popular-nav-btn:hover {
            background: #dc3545 !important;
            color: white !important;
            transform: scale(1.1);
        }

        /* Center products in popular carousel */
        #popular-scroll-container {
            justify-content: center;
        }

        #popular-scroll-container::-webkit-scrollbar {
            height: 8px;
        }

        #popular-scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #popular-scroll-container::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 10px;
        }

        #popular-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #e74c3c;
        }

        @media (max-width: 768px) {
            .popular-nav-btn {
                width: 38px;
                height: 38px;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        var popularProducts = [];
        var popularScrollAmount = 300;

        function loadPopularProducts() {
            const url = "{{ route('shop.api.products.popular.index') }}?limit=8";

            console.log('Loading popular products from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Popular products response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Popular products API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Try different data structures based on Laravel API response
                    if (Array.isArray(data)) {
                        popularProducts = data;
                    } else if (data.data && Array.isArray(data.data)) {
                        popularProducts = data.data;
                    } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
                        popularProducts = data.data.data;
                    } else if (data.data && data.data.data && data.data.data.data && Array.isArray(data.data.data
                            .data)) {
                        popularProducts = data.data.data.data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        popularProducts = [];
                    }

                    console.log('Popular products array length:', popularProducts.length);
                    console.log('Popular products array:', popularProducts);
                    renderPopularProducts();
                    setupPopularNavigationButtons();
                })
                .catch(error => {
                    console.error('Error loading popular products:', error);
                    document.getElementById('popular-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading popular products: ' + error
                        .message + '</div>';
                });
        }

        function renderPopularProducts() {
            const carousel = document.getElementById('popular-carousel');

            if (!popularProducts || popularProducts.length === 0) {
                carousel.innerHTML = '<div class="col-12 text-center text-muted">No popular products available.</div>';
                return;
            }

            let html =
                '<div class="d-flex gap-4" id="popular-scroll-container" style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: thin; -webkit-overflow-scrolling: touch; padding-bottom: 10px;">';

            popularProducts.forEach(product => {
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
                        <div class="product-card flex-shrink-0" style="width: 270px; min-width: 270px;">
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
                                    <div style="position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,0.95); padding: 4px 8px; border-radius: 6px; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                        ${renderStars(ratings)}
                                    </div>
                                ` : ''}
                            </div>

                            <div class="p-3" style="position: relative; z-index: 1;">
                                <a href="${productUrl}" class="text-decoration-none">
                                    <h5 class="product-name mb-2">${product.name}</h5>
                                </a>

                                <div class="product-price mb-2">
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

        function setupPopularNavigationButtons() {
            const prevBtn = document.getElementById('popular-prev');
            const nextBtn = document.getElementById('popular-next');

            if (!prevBtn || !nextBtn) {
                console.warn('Popular navigation buttons not found');
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
                const container = document.getElementById('popular-scroll-container');
                if (container) {
                    container.scrollBy({
                        left: -popularScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Popular Previous clicked, scrollLeft:', container.scrollLeft);
                } else {
                    console.error('Popular scroll container not found');
                }
            });

            newNextBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const container = document.getElementById('popular-scroll-container');
                if (container) {
                    if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                        container.scrollTo({
                            left: 0,
                            behavior: 'smooth'
                        });
                        console.log('Popular reached end, scrolling to start');
                    } else {
                        container.scrollBy({
                            left: popularScrollAmount,
                            behavior: 'smooth'
                        });
                        console.log('Popular Next clicked, scrollLeft:', container.scrollLeft);
                    }
                } else {
                    console.error('Popular scroll container not found');
                }
            });

            console.log('Popular navigation buttons setup complete');
        }

        // Helper function for Popular Products scrolling (inline onclick backup)
        function scrollPopular(direction) {
            const container = document.getElementById('popular-scroll-container');
            if (!container) {
                console.error('Popular scroll container not found');
                return;
            }

            if (direction === 'prev') {
                container.scrollBy({
                    left: -popularScrollAmount,
                    behavior: 'smooth'
                });
                console.log('Popular Previous clicked, scrollLeft:', container.scrollLeft);
            } else if (direction === 'next') {
                if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                    container.scrollTo({
                        left: 0,
                        behavior: 'smooth'
                    });
                    console.log('Popular reached end, scrolling to start');
                } else {
                    container.scrollBy({
                        left: popularScrollAmount,
                        behavior: 'smooth'
                    });
                    console.log('Popular Next clicked, scrollLeft:', container.scrollLeft);
                }
            }
        }

        // Load popular products on page load
        document.addEventListener('DOMContentLoaded', loadPopularProducts);
        </script>
        @endpush

        <!-------------------------------- End Popular Products Section --->

        <!-------------------------------- Blog Section ----------------->
        <section class="py-5 blog-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="blog-header mb-3">
                        <span class="blog-icon">📝</span>
                        <h2 class="section-title">Latest Blogs & Articles</h2>
                        <span class="blog-icon">📝</span>
                    </div>
                    <p class="text-muted mb-0">Stay updated with our latest news, recipes, and tips</p>
                </div>

                <div id="blog-carousel" class="row gx-4 gy-4">
                    <!-- Blog posts will be loaded here via JavaScript -->
                    <div class="col-12 text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('blog') }}" class="btn btn-primary btn-lg px-5">
                        View All Blogs
                    </a>
                </div>
            </div>
        </section>

        @push('styles')
        <style>
        .blog-section {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 30%, #ffffff 70%, #e3f2fd 100%);
            position: relative;
            overflow: hidden;
        }

        .blog-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230196f9' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .blog-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .blog-icon {
            font-size: 2rem;
            animation: float-blog 3s ease-in-out infinite;
        }

        @keyframes float-blog {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(5deg);
            }
        }

        .blog-section .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #0288d1, #0277bd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .blog-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(2, 119, 189, 0.15);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 2px solid #e3f2fd;
        }

        .blog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 14px;
            padding: 3px;
            background: linear-gradient(135deg, #0288d1, #0277bd, #01579b);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .blog-card:hover::before {
            opacity: 1;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(2, 119, 189, 0.25);
            border-color: #0288d1;
        }

        .blog-image-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .blog-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-image {
            transform: scale(1.1);
        }

        .blog-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
            font-size: 0.85rem;
            color: #757575;
        }

        .blog-meta-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .blog-badge {
            background: linear-gradient(135deg, #0288d1, #0277bd);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .blog-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .blog-card:hover .blog-title {
            color: #0288d1;
        }

        .blog-excerpt {
            font-size: 0.95rem;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .blog-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #e3f2fd;
        }

        .blog-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .blog-author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0288d1, #0277bd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .blog-author-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #495057;
        }

        .btn-blog-detail {
            background: linear-gradient(135deg, #0288d1, #0277bd) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.5rem 1.25rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-blog-detail:hover {
            background: linear-gradient(135deg, #01579b, #01579b) !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(2, 119, 189, 0.4);
        }

        @media (max-width: 992px) {
            .blog-image-container {
                height: 200px;
            }

            .blog-title {
                font-size: 1.1rem;
            }

            .blog-excerpt {
                -webkit-line-clamp: 2;
            }
        }

        @media (max-width: 768px) {
            .blog-section {
                padding: 3rem 0 !important;
            }

            .blog-image-container {
                height: 180px;
            }

            .blog-title {
                font-size: 1rem;
            }

            .blog-content {
                padding: 1.25rem;
            }

            .btn-lg {
                padding: 0.75rem 2rem;
                font-size: 1rem;
            }
        }
        </style>
        @endpush

        @push('scripts-bottom')
        <script>
        var blogPosts = [];

        function loadBlogPosts() {
            const url = "{{ url('/api/v1/blogs') }}?per_page=6";

            console.log('Loading blog posts from:', url);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Blog posts response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Blog posts API Response:', data);
                    console.log('Response keys:', Object.keys(data));

                    // Parse response from Webbycrown Blog API
                    if (data.status === 'success' && data.data) {
                        if (Array.isArray(data.data)) {
                            blogPosts = data.data;
                        } else if (typeof data.data === 'object' && data.data !== null) {
                            blogPosts = Object.values(data.data);
                        } else {
                            blogPosts = [];
                        }
                    } else if (Array.isArray(data)) {
                        blogPosts = data;
                    } else {
                        console.warn('Unknown data structure:', data);
                        blogPosts = [];
                    }

                    console.log('Blog posts array length:', blogPosts.length);
                    console.log('Blog posts array:', blogPosts);
                    renderBlogPosts();
                })
                .catch(error => {
                    console.error('Error loading blog posts:', error);
                    document.getElementById('blog-carousel').innerHTML =
                        '<div class="col-12 text-center text-danger">Error loading blog posts: ' + error.message +
                        '</div>';
                });
        }

        function renderBlogPosts() {
            const carousel = document.getElementById('blog-carousel');

            if (!blogPosts || blogPosts.length === 0) {
                carousel.innerHTML = '<div class="col-12 text-center text-muted">No blog posts available.</div>';
                return;
            }

            // Take only first 6 blog posts
            const displayPosts = blogPosts.slice(0, 6);

            let html = '';

            displayPosts.forEach(blog => {
                // Build blog URL with category slug and blog slug
                let categorySlug = null;

                // Extract category slug from assign_categorys array (API response structure)
                if (blog.assign_categorys && Array.isArray(blog.assign_categorys) && blog.assign_categorys
                    .length > 0) {
                    categorySlug = blog.assign_categorys[0].slug;
                }

                const blogSlug = blog.slug || blog.id;

                // Try to build URL with category slug first, fallback to blog slug only
                const blogUrl = categorySlug ?
                    "{{ url('blog') }}/" + categorySlug + "/" + blogSlug :
                    "{{ url('blog') }}/" + blogSlug;

                // Use src_url for real blog images, fallback to demo image if not available
                const blogImage = blog.src_url || blog.image ||
                    'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=400&h=300&fit=crop';
                const blogTitle = blog.name || blog.title || 'Untitled Blog';
                const blogExcerpt = blog.description || blog.excerpt || blog.content || '';
                const blogAuthor = blog.author_name || 'Saffron Admin';
                const blogDate = blog.published_at || blog.created_at || new Date().toISOString();
                const blogCategory = blog.category_name || 'General';
                const formattedDate = new Date(blogDate).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });

                html += `
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="blog-card">
                                <div class="blog-image-container">
                                    <img src="${blogImage}" alt="${blogTitle}" class="blog-image">
                                </div>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <span class="blog-badge">${blogCategory}</span>
                                        <div class="blog-meta-item">
                                            <span>📅</span>
                                            <span>${formattedDate}</span>
                                        </div>
                                    </div>
                                    <h3 class="blog-title">${blogTitle}</h3>
                                    <p class="blog-excerpt">${stripHtml(blogExcerpt)}</p>
                                    <div class="blog-footer">
                                        <div class="blog-author">
                                            <div class="blog-author-avatar">
                                                ${blogAuthor.charAt(0).toUpperCase()}
                                            </div>
                                            <span class="blog-author-name">${blogAuthor}</span>
                                        </div>
                                        <a href="${blogUrl}" class="btn btn-blog-detail">
                                            View Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            });

            carousel.innerHTML = html;
        }

        // Helper function to strip HTML tags
        function stripHtml(html) {
            const tmp = document.createElement('DIV');
            tmp.innerHTML = html;
            return tmp.textContent || tmp.innerText || '';
        }

        // Load blog posts on page load
        document.addEventListener('DOMContentLoaded', loadBlogPosts);
        </script>
        @endpush

        <!-------------------------------- End Blog Section --->

</x-shop::layouts>