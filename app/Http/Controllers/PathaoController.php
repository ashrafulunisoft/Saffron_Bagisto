<?php

namespace App\Http\Controllers;

use App\Services\PathaoService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

/**
 * Pathao Controller
 *
 * Handles HTTP requests for Pathao Courier integration including
 * authentication, store management, location data, order management,
 * tracking, and price calculation.
 *
 * @package App\Http\Controllers
 */
class PathaoController extends Controller
{
    /**
     * Pathao Service instance
     *
     * @var PathaoService
     */
    protected PathaoService $pathaoService;

    /**
     * Cache key for refresh token
     */
    private const REFRESH_TOKEN_CACHE_KEY = 'pathao_refresh_token';

    /**
     * Create a new controller instance.
     *
     * @param PathaoService $pathaoService
     * @return void
     */
    public function __construct(PathaoService $pathaoService)
    {
        $this->pathaoService = $pathaoService;
        // Middleware is applied in routes/api.php, not needed here
    }

    /**
     * Get current access token
     *
     * Retrieves the current access token from cache or fetches a new one.
     * This endpoint is useful for debugging and monitoring token status.
     *
     * @return JsonResponse
     */
    public function getAccessToken(): JsonResponse
    {
        try {
            $result = $this->pathaoService->getAccessToken();

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => [
                        'access_token' => $result['data']['access_token'] ?? null,
                        'token_type' => $result['data']['token_type'] ?? 'Bearer',
                        'expires_in' => $result['data']['expires_in'] ?? null,
                        'scope' => $result['data']['scope'] ?? null,
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getAccessToken Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve access token',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Refresh access token
     *
     * Refreshes the access token using the stored refresh token.
     * If no refresh token is available, it will return an error.
     *
     * @return JsonResponse
     */
    public function refreshToken(): JsonResponse
    {
        try {
            // Get refresh token from cache
            $refreshToken = Cache::get(self::REFRESH_TOKEN_CACHE_KEY);

            if (!$refreshToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'No refresh token available',
                    'errors' => ['refresh_token' => 'Refresh token not found in cache']
                ], 404);
            }

            $result = $this->pathaoService->refreshAccessToken($refreshToken);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'data' => [
                        'access_token' => $result['data']['access_token'] ?? null,
                        'token_type' => $result['data']['token_type'] ?? 'Bearer',
                        'expires_in' => $result['data']['expires_in'] ?? null,
                        'refresh_token' => $result['data']['refresh_token'] ?? null,
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController refreshToken Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to refresh access token',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Create a new store
     *
     * Creates a new store in Pathao system with the provided details.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createStore(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'contact_number' => 'required|string|min:11|max:11',
                'address' => 'required|string|max:500',
                'city_id' => 'required|integer',
                'zone_id' => 'required|integer',
                'area_id' => 'required|integer',
            ]);

            $result = $this->pathaoService->createStore($validated);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Store created successfully',
                    'data' => $result['data']
                ], 201);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController createStore Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create store',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get list of stores
     *
     * Retrieves all stores associated with the authenticated account.
     *
     * @return JsonResponse
     */
    public function getStores(): JsonResponse
    {
        try {
            $result = $this->pathaoService->getStores();

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Stores retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getStores Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve stores',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get specific store info
     *
     * Retrieves detailed information about a specific store by ID.
     *
     * @param int $storeId
     * @return JsonResponse
     */
    public function getStoreInfo(int $storeId): JsonResponse
    {
        try {
            $result = $this->pathaoService->getStoreInfo($storeId);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Store info retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getStoreInfo Exception', [
                'store_id' => $storeId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve store info',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get list of cities
     *
     * Retrieves all available cities in the Pathao system.
     * This is useful for populating dropdown menus in the frontend.
     *
     * @return JsonResponse
     */
    public function getCities(): JsonResponse
    {
        try {
            $result = $this->pathaoService->getCities();

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cities retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getCities Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve cities',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get zones within a city
     *
     * Retrieves all zones available within a specific city.
     *
     * @param int $cityId
     * @return JsonResponse
     */
    public function getZones(int $cityId): JsonResponse
    {
        try {
            $result = $this->pathaoService->getZones($cityId);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Zones retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getZones Exception', [
                'city_id' => $cityId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve zones',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get areas within a zone
     *
     * Retrieves all areas available within a specific zone.
     *
     * @param int $zoneId
     * @return JsonResponse
     */
    public function getAreas(int $zoneId): JsonResponse
    {
        try {
            $result = $this->pathaoService->getAreas($zoneId);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Areas retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getAreas Exception', [
                'zone_id' => $zoneId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve areas',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Create a new order
     *
     * Creates a new delivery order with Pathao courier service.
     * Validates all required fields before creating the order.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createOrder(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'store_id' => 'required|integer',
                'recipient_name' => 'required|string|max:255',
                'recipient_phone' => 'required|string|min:11|max:11',
                'recipient_address' => 'required|string|max:500',
                'recipient_city' => 'required|integer',
                'recipient_zone' => 'required|integer',
                'recipient_area' => 'required|integer',
                'delivery_type' => 'required|integer|in:48,12',
                'item_type' => 'required|integer|in:1,2',
                'item_quantity' => 'required|integer|min:1',
                'item_weight' => 'required|numeric|min:0',
                'amount_to_collect' => 'required|integer|min:0',
                'item_description' => 'nullable|string|max:500',
                'special_instruction' => 'nullable|string|max:500',
            ]);

            $result = $this->pathaoService->createOrder($validated);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order created successfully',
                    'data' => $result['data']
                ], 201);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController createOrder Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create order',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Create bulk orders
     *
     * Creates multiple orders in a single request.
     * Each order in the array must pass validation.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createBulkOrder(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'orders' => 'required|array|min:1|max:50',
                'orders.*.store_id' => 'required|integer',
                'orders.*.recipient_name' => 'required|string|max:255',
                'orders.*.recipient_phone' => 'required|string|min:11|max:11',
                'orders.*.recipient_address' => 'required|string|max:500',
                'orders.*.recipient_city' => 'required|integer',
                'orders.*.recipient_zone' => 'required|integer',
                'orders.*.recipient_area' => 'required|integer',
                'orders.*.delivery_type' => 'required|integer|in:48,12',
                'orders.*.item_type' => 'required|integer|in:1,2',
                'orders.*.item_quantity' => 'required|integer|min:1',
                'orders.*.item_weight' => 'required|numeric|min:0',
                'orders.*.amount_to_collect' => 'required|integer|min:0',
                'orders.*.item_description' => 'nullable|string|max:500',
                'orders.*.special_instruction' => 'nullable|string|max:500',
            ]);

            $result = $this->pathaoService->createBulkOrder($validated['orders']);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bulk orders created successfully',
                    'data' => $result['data']
                ], 201);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController createBulkOrder Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create bulk orders',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Get order short info
     *
     * Retrieves short information about a specific order using consignment ID.
     * This endpoint is publicly accessible for order tracking.
     *
     * @param string $consignmentId
     * @return JsonResponse
     */
    public function getOrderInfo(string $consignmentId): JsonResponse
    {
        try {
            $result = $this->pathaoService->getOrderInfo($consignmentId);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order info retrieved successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController getOrderInfo Exception', [
                'consignment_id' => $consignmentId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve order info',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Track order with live tracking info including geo-location
     *
     * This is the MAIN endpoint for customer dashboard to show live location.
     * Retrieves detailed tracking information including current geo-location
     * coordinates, delivery status, and tracking history.
     *
     * This endpoint is publicly accessible for customer tracking.
     *
     * @param string $consignmentId
     * @return JsonResponse
     */
    public function trackOrder(string $consignmentId): JsonResponse
    {
        try {
            $result = $this->pathaoService->trackOrder($consignmentId);

            if ($result['success']) {
                // Validate that data contains expected structure
                $data = $result['data'] ?? [];
                if (!is_array($data)) {
                    Log::warning('Pathao trackOrder returned non-array data', [
                        'consignment_id' => $consignmentId,
                        'data_type' => gettype($data)
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid tracking data format received from Pathao',
                        'errors' => ['data_format' => 'Expected array, got ' . gettype($data)]
                    ], 400);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Order tracking retrieved successfully',
                    'data' => [
                        'consignment_id' => $consignmentId,
                        'status' => $result['status'] ?? null,
                        'geo_location' => $result['geo_location'] ?? null,
                        'tracking_history' => $result['tracking_history'] ?? [],
                        'raw_data' => $data,
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to retrieve tracking data',
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (\Exception $e) {
            Log::error('PathaoController trackOrder Exception', [
                'consignment_id' => $consignmentId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to track order',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Calculate delivery price
     *
     * Calculates the delivery price based on store, item type, delivery type,
     * weight, and destination location.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function calculatePrice(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'store_id' => 'required|integer',
                'item_type' => 'required|integer|in:1,2',
                'delivery_type' => 'required|integer|in:48,12',
                'item_weight' => 'required|numeric|min:0',
                'recipient_city' => 'required|integer',
                'recipient_zone' => 'required|integer',
            ]);

            $result = $this->pathaoService->calculatePrice($validated);

            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Price calculated successfully',
                    'data' => $result['data']
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => $result['message'],
                'errors' => $result['error'] ?? null
            ], 400);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController calculatePrice Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate price',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Test extractLocationFromOrderDetails function
     *
     * Extracts city_id, zone_id, and area_id from order details.
     * This endpoint is useful for testing the location extraction logic.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function testExtractLocation(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'order_details' => 'required|array',
            ]);

            $result = $this->pathaoService->extractLocationFromOrderDetails($validated['order_details']);

            return response()->json([
                'success' => true,
                'message' => 'Location extracted successfully',
                'data' => $result
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController testExtractLocation Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to extract location from order details',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    /**
     * Test getGeoCoordinatesByLocation function
     *
     * Gets latitude and longitude coordinates for a specific location
     * defined by city_id, zone_id, and area_id.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function testGetGeoCoordinates(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'city_id' => 'required|integer',
                'zone_id' => 'required|integer',
                'area_id' => 'required|integer',
            ]);

            $result = $this->pathaoService->getGeoCoordinatesByLocation(
                $validated['city_id'],
                $validated['zone_id'],
                $validated['area_id']
            );

            return response()->json([
                'success' => true,
                'message' => 'Geo coordinates retrieved successfully',
                'data' => $result
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('PathaoController testGetGeoCoordinates Exception', [
                'city_id' => $validated['city_id'] ?? null,
                'zone_id' => $validated['zone_id'] ?? null,
                'area_id' => $validated['area_id'] ?? null,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve geo coordinates',
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }
}