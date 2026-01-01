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

        <!-- Tracking Content -->
        <div id="tracking-content" class="mt-8">
            <!-- Courier Status Card -->
            <div class="mb-6 rounded-lg border border-zinc-200 bg-white p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900">
                            Order Status
                        </h3>
                        <p class="mt-1 text-sm text-zinc-500">
                            Order ID: <span class="font-medium text-zinc-900">{{ $order->increment_id }}</span>
                        </p>
                        @if($order->pathao_consignment_id)
                            <p class="mt-1 text-sm text-zinc-500">
                                Consignment ID: <span class="font-medium text-zinc-900">{{ $order->pathao_consignment_id }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if($courier_status)
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-900',
                                    'Accepted' => 'bg-blue-100 text-blue-900',
                                    'Picked' => 'bg-indigo-100 text-indigo-900',
                                    'In Transit' => 'bg-purple-100 text-purple-900',
                                    'Out For Delivery' => 'bg-orange-100 text-orange-900',
                                    'Delivered' => 'bg-green-100 text-green-900',
                                    'Cancelled' => 'bg-red-100 text-red-900',
                                ];
                                $statusColor = $statusColors[$courier_status] ?? 'bg-gray-100 text-gray-900';
                            @endphp
                            <div class="rounded-full {{ $statusColor }} px-4 py-2 text-sm font-medium">
                                {{ $courier_status }}
                            </div>
                        @else
                            <div class="rounded-full bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900">
                                Status Not Available
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Address Card -->
            <div class="mb-6 rounded-lg border border-zinc-200 bg-white p-6">
                <h3 class="mb-4 text-base font-semibold text-zinc-900">
                    Delivery Address
                </h3>
                @if($order->shipping_address)
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm text-zinc-500">Full Name</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ $order->shipping_address->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Phone</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ $order->shipping_address->phone ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-zinc-500">Address</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ $order->shipping_address->address ?? 'N/A' }}
                                @if($order->shipping_address->city || $order->shipping_address->state || $order->shipping_address->country)
                                    <br>
                                    {{ implode(', ', array_filter([
                                        $order->shipping_address->city,
                                        $order->shipping_address->state,
                                        $order->shipping_address->country
                                    ])) }}
                                @endif
                                @if($order->shipping_address->postcode)
                                    <br>
                                    {{ $order->shipping_address->postcode }}
                                @endif
                            </p>
                        </div>
                        @if($order->shipping_address->latitude && $order->shipping_address->longitude)
                            <div>
                                <p class="text-sm text-zinc-500">Latitude</p>
                                <p class="mt-1 text-sm font-medium text-zinc-900">
                                    {{ number_format($order->shipping_address->latitude, 6) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500">Longitude</p>
                                <p class="mt-1 text-sm font-medium text-zinc-900">
                                    {{ number_format($order->shipping_address->longitude, 6) }}
                                </p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-zinc-500">No shipping address available</p>
                @endif
            </div>

            <!-- Map Container -->
            <div class="mb-6 overflow-hidden rounded-lg border border-zinc-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-zinc-200 bg-zinc-50 px-6 py-4">
                    <div class="flex items-center gap-2">
                        <h3 class="text-base font-semibold text-zinc-900">
                            @if(in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']))
                                Live Delivery Location
                            @elseif(in_array($courier_status, ['Pending', 'Accepted', 'Picked']))
                                Shop Location
                            @else
                                Location Map
                            @endif
                        </h3>
                        @if(in_array($courier_status, ['In Transit', 'Out For Delivery']))
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-3 w-3">
                                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex h-3 w-3 rounded-full bg-green-500"></span>
                                </span>
                                <span class="text-sm font-medium text-green-700">Live</span>
                            </div>
                        @endif
                    </div>
                    <!-- Map Legend -->
                    <div class="flex flex-wrap items-center gap-4 text-xs">
                        @if(in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']))
                            <div class="flex items-center gap-2">
                                <div class="h-4 w-4 rounded-full bg-green-600 border-2 border-white shadow-sm"></div>
                                <span class="text-zinc-600">Current Location</span>
                            </div>
                        @endif
                        @if($order->shipping_address && $order->shipping_address->latitude && $order->shipping_address->longitude)
                            <div class="flex items-center gap-2">
                                <div class="h-4 w-4 rounded-full bg-red-600 border-2 border-white shadow-sm"></div>
                                <span class="text-zinc-600">Delivery Address</span>
                            </div>
                        @endif
                        @if(in_array($courier_status, ['Pending', 'Accepted', 'Picked']))
                            <div class="flex items-center gap-2">
                                <div class="h-4 w-4 rounded-full bg-blue-600 border-2 border-white shadow-sm"></div>
                                <span class="text-zinc-600">Shop Location</span>
                            </div>
                        @endif
                    </div>
                </div>
                @if($courier_status && in_array($courier_status, ['Pending', 'Accepted', 'Picked']) && $shop_location)
                    <div id="tracking-map" class="h-[400px] w-full bg-zinc-100"></div>
                @elseif($courier_status && in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']) && $liveGeoLocation)
                    <div id="tracking-map" class="h-[400px] w-full bg-zinc-100"></div>
                @elseif($courier_status === null)
                    <div class="flex items-center justify-center h-[400px] bg-zinc-50">
                        <div class="text-center">
                            <span class="icon-location text-4xl text-zinc-400"></span>
                            <p class="mt-2 text-sm text-zinc-500">Courier status not available. Map will display once the order is processed.</p>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-center h-[400px] bg-zinc-50">
                        <div class="text-center">
                            <span class="icon-location text-4xl text-zinc-400"></span>
                            <p class="mt-2 text-sm text-zinc-500">Location data not available for this order status.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Current Location Info -->
            <div class="mb-6 rounded-lg border border-zinc-200 bg-white p-6">
                <h3 class="mb-4 text-base font-semibold text-zinc-900">
                    @if(in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']))
                        Current Delivery Location
                    @elseif(in_array($courier_status, ['Pending', 'Accepted', 'Picked']))
                        Shop Location
                    @else
                        Location Information
                    @endif
                </h3>

                @if(in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']) && $liveGeoLocation)
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <p class="text-sm text-zinc-500">City</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">{{ $liveGeoLocation['city_name'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Zone</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">{{ $liveGeoLocation['zone_name'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Area</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">{{ $liveGeoLocation['area_name'] ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Latitude</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ $liveGeoLocation['latitude'] ? number_format($liveGeoLocation['latitude'], 6) : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Longitude</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ $liveGeoLocation['longitude'] ? number_format($liveGeoLocation['longitude'], 6) : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Full Address</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                @if($liveGeoLocation['address'])
                                    {{ $liveGeoLocation['address'] }}
                                @elseif($liveGeoLocation['city_name'] || $liveGeoLocation['zone_name'] || $liveGeoLocation['area_name'])
                                    {{ implode(', ', array_filter([$liveGeoLocation['city_name'], $liveGeoLocation['zone_name'], $liveGeoLocation['area_name']])) }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                @elseif(in_array($courier_status, ['Pending', 'Accepted', 'Picked']) && $shop_location)
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm text-zinc-500">Latitude</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ number_format($shop_location['latitude'], 6) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-zinc-500">Longitude</p>
                            <p class="mt-1 text-sm font-medium text-zinc-900">
                                {{ number_format($shop_location['longitude'], 6) }}
                            </p>
                        </div>
                    </div>
                @elseif($courier_status === null)
                    <div class="text-center py-4">
                        <p class="text-sm text-zinc-500">Courier status not available. Location information will be displayed once the order is processed.</p>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-sm text-zinc-500">Location information not available for this order status.</p>
                    </div>
                @endif
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
        // State
        let map = null;
        let shopLocationMarker = null;
        let currentLocationMarker = null;
        let destinationMarker = null;
        let routePolyline = null;

        // Initialize tracking page
        document.addEventListener('DOMContentLoaded', function() {
            // Only initialize map if we have valid location data
            const mapElement = document.getElementById('tracking-map');
            if (mapElement) {
                initMap();
            }
        });

        // Initialize Leaflet map based on courier status
        function initMap() {
            @php
                // Determine which location to show based on courier status
                $showMap = false;
                $mapLat = 23.8103;
                $mapLng = 90.4125;
                $mapZoom = 13;
                $locationType = '';

                if (in_array($courier_status, ['In Transit', 'Out For Delivery', 'Delivered']) && $liveGeoLocation) {
                    $showMap = true;
                    $mapLat = $liveGeoLocation['latitude'];
                    $mapLng = $liveGeoLocation['longitude'];
                    $mapZoom = 15;
                    $locationType = 'live';
                } elseif (in_array($courier_status, ['Pending', 'Accepted', 'Picked']) && $shop_location) {
                    $showMap = true;
                    $mapLat = $shop_location['latitude'];
                    $mapLng = $shop_location['longitude'];
                    $mapZoom = 14;
                    $locationType = 'shop';
                }
            @endphp

            @if($showMap)
                map = L.map('tracking-map').setView([{{ $mapLat }}, {{ $mapLng }}], {{ $mapZoom }});

                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19
                }).addTo(map);

                @if($locationType === 'live' && $liveGeoLocation)
                    // Add current location marker (green)
                    const currentLat = {{ $liveGeoLocation['latitude'] }};
                    const currentLng = {{ $liveGeoLocation['longitude'] }};
                    const currentAddress = '{{ $liveGeoLocation['address'] ?? implode(', ', array_filter([$liveGeoLocation['city_name'], $liveGeoLocation['zone_name'], $liveGeoLocation['area_name']])) }}';

                    const currentIcon = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: #16a34a; width: 32px; height: 32px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); position: relative;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                        </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    currentLocationMarker = L.marker([currentLat, currentLng], { icon: currentIcon })
                        .addTo(map)
                        .bindPopup('<strong>Current Location</strong><br>' + currentAddress);
                @endif

                @if($locationType === 'shop' && $shop_location)
                    // Add shop location marker (blue)
                    const shopLat = {{ $shop_location['latitude'] }};
                    const shopLng = {{ $shop_location['longitude'] }};

                    const shopIcon = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: #2563eb; width: 32px; height: 32px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3); position: relative;">
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 12px; height: 12px; background: white; border-radius: 50%;"></div>
                        </div>`,
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });

                    shopLocationMarker = L.marker([shopLat, shopLng], { icon: shopIcon })
                        .addTo(map)
                        .bindPopup('<strong>Shop Location</strong>');
                @endif

                // Add destination marker (shipping address if available)
                @if($order->shipping_address && $order->shipping_address->latitude && $order->shipping_address->longitude)
                    const destinationLat = {{ $order->shipping_address->latitude }};
                    const destinationLng = {{ $order->shipping_address->longitude }};
                    const destinationAddress = '{{ $order->shipping_address->address ?? "Delivery Address" }}';

                    const destinationIcon = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div style="background-color: #dc2626; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>`,
                        iconSize: [24, 24],
                        iconAnchor: [12, 12]
                    });

                    destinationMarker = L.marker([destinationLat, destinationLng], { icon: destinationIcon })
                        .addTo(map)
                        .bindPopup('<strong>Delivery Address</strong><br>' + destinationAddress);

                    // Draw route if we have both locations
                    @if($locationType === 'live' && $liveGeoLocation)
                        drawRoute({{ $liveGeoLocation['latitude'] }}, {{ $liveGeoLocation['longitude'] }});
                    @elseif($locationType === 'shop' && $shop_location)
                        drawRoute({{ $shop_location['latitude'] }}, {{ $shop_location['longitude'] }});
                    @endif
                @endif

                // Fit map to show all markers
                fitMapToShowAllMarkers();
            @endif
        }

        // Draw route between location and destination
        function drawRoute(fromLat, fromLng) {
            if (!destinationMarker) return;

            const destLatLng = destinationMarker.getLatLng();

            // Remove existing route
            if (routePolyline) {
                map.removeLayer(routePolyline);
            }

            // Draw simple straight line route
            routePolyline = L.polyline([
                [fromLat, fromLng],
                [destLatLng.lat, destLatLng.lng]
            ], {
                color: '#2563eb',
                weight: 4,
                opacity: 0.6,
                dashArray: '10, 10'
            }).addTo(map);
        }

        // Fit map to show all markers
        function fitMapToShowAllMarkers() {
            const markers = [];

            if (shopLocationMarker) {
                markers.push(shopLocationMarker);
            }
            if (currentLocationMarker) {
                markers.push(currentLocationMarker);
            }
            if (destinationMarker) {
                markers.push(destinationMarker);
            }

            if (markers.length > 1) {
                const group = L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.1));
            } else if (markers.length === 1) {
                const marker = markers[0];
                map.setView(marker.getLatLng(), 15);
            }
        }
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

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #tracking-map {
                height: 300px;
            }
        }
    </style>
</x-shop::layouts.account>
