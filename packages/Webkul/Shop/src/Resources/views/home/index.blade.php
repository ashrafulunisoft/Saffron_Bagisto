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
        {{-- Categories stored in localStorage for other features --}}
        @if (isset($categories) && $categories)
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
                                    <span class="badge-inner" style="background:rgba(0, 0, 0, 0.1)">
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
                                    chocolates, and freshly baked treats made with pure saffron and love. Crafted using
                                    time-honored recipes passed down through generations.
                                </p>

                                <div class="hero-buttons animate-fade-in-up delay-3">
                                    <a href="{{ route('shop.search.index') }}" class="btn btn-hero btn-primary-hero">
                                        <span class="btn-text">Shop Now</span>
                                        <span class="btn-icon">→</span>
                                    </a>
                                    <a href="#about-section" class="btn btn-hero btn-secondary-hero">
                                        <span class="btn-text">Our Story</span>
                                        <span class="btn-icon">↓</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="hero-image-wrapper animate-float">
                                <div class="hero-image-container">
                                    <div class="image-glow"></div>
                                    <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=800&h=600&fit=crop"
                                        alt="Delicious Sweets" class="hero-image" loading="lazy">
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
                background: linear-gradient(135deg, rgba(255, 249, 230, 0.8) 0%, rgba(255, 245, 240, 0.8) 50%, rgba(255, 245, 245, 0.8) 100%);
                backdrop-filter: blur(20px);
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
                background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffc107' fill-opacity='0.03'%3E%3Cpath d='M30 20c-1.1 0-2 0.9-2 2s0.9 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2-0.9 2-2-0.9-2-2-2zM15 10c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zM45 10c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2zm0 5c-1.1 0-2 0.9-2 2s0.9 2 2 2 2-0.9 2-2-0.9-2-2-2z'/%3E%3C/g%3E%3C/svg%3E");
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
                background: rgba(255, 193, 7, 0.2);
                border: 2px solid rgba(255, 193, 7, 0.4);
                border-radius: 50px;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
                color: #e65100;
                font-size: 1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                backdrop-filter: blur(20px) saturate(180%);
                box-shadow: 0 8px 32px rgba(255, 193, 7, 0.2);
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
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px) saturate(150%);
                padding: 1.5rem 2rem;
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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
                background: rgba(255, 255, 255, 0.75);
                padding: 0.75rem 1.25rem;
                border-radius: 50px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(20px) saturate(180%);
                border: 2px solid rgba(255, 193, 7, 0.4);
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

            // Category Navigation Script
            document.addEventListener('DOMContentLoaded', function() {
                const scrollContainer = document.getElementById('category-scroll-container');
                const prevBtn = document.getElementById('category-prev');
                const nextBtn = document.getElementById('category-next');

                if (scrollContainer && prevBtn && nextBtn) {
                    const scrollAmount = 280;

                    function updateButtonStates() {
                        const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                        const currentScroll = scrollContainer.scrollLeft;
                        prevBtn.disabled = currentScroll <= 5;
                        nextBtn.disabled = currentScroll >= maxScroll - 5;
                    }

                    prevBtn.addEventListener('click', function() {
                        scrollContainer.scrollBy({
                            left: -scrollAmount,
                            behavior: 'smooth'
                        });
                    });

                    nextBtn.addEventListener('click', function() {
                        scrollContainer.scrollBy({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                    });

                    scrollContainer.addEventListener('scroll', updateButtonStates);
                    updateButtonStates();

                    const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                    if (maxScroll <= 10) {
                        prevBtn.style.display = 'none';
                        nextBtn.style.display = 'none';
                    }
                }
            });

            // Add to Cart Function
            function addToCart(productId, button) {
                if (!productId) return;

                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Adding...';

                const url = "{{ route('shop.api.checkout.cart.store') }}";
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                    document.querySelector('input[name="_token"]')?.value;

                const resetButton = () => {
                    button.disabled = false;
                    button.innerHTML = originalText;
                };

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
                        if (!response.ok) throw new Error('HTTP ' + response.status);
                        return response.json();
                    })
                    .then(data => {
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

                        if (window.app && window.app.$emitter) {
                            window.app.$emitter.emit('update-mini-cart', data.data || data);
                        }
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to add product to cart. Please try again.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    })
                    .finally(resetButton);
            }

            // Add to Wishlist Function
            function addToWishlist(productId, button) {
                if (!productId) return;

                const isLoggedIn = "{{ auth()->guard('customer')->check() }}" === "1";

                if (!isLoggedIn) {
                    window.location.href = "{{ route('shop.customer.session.index') }}";
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
                        if (button.classList.contains('active')) {
                            button.classList.remove('active');
                            button.innerHTML = '♡';
                        } else {
                            button.classList.add('active');
                            button.innerHTML = '♥';
                        }

                        Swal.fire({
                            icon: 'success',
                            title: button.classList.contains('active') ? 'Added to Wishlist' :
                                'Removed from Wishlist',
                            text: data.data?.message || 'Wishlist updated successfully!',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    })
                    .catch(error => {
                        console.error('Error updating wishlist:', error);
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

            // Add to Compare Function
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
        </script>
    @endpush

    <!-------------------------------- End Spectacular Hero Banner --->

    <!-------------------------------- Category Carousel ----------------->
    @if ($categories && $categories->count() > 0)
        <section class="py-5 category-section">
            <div class="container-lg">
                <div class="text-center mb-5">
                    <div class="category-header mb-3">
                        <span class="category-icon">🛒</span>
                        <h2 class="section-title">Shop by Category</h2>
                        <span class="category-icon">🛒</span>
                    </div>
                    <p class="text-muted mb-0">Browse our wide range of product categories</p>
                </div>

                @php
                    $subCategories = [];
                    $categoriesArray = $categories->collection->toArray();
                    foreach ($categoriesArray as $category) {
                        if (!empty($category['children'])) {
                            $children = $category['children'];
                            if (is_array($children)) {
                                $subCategories = array_merge($subCategories, $children);
                            } elseif (is_object($children) && method_exists($children, 'toArray')) {
                                $subCategories = array_merge($subCategories, $children->toArray());
                            }
                        }
                    }
                    $totalCategories = count($subCategories);
                    $subCategories = collect($subCategories)->take(12);
                @endphp

                @if ($totalCategories > 0)
                    <div class="category-nav-buttons mb-4">
                        <button class="category-nav-btn prev-btn" id="category-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>
                        <button class="category-nav-btn next-btn" id="category-next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>
                    </div>
                @endif

                @if (!empty($subCategories))
                    <div class="category-scroll-wrapper" id="category-scroll-wrapper">
                        <div class="row g-4 flex-nowrap category-scroll-container" id="category-scroll-container">
                            @foreach ($subCategories as $subCat)
                                @php
                                    $catName = $subCat['name'] ?? 'Category';
                                    $catSlug = $subCat['slug'] ?? '#';
                                    $catImage =
                                        $subCat['logo_url'] ??
                                        ($subCat['image_url'] ?? ($subCat['logo'] ?? ($subCat['image'] ?? null)));
                                @endphp

                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <div class="category-card h-100">
                                        <a href="{{ url('products/' . $catSlug) }}"
                                            class="nav-link text-center text-decoration-none text-dark h-100 d-flex flex-column">
                                            <div
                                                class="category-card-inner d-flex flex-column align-items-center flex-grow-1 p-3">
                                                @if ($catImage)
                                                    <img src="{{ $catImage }}" alt="{{ $catName }}"
                                                        class="rounded-circle mb-3 img-fluid category-image"
                                                        style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #dee2e6; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                                @else
                                                    <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center bg-light"
                                                        style="width: 120px; height: 120px; border: 3px solid #dee2e6; margin: 0 auto;">
                                                        <span class="fw-bold text-secondary"
                                                            style="font-size: 2rem;">{{ substr($catName, 0, 2) }}</span>
                                                    </div>
                                                @endif
                                                <h4 class="fs-6 mt-3 fw-normal category-title text-dark text-center">
                                                    {{ $catName }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center text-muted py-4">
                        <p>No sub-categories available</p>
                    </div>
                @endif
            </div>
            </div>
        </section>
    @endif

    <!-------------------------------- Category Carousel Styles ----------------->
    @push('styles')
        <style>
            /* Category Navigation Buttons */
            .category-nav-buttons {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-bottom: 1.5rem;
                padding-right: 10px;
            }

            .category-nav-btn {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                border: 2px solid #28a745;
                background: rgba(255, 255, 255, 0.9);
                color: #28a745;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
                z-index: 10;
                position: relative;
            }

            .category-nav-btn:hover:not(:disabled),
            .category-nav-btn:focus:not(:disabled) {
                background: linear-gradient(135deg, #28a745, #20c997);
                color: white;
                transform: scale(1.1);
                box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
            }

            .category-nav-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .category-scroll-wrapper {
                position: relative;
                overflow: hidden;
            }

            .category-scroll-container {
                overflow-x: auto;
                overflow-y: hidden;
                scroll-behavior: smooth;
                scrollbar-width: thin;
                scrollbar-color: #28a745 #f1f1f1;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
            }

            .category-scroll-container::-webkit-scrollbar {
                height: 8px;
            }

            .category-scroll-container::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .category-scroll-container::-webkit-scrollbar-thumb {
                background: #28a745;
                border-radius: 10px;
            }

            .category-scroll-container::-webkit-scrollbar-thumb:hover {
                background: #20c997;
            }

            .category-section {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 30%, #ffffff 70%, #f0fdf4 100%);
                position: relative;
                overflow: hidden;
            }

            .category-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 100%;
                background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2328a745' fill-opacity='0.05'%3E%3Cpath d='M40 35c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5-2.2 5-5-2.2-5-5-5zM20 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zM60 30c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5zm0 10c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
                pointer-events: none;
            }

            .category-header {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1rem;
            }

            .category-icon {
                font-size: 2rem;
                animation: bounce-category 2s ease-in-out infinite;
            }

            @keyframes bounce-category {

                0%,
                100% {
                    transform: translateY(0) rotate(0deg);
                }

                50% {
                    transform: translateY(-10px) rotate(5deg);
                }
            }

            .category-section .section-title {
                font-size: 2rem;
                font-weight: 700;
                color: #1a1a1a;
                margin: 0;
                background: linear-gradient(135deg, #28a745, #20c997);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .category-card {
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 16px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px) saturate(180%);
                height: 100%;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
                position: relative;
            }

            .category-card::before {
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

            .category-card:hover::before {
                opacity: 1;
            }

            .category-card:hover {
                transform: translateY(-10px) scale(1.03);
                box-shadow: 0 20px 50px rgba(40, 167, 69, 0.25);
                border-color: #28a745;
            }

            .category-card-inner {
                padding: 1.5rem;
                position: relative;
                z-index: 1;
            }

            .category-card:hover .category-image {
                transform: scale(1.1);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            }

            .category-title {
                transition: all 0.3s ease;
                color: #2d3748;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .category-card:hover .category-title {
                color: #28a745 !important;
                transform: translateX(3px);
            }

            @media (max-width: 768px) {
                .category-nav-buttons {
                    display: flex !important;
                    justify-content: space-between;
                    width: 100%;
                    padding: 0 10px;
                    position: relative;
                    z-index: 1;
                }

                .category-nav-btn {
                    width: 40px;
                    height: 40px;
                }

                .category-image {
                    width: 100px !important;
                    height: 100px !important;
                }

                .category-card {
                    width: 50% !important;
                    min-width: 140px !important;
                    max-width: 160px !important;
                    flex: 0 0 50% !important;
                }

                .category-scroll-container {
                    display: flex !important;
                    flex-wrap: nowrap !important;
                    position: relative;
                    z-index: 1;
                }

                .category-scroll-container>.col-xl-2,
                .category-scroll-container>.col-lg-3,
                .category-scroll-container>.col-md-4,
                .category-scroll-container>.col-sm-6 {
                    width: 50% !important;
                    flex: 0 0 50% !important;
                    max-width: 50% !important;
                    padding-right: 8px !important;
                    padding-left: 8px !important;
                }

                /* Fix mobile menu overlap */
                .category-section {
                    position: relative;
                    z-index: 1;
                }

                .category-scroll-wrapper {
                    position: relative;
                    z-index: 1;
                    background: transparent;
                }
            }
        </style>
    @endpush

    <!-------------------------------- End Category Carousel ----------------->

    <!-------------------------------- About Saffron Sweets & Bakery Section ----------------->
    <section class="py-5 about-section">
        <div class="container-lg">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                    <div class="about-image-wrapper position-relative rounded-4 overflow-hidden shadow-lg">
                        <img src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=800&h=600&fit=crop"
                            alt="Saffron Sweets and Bakery" class="img-fluid w-100"
                            style="height: 500px; object-fit: cover;" loading="lazy">
                        <div class="overlay position-absolute top-0 start-0 w-100 h-100"
                            style="background: linear-gradient(135deg, rgba(255, 215, 0, 0.3) 0%, rgba(139, 69, 19, 0.2) 100%);">
                        </div>
                        <div class="position-absolute top-4 end-4 bg-white rounded-circle d-flex align-items-center justify-content-center shadow"
                            style="width: 80px; height: 80px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                            <span class="fw-bold" style="color: #d4af37; font-size: 1.5rem;">25+</span>
                        </div>
                        <div class="position-absolute bottom-4 start-4 bg-dark text-white rounded-3 px-4 py-2 shadow">
                            <p class="mb-0 fw-bold fs-5">Premium Quality</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="about-content h-100 d-flex flex-column justify-content-center">
                        <div class="section-badge d-inline-block mb-3">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">WHO WE ARE</span>
                        </div>

                        <h2 class="display-4 fw-bold mb-4 text-dark" style="font-family: 'Playfair Display', serif;">
                            Authentic Saffron Sweets & Traditional Bakery
                        </h2>

                        <p class="lead text-secondary mb-4">
                            Welcome to Saffron, where tradition meets excellence. We bring you to finest collection
                            of authentic Bengali sweets and premium bakery items, crafted with love and the purest
                            saffron.
                        </p>

                        <p class="text-muted mb-4">
                            Our skilled artisans use time-honored recipes passed down through generations to create
                            mouth-watering treats that will transport you to the streets of Bangladesh.
                        </p>

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

            .feature-card {
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.3);
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(15px) saturate(150%);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            .feature-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 40px rgba(212, 175, 55, 0.25) !important;
                border-color: rgba(212, 175, 55, 0.5);
                background: rgba(255, 255, 255, 0.85);
            }

            .feature-icon {
                transition: transform 0.3s ease;
            }

            .feature-card:hover .feature-icon {
                transform: rotate(360deg) scale(1.1);
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
            }
        </style>
    @endpush

    <!-------------------------------- End About Section ----------------->

    <!-------------------------------- Featured Products ----------------->
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

            <div id="products-carousel">
                @if (!empty($featuredProducts))
                    @php
                        $featuredProducts = array_slice($featuredProducts, 0, 4);
                    @endphp
                    <div class="row g-4 justify-content-center">
                        @foreach ($featuredProducts as $product)
                            @php
                                $isSaleable = $product['is_saleable'] ?? true;
                                $isOnSale = $product['on_sale'] ?? false;
                                $isNew = $product['is_new'] ?? false;
                                $productUrl = route('shop.product_or_category.index', $product['url_key'] ?? '#');
                                $productImage =
                                    $product['base_image']['medium_image_url'] ?? '/images/default-product.png';
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="product-card h-100">
                                    <div class="product-image-container">
                                        @if ($isOnSale)
                                            <span class="badge-sale">Sale</span>
                                        @endif
                                        @if ($isNew && !$isOnSale)
                                            <span class="badge-new">New</span>
                                        @endif
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <img src="{{ $productImage }}" alt="{{ $product['name'] ?? 'Product' }}"
                                                class="product-image" loading="lazy">
                                        </a>
                                        <div class="action-icons">
                                            <button class="action-icon"
                                                onclick="addToWishlist('{{ $product['id'] }}', this)"
                                                title="Add to Wishlist">♡</button>
                                            <button class="action-icon"
                                                onclick="addToCompare('{{ $product['id'] }}')"
                                                title="Add to Compare">⤢</button>
                                        </div>
                                    </div>
                                    <div class="p-3" style="position: relative; z-index: 1;">
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <h5 class="product-name mb-2">{{ $product['name'] ?? 'Product' }}</h5>
                                        </a>
                                        <div class="product-price mb-2">
                                            {!! $product['price_html'] ?? '৳0.00' !!}
                                        </div>
                                        <button class="btn btn-add-cart w-100"
                                            @if (!$isSaleable) disabled @endif
                                            onclick="addToCart('{{ $product['id'] }}', this)">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted">No featured products available.</div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('shop.search.index') }}" class="btn btn-success btn-lg px-5">View All Products</a>
            </div>
        </div>
    </section>

    <!-------------------------------- Best Selling Products ----------------->
    <section class="py-5 best-selling-section">
        <div class="container-lg">
            <div class="text-center mb-5">
                <div class="best-selling-header mb-3">
                    <span class="best-selling-icon">🔥</span>
                    <h2 class="best-selling-title">Best Selling Products</h2>
                    <span class="best-selling-icon">🔥</span>
                </div>
                <p class="text-muted mb-0">Our customers' top picks - Don't miss out!</p>
            </div>

            <div id="best-selling-carousel">
                @if (!empty($bestSellingProducts))
                    @php
                        $bestSellingProducts = array_slice($bestSellingProducts, 0, 4);
                    @endphp
                    <div class="row g-4 justify-content-center">
                        @foreach ($bestSellingProducts as $product)
                            @php
                                $isSaleable = $product['is_saleable'] ?? true;
                                $isOnSale = $product['on_sale'] ?? false;
                                $isNew = $product['is_new'] ?? false;
                                $productUrl = route('shop.product_or_category.index', $product['url_key'] ?? '#');
                                $productImage =
                                    $product['base_image']['medium_image_url'] ?? '/images/default-product.png';
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="best-selling-card h-100">
                                    <div class="best-selling-image-container">
                                        @if ($isOnSale)
                                            <span class="badge-sale">Sale</span>
                                        @endif
                                        @if ($isNew && !$isOnSale)
                                            <span class="badge-new">New</span>
                                        @endif
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <img src="{{ $productImage }}" alt="{{ $product['name'] ?? 'Product' }}"
                                                class="best-selling-image" loading="lazy">
                                        </a>
                                        <div class="action-icons">
                                            <button class="action-icon"
                                                onclick="addToWishlist('{{ $product['id'] }}', this)"
                                                title="Add to Wishlist">♡</button>
                                            <button class="action-icon"
                                                onclick="addToCompare('{{ $product['id'] }}')"
                                                title="Add to Compare">⤢</button>
                                        </div>
                                    </div>
                                    <div class="p-3" style="position: relative; z-index: 1;">
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <h5 class="best-selling-name mb-2">{{ $product['name'] ?? 'Product' }}
                                            </h5>
                                        </a>
                                        <div class="best-selling-price mb-2">
                                            {!! $product['price_html'] ?? '৳0.00' !!}
                                        </div>
                                        <button class="btn btn-best-selling w-100"
                                            @if (!$isSaleable) disabled @endif
                                            onclick="addToCart('{{ $product['id'] }}', this)">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted">No best selling products available.</div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('shop.search.index') }}" class="btn btn-warning btn-lg px-5">View All Products</a>
            </div>
        </div>
    </section>

    <!-------------------------------- Popular Products ----------------->
    <section class="py-5 popular-products-section">
        <div class="container-lg">
            <div class="text-center mb-5">
                <div class="popular-products-header mb-3">
                    <span class="popular-products-icon">⭐</span>
                    <h2 class="popular-products-title">Popular Products</h2>
                    <span class="popular-products-icon">⭐</span>
                </div>
                <p class="text-muted mb-0">Trending favorites loved by our customers!</p>
            </div>

            <div id="popular-products-carousel">
                @if (!empty($popularProducts))
                    @php
                        $popularProducts = array_slice($popularProducts, 0, 4);
                    @endphp
                    <div class="row g-4 justify-content-center">
                        @foreach ($popularProducts as $product)
                            @php
                                $isSaleable = $product['is_saleable'] ?? true;
                                $isOnSale = $product['on_sale'] ?? false;
                                $isNew = $product['is_new'] ?? false;
                                $productUrl = route('shop.product_or_category.index', $product['url_key'] ?? '#');
                                $productImage =
                                    $product['base_image']['medium_image_url'] ?? '/images/default-product.png';
                            @endphp
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="popular-products-card h-100">
                                    <div class="popular-products-image-container">
                                        @if ($isOnSale)
                                            <span class="badge-sale">Sale</span>
                                        @endif
                                        @if ($isNew && !$isOnSale)
                                            <span class="badge-new">New</span>
                                        @endif
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <img src="{{ $productImage }}" alt="{{ $product['name'] ?? 'Product' }}"
                                                class="popular-products-image" loading="lazy">
                                        </a>
                                        <div class="action-icons">
                                            <button class="action-icon"
                                                onclick="addToWishlist('{{ $product['id'] }}', this)"
                                                title="Add to Wishlist">♡</button>
                                            <button class="action-icon"
                                                onclick="addToCompare('{{ $product['id'] }}')"
                                                title="Add to Compare">⤢</button>
                                        </div>
                                    </div>
                                    <div class="p-3" style="position: relative; z-index: 1;">
                                        <a href="{{ $productUrl }}" class="text-decoration-none">
                                            <h5 class="popular-products-name mb-2">{{ $product['name'] ?? 'Product' }}
                                            </h5>
                                        </a>
                                        <div class="popular-products-price mb-2">
                                            {!! $product['price_html'] ?? '৳0.00' !!}
                                        </div>
                                        <button class="btn btn-popular-products w-100"
                                            @if (!$isSaleable) disabled @endif
                                            onclick="addToCart('{{ $product['id'] }}', this)">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted">No popular products available.</div>
                @endif
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('shop.search.index') }}" class="btn btn-info btn-lg px-5">View All Products</a>
            </div>
        </div>
    </section>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .featured-products-section {
                background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 30%, #ffffff 70%, #f0fdf4 100%);
                position: relative;
                overflow: hidden;
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
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 16px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(20px) saturate(180%);
                height: 100%;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
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

            .product-image {
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .product-card:hover .product-image {
                transform: scale(1.1);
            }

            .product-name {
                font-size: 0.95rem;
                font-weight: 600;
                color: #2d3748;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .product-card:hover .product-name {
                color: #28a745 !important;
            }

            .badge-sale,
            .badge-new {
                position: absolute;
                top: 12px;
                left: 12px;
                padding: 8px 18px;
                border-radius: 25px;
                font-size: 0.8rem;
                font-weight: 800;
                z-index: 2;
                text-transform: uppercase;
                letter-spacing: 1px;
                animation: pulse-badge 2s ease-in-out infinite;
            }

            .badge-sale {
                background: linear-gradient(135deg, #ff4757 0%, #dc3545 100%);
                color: white;
            }

            .badge-new {
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
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
                border: 2px solid rgba(40, 167, 69, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                color: #4a5568;
            }

            .action-icon:hover {
                background: linear-gradient(135deg, #28a745, #20c997);
                color: white;
                border-color: transparent;
                transform: scale(1.1);
            }

            .btn-add-cart {
                width: 100%;
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
                color: white !important;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                padding: 12px 16px;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                cursor: pointer;
            }

            .btn-add-cart:hover {
                background: linear-gradient(135deg, #218838 0%, #1e7e34 100%) !important;
                transform: translateY(-2px);
            }

            @media (max-width: 768px) {
                .product-image-container {
                    height: 160px;
                }

                .action-icons {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush

    <!-------------------------------- Best Selling Products Styles ----------------->
    <style>
        .best-selling-section {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 30%, #ffffff 70%, #fff3e0 100%);
            position: relative;
            overflow: hidden;
        }

        .best-selling-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .best-selling-icon {
            font-size: 2rem;
            animation: fire-pulse 2s ease-in-out infinite;
        }

        @keyframes fire-pulse {

            0%,
            100% {
                transform: scale(1) rotate(-10deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.2) rotate(10deg);
                opacity: 0.8;
            }
        }

        .best-selling-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #ff6f00, #ff8f00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .best-selling-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            height: 100%;
            box-shadow: 0 8px 32px rgba(255, 111, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            position: relative;
        }

        .best-selling-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 14px;
            padding: 3px;
            background: linear-gradient(135deg, #ff6f00, #ff8f00, #ff9800);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .best-selling-card:hover::before {
            opacity: 1;
        }

        .best-selling-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 50px rgba(255, 111, 0, 0.25);
            border-color: #ff6f00;
        }

        .best-selling-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            z-index: 1;
        }

        .best-selling-image {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .best-selling-card:hover .best-selling-image {
            transform: scale(1.1);
        }

        .best-selling-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .best-selling-card:hover .best-selling-name {
            color: #ff6f00 !important;
        }

        .best-selling-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ff6f00;
        }

        .btn-best-selling {
            width: 100%;
            background: linear-gradient(135deg, #ff6f00 0%, #ff8f00 100%) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 12px 16px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
        }

        .btn-best-selling:hover {
            background: linear-gradient(135deg, #e65100 0%, #ff6f00 100%) !important;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .best-selling-image-container {
                height: 160px;
            }
        }
    </style>

    <!-------------------------------- End Best Selling Products --->

    <!-------------------------------- Popular Products Styles ----------------->
    <style>
        .popular-products-section {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 30%, #ffffff 70%, #e8f5e9 100%);
            position: relative;
            overflow: hidden;
        }

        .popular-products-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .popular-products-icon {
            font-size: 2rem;
            animation: star-pulse 2s ease-in-out infinite;
        }

        @keyframes star-pulse {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: scale(1.2) rotate(15deg);
                opacity: 0.8;
            }
        }

        .popular-products-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            background: linear-gradient(135deg, #2196f3, #00bcd4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .popular-products-card {
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px) saturate(180%);
            height: 100%;
            box-shadow: 0 8px 32px rgba(33, 150, 243, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.5);
            position: relative;
        }

        .popular-products-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 14px;
            padding: 3px;
            background: linear-gradient(135deg, #2196f3, #00bcd4, #009688);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .popular-products-card:hover::before {
            opacity: 1;
        }

        .popular-products-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 50px rgba(33, 150, 243, 0.25);
            border-color: #2196f3;
        }

        .popular-products-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            z-index: 1;
        }

        .popular-products-image {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .popular-products-card:hover .popular-products-image {
            transform: scale(1.1);
        }

        .popular-products-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .popular-products-card:hover .popular-products-name {
            color: #2196f3 !important;
        }

        .popular-products-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2196f3;
        }

        .btn-popular-products {
            width: 100%;
            background: linear-gradient(135deg, #2196f3 0%, #00bcd4 100%) !important;
            color: white !important;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 12px 16px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
        }

        .btn-popular-products:hover {
            background: linear-gradient(135deg, #1976d2 0%, #0097a7 100%) !important;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .popular-products-image-container {
                height: 160px;
            }
        }
    </style>

    <!-------------------------------- End Popular Products --->

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

            <div class="row gx-4 gy-4">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-card">
                        <div class="blog-image-container">
                            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=400&h=300&fit=crop"
                                alt="Blog 1" class="blog-image" loading="lazy">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-badge">Recipes</span>
                                <span>📅 Jan 15, 2026</span>
                            </div>
                            <h3 class="blog-title">Traditional Bengali Sweets You Must Try</h3>
                            <p class="blog-excerpt">Discover the rich heritage of Bengali confectionery and learn about
                                the most beloved traditional sweets that have been cherished for generations.</p>
                            <div class="blog-footer">
                                <div class="blog-author">
                                    <div class="blog-author-avatar">S</div>
                                    <span>Saffron Team</span>
                                </div>
                                <a href="{{ url('blog') }}" class="btn btn-blog-detail">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-card">
                        <div class="blog-image-container">
                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=400&h=300&fit=crop"
                                alt="Blog 2" class="blog-image" loading="lazy">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-badge">Chocolate</span>
                                <span>📅 Jan 10, 2026</span>
                            </div>
                            <h3 class="blog-title">The Art of Handcrafted Chocolates</h3>
                            <p class="blog-excerpt">Explore the intricate process behind our premium handcrafted
                                chocolates and what makes each piece a unique indulgence.</p>
                            <div class="blog-footer">
                                <div class="blog-author">
                                    <div class="blog-author-avatar">S</div>
                                    <span>Saffron Team</span>
                                </div>
                                <a href="{{ url('blog') }}" class="btn btn-blog-detail">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="blog-card">
                        <div class="blog-image-container">
                            <img src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=400&h=300&fit=crop"
                                alt="Blog 3" class="blog-image" loading="lazy">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-badge">Bakery</span>
                                <span>📅 Jan 5, 2026</span>
                            </div>
                            <h3 class="blog-title">Fresh Baked Goods Every Morning</h3>
                            <p class="blog-excerpt">Learn about our baking process and how we ensure every item is
                                freshly baked daily for our customers.</p>
                            <div class="blog-footer">
                                <div class="blog-author">
                                    <div class="blog-author-avatar">S</div>
                                    <span>Saffron Team</span>
                                </div>
                                <a href="{{ url('blog') }}" class="btn btn-blog-detail">View Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('blog') }}" class="btn btn-primary btn-lg px-5">View All Blogs</a>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .blog-section {
                background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 30%, #ffffff 70%, #e3f2fd 100%);
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
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .blog-section .section-title {
                font-size: 2rem;
                font-weight: 700;
                background: linear-gradient(135deg, #0288d1, #0277bd);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .blog-card {
                background: rgba(255, 255, 255, 0.75);
                border-radius: 16px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                height: 100%;
            }

            .blog-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 50px rgba(2, 119, 189, 0.25);
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
                display: flex;
                flex-direction: column;
            }

            .blog-meta {
                display: flex;
                align-items: center;
                gap: 1rem;
                margin-bottom: 0.75rem;
                font-size: 0.85rem;
                color: #757575;
            }

            .blog-badge {
                background: linear-gradient(135deg, #0288d1, #0277bd);
                color: white;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
            }

            .blog-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: #212529;
                margin-bottom: 0.75rem;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .blog-excerpt {
                font-size: 0.95rem;
                color: #6c757d;
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
                margin-top: 1rem;
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

            .btn-blog-detail {
                background: linear-gradient(135deg, #0288d1, #0277bd) !important;
                color: white !important;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.85rem;
                padding: 0.5rem 1.25rem;
            }

            .btn-blog-detail:hover {
                background: linear-gradient(135deg, #01579b, #01579b) !important;
                transform: translateY(-2px);
            }

            @media (max-width: 768px) {
                .blog-image-container {
                    height: 180px;
                }

                .blog-title {
                    font-size: 1rem;
                }
            }
        </style>
    @endpush

    <!-------------------------------- End Blog Section --->

    @push('scripts-bottom')
        <script>
            // Category Navigation Script - Placed at the end to ensure DOM elements exist
            document.addEventListener('DOMContentLoaded', function() {
                // Wait for all content to load
                window.addEventListener('load', function() {
                    initCategoryNavigation();
                });
            });

            function initCategoryNavigation() {
                const scrollContainer = document.getElementById('category-scroll-container');
                const prevBtn = document.getElementById('category-prev');
                const nextBtn = document.getElementById('category-next');

                console.log('Category Navigation Init:', {
                    scrollContainer: !!scrollContainer,
                    prevBtn: !!prevBtn,
                    nextBtn: !!nextBtn
                });

                if (scrollContainer && prevBtn && nextBtn) {
                    const scrollAmount = 280;

                    function updateButtonStates() {
                        const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                        const currentScroll = scrollContainer.scrollLeft;

                        prevBtn.disabled = currentScroll <= 5;
                        nextBtn.disabled = currentScroll >= maxScroll - 5;
                    }

                    prevBtn.addEventListener('click', function() {
                        scrollContainer.scrollBy({
                            left: -scrollAmount,
                            behavior: 'smooth'
                        });
                    });

                    nextBtn.addEventListener('click', function() {
                        scrollContainer.scrollBy({
                            left: scrollAmount,
                            behavior: 'smooth'
                        });
                    });

                    scrollContainer.addEventListener('scroll', updateButtonStates);

                    // Initial update
                    setTimeout(updateButtonStates, 100);

                    // Hide buttons if no scroll needed
                    const maxScroll = scrollContainer.scrollWidth - scrollContainer.clientWidth;
                    if (maxScroll <= 10) {
                        prevBtn.style.display = 'none';
                        nextBtn.style.display = 'none';
                    } else {
                        prevBtn.style.display = 'flex';
                        nextBtn.style.display = 'flex';
                    }

                    console.log('Category Navigation initialized successfully');
                } else {
                    console.log('Category navigation elements not found - checking if conditional rendering is active');
                }
            }
        </script>
    @endpush

</x-shop::layouts>
