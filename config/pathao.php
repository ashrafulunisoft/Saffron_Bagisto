<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pathao Courier Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file manages the Pathao Courier integration for
    | live order tracking with geo-location on the customer order dashboard.
    | Pathao is a leading logistics and courier service provider in Bangladesh.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Enable Pathao Integration
    |--------------------------------------------------------------------------
    |
    | Enable or disable Pathao integration globally. When disabled, Pathao
    | orders will not be created even when Pathao is selected as carrier.
    |
    */
    'enabled' => env('PATHAO_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Default Store ID
    |--------------------------------------------------------------------------
    |
    | The default Pathao store ID to use when creating orders.
    | This can be overridden per order if needed.
    |
    */
    'default_store_id' => env('PATHAO_DEFAULT_STORE_ID'),

    /*
    |--------------------------------------------------------------------------
    | API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Pathao Courier API. This can be set to either
    | the sandbox environment for testing or the production environment
    | for live operations.
    |
    | Sandbox: https://courier-api-sandbox.pathao.com
    | Production: https://courier-api.pathao.com
    |
    */
    'base_url' => env('PATHAO_BASE_URL', 'https://courier-api-sandbox.pathao.com'),

    /*
    |--------------------------------------------------------------------------
    | Client Credentials
    |--------------------------------------------------------------------------
    |
    | The client ID and secret provided by Pathao for API authentication.
    | These credentials are used to obtain access tokens for API requests.
    |
    */
    'client_id' => env('PATHAO_CLIENT_ID'),
    'client_secret' => env('PATHAO_CLIENT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Authentication Credentials
    |--------------------------------------------------------------------------
    |
    | The username and password used to authenticate with the Pathao API.
    | These credentials are used in conjunction with the grant type to
    | obtain OAuth access tokens.
    |
    */
    'username' => env('PATHAO_USERNAME'),
    'password' => env('PATHAO_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | OAuth Grant Type
    |--------------------------------------------------------------------------
    |
    | The OAuth grant type used for authentication. Pathao uses the
    | 'password' grant type for API authentication.
    |
    */
    'grant_type' => env('PATHAO_GRANT_TYPE', 'password'),

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    |
    | Specific API endpoints for various Pathao operations. These are
    | appended to the base URL to form complete API request URLs.
    |
    */
    'endpoints' => [
        // Authentication endpoint to obtain access token
        'authenticate' => '/aladdin/api/v1/issue-token',

        // Get list of available zones for a specific city
        'zones' => '/aladdin/api/v1/cities/{city_id}/zone-list',

        // Get list of available areas for a specific zone
        'areas' => '/aladdin/api/v1/zones/{zone_id}/area-list',

        // Create a new order
        'create_order' => '/aladdin/api/v1/orders',

        // Get order details
        'get_order' => '/aladdin/api/v1/orders/{order_id}',

        // Cancel an order
        'cancel_order' => '/aladdin/api/v1/orders/{order_id}/cancel',

        // Get order tracking information
        'track_order' => '/aladdin/api/v1/orders/{order_id}/track',

        // Get order price estimate
        'price_estimate' => '/aladdin/api/v1/merchant/me/price-plan',
    ],

    /*
    |--------------------------------------------------------------------------
    | Order Configuration
    |--------------------------------------------------------------------------
    |
    | Default order settings for Pathao integration.
    |
    */
    'delivery_type' => env('PATHAO_DELIVERY_TYPE', 48), // 48 = Normal Delivery
    'item_type' => env('PATHAO_ITEM_TYPE', 2), // 2 = Parcel

    /*
    |--------------------------------------------------------------------------
    | Request Configuration
    |--------------------------------------------------------------------------
    |
    | Additional configuration for API requests including timeout,
    | retry attempts, and other HTTP client settings.
    |
    */
    'request' => [
        'timeout' => 30, // Request timeout in seconds
        'retry_times' => 3, // Number of retry attempts on failure
        'retry_sleep' => 1000, // Sleep time between retries in milliseconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Cache settings for storing access tokens and other frequently
    | accessed data to reduce API calls and improve performance.
    |
    */
    'cache' => [
        'enabled' => true,
        'access_token_ttl' => 3600, // Access token cache time in seconds (1 hour)
        'zones_ttl' => 86400, // Zones cache time in seconds (24 hours)
        'areas_ttl' => 86400, // Areas cache time in seconds (24 hours)
    ],

];