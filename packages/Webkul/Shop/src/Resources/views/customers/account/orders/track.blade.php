<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.orders.track.page-title', ['order_id' => $order->increment_id])
    </x-slot>

    <!-- Breadcrumbs -->
    @section('breadcrumbs')
        <x-shop::breadcrumbs
            name="orders.track"
            :entity="$order"
        />
    @endSection

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="max-md:flex max-md:items-center">
                <!-- Back Button For mobile view -->
                <a
                    class="grid md:hidden"
                    href="{{ route('shop.customers.account.orders.view', $order->id) }}"
                >
                    <span class="icon-arrow-left rtl:icon-arrow-right text-2xl"></span>
                </a>

                <h2 class="text-2xl font-medium max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0">
                    @lang('shop::app.customers.account.orders.track.page-title', ['order_id' => $order->increment_id])
                </h2>
            </div>
        </div>

        <!-- Loading State -->
        <div id="tracking-loading" class="hidden mt-8 flex items-center justify-center py-12">
            <div class="flex flex-col items-center gap-4">
                <div class="h-12 w-12 animate-spin rounded-full border-4 border-zinc-200 border-t-navyBlue"></div>
                <p class="text-sm text-zinc-500">@lang('shop::app.customers.account.orders.track.loading')</p>
            </div>
        </div>

        <!-- Error State -->
        <div id="tracking-error" class="hidden mt-8 rounded-lg border border-red-200 bg-red-50 p-6">
            <div class="flex items-start gap-3">
                <span class="icon-error text-2xl text-red-500"></span>
                <div>
                    <h3 class="text-base font-semibold text-red-900">@lang('shop::app.customers.account.orders.track.error-title')</h3>
                    <p id="error-message" class="mt-1 text-sm text-red-700">@lang('shop::app.customers.account.orders.track.error-message')</p>
                    <button
                        id="retry-button"
                        class="mt-3 rounded-md bg-red-900 px-4 py-2 text-sm font-medium text-white hover:bg-red-800"
                    >
                        @lang('shop::app.customers.account.orders.track.retry')
                    </button>
                </div>
            </div>
        </div>

        <!-- Tracking Content -->
        <div id="tracking-content" class="mt-8">
            <!-- Order Info Card -->
            <div class="mb-6 rounded-lg border border-zinc-200 bg-white p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900">
                            @lang('shop::app.customers.account.orders.track.order-info')
                        </h3>
                        <p class="mt-1 text-sm text-zinc-500">
                            @lang('shop::app.customers.account.orders.track.consignment-id'):
                            <span id="consignment-id" class="font-medium text-zinc-900">{{ $order->pathao_consignment_id ?? 'N/A' }}</span>
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div id="status-badge" class="rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900">
                            @lang('shop::app.customers.account.orders.track.status-loading')
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-zinc-500">@lang('shop::app.customers.account.orders.track.last-updated')</p>
                            <p id="last-updated" class="text-sm font-medium text-zinc-900">--</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Container -->
            <div class="mb-6 overflow-hidden rounded-lg border border-zinc-200">
                <div class="flex items-center justify-between border-b border-zinc-200 bg-zinc-50 px-6 py-4">
                    <h3 class="text-base font-semibold text-zinc-900">
                        @lang('shop::app.customers.account.orders.track.live-location')
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="relative flex h-3 w-3">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                        </span>
                        <span class="text-sm font-medium text-green-700">@lang('shop::app.customers.account.orders.track.live')</span>
                    </div>
                </div>
                <div id="tracking-map" class="h-[400px] w-full bg-zinc-100"></div>
            </div>

            <!-- Current Location Info -->
            <div class="mb-6 rounded-lg border border-zinc-200 bg-white p-6">
                <h3 class="mb-4 text-base font-semibold text-zinc-900">
                    @lang('shop::app.customers.account.orders.track.current-location')
                </h3>
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <p class="text-sm text-zinc-500">@lang('shop::app.customers.account.orders.track.address')</p>
                        <p id="current-address" class="mt-1 text-sm font-medium text-zinc-900">--</p>
                    </div>
                    <div>
                        <p class="text-sm text-zinc-500">@lang('shop::app.customers.account.orders.track.coordinates')</p>
                        <p id="coordinates" class="mt-1 text-sm font-medium text-zinc-900">--</p>
                    </div>
                </div>
            </div>

            <!-- Tracking Timeline -->
            <div class="rounded-lg border border-zinc-200 bg-white p-6">
                <h3 class="mb-6 text-base font-semibold text-zinc-900">
                    @lang('shop::app.customers.account.orders.track.tracking-history')
                </h3>
                <div id="tracking-timeline" class="space-y-4">
                    <!-- Timeline items will be dynamically inserted here -->
                    <div class="flex items-center justify-center py-8 text-sm text-zinc-500">
                        @lang('shop::app.customers.account.orders.track.loading-history')
                    </div>
                </div>
            </div>
        </div>

        <!-- Auto-refresh Info -->
        <div class="mt-6 rounded-lg border border-zinc-200 bg-zinc-50 p-4">
            <div class="flex items-center gap-3">
                <span class="icon-refresh text-xl text-zinc-500"></span>
                <div>
                    <p class="text-sm font-medium text-zinc-900">
                        @lang('shop::app.customers.account.orders.track.auto-refresh')
                    </p>
                    <p class="text-xs text-zinc-500">
                        @lang('shop::app.customers.account.orders.track.auto-refresh-info')
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""
    />

    <!-- Leaflet JS -->
    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""
    ></script>

    <script>
        @php
            $consignmentId = $order->pathao_consignment_id ?? null;
            $trackingApiUrl = $consignmentId ? route('api.pathao.orders.track', $consignmentId) : null;
        @endphp

        // Configuration
        const CONFIG = {
            consignmentId: '{{ $consignmentId }}',
            trackingApiUrl: '{{ $trackingApiUrl }}',
            refreshInterval: 45000, // 45 seconds
            defaultLat: 23.8103,
            defaultLng: 90.4125,
            defaultZoom: 13
        };

        // State
        let map = null;
        let currentMarker = null;
        let destinationMarker = null;
        let routePolyline = null;
        let refreshInterval = null;
        let lastTrackingData = null;

        // Initialize tracking page
        document.addEventListener('DOMContentLoaded', function() {
            if (!CONFIG.consignmentId || !CONFIG.trackingApiUrl) {
                showError('No consignment ID available for this order');
                return;
            }

            initMap();
            fetchTrackingData();
            startAutoRefresh();

            // Retry button handler
            document.getElementById('retry-button').addEventListener('click', function() {
                hideError();
                fetchTrackingData();
            });
        });

        // Initialize Leaflet map
        function initMap() {
            map = L.map('tracking-map').setView([CONFIG.defaultLat, CONFIG.defaultLng], CONFIG.defaultZoom);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            }).addTo(map);

            // Add destination marker (shipping address if available)
            @if($order->shipping_address && $order->shipping_address->latitude && $order->shipping_address->longitude)
                const destinationLat = {{ $order->shipping_address->latitude }};
                const destinationLng = {{ $order->shipping_address->longitude }};

                const destinationIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style="background-color: #dc2626; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                    iconSize: [24, 24],
                    iconAnchor: [12, 12]
                });

                destinationMarker = L.marker([destinationLat, destinationLng], { icon: destinationIcon })
                    .addTo(map)
                    .bindPopup('<strong>Delivery Address</strong><br>{{ $order->shipping_address->address ?? "Destination" }}');
            @endif
        }

        // Fetch tracking data from API
        async function fetchTrackingData() {
            showLoading();

            try {
                const response = await fetch(CONFIG.trackingApiUrl);

                // Check if response is OK
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                // Get response text first to validate it's JSON
                const responseText = await response.text();

                // Validate response is valid JSON before parsing
                let data;
                try {
                    data = JSON.parse(responseText);
                } catch (parseError) {
                    console.error('JSON parsing error:', parseError);
                    console.error('Response text:', responseText);
                    throw new Error('Invalid response format from server. Please try again later.');
                }

                if (data.success && data.data) {
                    updateTrackingDisplay(data.data);
                    hideLoading();
                } else {
                    throw new Error(data.message || 'Failed to fetch tracking data');
                }
            } catch (error) {
                console.error('Error fetching tracking data:', error);
                showError(error.message || 'Failed to load tracking information');
                hideLoading();
            }
        }

        // Update tracking display with new data
        function updateTrackingDisplay(data) {
            lastTrackingData = data;

            // Update status badge
            updateStatusBadge(data.order_status || data.status);

            // Update last updated timestamp
            updateLastUpdated();

            // Update current location info
            updateLocationInfo(data);

            // Update map markers
            updateMapMarkers(data);

            // Update tracking timeline
            updateTimeline(data.tracking_history || []);
        }

        // Update status badge
        function updateStatusBadge(status) {
            const badge = document.getElementById('status-badge');
            if (!badge) return;

            const statusMap = {
                'Pending': { bg: 'bg-yellow-100', text: 'text-yellow-900' },
                'In Transit': { bg: 'bg-blue-100', text: 'text-blue-900' },
                'Out for Delivery': { bg: 'bg-purple-100', text: 'text-purple-900' },
                'Delivered': { bg: 'bg-green-100', text: 'text-green-900' },
                'Cancelled': { bg: 'bg-red-100', text: 'text-red-900' },
                'Returned': { bg: 'bg-gray-100', text: 'text-gray-900' }
            };

            const statusStyle = statusMap[status] || { bg: 'bg-gray-100', text: 'text-gray-900' };
            badge.className = `rounded-full px-4 py-2 text-sm font-medium ${statusStyle.bg} ${statusStyle.text}`;
            badge.textContent = status || 'Unknown';
        }

        // Update last updated timestamp
        function updateLastUpdated() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            document.getElementById('last-updated').textContent = timeString;
        }

        // Update location information
        function updateLocationInfo(data) {
            const addressElement = document.getElementById('current-address');
            const coordinatesElement = document.getElementById('coordinates');

            // Handle nested geo_location structure first, then fallback to flat structure
            let latitude = null;
            let longitude = null;
            let address = null;

            // Try nested geo_location structure
            if (data.geo_location) {
                latitude = data.geo_location.latitude;
                longitude = data.geo_location.longitude;
                address = data.geo_location.address;
            }
            // Fallback to flat structure for backward compatibility
            else {
                latitude = data.latitude;
                longitude = data.longitude;
                address = data.current_address || data.address;
            }

            if (addressElement) {
                addressElement.textContent = address || 'Address not available';
            }

            if (coordinatesElement) {
                if (latitude && longitude) {
                    coordinatesElement.textContent =
                        `${latitude.toFixed(6)}, ${longitude.toFixed(6)}`;
                } else {
                    coordinatesElement.textContent = 'Coordinates not available';
                }
            }
        }

        // Update map markers
        function updateMapMarkers(data) {
            // Handle nested geo_location structure first, then fallback to flat structure
            let latitude = null;
            let longitude = null;
            let address = null;

            // Try nested geo_location structure
            if (data.geo_location) {
                latitude = data.geo_location.latitude;
                longitude = data.geo_location.longitude;
                address = data.geo_location.address;
            }
            // Fallback to flat structure for backward compatibility
            else {
                latitude = data.latitude;
                longitude = data.longitude;
                address = data.current_address || data.address;
            }

            if (!latitude || !longitude) {
                return;
            }

            const currentLat = latitude;
            const currentLng = longitude;

            // Create custom icon for current location
            const currentIcon = L.divIcon({
                className: 'custom-div-icon',
                html: `<div style="background-color: #16a34a; width: 32px; height: 32px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); position: relative;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                </div>`,
                iconSize: [32, 32],
                iconAnchor: [16, 16]
            });

            // Remove existing current marker
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Add new current marker
            currentMarker = L.marker([currentLat, currentLng], { icon: currentIcon })
                .addTo(map)
                .bindPopup('<strong>Current Location</strong><br>' + (address || 'Location updated'));

            // Draw route if destination marker exists
            if (destinationMarker) {
                drawRoute(currentLat, currentLng);
            }

            // Fit map to show both markers
            if (destinationMarker) {
                const group = L.featureGroup([currentMarker, destinationMarker]);
                map.fitBounds(group.getBounds().pad(0.1));
            } else {
                map.setView([currentLat, currentLng], 15);
            }
        }

        // Draw route between current and destination
        function drawRoute(currentLat, currentLng) {
            const destLatLng = destinationMarker.getLatLng();

            // Remove existing route
            if (routePolyline) {
                map.removeLayer(routePolyline);
            }

            // Draw simple straight line route
            routePolyline = L.polyline([
                [currentLat, currentLng],
                [destLatLng.lat, destLatLng.lng]
            ], {
                color: '#16a34a',
                weight: 4,
                opacity: 0.6,
                dashArray: '10, 10'
            }).addTo(map);
        }

        // Update tracking timeline
        function updateTimeline(history) {
            const timelineContainer = document.getElementById('tracking-timeline');

            if (!history || history.length === 0) {
                timelineContainer.innerHTML = `
                    <div class="flex items-center justify-center py-8 text-sm text-zinc-500">
                        @lang('shop::app.customers.account.orders.track.no-history')
                    </div>
                `;
                return;
            }

            let timelineHTML = '';

            history.forEach((item, index) => {
                const isLatest = index === 0;
                const statusColor = isLatest ? 'bg-green-500' : 'bg-zinc-300';
                const textColor = isLatest ? 'text-green-700' : 'text-zinc-500';

                timelineHTML += `
                    <div class="relative flex gap-4">
                        <div class="flex flex-col items-center">
                            <div class="h-3 w-3 rounded-full ${statusColor}"></div>
                            ${index < history.length - 1 ? '<div class="flex-1 w-0.5 bg-zinc-200"></div>' : ''}
                        </div>
                        <div class="flex-1 pb-4 ${index === history.length - 1 ? 'pb-0' : ''}">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm font-medium ${textColor}">${item.status || item.status_name || 'Status Update'}</p>
                                    <p class="mt-1 text-xs text-zinc-500">${item.location || item.address || 'Location not specified'}</p>
                                </div>
                                <p class="text-xs text-zinc-400">
                                    ${formatDate(item.timestamp || item.created_at)}
                                </p>
                            </div>
                            ${item.remarks ? `<p class="mt-2 text-xs text-zinc-500">${item.remarks}</p>` : ''}
                        </div>
                    </div>
                `;
            });

            timelineContainer.innerHTML = timelineHTML;
        }

        // Format date for timeline
        function formatDate(dateString) {
            if (!dateString) return '';

            const date = new Date(dateString);
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMs / 3600000);
            const diffDays = Math.floor(diffMs / 86400000);

            if (diffMins < 1) return 'Just now';
            if (diffMins < 60) return `${diffMins} min ago`;
            if (diffHours < 24) return `${diffHours}h ago`;
            if (diffDays < 7) return `${diffDays}d ago`;

            return date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: date.getFullYear() !== now.getFullYear() ? 'numeric' : undefined
            });
        }

        // Start auto-refresh
        function startAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }

            refreshInterval = setInterval(() => {
                if (lastTrackingData) {
                    fetchTrackingData();
                }
            }, CONFIG.refreshInterval);
        }

        // Stop auto-refresh
        function stopAutoRefresh() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
                refreshInterval = null;
            }
        }

        // Show loading state
        function showLoading() {
            document.getElementById('tracking-loading').classList.remove('hidden');
            document.getElementById('tracking-content').classList.add('hidden');
        }

        // Hide loading state
        function hideLoading() {
            document.getElementById('tracking-loading').classList.add('hidden');
            document.getElementById('tracking-content').classList.remove('hidden');
        }

        // Show error state
        function showError(message) {
            document.getElementById('error-message').textContent = message;
            document.getElementById('tracking-error').classList.remove('hidden');
            document.getElementById('tracking-content').classList.add('hidden');
        }

        // Hide error state
        function hideError() {
            document.getElementById('tracking-error').classList.add('hidden');
            document.getElementById('tracking-content').classList.remove('hidden');
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', function() {
            stopAutoRefresh();
        });

        // Handle visibility change to optimize refresh
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                stopAutoRefresh();
            } else {
                fetchTrackingData();
                startAutoRefresh();
            }
        });
    </script>

    <style>
        /* Custom map styles */
        .custom-div-icon {
            background: transparent;
            border: none;
        }

        #tracking-map {
            z-index: 1;
        }

        /* Timeline styles */
        #tracking-timeline {
            max-height: 500px;
            overflow-y: auto;
        }

        #tracking-timeline::-webkit-scrollbar {
            width: 6px;
        }

        #tracking-timeline::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #tracking-timeline::-webkit-scrollbar-thumb {
            background: #d4d4d4;
            border-radius: 3px;
        }

        #tracking-timeline::-webkit-scrollbar-thumb:hover {
            background: #a3a3a3;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #tracking-map {
                history: 300px;
            }
        }
    </style>
</x-shop::layouts.account>
