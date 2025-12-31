# Pathao Courier Integration Guide

## Table of Contents
- [Overview](#overview)
- [Architecture](#architecture)
- [Component Overview](#component-overview)
- [Features Implemented](#features-implemented)
- [Prerequisites](#prerequisites)
- [Installation Steps](#installation-steps)
- [Configuration](#configuration)
- [Database Schema](#database-schema)
- [API Endpoints](#api-endpoints)
- [Usage Examples](#usage-examples)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
- [Best Practices](#best-practices)

---

## Overview

The Pathao Courier Integration provides live order tracking with geo-location capabilities for the Saffron e-commerce platform. This integration enables customers to track their orders in real-time on the customer dashboard, view delivery status, and see the current location of their package.

### Key Benefits
- **Real-time Tracking**: Live order tracking with geo-location coordinates
- **Seamless Integration**: Integrated with existing Bagisto order system
- **Automated Updates**: Automatic status updates from Pathao API
- **Comprehensive History**: Complete tracking history for each order
- **Public Access**: Customer-facing tracking endpoints without authentication
- **Bulk Operations**: Support for bulk order creation
- **Price Calculation**: Built-in delivery price estimation

### What is Pathao?

Pathao is a leading logistics and courier service provider in Bangladesh, offering:
- Same-day and next-day delivery
- Real-time tracking
- Cash on delivery (COD) support
- Multiple delivery zones
- API-first approach for seamless integration

---

## Architecture

### System Architecture Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                         Customer Dashboard                       │
│                    (Frontend Application)                        │
└──────────────────────────────┬──────────────────────────────────┘
                               │
                               │ HTTP Request
                               ▼
┌─────────────────────────────────────────────────────────────────┐
│                      Laravel API Layer                           │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │              PathaoController                             │   │
│  │  - Validates requests                                     │   │
│  │  - Handles HTTP responses                                │   │
│  │  - Public endpoints for tracking                          │   │
│  └────────────────────┬─────────────────────────────────────┘   │
│                       │                                          │
│                       ▼                                          │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │              PathaoService                               │   │
│  │  - API authentication                                   │   │
│  │  - Token management (cache)                            │   │
│  │  - HTTP requests to Pathao API                          │   │
│  │  - Error handling & logging                             │   │
│  └────────────────────┬─────────────────────────────────────┘   │
└───────────────────────┼──────────────────────────────────────────┘
                        │
                        │ HTTPS Requests
                        ▼
┌─────────────────────────────────────────────────────────────────┐
│                    Pathao Courier API                            │
│  - Authentication Endpoint                                       │
│  - Store Management                                              │
│  - Location Data (Cities, Zones, Areas)                          │
│  - Order Management                                              │
│  - Order Tracking (with Geo-location)                            │
│  - Price Calculation                                             │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                      Database Layer                              │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │              orders Table                                 │   │
│  │  - pathao_consignment_id                                  │   │
│  │  - pathao_tracking_enabled                                │   │
│  └──────────────────────────────────────────────────────────┘   │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │              pathao_orders Table                           │   │
│  │  - order_id (FK)                                          │   │
│  │  - consignment_id                                         │   │
│  │  - order_status                                           │   │
│  │  - latitude, longitude                                    │   │
│  │  - tracking_data (JSON)                                   │   │
│  └──────────────────────────────────────────────────────────┘   │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │              pathao_tracking_history Table                 │   │
│  │  - pathao_order_id (FK)                                   │   │
│  │  - status, timestamp                                      │   │
│  │  - latitude, longitude                                    │   │
│  └──────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘
```

### Data Flow

1. **Order Creation**: Customer places order → System creates Pathao order → Returns consignment ID
2. **Tracking Request**: Customer requests tracking → API fetches from Pathao → Returns geo-location data
3. **Status Updates**: Pathao updates order status → System syncs tracking history → Customer sees updates
4. **Location Updates**: Pathao provides geo-coordinates → System stores in database → Dashboard displays location

---

## Component Overview

### 1. PathaoService ([`app/Services/PathaoService.php`](app/Services/PathaoService.php))

The service layer handles all Pathao API interactions:

**Key Responsibilities:**
- OAuth 2.0 authentication with token caching
- HTTP request handling with retry logic
- Store management operations
- Location data retrieval (cities, zones, areas)
- Order creation and management
- Order tracking with geo-location
- Price calculation

**Key Methods:**
- [`getAccessToken()`](app/Services/PathaoService.php:65) - Obtain and cache access token
- [`createOrder()`](app/Services/PathaoService.php:505) - Create new delivery order
- [`trackOrder()`](app/Services/PathaoService.php:606) - Track order with geo-location
- [`calculatePrice()`](app/Services/PathaoService.php:659) - Calculate delivery price
- [`getCities()`](app/Services/PathaoService.php:407), [`getZones()`](app/Services/PathaoService.php:439), [`getAreas()`](app/Services/PathaoService.php:472) - Location data

### 2. PathaoController ([`app/Http/Controllers/PathaoController.php`](app/Http/Controllers/PathaoController.php))

The controller handles HTTP requests and responses:

**Key Responsibilities:**
- Request validation
- Response formatting
- Authentication middleware
- Public endpoints for customer tracking

**Key Methods:**
- [`createOrder()`](app/Http/Controllers/PathaoController.php:429) - Create new order
- [`trackOrder()`](app/Http/Controllers/PathaoController.php:608) - Public tracking endpoint
- [`getOrderInfo()`](app/Http/Controllers/PathaoController.php:562) - Public order info
- [`calculatePrice()`](app/Http/Controllers/PathaoController.php:657) - Calculate price

### 3. PathaoOrder Model ([`app/Models/PathaoOrder.php`](app/Models/PathaoOrder.php))

Represents Pathao orders with relationships:

**Key Features:**
- BelongsTo relationship with Order
- HasMany relationship with PathaoTrackingHistory
- Status helper methods (isDelivered, isInTransit, etc.)
- Query scopes for filtering
- Geo-location methods

**Key Methods:**
- [`updateTracking()`](app/Models/PathaoOrder.php:124) - Update tracking data
- [`getLocation()`](app/Models/PathaoOrder.php:153) - Get current location
- [`isDelivered()`](app/Models/PathaoOrder.php:180) - Check if delivered
- [`findByConsignmentId()`](app/Models/PathaoOrder.php:316) - Find by consignment ID

### 4. PathaoTrackingHistory Model ([`app/Models/PathaoTrackingHistory.php`](app/Models/PathaoTrackingHistory.php))

Stores tracking history for orders:

**Key Features:**
- BelongsTo relationship with PathaoOrder
- Geo-location data per tracking event
- Timestamp for each status change
- Location name and remarks

### 5. Configuration ([`config/pathao.php`](config/pathao.php))

Centralized configuration for Pathao integration:

**Configuration Sections:**
- API base URL (sandbox/production)
- Client credentials
- Authentication credentials
- API endpoints
- Request settings (timeout, retry)
- Cache settings

### 6. Routes ([`routes/api.php`](routes/api.php))

API routes for Pathao integration:

**Route Groups:**
- Authentication routes (token management)
- Store management routes
- Location data routes
- Order management routes
- Public tracking routes
- Price calculation routes

---

## Features Implemented

### 1. Authentication & Token Management
- OAuth 2.0 password grant authentication
- Automatic token caching with TTL
- Token refresh mechanism
- Configurable cache settings

### 2. Store Management
- Create new stores
- List all stores
- Get store details by ID

### 3. Location Data
- Get all cities
- Get zones by city
- Get areas by zone
- Hierarchical location structure

### 4. Order Management
- Create single orders
- Create bulk orders (up to 50)
- Get order information
- Order validation

### 5. Live Order Tracking
- Real-time order tracking
- Geo-location coordinates (latitude, longitude)
- Complete tracking history
- Status updates
- Public access for customers

### 6. Price Calculation
- Delivery price estimation
- Based on item type, weight, location
- Support for different delivery types

### 7. Database Integration
- Seamless integration with existing orders table
- Tracking history storage
- Geo-location data storage
- Foreign key relationships

### 8. Error Handling
- Comprehensive error logging
- Retry logic for failed requests
- Validation error handling
- API error response handling

---

## Prerequisites

Before installing the Pathao Courier integration, ensure you have:

### System Requirements
- PHP 8.1 or higher
- Laravel 10.x or higher
- MySQL 5.7 or higher / MariaDB 10.3 or higher
- Composer package manager
- Node.js and NPM (for frontend)

### Pathao Account Requirements
- Active Pathao merchant account
- API credentials (Client ID, Client Secret)
- API username and password
- Approved API access

### Required Laravel Packages
```bash
laravel/framework
guzzlehttp/guzzle
```

### Environment Configuration
- `.env` file properly configured
- Database connection established
- Cache driver configured (Redis recommended)

---

## Installation Steps

### Step 1: Install Dependencies

The integration uses Laravel's built-in HTTP client. Ensure Guzzle is installed:

```bash
composer require guzzlehttp/guzzle
```

### Step 2: Publish Configuration

Copy the Pathao configuration file:

```bash
php artisan config:publish --path=config/pathao.php
```

The configuration file is already included at [`config/pathao.php`](config/pathao.php).

### Step 3: Run Migrations

Run the database migrations to create required tables:

```bash
php artisan migrate
```

This will create:
- `pathao_orders` table
- `pathao_tracking_history` table
- Add `pathao_consignment_id` and `pathao_tracking_enabled` to `orders` table

### Step 4: Configure Environment Variables

Add the following to your `.env` file:

```env
# Pathao Courier Configuration
PATHAO_BASE_URL=https://courier-api-sandbox.pathao.com
PATHAO_CLIENT_ID=your_client_id_here
PATHAO_CLIENT_SECRET=your_client_secret_here
PATHAO_USERNAME=your_username_here
PATHAO_PASSWORD=your_password_here
PATHAO_GRANT_TYPE=password
```

For production, change `PATHAO_BASE_URL` to:
```env
PATHAO_BASE_URL=https://courier-api.pathao.com
```

### Step 5: Clear Configuration Cache

Clear the configuration cache to apply changes:

```bash
php artisan config:clear
php artisan cache:clear
```

### Step 6: Verify Installation

Test the installation by accessing the API:

```bash
curl -X GET http://your-domain.com/api/pathao/cities \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

## Configuration

### Configuration File: [`config/pathao.php`](config/pathao.php)

#### API Base URL

```php
'base_url' => env('PATHAO_BASE_URL', 'https://courier-api-sandbox.pathao.com'),
```

**Options:**
- Sandbox: `https://courier-api-sandbox.pathao.com`
- Production: `https://courier-api.pathao.com`

#### Client Credentials

```php
'client_id' => env('PATHAO_CLIENT_ID'),
'client_secret' => env('PATHAO_CLIENT_SECRET'),
```

Obtain these from your Pathao merchant dashboard.

#### Authentication Credentials

```php
'username' => env('PATHAO_USERNAME'),
'password' => env('PATHAO_PASSWORD'),
```

These are your Pathao API login credentials.

#### Grant Type

```php
'grant_type' => env('PATHAO_GRANT_TYPE', 'password'),
```

Pathao uses OAuth 2.0 password grant type.

#### API Endpoints

All endpoints are pre-configured:

```php
'endpoints' => [
    'authenticate' => '/aladdin/api/v1/issue-token',
    'zones' => '/aladdin/api/v1/cities/{city_id}/zone-list',
    'areas' => '/aladdin/api/v1/zones/{zone_id}/area-list',
    'create_order' => '/aladdin/api/v1/orders',
    'get_order' => '/aladdin/api/v1/orders/{order_id}',
    'cancel_order' => '/aladdin/api/v1/orders/{order_id}/cancel',
    'track_order' => '/aladdin/api/v1/orders/{order_id}/track',
    'price_estimate' => '/aladdin/api/v1/merchant/me/price-plan',
],
```

#### Request Configuration

```php
'request' => [
    'timeout' => 30,           // Request timeout in seconds
    'retry_times' => 3,        // Number of retry attempts
    'retry_sleep' => 1000,      // Sleep between retries (ms)
],
```

#### Cache Configuration

```php
'cache' => [
    'enabled' => true,
    'access_token_ttl' => 3600,  // 1 hour
    'zones_ttl' => 86400,          // 24 hours
    'areas_ttl' => 86400,         // 24 hours
],
```

---

## Database Schema

### pathao_orders Table

```sql
CREATE TABLE pathao_orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED NULL,
    consignment_id VARCHAR(255) UNIQUE NULL,
    merchant_order_id VARCHAR(255) NULL,
    store_id VARCHAR(255) NULL,
    order_status VARCHAR(255) DEFAULT 'Pending',
    order_status_slug VARCHAR(255) NULL,
    delivery_fee DECIMAL(10, 2) DEFAULT 0.00,
    recipient_name VARCHAR(255) NULL,
    recipient_phone VARCHAR(255) NULL,
    recipient_address TEXT NULL,
    latitude DECIMAL(10, 8) NULL,
    longitude DECIMAL(11, 8) NULL,
    tracking_data JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_order_id (order_id),
    INDEX idx_consignment_id (consignment_id),
    INDEX idx_merchant_order_id (merchant_order_id),
    INDEX idx_order_status (order_status),
    INDEX idx_store_id (store_id),
    
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);
```

### pathao_tracking_history Table

```sql
CREATE TABLE pathao_tracking_history (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pathao_order_id BIGINT UNSIGNED NOT NULL,
    status VARCHAR(255) NULL,
    status_slug VARCHAR(255) NULL,
    latitude DECIMAL(10, 8) NULL,
    longitude DECIMAL(11, 8) NULL,
    location_name VARCHAR(255) NULL,
    remarks TEXT NULL,
    timestamp TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    INDEX idx_pathao_order_id (pathao_order_id),
    INDEX idx_status (status),
    INDEX idx_timestamp (timestamp),
    
    FOREIGN KEY (pathao_order_id) REFERENCES pathao_orders(id) ON DELETE CASCADE
);
```

### orders Table (Additional Fields)

```sql
ALTER TABLE orders ADD COLUMN pathao_consignment_id VARCHAR(255) NULL AFTER cart_id;
ALTER TABLE orders ADD COLUMN pathao_tracking_enabled BOOLEAN DEFAULT FALSE AFTER pathao_consignment_id;
ALTER TABLE orders ADD INDEX idx_pathao_consignment_id (pathao_consignment_id);
```

---

## API Endpoints

All Pathao API endpoints are prefixed with `/api/pathao`.

### Authentication Endpoints

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| GET | `/api/pathao/token` | Yes | Get current access token |
| POST | `/api/pathao/refresh-token` | Yes | Refresh access token |

### Store Management Endpoints

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| POST | `/api/pathao/stores` | Yes | Create new store |
| GET | `/api/pathao/stores` | Yes | List all stores |
| GET | `/api/pathao/stores/{id}` | Yes | Get store details |

### Location Data Endpoints

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| GET | `/api/pathao/cities` | Yes | List all cities |
| GET | `/api/pathao/cities/{cityId}/zones` | Yes | Get zones by city |
| GET | `/api/pathao/zones/{zoneId}/areas` | Yes | Get areas by zone |

### Order Management Endpoints

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| POST | `/api/pathao/orders` | Yes | Create new order |
| POST | `/api/pathao/orders/bulk` | Yes | Create bulk orders |

### Public Tracking Endpoints (No Auth Required)

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| GET | `/api/pathao/orders/{consignmentId}/info` | No | Get order info |
| GET | `/api/pathao/orders/{consignmentId}/track` | No | Track order with geo-location |

### Price Calculation Endpoint

| Method | Endpoint | Auth Required | Description |
|--------|----------|---------------|-------------|
| POST | `/api/pathao/price-calculate` | Yes | Calculate delivery price |

---

## Usage Examples

### Example 1: Create a New Order

```bash
curl -X POST http://your-domain.com/api/pathao/orders \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "store_id": 123,
    "recipient_name": "John Doe",
    "recipient_phone": "01712345678",
    "recipient_address": "123 Main Street, Dhaka",
    "recipient_city": 1,
    "recipient_zone": 2,
    "recipient_area": 3,
    "delivery_type": 48,
    "item_type": 1,
    "item_quantity": 1,
    "item_weight": 0.5,
    "amount_to_collect": 1000,
    "item_description": "Electronics item",
    "special_instruction": "Handle with care"
  }'
```

### Example 2: Track Order (Public)

```bash
curl -X GET http://your-domain.com/api/pathao/orders/CONS-12345/track
```

Response:
```json
{
  "success": true,
  "message": "Order tracking retrieved successfully",
  "data": {
    "consignment_id": "CONS-12345",
    "status": "In Transit",
    "geo_location": {
      "latitude": 23.8103,
      "longitude": 90.4125,
      "address": "Gulshan 1, Dhaka",
      "updated_at": "2024-12-29T10:30:00Z"
    },
    "tracking_history": [
      {
        "status": "Order Placed",
        "timestamp": "2024-12-29T08:00:00Z"
      },
      {
        "status": "Picked Up",
        "timestamp": "2024-12-29T09:30:00Z"
      }
    ]
  }
}
```

### Example 3: Calculate Delivery Price

```bash
curl -X POST http://your-domain.com/api/pathao/price-calculate \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "store_id": 123,
    "item_type": 1,
    "delivery_type": 48,
    "item_weight": 0.5,
    "recipient_city": 1,
    "recipient_zone": 2
  }'
```

### Example 4: Get Cities

```bash
curl -X GET http://your-domain.com/api/pathao/cities \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

### Example 5: Get Zones for a City

```bash
curl -X GET http://your-domain.com/api/pathao/cities/1/zones \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

## Testing

### Running Tests

Run the test suite:

```bash
php artisan test --filter Pathao
```

### Manual Testing

Use the provided test endpoints to verify functionality:

1. **Test Authentication**
   ```bash
   curl -X GET http://your-domain.com/api/pathao/token \
     -H "Authorization: Bearer YOUR_API_TOKEN"
   ```

2. **Test Order Creation**
   ```bash
   curl -X POST http://your-domain.com/api/pathao/orders \
     -H "Authorization: Bearer YOUR_API_TOKEN" \
     -H "Content-Type: application/json" \
     -d @test_order.json
   ```

3. **Test Tracking**
   ```bash
   curl -X GET http://your-domain.com/api/pathao/orders/CONS-12345/track
   ```

### Test Data

Create a test order JSON file (`test_order.json`):

```json
{
  "store_id": 123,
  "recipient_name": "Test Customer",
  "recipient_phone": "01712345678",
  "recipient_address": "Test Address, Dhaka",
  "recipient_city": 1,
  "recipient_zone": 2,
  "recipient_area": 3,
  "delivery_type": 48,
  "item_type": 1,
  "item_quantity": 1,
  "item_weight": 0.5,
  "amount_to_collect": 1000
}
```

---

## Troubleshooting

### Common Issues

#### 1. Authentication Failed

**Problem:** Unable to obtain access token

**Solutions:**
- Verify credentials in `.env` file
- Check if credentials are correct for the environment (sandbox vs production)
- Ensure Pathao account is active
- Clear cache: `php artisan cache:clear`

#### 2. Order Creation Failed

**Problem:** Order creation returns error

**Solutions:**
- Validate all required fields
- Check store ID exists
- Verify city, zone, and area IDs are valid
- Ensure phone number format is correct (11 digits)
- Check delivery_type and item_type values

#### 3. Tracking Not Working

**Problem:** Unable to track order

**Solutions:**
- Verify consignment ID is correct
- Check if order exists in Pathao system
- Ensure order is not too old (tracking data expires)
- Check network connectivity

#### 4. Geo-location Not Available

**Problem:** No geo-location data in tracking response

**Solutions:**
- Order may not be in transit yet
- Pathao may not have location data for this order
- Check if order status supports tracking
- Verify API endpoint is correct

#### 5. Cache Issues

**Problem:** Stale data or authentication errors

**Solutions:**
- Clear cache: `php artisan cache:clear`
- Clear config: `php artisan config:clear`
- Restart queue workers if using queues
- Check Redis connection if using Redis cache

#### 6. Timeout Errors

**Problem:** API requests timing out

**Solutions:**
- Increase timeout in config: `'timeout' => 60`
- Check network connectivity
- Verify Pathao API status
- Check server resources

### Debug Mode

Enable debug logging in `.env`:

```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Check logs:

```bash
tail -f storage/logs/laravel.log | grep Pathao
```

### Error Codes

| Error Code | Description | Solution |
|------------|-------------|----------|
| 401 | Unauthorized | Check credentials and token |
| 403 | Forbidden | Verify API permissions |
| 404 | Not Found | Check endpoint and IDs |
| 422 | Validation Error | Validate request data |
| 429 | Too Many Requests | Implement rate limiting |
| 500 | Server Error | Check logs and retry |

---

## Best Practices

### 1. Security
- Never commit credentials to version control
- Use environment variables for sensitive data
- Implement rate limiting on public endpoints
- Use HTTPS in production
- Rotate credentials regularly

### 2. Performance
- Enable caching for access tokens
- Cache location data (cities, zones, areas)
- Use database indexes for frequently queried fields
- Implement queue for bulk operations
- Monitor API response times

### 3. Error Handling
- Implement retry logic for transient failures
- Log all API errors with context
- Provide meaningful error messages to users
- Handle edge cases gracefully
- Monitor error rates

### 4. Data Integrity
- Validate all input data
- Use database transactions for critical operations
- Implement idempotency for order creation
- Sync tracking data regularly
- Backup tracking history

### 5. Monitoring
- Track API usage and costs
- Monitor order success rates
- Alert on authentication failures
- Track delivery times
- Monitor cache hit rates

### 6. User Experience
- Provide clear status messages
- Show estimated delivery times
- Display tracking history chronologically
- Implement auto-refresh for tracking
- Provide fallback when tracking unavailable

---

## Additional Resources

- [Pathao API Documentation](https://docs.pathao.com/)
- [Pathao Developer Portal](https://developer.pathao.com/)
- [API Documentation](PATHAO_API_DOCUMENTATION.md)
- [Developer Guide](PATHAO_DEVELOPER_GUIDE.md)
- [Deployment Guide](PATHAO_DEPLOYMENT_GUIDE.md)
- [Integration Test Report](PATHAO_INTEGRATION_TEST_REPORT.md)

---

## Support

For issues or questions:
- Check the troubleshooting section above
- Review the API documentation
- Contact Pathao support for API-specific issues
- Check Laravel logs for detailed error messages

---

## Changelog

### Version 1.0.0 (2024-12-29)
- Initial release
- OAuth 2.0 authentication
- Store management
- Location data retrieval
- Order creation and tracking
- Geo-location support
- Price calculation
- Bulk order support
- Public tracking endpoints
