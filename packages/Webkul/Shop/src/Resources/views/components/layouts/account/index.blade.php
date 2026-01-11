<x-shop::layouts :has-feature="false">
    <!-- Page Title -->
    <x-slot:title>
        {{ $title ?? '' }}
    </x-slot>

    <style>
        /* Loading Overlay */
        .account-loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .account-loading-overlay.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        /* Loading Spinner */
        .account-loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: accountSpin 1s linear infinite;
        }

        @keyframes accountSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Content Fade In */
        .account-content-wrapper {
            opacity: 0;
            transition: opacity 0.5s ease-in;
        }

        .account-content-wrapper.fade-in {
            opacity: 1;
        }

        /* Smooth sidebar transition */
        .account-sidebar {
            animation: slideInLeft 0.4s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Smooth content transition */
        .account-main-content {
            animation: slideInUp 0.4s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Loading Overlay -->
    <div id="accountLoadingOverlay" class="account-loading-overlay">
        <div class="account-loading-spinner"></div>
    </div>

    <!-- Page Content -->
    <div class="container py-4 account-content-wrapper" id="accountContentWrapper">
        <x-shop::layouts.account.breadcrumb />

        <div class="row g-4 mt-3">
            {{ $slot }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate smooth loading
            setTimeout(function() {
                const overlay = document.getElementById('accountLoadingOverlay');
                const content = document.getElementById('accountContentWrapper');

                if (overlay) {
                    overlay.classList.add('fade-out');
                }

                if (content) {
                    content.classList.add('fade-in');
                }

                // Remove overlay after transition
                setTimeout(function() {
                    if (overlay && overlay.parentNode) {
                        overlay.parentNode.removeChild(overlay);
                    }
                }, 500);
            }, 300); // Small delay to ensure everything is ready
        });
    </script>
</x-shop::layouts>
