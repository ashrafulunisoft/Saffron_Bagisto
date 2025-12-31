<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Pathao Service
 *
 * Service layer for handling all Pathao Courier API interactions including
 * authentication, store management, location data, order management,
 * tracking, and price calculation.
 */
class PathaoService
{
    /**
     * Cache key for access token
     */
    private const ACCESS_TOKEN_CACHE_KEY = 'pathao_access_token';

    /**
     * Cache key for refresh token
     */
    private const REFRESH_TOKEN_CACHE_KEY = 'pathao_refresh_token';

    /**
     * Get API base URL from configuration
     *
     * @return string
     */
    private function getBaseUrl(): string
    {
        return config('pathao.base_url');
    }

    /**
     * Get API endpoint with optional parameters
     *
     * @param string $endpoint
     * @param array $params
     * @return string
     */
    private function getEndpoint(string $endpoint, array $params = []): string
    {
        $endpoint = config("pathao.endpoints.{$endpoint}", $endpoint);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $endpoint = str_replace("{{$key}}", $value, $endpoint);
            }
        }

        return $endpoint;
    }

    /**
     * Get access token using credentials
     *
     * @return array
     * @throws Exception
     */
    public function getAccessToken(): array
    {
        try {
            // Check if token is cached and valid
            if (config('pathao.cache.enabled')) {
                $cachedToken = Cache::get(self::ACCESS_TOKEN_CACHE_KEY);
                if ($cachedToken) {
                    return [
                        'success' => true,
                        'data' => $cachedToken,
                        'message' => 'Access token retrieved from cache'
                    ];
                }
            }

            $response = Http::timeout(config('pathao.request.timeout', 30))
                ->retry(
                    config('pathao.request.retry_times', 3),
                    config('pathao.request.retry_sleep', 1000)
                )
                ->post($this->getBaseUrl() . $this->getEndpoint('authenticate'), [
                    'client_id' => config('pathao.client_id'),
                    'client_secret' => config('pathao.client_secret'),
                    'username' => config('pathao.username'),
                    'password' => config('pathao.password'),
                    'grant_type' => config('pathao.grant_type', 'password'),
                ]);

            if (!$response->successful()) {
                Log::error('Pathao Authentication Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Authentication failed',
                    'error' => $response->json()
                ];
            }

            $data = $response->json();

            // Cache the access token
            if (config('pathao.cache.enabled') && isset($data['access_token'])) {
                $cacheTtl = config('pathao.cache.access_token_ttl', 3600);
                Cache::put(self::ACCESS_TOKEN_CACHE_KEY, $data, $cacheTtl);

                if (isset($data['refresh_token'])) {
                    Cache::put(self::REFRESH_TOKEN_CACHE_KEY, $data['refresh_token'], $cacheTtl * 2);
                }
            }

            Log::info('Pathao Access Token Retrieved Successfully');

            return [
                'success' => true,
                'data' => $data,
                'message' => 'Access token retrieved successfully'
            ];

        } catch (Exception $e) {
            Log::error('Pathao Get Access Token Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get access token',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Refresh access token using refresh token
     *
     * @param string $refreshToken
     * @return array
     */
    public function refreshAccessToken(string $refreshToken): array
    {
        try {
            $response = Http::timeout(config('pathao.request.timeout', 30))
                ->retry(
                    config('pathao.request.retry_times', 3),
                    config('pathao.request.retry_sleep', 1000)
                )
                ->post($this->getBaseUrl() . $this->getEndpoint('authenticate'), [
                    'client_id' => config('pathao.client_id'),
                    'client_secret' => config('pathao.client_secret'),
                    'refresh_token' => $refreshToken,
                    'grant_type' => 'refresh_token',
                ]);

            if (!$response->successful()) {
                Log::error('Pathao Token Refresh Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Token refresh failed',
                    'error' => $response->json()
                ];
            }

            $data = $response->json();

            // Cache the new access token
            if (config('pathao.cache.enabled') && isset($data['access_token'])) {
                $cacheTtl = config('pathao.cache.access_token_ttl', 3600);
                Cache::put(self::ACCESS_TOKEN_CACHE_KEY, $data, $cacheTtl);

                if (isset($data['refresh_token'])) {
                    Cache::put(self::REFRESH_TOKEN_CACHE_KEY, $data['refresh_token'], $cacheTtl * 2);
                }
            }

            Log::info('Pathao Access Token Refreshed Successfully');

            return [
                'success' => true,
                'data' => $data,
                'message' => 'Access token refreshed successfully'
            ];

        } catch (Exception $e) {
            Log::error('Pathao Refresh Access Token Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to refresh access token',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get cached access token or fetch new one
     *
     * @return string|null
     */
    private function getValidAccessToken(): ?string
    {
        if (config('pathao.cache.enabled')) {
            $cachedToken = Cache::get(self::ACCESS_TOKEN_CACHE_KEY);
            if ($cachedToken && isset($cachedToken['access_token'])) {
                return $cachedToken['access_token'];
            }
        }

        $result = $this->getAccessToken();

        if ($result['success'] && isset($result['data']['access_token'])) {
            return $result['data']['access_token'];
        }

        return null;
    }

    /**
     * Make authenticated API request
     *
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    private function makeAuthenticatedRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $accessToken = $this->getValidAccessToken();

            if (!$accessToken) {
                return [
                    'success' => false,
                    'message' => 'Unable to obtain access token',
                    'error' => 'Authentication required'
                ];
            }

            $url = $this->getBaseUrl() . $endpoint;

            $response = Http::timeout(config('pathao.request.timeout', 30))
                ->retry(
                    config('pathao.request.retry_times', 3),
                    config('pathao.request.retry_sleep', 1000)
                )
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->$method($url, $data);

            if (!$response->successful()) {
                Log::error('Pathao API Request Failed', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                // Try to parse JSON response, fallback to plain text
                $responseData = $this->parseJsonResponse($response->body());

                return [
                    'success' => false,
                    'message' => 'API request failed',
                    'error' => $responseData,
                    'status' => $response->status()
                ];
            }

            // Validate response is valid JSON before parsing
            $responseData = $this->parseJsonResponse($response->body());

            if ($responseData === null) {
                Log::error('Pathao API Invalid JSON Response', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Invalid JSON response from Pathao API',
                    'error' => $response->body()
                ];
            }

            return [
                'success' => true,
                'data' => $responseData,
                'message' => 'Request successful'
            ];

        } catch (Exception $e) {
            Log::error('Pathao API Request Exception', [
                'method' => $method,
                'endpoint' => $endpoint,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'API request exception',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Make public API request (no authentication)
     *
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    private function makePublicRequest(string $method, string $endpoint, array $data = []): array
    {
        try {
            $url = $this->getBaseUrl() . $endpoint;

            $response = Http::timeout(config('pathao.request.timeout', 30))
                ->retry(
                    config('pathao.request.retry_times', 3),
                    config('pathao.request.retry_sleep', 1000)
                )
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // NOTE: No Authorization header for public endpoints
                ])
                ->$method($url, $data);

            if (!$response->successful()) {
                Log::error('Pathao API Request Failed', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                $responseData = $this->parseJsonResponse($response->body());

                return [
                    'success' => false,
                    'message' => 'API request failed',
                    'error' => $responseData,
                    'status' => $response->status()
                ];
            }

            $responseData = $this->parseJsonResponse($response->body());

            if ($responseData === null) {
                Log::error('Pathao API Invalid JSON Response', [
                    'method' => $method,
                    'endpoint' => $endpoint,
                    'body' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Invalid JSON response from Pathao API',
                    'error' => $response->body()
                ];
            }

            return [
                'success' => true,
                'data' => $responseData,
                'message' => 'Request successful'
            ];

        } catch (Exception $e) {
            Log::error('Pathao API Request Exception', [
                'method' => $method,
                'endpoint' => $endpoint,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'API request exception',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create a new store
     *
     * @param array $storeData
     * @return array
     */
    public function createStore(array $storeData): array
    {
        try {
            Log::info('Creating Pathao Store', ['store_data' => $storeData]);

            $endpoint = '/aladdin/api/v1/stores';
            $result = $this->makeAuthenticatedRequest('post', $endpoint, $storeData);

            if ($result['success']) {
                Log::info('Pathao Store Created Successfully', ['data' => $result['data']]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Create Store Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to create store',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get list of stores
     *
     * @return array
     */
    public function getStores(): array
    {
        try {
            $endpoint = '/aladdin/api/v1/stores';
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Stores Retrieved Successfully');
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Stores Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get stores',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get specific store info
     *
     * @param int $storeId
     * @return array
     */
    public function getStoreInfo(int $storeId): array
    {
        try {
            $endpoint = "/aladdin/api/v1/stores/{$storeId}";
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Store Info Retrieved Successfully', ['store_id' => $storeId]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Store Info Exception', [
                'store_id' => $storeId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get store info',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get list of cities
     *
     * @return array
     */
    public function getCities(): array
    {
        try {
            $endpoint = '/aladdin/api/v1/city-list';
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Cities Retrieved Successfully');
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Cities Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get cities',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get zones within a city
     *
     * @param int $cityId
     * @return array
     */
    public function getZones(int $cityId): array
    {
        try {
            $endpoint = $this->getEndpoint('zones', ['city_id' => $cityId]);
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Zones Retrieved Successfully', ['city_id' => $cityId]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Zones Exception', [
                'city_id' => $cityId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get zones',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get areas within a zone
     *
     * @param int $zoneId
     * @return array
     */
    public function getAreas(int $zoneId): array
    {
        try {
            $endpoint = $this->getEndpoint('areas', ['zone_id' => $zoneId]);
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Areas Retrieved Successfully', ['zone_id' => $zoneId]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Areas Exception', [
                'zone_id' => $zoneId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get areas',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create a new order
     *
     * @param array $orderData
     * @return array
     */
    public function createOrder(array $orderData): array
    {
        try {
            Log::info('Creating Pathao Order', ['order_data' => $orderData]);

            $endpoint = '/aladdin/api/v1/orders';
            $result = $this->makeAuthenticatedRequest('post', $endpoint, $orderData);

            if ($result['success']) {
                Log::info('Pathao Order Created Successfully', ['data' => $result['data']]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Create Order Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create bulk orders
     *
     * @param array $orders
     * @return array
     */
    public function createBulkOrder(array $orders): array
    {
        try {
            Log::info('Creating Pathao Bulk Orders', ['order_count' => count($orders)]);

            $endpoint = '/aladdin/api/v1/orders/bulk';
            $result = $this->makeAuthenticatedRequest('post', $endpoint, ['orders' => $orders]);

            if ($result['success']) {
                Log::info('Pathao Bulk Orders Created Successfully', ['data' => $result['data']]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Create Bulk Order Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to create bulk orders',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get order short info
     *
     * @param string $consignmentId
     * @return array
     */
    public function getOrderInfo(string $consignmentId): array
    {
        try {
            $endpoint = "/aladdin/api/v1/orders/{$consignmentId}/info";
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            if ($result['success']) {
                Log::info('Pathao Order Info Retrieved Successfully', ['consignment_id' => $consignmentId]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Get Order Info Exception', [
                'consignment_id' => $consignmentId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to get order info',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Track order with live tracking info including geo-location
     *
     * @param string $consignmentId
     * @return array
     */
    public function trackOrder(string $consignmentId): array
    {
        try {
            $endpoint = $this->getEndpoint('track_order', ['order_id' => $consignmentId]);
            $result = $this->makeAuthenticatedRequest('get', $endpoint);

            // Check if the request itself failed
            if (!$result['success']) {
                Log::error('Pathao Track Order Request Failed', [
                    'consignment_id' => $consignmentId,
                    'error' => $result['error'] ?? 'Unknown error'
                ]);
                return $result;
            }

            $trackingData = $result['data'];

            // Check if Pathao API returned an error in the response data
            // Pathao API returns {"error":true,"success":true,"message":"Unauthorized!"}
            if (isset($trackingData['error']) && $trackingData['error'] === true) {
                Log::error('Pathao API Returned Error', [
                    'consignment_id' => $consignmentId,
                    'api_message' => $trackingData['message'] ?? 'Unknown API error',
                    'full_response' => $trackingData
                ]);

                return [
                    'success' => false,
                    'message' => $trackingData['message'] ?? 'Pathao API returned an error',
                    'error' => $trackingData,
                    'api_error' => true
                ];
            }

            Log::info('Pathao Order Tracking Retrieved Successfully', [
                'consignment_id' => $consignmentId,
                'data' => $trackingData
            ]);

            // Extract geo-location data if available
            // Handle both nested geo_location structure and flat structure
            $geoLocation = null;

            // Try nested geo_location structure first
            if (isset($trackingData['geo_location']) && is_array($trackingData['geo_location'])) {
                $geoLocation = [
                    'latitude' => $trackingData['geo_location']['latitude'] ?? null,
                    'longitude' => $trackingData['geo_location']['longitude'] ?? null,
                    'address' => $trackingData['geo_location']['address'] ?? null,
                    'updated_at' => $trackingData['geo_location']['updated_at'] ?? null,
                ];
            }
            // Fallback to current_location structure
            elseif (isset($trackingData['current_location']) && is_array($trackingData['current_location'])) {
                $geoLocation = [
                    'latitude' => $trackingData['current_location']['latitude'] ?? null,
                    'longitude' => $trackingData['current_location']['longitude'] ?? null,
                    'address' => $trackingData['current_location']['address'] ?? null,
                    'updated_at' => $trackingData['current_location']['updated_at'] ?? null,
                ];
            }

            $result['geo_location'] = $geoLocation;
            $result['status'] = $trackingData['status'] ?? $trackingData['order_status'] ?? null;
            $result['tracking_history'] = $trackingData['tracking_history'] ?? $trackingData['history'] ?? [];

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Track Order Exception', [
                'consignment_id' => $consignmentId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to track order',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Extract location information (area, zone, city) from order details
     *
     * @param array $orderDetails
     * @return array
     */
    public function extractLocationFromOrderDetails(array $orderDetails): array
    {
        try {
            Log::info('Extracting Location from Order Details', ['order_details' => $orderDetails]);

            // Extract location IDs from order details
            $cityId = $orderDetails['recipient_city'] ?? $orderDetails['city_id'] ?? null;
            $zoneId = $orderDetails['recipient_zone'] ?? $orderDetails['zone_id'] ?? null;
            $areaId = $orderDetails['recipient_area'] ?? $orderDetails['area_id'] ?? null;

            // Validate that at least one location ID is present
            if (!$cityId && !$zoneId && !$areaId) {
                Log::warning('No location IDs found in order details', ['order_details' => $orderDetails]);

                return [
                    'success' => false,
                    'data' => [
                        'city_id' => null,
                        'zone_id' => null,
                        'area_id' => null,
                    ],
                    'message' => 'No location IDs found in order details'
                ];
            }

            // Convert to integers if present
            $locationData = [
                'city_id' => $cityId ? (int) $cityId : null,
                'zone_id' => $zoneId ? (int) $zoneId : null,
                'area_id' => $areaId ? (int) $areaId : null,
            ];

            Log::info('Location Extracted Successfully', ['location_data' => $locationData]);

            return [
                'success' => true,
                'data' => $locationData,
                'message' => 'Location extracted successfully'
            ];

        } catch (Exception $e) {
            Log::error('Pathao Extract Location from Order Details Exception', [
                'order_details' => $orderDetails,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'data' => [
                    'city_id' => null,
                    'zone_id' => null,
                    'area_id' => null,
                ],
                'message' => 'Failed to extract location from order details',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get geo coordinates (latitude, longitude) for a specific location
     *
     * @param int $cityId
     * @param int $zoneId
     * @param int $areaId
     * @return array
     */
    public function getGeoCoordinatesByLocation(int $cityId, int $zoneId, int $areaId): array
    {
        try {
            Log::info('Getting Geo Coordinates for Location', [
                'city_id' => $cityId,
                'zone_id' => $zoneId,
                'area_id' => $areaId
            ]);

            $latitude = null;
            $longitude = null;
            $cityName = null;
            $zoneName = null;
            $areaName = null;

            // Get city data
            if ($cityId > 0) {
                $citiesResult = $this->getCities();

                if ($citiesResult['success'] && isset($citiesResult['data']['data'])) {
                    $cities = $citiesResult['data']['data'];

                    // Find the city by ID
                    foreach ($cities as $city) {
                        if (isset($city['city_id']) && (int) $city['city_id'] === $cityId) {
                            $cityName = $city['city_name'] ?? null;

                            // Check for geo coordinates in city data
                            $latitude = $latitude ?? $city['latitude'] ?? $city['lat'] ?? null;
                            $longitude = $longitude ?? $city['longitude'] ?? $city['lng'] ?? $city['long'] ?? null;

                            // Check for nested geo_location object
                            if (isset($city['geo_location']) && is_array($city['geo_location'])) {
                                $latitude = $latitude ?? $city['geo_location']['latitude'] ?? $city['geo_location']['lat'] ?? null;
                                $longitude = $longitude ?? $city['geo_location']['longitude'] ?? $city['geo_location']['lng'] ?? $city['geo_location']['long'] ?? null;
                            }

                            break;
                        }
                    }
                }
            }

            // Get zone data
            if ($zoneId > 0) {
                $zonesResult = $this->getZones($cityId);

                if ($zonesResult['success'] && isset($zonesResult['data']['data'])) {
                    $zones = $zonesResult['data']['data'];

                    // Find the zone by ID
                    foreach ($zones as $zone) {
                        if (isset($zone['zone_id']) && (int) $zone['zone_id'] === $zoneId) {
                            $zoneName = $zone['zone_name'] ?? null;

                            // Check for geo coordinates in zone data (more specific than city)
                            $latitude = $latitude ?? $zone['latitude'] ?? $zone['lat'] ?? null;
                            $longitude = $longitude ?? $zone['longitude'] ?? $zone['lng'] ?? $zone['long'] ?? null;

                            // Check for nested geo_location object
                            if (isset($zone['geo_location']) && is_array($zone['geo_location'])) {
                                $latitude = $latitude ?? $zone['geo_location']['latitude'] ?? $zone['geo_location']['lat'] ?? null;
                                $longitude = $longitude ?? $zone['geo_location']['longitude'] ?? $zone['geo_location']['lng'] ?? $zone['geo_location']['long'] ?? null;
                            }

                            break;
                        }
                    }
                }
            }

            // Get area data (most specific location)
            if ($areaId > 0) {
                $areasResult = $this->getAreas($zoneId);

                if ($areasResult['success'] && isset($areasResult['data']['data'])) {
                    $areas = $areasResult['data']['data'];

                    // Find the area by ID
                    foreach ($areas as $area) {
                        if (isset($area['area_id']) && (int) $area['area_id'] === $areaId) {
                            $areaName = $area['area_name'] ?? null;

                            // Check for geo coordinates in area data (most specific)
                            $latitude = $latitude ?? $area['latitude'] ?? $area['lat'] ?? null;
                            $longitude = $longitude ?? $area['longitude'] ?? $area['lng'] ?? $area['long'] ?? null;

                            // Check for nested geo_location object
                            if (isset($area['geo_location']) && is_array($area['geo_location'])) {
                                $latitude = $latitude ?? $area['geo_location']['latitude'] ?? $area['geo_location']['lat'] ?? null;
                                $longitude = $longitude ?? $area['geo_location']['longitude'] ?? $area['geo_location']['lng'] ?? $area['geo_location']['long'] ?? null;
                            }

                            break;
                        }
                    }
                }
            }

            // Convert coordinates to float if present
            $latitude = $latitude !== null ? (float) $latitude : null;
            $longitude = $longitude !== null ? (float) $longitude : null;

            $geoData = [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'city_name' => $cityName,
                'zone_name' => $zoneName,
                'area_name' => $areaName,
            ];

            Log::info('Geo Coordinates Retrieved Successfully', ['geo_data' => $geoData]);

            return [
                'success' => true,
                'data' => $geoData,
                'message' => $latitude && $longitude
                    ? 'Geo coordinates retrieved successfully'
                    : 'Geo coordinates not available for this location'
            ];

        } catch (Exception $e) {
            Log::error('Pathao Get Geo Coordinates Exception', [
                'city_id' => $cityId,
                'zone_id' => $zoneId,
                'area_id' => $areaId,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'data' => [
                    'latitude' => null,
                    'longitude' => null,
                    'city_name' => null,
                    'zone_name' => null,
                    'area_name' => null,
                ],
                'message' => 'Failed to get geo coordinates',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Calculate delivery price
     *
     * @param array $data
     * @return array
     */
    public function calculatePrice(array $data): array
    {
        try {
            Log::info('Calculating Pathao Delivery Price', ['data' => $data]);

            $endpoint = $this->getEndpoint('price_estimate');
            $result = $this->makeAuthenticatedRequest('post', $endpoint, $data);

            if ($result['success']) {
                Log::info('Pathao Price Calculated Successfully', ['data' => $result['data']]);
            }

            return $result;

        } catch (Exception $e) {
            Log::error('Pathao Calculate Price Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to calculate price',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Clear cached access token
     *
     * @return void
     */
    public function clearAccessTokenCache(): void
    {
        Cache::forget(self::ACCESS_TOKEN_CACHE_KEY);
        Cache::forget(self::REFRESH_TOKEN_CACHE_KEY);

        Log::info('Pathao Access Token Cache Cleared');
    }

    /**
     * Parse JSON response with validation
     *
     * Safely parses JSON response and returns null if invalid.
     * This handles cases where Pathao API returns plain text like "Unauthorized!"
     *
     * @param string $jsonString
     * @return array|null
     */
    private function parseJsonResponse(string $jsonString): ?array
    {
        $data = json_decode($jsonString, true);

        // Check for JSON parsing errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::warning('Failed to parse JSON response', [
                'json_error' => json_last_error_msg(),
                'response_body' => substr($jsonString, 0, 500) // Log first 500 chars
            ]);
            return null;
        }

        // Ensure we have an array
        if (!is_array($data)) {
            Log::warning('JSON response is not an array', [
                'response_type' => gettype($data),
                'response_body' => substr($jsonString, 0, 500)
            ]);
            return null;
        }

        return $data;
    }



}
