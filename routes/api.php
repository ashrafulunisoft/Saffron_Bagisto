<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PathaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Pathao Courier Integration Routes
|--------------------------------------------------------------------------
|
| Routes for Pathao Courier integration including authentication,
| store management, location data, order management, tracking,
| and price calculation.
|
| Prefix: /api/pathao
|
*/

Route::prefix('pathao')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    |
    | Routes for managing Pathao API authentication tokens.
    | All routes require authentication.
    |
    */
    Route::middleware('auth:api')->group(function () {
        // Get current access token
        Route::get('/token', [PathaoController::class, 'getAccessToken'])
            ->name('api.pathao.token');

        // Refresh access token
        Route::post('/refresh-token', [PathaoController::class, 'refreshToken'])
            ->name('api.pathao.refresh-token');
    });

    /*
    |--------------------------------------------------------------------------
    | Store Management Routes
    |--------------------------------------------------------------------------
    |
    | Routes for managing Pathao stores.
    | All routes require authentication.
    |
    */
    Route::middleware('auth:api')->group(function () {
        // Create a new store
        Route::post('/stores', [PathaoController::class, 'createStore'])
            ->name('api.pathao.stores.create');

        // Get list of stores
        Route::get('/stores', [PathaoController::class, 'getStores'])
            ->name('api.pathao.stores.index');

        // Get specific store info
        Route::get('/stores/{id}', [PathaoController::class, 'getStoreInfo'])
            ->name('api.pathao.stores.show')
            ->where('id', '[0-9]+');
    });

    /*
    |--------------------------------------------------------------------------
    | Location Data Routes
    |--------------------------------------------------------------------------
    |
    | Routes for retrieving Pathao location data (cities, zones, areas).
    | All routes require authentication.
    |
    */
    Route::middleware('auth:api')->group(function () {
        // Get list of cities
        Route::get('/cities', [PathaoController::class, 'getCities'])
            ->name('api.pathao.cities.index');

        // Get zones within a city
        Route::get('/cities/{cityId}/zones', [PathaoController::class, 'getZones'])
            ->name('api.pathao.cities.zones')
            ->where('cityId', '[0-9]+');

        // Get areas within a zone
        Route::get('/zones/{zoneId}/areas', [PathaoController::class, 'getAreas'])
            ->name('api.pathao.zones.areas')
            ->where('zoneId', '[0-9]+');
    });

    /*
    |--------------------------------------------------------------------------
    | Order Management Routes
    |--------------------------------------------------------------------------
    |
    | Routes for managing Pathao delivery orders.
    | All routes require authentication except for order info and tracking.
    |
    */
    Route::middleware('auth:api')->group(function () {
        // Create a new order
        Route::post('/orders', [PathaoController::class, 'createOrder'])
            ->name('api.pathao.orders.create');

        // Create bulk orders
        Route::post('/orders/bulk', [PathaoController::class, 'createBulkOrder'])
            ->name('api.pathao.orders.bulk');
    });

    /*
    |--------------------------------------------------------------------------
    | Order Info & Tracking Routes (Public Access)
    |--------------------------------------------------------------------------
    |
    | Routes for retrieving order information and live tracking.
    | These routes are publicly accessible for customer dashboard.
    | No authentication required.
    |
    */
    // Get order short info (public)
    Route::get('/orders/{consignmentId}/info', [PathaoController::class, 'getOrderInfo'])
        ->name('api.pathao.orders.info')
        ->where('consignmentId', '[A-Za-z0-9-]+');

    // Track order with live tracking info including geo-location (public)
    // This is the MAIN endpoint for customer dashboard to show live location
    Route::get('/orders/{consignmentId}/track', [PathaoController::class, 'trackOrder'])
        ->name('api.pathao.orders.track')
        ->where('consignmentId', '[A-Za-z0-9-]+');

    /*
    |--------------------------------------------------------------------------
    | Price Calculation Route
    |--------------------------------------------------------------------------
    |
    | Route for calculating delivery price.
    | Requires authentication.
    |
    */
    Route::middleware('auth:api')->group(function () {
        // Calculate delivery price
        Route::post('/price-calculate', [PathaoController::class, 'calculatePrice'])
            ->name('api.pathao.price-calculate');
    });

    /*
    |--------------------------------------------------------------------------
    | Testing Routes
    |--------------------------------------------------------------------------
    |
    | Routes for testing Pathao service functions.
    | These routes are publicly accessible for testing purposes.
    |
    */
    // Test extractLocationFromOrderDetails function
    Route::post('/test/extract-location', [PathaoController::class, 'testExtractLocation'])
        ->name('api.pathao.test.extract-location');

    // Test getGeoCoordinatesByLocation function
    Route::post('/test/get-geo-coordinates', [PathaoController::class, 'testGetGeoCoordinates'])
        ->name('api.pathao.test.get-geo-coordinates');
});