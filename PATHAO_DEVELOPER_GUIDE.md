# Pathao Developer Guide

## Table of Contents
- [Overview](#overview)
- [Getting Started](#getting-started)
- [Using PathaoService](#using-pathaoservice)
- [Using PathaoController](#using-pathaocontroller)
- [Using Pathao Models](#using-pathao-models)
- [Integration with Existing Orders](#integration-with-existing-orders)
- [Common Use Cases](#common-use-cases)
- [Code Examples](#code-examples)
- [Extension Points](#extension-points)
- [Best Practices](#best-practices)
- [Common Pitfalls](#common-pitfalls)
- [Testing](#testing)

---

## Overview

This guide provides developers with comprehensive instructions on how to use the Pathao Courier integration in the Saffron e-commerce platform. It includes code examples, integration patterns, and best practices.

### Target Audience
- Backend developers
- Full-stack developers
- System integrators
- Technical leads

### Prerequisites
- PHP 8.1+ knowledge
- Laravel framework experience
- REST API understanding
- Database relationships knowledge

---

## Getting Started

### Quick Start

1. **Configure Environment Variables**

```env
PATHAO_BASE_URL=https://courier-api-sandbox.pathao.com
PATHAO_CLIENT_ID=your_client_id
PATHAO_CLIENT_SECRET=your_client_secret
PATHAO_USERNAME=your_username
PATHAO_PASSWORD=your_password
PATHAO_GRANT_TYPE=password
```

2. **Inject PathaoService**

```php
use App\Services\PathaoService;

class OrderController extends Controller
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }
}
```

3. **Make Your First API Call**

```php
$result = $this->pathaoService->getAccessToken();

if ($result['success']) {
    $token = $result['data']['access_token'];
    // Use the token
}
```

---

## Using PathaoService

The [`PathaoService`](app/Services/PathaoService.php) is the main service layer for all Pathao API interactions.

### Service Overview

```php
namespace App\Services;

class PathaoService
{
    // Authentication
    public function getAccessToken(): array
    public function refreshAccessToken(string $refreshToken): array

    // Store Management
    public function createStore(array $storeData): array
    public function getStores(): array
    public function getStoreInfo(int $storeId): array

    // Location Data
    public function getCities(): array
    public function getZones(int $cityId): array
    public function getAreas(int $zoneId): array

    // Order Management
    public function createOrder(array $orderData): array
    public function createBulkOrder(array $orders): array
    public function getOrderInfo(string $consignmentId): array
    public function trackOrder(string $consignmentId): array

    // Price Calculation
    public function calculatePrice(array $data): array

    // Cache Management
    public function clearAccessTokenCache(): void
}
```

### Authentication

#### Get Access Token

```php
use App\Services\PathaoService;

$pathaoService = app(PathaoService::class);
$result = $pathaoService->getAccessToken();

if ($result['success']) {
    $accessToken = $result['data']['access_token'];
    $expiresIn = $result['data']['expires_in'];
    // Token is automatically cached for 1 hour
}
```

#### Refresh Access Token

```php
$refreshToken = 'your_refresh_token';
$result = $pathaoService->refreshAccessToken($refreshToken);

if ($result['success']) {
    $newAccessToken = $result['data']['access_token'];
    $newRefreshToken = $result['data']['refresh_token'];
}
```

#### Clear Token Cache

```php
$pathaoService->clearAccessTokenCache();
```

### Store Management

#### Create Store

```php
$storeData = [
    'name' => 'Main Store',
    'contact_name' => 'John Doe',
    'contact_number' => '01712345678',
    'address' => '123 Business Street, Dhaka',
    'city_id' => 1,
    'zone_id' => 2,
    'area_id' => 3,
];

$result = $pathaoService->createStore($storeData);

if ($result['success']) {
    $storeId = $result['data']['store_id'];
    // Store created successfully
}
```

#### Get All Stores

```php
$result = $pathaoService->getStores();

if ($result['success']) {
    $stores = $result['data'];
    foreach ($stores as $store) {
        echo $store['name'] . "\n";
    }
}
```

#### Get Store Info

```php
$storeId = 123;
$result = $pathaoService->getStoreInfo($storeId);

if ($result['success']) {
    $store = $result['data'];
    // Access store details
}
```

### Location Data

#### Get Cities

```php
$result = $pathaoService->getCities();

if ($result['success']) {
    $cities = $result['data'];
    // Cache cities for 24 hours
    Cache::put('pathao_cities', $cities, 86400);
}
```

#### Get Zones by City

```php
$cityId = 1;
$result = $pathaoService->getZones($cityId);

if ($result['success']) {
    $zones = $result['data'];
    // Cache zones for 24 hours
    Cache::put("pathao_zones_{$cityId}", $zones, 86400);
}
```

#### Get Areas by Zone

```php
$zoneId = 2;
$result = $pathaoService->getAreas($zoneId);

if ($result['success']) {
    $areas = $result['data'];
    // Cache areas for 24 hours
    Cache::put("pathao_areas_{$zoneId}", $areas, 86400);
}
```

### Order Management

#### Create Order

```php
$orderData = [
    'store_id' => 123,
    'recipient_name' => 'John Doe',
    'recipient_phone' => '01712345678',
    'recipient_address' => '123 Main Street, Dhaka',
    'recipient_city' => 1,
    'recipient_zone' => 2,
    'recipient_area' => 3,
    'delivery_type' => 48, // 48 hours
    'item_type' => 1, // Document
    'item_quantity' => 1,
    'item_weight' => 0.5,
    'amount_to_collect' => 1000,
    'item_description' => 'Electronics item',
    'special_instruction' => 'Handle with care',
];

$result = $pathaoService->createOrder($orderData);

if ($result['success']) {
    $consignmentId = $result['data']['consignment_id'];
    $deliveryFee = $result['data']['delivery_fee'];
    // Save consignment ID to your order
}
```

#### Create Bulk Orders

```php
$orders = [
    [
        'store_id' => 123,
        'recipient_name' => 'John Doe',
        'recipient_phone' => '01712345678',
        'recipient_address' => '123 Main Street, Dhaka',
        'recipient_city' => 1,
        'recipient_zone' => 2,
        'recipient_area' => 3,
        'delivery_type' => 48,
        'item_type' => 1,
        'item_quantity' => 1,
        'item_weight' => 0.5,
        'amount_to_collect' => 1000,
    ],
    [
        'store_id' => 123,
        'recipient_name' => 'Jane Smith',
        'recipient_phone' => '01812345678',
        'recipient_address' => '456 Market Road, Chittagong',
        'recipient_city' => 2,
        'recipient_zone' => 5,
        'recipient_area' => 8,
        'delivery_type' => 48,
        'item_type' => 2,
        'item_quantity' => 2,
        'item_weight' => 1.0,
        'amount_to_collect' => 2000,
    ],
];

$result = $pathaoService->createBulkOrder($orders);

if ($result['success']) {
    $totalOrders = $result['data']['total_orders'];
    $successfulOrders = $result['data']['successful_orders'];
    // Process results
}
```

#### Get Order Info

```php
$consignmentId = 'CONS-12345678';
$result = $pathaoService->getOrderInfo($consignmentId);

if ($result['success']) {
    $orderInfo = $result['data'];
    $status = $orderInfo['order_status'];
    $deliveryFee = $orderInfo['delivery_fee'];
}
```

#### Track Order with Geo-location

```php
$consignmentId = 'CONS-12345678';
$result = $pathaoService->trackOrder($consignmentId);

if ($result['success']) {
    $status = $result['status'];
    $geoLocation = $result['geo_location'];
    $trackingHistory = $result['tracking_history'];

    if ($geoLocation) {
        $latitude = $geoLocation['latitude'];
        $longitude = $geoLocation['longitude'];
        $address = $geoLocation['address'];
        // Display on map
    }

    foreach ($trackingHistory as $event) {
        echo $event['status'] . ' at ' . $event['timestamp'] . "\n";
    }
}
```

### Price Calculation

```php
$priceData = [
    'store_id' => 123,
    'item_type' => 1,
    'delivery_type' => 48,
    'item_weight' => 0.5,
    'recipient_city' => 1,
    'recipient_zone' => 2,
];

$result = $pathaoService->calculatePrice($priceData);

if ($result['success']) {
    $deliveryFee = $result['data']['delivery_fee'];
    $estimatedDelivery = $result['data']['estimated_delivery'];
    // Display to customer
}
```

---

## Using PathaoController

The [`PathaoController`](app/Http/Controllers/PathaoController.php) handles HTTP requests and responses.

### Controller Overview

```php
namespace App\Http\Controllers;

class PathaoController extends Controller
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;

        // Apply authentication middleware
        $this->middleware('auth:api')->except([
            'trackOrder',
            'getOrderInfo'
        ]);
    }

    // Authentication
    public function getAccessToken(): JsonResponse
    public function refreshToken(): JsonResponse

    // Store Management
    public function createStore(Request $request): JsonResponse
    public function getStores(): JsonResponse
    public function getStoreInfo(int $storeId): JsonResponse

    // Location Data
    public function getCities(): JsonResponse
    public function getZones(int $cityId): JsonResponse
    public function getAreas(int $zoneId): JsonResponse

    // Order Management
    public function createOrder(Request $request): JsonResponse
    public function createBulkOrder(Request $request): JsonResponse

    // Public Tracking (No Auth)
    public function getOrderInfo(string $consignmentId): JsonResponse
    public function trackOrder(string $consignmentId): JsonResponse

    // Price Calculation
    public function calculatePrice(Request $request): JsonResponse
}
```

### Creating Custom Controller Methods

You can extend the PathaoController or create your own controller that uses PathaoService.

#### Example: Order Processing Controller

```php
namespace App\Http\Controllers;

use App\Services\PathaoService;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderProcessingController extends Controller
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    /**
     * Create Pathao order from existing order
     */
    public function createPathaoOrder(int $orderId): JsonResponse
    {
        $order = Order::findOrFail($orderId);

        // Prepare order data
        $orderData = [
            'store_id' => config('pathao.default_store_id'),
            'recipient_name' => $order->customer_name,
            'recipient_phone' => $order->customer_phone,
            'recipient_address' => $order->shipping_address,
            'recipient_city' => $order->shipping_city_id,
            'recipient_zone' => $order->shipping_zone_id,
            'recipient_area' => $order->shipping_area_id,
            'delivery_type' => 48,
            'item_type' => 2,
            'item_quantity' => $order->items->count(),
            'item_weight' => $order->total_weight,
            'amount_to_collect' => $order->grand_total,
            'item_description' => 'Order #' . $order->id,
        ];

        // Create Pathao order
        $result = $this->pathaoService->createOrder($orderData);

        if ($result['success']) {
            // Update order with consignment ID
            $order->pathao_consignment_id = $result['data']['consignment_id'];
            $order->pathao_tracking_enabled = true;
            $order->save();

            // Create PathaoOrder record
            $pathaoOrder = \App\Models\PathaoOrder::create([
                'order_id' => $order->id,
                'consignment_id' => $result['data']['consignment_id'],
                'merchant_order_id' => 'ORD-' . $order->id,
                'store_id' => $orderData['store_id'],
                'order_status' => $result['data']['order_status'],
                'delivery_fee' => $result['data']['delivery_fee'],
                'recipient_name' => $orderData['recipient_name'],
                'recipient_phone' => $orderData['recipient_phone'],
                'recipient_address' => $orderData['recipient_address'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pathao order created successfully',
                'data' => [
                    'consignment_id' => $pathaoOrder->consignment_id,
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create Pathao order',
            'errors' => $result['error']
        ], 400);
    }

    /**
     * Sync tracking data for order
     */
    public function syncTracking(int $orderId): JsonResponse
    {
        $order = Order::findOrFail($orderId);

        if (!$order->pathao_consignment_id) {
            return response()->json([
                'success' => false,
                'message' => 'No Pathao consignment ID found'
            ], 404);
        }

        // Get tracking data
        $result = $this->pathaoService->trackOrder($order->pathao_consignment_id);

        if ($result['success']) {
            // Find Pathao order
            $pathaoOrder = \App\Models\PathaoOrder::where('consignment_id', $order->pathao_consignment_id)
                ->first();

            if ($pathaoOrder) {
                // Update tracking data
                $pathaoOrder->updateTracking($result['data']);

                // Create tracking history records
                foreach ($result['tracking_history'] as $event) {
                    \App\Models\PathaoTrackingHistory::create([
                        'pathao_order_id' => $pathaoOrder->id,
                        'status' => $event['status'],
                        'status_slug' => $event['status_slug'] ?? null,
                        'latitude' => $event['latitude'] ?? null,
                        'longitude' => $event['longitude'] ?? null,
                        'location_name' => $event['location_name'] ?? null,
                        'remarks' => $event['remarks'] ?? null,
                        'timestamp' => $event['timestamp'] ?? now(),
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Tracking data synced successfully',
                'data' => $result['data']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to sync tracking data',
            'errors' => $result['error']
        ], 400);
    }
}
```

---

## Using Pathao Models

The Pathao integration includes two main models: [`PathaoOrder`](app/Models/PathaoOrder.php) and [`PathaoTrackingHistory`](app/Models/PathaoTrackingHistory.php).

### PathaoOrder Model

#### Model Relationships

```php
use App\Models\PathaoOrder;

// Get order relationship
$pathaoOrder = PathaoOrder::with('order')->first();
$order = $pathaoOrder->order;

// Get tracking history
$pathaoOrder = PathaoOrder::with('trackingHistory')->first();
$history = $pathaoOrder->trackingHistory;
```

#### Status Helper Methods

```php
$pathaoOrder = PathaoOrder::first();

// Check status
if ($pathaoOrder->isDelivered()) {
    // Order is delivered
}

if ($pathaoOrder->isInTransit()) {
    // Order is in transit
}

if ($pathaoOrder->isPending()) {
    // Order is pending
}

if ($pathaoOrder->isCancelled()) {
    // Order is cancelled
}

if ($pathaoOrder->isReturned()) {
    // Order is returned
}

if ($pathaoOrder->isOutForDelivery()) {
    // Order is out for delivery
}
```

#### Query Scopes

```php
// Get pending orders
$pendingOrders = PathaoOrder::pending()->get();

// Get in-transit orders
$inTransitOrders = PathaoOrder::inTransit()->get();

// Get delivered orders
$deliveredOrders = PathaoOrder::delivered()->get();

// Get cancelled orders
$cancelledOrders = PathaoOrder::cancelled()->get();

// Get returned orders
$returnedOrders = PathaoOrder::returned()->get();
```

#### Find by Consignment ID

```php
$consignmentId = 'CONS-12345678';
$pathaoOrder = PathaoOrder::findByConsignmentId($consignmentId);

if ($pathaoOrder) {
    echo "Order ID: " . $pathaoOrder->order_id;
    echo "Status: " . $pathaoOrder->status_label;
}
```

#### Find by Merchant Order ID

```php
$merchantOrderId = 'ORD-001';
$pathaoOrder = PathaoOrder::findByMerchantOrderId($merchantOrderId);

if ($pathaoOrder) {
    echo "Consignment ID: " . $pathaoOrder->consignment_id;
}
```

#### Get Location

```php
$pathaoOrder = PathaoOrder::first();
$location = $pathaoOrder->getLocation();

if ($location) {
    echo "Latitude: " . $location['latitude'];
    echo "Longitude: " . $location['longitude'];
}
```

#### Get Tracking History

```php
$pathaoOrder = PathaoOrder::first();
$history = $pathaoOrder->getTrackingHistory();

foreach ($history as $event) {
    echo $event['status'] . ' - ' . $event['timestamp'] . "\n";
}
```

#### Update Tracking Data

```php
$pathaoOrder = PathaoOrder::first();

$trackingData = [
    'status' => 'In Transit',
    'status_slug' => 'in-transit',
    'latitude' => 23.8103,
    'longitude' => 90.4125,
    'tracking_history' => [
        [
            'status' => 'Picked Up',
            'timestamp' => now()->toIso8601String(),
        ]
    ]
];

$pathaoOrder->updateTracking($trackingData);
```

#### Get Formatted Delivery Fee

```php
$pathaoOrder = PathaoOrder::first();
$fee = $pathaoOrder->getFormattedDeliveryFee();
echo "Delivery Fee: ৳" . $fee;
```

### PathaoTrackingHistory Model

#### Model Relationships

```php
use App\Models\PathaoTrackingHistory;

// Get Pathao order relationship
$history = PathaoTrackingHistory::with('pathaoOrder')->first();
$pathaoOrder = $history->pathaoOrder;
```

#### Get Location

```php
$history = PathaoTrackingHistory::first();
$location = $history->getLocation();

if ($location) {
    echo "Latitude: " . $location['latitude'];
    echo "Longitude: " . $location['longitude'];
    echo "Location: " . $location['location_name'];
}
```

#### Query with Latest

```php
// Get latest tracking history for an order
$latestHistory = PathaoTrackingHistory::where('pathao_order_id', 1)
    ->latest()
    ->first();
```

---

## Integration with Existing Orders

### Creating Pathao Order from Existing Order

```php
use App\Models\Order;
use App\Models\PathaoOrder;
use App\Services\PathaoService;

class OrderService
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function createPathaoOrderForOrder(int $orderId): array
    {
        $order = Order::findOrFail($orderId);

        // Check if Pathao order already exists
        if ($order->pathao_consignment_id) {
            return [
                'success' => false,
                'message' => 'Pathao order already exists'
            ];
        }

        // Prepare order data for Pathao
        $orderData = [
            'store_id' => $this->getStoreIdForOrder($order),
            'recipient_name' => $order->shipping_address->first_name . ' ' . $order->shipping_address->last_name,
            'recipient_phone' => $order->shipping_address->phone,
            'recipient_address' => $this->formatAddress($order->shipping_address),
            'recipient_city' => $this->getCityId($order->shipping_address),
            'recipient_zone' => $this->getZoneId($order->shipping_address),
            'recipient_area' => $this->getAreaId($order->shipping_address),
            'delivery_type' => $this->getDeliveryType($order),
            'item_type' => $this->getItemType($order),
            'item_quantity' => $order->items->count(),
            'item_weight' => $this->calculateWeight($order),
            'amount_to_collect' => $order->grand_total,
            'item_description' => $this->getItemDescription($order),
            'special_instruction' => $order->customer_note,
        ];

        // Create Pathao order
        $result = $this->pathaoService->createOrder($orderData);

        if ($result['success']) {
            // Update order with Pathao data
            $order->pathao_consignment_id = $result['data']['consignment_id'];
            $order->pathao_tracking_enabled = true;
            $order->save();

            // Create PathaoOrder record
            $pathaoOrder = PathaoOrder::create([
                'order_id' => $order->id,
                'consignment_id' => $result['data']['consignment_id'],
                'merchant_order_id' => 'ORD-' . $order->id,
                'store_id' => $orderData['store_id'],
                'order_status' => $result['data']['order_status'],
                'delivery_fee' => $result['data']['delivery_fee'],
                'recipient_name' => $orderData['recipient_name'],
                'recipient_phone' => $orderData['recipient_phone'],
                'recipient_address' => $orderData['recipient_address'],
            ]);

            return [
                'success' => true,
                'message' => 'Pathao order created successfully',
                'data' => [
                    'consignment_id' => $pathaoOrder->consignment_id,
                    'delivery_fee' => $pathaoOrder->delivery_fee,
                ]
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to create Pathao order',
            'errors' => $result['error']
        ];
    }

    private function formatAddress($address): string
    {
        $parts = array_filter([
            $address->address1,
            $address->address2,
            $address->city,
            $address->state,
            $address->postcode,
            $address->country,
        ]);

        return implode(', ', $parts);
    }

    private function calculateWeight(Order $order): float
    {
        return $order->items->sum(function ($item) {
            return $item->quantity * ($item->weight ?? 0.5);
        });
    }

    // Additional helper methods...
}
```

### Syncing Tracking Data

```php
use App\Models\Order;
use App\Models\PathaoOrder;
use App\Models\PathaoTrackingHistory;
use App\Services\PathaoService;

class TrackingSyncService
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function syncOrderTracking(int $orderId): array
    {
        $order = Order::findOrFail($orderId);

        if (!$order->pathao_consignment_id) {
            return [
                'success' => false,
                'message' => 'No Pathao consignment ID found'
            ];
        }

        // Get tracking data from Pathao
        $result = $this->pathaoService->trackOrder($order->pathao_consignment_id);

        if (!$result['success']) {
            return [
                'success' => false,
                'message' => 'Failed to get tracking data',
                'errors' => $result['error']
            ];
        }

        // Find or create Pathao order
        $pathaoOrder = PathaoOrder::firstOrCreate(
            ['consignment_id' => $order->pathao_consignment_id],
            [
                'order_id' => $order->id,
                'merchant_order_id' => 'ORD-' . $order->id,
            ]
        );

        // Update Pathao order with latest data
        $pathaoOrder->updateTracking($result['data']);

        // Create tracking history records
        foreach ($result['tracking_history'] as $event) {
            // Check if this event already exists
            $exists = PathaoTrackingHistory::where('pathao_order_id', $pathaoOrder->id)
                ->where('status', $event['status'])
                ->where('timestamp', $event['timestamp'])
                ->exists();

            if (!$exists) {
                PathaoTrackingHistory::create([
                    'pathao_order_id' => $pathaoOrder->id,
                    'status' => $event['status'],
                    'status_slug' => $event['status_slug'] ?? null,
                    'latitude' => $event['latitude'] ?? null,
                    'longitude' => $event['longitude'] ?? null,
                    'location_name' => $event['location_name'] ?? null,
                    'remarks' => $event['remarks'] ?? null,
                    'timestamp' => $event['timestamp'] ?? now(),
                ]);
            }
        }

        return [
            'success' => true,
            'message' => 'Tracking data synced successfully',
            'data' => [
                'status' => $pathaoOrder->order_status,
                'geo_location' => $pathaoOrder->getLocation(),
                'tracking_history' => $pathaoOrder->trackingHistory()->latest()->get(),
            ]
        ];
    }

    public function syncAllPendingOrders(): array
    {
        $orders = Order::where('pathao_tracking_enabled', true)
            ->where('pathao_consignment_id', '!=', null)
            ->whereHas('pathaoOrder', function ($query) {
                $query->whereIn('order_status', [
                    PathaoOrder::STATUS_PENDING,
                    PathaoOrder::STATUS_IN_TRANSIT,
                    PathaoOrder::STATUS_PICKUP_PENDING,
                    PathaoOrder::STATUS_PICKED_UP,
                    PathaoOrder::STATUS_AT_HUB,
                    PathaoOrder::STATUS_OUT_FOR_DELIVERY,
                ]);
            })
            ->get();

        $results = [
            'total' => $orders->count(),
            'successful' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        foreach ($orders as $order) {
            $result = $this->syncOrderTracking($order->id);

            if ($result['success']) {
                $results['successful']++;
            } else {
                $results['failed']++;
                $results['errors'][] = [
                    'order_id' => $order->id,
                    'error' => $result['message'],
                ];
            }
        }

        return $results;
    }
}
```

---

## Common Use Cases

### Use Case 1: Auto-create Pathao Order on Order Completion

```php
namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Services\OrderService;

class CreatePathaoOrder
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function handle(OrderCompleted $event)
    {
        $order = $event->order;

        // Only create Pathao order for specific shipping methods
        if ($order->shipping_method === 'pathao') {
            $this->orderService->createPathaoOrderForOrder($order->id);
        }
    }
}
```

### Use Case 2: Display Tracking on Customer Dashboard

```php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    public function show(int $orderId): JsonResponse
    {
        $order = Order::with('pathaoOrder.trackingHistory')
            ->where('customer_id', auth()->id())
            ->findOrFail($orderId);

        if (!$order->pathao_tracking_enabled || !$order->pathao_consignment_id) {
            return response()->json([
                'success' => false,
                'message' => 'Tracking not available for this order'
            ], 404);
        }

        $pathaoOrder = $order->pathaoOrder;

        return response()->json([
            'success' => true,
            'data' => [
                'order_id' => $order->id,
                'consignment_id' => $pathaoOrder->consignment_id,
                'status' => $pathaoOrder->status_label,
                'current_location' => $pathaoOrder->getLocation(),
                'tracking_history' => $pathaoOrder->trackingHistory()
                    ->latest()
                    ->get()
                    ->map(function ($history) {
                        return [
                            'status' => $history->status,
                            'location' => $history->getLocation(),
                            'timestamp' => $history->timestamp->toIso8601String(),
                            'remarks' => $history->remarks,
                        ];
                    }),
            ]
        ]);
    }
}
```

### Use Case 3: Scheduled Tracking Sync

```php
namespace App\Console\Commands;

use App\Services\TrackingSyncService;
use Illuminate\Console\Command;

class SyncPathaoTracking extends Command
{
    protected $signature = 'pathao:sync-tracking';
    protected $description = 'Sync tracking data for all active Pathao orders';

    protected TrackingSyncService $syncService;

    public function __construct(TrackingSyncService $syncService)
    {
        parent::__construct();
        $this->syncService = $syncService;
    }

    public function handle()
    {
        $this->info('Starting Pathao tracking sync...');

        $results = $this->syncService->syncAllPendingOrders();

        $this->info("Total orders: {$results['total']}");
        $this->info("Successful: {$results['successful']}");
        $this->info("Failed: {$results['failed']}");

        if (!empty($results['errors'])) {
            $this->warn('Errors:');
            foreach ($results['errors'] as $error) {
                $this->warn("  Order {$error['order_id']}: {$error['error']}");
            }
        }

        $this->info('Pathao tracking sync completed.');

        return 0;
    }
}
```

Schedule the command in `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('pathao:sync-tracking')
        ->everyFiveMinutes()
        ->withoutOverlapping();
}
```

### Use Case 4: Calculate Delivery Price Before Order

```php
namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Services\PathaoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShippingController extends Controller
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function calculatePrice(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'city_id' => 'required|integer',
            'zone_id' => 'required|integer',
            'weight' => 'required|numeric|min:0',
            'delivery_type' => 'required|integer|in:12,48',
        ]);

        $priceData = [
            'store_id' => config('pathao.default_store_id'),
            'item_type' => 2, // Parcel
            'delivery_type' => $validated['delivery_type'],
            'item_weight' => $validated['weight'],
            'recipient_city' => $validated['city_id'],
            'recipient_zone' => $validated['zone_id'],
        ];

        $result = $this->pathaoService->calculatePrice($priceData);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'data' => [
                    'delivery_fee' => $result['data']['delivery_fee'],
                    'estimated_delivery' => $result['data']['estimated_delivery'],
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to calculate price',
            'errors' => $result['error']
        ], 400);
    }
}
```

---

## Code Examples

### Example 1: Complete Order Flow

```php
use App\Models\Order;
use App\Models\PathaoOrder;
use App\Services\PathaoService;

class CompleteOrderFlow
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function processOrder(int $orderId): array
    {
        // Step 1: Get order
        $order = Order::findOrFail($orderId);

        // Step 2: Calculate price
        $priceResult = $this->calculateDeliveryPrice($order);
        if (!$priceResult['success']) {
            return $priceResult;
        }

        // Step 3: Create Pathao order
        $orderResult = $this->createPathaoOrder($order);
        if (!$orderResult['success']) {
            return $orderResult;
        }

        // Step 4: Get initial tracking
        $trackingResult = $this->getTrackingData($orderResult['consignment_id']);

        return [
            'success' => true,
            'message' => 'Order processed successfully',
            'data' => [
                'order_id' => $order->id,
                'consignment_id' => $orderResult['consignment_id'],
                'delivery_fee' => $priceResult['delivery_fee'],
                'tracking' => $trackingResult,
            ]
        ];
    }

    private function calculateDeliveryPrice(Order $order): array
    {
        $data = [
            'store_id' => config('pathao.default_store_id'),
            'item_type' => 2,
            'delivery_type' => 48,
            'item_weight' => $this->calculateWeight($order),
            'recipient_city' => $order->shipping_city_id,
            'recipient_zone' => $order->shipping_zone_id,
        ];

        $result = $this->pathaoService->calculatePrice($data);

        if ($result['success']) {
            return [
                'success' => true,
                'delivery_fee' => $result['data']['delivery_fee'],
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to calculate price',
            'errors' => $result['error']
        ];
    }

    private function createPathaoOrder(Order $order): array
    {
        $orderData = [
            'store_id' => config('pathao.default_store_id'),
            'recipient_name' => $order->customer_name,
            'recipient_phone' => $order->customer_phone,
            'recipient_address' => $order->shipping_address,
            'recipient_city' => $order->shipping_city_id,
            'recipient_zone' => $order->shipping_zone_id,
            'recipient_area' => $order->shipping_area_id,
            'delivery_type' => 48,
            'item_type' => 2,
            'item_quantity' => $order->items->count(),
            'item_weight' => $this->calculateWeight($order),
            'amount_to_collect' => $order->grand_total,
        ];

        $result = $this->pathaoService->createOrder($orderData);

        if ($result['success']) {
            // Update order
            $order->pathao_consignment_id = $result['data']['consignment_id'];
            $order->pathao_tracking_enabled = true;
            $order->save();

            return [
                'success' => true,
                'consignment_id' => $result['data']['consignment_id'],
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to create Pathao order',
            'errors' => $result['error']
        ];
    }

    private function getTrackingData(string $consignmentId): array
    {
        $result = $this->pathaoService->trackOrder($consignmentId);

        if ($result['success']) {
            return $result['data'];
        }

        return [];
    }

    private function calculateWeight(Order $order): float
    {
        return $order->items->sum(function ($item) {
            return $item->quantity * ($item->weight ?? 0.5);
        });
    }
}
```

### Example 2: Location Data Caching

```php
use App\Services\PathaoService;
use Illuminate\Support\Facades\Cache;

class LocationDataService
{
    protected PathaoService $pathaoService;

    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
    }

    public function getCities(): array
    {
        return Cache::remember('pathao_cities', 86400, function () {
            $result = $this->pathaoService->getCities();
            return $result['success'] ? $result['data'] : [];
        });
    }

    public function getZones(int $cityId): array
    {
        return Cache::remember("pathao_zones_{$cityId}", 86400, function () use ($cityId) {
            $result = $this->pathaoService->getZones($cityId);
            return $result['success'] ? $result['data'] : [];
        });
    }

    public function getAreas(int $zoneId): array
    {
        return Cache::remember("pathao_areas_{$zoneId}", 86400, function () use ($zoneId) {
            $result = $this->pathaoService->getAreas($zoneId);
            return $result['success'] ? $result['data'] : [];
        });
    }

    public function getLocationHierarchy(int $areaId): array
    {
        $area = Cache::remember("pathao_area_{$areaId}", 86400, function () use ($areaId) {
            // Get all areas and find the matching one
            $zones = $this->getAllZones();
            foreach ($zones as $zone) {
                $areas = $this->getAreas($zone['zone_id']);
                foreach ($areas as $area) {
                    if ($area['area_id'] == $areaId) {
                        return [
                            'area' => $area,
                            'zone' => $zone,
                            'city' => $this->getCityById($zone['city_id']),
                        ];
                    }
                }
            }
            return null;
        });

        return $area ?? [];
    }

    private function getAllZones(): array
    {
        $cities = $this->getCities();
        $zones = [];
        foreach ($cities as $city) {
            $zones = array_merge($zones, $this->getZones($city['city_id']));
        }
        return $zones;
    }

    private function getCityById(int $cityId): ?array
    {
        $cities = $this->getCities();
        foreach ($cities as $city) {
            if ($city['city_id'] == $cityId) {
                return $city;
            }
        }
        return null;
    }
}
```

---

## Extension Points

### Custom Service Methods

You can extend [`PathaoService`](app/Services/PathaoService.php) by creating a custom service:

```php
namespace App\Services;

class CustomPathaoService extends PathaoService
{
    /**
     * Get delivery estimate for multiple orders
     */
    public function getBulkDeliveryEstimates(array $orders): array
    {
        $estimates = [];

        foreach ($orders as $order) {
            $result = $this->calculatePrice([
                'store_id' => $order['store_id'],
                'item_type' => $order['item_type'],
                'delivery_type' => $order['delivery_type'],
                'item_weight' => $order['item_weight'],
                'recipient_city' => $order['city_id'],
                'recipient_zone' => $order['zone_id'],
            ]);

            $estimates[] = [
                'order_id' => $order['order_id'],
                'delivery_fee' => $result['success'] ? $result['data']['delivery_fee'] : null,
                'estimated_delivery' => $result['success'] ? $result['data']['estimated_delivery'] : null,
            ];
        }

        return $estimates;
    }

    /**
     * Cancel order
     */
    public function cancelOrder(string $consignmentId): array
    {
        try {
            $endpoint = "/aladdin/api/v1/orders/{$consignmentId}/cancel";
            $result = $this->makeAuthenticatedRequest('post', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Order Cancelled Successfully', [
                    'consignment_id' => $consignmentId
                ]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Cancel Order Exception', [
                'consignment_id' => $consignmentId,
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Failed to cancel order',
                'error' => $e->getMessage()
            ];
        }
    }
}
```

### Custom Model Methods

Add custom methods to [`PathaoOrder`](app/Models/PathaoOrder.php) model:

```php
namespace App\Models;

class PathaoOrder extends Model
{
    // ... existing code ...

    /**
     * Get estimated delivery time
     */
    public function getEstimatedDeliveryTime(): ?string
    {
        $createdAt = $this->created_at;
        $deliveryType = $this->order_status === PathaoOrder::STATUS_DELIVERED
            ? $this->updated_at
            : null;

        if ($createdAt && $deliveryType) {
            return $createdAt->diffForHumans($deliveryType);
        }

        return null;
    }

    /**
     * Get tracking timeline
     */
    public function getTrackingTimeline(): array
    {
        return $this->trackingHistory()
            ->orderBy('timestamp', 'asc')
            ->get()
            ->map(function ($history) {
                return [
                    'status' => $history->status,
                    'location' => $history->getLocation(),
                    'timestamp' => $history->timestamp->toIso8601String(),
                    'remarks' => $history->remarks,
                ];
            })
            ->toArray();
    }

    /**
     * Get delivery progress percentage
     */
    public function getDeliveryProgress(): int
    {
        $statusOrder = [
            PathaoOrder::STATUS_PENDING => 10,
            PathaoOrder::STATUS_PICKUP_PENDING => 20,
            PathaoOrder::STATUS_PICKED_UP => 30,
            PathaoOrder::STATUS_AT_HUB => 50,
            PathaoOrder::STATUS_IN_TRANSIT => 70,
            PathaoOrder::STATUS_OUT_FOR_DELIVERY => 90,
            PathaoOrder::STATUS_DELIVERED => 100,
        ];

        return $statusOrder[$this->order_status] ?? 0;
    }
}
```

---

## Best Practices

### 1. Error Handling

Always check the success flag:

```php
$result = $pathaoService->createOrder($orderData);

if (!$result['success']) {
    // Log error
    Log::error('Failed to create Pathao order', [
        'order_id' => $orderId,
        'error' => $result['error']
    ]);

    // Handle error appropriately
    throw new Exception('Failed to create Pathao order');
}
```

### 2. Caching

Cache frequently accessed data:

```php
$cities = Cache::remember('pathao_cities', 86400, function () use ($pathaoService) {
    $result = $pathaoService->getCities();
    return $result['success'] ? $result['data'] : [];
});
```

### 3. Validation

Validate input data before API calls:

```php
$validated = $request->validate([
    'recipient_phone' => 'required|string|size:11',
    'delivery_type' => 'required|integer|in:12,48',
]);

$result = $pathaoService->createOrder($validated);
```

### 4. Logging

Log important events:

```php
Log::info('Pathao order created', [
    'order_id' => $orderId,
    'consignment_id' => $consignmentId,
    'delivery_fee' => $deliveryFee,
]);
```

### 5. Transactions

Use database transactions for critical operations:

```php
DB::transaction(function () use ($order, $orderData) {
    $result = $pathaoService->createOrder($orderData);

    if ($result['success']) {
        $order->pathao_consignment_id = $result['data']['consignment_id'];
        $order->save();

        PathaoOrder::create([
            'order_id' => $order->id,
            'consignment_id' => $result['data']['consignment_id'],
            // ...
        ]);
    }
});
```

### 6. Async Operations

Use queues for time-consuming operations:

```php
ProcessPathaoOrder::dispatch($orderId);
```

---

## Common Pitfalls

### 1. Not Checking Success Flag

❌ **Wrong:**
```php
$result = $pathaoService->createOrder($orderData);
$consignmentId = $result['data']['consignment_id']; // May cause error
```

✅ **Correct:**
```php
$result = $pathaoService->createOrder($orderData);
if ($result['success']) {
    $consignmentId = $result['data']['consignment_id'];
}
```

### 2. Not Caching Location Data

❌ **Wrong:**
```php
// Every request calls API
$result = $pathaoService->getCities();
```

✅ **Correct:**
```php
$cities = Cache::remember('pathao_cities', 86400, function () use ($pathaoService) {
    $result = $pathaoService->getCities();
    return $result['success'] ? $result['data'] : [];
});
```

### 3. Not Validating Phone Numbers

❌ **Wrong:**
```php
'recipient_phone' => $request->phone, // May be invalid format
```

✅ **Correct:**
```php
'recipient_phone' => preg_replace('/[^0-9]/', '', $request->phone), // Clean phone number
```

### 4. Not Handling API Errors

❌ **Wrong:**
```php
$result = $pathaoService->createOrder($orderData);
// No error handling
```

✅ **Correct:**
```php
$result = $pathaoService->createOrder($orderData);
if (!$result['success']) {
    Log::error('Pathao API error', $result['error']);
    // Handle error appropriately
}
```

### 5. Not Using Database Transactions

❌ **Wrong:**
```php
$order->pathao_consignment_id = $consignmentId;
$order->save();
PathaoOrder::create([...]); // May fail, leaving inconsistent state
```

✅ **Correct:**
```php
DB::transaction(function () use ($order, $consignmentId) {
    $order->pathao_consignment_id = $consignmentId;
    $order->save();
    PathaoOrder::create([...]);
});
```

---

## Testing

### Unit Tests

```php
namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PathaoService;
use Illuminate\Support\Facades\Http;

class PathaoServiceTest extends TestCase
{
    protected PathaoService $pathaoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pathaoService = app(PathaoService::class);
    }

    public function test_get_access_token()
    {
        Http::fake([
            '*' => Http::response([
                'access_token' => 'test_token',
                'expires_in' => 3600,
            ], 200),
        ]);

        $result = $this->pathaoService->getAccessToken();

        $this->assertTrue($result['success']);
        $this->assertEquals('test_token', $result['data']['access_token']);
    }

    public function test_create_order()
    {
        Http::fake([
            '*' => Http::response([
                'consignment_id' => 'CONS-12345',
                'order_status' => 'Pending',
                'delivery_fee' => 60.00,
            ], 201),
        ]);

        $orderData = [
            'store_id' => 123,
            'recipient_name' => 'Test Customer',
            'recipient_phone' => '01712345678',
            'recipient_address' => 'Test Address',
            'recipient_city' => 1,
            'recipient_zone' => 2,
            'recipient_area' => 3,
            'delivery_type' => 48,
            'item_type' => 1,
            'item_quantity' => 1,
            'item_weight' => 0.5,
            'amount_to_collect' => 1000,
        ];

        $result = $this->pathaoService->createOrder($orderData);

        $this->assertTrue($result['success']);
        $this->assertEquals('CONS-12345', $result['data']['consignment_id']);
    }
}
```

### Feature Tests

```php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\PathaoOrder;
use Illuminate\Support\Facades\Http;

class PathaoOrderTest extends TestCase
{
    public function test_create_pathao_order_from_order()
    {
        Http::fake([
            '*' => Http::response([
                'consignment_id' => 'CONS-12345',
                'order_status' => 'Pending',
                'delivery_fee' => 60.00,
            ], 201),
        ]);

        $order = Order::factory()->create([
            'pathao_consignment_id' => null,
        ]);

        $response = $this->postJson("/api/orders/{$order->id}/pathao");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'consignment_id' => 'CONS-12345',
                ]
            ]);

        $this->assertDatabaseHas('pathao_orders', [
            'consignment_id' => 'CONS-12345',
            'order_id' => $order->id,
        ]);

        $order->refresh();
        $this->assertEquals('CONS-12345', $order->pathao_consignment_id);
    }
}
```

---

## Additional Resources

- [Integration Guide](PATHAO_COURIER_INTEGRATION_GUIDE.md)
- [API Documentation](PATHAO_API_DOCUMENTATION.md)
- [Deployment Guide](PATHAO_DEPLOYMENT_GUIDE.md)
- [Pathao Official API Documentation](https://docs.pathao.com/)
