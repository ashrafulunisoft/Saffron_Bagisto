{!! view_render_event('bagisto.shop.layout.header.before') !!}

@if(core()->getCurrentChannel()->locales()->count() > 1 || core()->getCurrentChannel()->currencies()->count() > 1 )
    <div class="d-none d-lg-block">
        <x-shop::layouts.header.desktop.top />
    </div>
@endif

<header class="position-sticky top-0 z-10 bg-white shadow-sm">
    <v-header-switcher>
        <!-- Desktop Header Shimmer -->
        <div class="d-none d-lg-block">
            <div class="d-flex align-items-center justify-content-between w-100 border-bottom px-5 py-0" style="min-height: 78px;">
                <!-- Left Navigation Section -->
                <div class="d-flex align-items-center gap-4">
                    <!-- Logo Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 29px; width: 131px;"
                    >
                    </span>

                    <!-- Categories Shimmer -->
                    <div class="d-flex align-items-center gap-3">
                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 80px;"
                        >
                        </span>

                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 80px;"
                        >
                        </span>

                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 80px;"
                        >
                        </span>
                    </div>
                </div>

                <!-- Right Navigation Section -->
                <div class="d-flex align-items-center gap-4">
                    <!-- Search Bar Shimmer -->
                    <div class="position-relative flex-grow-1">
                        <span
                            class="shimmer d-block rounded px-3"
                            role="presentation"
                            style="height: 42px; width: 250px;"
                        >
                        </span>
                    </div>

                    <!-- Right Navigation Icons Shimmer -->
                    <div class="d-flex gap-4">
                        <!-- Compare Icon Shimmer -->
                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 24px;"
                        >
                        </span>

                        <!-- Cart Icon Shimmer -->
                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 24px;"
                        >
                        </span>

                        <!-- Profile Icon Shimmer -->
                        <span
                            class="shimmer rounded"
                            role="presentation"
                            style="height: 24px; width: 24px;"
                        >
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Header Shimmer -->
        <div class="d-lg-none shadow-sm p-3 pb-4 pt-4">
            <div class="d-flex w-100 align-items-center justify-content-between mb-3">
                <!-- Left Navigation -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Hamburger Menu Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 24px; width: 24px;"
                    >
                    </span>

                    <!-- Logo Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 29px; width: 131px;"
                    >
                    </span>
                </div>

                <!-- Right Navigation Icons -->
                <div class="d-flex align-items-center gap-3 gap-md-4">
                    <!-- Compare Icon Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 24px; width: 24px;"
                    >
                    </span>

                    <!-- Cart Icon Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 24px; width: 24px;"
                    >
                    </span>

                    <!-- Profile Icon Shimmer -->
                    <span
                        class="shimmer d-block rounded"
                        role="presentation"
                        style="height: 24px; width: 24px;"
                    >
                    </span>
                </div>
            </div>

            <!-- Search Bar Shimmer -->
            <div class="d-flex w-100 align-items-center">
                <div class="position-relative w-100">
                    <span
                        class="shimmer d-block rounded px-3"
                        role="presentation"
                        style="height: 42px;"
                    >
                    </span>
                </div>
            </div>
        </div>
    </v-header-switcher>
</header>

{!! view_render_event('bagisto.shop.layout.header.after') !!}

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-header-switcher-template"
    >
        <v-desktop-header v-if="isDesktop"></v-desktop-header>

        <v-mobile-header v-else></v-mobile-header>
    </script>

    <script type="module">
        app.component('v-header-switcher', {
            template: '#v-header-switcher-template',

            data() {
                return {
                    isDesktop: window.innerWidth >= 1024
                }
            },

            mounted() {
                this.media = window.matchMedia('(min-width: 1024px)');

                this.media.addEventListener('change', this.handleMedia);
            },

            beforeUnmount() {
                this.media.removeEventListener('change', this.handleMedia);
            },

            methods: {
                handleMedia(e) {
                    this.isDesktop = e.matches;
                }
            }
        });

        app.component('v-desktop-header', {
            template: '#v-desktop-header-template'
        });

        app.component('v-mobile-header', {
            template: '#v-mobile-header-template'
        });
    </script>

    <script
        type="text/x-template"
        id="v-desktop-header-template"
    >
        <x-shop::layouts.header.desktop />
    </script>

    <script
        type="text/x-template"
        id="v-mobile-header-template"
    >
        <x-shop::layouts.header.mobile />
    </script>
@endPushOnce
