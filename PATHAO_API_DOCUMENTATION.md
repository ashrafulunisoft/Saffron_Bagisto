# Pathao API Documentation

## Table of Contents
- [Overview](#overview)
- [Authentication](#authentication)
- [Base URL](#base-url)
- [Rate Limiting](#rate-limiting)
- [Error Handling](#error-handling)
- [API Endpoints](#api-endpoints)
  - [Authentication Endpoints](#authentication-endpoints)
  - [Store Management Endpoints](#store-management-endpoints)
  - [Location Data Endpoints](#location-data-endpoints)
  - [Order Management Endpoints](#order-management-endpoints)
  - [Order Tracking Endpoints](#order-tracking-endpoints)
  - [Price Calculation Endpoint](#price-calculation-endpoint)
- [Data Models](#data-models)
- [Best Practices](#best-practices)
- [Testing](#testing)

---

## Overview

This document provides comprehensive API documentation for the Pathao Courier integration. All endpoints follow RESTful conventions and return JSON responses.

### API Version
- Current Version: v1
- Base Path: `/api/pathao`

### Response Format
All API responses follow this structure:

```json
{
  "success": true|false,
  "message": "Human-readable message",
  "data": { ... },
  "errors": { ... }
}
```

---

## Authentication

### OAuth 2.0 Authentication

The Pathao API uses OAuth 2.0 with the password grant type for authentication.

#### Authentication Flow

1. **Obtain Access Token**
   - Send credentials to authentication endpoint
   - Receive access token and refresh token
   - Access token is cached for 1 hour

2. **Use Access Token**
   - Include access token in Authorization header
   - Format: `Bearer {access_token}`

3. **Refresh Token**
   - Use refresh token to obtain new access token
   - Refresh token is valid for 2 hours

#### Authentication Headers

```http
Authorization: Bearer {access_token}
Content-Type: application/json
Accept: application/json
```

---

## Base URL

### Environments

| Environment | Base URL |
|-------------|----------|
| Sandbox | `https://courier-api-sandbox.pathao.com` |
| Production | `https://courier-api.pathao.com` |

### Configuration

Set the base URL in your `.env` file:

```env
# Sandbox (Testing)
PATHAO_BASE_URL=https://courier-api-sandbox.pathao.com

# Production
PATHAO_BASE_URL=https://courier-api.pathao.com
```

---

## Rate Limiting

### Rate Limits

| Endpoint Type | Rate Limit |
|---------------|------------|
| Authentication | 10 requests/minute |
| Store Management | 60 requests/minute |
| Location Data | 100 requests/minute |
| Order Management | 30 requests/minute |
| Order Tracking | 60 requests/minute |

### Rate Limit Headers

```http
X-RateLimit-Limit: 100
X-RateLimit-Remaining: 95
X-RateLimit-Reset: 1609459200
```

### Handling Rate Limits

When rate limit is exceeded, the API returns:

```json
{
  "success": false,
  "message": "Too many requests",
  "errors": {
    "rate_limit": "Rate limit exceeded"
  }
}
```

**Status Code:** 429 Too Many Requests

**Best Practices:**
- Implement exponential backoff
- Cache location data to reduce API calls
- Use bulk operations for multiple orders
- Monitor rate limit headers

---

## Error Handling

### Error Response Format

```json
{
  "success": false,
  "message": "Error description",
  "errors": {
    "field_name": ["Error message"]
  }
}
```

### HTTP Status Codes

| Status Code | Description |
|-------------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Validation Error |
| 429 | Too Many Requests |
| 500 | Internal Server Error |

### Error Codes

| Error Code | HTTP Status | Description |
|------------|-------------|-------------|
| AUTH_001 | 401 | Invalid credentials |
| AUTH_002 | 401 | Token expired |
| AUTH_003 | 401 | Invalid token |
| VAL_001 | 422 | Validation failed |
| VAL_002 | 422 | Missing required field |
| VAL_003 | 422 | Invalid field format |
| ORD_001 | 404 | Order not found |
| ORD_002 | 400 | Order creation failed |
| ORD_003 | 400 | Invalid order status |
| STO_001 | 404 | Store not found |
| LOC_001 | 404 | City not found |
| LOC_002 | 404 | Zone not found |
| LOC_003 | 404 | Area not found |
| SRV_001 | 500 | Internal server error |
| SRV_002 | 503 | Service unavailable |

### Common Error Responses

#### Authentication Error (401)
```json
{
  "success": false,
  "message": "Authentication failed",
  "errors": {
    "error": "Invalid credentials"
  }
}
```

#### Validation Error (422)
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "recipient_phone": [
      "The recipient phone must be 11 digits."
    ],
    "item_weight": [
      "The item weight must be at least 0."
    ]
  }
}
```

#### Not Found Error (404)
```json
{
  "success": false,
  "message": "Resource not found",
  "errors": {
    "order": "Order with consignment ID 'CONS-12345' not found"
  }
}
```

#### Server Error (500)
```json
{
  "success": false,
  "message": "Internal server error",
  "errors": {
    "exception": "An unexpected error occurred"
  }
}
```

---

## API Endpoints

### Authentication Endpoints

#### Get Access Token

Obtain a new access token using credentials.

**Endpoint:** `GET /api/pathao/token`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Access token retrieved successfully",
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "Bearer",
    "expires_in": 3600,
    "scope": "read write"
  }
}
```

**Error Response (400 Bad Request):**
```json
{
  "success": false,
  "message": "Authentication failed",
  "errors": {
    "error": "Invalid credentials"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/token \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

#### Refresh Access Token

Refresh an expired access token using refresh token.

**Endpoint:** `POST /api/pathao/refresh-token`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Access token refreshed successfully",
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "Bearer",
    "expires_in": 3600,
    "refresh_token": "def50200f3e5...",
    "scope": "read write"
  }
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "No refresh token available",
  "errors": {
    "refresh_token": "Refresh token not found in cache"
  }
}
```

**cURL Example:**
```bash
curl -X POST http://your-domain.com/api/pathao/refresh-token \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

### Store Management Endpoints

#### Create Store

Create a new store in the Pathao system.

**Endpoint:** `POST /api/pathao/stores`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
```

**Request Body:**
```json
{
  "name": "Main Store",
  "contact_name": "John Doe",
  "contact_number": "01712345678",
  "address": "123 Business Street, Dhaka",
  "city_id": 1,
  "zone_id": 2,
  "area_id": 3
}
```

**Request Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| name | string | Yes | Store name (max 255 chars) |
| contact_name | string | Yes | Contact person name (max 255 chars) |
| contact_number | string | Yes | Contact phone (11 digits) |
| address | string | Yes | Store address (max 500 chars) |
| city_id | integer | Yes | City ID from Pathao |
| zone_id | integer | Yes | Zone ID from Pathao |
| area_id | integer | Yes | Area ID from Pathao |

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Store created successfully",
  "data": {
    "store_id": 123,
    "name": "Main Store",
    "contact_name": "John Doe",
    "contact_number": "01712345678",
    "address": "123 Business Street, Dhaka",
    "city_id": 1,
    "zone_id": 2,
    "area_id": 3,
    "created_at": "2024-12-29T10:00:00Z"
  }
}
```

**Error Response (422 Validation Error):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "contact_number": [
      "The contact number must be 11 digits."
    ]
  }
}
```

**cURL Example:**
```bash
curl -X POST http://your-domain.com/api/pathao/stores \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Main Store",
    "contact_name": "John Doe",
    "contact_number": "01712345678",
    "address": "123 Business Street, Dhaka",
    "city_id": 1,
    "zone_id": 2,
    "area_id": 3
  }'
```

---

#### Get Stores

Retrieve all stores associated with the authenticated account.

**Endpoint:** `GET /api/pathao/stores`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Stores retrieved successfully",
  "data": [
    {
      "store_id": 123,
      "name": "Main Store",
      "contact_name": "John Doe",
      "contact_number": "01712345678",
      "address": "123 Business Street, Dhaka",
      "city_id": 1,
      "zone_id": 2,
      "area_id": 3,
      "created_at": "2024-12-29T10:00:00Z"
    },
    {
      "store_id": 124,
      "name": "Secondary Store",
      "contact_name": "Jane Smith",
      "contact_number": "01812345678",
      "address": "456 Market Road, Chittagong",
      "city_id": 2,
      "zone_id": 5,
      "area_id": 8,
      "created_at": "2024-12-28T15:30:00Z"
    }
  ]
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/stores \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

#### Get Store Info

Retrieve detailed information about a specific store.

**Endpoint:** `GET /api/pathao/stores/{id}`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**URL Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| id | integer | Yes | Store ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Store info retrieved successfully",
  "data": {
    "store_id": 123,
    "name": "Main Store",
    "contact_name": "John Doe",
    "contact_number": "01712345678",
    "address": "123 Business Street, Dhaka",
    "city_id": 1,
    "zone_id": 2,
    "area_id": 3,
    "created_at": "2024-12-29T10:00:00Z",
    "updated_at": "2024-12-29T11:00:00Z"
  }
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "Store not found",
  "errors": {
    "store": "Store with ID 999 not found"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/stores/123 \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

### Location Data Endpoints

#### Get Cities

Retrieve all available cities in the Pathao system.

**Endpoint:** `GET /api/pathao/cities`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Cities retrieved successfully",
  "data": [
    {
      "city_id": 1,
      "city_name": "Dhaka",
      "country_id": 1
    },
    {
      "city_id": 2,
      "city_name": "Chittagong",
      "country_id": 1
    },
    {
      "city_id": 3,
      "city_name": "Sylhet",
      "country_id": 1
    }
  ]
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/cities \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

#### Get Zones

Retrieve all zones within a specific city.

**Endpoint:** `GET /api/pathao/cities/{cityId}/zones`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**URL Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| cityId | integer | Yes | City ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Zones retrieved successfully",
  "data": [
    {
      "zone_id": 1,
      "zone_name": "Gulshan",
      "city_id": 1
    },
    {
      "zone_id": 2,
      "zone_name": "Banani",
      "city_id": 1
    },
    {
      "zone_id": 3,
      "zone_name": "Dhanmondi",
      "city_id": 1
    }
  ]
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "City not found",
  "errors": {
    "city": "City with ID 999 not found"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/cities/1/zones \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

#### Get Areas

Retrieve all areas within a specific zone.

**Endpoint:** `GET /api/pathao/zones/{zoneId}/areas`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
```

**URL Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| zoneId | integer | Yes | Zone ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Areas retrieved successfully",
  "data": [
    {
      "area_id": 1,
      "area_name": "Gulshan 1",
      "zone_id": 1
    },
    {
      "area_id": 2,
      "area_name": "Gulshan 2",
      "zone_id": 1
    },
    {
      "area_id": 3,
      "area_name": "Gulshan North Avenue",
      "zone_id": 1
    }
  ]
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "Zone not found",
  "errors": {
    "zone": "Zone with ID 999 not found"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/zones/1/areas \
  -H "Authorization: Bearer YOUR_API_TOKEN"
```

---

### Order Management Endpoints

#### Create Order

Create a new delivery order with Pathao courier service.

**Endpoint:** `POST /api/pathao/orders`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
```

**Request Body:**
```json
{
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
}
```

**Request Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| store_id | integer | Yes | Store ID from Pathao |
| recipient_name | string | Yes | Recipient name (max 255 chars) |
| recipient_phone | string | Yes | Recipient phone (11 digits) |
| recipient_address | string | Yes | Delivery address (max 500 chars) |
| recipient_city | integer | Yes | City ID |
| recipient_zone | integer | Yes | Zone ID |
| recipient_area | integer | Yes | Area ID |
| delivery_type | integer | Yes | 48 (48 hours) or 12 (12 hours) |
| item_type | integer | Yes | 1 (Document) or 2 (Parcel) |
| item_quantity | integer | Yes | Number of items (min 1) |
| item_weight | decimal | Yes | Weight in kg (min 0) |
| amount_to_collect | integer | Yes | COD amount (min 0) |
| item_description | string | No | Item description (max 500 chars) |
| special_instruction | string | No | Special instructions (max 500 chars) |

**Delivery Types:**
- `48` - 48-hour delivery (standard)
- `12` - 12-hour delivery (express)

**Item Types:**
- `1` - Document
- `2` - Parcel

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "consignment_id": "CONS-12345678",
    "merchant_order_id": "ORD-001",
    "order_status": "Pending",
    "delivery_fee": 60.00,
    "estimated_delivery": "2024-12-31T18:00:00Z",
    "created_at": "2024-12-29T10:00:00Z"
  }
}
```

**Error Response (422 Validation Error):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "recipient_phone": [
      "The recipient phone must be 11 digits."
    ],
    "delivery_type": [
      "The delivery type must be 48 or 12."
    ]
  }
}
```

**cURL Example:**
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

---

#### Create Bulk Orders

Create multiple orders in a single request (up to 50 orders).

**Endpoint:** `POST /api/pathao/orders/bulk`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
```

**Request Body:**
```json
{
  "orders": [
    {
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
      "amount_to_collect": 1000
    },
    {
      "store_id": 123,
      "recipient_name": "Jane Smith",
      "recipient_phone": "01812345678",
      "recipient_address": "456 Market Road, Chittagong",
      "recipient_city": 2,
      "recipient_zone": 5,
      "recipient_area": 8,
      "delivery_type": 48,
      "item_type": 2,
      "item_quantity": 2,
      "item_weight": 1.0,
      "amount_to_collect": 2000
    }
  ]
}
```

**Request Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| orders | array | Yes | Array of order objects (1-50 orders) |
| orders.* | object | Yes | Order object (same as create order) |

**Response (201 Created):**
```json
{
  "success": true,
  "message": "Bulk orders created successfully",
  "data": {
    "total_orders": 2,
    "successful_orders": 2,
    "failed_orders": 0,
    "orders": [
      {
        "consignment_id": "CONS-12345678",
        "merchant_order_id": "ORD-001",
        "order_status": "Pending",
        "delivery_fee": 60.00
      },
      {
        "consignment_id": "CONS-12345679",
        "merchant_order_id": "ORD-002",
        "order_status": "Pending",
        "delivery_fee": 75.00
      }
    ]
  }
}
```

**Error Response (422 Validation Error):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "orders": [
      "The orders field must have between 1 and 50 items."
    ]
  }
}
```

**cURL Example:**
```bash
curl -X POST http://your-domain.com/api/pathao/orders/bulk \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json" \
  -d @bulk_orders.json
```

---

### Order Tracking Endpoints

#### Get Order Info

Retrieve short information about a specific order using consignment ID.

**Endpoint:** `GET /api/pathao/orders/{consignmentId}/info`

**Authentication Required:** No (Public Endpoint)

**URL Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| consignmentId | string | Yes | Consignment ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Order info retrieved successfully",
  "data": {
    "consignment_id": "CONS-12345678",
    "merchant_order_id": "ORD-001",
    "order_status": "In Transit",
    "order_status_slug": "in-transit",
    "recipient_name": "John Doe",
    "recipient_phone": "01712345678",
    "recipient_address": "123 Main Street, Dhaka",
    "delivery_fee": 60.00,
    "created_at": "2024-12-29T10:00:00Z",
    "updated_at": "2024-12-29T14:30:00Z"
  }
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "Order not found",
  "errors": {
    "order": "Order with consignment ID 'CONS-99999999' not found"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/orders/CONS-12345678/info
```

---

#### Track Order

Retrieve detailed tracking information including current geo-location coordinates.

**Endpoint:** `GET /api/pathao/orders/{consignmentId}/track`

**Authentication Required:** No (Public Endpoint)

**URL Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| consignmentId | string | Yes | Consignment ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Order tracking retrieved successfully",
  "data": {
    "consignment_id": "CONS-12345678",
    "status": "In Transit",
    "geo_location": {
      "latitude": 23.8103,
      "longitude": 90.4125,
      "address": "Gulshan 1, Dhaka",
      "updated_at": "2024-12-29T14:30:00Z"
    },
    "tracking_history": [
      {
        "status": "Order Placed",
        "status_slug": "order-placed",
        "latitude": 23.7925,
        "longitude": 90.4079,
        "location_name": "Store Location",
        "remarks": "Order placed successfully",
        "timestamp": "2024-12-29T10:00:00Z"
      },
      {
        "status": "Picked Up",
        "status_slug": "picked-up",
        "latitude": 23.7930,
        "longitude": 90.4085,
        "location_name": "Pickup Point",
        "remarks": "Package picked up by courier",
        "timestamp": "2024-12-29T11:30:00Z"
      },
      {
        "status": "In Transit",
        "status_slug": "in-transit",
        "latitude": 23.8103,
        "longitude": 90.4125,
        "location_name": "Gulshan 1",
        "remarks": "Package is in transit to destination",
        "timestamp": "2024-12-29T14:30:00Z"
      }
    ],
    "raw_data": {
      "current_location": {
        "latitude": 23.8103,
        "longitude": 90.4125,
        "address": "Gulshan 1, Dhaka"
      },
      "status": "In Transit"
    }
  }
}
```

**Error Response (404 Not Found):**
```json
{
  "success": false,
  "message": "Order not found",
  "errors": {
    "order": "Order with consignment ID 'CONS-99999999' not found"
  }
}
```

**cURL Example:**
```bash
curl -X GET http://your-domain.com/api/pathao/orders/CONS-12345678/track
```

---

### Price Calculation Endpoint

#### Calculate Price

Calculate delivery price based on store, item type, delivery type, weight, and destination.

**Endpoint:** `POST /api/pathao/price-calculate`

**Authentication Required:** Yes (API Token)

**Request Headers:**
```http
Authorization: Bearer YOUR_API_TOKEN
Content-Type: application/json
```

**Request Body:**
```json
{
  "store_id": 123,
  "item_type": 1,
  "delivery_type": 48,
  "item_weight": 0.5,
  "recipient_city": 1,
  "recipient_zone": 2
}
```

**Request Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| store_id | integer | Yes | Store ID |
| item_type | integer | Yes | 1 (Document) or 2 (Parcel) |
| delivery_type | integer | Yes | 48 (48 hours) or 12 (12 hours) |
| item_weight | decimal | Yes | Weight in kg |
| recipient_city | integer | Yes | City ID |
| recipient_zone | integer | Yes | Zone ID |

**Response (200 OK):**
```json
{
  "success": true,
  "message": "Price calculated successfully",
  "data": {
    "delivery_fee": 60.00,
    "currency": "BDT",
    "base_price": 50.00,
    "weight_charge": 10.00,
    "delivery_charge": 0.00,
    "total": 60.00,
    "estimated_delivery": "2024-12-31T18:00:00Z"
  }
}
```

**Error Response (422 Validation Error):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "item_type": [
      "The item type must be 1 or 2."
    ],
    "delivery_type": [
      "The delivery type must be 48 or 12."
    ]
  }
}
```

**cURL Example:**
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

---

## Data Models

### Order Status Values

| Status | Slug | Description |
|--------|------|-------------|
| Pending | pending | Order is pending pickup |
| Pickup Pending | pickup-pending | Pickup is pending |
| Picked Up | picked-up | Package has been picked up |
| At Hub | at-hub | Package is at the hub |
| In Transit | in-transit | Package is in transit |
| Out for Delivery | out-for-delivery | Package is out for delivery |
| Delivered | delivered | Package has been delivered |
| Cancelled | cancelled | Order has been cancelled |
| Returned | returned | Package has been returned |

### Item Types

| Type | Description |
|------|-------------|
| 1 | Document |
| 2 | Parcel |

### Delivery Types

| Type | Description |
|------|-------------|
| 12 | 12-hour delivery (express) |
| 48 | 48-hour delivery (standard) |

### Geo-Location Format

```json
{
  "latitude": 23.8103,
  "longitude": 90.4125,
  "address": "Gulshan 1, Dhaka",
  "updated_at": "2024-12-29T14:30:00Z"
}
```

### Tracking History Format

```json
{
  "status": "In Transit",
  "status_slug": "in-transit",
  "latitude": 23.8103,
  "longitude": 90.4125,
  "location_name": "Gulshan 1",
  "remarks": "Package is in transit to destination",
  "timestamp": "2024-12-29T14:30:00Z"
}
```

---

## Best Practices

### 1. Authentication
- Cache access tokens to reduce API calls
- Implement token refresh before expiration
- Store credentials securely in environment variables
- Use HTTPS for all API calls in production

### 2. Error Handling
- Implement retry logic with exponential backoff
- Handle rate limiting gracefully
- Log all API errors with context
- Provide meaningful error messages to users

### 3. Performance
- Cache location data (cities, zones, areas)
- Use bulk operations for multiple orders
- Implement request queuing for high-volume operations
- Monitor API response times

### 4. Security
- Never expose credentials in client-side code
- Implement rate limiting on public endpoints
- Validate all input data
- Use CORS appropriately for public endpoints

### 5. Data Integrity
- Validate phone number format (11 digits)
- Verify location IDs before creating orders
- Use database transactions for critical operations
- Implement idempotency for order creation

### 6. User Experience
- Provide clear status messages
- Show estimated delivery times
- Display tracking history chronologically
- Implement auto-refresh for tracking

---

## Testing

### Test Environment

Use the sandbox environment for testing:

```env
PATHAO_BASE_URL=https://courier-api-sandbox.pathao.com
```

### Test Endpoints

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

Create test files for testing:

**test_order.json:**
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

## Additional Resources

- [Integration Guide](PATHAO_COURIER_INTEGRATION_GUIDE.md)
- [Developer Guide](PATHAO_DEVELOPER_GUIDE.md)
- [Deployment Guide](PATHAO_DEPLOYMENT_GUIDE.md)
- [Pathao Official API Documentation](https://docs.pathao.com/)
- [Pathao Developer Portal](https://developer.pathao.com/)

---

## Support

For API-specific issues:
- Check the error codes section
- Review the troubleshooting guide
- Contact Pathao support for API issues
- Check Laravel logs for detailed errors
